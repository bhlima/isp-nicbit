<?php namespace App\Models;

use CodeIgniter\Model;

class MapModel extends Model
{
	protected $table      = 'radusergroup';
	protected $primaryKey = 'username';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'username', 'groupname', 'prioority'
	];

	protected $useTimestamps = true;


	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules     = [
		'cadastro'              => [
            'username' 		    => 'required',
			'groupname' 	    => 'required',
		],
		'update' => [
            'username' 		    => 'required',
			'groupname' 	    => 'required',

		],
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
