<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/base/BaseController.php';

class errors extends BaseController {


	public function index()
	{
		$this->loadView('pagina404');
	}
}
