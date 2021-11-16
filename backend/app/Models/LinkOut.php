<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class LinkOut extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'redirect_limit',
        'redirect_count',
        'status',
        'expiration_date',
        'link_id'
    ];

    public function link()
    {
        return $this->belongsTO(Link::class);
    }
}
