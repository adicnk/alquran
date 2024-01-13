<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfigMDL extends Model
{
    protected $table = 'config';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['total_soal', 'total_soal_demo', 'total_soal_bronze', 'total_soal_silver', 'total_soal_diamond', 'total_soal_premuium'];

    public function totalSoal($user)
    {
        $this->where(['id' => 1]);
        $query = $this->findAll();
        foreach ($query as $q) {
            $paketA = $q['total_soal_demo'];
            $paketB = $q['total_soal_bronze'];
            $paketC = $q['total_soal_silver'];
            $paketD = $q['total_soal_diamond'];
            $paketE = $q['total_soal_premium'];
        }
        foreach ($user as $usr) {
            switch ($usr['paket']) {
                case "demo" :
                    return $paketA;
                    break;
                case "bronze" :
                    return $paketB;
                    break;
                case "silver" :
                    return $paketC;
                    break;
                case "diamond" :
                    return $paketD;
                    break;
                case "premium" :
                    return $paketE;
                    break;
            }
        }
    }

    public function addTotalSoal($val=0){
        $this->where(['id' => 1]);
        $query = $this->findAll();
        foreach ($query as $q) {
            $val = $q['total_soal']+1;
            $this->set('total_soal', $val);
            $this->update();            
        }
    }

    public function subtractTotalSoal($val=0){
        $this->where(['id' => 1]);
        $query = $this->findAll();
        foreach ($query as $q) {
            $val = $q['total_soal']-1;
            $this->set('total_soal', $val);
            $this->update();            
        }
    }    

    public function nilaiMinimum()
    {
        $this->where(['id' => 1]);
        $query = $this->findAll();
        foreach ($query as $q) {
            return $q['nilai_min'];
        }
    }
}
