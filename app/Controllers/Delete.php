<?php

namespace App\Controllers;

use App\Models\UserMDL;
use App\Models\UserInfoMDL;
use App\Models\EventMDL;
use App\Models\ContentMDL;
use App\Models\ContentOptionMDL;
use App\Models\WaitContentMDL;

class Delete extends BaseController
{
	protected $userModel, $userInfoModel, $eventModel, $contentModel, $contentOptionModel, $waitContentModel;

	public function __construct()
	{
		$this->userModel = new UserMDL();
		$this->userInfoModel = new UserInfoMDL();
		$this->eventModel = new EventMDL();
		$this->contentModel = new ContentMDL();
		$this->contentOptionModel = new ContentOptionMDL();
		$this->waitContentModel = new WaitContentMDL();
	}

	public function index()
	{
	}

	public function mahasiswa($id)
	{
		$this->userModel->delUser($id);
		$this->userInfoModel->delUserInfo($id);
		return redirect()->to('/admin/mahasiswa');
	}

	public function administrator($id)
	{
		$this->userModel->delUser($id);
		$this->userInfoModel->delUserInfo($id);
		return redirect()->to('/admin/administrator');
	}

	public function jadwal($id)
	{
		$this->eventModel->delEvent($id);
		$this->waitContentModel->deleteWait($id);
		return redirect()->to('/admin/jadwal');
	}

	public function materi($id)
	{
		$this->contentModel->delContent($id);
		$this->contentOptionModel->delContentOption($id);
		$this->waitContentModel->deleteWait($id);
		return redirect()->to('/admin/materi');
	}
}
