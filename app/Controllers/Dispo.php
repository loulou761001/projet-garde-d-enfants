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
        $this->contratsModel = model('App\Models\ContratsModel');
        $this->contratsEnfantsModel = model('App\Models\ContratsEnfantsModel');
        $this->contratsDispoModel = model('App\Models\ContratsDispoModel');
    }

    public function index()
    {
        if (!isPro()) {
            return redirect()->to('');
        }
        $data = [
            'parents' => $this->parentsModel->recupParents(),
            'pro' => $this->proModel->recupPro(),
            'dispos' => $this->dispoModel->recupPropreDispos(),
        ];
        return view('dispos/dispos',$data);
    }
    public function ajout()
    {
        if (!isPro()) {
            return redirect()->to('');
        }
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
    public function disposParents() {
        if (!isParent()) {
            return redirect()->to('');
        }
        {
            $data = [
                'parents' => $this->parentsModel->recupParents(),
                'pro' => $this->proModel->recupPro(),
                'dispos' => $this->dispoModel->recupDisposLibres(),
            ];
            return view('dispos/parents/dispos',$data);
        }
    }
    public function dispoDetails() {
        if (!isParent()) {
            return redirect()->to('');
        };
        if (empty($_GET["dispoNbr"])) {
            return redirect()->to('/voirDispos');
        };

        $checkNbr = explode('-',$_GET["dispoNbr"])[0];
        if (empty($this->dispoModel->recupDisposParID($checkNbr))) {
            return redirect()->to('/voirDispos');
        }
        foreach ($this->dispoModel->recupDisposParID(explode('-',$_GET["dispoNbr"])) as $check) {
            if (empty($check)) {
                return redirect()->to('/voirDispos');
            }
        }
        {
            $data = [
                'parents' => $this->parentsModel->recupParents(),
                'enfants' => $this->enfantsModel->recupEnfantsDeParent($_SESSION['user']['id']),
                'pro' => $this->proModel->recupUnPro($this->dispoModel->recupDisposParID(explode('-',$_GET["dispoNbr"]))[0]['dispo_id_pro']),
                'dispos' => $this->dispoModel->recupDispos(),
                'dispoActuelleID' => explode('-',$_GET["dispoNbr"]),
                'disposActuelles' => $this->dispoModel->recupDisposParID(explode('-',$_GET["dispoNbr"]))
            ];


            if (count($data['disposActuelles']) >1) {
                for ($i = 1; $i < count($data['disposActuelles']) ; $i++) {
                    if ($data['disposActuelles'][$i]['dispo_heure_debut'] != $data['disposActuelles'][$i-1]['dispo_heure_fin'] || $data['disposActuelles'][$i]['dispo_jour'] != $data['disposActuelles'][$i-1]['dispo_jour'] || $data['disposActuelles'][$i]['dispo_id_pro'] != $data['disposActuelles'][$i-1]['dispo_id_pro']) {
                        return redirect()->to('/voirDispos');
                    }
                }
            }
        }
        return view('dispos/parents/disposDetails',$data);
    }

    public function postChoix() {
        $proActuel = $this->dispoModel->recupDisposParID(explode('-',$_GET["dispoNbr"]))[0]['dispo_id_pro'];
        $data = [
            'parents' => $this->parentsModel->recupParents(),
            'enfants' => $this->enfantsModel->recupEnfantsDeParent($_SESSION['user']['id']),
            'pro' => $this->proModel->recupUnPro($proActuel),
            'dispos' => $this->dispoModel->recupDispos(),
            'dispoActuelleID' => explode('-',$_GET["dispoNbr"]),
            'disposActuelles' => $this->dispoModel->recupDisposParID(explode('-',$_GET["dispoNbr"]))
        ];
        $i = 0;
        $d = 0;
        //            vérifie les formats des clés de données en POST
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
        }
        $contrat = [
            "contrat_pro" => $proActuel,
            "contrat_infos" => $_POST['infos'],
        ];
        $this->contratsModel->insertContrat($contrat);
        $dernierId = $this->contratsModel->recupDernierId()[0]['id'];
        for ($i = 0; $i<count($enfants);$i++) {
            $contratEnfants[$i] = [
                "id_enfant" => $enfants[$i],
                "id_contrat" => $dernierId,
            ];
            $this->contratsEnfantsModel->insertContratEnfants($contratEnfants[$i]);
        }
        for ($i = 0; $i<count($dispos);$i++) {
            $contratDispo[$i] = [
                "id_dispo" => $dispos[$i],
                "id_contrat" => $dernierId,
            ];
            $this->contratsDispoModel->insertContratDispo($contratDispo[$i]);
        }
        return view('dispos/parents/disposDetails',$data);
    }
}
