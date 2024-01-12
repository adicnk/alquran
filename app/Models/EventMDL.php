<?php

namespace App\Models;

use CodeIgniter\Model;

class EventMDL extends Model
{
    protected $table = 'event';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['school_id', 'event_category_id', 'class_id', 'name', 'date', 'date_end', 'is_active', 'total_content', 'duration', 'min_pass', 'subjects_id', 'is_auto_user', 'is_auto_content', 'is_loaded'];

    public function getEvent($school, $active)
    {
        $this->where(['school_id' => $school]);
        $this->where(['is_active' => $active]);
        return $this->findAll();
    }

    public function getActiveEvent($school)
    {
        $this->where(['school_id' => $school]);
        $this->where(['is_active' => 1]);
        return $this->findAll();
    }

    public function getTotalContent($id)
    {
        $this->where(['id' => $id]);
        return $this->findAll();
    }

    public function getEventCategory($id)
    {
        $this->where(['event_category_id' => $id]);
        return $this->findAll();
    }

    public function search($keyword = false)
    {
        if ($keyword == false) {
            return $this->findAll();
        }
        return  $this->like('name', $keyword);
    }

    public function searchClass($filter = false)
    {
        if ($filter == false) {
            return $this->findAll();
        }
        return  $this->where('class_id', $filter);
    }

    public function searchByID($id)
    {
        return  $this->where('id', $id);
    }

    public function searchCategory($filter, $subjects = false)
    {
        if ($subjects == false) {
            return $this->where('event_category_id', $filter);
        }
        $this->where('event_category_id', $filter);
        return $this->where('subjects_id', $subjects);
    }

    public function delEvent($id)
    {
        $this->delete(['id' => $id]);
    }

    public function getEventByID($id)
    {
        $this->where(['id' => $id]);
        return $this->findAll();
    }

    public function setActive($id)
    {
        $this->where(['id' => $id]);
        $query1 = $this->findAll();
        foreach ($query1 as $q1) :
            $isActive = $q1['is_active'];
            $isAutoUser = $q1['is_auto_user'];
            $isAutoContent = $q1['is_auto_content'];
        endforeach;
        $this->where(['id' => $id]);
        if ($isActive == 1) {
            $this->set('is_active', 0);
            $this->set('is_auto_user', 0);
            $this->set('is_auto_content', 0);
        } else {
            $this->set('is_active', 1);
            $this->set('is_auto_user', 1);
            $this->set('is_auto_content', 1);
            $this->set('is_loaded', 0);
        }
        $this->update();
    }

    public function getLastID()
    {
        $this->orderBy('id', 'DESC');
        $query = $this->findAll();
        foreach ($query as $curr) :
            return $curr['id'];
        endforeach;
    }
}
