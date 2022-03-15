<?php

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