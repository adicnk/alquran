<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentOptionMDL extends Model
{
    protected $table = 'content_option';
    protected $useTimestamps = true;

    // Field yang boleh diisi waktu saving data ** harus didefinisikan dulu **
    protected $allowedFields = ['content_id', 'option', 'option_char', 'answer', 'is_answer'];

    public function getRightAnswer($id)
    {
        $this->join('event_content', 'event_content.content_id = content_option.content_id');
        $this->where(['is_answer' => 1]);
        $this->where(['indexed' => $id]);
        foreach ($this->findAll() as $ra) :
            return $ra['option_char'];
        endforeach;
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

    public function delContentOption($id)
    {
        $this->where(['content_id' => $id]);
        $this->delete();
    }

    public function updateContent($id, $data, $option)
    {
        $this->set($data);
        $this->where(['content_id' => $id]);
        $this->where(['option' => $option]);
        $this->update();
    }
}
