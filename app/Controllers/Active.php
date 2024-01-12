<?php

namespace App\Controllers;

use App\Models\UserMDL;
use App\Models\UserInfoMDL;
use App\Models\SchoolMDL;
use App\Models\EventMDL;
use App\Models\ContentMDL;
use App\Models\EventContentMDL;
use App\Models\WaitContentMDL;

class Active extends BaseController
{
	protected $userModel, $userInfoModel, $schoolMOdel, $eventModel, $contentModel, $eventContentModel, $waitContentModel;

	public function __construct()
	{
		$this->userModel = new UserMDL();
		$this->userInfoModel = new UserInfoMDL();
		$this->schoolModel = new SchoolMDL();
		$this->eventModel = new EventMDL();
		$this->contentModel = new ContentMDL();
		$this->eventContentModel = new EventContentMDL();
		$this->waitContentModel = new WaitContentMDL();
	}

	public function index()
	{
	}

	public function mahasiswa($id)
	{
		$this->userModel->setActive($id);
		return redirect()->to('../admin/mahasiswa');
	}

	public function administrator($id)
	{
		$this->userModel->setActive($id);
		return redirect()->to('../admin/administrator');
	}

	public function jadwal($id)
	{
		$this->eventModel->setActive($id);

		$this->waitContentModel->deleteWait($id);

		$queryAuto = $this->eventModel->searchByID($id)->findAll();
		foreach ($queryAuto as $qa) :
			if ($qa['is_auto_user'] == 1) {
				$autoUser = 1;
			} else {
				$autoUser = 0;
			}
			if ($qa['is_auto_content'] == 1) {
				$autoContent = 1;
			} else {
				$autoContent = 0;
			}
			$subjectsID = $qa['subjects_id'];
			$categoryID = $qa['event_category_id'];
			$classID = $qa['class_id'];
		endforeach;

		if ($autoContent == 1) {
			$totalContent = $this->contentModel->getTotalContent($categoryID, $classID, $subjectsID);
			$eventID = $this->eventModel->getLastID();
			foreach ($totalContent as $tc) :
				if ($tc['is_choosen'] == 1) {
					$this->waitContentModel->waitAdd($eventID, $tc['id']);
				}
			endforeach;
		}

		// if ($autoUser == 1) {
		// 	$totalUser = $this->userModel->getStudentUser();
		// 	$eventID = $this->eventModel->getLastID();
		// 	foreach ($totalUser as $tu) :
		// 		if ($tu['class_id'] == $classID) {
		// 			$this->waitUserModel->addWait($eventID, $tu['id']);
		// 		}
		// 	endforeach;
		// }

		return redirect()->to('../admin/jadwal');
	}

	public function materi($id)
	{
		$content = $this->contentModel->getContentByID($id);
		foreach ($content as $cnt) :
			$this->contentModel->setActive($id);
			$choosen = $this->contentModel->getChoosen($id);
			if ($choosen == 1) {
				$this->waitContentModel->save([
					'content_id' => $id,
					'event_category_id' => $cnt['event_category_id'],
					'class_id' => $cnt['class_id'],
					'subjects_id' => $cnt['subjects_id']
				]);
			} else {
				$this->waitContentModel->deleteWait($id);
			}
			return redirect()->to('../admin/materi');
		endforeach;
	}
}
