<?php

namespace App\Controllers;

class Connexion extends BaseController
{

    private $parentsModel;

    public function __construct()
    {
        $this->parentsModel = model('App\Models\ParentsModel');
        $this->proModel = model('App\Models\ProModel');
    }

    public function index()
    {
        $data = [
            'parents' => $this->parentsModel->recupParents(),
            'pro' => $this->proModel->recupPro(),
        ];
        return view('connexion',$data);
    }
    public function loginVerif()
    {

        $parents = $this->parentsModel->recupParents();
        $pros = $this->proModel->recupPro();
        $check = 0;
        foreach($parents as $parent) {
            if ($parent['parent_email'] == $_POST['email'] AND password_verify($_POST['mdp'], $parent['parent_password'])) {
                $check = 1;
                $utilActuel = $parent;
                $status = 'parent';
            }
        }
        if ($check != 1)  {
            foreach($pros as $pro) {
                if ($pro['pro_email'] == $_POST['email'] AND password_verify($_POST['mdp'], $pro['pro_password'])) {
                    $check = 1;
                    $utilActuel = $pro;
                    $status = 'pro';
                }
            }
        }
        if ($check == 0) {
            echo 'ERREUR';
        } else {
            echo 'succes';
                if ($status = 'parent') {
                    var_dump($utilActuel);

                    $_SESSION['user']=array(
                        'status'=>'parent',
                        'id'    =>$utilActuel['id'],
                        'email' =>$utilActuel['parent_email'],
                        'ip'     =>$_SERVER['REMOTE_ADDR'],
                        'adresse' =>$utilActuel['parent_adresse'],
                        'telephone' =>$utilActuel['parent_tel'],
                        'photo' =>$utilActuel['parent_photo'],
                        'naissance' =>$utilActuel['parent_naissance'],
                        'nom' =>$utilActuel['parent_nom'],
                        'prenom' =>$utilActuel['parent_prenom'],
                    );
                } else {
                    $_SESSION['user']=array(
                        'status'=>'professionnel',
                        'id'    =>$utilActuel['id'],
                        'email' =>$utilActuel['pro_email'],
                        'ip'     =>$_SERVER['REMOTE_ADDR'],
                        'adresse' =>$utilActuel['pro_adresse'],
                        'telephone' =>$utilActuel['pro_telephone'],
                        'photo' =>$utilActuel['pro_photo'],
                        'naissance' =>$utilActuel['pro_naissance'],
                        'nom' =>$utilActuel['pro_nom'],
                        'prenom' =>$utilActuel['pro_prenom'],
                        'entreprise' =>$utilActuel['pro_entreprise'],
                        'categorie' =>$utilActuel['pro_categorie'],
                        'taux_horaire' =>$utilActuel['pro_taux_horaire'],
                        'description' =>$utilActuel['pro_description'],
                    );
                }
            return redirect()->to('/');

        }
        $data = [
            'parents' => $this->parentsModel->recupParents(),
            'pro' => $this->proModel->recupPro(),
        ];
        return view('connexion',$data);
    }
    public function deco()
    {
        echo view('connexion');
        session_destroy();
        return redirect()->to('/');
    }
}
