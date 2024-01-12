<?php

namespace App\Controllers;

use App\Models\UserMDL;
use App\Models\UserInfoMDL;
use App\Models\SchoolMDL;
use App\Models\EventMDL;
use App\Models\ClassMDL;
use App\Models\EventContentMDL;

class Login extends BaseController
{

	protected $userModel, $userInfoModel, $schoolModel, $eventModel, $classModel, $eventContentModel;

	public function __construct()
	{
		$this->userModel = new UserMDL();
		$this->userInfoModel = new UserInfoMDL();
		$this->schoolModel = new SchoolMDL();
		$this->eventModel = new EventMDL();
		$this->classModel = new ClassMDL();
		$this->eventContentModel = new EventContentMDL();
	}

	public function index()
	{

		$data = [
			'title'   => "Login Ujian - STIKep PPNI Bandung"
		];

		return view('/pages/login', $data);
	}

	public function submit()
	{

		$userEmail = $this->request->getVar('email');
		$userPassword = $this->request->getVar('password');
		$authLogin = $this->userModel->authLoginUjian($userEmail, $userPassword); //is user correct
		$isActive = $this->userModel->isActive($userEmail); //is user active
		$isStart = $this->userModel->isStart($userEmail); //is user active

		$ujian = $this->request->getVar('ujian');

		if (!$authLogin) {
			// Menambahkan flash message di menu jika authorisasi gagal
			session()->setFlashdata('message', 'Username atau Password anda salah');
			return redirect()->to('/');
		}

		if (!$isActive) {
			session()->setFlashdata('message', 'Anda bukan peserta ujian');
			return redirect()->to('/');
		}

		//Error message if back button pressed repeatly
		if ($isStart) {
			return redirect()->to('../error/back');
		}

		$event = $this->eventModel->getActiveEvent(1);
		$user = $this->userModel->getUser($userEmail);

		$userevent = $this->userModel->getUserEvent($userEmail, $event);
		if (!$userevent) {
			session()->setFlashdata('message', 'Belum ada jadwal ujian di prodi anda');
			return redirect()->to('/');
		}

		foreach ($event as $ev) :

			foreach ($user as $usr) :
				// check if user in active event 
				if ($ev['class_id'] == $usr['class_id']) :

					// scrambling question	
					$totalQuestion = $ev['total_content'];
					$questionArr = array_fill(1, $totalQuestion, "");
					$arrFill = 1;
					for ($x = 0; $x = 1000; $x++) {
						$randID = rand(1, $totalQuestion);
						if (!in_array($randID, $questionArr)) {
							$questionArr[$arrFill] = $randID;
							$arrFill++;
							if ($arrFill == $totalQuestion + 1) {
								break;
							}
						}
					}

					// array for answer
					$answer = array_fill(1, $totalQuestion, ""); // Fill flag with blank question for not answer
					$doubtanswer = array_fill(1, $totalQuestion, ""); // Fill flag with a doubt answer
					$rightanswer = array_fill(1, $totalQuestion, 0);

					// $answer['1'] = "A";

					$data = [
						'title'   => $this->request->getVar('ujian'),
						'school' => $this->schoolModel->getSchool(1),
						'event' => $event,
						'user' => $user,
						'eventcontent' => $this->eventContentModel->getEventContent($ev['id']), //Flag when the event being held
						'startnumber' => 0, // Flag for number of question
						'question' => $questionArr, // Flag for scrambling question
						'doneanswer' => $answer, // Flag for questions being answer
						'doubtanswer' => $doubtanswer, // Flag for doubtful question
						'rightanswer' => $rightanswer, //Flag for right answer
						'isAnswer' => "", // Flag for current answer question
						'is_start' => 0, // Flag for starting the test, default is not start						
						'score' => 0, // Flag for scoring result
						'bg' => 0, // Flag for background class
						'bg_red' => "background-color:rgba(111, 173, 78, 0.7)",
						'bg_blue' => "background-color:rgba(128, 127, 128, 0.5)"
					];

					$data = session()->set($data);
					return redirect()->to('../ujian');
				endif;
				session()->setFlashdata('message', 'Anda belum waktunya ujian');
				return redirect()->to('/');
			endforeach;
		endforeach;
	}
}
