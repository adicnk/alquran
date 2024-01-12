<?php

namespace App\Models;

use CodeIgniter\Model;

class WaitContentMDL extends Model
{
    protected $table = 'wait_content';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['content_id', 'event_category_id', 'class_id', 'subjects_id'];

    public function waitAdd($waitData)
    {
        $this->set($waitData);
        $this->insert();
    }

    public function updateWait($contentID, $waitData)
    {
        $this->set($waitData);
        $this->where(['content_id' => $contentID]);
        $this->update();
    }

    public function deleteWait($contentID)
    {
        $this->where(['content_id' => $contentID]);
        $this->delete();
    }

    public function getCount()
    {
        return $this->countAll();
    }
}
