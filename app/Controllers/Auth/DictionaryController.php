<?php
namespace App\Controllers\Auth;


use CodeIgniter\Controller;
use Config\Services;
use App\Models\DictionaryModel;

class DictionaryController extends Controller
{

	protected $session;
	protected $config;

    //--------------------------------------------------------------------

	public function __construct()
	{
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-type, Content-lengh, Accept-Encoding");

		$this->session = Services::session();

	}

        
	public function Dictionary()
	{

		if (! $this->session->isLoggedIn) {
			return redirect()->route('public/login');
		}

		return view('auth/predic', [
			'userData' => $this->session->userData,
			'data' => $this->getvendoroptions(),
		]);
	}


    public function getvendoroptions()
    {

        $dics           = new DictionaryModel();
        $vendors = $dics->query('select distinct vendor from dictionary');
        $row = $vendors->getResult();
        $options ="<option value = '' > Escolha o fonecedor </options>";

        foreach ($row as $fornecedor)      
        {
            $options .= "<option value='" . $fornecedor->vendor . "'>" . $fornecedor->vendor . "</option>" . PHP_EOL;
        }
        return $options;

    }



    public function attributes()
    {
        $vendor1 = $this->request->getPost('vendor1');
        $dics  = new DictionaryModel();
        $data = $dics->where('vendor', $vendor1)
                     ->findall();

       // dd(print_r($data));exit;

                     return view('auth/attributes', [
                        'userData' => $this->session->userData,
                        'data' => $data,
                        'vendor' => $vendor1
                    ]);
            


    }





    public function getattributes() {
        $vendor = $this->request->getvar();
        $dics  = new DictionaryModel();
        $data = $dics->where('vendor', $vendor)
                     ->findall();
        
        echo json_encode(array(
                "status" => 1,
                "message" => "Successful request",
                "data" => $data
        ));      
    }






}