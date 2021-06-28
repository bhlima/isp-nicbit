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
use App\Models\ClientsModel;
use App\Models\CliinfoModel;
use App\Models\EstadosModel;
use App\Models\MunicipiosModel;
use App\Models\RadacctModel;



class ClientsController extends Controller
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
	 * Displays clients page.
	 */
	public function clients()
	{
		// check if user is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->route('login');
		}

		// current year and month variable 
		$ym = date("Y-m");

		// load user models
		$info 	 = new CliinfoModel();
		$clients = new ClientsModel();
		
		// Load all clients and all info joined
		
		$allclients = $info->findAll(); 

		$countClientsIncompletos = $info->where('telefone1','00 00000 0000')->countAll();

		//echo '<pre>';
		//print_r($allclients);exit;

		// count all rows in users table
		$countclients = $clients->countAll(); 

		// load the view with session data
		return view('auth/clients', [
				'userData' => $this->session->userData, 
				'data' => $allclients, 
				'clientscount' => $countclients, 
				'countClientsIncompletos' => $countClientsIncompletos, 
			]);
	}


	public function edit()
	{

		// check if user is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->route('login');
		}

		// get the user id
		$username = $this->request->uri->getSegment(3);

		// load user model
        $userinfos = new CliinfoModel();

		// get user data using the id
		$userinfo = $userinfos->where('username', $username)->first(); 


		// get States from address info
		$options = $this->getEstados();
		
		$optionsC = $this->getMunicipios('SP');


		echo '<pre>';
		print_r($optionsC); exit;

		// load the view with session data
		return view('auth/edits/edit-clients', [
				'userData' => $this->session->userData, 
				'data' => $userinfo,
				'options' => $options
			]);
	}

	public function update()
	{
		$rules = [
			'username'	=> 'required',
			'value'	    => 'required'
		];

		if (! $this->validate($rules)) {
			return redirect()->route('clients')->withInput()->with('errors', $this->validator->getErrors());
		}

		$clients = new ClientsModel();

		$client = [
            'id'      	    => $this->request->getPost('id'),
			'username'  	=> $this->request->getPost('username'),
			'attribute' 	=> $this->request->getPost('attribute'),
			'op' 	        => $this->request->getPost('op'),
			'value'      	=> $this->request->getPost('value'),
		];



		
		if (! $clients->save($client)) {
		
			return redirect('clients')->route('clients')->withInput()->with('errors', $clients->errors());
        }

        return redirect()->route('clients')->with('success', lang('Auth.updateSuccess'));
	}


	public function updateinfo()
	{
		$rules = [
			'id'	=> 'required',
		];

		if (! $this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

        $userinfos = new CliinfoModel();

		$username = $this->request->getPost('username');

		$userinfo = [
            'id'      	    				=> $this->request->getPost('id'),
			'usename'  	    				=> $this->request->getPost('username'),
			'changeuserinfo' 				=> $this->request->getPost('changeuserinfo'),
			'cidade'        				=> $this->request->getPost('cidade'),
			'estado'      					=> $this->request->getPost('estado'),
            'endereco'      	    		=> $this->request->getPost('endereco'),
			'bairro'  	    				=> $this->request->getPost('bairro'),
			'referencia' 					=> $this->request->getPost('referencia'),
			'email'        					=> $this->request->getPost('email'),
			'enableportallogin'      		=> $this->request->getPost('enableportallogin'),
			'nome'     	    				=> $this->request->getPost('nome'),
			'cpf'   	    				=> $this->request->getPost('cpf'),
			'cnpj'			 				=> $this->request->getPost('cnpj'),
			'empresa'        				=> $this->request->getPost('empresa'),
			'portalpassword'				=> $this->request->getPost('portalpassword'),
            'telefone1'      	    		=> $this->request->getPost('telefone1'),
			'telefone2'  	    			=> $this->request->getPost('telefone2'),
			'notes' 						=> $this->request->getPost('notes'),
			'cep'        					=> $this->request->getPost('cep'),
			'localidadeatt' 		     	=> $this->request->getPost('localidadeatt'),
			'aniversario'	 		     	=> $this->request->getPost('aniversario'),

		];


		if (! $userinfos->save($userinfo)) {
			return redirect()->route('/index.php/clients/edit/' . $username)->withInput()->with('errors', $userinfos->errors());
        }

        return redirect()->route('clients')->with('success', lang('Auth.updateSuccess'));
	}



	public function delete()
	{
		// get the user id
		$id = $this->request->uri->getSegment(3);

		// load user model
		$clients = new ClientsModel();

		// delete user using the id
		$clients->delete($id);

        return redirect()->route('clients')->with('success', lang('Auth.accountDeleted'));
	}




	public function create()
	{

		if (! $this->session->isLoggedIn) {
			return redirect()->route('login');
		}

		// save new user, validation happens in the model
		$clients = new ClientsModel();

        $userinfos = new CliinfoModel();

		$getRule = $clients->getRule('cadastro');
		$clients->setValidationRules($getRule);

		$getRule = $userinfos->getRule('saveindexkey');
		$userinfos->setValidationRules($getRule);
		

        $client = [
            'username'          	=> $this->request->getPost('username'),
            'attribute'          	=> $this->request->getPost('attribute'),
            'op'          	        => $this->request->getPost('op'),
            'value'         	    => $this->request->getPost('value')			
        ];

		$userinfo = [
            'username'  	=> $this->request->getPost('username'),
            'nome'			=> $this->request->getPost('username'),
            'telefone1'  	=> '(00) 00000 0000',
        ];

//print_r($userinfo);
//print_r($client);
//exit;

//echo '<pre>';
//print_r($clients);
//print_r($userinfos);exit;

//$clients->save($client);
//$userinfos->save($userinfo);

if (! $userinfos->save($userinfo ) )  {
	return redirect()->route('clients')->with('error', 'Voce errou seu asno!');
}

if (! $clients->save($client ) )  {
	return redirect()->route('clients')->with('error', 'Voce errou seu asno!');
}
	return redirect()->route('clients')->with('success', 'ok! Tudo certo mano!');
	}


	function time2str($time) {

		$str = "";				// initialize variable
		$time = floor($time);
		if (!$time)
			return "0 seconds";
		$d = $time/86400;
		$d = floor($d);
		if ($d){
			$str .= "$d days, ";
			$time = $time % 86400;
		}
		$h = $time/3600;
		$h = floor($h);
		if ($h){
			$str .= "$h hours, ";
			$time = $time % 3600;
		}
		$m = $time/60;
		$m = floor($m);
		if ($m){
			$str .= "$m minutes, ";
			$time = $time % 60;
		}
		if ($time)
			$str .= "$time seconds, ";
		$str = preg_replace("/, $/",'',$str);
		return $str;
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

	public function handleajaxrequest()
	{
	
		$data = $this->request->uri->getSegment(3);


		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Max-Age: 604800');
		header("Content-type: application/json");

			echo json_encode(array(
				'status' => 1,
				'message' => 'Successful request nicbit',
				'data'	=> $data
			));



	}


	public function ajaxRequest()
	{

		return view('ajax-request2');
	}




	public function getEstados() {

		$estados = new EstadosModel();
		$options = $estados->findAll();

		return $options;

	}

	public function getMunicipios($uf) {

			$municipios  = new MunicipiosModel();
			$m = $municipios->where('Uf', $uf);
			$options ="<option value = '' > Escolha a cidade </options>";
	
			//echo "<pre>";
			//print_r($m);exit;

			foreach ($m as $cidade)      
			{
				$options .= "<option value='" . $cidade['Nome'] . "'>" . $cidade->nome. "</option>" . PHP_EOL;
			}
			return $options;
	
	}


	public function clientperfil() {
		
		$username = $this->request->uri->getSegment(3);
		$perfis = new CliinfoModel();
		$clientperfil= $perfis->where('username', $username)->first(); 
		$radacct  = new RadacctModel();


		$query  = $radacct->query("select sum(AcctOutputOctets) as Uploads, sum(AcctInputOctets) as Downloads, day(AcctStartTime) as day 
									from radacct where username ='". $username . "' 
									and acctstoptime>0 
									and AcctStartTime>DATE_SUB(curdate(),INTERVAL (DAY(curdate())-1) DAY) 
									and AcctStartTime<now() group by day;");
		
		
		$plabels 	= '[';
		$grafico1	= '[';
		$grafico2 	= '[';

		foreach ($query->getResult('array') as $row)
		{
			$plabels .= $row['day']; 
			$plabels .= ',';
		}

		//Monta a o array padrao gráfico
		$plabels = rtrim($plabels, ',');
		$plabels .= ']';
		$row = '';

		//echo $plabels;

		foreach ($query->getResult('array') as $row)
		{

			$grafico1 .= $row['Downloads']/1000/1000; 
			$grafico2 .= $row['Uploads']/1000/1000;

			$grafico1 .= ',';
			$grafico2 .= ',';

		}

		//Monta a o array padrao gráfico
		$grafico1 = rtrim($grafico1, ',');
		$grafico1 .= ']';
	
		$grafico2 = rtrim($grafico2, ',');
		$grafico2 .= ']';		

                                                                                                                                                                                                                                                                                  		//echo $grafico1;
		//echo $grafico2;exit;

		return view('auth/perfilcliente', [
			'userData' => $this->session->userData, 
			'data' => $clientperfil,
			'grafico1' => $grafico1,
			'grafico2' => $grafico2,
			'labels' 	=> $plabels
		]);
	}
}
