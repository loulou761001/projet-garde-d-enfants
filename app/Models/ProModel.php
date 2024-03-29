<?php
namespace App\Models;
use CodeIgniter\Model;
use function PHPUnit\Framework\isNull;

class ProModel extends Model
{
    protected $table = 'professionnels';
    protected $allowedFields = ['id','pro_prenom', 'pro_nom','pro_naissance','pro_email','pro_password', 'pro_token','pro_adresse','pro_telephone','pro_photo','pro_taux_horaire','pro_categorie','pro_description','pro_entreprise','pro_numAdresse','pro_infosAdresse','pro_ville','pro_postal','pro_siret','pro_identite','pro_approuve'];
    public function recupPro() {
        if (!empty($_GET['limit'])) {
            return $this->limit($_GET['limit'])->find();
        } else {
            return $this->findAll();
        }
    }
    public function recupRechercheParents() {

        if (!empty($_GET['classe'])) {
            return $this->select('eleves.*')
                ->where('id_classe', $_GET['classe'])
                ->find();
        } else {
            return redirect()->to('');
        }
    }
    public function recupUnPro($id) {
        if (empty($id)) {
            return redirect()->to('');
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
    public function suppUnPro($id) {
        if (empty($id)) {
            return redirect()->to('/admin');
        } else {
            return $this->select('professionnels')
                ->where('id', $id)
                ->delete();
        }
    }
    public function inserPro(array $data)
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