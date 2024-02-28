<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ApiAja extends ResourceController
{
	use ResponseTrait;

	public function index()
	{
		$data = array('npm' => '202210079', 'nama' => 'Farwis');

		return $this->respond($data);
	}
}