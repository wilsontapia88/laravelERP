<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

use App\Jobs\PostServers;

use App\Models\Order;

class Order extends Model
{
    use HasFactory;

    protected $fillable =[
        'OrderCode',
        'OrderDate',
        'TotalAmountWihtoutDiscount',
        'TotalAmountWithDiscount',
        'OrderInfo'
    ];

    protected $casts = [
        'OrderInfo' => 'array'
    ];
}
