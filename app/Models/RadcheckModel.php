<?php namespace App\Models;

use CodeIgniter\Model;

class RadcheckModel extends Model
{
	protected $table      = 'radcheck';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'id', 'username', 'atribute', 'op', 'value'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $dateFormat  	 = 'datetime';
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;


}
