<?php namespace App\Models;

use CodeIgniter\Model;

class RadacctModel extends Model
{
	protected $table      = 'radacct';
	protected $primaryKey = 'radaccid';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'acctsessionid', 'acctuniqueid', 'username', 'groupname', 'realm', 'nasipaddress', 'nasporid',
		'nasporttype', 'acctstarttime', 'acctsessiontime', 'acctauthentic', 'conectinfo_start', 'conectinfo_stop', 
        'acctinputoctets', 'acctoutputoctets', 'caledstationid', 'callingstationid', 
        'acctterminatecause'.'servicetype', 'framedprotocol','framedipaddress','acctstartdelay',
        'acctstodelay', 'xascendsessionsvrkey', 'acctupdatetime', 'framedipv6address',
        'framedipv6address', 'framedipv6prefix', 'framedinterfaceid','acctinterval', 
        'delegateipv6prefix'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $dateFormat  	 = 'datetime';

	protected $validationRules = [];

	protected $validationMessages = [];

	protected $skipValidation = false;

	// this runs after field validation


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
