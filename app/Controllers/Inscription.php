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
        $data = [
            'parents' => $this->parentsModel->recupParents()
        ];
        return view('Inscription/InscriptionUtilisateur',$data);
    }

    public function indexNourrice()
    {
        return view('Inscription/InscriptionNourrice');
    }
    public function uploadEmailParent()
    {
        $data = [
            'parents' => $this->parentsModel->recupParents()
        ];
        $currentMail = $_POST['email'];
        $indispo = 0;
        foreach ($data['parents'] as $parent) {
            if ($parent['parent_email'] == $currentMail) {
                $indispo = 1;
            }
        }
        echo $indispo;
    }

    public function handlePost()
    {

        var_dump($_POST);

        $data = [
            'parent_nom' => $_POST['nom'],
            'parent_prenom' => $_POST['prenom'],
            'parent_email' => $_POST['email'],
            'parent_password' => password_hash($_POST['password'], PASSWORD_DEFAULT ),
            'parent_tel' => $_POST['phone'],
            'parent_naissance' => $_POST['naissance'],
            'parent_numAdresse' => $_POST['numAdresse'],
            'parent_adresse' => $_POST['adresse'],
            'parent_infosAdresse' => $_POST['infosAdresse'],
            'parent_postal' => $_POST['codePostal'],
            'parent_ville' => $_POST['ville'],
        ];
        $this->parentsModel->inserParent($data);

        return redirect()->to('/');
    }

    public function handlePostNourrice()
    {
        var_dump($_POST);
    }

    public function photo($id){
        if ($_SESSION['user']['status'] == 'parent') {
            $parent = $this->parentsModel->recupUnParents($id);
            echo view('photoParent', [
                "parent" => $parent,
            ]);
        } elseif (($_SESSION['user']['status'] == 'professionnel'))  {

        }

    }
}
