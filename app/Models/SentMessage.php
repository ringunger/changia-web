<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentMessage extends Model
{
    use HasFactory;
    public $fillable = ['number', 'successful', 'request_id', 'code', 'message', 'valid', 'invalid', 'duplicates'];
}
