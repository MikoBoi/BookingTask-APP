<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'ticket_adult_quantity',
        'ticket_kid_quantity',
        'ticket_discount_quantity',
        'ticket_group_quantity',
        'user_id',
        'equal_price',
        'created'
    ];
}
