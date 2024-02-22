<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    public $table = 'cart';
    public $inscrementing = true;
    public $timestamps = false;
}
