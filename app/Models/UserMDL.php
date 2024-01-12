<?php

namespace App\Models;

use CodeIgniter\Model;

class UserMDL extends Model
{
    protected $table = 'user';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['role_id', 'email', 'password', 'is_active', 'is_start'];

    public function authLoginUjian($email, $password)
    {
        $this->where(['email' => $email]);
        $this->where(['password' => $password]);
        $this->where(['role_id' => 1]); // is student
        return $this->findAll();
    }

    public function authLoginAdmin($email, $password)
    {
        $this->where(['email' => $email]);
        $this->where(['password' => $password]);
        $this->where(['is_active' => 1]);
        $this->where(['role_id' => 2]); // is administrator
        return $this->findAll();
    }

    public function isActive($email) // is user active
    {
        $this->where(['email' => $email]);
        $this->where(['is_active' => 1]);
        return $this->findAll();
    }

    public function setRecovery($id)
    {
        // If error message when user login
        // the back button reatly pressed
        $this->set('is_start', 0);
        $this->where(['id' => $id]);
        $this->update();
    }

    public function setActive($id)
    {
        $this->where(['id' => $id]);
        $query1 = $this->findAll();
        foreach ($query1 as $q1) :
            $isActive = $q1['is_active'];
        endforeach;
        $this->where(['id' => $id]);
        if ($isActive == 1) {
            $this->set('is_active', 0);
        } else {
            $this->set('is_active', 1);
        }
        $this->update();
    }

    public function isStart($email) // is user already start the test
    {
        $this->where(['email' => $email]);
        $this->where(['is_start' => 1]);
        $result = $this->findAll();
        if ($result) {
            return true;
        }
        return false;
    }

    public function getUser($email)
    {
        if ($email == false) {
            return $this->findAll();
        }

        $arrayUser = $this->where(['email' => $email])->findAll();
        $idUser = null;
        foreach ($arrayUser as $as) :
            $idUser = $as['id'];
        endforeach;

        if ($idUser) {
            // "SELECT * FROM user u JOIN user_info ui ON u.id = ui.user_id WHERE u.email =".$email;
            $this->where(['email' => $email]);
            $this->where(['role_id' => 1]); // User is Student
            $this->join('user_info', 'user_info.user_id =' . $idUser);
            return $this->findAll();
        } else {
            return "No Data";
        }
    }

    public function getUserEvent($email, $classID)
    {

        $arrayUser = $this->where(['email' => $email])->findAll();
        $idUser = null;
        foreach ($arrayUser as $as) :
            $idUser = $as['id'];
        endforeach;

        if ($idUser) {
            $this->where(['email' => $email]);
            $this->where(['role_id' => 1]); // User is Student
            $this->join('user_info', 'user_info.user_id =' . $idUser);
            $this->join('event', 'event.class_id = user_info.class_id');
            return $this->findAll();
        }
    }

    public function getUserAdmin($email)
    {
        if ($email == false) {
            return $this->findAll();
        }

        $arrayUser = $this->where(['email' => $email])->findAll();
        $idUser = null;
        foreach ($arrayUser as $as) :
            $idUser = $as['id'];
        endforeach;

        if ($idUser) {
            // "SELECT * FROM user u JOIN user_info ui ON u.id = ui.user_id WHERE u.email =".$email;
            $this->where(['email' => $email]);
            $this->where(['role_id' => 2]); // User is Administrator
            $this->join('user_info', 'user_info.user_id =' . $idUser);
            return $this->findAll();
        } else {
            return "No Data";
        }
    }

    public function getUserByID($id)
    {
        // "SELECT * FROM user u JOIN user_info ui ON u.id = ui.user_id WHERE u.email =".$email;
        $this->where(['id' => $id]);
        $this->where(['role_id' => 1]); // User is Student
        $this->join('user_info', 'user_info.user_id =' . $id);
        return $this->findAll();
    }

    public function getUserAdminByID($id)
    {
        // "SELECT * FROM user u JOIN user_info ui ON u.id = ui.user_id WHERE u.email =".$email;
        $this->where(['id' => $id]);
        $this->where(['role_id' => 2]); // User is Administrator
        $this->join('user_info', 'user_info.user_id =' . $id);
        return $this->findAll();
    }

    public function delUser($id)
    {
        $this->delete(['id' => $id]);
    }

    public function delRecordUser($id)
    {
        $this->where(['supplier_id' => $id]);
        $this->delete();
    }

    public function getUserID()
    {
        $this->orderBy('id', 'DESC');
        $user = $this->findAll();
        foreach ($user as $usr) :
            return $usr['id'];
        endforeach;
    }

    public function getStudentUser()
    {
        $this->where(['role_id' => 1]);
        $this->where(['is_active' => 1]);
        $this->join('user_info', 'user_info.user_id=user.id');
        return $this->findAll();
    }

    public function getStudentClassActive($classID)
    {
        $this->where(['role' => 1]);
        $this->where(['is_active' => 1]);
        $this->join('user_info', 'user_info.user_id = user.id');
        return $this->findAll();
    }
}
