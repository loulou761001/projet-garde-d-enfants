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
        $dispos = $this->dispoModel->recupPropreDispos();
        $i = 0;
        foreach ($dispos as $dispo) {
            if (!empty($this->contratsDispoModel->recupUnContratParDispo($dispo['id']))) {
                $contrat =$this->contratsDispoModel->recupUnContratParDispo($dispo['id'])[0];
                $enfants[$dispo['id']] = $this->contratsEnfantsModel->recupContratsEnfantParContrat($contrat['id_contrat']);


                for ($e = 0; $e < count($enfants[$dispo['id']]);$e++) {
                    $enfants[$dispo['id']][$e]['enfant_infos'] = $this->enfantsModel->recupUnEnfant($enfants[$dispo['id']][$e]['id_enfant'])[0];
                }
                $i++;
            }
        }
        if (!empty($enfants)) {
            $data = [
                'parents' => $this->parentsModel->recupParents(),
                'pro' => $this->proModel->recupPro(),
                'dispos' => $this->dispoModel->recupPropreDispos(),
                'enfants' => $enfants,
            ];
        } else {
            $data = [
                'parents' => $this->parentsModel->recupParents(),
                'pro' => $this->proModel->recupPro(),
                'dispos' => $this->dispoModel->recupPropreDispos(),
            ];
        }


        if(empty($data["dispos"])) {
            return redirect()->to('/gestionDispo/ajout');
        }
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
        $idGroupe=generateRandomNumber(8);
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
                'dispo_id_groupe'=>$idGroupe,
            ];
            if ($n>1) {
                if ($finalArray[$n-1]['dispo_heure_fin'] != $finalArray[$n]['dispo_heure_debut']) {
                    $idGroupe=generateRandomNumber(8);
                }
            }
            $this->dispoModel->inserDispo($dispo);
        }
    return redirect()->to('/gestionDispo');
    }


    public function disposParents() {
        $dispos = [];
        if (!isParent()) {
            return redirect()->to('');
        }
        if (!empty($_GET['page'])) {
            $offset = intval(10*$_GET['page']-10) ;
            $dispos = $this->dispoModel->recupDisposLibres($offset);
        } else {
            $offset =0;
            $dispos = $this->dispoModel->recupDisposLibres($offset);
        }


        $distance = [];
        foreach ($dispos as $dispo) {
            $pro = $this->proModel->recupUnPro($dispo['dispo_id_pro']);

            $distance[$dispo['id']] = file_get_contents(str_replace(" ","+","https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$_SESSION['user']['numAdresse']."+".$_SESSION['user']['adresse']."&destinations=".$pro[0]['pro_numAdresse']."+".$pro[0]['pro_adresse']."+".$pro[0]['pro_ville']."&units=metric&key=AIzaSyB7Bd7FBAfcCuG-i0hKlQBpPX3ytXB0qg0"));
            $distance[$dispo['id']] = json_decode($distance[$dispo['id']],true)['rows'][0]['elements'][0]['distance']['text'];
        }

        $disposCount = 1;
        for ($c=1;$c<count($this->dispoModel->recupDisposFutur());$c++) {

            if ($this->dispoModel->recupDisposFutur()[$c-1]['dispo_id_groupe']!= $this->dispoModel->recupDisposFutur()[$c]['dispo_id_groupe'] ) {
                $disposCount++;
            }
        }

        $data = [
            'distance' => $distance,
            'parents' => $this->parentsModel->recupParents(),
            'pro' => $this->proModel->recupPro(),
            'dispos' => $this->dispoModel->recupDisposLibres($offset),
            'disposCount' => $disposCount,
        ];
        if(empty($data['dispos'])) {
            return redirect()->to('dispoErreur');
        }
        return view('dispos/parents/dispos',$data);
    }

    public function mesDisposParents() {
        if (!isParent()) {
            return redirect()->to('');
        }
        $enfants = $this->enfantsModel->recupEnfantsDeParent($_SESSION['user']['id']);
        if(empty($enfants)) {
            return redirect()->to('profil');
        }
        $contrats = [];
        foreach ($enfants as $enfant) {
            $contrat = $this->contratsEnfantsModel->recupContratsEnfant($enfant['id']);
            array_push($contrats, $contrat);
        }
        $i =0;
        foreach ($contrats as $contratList) {
            foreach ($contratList as $contrat) {
                $mesContrat[$i] = $this->contratsModel->recupContratParID($contrat['id_contrat']);
                $i++;
            }
        }
        if(empty($mesContrat)) {
            return redirect()->to('profil');
        }
        $i =0;
        $e =0;
        foreach ($mesContrat as $item) {
            $id = $item[0]['id'];
            $id_dispo = $this->contratsDispoModel->recupUneDispo($id);
            foreach ($id_dispo as $value) {
                if (!empty($value)) {
                    $datetest = date('Y-m-d',strtotime($this->dispoModel->recupDisposParID($value['id_dispo'])[0]['dispo_jour']));;

                    if ($datetest > date('Y-m-d')) {
                        $contratID = $this->contratsDispoModel->recupUnContratParDispo($value['id_dispo'])[0]['id_contrat'];
                        $mesDispos[$e] = $this->dispoModel->recupDisposParID($value['id_dispo']);
                        $mesDispos[$e]['enfants'] = $this->contratsEnfantsModel->recupContratsEnfantParContrat($contratID);
                        $mesDispos[$e]['pro'] = $this->proModel->recupUnPro($mesDispos[$e][0]['dispo_id_pro']);
                        $e++;
                    }
                }
            }
            $i++;
        }
        $i =0;
        $enfants = [];
        foreach ($contrats as $contrat) {
            if (!empty($contrat)) {
                foreach ($contrat as $item) {
                    $enfants[$i] = $this->enfantsModel->recupUnEnfant($item['id_enfant']);
                    $i++;
                }
            }
        }
        $data = [
            'parents' => $this->parentsModel->recupParents(),
            'pro' => $this->proModel->recupPro(),
            'contrats' => $contrats,
            'dispos' => $mesDispos,
            'enfants' => $enfants,
        ];
        return view('dispos/parents/mesDispos',$data);
    }
    public function noDispo() {
        return view('dispos/parents/noDispos');

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
        $proActuel = $this->dispoModel->recupDisposParID(explode('-',$_POST["dispoNbr"]))[0]['dispo_id_pro'];
        $data = [
            'parents' => $this->parentsModel->recupParents(),
            'enfants' => $this->enfantsModel->recupEnfantsDeParent($_SESSION['user']['id']),
            'pro' => $this->proModel->recupUnPro($proActuel),
            'dispos' => $this->dispoModel->recupDispos(),
            'dispoActuelleID' => explode('-',$_POST["dispoNbr"]),
            'disposActuelles' => $this->dispoModel->recupDisposParID(explode('-',$_POST["dispoNbr"]))
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

        foreach ($dispos as $dispo) {
            $places = [
                'dispo_places'=>$this->dispoModel->recupDisposParID($dispo)[0]['dispo_places']-count($enfants)
            ];
            $this->dispoModel->editDispo($places,$dispo);
        }
        return redirect()->to('/mesDispos');
    }
    public function deleteDispo($idGroupe){
        $data = [
            'dispo_suppr' => 1
        ];
        if(isPro()){
            $this->dispoModel->where('dispo_id_groupe',$idGroupe)->set('dispo_suppr',$data['dispo_suppr'])->update();
            return redirect()->to('/gestionDispo');
        }else{
            return redirect()->to('');
        }
    }
}
