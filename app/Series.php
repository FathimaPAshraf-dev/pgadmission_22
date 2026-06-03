<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = [
		'prefix', 'type',
	];

	public function series_table()
	{
		return $this->belongsTo('App\Prefix', 'id');
	}
}
