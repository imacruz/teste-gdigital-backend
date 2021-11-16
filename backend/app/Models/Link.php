<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Link extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'uri',
        'default_url',
        'expiration_date'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function linkOuts()
    {
        return $this->hasMany(LinkOut::class);
    }
}
