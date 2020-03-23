<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class ArticlePhotos extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'photo',
    ];
}