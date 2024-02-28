<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        $content = view('login/form');
        $this->show_layout($content);
    }
}
