<?php

namespace App\Controllers;

use App\Models\UserMDL;
use App\Models\LoginMDL;
use App\Models\SoalMDL;
use App\Models\JawabanMDL;
use App\Models\ConfigMDL;

class SubmitEdit extends BaseController
{
    protected $userModel, $loginModel, $soalModel, $jawabanModel, $configModel;

    public function __construct()
    {
        $this->userModel = new UserMDL();
        $this->loginModel = new LoginMDL();
        $this->soalModel = new SoalMDL();
        $this->jawabanModel = new JawabanMDL();
        $this->configModel = new ConfigMDL();
    }

    public function admin($id)
    {
        //dd($this->request->getVar());
        $url = $this->request->getVar('url');
        $roleID = $this->request->getVar('roleUser');
        $nimnip = $this->request->getVar('nimnipUser');
        $slug = url_title($this->request->getVar('namaUser'), '-', true);
        $statusID = $this->request->getVar('statusUser');


        $this->userModel->save([
            'id' => $id,
            'idx' => $id,
            'role_id' => $roleID,
            'name' => $this->request->getVar('namaUser'),
            'slug' => $slug,
            'jurusan_id' => $this->request->getVar('jurusanUser'),
            'status_id' => $statusID,
            'email' => $this->request->getVar('emailUser'),
            'nim' => $nimnip,
            'nip' => $nimnip
        ]);
        if ($this->loginModel->searchID($id)) {
            $this->loginModel->save([
                'id' => $this->loginModel->searchID($id),
                'role_id' => $roleID,
                'user_id' => $id,
                'username' => $this->request->getVar('usernameUser'),
                'password' => $this->request->getVar('passwordUser'),
                'is_active' => 1
            ]);
        }
        if ($url == "mahasiswa") {
            $this->userModel->save([
                'id' => $id,
                'username' => $this->request->getVar('usernameUser'),
                'password' => $this->request->getVar('passwordUser')
            ]);
        }

        // dd($url);
        if ($url == 'admin') {
            return redirect()->to('../../admin/user');
        } else {
            return redirect()->to('../../admin/mahasiswa');
        }
    }

    public function soal($cat,$id)
    {
        $id=$this->soalModel->getSoalID($cat,$id);
        $namaGambar = null;
        $isPicture = $this->request->getVar('isPicture');
        $fileGambar = $this->request->getFile('fileGambar');
        $isAudio = $this->request->getVar('isAudio');
        $fileAudio = $this->request->getFile('fileAudio');
        $isChoosen = $this->request->getVar('isChoosen');
        $isChoosenBefore = $this->soalModel->isChoosenStatus($id);
        $namaGambar = $this->soalModel->getName($id);

        $namaSuara = null;
            // Ambil nama file
            if ($isPicture) {   
                if ($namaGambar==""){             
                    $namaGambar = $fileGambar->getName();
                    //$fileGambar->move('img');
                }                
            } else {
                $namaGambar = null;
            }
            //d($namaGambar);
        if ($fileAudio) :
            $fileAudio->move('aud');
            if ($isAudio) {
                $namaSuara = $fileAudio->getName();
            } else {
                $namaSuara = null;
            }
        endif;

        //dd($isChoosenBefore ."|".$isChoosen);

        if ($isChoosen<>$isChoosenBefore) {
            if ($isChoosenBefore=="on") {
                $isChoosen = null;
                $this->configModel->subtractTotalSoal();
            } else {
                $isChoosen = "on";
                $this->configModel->addTotalSoal();
            }
        }
        
        $this->soalModel->save([
            'id' => $id,
            'kategori_soal_id' => $cat,
            'name' => $this->request->getVar('isiSoal'),
            'is_picture' => $isPicture == "on" ? 1 : null,
            'picture_url' => $namaGambar,
            'is_audio' => $isAudio == "on" ? 1 : null,
            'audio_url' => $namaSuara,
            'is_choosen' => $isChoosen == "on" ? 1 : null
        ]);

        $this->jawabanModel->save([
            'id' => $this->jawabanModel->searchID($id),
            'soal_id' => $id,
            'jawabanA' => $this->request->getVar('jawabanA') ? $this->request->getVar('jawabanA') : null,
            'jawabanB' => $this->request->getVar('jawabanB') ? $this->request->getVar('jawabanB') : null,
            'jawabanC' => $this->request->getVar('jawabanC') ? $this->request->getVar('jawabanC') : null,
            'jawabanD' => $this->request->getVar('jawabanD') ? $this->request->getVar('jawabanD') : null,
            'jawabanE' => $this->request->getVar('jawabanE') ? $this->request->getVar('jawabanE') : null,
            'jawaban_benar' => $this->request->getVar('jawabanBenar')
        ]);

            //Sorting Record by Kategori Soal
            $this->soalModel->reSortIdx();


        return redirect()->to('../../admin/soal');
    }
}
