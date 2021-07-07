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
use App\Models\SubareasModel;

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
        if (!$this->session->isLoggedIn) {
            return redirect()->route('public/login');
        }

        return view('auth/areas', [
            'userData' => $this->session->userData,
            'data' => $this->getgroupareas(),
        ]);
    }


    public function create()
    {
        if (!$this->session->isLoggedIn) {
            return redirect()->route('login');
        }

        //Inicializa models
        $areas = new AreasModel();

        //Captura dados
        $getRule = $areas->getRule('cadastro');
        $areas->setValidationRules($getRule);

        $area = [
            'groupareas' => $this->request->getPost('groupareas'),
            'subgroup' => $this->request->getPost('subgroup'),

        ];

        if (!$areas->save($area)) {
            return redirect()->route('areas')->with('error', 'Algo esta errado!');
        }

        return redirect()->route('areas')->with('success', 'ok! Tudo certo mano!');
    }

    /**
     * @
     */
    public function precreatesub()
    {
        if (!$this->session->isLoggedIn) {
            return redirect()->route('login');
        }

        $id_grouparea = $this->request->uri->getSegment(3);

        //echo $id_grouparea;exit;

        return view('auth/add-subgrouparea', [
            'userData'      => $this->session->userData,
            'id_grouparea'  => $id_grouparea

        ]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */

     public function createsub()
    {
        if (!$this->session->isLoggedIn) {
            return redirect()->route('login');
        }

        $subareas = new SubareasModel();

        //Captura dados
        $getRule = $subareas->getRule('cadastro');
        $subareas->setValidationRules($getRule);

        $subarea = [
            'id_grouparea' => $this->request->getPost('id_grouparea'),
            'subgroup_name' => $this->request->getPost('subgroup_name'),
        ];


        if (!$subareas->save($subarea)) {
            return redirect()->route('areas')->with('error', 'Algo esta errado!');
        }

        return redirect()->route('areas')->with('success', 'ok! Tudo certo mano!');
    }


    /**
     * Get Group Areas 
     * Organize locals
     * 
     *      
     * @return array
     */
    public function getgroupareas()
    {

        $areas  = new AreasModel();
        $groups = $areas->query('select * from areas');
        $row = $groups->getResult();
        $options = "<option value = '' > Escolha o Grupo </options>";

        foreach ($row as $group) {
            $options .= "<option value='" . $group->id . "'>" . $group->groupareas . "</option>" . PHP_EOL;
        }
        return $options;
    }

    /**
     * Get Sub Group Areas
     *
     * @return void
     */
    public function subgrouparea()
    {
        $id_grouparea = $this->request->getPost('groupareas');

        $subareas  = new SubareasModel();
        $data = $subareas->where('id_grouparea', $id_grouparea)
            ->findall();

        return view('auth/areassubgroups', [
            'userData' => $this->session->userData,
            'data' => $data,
            'grouparea' => $id_grouparea
        ]);
    }
}
