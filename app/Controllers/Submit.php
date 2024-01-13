<?php

namespace App\Controllers;

use App\Models\UserMDL;
use App\Models\LoginMDL;
use App\Models\SoalMDL;
use App\Models\JawabanMDL;
use App\Models\KategoriMDL;
use App\Models\ConfigMDL;
use App\Models\UserSubcribeMDL;

class Submit extends BaseController
{
    protected $userModel, $loginModel, $soalModel, $jawabanModel, $kategoriModel, $configModel, $userSubcribeModel;

    public function __construct()
    {
        $this->userModel = new UserMDL();
        $this->loginModel = new LoginMDL();
        $this->soalModel = new SoalMDL();
        $this->jawabanModel = new JawabanMDL();
        $this->kategoriModel = new KategoriMDL();
        $this->configModel = new ConfigMDL();
        $this->userSubcribeModel = new UserSubcribeMDL();
    }

    public function admin()
    {
        // dd($this->request->getVar());
        $url = $this->request->getVar('url');
        $roleID = $this->request->getVar('roleUser');
        $nimnip = $this->request->getVar('nimnipUser');
        $slug = url_title($this->request->getVar('namaUser'), '-', true);
        $statusID = $this->request->getVar('statusUser');

        $this->userModel->save([
            'role_id' => $roleID,
            'name' => $this->request->getVar('namaUser'),
            'slug' => $slug,
            'jurusan_id' => $this->request->getVar('jurusanUser'),
            'status_id' => $statusID,
            'email' => $this->request->getVar('emailUser')
        ]);

        //ID terakhir yg di buat di tabel user
        $db      = \Config\Database::connect();
        $lastID = $db->insertID();

        if ($roleID == 1) {
            if ($statusID == 1) {
                $this->userModel->save([
                    'id' => $lastID,
                    'idx' => $lastID,
                    'nim' => $nimnip
                ]);
            } else {
                $this->userModel->save([
                    'id' => $lastID,
                    'idx' => $lastID,
                    'nip' => $nimnip
                ]);
            }
            if ($this->loginModel->search($lastID)) {
                $this->loginModel->save([
                    'role_id' => $roleID,
                    'user_id' => $lastID,
                    'username' => $this->request->getVar('usernameUser'),
                    'password' => $this->request->getVar('passwordUser'),
                    'is_active' => 1
                ]);
            }
        } else {
            if ($statusID == 1) {
                $this->userModel->save([
                    'id' => $lastID,
                    'idx' => $lastID,
                    'nim' => $this->request->getVar('nimnipUser'),
                    'username' => $this->request->getVar('usernameUser'),
                    'password' => $this->request->getVar('passwordUser')
                ]);
            } else {
                $this->userModel->save([
                    'id' => $lastID,
                    'idx' => $lastID,
                    'nip' => $this->request->getVar('nimnipUser'),
                    'username' => $this->request->getVar('usernameUser'),
                    'password' => $this->request->getVar('passwordUser')
                ]);
            }
        }
        // dd($url);
        if ($url == 'admin') {
            return redirect()->to('../../admin/user');
        } else {
            return redirect()->to('../../admin/mahasiswa');
        }
    }

    public function soal()
    {
        $isPicture = $this->request->getVar('isPicture');
        $fileGambar = $this->request->getFile('fileGambar');
        $isAudio = $this->request->getVar('isAudio');
        $fileAudio = $this->request->getFile('fileAudio');
        $isChoosen = $this->request->getVar('isChoosen');
        $isDP = $this->request->getVar('isDP');

        $namaGambar = null;
        $namaSuara = null;

        if ($fileGambar) :
            // Pindahkan file ke folder gambar
            //$fileGambar->move('img');
            // Ambil nama file
            if ($isPicture) {
                $namaGambar = $fileGambar->getName();
            } else {
                $namaGambar = null;
            }
        endif;
        if ($fileAudio) :
            $fileAudio->move('aud');
            if ($isAudio) {
                $namaSuara = $fileAudio->getName();
            } else {
                $namaSuara = null;
            }
        endif;

        $this->configModel->addTotalSoal();

        $this->soalModel->save([
            'kategori_soal_id' => $this->request->getVar('kategoriSoal'),
            'name' => $this->request->getVar('isiSoal'),
            'is_picture' => $isPicture == "on" ? 1 : null,
            'picture_url' => $namaGambar,
            'is_audio' => $isAudio == "on" ? 1 : null,
            'audio_url' => $namaSuara,
            'is_choosen' => 1,
            'is_dp' => $isDP == "on" ? 1 : null,
            'is_tp' => $isDP == "on" ? null : 1
        ]);

        //ID terakhir yg di buat di tabel soal
        $db      = \Config\Database::connect();
        $lastID = $db->insertID();

        for ($x = 1; $x <= 5; $x++) {
            $val = $this->soalModel->getJumlahSoal($x);
            $this->kategoriModel->saveJumlah($x, $val);
        }

//        $this->soalModel->save([
//            'id' => $lastID,
//            'idx' => $lastID
 //       ]);

        $this->jawabanModel->save([
            'soal_id' => $lastID,
            'jawabanA' => $this->request->getVar('jawabanA') ? $this->request->getVar('jawabanA') : null,
            'jawabanB' => $this->request->getVar('jawabanB') ? $this->request->getVar('jawabanB') : null,
            'jawabanC' => $this->request->getVar('jawabanC') ? $this->request->getVar('jawabanC') : null,
            'jawabanD' => $this->request->getVar('jawabanD') ? $this->request->getVar('jawabanD') : null,
            'jawabanE' => $this->request->getVar('jawabanE') ? $this->request->getVar('jawabanE') : null,
            'jawaban_benar' => $this->request->getVar('jawabanBenar')
        ]);  
        
        //Sorting Record by Kategori Soal
        $this->soalModel->reSortIdx();

        return redirect()->to('../admin/soal');
    }

