<?php

namespace App\Controllers;

class Inscription extends BaseController
{

    private $parentsModel;

    public function __construct()
    {
        $this->parentsModel = model('App\Models\ParentsModel');
    }

    public function index()
    {
        $data = [
            'parents' => $this->parentsModel->recupParents()
        ];
        return view('home',$data);
    }
}
