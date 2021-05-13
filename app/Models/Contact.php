<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'user_contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
    ];

    protected $fillable = [
        'id',
        'name',
        'phone',
        'description',
        'user_uuid'
    ];

}
