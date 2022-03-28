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


        if ($_SESSION['user']['status']=='parent'){
            $enfants= $this->enfantsModel->recupEnfantsDeParent($_SESSION['user']['id']);
            $parent = $this->parentsModel->recupUnParents($_SESSION['user']['id']);
            echo view('Profil/Profil', ["parent" => $parent,"enfants"=>$enfants]);
        }elseif($_SESSION['user']['status']=='professionnel'){
            $pro =$this->proModel->recupUnPro($_SESSION['user']['id']);
            echo view('Profil/Profil', ["pro" => $pro]);
        }

    }

    public function ajoutEnfant()
    {
        echo view('Profil/AjoutEnfant');
    }

    public function supprEnfant($id)
    {
        $check=$this->enfantsModel->recupUnEnfant($id);
        debug($check);
        if($_SESSION['user']['id']==$check[0]['enfant_parent']){
            $this->enfantsModel->suppUnEnfant($id);
        }else{
            return redirect()->to('/profil');
        }
        return redirect()->to('/profil');


    }
}
