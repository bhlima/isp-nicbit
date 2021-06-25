<?php
namespace App\Controllers\Auth;


use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use App\Models\UserModel;
use App\Models\RadacctModel;
use App\Models\RadcheckModel;
USE LinuxInfo;
use RouterosAPI;
use Radius;




class AccountController extends Controller
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
	 * Displays account settings.
	 */
        
	public function dashboard()
	{

		
		$RadiusOB = new Radius();
		$radius = new RadacctModel();
		$linfo = new LinuxInfo();


		//Recupera o tempo que o servidor esta no ar
		$temponoar = $linfo->uptime();

		// get all user logs
		$activeusers = $radius->where('acctstoptime', NULL)->countAllResults(); 

        $radcheck = new RadcheckModel();
        $radacct  = new RadacctModel();

		


		$totalclientes = $radcheck->countAll(); 

		if (! $this->session->isLoggedIn) {
			return redirect()->route('public/login');
		}



		//$builder = $radcheck->table('radacct');

		$db = \Config\Database::connect();


		$query = array();
		$query  = $radcheck->query('select day(acctupdatetime) as time, sum(acctoutputoctets) as output, 
							sum(acctinputoctets) as input from radacct group by day(acctupdatetime), 
							month(acctupdatetime) order by month(acctupdatetime), day(acctupdatetime);');
		$plabels 	= '[';
		$grafico1	= '[';
		$grafico2 	= '[';

		foreach ($query->getResult('array') as $row)
		{
			$plabels .= $row['time']; 
			$plabels .= ',';
		}
				
		//Monta a o array padrao gráfico
		$plabels = rtrim($plabels, ',');
		$plabels .= ']';
		$row = '';






		foreach ($query->getResult('array') as $row)
		{
			$grafico1 .= $row['output']; 
			$grafico1 .= ',';
		}
				
		//Monta a o array padrao gráfico
		$grafico1 = rtrim($grafico1, ',');
		$grafico1 .= ']';
		$row = '';





		return view('auth/starter', [
			'userData' => $this->session->userData,
			'activeusers' => $activeusers,
			'totalusers' => $totalclientes,
			'uptime'     => $temponoar,
			'labels'	 => $plabels,
			'grafico1'	 => $grafico1,

		]);
	}

	//--------------------------------------------------------------------

	/**
	 * Displays profile page.
	 */
	public function profile()
	{
		if (! $this->session->isLoggedIn) {
			return redirect()->route('login');
		}

		return view('auth/profile', [
			'userData' => $this->session->userData,
		]);
	}
	
	//--------------------------------------------------------------------

	/**
	 * Updates regular account settings.
	 */
	public function updateProfile()
	{
		// update user, validation happens in model
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

        // update session data
        $this->session->push('userData', $user);

        return redirect()->to('profile')->with('success', lang('Auth.updateSuccess'));
	}

    //--------------------------------------------------------------------

	/**
	 * Updates regular account settings.
	 */
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
			return redirect()->to('profile')->withInput()
				->with('errors', $this->validator->getErrors());
		}

		// check current password
		$users = new UserModel();

		$user = $users->find($this->session->get('userData.id'));

		if (
			! $user ||
			! password_verify($this->request->getPost('password'), $user['password_hash'])
		) {
			return redirect()->to('profile')->withInput()->with('error', lang('Auth.wrongCredentials'));
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
