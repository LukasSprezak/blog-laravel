<?php
declare(strict_types=1);

namespace App\Model;

use App\ProductPhotos;
use Illuminate\{Database\Eloquent\Model, Support\Str};

class Article extends Model
{
    public function setTitleAttribute($val)
    {
        $this->attributes['title'] = $val;
        $this->attributes['slug'] = Str::slug($val);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeEnabled($query)
    {
        $user = auth()->user();
        if($user && $user->can('administerArticle')) {
            return $query;
        }
        return $query->where('enabled', 1);
    }

    public function photos()
    {
        return $this->hasMany(ArticlePhotos::class);
    }

    public function firstPhoto() {
        return $this->photos->first();
    }

    protected $guarded = [];

    protected $fillable = ['user_id', 'title', 'enabled', 'content', 'imageName', 'order'];
}
