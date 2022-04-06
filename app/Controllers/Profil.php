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
        if (empty($_SESSION['user'])){
            return redirect()->to('');
        } elseif ($_SESSION['user']['status']=='parent'){
            $enfants= $this->enfantsModel->recupEnfantsDeParent($_SESSION['user']['id']);
            $parent = $this->parentsModel->recupUnParents($_SESSION['user']['id']);
            echo view('Profil/Profil', ["parent" => $parent,"enfants"=>$enfants]);
        }elseif($_SESSION['user']['status']=='professionnel'){
            $pro =$this->proModel->recupUnPro($_SESSION['user']['id']);
            echo view('Profil/Profil', ["pro" => $pro]);
        }
    }
    public function autreProfilPro($id)
    {
        if (empty($this->proModel->recupUnPro($id))) {
            return redirect()->to('');
        }
        $data = [
            'pro' =>$this->proModel->recupUnPro($id)[0]
        ];
        echo view('/Profil/ProfilAutre', $data);
    }
    public function autreProfilParent($id)
    {
        if (empty($this->parentsModel->recupUnParents($id))) {
            return redirect()->to('');
        }
        $data = [
            'parent' =>$this->parentsModel->recupUnParents($id)[0]
        ];
        echo view('/Profil/ProfilAutreParent', $data);
    }


    public function modifProfil()
    {
        if (empty($_SESSION['user'])){
            return redirect()->to('');
        }elseif ($_SESSION['user']['status']=='parent'){
            $enfants= $this->enfantsModel->recupEnfantsDeParent($_SESSION['user']['id']);
            $parent = $this->parentsModel->recupUnParents($_SESSION['user']['id']);
            echo view('Profil/ModifProfil', ["parent" => $parent,"enfants"=>$enfants]);
        }elseif($_SESSION['user']['status']=='professionnel'){
            $pro =$this->proModel->recupUnPro($_SESSION['user']['id']);
            echo view('Profil/ModifProfil', ["pro" => $pro]);
        }

    }

    public function modifiedProfil()
    {
        $data = $this->dataModifProfil($this->request, "creation");
        if ($_SESSION['user']['status']=='parent'){
            $parent=$this->parentsModel->recupUnParents($_SESSION['user']['id']);

            if (password_verify($_POST['password'], $parent[0]['parent_password'])){
                $input=$this->validate([
                    'nom'=> 'required|min_length[2]',
                    'prenom'=> 'required|min_length[2]',
                    'email'=> 'required|min_length[2]',
                    'tel'=> 'required|min_length[2]',
                    'numAdresse'=> 'required|min_length[2]',
                    'adresse'=> 'required|min_length[2]',
                    'ville'=> 'required|min_length[2]',
                    'codePostal'=> 'required|min_length[5]|max_length[5]|numeric',
                ]);

                if(!$input){
                    $erreurs = $this->validator->getErrors();
                        $enfants= $this->enfantsModel->recupEnfantsDeParent($_SESSION['user']['id']);
                        $parent = $this->parentsModel->recupUnParents($_SESSION['user']['id']);
                        echo view('Profil/ModifProfil', ["parent" => $parent,'erreurs'=>$erreurs]);
                }else{

                    $this->parentsModel->update($_SESSION['user']['id'],$data);
                    return redirect()->to('/profil');
                }
            }else{
                $parent =$this->parentsModel->recupUnParents($_SESSION['user']['id']);
                echo view('Profil/ModifProfil', ["parent" => $parent,'erreurs'=>'Mauvais mot de passe']);
            }

        }elseif($_SESSION['user']['status']=='professionnel'){
            $pro=$this->proModel->recupUnPro($_SESSION['user']['id']);
            if (password_verify($_POST['password'], $pro[0]['pro_password'])){
                if($pro[0]['pro_categorie']!='Nourrice'){
                    $input=$this->validate([
                        'nom'=> 'required|min_length[2]',
                        'prenom'=> 'required|min_length[2]',
                        'email'=> 'required|min_length[2]',
                        'tel'=> 'required|min_length[10]|max_length[10]',
                        'numAdresse'=> 'required|min_length[2]',
                        'adresse'=> 'required|min_length[2]',
                        'ville'=> 'required|min_length[2]',
                        'codePostal'=> 'required|min_length[5]|max_length[5]|numeric',
                        'siret'=> 'required|min_length[14]|max_length[14]|numeric',
                        'entreprise'=> 'required',
                    ]);
                }else{
                    $input=$this->validate([
                        'nom'=> 'required|min_length[2]',
                        'prenom'=> 'required|min_length[2]',
                        'email'=> 'required|min_length[2]',
                        'tel'=> 'required|min_length[10]|max_length[10]',
                        'numAdresse'=> 'required|min_length[2]',
                        'adresse'=> 'required|min_length[2]',
                        'ville'=> 'required|min_length[2]',
                        'codePostal'=> 'required|min_length[5]|max_length[5]|numeric',

                    ]);
                }
                if(!$input){
                    $erreurs = $this->validator->getErrors();
                    $pro =$this->proModel->recupUnPro($_SESSION['user']['id']);
                    echo view('Profil/ModifProfil', ["pro" => $pro,"erreurs"=>$erreurs]);

                }else{
                    $this->proModel->update($_SESSION['user']['id'],$data);
                    return redirect()->to('/profil');
                }
            }else{
                $pro =$this->proModel->recupUnPro($_SESSION['user']['id']);
                echo view('Profil/ModifProfil', ["pro" => $pro,'erreurs'=>['mdp'=>'Mauvais mot de passe']]);
            }
        }elseif (empty($_SESSION['user'])){
        return redirect()->to('');
     }
    }




    public function supprEnfant($id)
    {
        $check=$this->enfantsModel->recupUnEnfant($id);
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
            'infos'=> 'required',
        ]);

        if(!$input){
            $erreurs = $this->validator->getErrors();
            $enfants= $this->enfantsModel->recupEnfantsDeParent($_SESSION['user']['id']);
            $parent = $this->parentsModel->recupUnParents($_SESSION['user']['id']);
            echo view('Profil/Profil', ["parent" => $parent,"enfants"=>$enfants,'erreurs'=>$erreurs,'form'=>$data]);
        }else{
            debug($this->request->getFile('carnet'));
            if(!empty($this->request->getFile('carnet')['path'])) {
                helper(['form', 'url']);
                $File = $this->request->getFile('carnet');
                debug($File);
                $File->move(PUBLIC_PATH . '/uploads/carnets');
                $dataFile = [
                    'enfant_carnet' => $File->getName()
                ];
                var_dump($dataFile);

                $data['enfant_carnet'] = $File->getName();
            }

            $this->enfantsModel->insert($data);
//            return redirect()->to('/profil');
        }
    }

    private function generateActualiteFromPost(IncomingRequest $request, string $type): array
    {
        debug($_POST);
        $data = [
            'enfant_nom' => $request->getPost("nom"),
            'enfant_prenom' => $request->getPost("prenom"),
            'enfant_sexe' => $request->getPost("sexe"),
            'enfant_parent' => $_SESSION['user']['id'],
            'enfant_naissance' => $request->getPost("naissance"),
            'enfant_carnet' => '',
            'enfants_infos' => $request->getPost("infos"),
        ];
        debug($data);

        return $data;
    }

    private function dataModifProfil(IncomingRequest $request, string $type): array
    {

        if ($_SESSION['user']['status']=='parent'){
            $data = [
                'parent_nom' => $request->getPost("nom"),
                'parent_prenom' => $request->getPost("prenom"),
                'parent_email' => $request->getPost("email"),
                'parent_adresse' => $request->getPost("adresse"),
                'parent_ville' => $request->getPost("ville"),
                'parent_postal' => $request->getPost("codePostal"),
                'parent_numAdresse' => $request->getPost("numAdresse"),
                'parent_tel' => $request->getPost("tel"),
                'parent_infosAdresse' => $request->getPost("infosAdresse"),
            ];

            return $data;

        }elseif($_SESSION['user']['status']=='professionnel'){

            $data = [
                'pro_nom' => $request->getPost("nom"),
                'pro_prenom' => $request->getPost("prenom"),
                'pro_entreprise' => $request->getPost("entreprise"),
                'pro_description' => $request->getPost("description"),
                'pro_adresse' => $request->getPost("adresse"),
                'pro_numAdresse' => $request->getPost("numAdresse"),
                'pro_infosAdresse' => $request->getPost("infosAdresse"),
                'pro_ville' => $request->getPost("ville"),
                'pro_postal' => $request->getPost("codePostal"),
                'pro_telephone' => $request->getPost("tel"),
                'pro_email' => $request->getPost("email"),
                'pro_taux_horaire' => $request->getPost("infosAdresse"),
                'pro_siret' => $request->getPost("siret"),
            ];
            return $data;
        }else{
            $data =['erreur'=>'Il y a eu un problème'];
            return $data;
        }
    }


    public function motDePasse(){
        echo view('Profil/MotDePasse');
    }
    public function motDePassePost(){
        $parent=$this->parentsModel->where('parent_email', $_POST['email'])->find();
        $pro=$this->proModel->where('pro_email', $_POST['email'])->find();

        if(!empty($parent)){
            $chiffre= generateRandomString(60);
            $this->parentsModel->update($parent[0]['id'],['parent_token'=>$chiffre]);
            //mail() puis redirect()
            // EN LOCAL DONC :
            echo view('Profil/MotDePasse',['mail'=>$parent[0]['parent_email'],'token'=>$chiffre]);
        }elseif (!empty($pro)){
            $chiffre= generateRandomString(60);
            $this->proModel->update($pro[0]['id'],['pro_token'=>$chiffre]);
            //mail() puis redirect()
            // EN LOCAL DONC :
            echo view('Profil/MotDePasse',['mail'=>$pro[0]['pro_email'],'token'=>$chiffre  ]);
        }else{
            echo view('Profil/MotDePasse',['erreurs'=>'Aucun compte avec cet adresse mail n\'a été trouvé']);
        }
    }
    public function motDePasseModif(){

        $parent=$this->parentsModel->where('parent_email', $_GET['email'])->find();
        $pro=$this->proModel->where('pro_email', $_GET['email'])->find();

        if(!empty($parent)){

            if ($_GET['token'] == $parent[0]['parent_token']){
                echo view('Profil/ModifMdp');
            }else{
                return redirect()->to('');
            }

        }elseif (!empty($pro)){
            if ($_GET['token'] == $pro[0]['parent_token']){
                echo view('Profil/ModifMdp');
            }else{
                return redirect()->to('');
            }

        }
        return redirect()->to('');
    }
    public function motDePasseModifPost(){
        $input=$this->validate([
            'mdp'=> 'required|min_length[8]',
        ]);

        if(!$input){
            $erreurs = $this->validator->getErrors();
            echo view('Profil/ModifMdp', ['erreurs'=>$erreurs,]);
        }else{

            $parent=$this->parentsModel->where('parent_email', $_GET['email'])->find();
            $pro=$this->proModel->where('pro_email', $_GET['email'])->find();

            if(!empty($parent)){
                $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
                $this->parentsModel->update($parent[0]['id'],['parent_password'=>$mdp,'parent_token'=>'']);
                return redirect()->to('/connexion');

            }elseif (!empty($pro)){
                $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
                $this->proModel->update($pro[0]['id'],['pro_password'=>$mdp,'parent_token'=>'']);
                return redirect()->to('/connexion');
            }
        }
     return redirect()->to('');
    }

    public function motDePasseModifProfil(){

        if(!empty($_SESSION['user'])){
            if($_SESSION['user']['status']=='parent'){
                echo view('Profil/ModifMdpUser');
            }elseif($_SESSION['user']['status']=='professionnel'){
                echo view('Profil/ModifMdpUser');
            }
        }else{
            return redirect()->to('/connexion');
        }

    }


    public function motDePasseModifProfilPost(){
        $mdp=password_hash($_POST['newmdp'],PASSWORD_DEFAULT);
        if ($_SESSION['user']['status']=='parent'){
           $parent=$this->parentsModel->recupUnParents($_SESSION['user']['id']);

           if (password_verify($_POST['mdp'],$parent[0]['parent_password'])){
               $input=$this->validate([
                   'newmdp'=> 'required|min_length[8]',
               ]);

               if(!$input){
                   $erreurs = $this->validator->getErrors();
                   echo view('Profil/ModifMdpUser', ['erreurs'=>$erreurs,]);
               }else{
                   $this->parentsModel->update($parent[0]['id'],['parent_password'=>$mdp]);
                   return redirect()->to('/deconnexion');
               }
           }else{
               echo view('Profil/ModifMdpUser', ['erreur'=>'Le mot de passe actuel saisi n\'est pas bon']);
           }


       }elseif($_SESSION['user']['status']=='professionnel'){
           $pro=$this->proModel->recupUnPro($_SESSION['user']['id']);
        debug($mdp);
           if (password_verify($_POST['mdp'],$pro[0]['pro_password'])){
               $input=$this->validate([
                   'newmdp'=> 'required|min_length[8]',
               ]);

               if(!$input){
                   $erreurs = $this->validator->getErrors();
                   echo view('Profil/ModifMdpUser', ['erreurs'=>$erreurs,]);
               }else{
                   $this->proModel->update($pro[0]['id'],['pro_password'=>$mdp]);
                   return redirect()->to('/deconnexion');
               }
           }else{
               echo view('Profil/ModifMdpUser', ['erreur'=>'Le mot de passe actuel saisi n\'est pas bon']);
           }
       }
    }
}
