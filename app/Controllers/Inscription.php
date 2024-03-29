<?php

namespace App\Controllers;

class Inscription extends BaseController
{

    private $parentsModel;
    private $prosModel;

    public function __construct()
    {
        $this->parentsModel = model('App\Models\ParentsModel');
        $this->prosModel = model('App\Models\ProModel');
    }
    public function redirect()
    {
        return view('Inscription/InscriptionChoix');
    }

    public function index()
    {
        if(isLogged()){
            return redirect()->to('');
        }
        $data = [
            'parents' => $this->parentsModel->recupParents()
        ];
        return view('Inscription/InscriptionUtilisateur',$data);
    }

    public function indexNourrice()
    {
        return view('Inscription/InscriptionNourrice');
    }
    public function uploadEmail()
    {
        $data = [
            'parents' => $this->parentsModel->recupParents(),
            'pros' => $this->prosModel->recupPro()
        ];
        $currentMail = $_POST['email'];
        $indispo = 0;
        foreach ($data['parents'] as $parent) {
            if ($parent['parent_email'] == $currentMail) {
                $indispo = 1;
            }
        }
        if ($indispo != 1) {
            foreach ($data['pros'] as $pro) {
                if ($pro['pro_email'] == $currentMail) {
                    $indispo = 1;
                }
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
        return redirect()->to('/connexion');
    }

    public function handlePostNourrice()
    {

        if ($_POST['categorie'] == "Nourrice") {
            helper(['form', 'url']);
            $File = $this->request->getFile('identite');

            $File->move(PUBLIC_PATH . '/uploads/identite');
            $dataFile = [
                'pro_identite' => $File->getName()
            ];
            var_dump($dataFile);
        }
        debug($_POST);

        if ($_POST['categorie'] == "nourrice") {
            $data = [
                'pro_nom' => $_POST['nom'],
                'pro_prenom' => $_POST['prenom'],
                'pro_email' => $_POST['email'],
                'pro_password' => password_hash($_POST['password'], PASSWORD_DEFAULT ),
                'pro_telephone' => $_POST['phone'],
                'pro_naissance' => $_POST['naissance'],
                'pro_numAdresse' => $_POST['numAdresse'],
                'pro_adresse' => $_POST['adresse'],
                'pro_infosAdresse' => $_POST['infosAdresse'],
                'pro_postal' => $_POST['codePostal'],
                'pro_ville' => $_POST['ville'],
                'pro_categorie' => $_POST['categorie'],
                'pro_description' => $_POST['description'],
                'pro_taux_horaire' => $_POST['tauxHorraire'],
                'pro_entreprise' => $_POST['entreprise'],
                'pro_siret' => $_POST['siret'],
                'pro_identite' => $File->getName(),
            ];
        } else {
            $data = [
                'pro_nom' => $_POST['nom'],
                'pro_prenom' => $_POST['prenom'],
                'pro_email' => $_POST['email'],
                'pro_password' => password_hash($_POST['password'], PASSWORD_DEFAULT ),
                'pro_telephone' => $_POST['phone'],
                'pro_naissance' => $_POST['naissance'],
                'pro_numAdresse' => $_POST['numAdresse'],
                'pro_adresse' => $_POST['adresse'],
                'pro_infosAdresse' => $_POST['infosAdresse'],
                'pro_postal' => $_POST['codePostal'],
                'pro_ville' => $_POST['ville'],
                'pro_categorie' => $_POST['categorie'],
                'pro_description' => $_POST['description'],
                'pro_taux_horaire' => $_POST['tauxHorraire'],
                'pro_entreprise' => $_POST['entreprise'],
                'pro_siret' => $_POST['siret'],
            ];
        }

        debug($_POST);
//        $this->prosModel->inserPro($data);

//        return redirect()->to('/connexion');
    }

    public function photo($id){
        if ($id != $_SESSION['user']['id']) {
            return redirect()->to('/profil');
        }
        if ($_SESSION['user']['status'] == 'parent') {
            $parent = $this->parentsModel->recupUnParents($id);
            echo view('photoParent', [
                "parent" => $parent,
            ]);
        } elseif (($_SESSION['user']['status'] == 'professionnel'))  {
            $pro = $this->prosModel->recupUnPro($id);
            echo view('photoPro', [
                "pro" => $pro,
            ]);
        }
    }

    public function handlePhoto($id)
    {
        helper(['form', 'url']);
        $file = $this->validate([
            'file' => [
                'uploaded[file]',
                'max_size[file,4096]',
            ]
        ]);
        if (!$file) {
            print_r('Wrong file type selected');
        } else {
            $imageFile = $this->request->getFile('file');
            $imageFile->move(PUBLIC_PATH . '/uploads/imgs');
            if ($_SESSION['user']["status"] == 'parent') {
                $dataPic = [
                    'parent_photo' => $imageFile->getName()
                ];
            }  else {
                $dataPic = [
                    'pro_photo' => $imageFile->getName()
                ];
            }
            var_dump($dataPic);
            if ($_SESSION['user']["status"] == 'parent') {
                $this->parentsModel->editParent($dataPic, $id);
            } elseif (($_SESSION['user']['status'] == 'professionnel'))  {
                $this->prosModel->editPro($dataPic, $id);
            }
            return redirect()->to('/profil');
        }
    }
}
