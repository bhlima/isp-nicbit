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
use App\Models\EmodelModel;

class EmodelsController extends Controller
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
	 * Displays users page.
	 */
	public function emodels()
	{
		// check if user is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		// current year and month variable 
		$ym = date("Y-m");

		// load user model
		$emodels = new EmodelModel();

		// getall users
		$allemodels = $emodels->findAll(); 

		// count all rows in users table
		$countemodels = $emodels->countAll(); 
	
		// load the view with session data
		return view('auth/emodels', [
				'userData' => $this->session->userData, 
				'data' => $allemodels, 
				'countemodels' => $countemodels, 
			]);
	}



	public function edit()
	{
		// get the user id
		$id = $this->request->uri->getSegment(3);

		// load user model
		$emodels = new EmodelModel();

		// get user data using the id
		$emodel = $emodels->where('id', $id)->first(); 

		// load the view with session data
		return view('auth/edits/edit-emodel', [
				'userData' => $this->session->userData, 
				'emodel' => $emodel, 
			]);
	}

	public function update()
	{
		$rules = [
			'id'	=> 'required|is_natural',
			'assunto'	=> 'required',
			'mensagem'	=> 'required'
		];

		if (! $this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$emodels = new EmodelModel();

		$emodel = [
			'id'  	=> $this->request->getPost('id'),
			'assunto' 	=> $this->request->getPost('assunto'),
			'mensagem' 	=> $this->request->getPost('mensagem'),
		];

		if (! $emodels->save($emodel)) {
			return redirect()->back()->withInput()->with('errors', $emodels->errors());
        }

        return redirect()->back()->with('success', 'Atualizado com sucesso!');
	}

	public function delete()
	{
		// get the user id
		$id = $this->request->uri->getSegment(3);

		// load user model
		$emodels = new EmodelModel();

		// delete user using the id
		$emodels->delete($id);

        return redirect()->back()->with('success', lang('Auth.accountDeleted'));
	}

	public function create()
	{

		return view('auth/add-emodel', [
            'userData' => $this->session->userData
        ]);

	}





	public function createEmodel()
	{
		helper('text');

		// save new user, validation happens in the model
		$emodels = new EmodelModel();
		$getRule = $emodels->getRule('cadastro');
		$emodels->setValidationRules($getRule);
		
        $emodel = [
            'assunto'          	=> $this->request->getPost('assunto'),
            'mensagem'          	=> $this->request->getPost('mensagem')
        ];

        if (! $emodels->save($emodel)) {
			return redirect()->back()->withInput()->with('errors', $emodels->errors());
        }

        return redirect()->back()->with('success', 'Success! You created a new account');
	}


}
