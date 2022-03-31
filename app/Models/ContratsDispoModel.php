<?php
namespace App\Models;
use CodeIgniter\Model;
use function PHPUnit\Framework\isNull;

class ContratsDispoModel extends Model
{
    protected $table = 'contrat_dispo_pivot';
    protected $allowedFields = ['id','id_contrat', 'id_dispo'];

    public function insertContratDispo(array $data)
    {
        return $this->insert($data);
    }

    public function suppUnEnfant($id) {
        if (empty($id)) {
            return redirect()->to('');
        } else {
            return $this->select('enfants.*')
                ->where('id', $id)
                ->delete();
        }
    }

    public function recupUneDispo($id) {
        if (empty($id)) {
            return redirect()->to('');
        } else {
            return $this->select('contrat_dispo_pivot.*')
                ->where('id_contrat', $id)
                ->find();
        }
    }
    public function recupUnContratParDispo($id) {
        if (empty($id)) {
            return redirect()->to('');
        } else {
            return $this->select('contrat_dispo_pivot.*')
                ->where('id_dispo', $id)
                ->find();
        }
    }


    public function recupEnfantsDeParent($id) {
        if (empty($id)) {
            return redirect()->to('');
        } else {
            return $this->where(['enfant_parent'=>$id])->find();
        }
    }
    public function editEnfant(array $data, $id)
    {
        var_dump($data);
        return $this->select('enfants.*')
            ->where('id', $id)
            ->set($data)
            ->update($id,$data);
    }
}