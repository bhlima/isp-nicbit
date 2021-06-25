<?php namespace App\Models;

use CodeIgniter\Model;

class EmodelModel extends Model
{
	protected $table      = 'emailsmodel';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'assunto', 'mensagem'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $dateFormat  	 = 'datetime';

	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules = [
		'cadastro' => [
			'assunto' 		=> 'required',
			'mensagem' 			=> 'required'
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
