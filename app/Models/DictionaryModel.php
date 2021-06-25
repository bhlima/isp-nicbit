<?php 


namespace App\Models;
use CodeIgniter\Model;

class DictionaryModel extends Model
{
	protected $table      = 'dictionary';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'type', 'attribute', 'vendor', 'RecommendedTable', 
        'RecommendedHelper' , 'RecommendedTooltip'
    	];

	protected $useTimestamps = false;

	protected $validationRules = [];

	protected $dynamicRules = [
		'cadastro' => [
			'attribute'			    => 'required',
			'vendor' 			    => 'required',
		],
	];

	protected $validationMessages = [];

	protected $skipValidation = false;



	public function getRule(string $rule)
        {
            return $this->dynamicRules[$rule];
        }



}
