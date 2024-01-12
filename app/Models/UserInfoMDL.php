<?php

namespace App\Models;

use CodeIgniter\Model;

class UserInfoMDL extends Model
{
    protected $table = 'user_info';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['user_id', 'school_id', 'class_id', 'name', 'nim', 'nip'];

    public function getUserInfo($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        $allInfoByUser = $this->where(['user_id' => $id])->findAll();

        if ($allInfoByUser) {
            return $allInfoByUser;
        } else {
            return "No Data";
        }
    }

    public function search($keyword = false)
    {
        if ($keyword == false) {
            $this->table('user_info');
            $this->where(['role_id' => 1]); // User is Student
            return $this->join('user', 'user.id =user_info.user_id');
        }
        $this->table('user_info');
        $this->where(['role_id' => 1]); // User is Student
        $this->join('user', 'user.id =user_info.user_id');
        return  $this->like('nim', $keyword);
    }

    public function filter($filter = false)
    {
        if ($filter == false) {
            $this->table('user_info');
            $this->where(['role_id' => 1]); // User is Student
            return $this->join('user', 'user.id =user_info.user_id');
        }
        $this->table('user_info');
        $this->where(['role_id' => 1]); // User is Student
        $this->join('user', 'user.id =user_info.user_id');
        return  $this->where(['class_id' => $filter]);
    }

    public function searchAdmin($keyword = false)
    {
        if ($keyword == false) {
            $this->table('user_info');
            $this->where(['role_id' => 2]); // User is Administrator
            return $this->join('user', 'user.id =user_info.user_id');
        }
        $this->table('user_info');
        $this->where(['role_id' => 2]); // User is Administrator
        $this->join('user', 'user.id =user_info.user_id');
        return  $this->like('name', $keyword);
    }

    public function setUserInfo($data, $id)
    {
        $this->set($data);
        $this->where(['user_id' => $id]);
        $this->update();
    }

    public function delUserInfo($id)
    {
        $this->where(['user_id' => $id]);
        $this->delete();
    }
}
