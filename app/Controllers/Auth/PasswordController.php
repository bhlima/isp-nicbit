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

class PasswordController extends Controller
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

    public function forgotPassword()
	{
		if ($this->session->isLoggedIn) {
			return redirect()->to('account');
		}

		return view('auth/auth/forgot');
	}

    //--------------------------------------------------------------------

	public function attemptForgotPassword()
	{
		// validate request
		if (! $this->validate(['email' => 'required|valid_email'])) {
            return redirect()->back()->with('error', lang('Auth.wrongEmail'));
        }

		// check if email exists in DB
		$users = new UserModel();

		$user = $users->where('email', $this->request->getPost('email'))->first();

		if (! $user) {
            return redirect()->back()->with('error', lang('Auth.wrongEmail'));
        }

        // check if email is already sent to prevent spam
        if (! empty($user['reset_expires']) && $user['reset_expires'] >= time()) {
			return redirect()->back()->with('error', lang('Auth.emailAlreadySent'));
        }

		// set reset hash and expiration
		helper('text');
		$updatedUser['id'] = $user['id'];
		$updatedUser['reset_hash'] = random_string('alnum', 32);
		$updatedUser['reset_expires'] = time() + HOUR;
		$users->save($updatedUser);

		// send password reset e-mail
		helper('auth');
        send_password_reset_email($this->request->getPost('email'), $updatedUser['reset_hash']);

        return redirect()->back()->with('success', lang('Auth.forgottenPasswordEmail'));
	}

    //--------------------------------------------------------------------

	public function resetPassword()
	{
		// check reset hash and expiration
		$users = new UserModel();

		$user = $users->where('reset_hash', $this->request->getGet('token'))
			->where('reset_expires >', time())
			->first();

		if (! $user) {
            return redirect()->to('login')->with('error', lang('Auth.invalidRequest'));
        }

		return view('auth/auth/reset');
	}

    //--------------------------------------------------------------------

	public function attemptResetPassword()
	{
		// validate request
		$rules = [
			'token'	=> 'required',
			'password' => 'required|min_length[5]',
			'password_confirm' => 'matches[password]'
		];

		if (! $this->validate($rules)) {
            return redirect()->back()->with('error', lang('Auth.passwordMismatch'));
        }

		// check reset hash, expiration
		$users = new UserModel();
		
		$user = $users->where('reset_hash', $this->request->getPost('token'))
			->where('reset_expires >', time())
			->first();

		if (! $user) {
            return redirect()->to('login')->with('error', lang('Auth.invalidRequest'));
        }

		// update user password
        $updatedUser['id'] = $user['id'];
        $updatedUser['password'] = $this->request->getPost('password');
        $updatedUser['reset_hash'] = null;
        $updatedUser['reset_expires'] = null;
        $users->save($updatedUser);

		// redirect to login
        return redirect()->to('login')->with('success', lang('Auth.passwordUpdateSuccess'));

	}

}
