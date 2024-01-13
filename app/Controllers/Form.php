<?php

namespace App\Controllers;

use App\Models\UserMDL;
use App\Models\KategoriMDL;

class Form extends BaseController
{
    protected $userModel, $kategoriModel;

    public function __construct()
    {
        $this->userModel = new UserMDL();
        $this->kategoriModel = new KategoriMDL();
    }

    public function admin()
    {
        // d($this->request->getVar('url'));
        $data = [
            'title'   => "Form User Administrator / Mahasiswa",
            'url' => $this->request->getVar('url')
        ];
        return view('form/user', $data);
    }

    public function soal()
    {
        // d($this->request->getVar('url'));
        $data = [
            'title'   => "Form Soal",
            'kategori_soal' => $this->kategoriModel->findAll()
        ];
        return view('form/soal', $data);
    }
}
