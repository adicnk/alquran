<?php

namespace App\Controllers;

use App\Models\ConfigMDL;
use App\Models\SoalMDL;
use App\Models\JawabanMDL;
use App\Models\LatihanMDL;
use App\Models\UserMDL;
use App\Models\UserSubcribeMDL;
use CodeIgniter\I18n\Time;

class Latihan extends BaseController
{

    protected $soalModel, $configModel, $jawabanModel, $latihanModel, $userModel, $userSubcribeModel;

    public function __construct()
    {
        $this->soalModel = new SoalMDL();
        $this->jawabanModel = new JawabanMDL();
        $this->configModel = new ConfigMDL();
        $this->latihanModel = new LatihanMDL();
        $this->userModel = new UserMDL();
        $this->userSubcribeModel = new UserSubcribeMDL();
    }

    public function index()
    {     
        
        $userID = session()->get('userID');
        if (!session()->get('isFinish')) {       
            $data = [
                'title'   => "User Login"
            ];                                 
            if (!isset($userID)) {
                return view('exercise/login', $data);            
            }
            $user = $this->userModel->searhAdminID(session()->get('userID'));
            //$totalSoal = $this->configModel->totalSoal($user);
            //$soal = session()->get('soal');
            //$totalSoal = $this->configModel->totalSoal();
            
            $soalClass=(int) session()->get('soalClass');
            foreach ($user as $u) :
                switch ($u['paket']) {
                    case 'demo':                    
                        $totalSoal=$this->userSubcribeModel->totalSoal(1,$soalClass);
                        break;                
                    }
                endforeach;
                
                $soal = $this->soalModel->soalBuilder($soalClass,$totalSoal);
    
            $nilaiMin = $this->configModel->nilaiMinimum();

            $soalArr = session()->get('soalArr');

            $pilihanA = $this->request->getVar('jawabanA');
            $pilihanB = $this->request->getVar('jawabanB');
            $pilihanC = $this->request->getVar('jawabanC');
            $pilihanD = $this->request->getVar('jawabanD');
            $pilihanE = $this->request->getVar('jawabanE');            

            $no = $this->request->getVar('id');
            $answer = session()->get('jawabanArr');            

            if ($pilihanA) {
                $answer[$no - 2] = $pilihanA ? 1 : null;
            }
            if ($pilihanB) {
                $answer[$no - 2] = $pilihanB ? 2 : null;
            }
            if ($pilihanC) {
                $answer[$no - 2] = $pilihanC ? 3 : null;
            }
            if ($pilihanD) {
                $answer[$no - 2] = $pilihanD ? 4 : null;
            }
            if ($pilihanE) {
                $answer[$no - 2] = $pilihanE ? 5 : null;
            }

            $back=$this->request->getVar('prev');
            if ($back<>null){
                $panjangText=strlen($back);
                $isiText=substr($back,9,$panjangText-9);
                //d($isiText);
                $no=strval($isiText);
            }

            session()->set('noId', $no);
            session()->set('jawabanArr', $answer);

            $answer = session()->get('jawabanArr');
            // $no == $totalSoal + 1 ? dd(session()->get('jawabanArr')) : "";
            if ($no == $totalSoal + 1) {
                

                session()->set('isFinish', true);
                $benar = 0;
                $salah = 0;
                $diisi = 0;
                $kosong = 0;
                for ($x = 0; $x < $totalSoal; $x++) {
                    $jawabanBenar = $this->soalModel->searchJawabanSoalIdx($soalArr[$x], $answer[$x]);
                    $jawabanBenar ? $benar++ : $salah++;
                    $answer[$x] == null ? $kosong++ : $diisi++;
                }
                $score = $benar / $totalSoal * 100;

                //for dashboard exercise
                $newTime = new Time('now', 'Asia/Jakarta');
                $this->latihanModel->save([
                    'date' => $newTime,
                    'user_id' => session()->get('userID')
                ]);
                //ID terakhir yg di buat di tabel soal
                $db      = \Config\Database::connect();
                $latihanID = $db->insertID();
                session()->set('latihanID', $latihanID);

                $latihanID = session()->get('latihanID');
                $this->latihanModel->save([
                    'id' => $latihanID,
                    'kategori_soal_id' => $this->soalModel->soalClass,
                    'score' => $score,
                    'benar' => $benar,
                    'salah' => $salah
                ]);

                session()->set('soalBenar', $benar);
                session()->set('soalSalah', $salah);
                session()->set('soalDiisi', $diisi);
                session()->set('soalKosong', $kosong);
                session()->set('soalScore', $score);
                session()->set('soalTotal', $totalSoal);
                session()->set('soalArr', $soalArr);
                session()->set('jawabanSoal', $answer);

                $data = [
                    'title' => "Score Latihan Soal",
                    'benar' => $benar,
                    'salah' => $salah,
                    'diisi' => $diisi,
                    'kosong' => $kosong,
                    'score' => $score,
                    'nilaiMin' => $nilaiMin
                ];
                return view('exercise/selesai', $data);
            }

            $data = [
                'title' => "Latihan Soal",
                'soalIdx' => $soalArr,
                'soal' => $soal,
                'total' => $totalSoal
            ];
            return view('exercise/latihan', $data);
        }
        //redirect()->to('../');
    }
}
