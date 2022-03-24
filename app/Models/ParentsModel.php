<?php
namespace App\Models;
use CodeIgniter\Model;
use function PHPUnit\Framework\isNull;

class ParentsModel extends Model
{
    protected $table = 'parents';
    protected $allowedFields = ['id','parent_prenom', 'parent_nom','parent_email','parent_password', 'parent_token','parent_adresse','parent_tel','parent_photo','parent_numAdresse','parent_infosAdresse','parent_ville','parent_postal'];
    public function recupParents() {
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
            return redirect()->to('/');
        }
    }
    public function recupUnParents($id) {
        if (empty($id)) {
            return redirect()->to('/');
        } else {
            return $this->select('parents.*')
                ->where('parents.id', $id)
                ->find();
        }
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
    public function inserParent(array $data)
    {
        return $this->insert($data);
    }
    public function editParent(array $data, $id)
    {
        var_dump($data);
        return $this->select('eleves')
            ->where('id', $id)
            ->set($data)
            ->update($id,$data);
    }
}