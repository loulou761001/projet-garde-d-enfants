<?php

namespace App\Controllers;

class Conditions extends BaseController
{

    private $parentsModel;

    public function __construct()
    {
        $this->parentsModel = model('App\Models\ParentsModel');
    }

    public function index()
    {
        return view('conditions');
    }
}
