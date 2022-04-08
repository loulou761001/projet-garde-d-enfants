<?php
namespace App\Models;
use CodeIgniter\Model;
use function PHPUnit\Framework\isNull;

class ParentsModel extends Model
{
    protected $table = 'parents';
    protected $allowedFields = ['id','parent_prenom', 'parent_nom','parent_email','parent_password', 'parent_token','parent_adresse','parent_tel','parent_photo','parent_numAdresse','parent_infosAdresse','parent_ville','parent_postal','parent_naissance','est_admin'];
    public function recupParents() {
        if (!empty($_GET['limit'])) {
            return $this->limit($_GET['limit'])->find();
        } else {
            return $this->findAll();
        }
    }
    public function rechercheAdmin() {
        $data = [
            'est_admin'=>1
        ];
        $resultat = $this->select('parents.*')
            ->where('parent_nom', $_POST['nom'])
            ->where('parent_prenom', $_POST['prenom'])
            ->where('parent_email', $_POST['email'])
            ->find();
        if (!empty($resultat)) {

            return $this->select('parents.*')
                ->set($data)
                ->update($resultat[0]['id'],$data);
        } else {
            return 'null';
        }

    }

    public function recupUnParents($id) {
        if (empty($id)) {
            return redirect()->to('');
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
        return $this->select('parents')
            ->where('id', $id)
            ->set($data)
            ->update($id,$data);
    }
}