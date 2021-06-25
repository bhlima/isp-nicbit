<?php namespace App\Models;

use CodeIgniter\Model;

class EstadosModel extends Model
{
	protected $table      = 'Estado';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'CodigoUF', 'Nome', 'Uf', 'Regiao'
	];

	protected $useTimestamps = false;
	protected $skipValidation = true;

}
