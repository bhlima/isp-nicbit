<?php 
namespace App\Models;

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

use CodeIgniter\Model;

class PlansModel extends Model
{
	protected $table      = 'planos';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'nome', 'id_plano', 'plano_timebank', 'plano_prepago', 'plano_banda_up', 
		'plano_banda_dw', 'plano_recorrente', 'recorrente_periodo', 'agenda_recorrente',
		'valor', 'setup', 'imposto', 'grupo_plano'
    	];

	protected $useTimestamps = false;

	protected $validationRules = [];

	protected $dynamicRules = [
		'cadastro' => [
			'nome'		 		=> 'required',
			'id_plano'			=> 'required',
			'grupo_plano'		=> 'required',
			'valor' 			=> 'required',
		],
		'update' => [
			'nome'		 		=> 'required',
			'id_plano'			=> 'required',
			'grupo_plano'		=> 'required',
			'valor' 			=> 'required',
		],
	];

	protected $validationMessages = [];

	protected $skipValidation = false;

	public function getRule(string $rule)
	{
		return $this->dynamicRules[$rule];
	}



}
