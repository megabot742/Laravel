<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    public $table = 'products';
    public $inscrementing = true;
    public $timestamps = false;
}
