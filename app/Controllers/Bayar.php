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

class Bayar extends BaseController
{

    protected $soalModel, $configModel, $jawabanModel, $latihanModel, $loginModel, $userModel, $userSubcribeModel, $kategoriModel;

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

    public function index()
    {

        $userID = session()->get('userID');
        $catID = $this->request->getVar('soalClass');
        $fileGambar = $this->request->getFile('fileGambar');

        if($fileGambar->getName()){

            $namaFile = $fileGambar->getName();
            $idUserSubcribe = $this->userSubcribeModel->getID($catID,$userID);
            $namaNewFile =$userID."-".$catID."-". $idUserSubcribe."-".$namaFile;

            $fileGambar->move('img');
            rename(FCPATH."img/".$namaFile, FCPATH."img/".$namaNewFile);

            $this->userSubcribeModel->save([
                'id' => $idUserSubcribe,
                'user_id' => $userID,
                'kategori_soal_id' => $catID,
                'is_confirm' => 1,   
                'file' => $namaNewFile
            ]);
        
            $data = [
                'title' => 'Beli Paket'
            ];
            return view('exercise/deal',$data);      
                    
            }  
            $data = [
                'title' => 'Konfirmasi Pembayaran',
                'validation'=> \Config\Services::validation()
            ];
            return view('exercise/confirm',$data);      
     
        }
}