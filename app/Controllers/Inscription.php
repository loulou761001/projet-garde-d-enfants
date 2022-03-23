<?php

namespace App\Controllers;

class Inscription extends BaseController
{

    private $parentsModel;

    public function __construct()
    {
        $this->parentsModel = model('App\Models\ParentsModel');
    }
    public function redirect()
    {
        return view('Inscription/InscriptionChoix');
    }

    public function index()
    {
        return view('Inscription/InscriptionUtilisateur');
    }

    public function indexNourrice()
    {
        return view('Inscription/InscriptionNourrice');
    }

    public function handlePost()
    {

        var_dump($_POST);

    }

    public function handlePostNourrice()
    {

        var_dump($_POST);

    }
}
