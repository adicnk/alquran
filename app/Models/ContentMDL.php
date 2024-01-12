<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentMDL extends Model
{
    protected $table = 'content';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['class_id', 'event_category_id', 'subjects_id', 'question', 'question_index', 'content_type_id', 'description', 'is_choosen', 'tag'];

    public function getContent($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        $content = $this->where(['id' => $id])->findAll();

        if ($content) {
            return $content;
        } else {
            return "No Data";
        }
    }

    public function getTotalContent($eventCategoryID, $classID, $subjectsID)
    {
        // dd($subjectsID);
        $this->where(['event_category_id' => $eventCategoryID]);
        $this->where(['class_id' => $classID]);
        $this->where(['subjects_id' => $subjectsID]);
        return $this->findAll();
    }

    public function getContentByID($id)
    {
        $this->where(['id' => $id]);
        return $this->findAll();
    }

    public function countIndex($id)
    {
        $this->where(['class_id' => $id]);
        $this->selectCount('class_id');
        $query = $this->get();
        foreach ($query->getResult('array') as $cc) :
            return $cc['class_id'];
        endforeach;
    }

    public function search($keyword = false)
    {
        if ($keyword == false) {
            return $this->findAll();
        }
        return  $this->like('question', $keyword);
    }

    public function searchClass($filter)
    {
        if ($filter == false) {
            return $this->findAll();
        }
        return  $this->like('class_id', $filter);
    }

    public function getLastID()
    {
        $this->orderBy('id', 'DESC');
        $query = $this->findAll();
        foreach ($query as $curr) :
            return $curr['id'];
        endforeach;
    }

    public function setActive($id)
    {
        $this->where(['id' => $id]);
        $query1 = $this->findAll();
        foreach ($query1 as $q1) :
            $isActive = $q1['is_choosen'];
        endforeach;
        $this->where(['id' => $id]);
        if ($isActive == 1) {
            $this->set('is_choosen', 0);
        } else {
            $this->set('is_choosen', 1);
        }
        $this->update();
    }

    public function getChoosen($id)
    {
        $this->where(['id' => $id]);
        $query = $this->findAll();
        foreach ($query as $qc) {
            return $qc['is_choosen'];
        }
    }

    public function delContent($id)
    {
        $this->delete(['id' => $id]);
    }
}
