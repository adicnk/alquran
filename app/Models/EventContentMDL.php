<?php

namespace App\Models;

use CodeIgniter\Model;

class EventContentMDL extends Model
{
    protected $table = 'event_content';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['event_id', 'content_id'];

    public function getEventContent($event)
    {
        $this->where(['event_id' => $event]);
        $contentByEvent =  $this->findAll();

        if ($contentByEvent) {
            return $contentByEvent;
        } else {
            return "No Data";
        }
    }

    public function getContentID($id)
    {
        $this->where(['id' => $id]);
        $sq = $this->findAll();
        foreach ($sq as $s) :
            return $s;
        endforeach;
    }

    public function delContent($id)
    {
        $this->where(['content_id' => $id]);
        $this->delete();
    }

    public function delRecordSupplier($id)
    {
        $this->where(['supplier_id' => $id]);
        $this->delete();
    }
}
