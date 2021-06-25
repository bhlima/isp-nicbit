<?php namespace App\Models;

use CodeIgniter\Model;

class ClientsModel extends Model
{
	protected $table      = 'radcheck';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'username', 'attribute', 'op', 'value'
	];

	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules = [
		'cadastro' => [
			'username' 	    	=> 'required|is_unique[radcheck.username,id,{id}]',
			'value' 			=> 'required'
		],

		'update' => [
			'username'	        => 'required|is_unique[radcheck.username,id,{id}]',
			'value'	            => 'required'
		]

	];



	protected $validationMessages = [];

	protected $skipValidation = false;


    //--------------------------------------------------------------------

    /**
     * Retrieves validation rule
     */
	public function getRule(string $rule)
	{
		return $this->dynamicRules[$rule];
	}
}
