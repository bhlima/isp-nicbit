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
USE LinuxInfo;


class NicbitController extends Controller
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


	/**
	 * Constructor.
	 */
	public function __construct()
	{
		// start session
		$this->session = Services::session();
	}




	public function about()
	{
		// check if user is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

	
		// load the view with session data
		return view('auth/nicbit', [
				'userData' => $this->session->userData
			]);
	}




	public function key()
	{
		// check if user is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

	
		// load the view with session data
		return view('auth/nicbitkey', [
				'userData' => $this->session->userData
			]);
	}

	public function atualiza()
	{
		// check if user is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}


		//Obtem dados atuais do servidor
		$linuxi 		= 	new LinuxInfo();
		$uptime 		= 	$linuxi->uptime();
		$systemload 	= 	$linuxi->get_system_load();
		$hostname 		=	$linuxi->get_hostname();
		$datetime 		=	$linuxi->get_datetime();
		$memory 		= 	$linuxi->get_memory();
		$memtotal	    =   $linuxi->convert_ToMB ($memory['MemTotal']);
		$memfree	    =   $linuxi->convert_ToMB ($memory['MemFree']);

		$memused 		= 	$memory['MemTotal'] - $memory['MemFree'];
		$memused 		= 	$linuxi->convert_ToMB ($memused);
		$hddfree		=  	$linuxi->get_hdd_freespace();
		$hddfreemb		=	$linuxi->convert_ToMB ($hddfree);
		$iflist 		= 	$linuxi->get_interface_list();

	
		// load the view with session data
		return view('auth/nicbitatualiza', [
				'userData' 		=> $this->session->userData,
				'uptime'   		=> $uptime,
				'systemload'	=> $systemload,
				'hostname'		=> $hostname,
				'datetime'		=> $datetime,
				'memory'		=> $memory,
				'memtotal'		=> $memtotal,
				'memfree'		=> $memfree,
				'memused'		=> $memused,
				'hddfreemb'		=> $hddfreemb,
			]);
	}


	public function git()
	{
		// check if user is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

	
		// load the view with session data
		return view('auth/nicbitgit', [
				'userData' => $this->session->userData
			]);
	}


	public function licenca()
	{
		// check if user is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

	
		// load the view with session data
		return view('auth/nicbitlicenca', [
				'userData' => $this->session->userData
			]);
	}

}
