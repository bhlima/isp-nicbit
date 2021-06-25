<?php
namespace App\Controllers\Auth;


use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use App\Models\UserModel;
use App\Models\InvoicesModel;


class InvoicesController extends Controller
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
        
	public function invoices()
	{


		if (! $this->session->isLoggedIn) {
			return redirect()->route('public/login');
		}


		$invoices = new InvoicesModel;
		$allinvoices = $invoices->getall();

	}


	public function updateInvoice()
	{
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



	public function deleteInvoice()
	{

	}



	}

	