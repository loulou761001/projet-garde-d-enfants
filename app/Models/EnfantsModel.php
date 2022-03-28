<?php
namespace App\Models;
use CodeIgniter\Model;
use function PHPUnit\Framework\isNull;

class EnfantsModel extends Model
{
    protected $table = 'enfants';
    protected $allowedFields = ['id','enfant_prenom', 'enfant_nom','enfant_sexe','enfant_parent','enfant_photo','enfant_carnet','enfant_naissance','enfant_infos'];

    public function insertEnfant(array $data)
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

    public function recupEnfantsDeParent($id) {
        if (empty($id)) {
            return redirect()->to('');
        } else {
            return $this->where(['enfant_parent'=>$id])->findAll();
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