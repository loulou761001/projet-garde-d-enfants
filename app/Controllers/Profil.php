<?php

namespace App\Controllers;

class Profil extends BaseController
{

    private $parentsModel;
    private $enfantsModel;
    private $proModel;

    public function __construct()
    {
        $this->parentsModel = model('App\Models\ParentsModel');
        $this->proModel = model('App\Models\ProModel');
        $this->enfantsModel = model('App\Models\EnfantsModel');
    }

    public function index()
    {
        $enfants= $this->enfantsModel->recupEnfantsDeParent($_SESSION['user']['id']);
        $parent = $this->parentsModel->recupUnParents($_SESSION['user']['id']);
        echo view('Profil/Profil', ["parent" => $parent,"enfants"=>$enfants]);
    }

}
