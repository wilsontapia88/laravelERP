Projeto laravelERP

Instrucoes para instalacao e funcionamento


depois de clonar o projeto
configurar o .env com aos dados da ta base

acessar no projeto e digitar

- composer install

Este comando vai fazer o require de todos os repositorios para o projeto funcionar

php artisan migrate

rodar o servidor
- php artisan serve

exmplo do json esperado na rota

http://127.0.0.1:8000/api/order

[
    {
	"ArticleCode": "code150",
	"ArticleName": "batidora",
	"UnitPrice":   10.00,
	"Quantity":    3
    },
    {
	"ArticleCode": "code150",
	"ArticleName": "batidora",
	"UnitPrice":   10.00,
	"Quantity":    2
    },
    {
	"ArticleCode": "code151",
	"ArticleName": "cocina",
	"UnitPrice":   180.00,
	"Quantity":    2
    }
]

ele vai fazer uma entrada na data base.

A atualizacao dos outros server e feito por um job

a configuracao dos server esta na pasta Config/servers

caso quiserem adicionar ou trocar as url dos server este e o formato

return [
    
    'https://localhost:9001/order' => [
        'OrderId',                       
        'OrderCode',                     
        'OrderDate',                     
        'TotalAmountWihtoutDiscount',    
        'TotalAmountWithDiscount',       
    ],

    'https://localhost:9002/v1/order' => [
        'id',
        'code',
        'date',
        'total',
        'discount',
    ],

    'https://localhost:9003/web_api/order' => [
        'id',
        'code',
        'date',
        'totalAmount',
        'totalAmountWithDiscount' ,
    ],

];

depois que e iniciada o job e dentro do job vai te uma requsicao, como pode ter n pedidos e melhor por jobs assim ele criara uma fila de atualizacoes sem prejudicar a performance do sistema.

depois de o server esta iniciado e so rodar os queue

php artisan queue:work 

e começara a disparar os request para atualizar os outros server tambem pode ter n server

Brigado!!


