<?php namespace App\Api\V1\Models;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	protected $table = 'tags';
	public $timestamps = true;
	protected $fillable = array('name');

	public function groups()
	{
		return $this->morphedByMany('App\Api\V1\Models\Group', 'taggable');
	}

	public function tags()
	{
		return $this->morphedByMany('App\Api\V1\Models\Note', 'taggable');
	}

}