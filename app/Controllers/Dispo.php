<?php

namespace App\Controllers;

class Dispo extends BaseController
{

    private $parentsModel;
    private $enfantsModel;
    private $proModel;
    private $dispoModel;

    public function __construct()
    {
        $this->parentsModel = model('App\Models\ParentsModel');
        $this->proModel = model('App\Models\ProModel');
        $this->enfantsModel = model('App\Models\EnfantsModel');
        $this->dispoModel = model('App\Models\DispoModel');
    }

    public function index()
    {
        $data = [
            'parents' => $this->parentsModel->recupParents(),
            'pro' => $this->proModel->recupPro(),
            'dispos' => $this->dispoModel->recupPropreDispos(),
        ];
        return view('dispos/dispos',$data);
    }
    public function ajout()
    {
        $data = [
            'parents' => $this->parentsModel->recupParents(),
            'pro' => $this->proModel->recupPro(),
            'dispos' => $this->dispoModel->recupPropreDispos(),
        ];
        return view('dispos/ajoutDispos',$data);
    }
    public function HandlePost()
    {
        $data = [
            'parents' => $this->parentsModel->recupParents(),
            'pro' => $this->proModel->recupPro(),
            'dispos' => $this->dispoModel->recupPropreDispos(),
        ];
        debug($_POST);
        $regex = '/^[0-9]{2}-[0-9]{2}$/';
        $regexDate = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
        $i = 0;
        $finalArray = [
            $i => []
        ];
        foreach ($_POST as $item) {
            if (preg_match($regex, $item)) {
                $heures = explode('-',$item);
                $heureDebut = $heures[0].':00:00';
                $heureFin = $heures[1].':00:00';
                debug($heures);
                $finalArray[$i]['dispo_heure_debut'] = $heureDebut;
                $finalArray[$i]['dispo_heure_fin'] = $heureFin;

            } elseif (preg_match($regexDate, $item)) {
                $date = $item;
                $finalArray[$i]['date'] = $date;
            } else {
                $places = $item;
                $finalArray[$i]['places'] = $places;
            }
            $i++;
        }
        debug($finalArray);
        for ($n = 1; $n <= count($finalArray)-2; $n++) {
            $dispo = [
                'dispo_id_pro' => $_SESSION['user']['id'],
                'dispo_jour' => $finalArray[0]['date'],
                'dispo_heure_debut' => $finalArray[$n]['dispo_heure_debut'],
                'dispo_heure_fin' => $finalArray[$n]['dispo_heure_fin'],
                'dispo_places' => $finalArray[count($finalArray)-1]['places'],
            ];
            $this->dispoModel->inserDispo($dispo);
        }
    return redirect()->to('/gestionDispo');
    }
}
