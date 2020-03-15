<?php
declare(strict_types=1);

namespace App\Model;

use Illuminate\{Database\Eloquent\Model, Support\Str};

class Tag extends Model
{
    public function setNameAttribute($val)
    {
        $this->attributes['name'] = $val;
        $this->attributes['slug'] = Str::slug($val);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    protected $fillable = ['name'];
}
