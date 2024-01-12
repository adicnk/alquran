<?php

namespace App\Models;

use CodeIgniter\Model;

class UserHistoryMDL extends Model
{
    protected $table = 'user_history';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['event_id', 'user_id', 'score'];

    public function getUserHistory($user)
    {
        $historyByUser = $this->where(['user_id' => $user])->findAll();

        if ($historyByUser) {
            return $historyByUser;
        }
    }

    public function setUserHistory($user, $event, $score)
    {
        $historyData = [
            'user_id' => $user,
            'event_id' => $event,
            'score' => $score
        ];
        $this->insert($historyData);
    }

    public function countHistory($user)
    {
        return $this->countAll->get();
    }

    public function delRecordSupplier($id)
    {
        $this->where(['supplier_id' => $id]);
        $this->delete();
    }
}
