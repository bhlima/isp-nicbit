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


		if (!$this->session->isLoggedIn) {
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

		if (!$invoices->save($invoice)) {
			return redirect()->back()->withInput()->with('errors', $invoices->errors());
		}
		return redirect()->to('invoices')->with('success', lang('Auth.updateSuccess'));
	}


	public function deleteInvoice()
	{
	}
}
