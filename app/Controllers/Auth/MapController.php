<?php
namespace App\Controllers\Auth;


use CodeIgniter\Controller;
use Config\Services;
use App\Models\MapModel;



class  MapController extends Controller
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
        
	public function map()
	{

		if (! $this->session->isLoggedIn) {
			return redirect()->route('public/login');
		}

        $maps			 = new MapModel();
		$totalmapeamento = $maps->countAll(); 
		$allmaps         = $maps->findAll(); 


		return view('auth/maps', [
			'userData'          => $this->session->userData,
			'totalmapeamento'   => $totalmapeamento,
			'data'              => $allmaps,
		]);
    }

}

























