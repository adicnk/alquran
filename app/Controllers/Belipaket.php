<?php

namespace App\Controllers;

use App\Models\ConfigMDL;
use App\Models\SoalMDL;
use App\Models\JawabanMDL;
use App\Models\LatihanMDL;
use App\Models\LoginMDL;
use App\Models\UserMDL;
use App\Models\KategoriMDL;
use App\Models\UserSubcribeMDL;

class Belipaket extends BaseController
{
    protected $soalModel, $configModel, $jawabanModel, $latihanModel, $loginModel, $userModel, $kategoriModel, $userSubcribeModel;

    public function __construct()
    {
        $this->soalModel = new SoalMDL();
        $this->jawabanModel = new JawabanMDL();
        $this->configModel = new ConfigMDL();
        $this->latihanModel = new LatihanMDL();
        $this->loginModel = new LoginMDL();
        $this->userModel = new UserMDL();
        $this->kategoriModel = new KategoriMDL();
        $this->userSubcribeModel = new UserSubcribeMDL();
    }
    public function index(){
        $userID = session()->get('userID');
        $kategoriID = $this->request->getVar('kategoriID');
            
        $data = [
            'title'   => "User Login",
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }
        
        $idUserSubcribe = $this->userSubcribeModel->getID($kategoriID,$userID);
        $total = $this->kategoriModel->getTotalSoal($kategoriID);

        dd($kategoriID);

        $this->userSubcribeModel->save([
            'id' => $idUserSubcribe,
            'user_id' => $userID,
            'subcribe_id' => 2,
            'kategori_soal_id' => $kategoriID,
            'total' => $total,
            'is_request' => 1     
        ]);

        $data = [
            'title' => 'Beli Paket'
        ];

        return view('exercise/deal',$data);
    }
}