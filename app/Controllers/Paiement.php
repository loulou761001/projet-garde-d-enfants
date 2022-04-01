<?php

namespace App\Controllers;

class Paiement extends BaseController
{

    private $parentsModel;

    public function __construct()
    {
        $this->parentsModel = model('App\Models\ParentsModel');
    }

    public function index()
    {

        return view('Paiement/Paiement',['prix'=>850]);
    }
}
