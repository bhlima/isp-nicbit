<?php namespace App\Models;

use CodeIgniter\Model;

class InvoicesModel extends Model
{
	protected $table      = 'faturas';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $useSoftDeletes = false;
	protected $allowedFields = [
		'user_id', 'date', 'status_id', 'tipo_id', 'obs', 
		'created_at', 'updated_at', 'created_by'
    	];

	protected $useTimestamps = false;
	protected $validationRules = [];
	protected $dynamicRules = [
		'cadastro' => [
			'user_id'		 		=> 'required',
		],

	];

	protected $validationMessages = [];
	protected $skipValidation = false;




	public function getRule(string $rule)
	{
		return $this->dynamicRules[$rule];
	}



}
