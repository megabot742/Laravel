<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    public $table = 'message';
    public $inscrementing = true;
    public $timestamps = false;
}
