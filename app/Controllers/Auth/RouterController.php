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
use App\Models\RouterModel;
use App\Models\RadacctModel;
use Radius;

class RouterController extends Controller
{

	/**
	 * Access to current session.
	 *
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	/**
	 * Authentication settings.
	 */
	protected $config;


	//--------------------------------------------------------------------

	public function __construct()
	{
		// start session
		$this->session = Services::session();
	}

	//--------------------------------------------------------------------

	/**
	 * Displays routers page.
	 */
	public function router()
	{
		// check if user is signed-in if not redirect to login page
		if (!$this->session->isLoggedIn) {
			return redirect()->route('login');
		}

		// current year and month variable 
		$ym = date("Y-m");


		// Load model for auth
		$radacct  =  new RadacctModel();



		// load router model
		$routers = new RouterModel();

		// getall routers
		$allrouters = $routers->findAll();

		//$authtoday = $radacct->



		//echo $output = shell_exec('snmpwalk -v 1 -c public 10.0.0.1 .1.3.6.1.2.1.1.1.0');



		// count all rows in users table
		$countrouters = $routers->countAll();

		// get routers active
		$activerouters = '';

		// load the view with session data
		return view('auth/servidores', [
			'userData' => $this->session->userData,
			'data' => $allrouters,
			'routerativo' => $activerouters,
			'routercount' => $countrouters
		]);
	}


	public function edit()
	{
		// get the user id
		$id = $this->request->uri->getSegment(3);

		// load user model
		$routers = new RouterModel();

		// get user data using the id
		$router = $routers->where('id', $id)->first();
		//print_r($router);

		// load the view with session data
		return view('auth/edits/edit-router', [
			'userData' => $this->session->userData,
			'router' => $router,
		]);
	}

	public function update()
	{

		$rules = [
			'id'		=> 'required|is_natural',
			'nasname'	=> 'required',
			'secret'	=> 'required',
		];

		if (!$this->validate($rules)) {
			return redirect()->route('router')->withInput()->with('errors', $this->validator->getErrors());
		}

		$routers = new RouterModel();

		$router = [
			'id'  			=> $this->request->getPost('id'),
			'nasname' 		=> $this->request->getPost('nasname'),
			'shortname' 	=> $this->request->getPost('shortname'),
			'type' 			=> $this->request->getPost('type'),
			'ports' 		=> $this->request->getPost('ports'),
			'secret' 		=> $this->request->getPost('secret'),
			'server' 		=> $this->request->getPost('server'),
			'community' 	=> $this->request->getPost('community'),
			'description' 	=> $this->request->getPost('description')

		];


		if (!$routers->save($router)) {
			$vid = $this->request->getPost('id');
			return redirect()->route('router')->withInput()->with('errors', $routers->errors());
		}

		return redirect()->route('router')->with('success', 'NAS atualizado com sucesso, servidor precisar ser reiniciado para que as alterações façam efeito.');
	}

	public function delete()
	{
		// get the user id
		$id = $this->request->uri->getSegment(3);

		// load user model
		$routers = new RouterModel();

		// delete user using the id
		$routers->delete($id);

		return redirect()->route('router')->with('success', 'NAS Removido do Sistema, servidor precisar ser reiniciado.');
	}

	public function createRouter()
	{
		helper('text');

		// save new user, validation happens in the model
		$routers = new RouterModel();
		$getRule = $routers->getRule('cadastro');
		$routers->setValidationRules($getRule);

		$router = [
			'id'  			=> $this->request->getPost('id'),
			'nasname' 		=> $this->request->getPost('nasname'),
			'shortname' 	=> $this->request->getPost('shortname'),
			'type' 			=> $this->request->getPost('type'),
			'ports' 		=> $this->request->getPost('ports'),
			'secret' 		=> $this->request->getPost('secret'),
			'server' 		=> $this->request->getPost('server'),
			'community' 	=> $this->request->getPost('community'),
			'description' 	=> $this->request->getPost('description')

		];

		if (!$routers->save($router)) {
			return redirect()->route('router')->withInput()->with('errors', $routers->errors());
		}

		// success
		return redirect()->route('router')->with('success', 'Pronto! Você adicionou nova estação cliente');
	}
}
