<?php

namespace App\Controllers;

use App\Models\UserMDL;
use App\Models\LoginMDL;
use App\Models\SoalMDL;
use App\Models\JawabanMDL;
use App\Models\LatihanMDL;
use App\Models\ConfigMDL;
use App\Models\UserSubcribeMDL;

class LatihanPaket extends BaseController
{
    protected $userModel, $loginModel, $soalModel, $jawabanModel, $latihanModel, $configModel, $userSubcribeModel;

    public function __construct()
    {
        $this->userModel = new UserMDL();
        $this->loginModel = new LoginMDL();
        $this->soalModel = new SoalMDL();
        $this->jawabanModel = new JawabanMDL();
        $this->latihanModel = new LatihanMDL();
        $this->configModel = new ConfigMDL();
        $this->userSubcribeModel = new UserSubcribeMDL();
    }

    public function index()
    {
        session()->set('isFinish', false);
        $user = $this->userModel->searchPaket(session()->get('userID'));
        
        // Soal tp (tanpa pembahasan) dan dp (dengan pembahasan)        
        //$soal = $this->soalModel->isChoosen();
        $soalClass = $this->request->getVar('soalClass');
        foreach ($user as $u) :
            switch ($u['paket']) {
                case 'demo':                    
                    //d($soalClass);
                    $totalSoal=$this->userSubcribeModel->totalSoal(1,$soalClass);
                    break;                
            }
        endforeach;

        $soal = $this->soalModel->soalBuilder($soalClass,$totalSoal);

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
        session()->set('soalClass', $soal);

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
}