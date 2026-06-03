<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostpgQuali extends Model
{
    protected $table='tb_postpgquali';
    protected $primaryKey = 'postpgquali_serial';
    protected $fillable = [
        'postpgquali_exam',
        'postpgquali_institute',
        'postpgquali_university',
        'postpgquali_subjects',
        'postpgquali_year',
        'postpgquali_gp_per',
        'postpgquali_date',
        
    ];
}