    public function upload()
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["picture_url"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
    }

    public function daftar(){
        $name = $this->request->getVar('namaUser');
        $slug = url_title($this->request->getVar('namaUser'), '-', true);
        $email = $this->request->getVar('emailUser');
        $hp = $this->request->getVar('hpUser');
        $asal = $this->request->getVar('asalUser');
        $jurusan = $this->request->getVar('jurusanUser');
        $username = $this->request->getVar('usernameUser');
        $password = $this->request->getVar('passwordUser') ;

        //dd($hp);

        //validation
        if(!$this->validate([
            'namaUser'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Nama tidak boleh kosong'
                    ]
            ],
            'emailUser'=>[
                'rules'=>'valid_email',
                'errors'=>[
                    'valid_email'=>'Alamat email harus benar'
                ]
            ],
            'hpUser'=>[
                'rules'=>'required|numeric',
                'errors'=>[
                    'numeric'=>'Nomor handphone harus berupa angka',
                    'required'=>'Nomor handphone harus diisi'
                ]
            ],
            'usernameUser'=>[
                'rules'=>'required|is_unique[user.username]',
                'errors'=>[
                    'required'=>'Username harus diisi',
                    'is_unique' =>'Username sudah terdaftar'
                ]
            ],
            'passwordUser'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Password harus ada'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            //dd($validation);
            return redirect()->to('/daftar')->withInput()->with('validation',$validation);
        }

        $this->userModel->save([
            'role_id' => 2,
            'name' => $name,
            'slug' => $slug,
            'asal' => $asal,
            'jurusan_id' => $jurusan,
            'status_id' => 1,
            'email' => $email,
            'hp' => $hp,
            'username' => $username,
            'password' => $password,
            'paket' => "demo"       
        ]);

        //ID terakhir yg di buat di tabel user
        $db      = \Config\Database::connect();
        $lastID = $db->insertID();

        $data = [
            'title' => 'Keperawatan | Daftar',
            'idx' => $lastID,
            'nama' => $name,
            'asal' => $asal,
            'jurusan' => $jurusan,
            'email' => $email,
            'hp' => $hp,
            'username' => $username,
            'password' => $password
        ];
    
        $this->userModel->save([
            'id' => $lastID,
            'idx' => $lastID
        ]);

        return view('admin/email',$data);
        //return redirect()->to('https://keperawatan.devinc.website');
    }

    public function pesan($id){

        $hpUser = "81214684065";
        $message = "ok";
        $data = [
            'title' => 'Keperawatan | Daftar',
            'hp' => $hpUser,
            'message' => $message
        ];
        
        $this->userSubcribeModel->save([
            'id' => $id,
            'is_message' => 1
        ]);

        //return view('admin/pesan',$data);
        return redirect()->to('https://perawat.devinc.website/admin/belipaket');
    }

    public function confirm($id){
        $this->userSubcribeModel->save([
            'id' => $id,
            'is_confirm' => 1
        ]);

        return redirect()->to('https://perawat.devinc.website/admin/belipaket');

    }

    public function review(){
        $boxNumber = $this->request->getVar('boxnumber');
        //return redirect()->to('../review');
        $data = [
            'boxNumber' => $boxNumber
        ];

        return view('exercise/selesai-review',$data);

    }
}
