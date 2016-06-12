<?php namespace App\Api\V1\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {

	protected $table = 'notes';
	public $timestamps = true;
	protected $fillable = array('name', 'group_id');

	public function group()
	{
		return $this->belongsTo('App\Api\V1\Models\Group');
	}

	public function tags()
	{
		return $this->morphToMany('App\Api\V1\Models\Tag', 'taggable');
	}

}