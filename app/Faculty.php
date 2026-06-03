<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table='tb_faculty';
    protected $primaryKey = 'sl';
    protected $fillable = [

                'name'
    ];



}
