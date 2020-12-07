<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $table = 'students';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','email','password','pocket_money','age','city','state','zip','country','created_at','updated_at'
    ];

    protected $dates = [
        'created_at','updated_at'
    ];
}
