<?php
namespace App\Controllers\Auth;

/**
 * nicbit isp
 *
 * An open source application management for isp - Radius / Mikrotik
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2021-2021 - nicbit 
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    ISP - Nicbit 
 * @author     nicbit dev team @ Flavio Lima
 * @copyright  2021-2021 Nicbit.com 
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @since      Version 1.1.0
 * @filesource
 */

use CodeIgniter\Controller;
use Config\Services;
use App\Models\ContractModel;
use App\Models\ClientsModel;
use App\Models\PlansModel;
use App\Models\AreasModel;

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



	public function addcontract()
	{

		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

        $username = $this->request->uri->getSegment(3);
		$clients = new ClientsModel();
		$plans	 = new PlansModel();
		$contracts = new ContractModel();
		
		$client = $clients->where('username', $username)->first(); 

		return view('auth/add-contracts', [
			'userData'          => $this->session->userData, 
			'client'            => $client, 
			'username'			=> $username,
			'areaoptions'		=> $this->getgroupareas()
		]);

	}


	public function getSubgroup()
	{

		$id_group = $this->request->uri->getSegment(3);
		$query = "select * from subarea where  id_grouparea = '" . $id_group . "'";
		$subgroups  = new AreasModel();
		$s = $subgroups->query($query);

		//print_r($s);exit;
		
		$row = $s->getResult();
		$options = "<option value = '' > Escolha o Sub Grupo </options>";

		foreach ($row as $sub) {
			$options .= "<option value='" . $sub->id . "'>" . $sub->subgroup_name . "</option>" . PHP_EOL;
		}
		return $options;
	}



	public function edit()
	{

		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

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

		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

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


		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		$id = $this->request->uri->getSegment(3);
		$contracts = new ContractModel();
		$contracts->delete($id);
        return redirect()->back()->with('success', lang('Auth.accountDeleted'));
	}


	public function create()
	{
		helper('text');


		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

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
        return redirect()->back()->with('success', 'Successo! You created a new account');
	}


	public function getgroupareas()
    {
        $areas  = new AreasModel();
        $groups = $areas->query('select * from areas');
        $row = $groups->getResult();
        $options = "<option value = '' > Escolha o Grupo </options>";

        foreach ($row as $group) {
            $options .= "<option value='" . $group->id . "'>" . $group->groupareas . "</option>" . PHP_EOL;
        }
        return $options;
    }

	public function getplans()
    {
        $plans  = new PLansModel();
        $allplans = $plans->query('select * from planos');
        $row = $allplans->getResult();
        $options = "<option value = '' > Escolha o Plano </options>";

        foreach ($row as $plan) {
            $options .= "<option value='" . $plan->id . "'>" . $plan->nome . "</option>" . PHP_EOL;
        }
        return $options;
    }




}
