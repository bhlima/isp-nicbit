<?php
namespace App\Controllers\Auth;

use CodeIgniter\Controller;
use Config\Services;
use App\Models\GatewayModel;

class GatewaysController extends Controller
{

	protected $session;
	protected $config;


	public function __construct()
	{
		// start session
		$this->session = Services::session();
	}


	public function gateways()
	{
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		$ym = date("Y-m");

		$gateways = new GatewayModel();

		$allgateways = $gateways->findAll(); 

		$ngateways = $gateways->countAll(); 

		$activegateways = $gateways->where('active', 1)->countAllResults(); 

	
		return view('auth/gateways', [
				'userData'          => $this->session->userData, 
				'data'       => $allgateways, 
				'ngateways'         => $ngateways, 
				'activegateways'    => $activegateways
			]);
	}

	public function enable()
	{
		$id = $this->request->uri->getSegment(3);
		$gateways = new GatewayModel();
		$gateway = [
			'id'  	=> $id,
			'active'  	=> 1,
		];

		if (! $gateways->save($gateway)) {
			return redirect()->back()->withInput()->with('errors', $gateways->errors());
        }

        return redirect()->back()->with('success', lang('Auth.enableUser'));
	}


	public function disable()
	{
		$id = $this->request->uri->getSegment(3);
		$gateways = new GatewayModel();
		$gateway = [
			'id'  	=> $id,
			'active'  	=> 0,
		];

		if (! $gateways->save($gateway)) {
			return redirect()->back()->withInput()->with('errors', $gateways->errors());
        }

        return redirect()->back()->with('success', lang('Auth.enableUser'));
	}




	public function edit()
	{
		$id = $this->request->uri->getSegment(3);
		$gateways = new GatewayModel();
		$gateway = $gateways->where('id', $id)->first(); 

		return view('auth/edits/edit-gateway', [
				'userData' => $this->session->userData, 
				'gateway' => $gateway, 
			]);
	}


	public function update()
	{
		$rules = [
			'id'     		    => 'required|is_natural',
            'client_id' 		=> 'required|is_natural',
			'client_secret' 	=> 'required|is_natural',
			'pix_cert' 			=> 'required|alpha_space|min_length[2]',
			'sandbox' 			=> 'required',
			'debug'			    => 'required',
			'timeout'	        => 'required'
		];

		if (! $this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$gateways = new GatewayModel();

		$gateway = [
			'id'  	            => $this->request->getPost('id'),
			'client_id' 	    => $this->request->getPost('client_id'),
			'client_secret' 	=> $this->request->getPost('client_secret'),
			'pix_cert' 	        => $this->request->getPost('pix_cert'),
			'sandbox' 	        => $this->request->getPost('sandbox'),
			'debug' 	        => $this->request->getPost('debug'),
            'timeout' 	        => $this->request->getPost('timeout')
		];

		if (! $gateways->save($gateway)) {
			return redirect()->back()->withInput()->with('errors', $gateways->errors());
        }

        return redirect()->back()->with('success', lang('Auth.updateSuccess'));
	}



	public function delete()
	{
		$id = $this->request->uri->getSegment(3);
		$gateways = new GatewayModel();
		$gateways->delete($id);
        return redirect()->back()->with('success', lang('Auth.accountDeleted'));
	}


	public function createGateway()
	{
		helper('text');

		// save new user, validation happens in the model
		$gateways = new GatewayModel();
		$getRule = $gateways->getRule('cadastro');
		$gateways->setValidationRules($getRule);
		
        $gateway = [
            'id'          	    => $this->request->getPost('id'),
            'client_id'         => $this->request->getPost('client_id'),
            'client_secret'     => $this->request->getPost('client_secret'),
            'pix_cert'         	=> $this->request->getPost('pix_cert'),
            'sandbox'     		=> $this->request->getPost('sandbox'),
            'debug'	            => $this->request->getPost('debug'),
            'timeout' 	        => $this->request->getPost('timeout')
        ];

        if (! $gateways->save($gateway)) {
			return redirect()->back()->withInput()->with('errors', $gateways->errors());
        }
        return redirect()->back()->with('success', 'Success! You created a new account');
	}


}
