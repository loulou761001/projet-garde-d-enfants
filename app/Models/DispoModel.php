<?php
namespace App\Models;
use CodeIgniter\Model;
use phpDocumentor\Reflection\Types\Integer;
use function PHPUnit\Framework\isNull;

class DispoModel extends Model
{
    protected $table = 'disponibilites';
    protected $allowedFields = ['id','dispo_id_groupe','dispo_id_pro', 'dispo_jour','dispo_matin_aprem','dispo_heure_debut', 'dispo_heure_fin','dispo_places','dispo_suppr'];
    public function recupDispos() {
        if (!empty($_GET['limit'])) {
            return $this->where('dispo_suppr', 0)->limit($_GET['limit'])->find();
        }
        else {
            return $this->where('dispo_suppr', 0)->find();
        }
    }

    public function recupDisposFutur() {
        if (!empty($_GET['limit'])) {
            return $this->where('dispo_suppr', 0)->limit($_GET['limit'])->find();
        } else{
            return $this->where('dispo_suppr', 0)->where('dispo_jour >', date('Y-m-d'))->where('dispo_places >', 0)->find();
        }

    }
    public function recupDisposParIDString($id) {
        return $this->select('disponibilites.*')
            ->where('id', $id)
            ->find();
    }
    public function recupDisposParID($id) {
        if (gettype($id)=='string' OR gettype($id)=='integer') {
            return $this->select('disponibilites.*')
                ->where('id', $id)
                ->find();
        } elseif (gettype($id)=='array') {
            $arrayList = [];
            for ($i = 0; $i < count($id)-1; $i++) {
                $singleID = $this->select('disponibilites.*')
                    ->where('id', $id[$i])
                    ->find();
                array_push($arrayList,$singleID[0]);
            }
            return $arrayList;
        }
    }

    public function recupPropreDispos() {
        return $this->select('disponibilites.*')
            ->where('dispo_id_pro', $_SESSION['user']["id"])
            ->where('dispo_suppr', 0)
            ->orderBy('dispo_jour','ASC')
            ->find();
    }
    public function recupDisposLibres($offset=0) {
        return $this->select('disponibilites.*')
            ->where('dispo_places >', 0)
            ->where('dispo_suppr', 0)
            ->limit(10,$offset)
            ->find();
    }

    public function recupUnPro($id) {
        if (empty($id)) {
            return redirect()->to('/');
        } else {
            return $this->select('professionnels.*')
                ->where('professionnels.id', $id)
                ->find();
        }
    }
    public function recupProParentsLogin($email,$pw) {
        return $this->select('parents.parents_email, professionnels.pro_email')
            ->where('parents.parents_email', $email)
            ->join('classes', 'eleves.id_classe = classes.id')
            ->find();

    }
    public function suppUnParent($id) {
        if (empty($id)) {
            return redirect()->to('/');
        } else {
            return $this->select('eleves.*')
                ->where('id', $id)
                ->delete();
        }
    }
    public function inserDispo(array $data)
    {
        return $this->insert($data);
    }
    public function editDispo(array $data, $id)
    {
        return $this->select('disponibilites.*')
            ->where('id', $id)
            ->set($data)
            ->update($id,$data);
    }
    public function moinsPlace(Integer $nbr, $id)
    {
        $cetteDispo = $this->select('disponibilites.*')
            ->where('disponibilites.id', $id)
            ->find();
        $data = [
            'dispo_places' => $cetteDispo['dispo_places']-$nbr
        ];
        return $this->select('disponibilites')
            ->where('id', $id)
            ->set($data)
            ->update($id,$data);
    }
}