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
use App\Models\RadacctModel;
use App\Models\RadcheckModel;
use App\Models\SetModel;
USE LinuxInfo;
use RouterosAPI;
use Radius;




class AccountController extends Controller
{

	protected $session;
	protected $config;


	public function __construct()
	{
		$this->session = Services::session();

	}

        
	public function dashboard()
	{


		if (! $this->session->isLoggedIn) {
			return redirect()->route('login');
		}

		$RadiusOB = new Radius();
		$radius = new RadacctModel();
		$linfo = new LinuxInfo();
		$set   = new SetModel();


		$language = $set->getset('language');
		$radaccttable = $set->getset('radacct');

		
		// echo $language->value;exit;

		$temponoar = $linfo->uptime();
		$activeusers = $radius->where('acctstoptime', NULL)->countAllResults(); 

        $radcheck = new RadcheckModel();
        $radacct  = new RadacctModel();

		$this->db = \Config\Database::connect();

		$query = array();
		$query  = $this->db->query('SELECT sum(acctoutputoctets) as download, sum(acctinputoctets) as upload FROM radacct WHERE DATE_FORMAT(acctstoptime, "%Y-%m-%d") = CURDATE();');
		
		$query2  = $this->db->query('SELECT * FROM radacct WHERE DATE_FORMAT(acctstarttime, "%Y-%m-%d") = CURDATE();');

		$r =  0;// $this->db->count_all_results();

		$q = $query->Getrow();
							
		$totdownload 	= $this->toxbyte($q->download);
		$totupload 		= $this->toxbyte($q->upload);
		$logins			= $r;





		$totalclientes = $radcheck->countAll(); 

		if (! $this->session->isLoggedIn) {
			return redirect()->route('login');
		}

		$db = \Config\Database::connect();

		$query = array();
		$query  = $radacct->query("SELECT day(acctupdatetime) as time, sum(acctoutputoctets) as output, 
							sum(acctinputoctets) as input from radacct group by day(acctupdatetime), 
							month(acctupdatetime) order by month(acctupdatetime), day(acctupdatetime);");
		$plabels 	= '[';
		$grafico1	= '[';
		$grafico2 	= '[';
		$grafico3 	= '[';

		foreach ($query->getResult('array') as $row)
		{
			$plabels .= $row['time']; 
			$plabels .= ',';
		}
				
		$plabels = rtrim($plabels, ',');
		$plabels .= ']';
		$row = '';

		foreach ($query->getResult('array') as $row)
		{

			$grafico1 .= $row['output']/1000/1000/1000; 
			$grafico2 .= $row['input']/1000/1000/1000;
			$grafico3 .= $row['input']/1000/1000/1000 + $row['output']/1000/1000/1000;

			$grafico1 .= ',';
			$grafico2 .= ',';
			$grafico3 .= ',';

		}
				
		$grafico1 = rtrim($grafico1, ',');
		$grafico1 .= ']';
	
		$grafico2 = rtrim($grafico2, ',');
		$grafico2 .= ']';		

		$grafico3 = rtrim($grafico3, ',');
		$grafico3 .= ']';



		return view('auth/starter', [
			'userData' 		=> $this->session->userData,
			'activeusers' 	=> $activeusers,
			'totalusers' 	=> $totalclientes,
			'uptime'     	=> $temponoar,
			'labels'	 	=> $plabels,
			'grafico1'	 	=> $grafico1,
			'grafico2'	 	=> $grafico2,
			'grafico3'	 	=> $grafico3,
			'totalupload' 	=> $totupload,
			'totaldownload' => $totdownload,
			'logins' 	=> $logins



		]);
	}


	public function profile()
	{
		if (! $this->session->isLoggedIn) {
			return redirect()->route('login');
		}

		return view('auth/profile', [
			'userData' => $this->session->userData,
		]);
	}
	

	public function updateProfile()
	{
		$users = new UserModel();
		$getRule = $users->getRule('updateProfile');
		$users->setValidationRules($getRule);

		$user = [
			'id'  	=> $this->session->get('userData.id'),
			'name' 	=> $this->request->getPost('name'),
			'firstname' 	=> $this->request->getPost('firstname'),
			'lastname' 	=> $this->request->getPost('lastname'),
			'email' 	=> $this->request->getPost('email')
		];

		if (! $users->save($user)) {
			return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        $this->session->push('userData', $user);

        return redirect()->route('profile')->with('success', lang('Auth.updateSuccess'));
	}


	public function updateAccount()
	{
		// update user, validation happens in model
		$users = new UserModel();
		$getRule = $users->getRule('updateAccount');
		$users->setValidationRules($getRule);

		$user = [
			'id'  	=> $this->session->get('userData.id'),
			'name' 	=> $this->request->getPost('name')
		];

		if (! $users->save($user)) {
			return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // update session data
        $this->session->push('userData', $user);

        return redirect()->to('account')->with('success', lang('Auth.updateSuccess'));
	}

    //--------------------------------------------------------------------

	/**
	 * Handles password change.
	 */
	public function changePassword()
	{
		// validate request
		$rules = [
			'password' 	=> 'required|min_length[5]',
			'new_password' => 'required|min_length[5]',
			'new_password_confirm' => 'required|matches[new_password]'
		];

		if (! $this->validate($rules)) {
			return redirect()->route('profile')->withInput()
				->with('errors', $this->validator->getErrors());
		}

		// check current password
		$users = new UserModel();

		$user = $users->find($this->session->get('userData.id'));

		if (
			! $user ||
			! password_verify($this->request->getPost('password'), $user['password_hash'])
		) {
			return redirect()->route('profile')->withInput()->with('error', lang('Auth.wrongCredentials'));
		}

		// update user's password
		$updatedUser['id'] = $this->session->get('userData.id');

		$updatedUser['password'] = $this->request->getPost('new_password');

		$users->save($updatedUser);

		// redirect to account with success message
		return redirect()->to('profile')->with('success', lang('Auth.passwordUpdateSuccess'));
	}

    //--------------------------------------------------------------------

	/**
	 * Deletes user account.
	 */
	public function deleteAccount()
	{
		// check current password
		$users = new UserModel();
		
		$user = $users->find($this->session->get('userData.id'));

		if (
			! $user ||
			! password_verify($this->request->getPost('password'), $user['password_hash'])
		) {
			return redirect()->back()->withInput()->with('error', lang('Auth.wrongCredentials'));
		}

		// delete account from DB
		$users->delete($this->session->get('userData.id'));

		// log out user
		$this->session->remove(['isLoggedIn', 'userData']);

		// redirect to register with success message
		return redirect()->to('register')->with('success', lang('Auth.accountDeleted'));
	}



	public function toxbytedata($size)
	{
			// Gigabytes
			if ( $size > 1073741824 )
			{
					$ret = $size / 1073741824;
					$ret = round($ret,2);
					return $ret;
			}
	
			// Megabytes
			if ( $size > 1048576 )
			{
					$ret = $size / 1048576;
					$ret = round($ret,2);
					return $ret;
			}
	
			// Kilobytes
			if ($size > 1024 )
			{
					$ret = $size / 1024;
					$ret = round($ret,2);
					return $ret;
			}
	
			// Bytes
			if ( ($size != "") && ($size <= 1024 ) )
			{
					$ret = $size;
					return $ret;
			}
	
	}

	public function toxbyte($size)
	{
			// Gigabytes
			if ( $size > 1073741824 )
			{
					$ret = $size / 1073741824;
					$ret = round($ret,2)." Gb";
					return $ret;
			}
	
			// Megabytes
			if ( $size > 1048576 )
			{
					$ret = $size / 1048576;
					$ret = round($ret,2)." Mb";
					return $ret;
			}
	
			// Kilobytes
			if ($size > 1024 )
			{
					$ret = $size / 1024;
					$ret = round($ret,2)." Kb";
					return $ret;
			}
	
			// Bytes
			if ( ($size != "") && ($size <= 1024 ) )
			{
					$ret = $size." B";
					return $ret;
			}
	
	}























}
