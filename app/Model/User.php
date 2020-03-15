<?php
declare(strict_types=1);

namespace App\Model;

use Illuminate\{Notifications\Notifiable, Contracts\Auth\MustVerifyEmail, Foundation\Auth\User as Authenticatable};

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;


    public function isVoter()
    {
        return $this->id === 1;
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'facebook_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
