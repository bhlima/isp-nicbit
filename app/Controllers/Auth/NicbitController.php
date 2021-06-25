<?php
namespace App\Controllers\Auth;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
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
