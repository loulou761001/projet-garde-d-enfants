<?php
namespace App\Models;
use CodeIgniter\Model;
use function PHPUnit\Framework\isNull;

class ContratsModel extends Model
{
    protected $table = 'contrats';
    protected $allowedFields = ['id','contrat_pro', 'contrat_debut','contrat_fin','contrat_facture','contrat_infos'];

    public function insertContrat(array $data)
    {
        return $this->insert($data);
    }
    public function recupDernierId()
    {
        return $this->select('contrats.id')
            ->orderBy('id',"desc")
            ->limit(1)
            ->find();
    }
    public function recupDernierNumFacture()
    {
        return $this->select('contrats.contrat_facture')
            ->orderBy('contrat_facture',"desc")
            ->limit(1)
            ->find();
    }
    public function recupContratParID($id)
    {
        return $this->select('contrats.*')
            ->where('id',$id)
            ->find();
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

    public function recupUnEnfant($id) {
        if (empty($id)) {
            return redirect()->to('');
        } else {
            return $this->select('enfants.*')
                ->where('id', $id)
                ->find();
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