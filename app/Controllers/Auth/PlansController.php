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
use App\Models\PlansModel;
use App\Models\GroupModel;

class PlansController extends Controller
{

	protected $session;
	protected $config;


	public function __construct()
	{
		// start session
		$this->session = Services::session();
	}


	public function plans()
	{
		if (!$this->session->isLoggedIn) {
			return redirect()->route('login');
		}

		$ym = date("Y-m");

		$plans = new PlansModel();

		$allplans = $plans->findAll();

		$nplans = $plans->countAll();


		return view('auth/plans', [
			'userData'          => $this->session->userData,
			'data'       => $allplans,
			'nplans'         => $nplans,
		]);
	}


	public function edit()
	{
		$id = $this->request->uri->getSegment(3);
		$plans = new PlansModel();
		$plan  = $plans->where('id', $id)->first();

		return view('auth/edits/edit-plan', [
			'userData' => $this->session->userData,
			'data' => $plan,
		]);
	}


	public function update()
	{
		$rules = [
			'nome'     		    => 'required',
			'id_plano' 		    => 'required',
			'grupo_plano'   	=> 'required',
		];

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$plans = new PlansModel();

		$plan = [
			'id'  	            => $this->request->getPost('id'),
			'nome' 	            => $this->request->getPost('nome'),
			'id_plano' 	        => $this->request->getPost('id_plano'),
			'tipo_plano'        => $this->request->getPost('tipo_plano'),
			'plano_timebank'    => $this->request->getPost('plano_timebank'),
			'plano_prepago'     => $this->request->getPost('plano_prepago'),
			'plano_banda_up'    => $this->request->getPost('plano_banda_up'),
			'plano_banda_dw'    => $this->request->getPost('plano_banda_dw'),
			'plano_recorrente'  => $this->request->getPost('plano_recorrente'),
			'agenda_recorrente' => $this->request->getPost('agebnda_recorrente'),
			'valor'             => $this->request->getPost('valor'),
			'setup'             => $this->request->getPost('setup'),
			'imposto'           => $this->request->getPost('imposto'),
			'grupo_plano'       => $this->request->getPost('GRUPO_PLANO'),

		];

		if (!$plans->save($plan)) {
			return redirect()->back()->withInput()->with('errors', $plans->errors());
		}

		return redirect()->route('plans')->with('success', 'Plano adicionado com sucesso');
	}



	public function delete()
	{
		$id = $this->request->uri->getSegment(3);
		$plans = new PlansModel();
		$plans->delete($id);
		return redirect()->route('plans')->with('success', 'Plano j?? era!');
	}


	public function create()
	{
		if (!$this->session->isLoggedIn) {
			return redirect()->route('public/login');
		}

		$options = $this->getnamegroup();

		return view('auth/add-plan', [
			'userData' => $this->session->userData,
			'data'  => $options,
		]);
	}



	public function createPlan()
	{
		helper('text');

		// save new user, validation happens in the model
		$plans = new PlansModel();
		$getRule = $plans->getRule('cadastro');
		$plans->setValidationRules($getRule);

		$plan = [
			'nome' 	            => $this->request->getPost('nome'),
			'id_plano' 	        => $this->request->getPost('id_plano'),
			'tipo_plano'        => $this->request->getPost('tipo_plano'),
			'valor'   			=> $this->request->getPost('valor'),
			'setup'     		=> $this->request->getPost('setup'),
			'imposto'    		=> $this->request->getPost('imposto'),
			'plano_horas'   	=> $this->request->getPost('plano_horas'),
			'plano_trafego'  	=> $this->request->getPost('plano_trafego'),
			'plano_banda_up' 	=> $this->request->getPost('plano_banda_up'),
			'plano_banda_dw'    => $this->request->getPost('plano_banda_dw'),
			'id_plano'             => $this->request->getPost('id_plano'),
			'grupo_plano'       => $this->request->getPost('grupo_plano'),
		];

		if (!$plans->save($plan)) {
			return redirect()->route('plans/create')->withInput()->with('errors', $plans->errors());
		}
		return redirect()->route('plans')->with('success', 'Plano adicionado com sucesso!');
	}

	public function getnamegroup()
	{

		$g      	= new GroupModel();
		$groups 	= $g->query('select distinct groupname from radgroupreply');
		$row 		= $groups->getResult();
		$options 	= "<option value = '' > Escolha o grupo </options>";

		foreach ($row as $group) {
			$options .= "<option value='" . $group->groupname . "'>" . $group->groupname . "</option>" . PHP_EOL;
		}
		return $options;
	}
}
