<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Jobs\PostServers;


class OrderController extends Controller
{
    private $order;

    public function __construct(Order $order){
        $this->order = $order;
    }

    public function index(){

    }

    public function store(Request $request){

        $dados = collect($request->all());
        $groupOrders = $dados->groupBy('ArticleCode');

        $valTotalOrder = 0;
        foreach($groupOrders as $index => $groupOrder){

            $qtdtotal = 0;
            foreach($groupOrder as $order){
                $qtdtotal += $order['Quantity'];
                $datos = [
                    "ArticleCode" => $order['ArticleCode'],
                    "ArticleName" => $order['ArticleName'],
                    "UnitPrice"   => $order['UnitPrice'],
                    "Quantity"    => $qtdtotal
                ];
            }

            $valorTotalArticle = $order['UnitPrice'] * $qtdtotal;

            $valTotalOrder += $valorTotalArticle;

            if($qtdtotal >= 5 && $qtdtotal <= 9 && $valTotalOrder >= 500){
                $valor_descontado = $valTotalOrder - $valTotalOrder * 30 / 100.0;
            }else{
                $valor_descontado = 0;
            }
            $groupOrders[$index] = $datos;
        }

        $dadosRetorno = [   
            'OrderId'                       => null,
            'OrderCode'                     => null,                                     
            'OrderDate'                     => date('Y-m-d'), # data do pedido no formato YYYY-MM-DD
            'TotalAmountWihtoutDiscount'    => $valTotalOrder,  # preço total sem desconto
            'TotalAmountWithDiscount'       => $valor_descontado,   # preço total com desconto
            'OrderInfo'                     => $groupOrders
        ];
 
        $nOrder = Order::create($dadosRetorno);
        $nOrder->OrderCode = date('Y-m-').$nOrder->id; # código no formato YYYY-MM-OrderId
        $nOrder->save();

        unset($dadosRetorno['OrderInfo']);
        
        $dadosRetorno['OrderId'] = $nOrder->id;
        $dadosRetorno['OrderCode'] = date('Y-m-').$nOrder->id;

        //job para teste o job funciona como funcao
        // dispatch_now(new PostServers($dadosRetorno));

        //job para encaminhar a utilizacao a todos os server
        dispatch(new PostServers($dadosRetorno));

        return response()->json($dadosRetorno);        
    }
}
