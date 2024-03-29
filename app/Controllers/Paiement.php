<?php

namespace App\Controllers;

class Paiement extends BaseController
{

    private $parentsModel;

    public function __construct()
    {
        $this->parentsModel = model('App\Models\ParentsModel');
        $this->proModel = model('App\Models\ProModel');
        $this->enfantsModel = model('App\Models\EnfantsModel');
        $this->dispoModel = model('App\Models\DispoModel');
        $this->contratsModel = model('App\Models\ContratsModel');
        $this->contratsEnfantsModel = model('App\Models\ContratsEnfantsModel');
        $this->contratsDispoModel = model('App\Models\ContratsDispoModel');
    }

    public function index()
    {
        $i = 0;
        $d = 0;
        $enfants=[];
        foreach (array_keys($_POST) as $item) {
            $matchEnfants = preg_match("/^id_enfant[0-9]+$/i", $item);
            $matchDispo = preg_match("/^id_dispo[0-9]+$/i", $item);
            if($matchEnfants == 1) {
                $enfants[$i] = $_POST[$item];
                $i++;
            } elseif ($matchDispo == 1) {
                $dispos[$d] = $_POST[$item];
                $d++;
            }
            $prix = ($_POST['taux']*count($enfants))*count($dispos);
            $quantite = count($enfants)+count($dispos)-1;

        }



        if (!empty($this->contratsModel->recupDernierNumFacture())) {
            $facture = intval($this->contratsModel->recupDernierNumFacture()[0]['contrat_facture'])+1;
        } else {
            $facture = 0;
        }

//        debug($facture);
        $data = [
            'parents' => $this->parentsModel->recupParents(),
            'enfants' => $this->enfantsModel->recupEnfantsDeParent($_SESSION['user']['id']),
            'dispos' => $this->dispoModel->recupDispos(),
            'pro' => $_POST['pro_id'],
            'prix'=>$prix,
            'quantite'=>$quantite,
            'prix_unite'=>$_POST['taux'],
            'facture'=>$facture
        ];
        return view('Paiement/Paiement',$data);
    }
    public function saveFacture() {


//        debug($_FILES);
//        get_file_data($_POST['data']);

//        $File = $this->request->getFile($_POST['data']);
//        debug($File);
//        $File->move(PUBLIC_PATH . '/uploads/factures');


//        $File->move(PUBLIC_PATH . '/uploads/factures');
//        return $File;
    }
}



