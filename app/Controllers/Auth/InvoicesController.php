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
		$allinvoices = $invoices->findall();
		$countInvoices = $invoices->countall();


		return view('auth/invoices', [
			'userData' => $this->session->userData,
			'data' => $allinvoices,
			'countinvoices' => $countInvoices

		]);

	}


	public function updateInvoice()
	{
		$invoices = new InvoicesModel();
		$getRule = $invoices->getRule('update');
		$invoices->setValidationRules($getRule);

		$invoice = [
			'user_id' 		=> $this->request->getPost('user_id'),
			'date' 			=> $this->request->getPost('date'),
			'duedate' 			=> $this->request->getPost('date'),
			'status_id' 	=> $this->request->getPost('status_id'),
			'tipo_id' 		=> $this->request->getPost('tipo_id'),
			'obs' 			=> $this->request->getPost('obs'),
			'created_at' 	=> $this->request->getPost('created_at'),
			'updated_at' 	=> $this->request->getPost('updated_at'),
			'created_by' 	=> $this->request->getPost('created_by'),
		];

		if (! $invoices->save($invoice)) {
			return redirect()->back()->withInput()->with('errors', $invoices->errors());
        }
        return redirect()->to('invoices')->with('success', lang('Auth.updateSuccess'));
	}


	public function deleteInvoice()
	{

	}



	}

