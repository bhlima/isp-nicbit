<?php namespace App\Models;

use CodeIgniter\Model;

class CliinfoModel extends Model
{
	protected $table      = 'userinfonew';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'username','changeuserinfo', 'aniversario', 'cidade', 'estado', 'endereco', 'bairro', 'referencia',
		'email', 'enableportallogin', 'nome', 'cpf','cnpj','empresa','portalpassword','telefone1',
        'telefone1', 'telefone2', 'notes','created_at','updated_at','cep', 'localidadeatt',  
	];

	protected $useTimestamps = true;
	protected $createdField  = 'updated_at';
	protected $updatedField  = 'created_at';
	protected $dateFormat  	 = 'datetime';
	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules = [
		'cadastro' => [
			'username'   		=> 'alpha_space|min_length[2]',

		],
		'saveindexkey' => [
			'username'   		=> 'alpha_space|min_length[2]'

		],



	];

	protected $validationMessages = [];

	protected $skipValidation = false;





    public function getRule(string $rule)
	{
		return $this->dynamicRules[$rule];
	}

}
