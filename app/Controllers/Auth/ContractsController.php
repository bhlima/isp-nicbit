<?php
namespace App\Controllers\Auth;

use CodeIgniter\Controller;
use Config\Services;
use App\Models\ContractModel;

class ContractsController extends Controller
{

	protected $session;
	protected $config;


	public function __construct()
	{
		// start session
		$this->session = Services::session();
	}


	public function contracts()
	{
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		$ym = date("Y-m");
		$contracts = new ContractModel();
		$allcontracts = $contracts->findAll(); 
		$ncontracts = $contracts->countAll(); 

		return view('auth/contracts', [
				'userData'          => $this->session->userData, 
				'data'              => $allcontracts, 
				'ncontracts'        => $ncontracts, 
			]);
	}




	public function edit()
	{
		$id = $this->request->uri->getSegment(3);
		$contracts = new ContractModel();
		$contract = $contracts->where('id', $id)->first(); 

		return view('auth/edits/edit-contract', [
				'userData' => $this->session->userData, 
				'contract' => $contract, 
			]);
	}


	public function update()
	{
		$rules = [
			'id'     		        => 'required',
            'usernam' 		        => 'required',
			'vencimentofat'     	=> 'required',
			'id_plano' 			    => 'required',
		];

		if (! $this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$contracts = new ContractModel();

		$contract = [
			'id'  	            => $this->request->getPost('id'),
			'username' 	        => $this->request->getPost('username'),
			'vencimentofat'        => $this->request->getPost('vencimentofat'),
			'plan_id' 	        => $this->request->getPost('plan_id')
		];

		if (! $contracts->save($contract)) {
			return redirect()->back()->withInput()->with('errors', $contracts->errors());
        }

        return redirect()->back()->with('success', lang('Auth.updateSuccess'));
	}



	public function delete()
	{
		$id = $this->request->uri->getSegment(3);
		$contracts = new ContractModel();
		$contracts->delete($id);
        return redirect()->back()->with('success', lang('Auth.accountDeleted'));
	}


	public function create()
	{
		helper('text');

		// save new user, validation happens in the model
		$contracts = new ContractModel();
		$getRule = $contracts->getRule('cadastro');
		$contracts->setValidationRules($getRule);
		
        $contract = [
            'id'          	    => $this->request->getPost('id'),
            'usernam'           => $this->request->getPost('username'),
            'plan_id'           => $this->request->getPost('plan_id'),
            'vencimentofat'    	=> $this->request->getPost('vencimentofat'),
        ];

        if (! $contracts->save($contract)) {
			return redirect()->back()->withInput()->with('errors', $contracts->errors());
        }
        return redirect()->back()->with('success', 'Success! You created a new account');
	}


}
