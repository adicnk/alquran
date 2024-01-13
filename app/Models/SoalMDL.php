<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalMDL extends Model
{
    protected $table = 'soal';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['name', 'idx', 'kategori_soal_id', 'is_picture', 'picture_url', 'is_audio', 'audio_url', 'is_choosen', 'is_tp', 'is_dp'];

    public function searchSoal($keyword = false)
    {
        if ($keyword == false) {
            $this->table('soal');
            $this->join('kategori_soal', 'soal.kategori_soal_id = kategori_soal.id');
            return $this->like('kategori_soal_id', 1);
        }
        $this->table('soal');
        $this->join('kategori_soal', 'soal.kategori_soal_id = kategori_soal.id');
        return  $this->like('kategori_soal_id', $keyword);
    }

    public function searchSoalID($id)
    {
        $this->where(['id' => $id]);
        return $this->findAll();
    }

    public function searchSoalIDX($cat,$id)
    {
        $this->where(['kategori_soal_id' => $cat]);
        $this->where(['idx' => $id]);
        return $this->findAll();
    }


    public function getJumlahSoal($id)
    {
        $this->where(['kategori_soal_id' => $id]);
        $this->join('kategori_soal', 'soal.kategori_soal_id = kategori_soal.id');
        return $this->countAllResults();
    }

    public function getName($id)
    {        
        $this->where(['id' => $id]);
        $query =  $this->findAll();
        foreach ($query as $q) {
            return $q['picture_url'];
        }
    }

    public function getSoalID($cat,$idx){
        $this->where(['kategori_soal_id' => $cat]);
        $this->where(['idx' => $idx]);
        $query =  $this->findAll();
        foreach ($query as $q) {
            return $q['id'];
        }
    }

    public function delSoal($id)
    {
        $this->delete(['idx' => $id]);
    }

    public function isChoosen()
    {
        $this->where(['is_choosen' => 1]);
        $this->join('jawaban', 'jawaban.soal_id = soal.id');
        return $this->findAll();
    }

    public function isTP()
    {
        $this->where(['is_tp' => 1]);
        $this->join('jawaban', 'jawaban.soal_id = soal.id');
        return $this->findAll();
    }

    public function isDP()
    {
        $this->where(['is_dp' => 1]);
        $this->join('jawaban', 'jawaban.soal_id = soal.id');
        return $this->findAll();
    }

    public function  isChoosenStatus($id) {

        $this->where(['id' => $id]);
        $query =  $this->findAll();
        foreach ($query as $q) {
            if ($q['is_choosen']==1) {
                return "on";
            } else {
                return "off";
            };
        }

    }

    public function soalBuilder($kategori,$limit){
        $this->where(['kategori_soal_id' => $kategori]);
        $this->join('jawaban', 'jawaban.soal_id = soal.id');
        $this->orderby('idx ASC');
        $this->limit((int)$limit);
        return $this->findAll();        
    }

    public function searchJawabanSoalIdx($id, $value)
    {
        $this->where(['soal.idx' => $id]);
        $this->join('jawaban', 'jawaban.soal_id = soal.id');
        $query =  $this->findAll();
        foreach ($query as $q) {
                if ($q['jawaban_benar'] == $value) {
                    return true;
                } else {
                    return false;
                }  
        }
    }

    public function countAllUjian()
    {
        $this->where(['is_choosen' => 1]);
        return $this->countAllResults();
    }

    public function reSortIdx(){
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_soal');    
        $query = $builder->get();
        
        foreach ($query->getResult() as $q){
            $index=0;
            $idk = $q->id;

            $this->where('kategori_soal_id', $idk);        
            $querySort=$this->findAll();
            foreach ($querySort as $qs) :
                $id = $qs['id'];
                $idx_new= $index+1;
                $this->set('idx', $idx_new);
                $this->where('id', $id);        
                $this->update();
                $index++;
            endforeach; 
        }
    }
    
    public function sortTPDP(){
        $db      = \Config\Database::connect();
        $builder = $db->table('soal');
    
        $builder->where('is_tp',1);
        $query = $builder->get();
        $index= 0;
    
        foreach ($query->getResult() as $q){
            $id = $q->id;    
            $idx_new= $index+1;
            $builder->set('idx', $idx_new);
            $builder->where('id', $id);        
            $builder->update();
            $index++;
        }
    
        $index=0;
        $this->where(['is_dp' => 1]);
        $queryDP = $this->findAll();
        foreach ($queryDP as $q){
            $id = $q['id'];    
            $idx_new= $index+1;
            $builder->set('idx', $idx_new);
            $builder->where('id', $id);        
            $builder->update();
            d($id);
            $index++;
        }
    }
}
