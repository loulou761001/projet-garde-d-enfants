<?php
namespace App\Models;
use CodeIgniter\Model;
use function PHPUnit\Framework\isNull;

class DispoModel extends Model
{
    protected $table = 'disponibilites';
    protected $allowedFields = ['id','dispo_id_pro', 'dispo_jour','dispo_matin_aprem','dispo_heure_debut', 'dispo_heure_fin','dispo_places'];
    public function recupDispos() {
        if (!empty($_GET['limit'])) {
            return $this->limit($_GET['limit'])->find();
        } else {
            return $this->findAll();
        }
    }
    public function recupRechercheDispo() {

        if (!empty($_GET['jour'])) {
            return $this->select('disponibilites.*')
                ->where('dispo_jour', $_GET['jour'])
                ->find();
        } else {
            return redirect()->to('/');
        }
    }
    public function recupPropreDispos() {
        return $this->select('disponibilites.*')
            ->where('dispo_id_pro', $_SESSION['user']["id"])
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
    public function editPro(array $data, $id)
    {
        var_dump($data);
        return $this->select('professionnels')
            ->where('id', $id)
            ->set($data)
            ->update($id,$data);
    }
}