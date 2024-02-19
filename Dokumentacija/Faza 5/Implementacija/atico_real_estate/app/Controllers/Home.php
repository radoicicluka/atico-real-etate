<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view ('sablon/header_gost');
        $data['oglasi'] = [];
        echo view('stranice/index', $data);
    }
}
