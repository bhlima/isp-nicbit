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
use Config\Email;
use Config\Services;
use App\Models\UserModel;
use App\Models\LogsModel;

class UsersController extends Controller
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
	public function users()
	{
		// check if user is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->route('login');
		}

		// current year and month variable 
		$ym = date("d-m-Y");

		// load user model
		$users = new UserModel();

		// getall users
		$allusers = $users->findAll(); 

		// count all rows in users table
		$countusers = $users->countAll(); 

		// count all active user in the last 30 days
		$newusers = $users->like("created_at", $ym)->countAllResults(); 

		// count all active users
		$activeusers = $users->where('active', 1)->countAllResults(); 

		// calculate active users in how many percents
		$percentofactiveusers = ($activeusers / $countusers) * 100;
		
		// load the view with session data
		return view('auth/users', [
				'userData' => $this->session->userData, 
				'data' => $allusers, 
				'usercount' => $countusers, 
				'newusers' => $newusers,
				'percentofactiveusers' => $percentofactiveusers
			]);
	}

	public function enable()
	{
		// get the user id
		$id = $this->request->uri->getSegment(3);

		// validation does not work when data is not submitted via post form
		// $rules = [
		// 	'id'	=> 'required|integer',
		// ];

		// if (! $this->validate($rules)) {
		// 	return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		// }

		$users = new UserModel();

		$user = [
			'id'  	=> $id,
			'active'  	=> 1,
		];

		if (! $users->save($user)) {
			return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        return redirect()->back()->with('success', lang('Auth.enableUser'));
	}

	public function edit()
	{
		// get the user id
		$id = $this->request->uri->getSegment(3);

		// load user model
		$users = new UserModel();

		// get user data using the id
		$user = $users->where('id', $id)->first(); 

		// load the view with session data
		return view('auth/edits/edit-user', [
				'userData' => $this->session->userData, 
				'user' => $user, 
			]);
	}

	public function update()
	{
		$rules = [
			'id'	=> 'required|is_natural',
			'name'	=> 'required|alpha_space|min_length[2]',
			'firstname'	=> 'required|alpha_space|min_length[2]',
			'lastname'	=> 'required|alpha_space|min_length[2]',
			'email'	=> 'required|valid_email|is_unique[users.email,id,{id}]',
			'active'	=> 'required|integer',
		];

		if (! $this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$users = new UserModel();

		$user = [
			'id'  	=> $this->request->getPost('id'),
			'name' 	=> $this->request->getPost('name'),
			'firstname' 	=> $this->request->getPost('firstname'),
			'lastname' 	=> $this->request->getPost('lastname'),
			'email' 	=> $this->request->getPost('email'),
			'active' 	=> $this->request->getPost('active')
		];

		if (! $users->save($user)) {
			return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        return redirect()->back()->with('success', lang('Auth.updateSuccess'));
	}

	public function delete()
	{
		// get the user id
		$id = $this->request->uri->getSegment(3);

		// load user model
		$users = new UserModel();

		// delete user using the id
		$users->delete($id);

        return redirect()->back()->with('success', lang('Auth.accountDeleted'));
	}

	public function createUser()
	{
		helper('text');

		// save new user, validation happens in the model
		$users = new UserModel();
		$getRule = $users->getRule('registration');
		$users->setValidationRules($getRule);
		
        $user = [
            'firstname'          	=> $this->request->getPost('firstname'),
            'lastname'          	=> $this->request->getPost('lastname'),
            'name'          	=> $this->request->getPost('name'),
            'email'         	=> $this->request->getPost('email'),
            'password'     		=> $this->request->getPost('password'),
            'password_confirm'	=> $this->request->getPost('password_confirm'),
            'activate_hash' 	=> random_string('alnum', 32)
        ];

        if (! $users->save($user)) {
			return redirect()->back()->withInput()->with('errors', $users->errors());
        }

		// send activation email //
		// send email activation is commented no email support //
		
		// helper('auth'); 
        // send_activation_email($user['email'], $user['activate_hash']);

		// success
        return redirect()->back()->with('success', 'Success! You created a new account');
	}

	public function userLogs() 
	{
		// load logs model
		$logs = new LogsModel();
		// get all user logs
		$userlogs = $logs->findAll();

		return view('auth/user-logs', ['userData' => $this->session->userData, 'data' => $userlogs]);
	}

}
