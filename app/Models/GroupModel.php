<?php namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
	protected $table      = 'radgroupreply';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'groupname', 'attribute', 'op', 'value', 
    	];

	protected $useTimestamps = false;

	protected $validationRules = [];

	protected $dynamicRules = [
		'cadastro' => [
			'groupname' 		=> 'required',
			'attribute'			=> 'required',
			'op' 				=> 'required',
			'value' 			=> 'required',
		],
		'update' => [
			'groupname' 		=> 'required',
			'attribute'			=> 'required',
			'op' 				=> 'required',
			'value' 			=> 'required',
		],
	];

	protected $validationMessages = [];

	protected $skipValidation = false;

	public function getRule(string $rule)
	{
		return $this->dynamicRules[$rule];
	}



}
