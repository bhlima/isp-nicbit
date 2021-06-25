<?php namespace App\Models;

use CodeIgniter\Model;

class GatewayModel extends Model
{
	protected $table      = 'gateway';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'client_id', 'client_secret', 'pix_cert', 'sandbox', 'debug', 'timeout', 'active'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $dateFormat  	 = 'datetime';

	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules     = [
		'cadastro'              => [
            'client_id' 		=> 'required|is_natural',
			'client_secret' 	=> 'required|is_natural',
			'pix_cert' 			=> 'required',
			'sandbox' 			=> 'required',
			'debug'			    => 'required',
			'timeout'	        => 'required',

		],
		'update' => [
			'client_id' 		=> 'required|is_natural',
			'client_secret' 	=> 'required|is_natural',
			'pix_cert' 			=> 'required',
			'sandbox' 			=> 'required',
			'debug'			    => 'required',
			'timeout'	        => 'required',

		],
		'enable' => [
            'id' 		        => 'required|is_natural',
			'active'	        => 'required|integer'
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
