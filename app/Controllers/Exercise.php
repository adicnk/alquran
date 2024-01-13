<?php

namespace App\Controllers;

use App\Models\ConfigMDL;
use App\Models\SoalMDL;
use App\Models\JawabanMDL;
use App\Models\KategoriMDL;
use App\Models\LatihanMDL;
use App\Models\LoginMDL;
use App\Models\UserMDL;
use App\Models\KategoriMDLMDL;
use App\Models\UserSubcribeMDL;

class Exercise extends BaseController
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

    public function index()
    {
        $data = [
            'title' => "USER LOGIN"
        ];

        return view('exercise/login', $data);
    }

    public function soal()
    {
        session()->set('isFinish', false);
        $user = $this->userModel->searhAdminID(session()->get('userID'));
        // Soal tp (tanpa pembahasan) dan dp (dengan pembahasan)        
        //$soal = $this->soalModel->isChoosen();
        //$soal = $this->soalModel->isChoosen();
        
        foreach ($user as $u) :
            switch ($u['paket']) {
                case 'demo':                    
                    $totalSoal=$this->userSubcribeModel->totalSoal(1);
                    break;                
            }
        endforeach;

        $soalClass = $this->request->getVar('soalClass');
        $soal = $this->soalModel->soalBuilder($soalClass);

        //dd($soalClass);

        //$totalSoal = $this->configModel->totalSoal($user);
        $no = $this->request->getVar('id');
        $soalArr = array_fill(0, $totalSoal, null);
        $jawabanArr = array_fill(0, $totalSoal, null);

        for ($x = 0; $x < $totalSoal; $x++) {
            $soalArr[$x]=$x+1;
        }
        
        session()->set('noId', 1);
        session()->set('soalArr', $soalArr);
        session()->set('jawabanArr', $jawabanArr);
        session()->set('soal', $soal);
        
        $data = [
            'title' => "Latihan Soal",
            'soalIdx' => $soalArr,
            'soal' => $soal,
            'total' => $totalSoal,
            'paket' => $user            
        ];
        
        return view('exercise/latihan', $data);
    }
    
    public function login()
    {
        $usr = $this->request->getVar('username');
        $pwd = $this->request->getVar('password');

        if (!$usr or !$pwd) {
            $data = [
                'title' => 'Login Status',
                'login' => $this->loginModel->index()
            ];
            return view('exercise/relogin', $data);
        } else {
            $loginStatus = $this->userModel->statusLogin($usr, $pwd);


            if ($loginStatus) {
                session()->set('userID', $loginStatus);
                $data = [
                    'title'   => "Dashboard"
                ];
                return view('exercise/getdashboard', $data);
            } else {
                $data = [
                    'title' => 'Login Status',
                    'login' => $this->loginModel->index(),                   
                ];
                return view('exercise/relogin', $data);
            }
        }
    }

    public function dashboard()
    {
        if (session()->start==false):
            session()->set('start', true);
            $start=0;
            if ($start==1) :
                $data = [
                    'title' => "USER LOGIN"
                ];
                return view('exercise/login', $data);            
            endif;
        endif;
        
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login"
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }

        session()->set('isFinish', false);
        $totalLatihan = $this->latihanModel->countLatihan($userID);
        $benar = $this->latihanModel->lastBenar($userID);
        $salah = $this->latihanModel->lastSalah($userID);
        $score = $this->latihanModel->lastScore($userID);
        
        if ($totalLatihan==0 AND session()->start):
            session()->set('start', false);
            $start=1;
        endif;
        
        if ($totalLatihan > 1) {
            $benarBefore = $this->latihanModel->benarBefore($userID);
            $persenBenar = ($benar - $benarBefore);
            $salahBefore = $this->latihanModel->salahBefore($userID);
            $persenSalah = ($salah - $salahBefore);
            $scoreBefore = $this->latihanModel->scoreBefore($userID);
            $persenScore = ($score - $scoreBefore);
        } else {
            $persenBenar = null;
            $persenSalah = null;
            $persenScore = null;
        }

        $cRec = $this->latihanModel->findAllID($userID);
        $cid = 1;
        $labelChart = null;
        $dataChart = null;
        foreach ($cRec as $c) {
            // $dataChart = $dataChart . "-" . $c['score'];
            if ($cid == 1) {
                $labelChart = '"' . substr($c['date'], 0, 10) . '",';
                $dataChart = $c['score'] . ',';
            }
            if ($cid > 1) {
                if ($cid == $totalLatihan) {
                    $labelChart = $labelChart . '"' . substr($c['date'], 0, 10) . '"';
                    $dataChart = $dataChart . $c['score'];
                } else {
                    $labelChart = $labelChart . '"' . substr($c['date'], 0, 10) . '",';
                    $dataChart = $dataChart . $c['score'] . ",";
                }
            } else {
            }
            $cid++;
        }

        $data = [
            'title' => "PAIT @ PPNI",
            'totalLatihan' => $totalLatihan,
            'lastLatihan' => $this->latihanModel->lastLatihan($userID),
            'benar' => $benar,
            'persenBenar' => $persenBenar,
            'salah' => $this->latihanModel->lastSalah($userID),
            'persenSalah' => $persenSalah,
            'lastScore' => $score,
            'persenScore' => $persenScore,
            'labelChart' => $labelChart,
            'dataChart' => $dataChart
        ];
        return view('exercise/dashboard', $data);
    }

    public function belajar()
    {
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login"
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }

        $data = [
            'title' => "PAIT @ PPNI",
            'user' => $this->userModel->searhAdminID(session()->get('userID')),

        ];
        return view('exercise/belajar', $data);
    }

    public function profile()
    {
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login"
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }

        $data = [
            'title' => "PAIT @ PPNI",
            'user' => $this->userModel->searhAdminID(session()->get('userID')),
            'nilai_ratarata' => $this->latihanModel->nilaiRatarata(session()->get('userID'))
        ];
        return view('exercise/profile', $data);
    }

    public function request(){
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login"
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }

    $data = [
        'paket' => $this->userModel->searhAdminID(session()->get('userID'))    
    ];
        return view('exercise/beli',$data);
    }

    public function beli(){
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login"
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }

    $data = [
        'paket' => $this->userModel->searchPaket(session()->get('userID')) 
    ];
        return view('exercise/beli',$data);
    }

    public function belifp(){
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login"
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }

    $data = [
        'paket' => $this->userModel->searchPaket(session()->get('userID')) 
    ];
        return view('exercise/beli',$data);
    }

    public function belipaket($idKategoriSoal){
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login",
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }

        $idUserSubcribe = $this->userSubcribeModel->getID($idKategoriSoal,$userID);
        $total = $this->kategoriModel->getTotalSoal($idKategoriSoal);

        $this->userSubcribeModel->save([
            'id' => $idUserSubcribe,
            'user_id' => $userID,
            'subcribe_id' => 2,
            'kategori_soal_id' => $idKategoriSoal,
            'total' => $total,
            'is_request' => 1     
        ]);

        $data = [
            'title' => 'Beli Paket'
        ];

        return view('exercise/deal',$data);
        
    }

    public function bayar($idKategoriSoal){
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login",
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }

        $idUserSubcribe = $this->userSubcribeModel->getID($idKategoriSoal,$userID);
        $total = $this->kategoriModel->getTotalSoal($idKategoriSoal);

        $this->userSubcribeModel->save([
            'id' => $idUserSubcribe,
            'user_id' => $userID,
            'subcribe_id' => 2,
            'kategori_soal_id' => $idKategoriSoal,
            'total' => $total,
            'is_request' => 1     
        ]);

        $data = [
            'title' => 'Beli Paket'
        ];
            return view('exercise/deal',$data);
        
    }

    public function info()
    {
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login"
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }

        $data = [
            'title' => "PAIT @ PPNI"
        ];
        return view('exercise/info', $data);
    }

    public function confirm()
    {
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login"
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }

        $data = [
            'title' => "Konfirmasi Pembayaran",
            'validation'=> \Config\Services::validation()
        ];
        return view('exercise/confirm', $data);
    }

    public function about()
    {
        return view('exercise/about');
    }

    public function latihanFP()
    {
        $userID = session()->get('userID');

        $data = [
            'title'   => "User Login"
        ];                                 
        if (!isset($userID)) {
            return view('exercise/login', $data);            
        }

    $data = [
        'paket' => $this->userModel->searchPaket(session()->get('userID'))    
    ];        
        return view('exercise/latihan-fp',$data);
    }

    public function review()
    {        
        $data = [
            'boxNumber' => 0
        ];

        return view('exercise/selesai-review',$data);
    }

}
