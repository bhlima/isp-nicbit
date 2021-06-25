<?php namespace App\Models;

use CodeIgniter\Model;

class RouterModel extends Model
{
	protected $table      = 'nas';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'nasname', 'shortname', 'type', 'ports', 'secret', 'server', 'community', 'descrition'
	];



	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules = [
		'cadastro' => [
			'nasname'		=> 'required',
			'secret'		=> 'required'

		],
		'update' => [
			'nasname'		=> 'required',
			'secret'		=> 'required',
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

    //--------------------------------------------------------------------


}
