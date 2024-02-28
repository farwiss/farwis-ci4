<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class BasicAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $username = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : "";
        $password = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : "";

        $check = $this->check_user_login($username, $password);
        if($check === FALSE)
        {
            header("Content-type: application/json");

            echo json_encode(array(
                "status" => false,
                "message" => "invalid credentials"
            ));
            die();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
    }

    protected function check_user_login($username, $password){
        $db = \Config\Database::connect();
        $query = $db->table('users');
        $query->where('username', $username);
        $query->where('password', $password);
        $result = $query->get()->getRow();
        
        if(isset($result)){
            return $result;
        }
        return FALSE;
    }
}