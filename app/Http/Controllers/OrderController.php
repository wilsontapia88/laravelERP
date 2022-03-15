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
        $modelOrders = $this->order->groupOrders($groupOrders);
        return response()->json($modelOrders);
        
    }
}
