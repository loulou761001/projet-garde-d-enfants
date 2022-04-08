<?php

namespace App\Controllers;

class Admin extends BaseController
{

    private $parentsModel;
    private $enfantsModel;
    private $proModel;

    public function __construct()
    {
        $this->parentsModel = model('App\Models\ParentsModel');
        $this->proModel = model('App\Models\ProModel');
        $this->enfantsModel = model('App\Models\EnfantsModel');
    }

    public function index()
    {
        if (isAdmin()){
            $data = [
                'pro' => $this->proModel->where('pro_approuve',0)->recupPro()
            ];
            return view('admin/Admin',$data);
        }else{
            return redirect()->to('');
        }
    }
    public function postAdd()
    {
        if (isAdmin()){
            $result = 1;
            $this->parentsModel->rechercheAdmin();
            if ($this->parentsModel->rechercheAdmin() === 'null') {
                $result = 0;
            }
            $data = [
                'result' => $result,
                'pro' => $this->proModel->where('pro_approuve',0)->recupPro()
            ];
            return view('admin/Admin',$data);
        }else{
            return redirect()->to('');
        }
    }

    public function approuve($id){
        if(isAdmin()){
            $this->proModel->editPro(['pro_approuve'=>1],$id);
            return redirect()->to('/admin');
        }else{
            return redirect()->to('');
        }
    }

    public function supprimer($id){
        if(isAdmin()){
            $this->proModel->suppUnPro($id);
            return redirect()->to('/admin');
        }else{
            return redirect()->to('');
        }
    }
}
