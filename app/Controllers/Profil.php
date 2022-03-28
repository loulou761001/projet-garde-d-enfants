<?php

namespace App\Controllers;

use CodeIgniter\HTTP\IncomingRequest;

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

    public function ajoutEnfant()
    {
        $data = $this->generateActualiteFromPost($this->request, "creation");
        $input=$this->validate([
            'nom'=> 'required|min_length[2]',
            'prenom'=> 'required|min_length[2]',
            'naissance'=> 'required',
            'carnet'=> 'required',
            'infos'=> 'required',
        ]);

        if(!$input){
            $erreurs = $this->validator->getErrors();
            $enfants= $this->enfantsModel->recupEnfantsDeParent($_SESSION['user']['id']);
            $parent = $this->parentsModel->recupUnParents($_SESSION['user']['id']);
            echo view('Profil/Profil', ["parent" => $parent,"enfants"=>$enfants,'erreurs'=>$erreurs,'form'=>$data]);


        }else{

            $this->enfantsModel->insert($data);
            return redirect()->to('/profil');
        }

    }

    private function generateActualiteFromPost(IncomingRequest $request, string $type): array
    {
        $data = [
            'enfant_nom' => $request->getPost("nom"),
            'enfant_prenom' => $request->getPost("prenom"),
            'enfant_sexe' => $request->getPost("sexe"),
            'enfant_parent' => $_SESSION['user']['id'],
            'enfant_carnet'=>$request->getPost("carnet"),
            'enfant_naissance' => $request->getPost("naissance"),
            'enfants_infos' => $request->getPost("infos"),
        ];

        return $data;
    }



}
