<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sort extends Model
{
    protected $fillable = [
        'id', 'title','order', 'status',
    ];
}