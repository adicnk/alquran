<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolMDL extends Model
{
    protected $table = 'school';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['category_id', 'name', 'address', 'contact', 'phone'];

    public function getSchool($schoolID = false)
    {
        if ($schoolID == false) {
            return $this->findAll();
        }

        $schoolByID = $this->where(['id' => $schoolID])->findAll();

        if ($schoolByID) {
            return $schoolByID;
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
