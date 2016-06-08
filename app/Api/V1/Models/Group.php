<?php namespace App\Api\V1\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

	protected $table = 'groups';
	public $timestamps = true;
	protected $fillable = array('name');

	public function tags()
	{
		return $this->morphToMany('App\Api\V1\Models\Tag', 'taggable');
	}

	public function notes()
	{
		return $this->hasMany('App\Api\V1\Models\Note');
	}

}