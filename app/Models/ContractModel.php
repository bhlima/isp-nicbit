<?php namespace App\Models;

use CodeIgniter\Model;

class ContractModel extends Model
{
	protected $table      = 'client_contrato';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'username', 'id_plano', 'created_at', 'updated_at', 'vencimento', 'status_instalacao','status_contrato'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $dateFormat  	 = 'datetime';

	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules     = [
		'cadastro'              => [
            'plan_id' 		    => 'required',
			'username' 	        => 'required'

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
