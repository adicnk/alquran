<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassMDL extends Model
{
    protected $table = 'class';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['name'];

    public function getClass($classID = false)
    {
        $classByUser = $this->where(['id' => $classID])->findAll();

        if ($classByUser) {
            return $classByUser;
        } else {
            return "No Data";
        }
    }

    public function historyByClass($classID)
    {
        $this->join('user_info', 'user_info.class_id = class.id');
        $this->join('user_history', 'user_history.user_id = user_info.user_id');
        $this->where(['class.id' => $classID]);
        // dd($this->findAll());
        return $this->findAll();
    }
}
