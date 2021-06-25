<?php namespace App\Models;

use CodeIgniter\Model;

class MunicipiosModel extends Model
{
	protected $table      = 'Municipio';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'Uf', 'Nome'
	];
	protected $useTimestamps = false;
	protected $skipValidation = true;

}
