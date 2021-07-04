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
use App\Models\AreasModel;

class AreasController extends Controller
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

        
	public function areas()
	{

		if (! $this->session->isLoggedIn) {
			return redirect()->route('public/login');
		}

		return view('auth/areas', [
			'userData' => $this->session->userData,
			'data' => $this->getgroupareas(),
		]);
	}


    public function getgroupareas()
    {

        $areas  = new AreasModel();
        $groups = $areas->query('select distinct groupareas from areas');
        $row = $groups->getResult();
        $options ="<option value = '' > Escolha o Grupo </options>";

        foreach ($row as $group)      
        {
            $options .= "<option value='" . $group->vendor . "'>" . $group->vendor . "</option>" . PHP_EOL;
        }
        return $options;

    }



    public function getareas()
    {
        $group = $this->request->getPost('groupareas');
        $dics  = new AreasModel();
        $data = $dics->where('group', $group)
                     ->findall();

                     return view('auth/areassubgroups', [
                        'userData' => $this->session->userData,
                        'data' => $data,
                        'group' => $group
                    ]);
            


    }

}