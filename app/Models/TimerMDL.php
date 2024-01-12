<?php

namespace App\Models;

use CodeIgniter\Model;

class TimerMDL extends Model
{
    protected $table = 'timer';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['second', 'minute', 'hour'];

    public function getTimer()
    {
        $second = $this->where(['id' => 1])->findAll();

        if ($second) {
            return $second;
        } else {
            return "No Data";
        }
    }

    public function getItemID($supplierID, $productID)
    {
        $this->where(['supplier_id' => $supplierID]);
        $this->where(['product_id' => $productID]);
        return $this->findAll();
    }

    public function addItem($supplierID, $productID)
    {
        $itemData = [
            'supplier_id' => $supplierID,
            'product_id' => $productID
        ];
        $this->insert($itemData);
    }

    public function deleteItem($id)
    {
        $this->delete(['id' => $id]);
    }

    public function delRecordSupplier($id)
    {
        $this->where(['supplier_id' => $id]);
        $this->delete();
    }
}
