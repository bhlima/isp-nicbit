<?php namespace App\Models;

use CodeIgniter\Model;

class PlansModel extends Model
{
	protected $table      = 'planos';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'nome', 'id_plano', 'plano_timebank', 'plano_prepago', 'plano_banda_up', 
		'plano_banda_dw', 'plano_recorrente', 'recorrente_periodo', 'agenda_recorrente',
		'valor', 'setup', 'imposto', 'grupo_plano'
    	];

	protected $useTimestamps = false;

	protected $validationRules = [];

	protected $dynamicRules = [
		'cadastro' => [
			'nome'		 		=> 'required',
			'id_plano'			=> 'required',
			'grupo_plano'		=> 'required',
			'valor' 			=> 'required',
		],
		'update' => [
			'nome'		 		=> 'required',
			'id_plano'			=> 'required',
			'grupo_plano'		=> 'required',
			'valor' 			=> 'required',
		],
	];

	protected $validationMessages = [];

	protected $skipValidation = false;

	public function getRule(string $rule)
	{
		return $this->dynamicRules[$rule];
	}



}
