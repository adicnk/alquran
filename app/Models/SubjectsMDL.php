<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectsMDL extends Model
{
    protected $table = 'subjects';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['name'];

    public function getSubject($id)
    {
        $subjects = $this->where(['id' => $id])->findAll();

        if ($subjects) {
            foreach ($subjects as $qs) :
                return $qs['name'];
            endforeach;
        } else {
            return "";
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
