<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class Users extends ResourceController
{
	use ResponseTrait;

	public function get_user_list()
	{
		$db = \Config\Database::connect();
        $query = $db->table('user u');
        $query->select('u.id, u.username');

        $result = $query->get()->getResult();

        return $this->respond($result);
		
	}

	public function get_user($id)
	{

		$db = \Config\Database::connect();
		$query = $db->table('user u');
		$query->select('u.id, u.username');
		$query->where('u.id', $id);

		$result = $query->get()->getRow();

		return $this->respond($result);
	}

	public function add()
	{
		$request = \Config\Services::request();
        $session = \Config\Services::session();
     	$_SESSION['id'] = 1;
        $data_save = [
            'username' => $request->getGet('username'),
            'password' => md5($request->getGet('password')),
            'created_date' => date('m/d/Y'),
            'created_at' => $session->id,
        ];
        
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        if ($builder->insert($data_save)) {
            return $this->respond([
                'status' => true,
                'message' => 'User baru berhasil ditambahkan' 
            ]);
        } else {
            return $this->respond('gagal dibuat');
        }
	}

	public function update($id=null)
	{
		$request = \Config\Services::request();
        $session = \Config\Services::session();
        $_SESSION['id'] = 1;
        $data_save = [
            'username' => $request->getGet('username'),
            'password' => md5($request->getGet('password')),
            'updated_date' => date('m/d/Y'),
            'updated_at' => $session->id,
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->where('id', $id);
        if ($builder->update($data_save)) {
            return $this->respond([
                'status' => true,
                'message' => 'Data User berhasil diupdate' 
            ]);
        } else {
            return $this->respond('gagal diupdate');
        }
	}

	public function remove($id=null)
	{
		$db = \Config\Database::connect();
        $builder = $db->table('user');
        
        if ($builder->delete(['id' => $id])) {
            return $this->respond([
                'status' => true,
                'message' => 'Data User berhasil dihapus' 
            ]);
        } else {
            return $this->respond('gagal dihapus');
        }
	}
}