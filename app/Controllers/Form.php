<?php

namespace App\Controllers;

use App\Models\UserMDL;
use App\Models\UserInfoMDL;
use App\Models\EventMDL;
use App\Models\ContentMDL;
use App\Models\ContentOptionMDL;
use App\Models\SubjectsMDL;
use App\Models\WaitContentMDL;

class Form extends BaseController
{
	protected $userModel, $userInfoModel, $eventModel, $contentModel, $contentOptionModel, $subjectsModel, $waitContentModel;

	public function __construct()
	{
		$this->userModel = new UserMDL();
		$this->userInfoModel = new UserInfoMDL();
		$this->eventModel = new EventMDL();
		$this->contentModel = new ContentMDL();
		$this->contentOptionModel = new ContentOptionMDL();
		$this->subjectsModel = new SubjectsMDL();
		$this->waitContentModel = new WaitContentMDL();
	}

	public function index()
	{
	}

	public function create($name)
	{
		switch ($name) {
			case "mahasiswa":
				$data = [
					'title'  => "Tambah Data Mahasiswa",
					'content'  => false,
					'validation' => \Config\Services::validation()
				];

				return view('/form/mahasiswa', $data);
				break;

			case "administrator":
				$data = [
					'title'  => "Tambah Data Administrator",
					'content'  => false,
					'validation' => \Config\Services::validation()
				];

				return view('/form/administrator', $data);
				break;

			case "jadwal":
				$data = [
					'title'  => "Tambah Jadwal Ujian",
					'content'  => false,
					'validation' => \Config\Services::validation()
				];

				return view('/form/jadwal', $data);
				break;

			case "materi":
				$data = [
					'title'  => "Tambah Materi Ujian",
					'content'  => false,
					'validation' => \Config\Services::validation()
				];

				return view('/form/materi', $data);
				break;
		}
	}

	public function edit($name, $id)
	{
		switch ($name) {
			case "mahasiswa":
				$user = $this->userModel->getUserByID($id);
				$data = [
					'title' => "Edit Mahasiswa",
					'user' => $user,
					'content'  => false,
					'validation' => \Config\Services::validation()
				];

				return view('/form/mahasiswa-edit', $data);
				break;

			case "administrator":
				$user = $this->userModel->getUserAdminByID($id);
				$data = [
					'title' => "Edit Administrator",
					'user' => $user,
					'content'  => false,
					'validation' => \Config\Services::validation()
				];

				return view('/form/administrator-edit', $data);
				break;

			case "jadwal":
				$event = $this->eventModel->getEventByID($id);
				$data = [
					'title' => "Edit Jadwal",
					'event' => $event,
					'content'  => false,
					'validation' => \Config\Services::validation()
				];
				return view('/form/jadwal-edit', $data);
				break;

			case "materi":
				$content = $this->contentModel->getContentByID($id);
				$data = [
					'title' => "Edit Materi",
					'content' => $content,
					'validation' => \Config\Services::validation()
				];
				return view('/form/materi-edit', $data);
				break;
		}
	}

	public function submit($name)
	{
		switch ($name) {
			case "mahasiswa":
				// Validating Data
				if (!$this->validate([
					'name' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'email' => [
						'rules' => 'required|valid_email',
						'errors' => [
							'required' => 'tidak boleh kosong',
							'valid_email' => 'harus menyertakan tanda @ dan email yang valid'
						]
					],
					'nim' => [
						'rules' => 'required|is_unique[user_info.nim]',
						'errors' => [
							'required' => 'tidak boleh kosong',
							'is_unique' => 'NIM sudah terdaftar'
						]
					],
					'password' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'konfirmasi' => [
						'rules' => 'required|matches[password]',
						'errors' => [
							'required' => 'tidak boleh kosong',
							'matches' => 'harus sama dengan password'
						]
					]
				])) {
					$validation = \Config\Services::validation();
					return redirect()->to('../../form/create/mahasiswa')->withInput()->with('validation', $validation);
				}

				$this->userModel->save([
					'role_id' => 1,
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
					'is_active' => 1,
					'is_start' => 0
				]);

				$this->userInfoModel->save([
					'user_id' => $this->userModel->getUserID(),
					'school_id' => 1,
					'class_id' => $this->request->getVar('major'),
					'name' => $this->request->getVar('name'),
					'nim' => $this->request->getVar('nim')
				]);

				session()->setFlashdata('message', $this->request->getVar('name') . ' berhasil ditambahkan');

				return redirect()->to('../../admin/mahasiswa');
				break;

			case "administrator":
				// Validating Data
				if (!$this->validate([
					'name' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'email' => [
						'rules' => 'required|valid_email',
						'errors' => [
							'required' => 'tidak boleh kosong',
							'valid_email' => 'harus menyertakan tanda @ dan email yang valid'
						]
					],
					'nip' => [
						'rules' => 'required|is_unique[user_info.nim]',
						'errors' => [
							'required' => 'tidak boleh kosong',
							'is_unique' => 'NIP sudah terdaftar'
						]
					],
					'password' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'konfirmasi' => [
						'rules' => 'required|matches[password]',
						'errors' => [
							'required' => 'tidak boleh kosong',
							'matches' => 'harus sama dengan password'
						]
					]
				])) {
					$validation = \Config\Services::validation();
					return redirect()->to('../../form/create/administator')->withInput()->with('validation', $validation);
				}

				$this->userModel->save([
					'role_id' => 2,
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
					'is_active' => 1,
					'is_start' => 0
				]);

				$this->userInfoModel->save([
					'user_id' => $this->userModel->getUserID(),
					'school_id' => 1,
					'name' => $this->request->getVar('name'),
					'nip' => $this->request->getVar('nip')
				]);

				session()->setFlashdata('message', $this->request->getVar('name') . ' berhasil ditambahkan');

				return redirect()->to('../../admin/administrator');
				break;

			case "jadwal":
				// Validating Data
				if (!$this->validate([
					'name' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'total' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'durasi' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'min-pass' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					]
				])) {
					$validation = \Config\Services::validation();
					return redirect()->to('../../form/create/jadwal')->withInput()->with('validation', $validation);
				}

				if ($this->request->getVar('auto-user')) {
					$autoUser = 1;
				} else {
					$autoUser = 0;
				}

				if ($this->request->getVar('auto-content')) {
					$autoContent = 1;
				} else {
					$autoContent = 0;
				}

				$date = $this->request->getVar('date');
				$time = $this->request->getVar('time');
				$duration = $this->request->getVar('durasi');

				$dateStart = date($date . " " . $time);
				$stamptime = strtotime($date . " " . $time);
				$date_end =  date('Y-m-d H:i', $stamptime + 60 * $duration);

				if ($this->request->getVar('subjects')) {
					$subjects = $this->request->getVar('subjects');
				} else {
					$subjects = 0;
				}

				$this->eventModel->save([
					'school_id' => 1,
					'event_category_id' => $this->request->getVar('kategori'),
					'class_id' => $this->request->getVar('major'),
					'subjects_id' => $subjects,
					'name' => $this->request->getVar('name'),
					'is_active' => 1,
					'total_content' => $this->request->getVar('total'),
					'is_auto_user' => $autoUser,
					'is_auto_content' => $autoContent,
					'date' => $date . " " . $time,
					'date_end' => $date_end,
					'duration' => $duration,
					'min_pass' => $this->request->getVar('min-pass'),
					'is_loaded' => 0
				]);

				if ($autoContent == 1) {
					$totalContent = $this->contentModel->getTotalContent($this->request->getVar('kategori'), $this->request->getVar('major'), $subjects);
					$eventID = $this->eventModel->getLastID();
					foreach ($totalContent as $tc) :
						if ($tc['is_choosen'] == 1) {
							$waitData = [
								'content_id' => $tc['id'],
								'event_category_id' => $this->request->getVar('kategori'),
								'class_id' => $this->request->getVar('major'),
								'subjects_id' => $subjects
							];
							$this->waitContentModel->waitAdd($waitData);
						}
					endforeach;
				}

				// if ($autoUser == 1) {
				// 	$totalUser = $this->userModel->getStudentUser();
				// 	$eventID = $this->eventModel->getLastID();
				// 	foreach ($totalUser as $tu) :
				// 		if ($tu['class_id'] == $this->request->getVar('major')) {
				// 			$this->waitUserModel->addWait($eventID, $tu['id']);
				// 		}
				// 	endforeach;
				// }

				session()->setFlashdata('message', $this->request->getVar('name') . ' berhasil ditambahkan');

				return redirect()->to('../../admin/jadwal');
				break;

			case "materi":
				// Validating Data
				// if (!$this->validate([
				// 	'name' => [
				// 		'rules' => 'required',
				// 		'errors' => [
				// 			'required' => 'tidak boleh kosong'
				// 		]
				// 	]
				// ])) {
				// 	$validation = \Config\Services::validation();
				// 	return redirect()->to('../../form/create/materi')->withInput()->with('validation', $validation);
				// }

				// dd($this->request->getVar());				

				$questionIndex = $this->contentModel->countIndex($this->request->getVar('major'));
				$kategori = $this->request->getVar('kategori');
				if ($kategori == 2) {
					$subjects = $this->request->getVar('subjects');
				} else {
					$subjects = 0;
				}

				$this->contentModel->save([
					'question' => $this->request->getVar('question'),
					'class_id' => $this->request->getVar('major'),
					'event_category_id' => $this->request->getVar('kategori'),
					'subjects_id' => $subjects,
					'question_index' => $questionIndex + 1,
					'description' => $this->request->getVar('description'),
					'is_choosen' => 1
				]);

				$contentID = $this->contentModel->getLastID();
				// Save to Wait Content
				$this->waitContentModel->save([
					'content_id' => $contentID,
					'event_category_id' => $this->request->getVar('kategori'),
					'class_id' => $this->request->getVar('major'),
					'subjects_id' => $subjects
				]);

				for ($x = 1; $x <= 5; $x++) {
					$choosen = 0;
					switch ($x) {
						case 1:
							if ($this->request->getVar('choosen') == $x) {
								$choosen = 1;
							}
							$this->contentOptionModel->save([
								'content_id' => $contentID,
								'option' => $x,
								'option_char' => "A",
								'answer' => $this->request->getVar('answerA'),
								'is_answer' => $choosen
							]);
							break;
						case 2:
							if ($this->request->getVar('choosen') == $x) {
								$choosen = 1;
							}
							$this->contentOptionModel->save([
								'content_id' => $contentID,
								'option' => $x,
								'option_char' => "B",
								'answer' => $this->request->getVar('answerB'),
								'is_answer' => $choosen
							]);
							break;
						case 3:
							if ($this->request->getVar('choosen') == $x) {
								$choosen = 1;
							}
							$this->contentOptionModel->save([
								'content_id' => $contentID,
								'option' => $x,
								'option_char' => "C",
								'answer' => $this->request->getVar('answerC'),
								'is_answer' => $choosen
							]);
							break;
						case 4:
							if ($this->request->getVar('choosen') == $x) {
								$choosen = 1;
							}
							$this->contentOptionModel->save([
								'content_id' => $contentID,
								'option' => $x,
								'option_char' => "D",
								'answer' => $this->request->getVar('answerD'),
								'is_answer' => $choosen
							]);
							break;
						case 5:
							if ($this->request->getVar('choosen') == $x) {
								$choosen = 1;
							}
							$this->contentOptionModel->save([
								'content_id' => $contentID,
								'option' => $x,
								'option_char' => "E",
								'answer' => $this->request->getVar('answerE'),
								'is_answer' => $choosen
							]);
							break;
					}
				}

				session()->setFlashdata('message', 'soal ujian berhasil ditambahkan');

				return redirect()->to('../../admin/materi');
				break;
		}
	}

	public function update($name, $id)
	{
		switch ($name) {
			case "mahasiswa":
				// Validating Data
				if (!$this->validate([
					'name' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'email' => [
						'rules' => 'required|valid_email',
						'errors' => [
							'required' => 'tidak boleh kosong',
							'valid_email' => 'harus menyertakan tanda @ dan email yang valid'
						]
					],
					'password' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'konfirmasi' => [
						'rules' => 'required|matches[password]',
						'errors' => [
							'required' => 'tidak boleh kosong',
							'matches' => 'harus sama dengan password'
						]
					]
				])) {
					$validation = \Config\Services::validation();
					return redirect()->to('../../form/edit/mahasiswa/' . $id)->withInput()->with('validation', $validation);
				}

				$this->userModel->save([
					'id' => $id,
					'role_id' => 1,
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
					'is_active' => 1
				]);

				$data = [
					'class_id' => $this->request->getVar('major'),
					'name' => $this->request->getVar('name'),
					'nim' => $this->request->getVar('nimhidden')
				];
				$this->userInfoModel->setUserInfo($data, $id);

				session()->setFlashdata('message', $this->request->getVar('name') . ' berhasil diperbaharui');

				return redirect()->to('../../admin/mahasiswa');
				break;

			case "administrator":
				// Validating Data
				if (!$this->validate([
					'name' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'email' => [
						'rules' => 'required|valid_email',
						'errors' => [
							'required' => 'tidak boleh kosong',
							'valid_email' => 'harus menyertakan tanda @ dan email yang valid'
						]
					],
					'password' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'konfirmasi' => [
						'rules' => 'required|matches[password]',
						'errors' => [
							'required' => 'tidak boleh kosong',
							'matches' => 'harus sama dengan password'
						]
					]
				])) {
					$validation = \Config\Services::validation();
					return redirect()->to('../../form/edit/administrator/' . $id)->withInput()->with('validation', $validation);
				}

				$this->userModel->save([
					'id' => $id,
					'role_id' => 2,
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
					'is_active' => 1
				]);

				$data = [
					'name' => $this->request->getVar('name'),
					'nip' => $this->request->getVar('niphidden')
				];
				$this->userInfoModel->setUserInfo($data, $id);

				session()->setFlashdata('message', $this->request->getVar('name') . ' berhasil diperbaharui');

				return redirect()->to('../../admin/administrator');
				break;

			case "jadwal":
				// dd($this->request->getVar());
				// Validating Data
				if (!$this->validate([
					'name' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'total' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'durasi' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					],
					'min-pass' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'tidak boleh kosong'
						]
					]
				])) {
					$validation = \Config\Services::validation();
					return redirect()->to('../../form/create/jadwal')->withInput()->with('validation', $validation);
				}

				if ($this->request->getVar('auto-user')) {
					$autoUser = 1;
				} else {
					$autoUser = 0;
				}

				if ($this->request->getVar('auto-content')) {
					$autoContent = 1;
				} else {
					$autoContent = 0;
				}

				$date = $this->request->getVar('date');
				$time = $this->request->getVar('time');
				$duration = $this->request->getVar('durasi');

				$dateStart = date($date . " " . $time);
				$stamptime = strtotime($date . " " . $time);
				$date_end =  date('Y-m-d H:i:s', $stamptime + 60 * $duration);

				$this->eventModel->save([
					'id' => $id,
					'school_id' => 1,
					'event_category_id' => $this->request->getVar('kategori'),
					'class_id' => $this->request->getVar('major'),
					'name' => $this->request->getVar('name'),
					'is_active' => 1,
					'total_content' => $this->request->getVar('total'),
					'is_auto_user' => $autoUser,
					'is_auto_content' => $autoContent,
					'date' => $dateStart,
					'date_end' => $date_end,
					'duration' => $duration,
					'min_pass' => $this->request->getVar('min-pass'),
					'is_loaded' => 0
				]);

				session()->setFlashdata('message', $this->request->getVar('name') . ' berhasil diperbaharui');

				return redirect()->to('../../admin/jadwal');
				break;

			case "materi":
				$questionIndex = $this->contentModel->countIndex($this->request->getVar('major'));
				$kategori = $this->request->getVar('kategori');
				if ($kategori == 2) {
					$subjects =  $this->request->getVar('subjects');
				} else {
					$subjects = 0;
				}

				$this->contentModel->save([
					'id' => $id,
					'question' => $this->request->getVar('question'),
					'class_id' => $this->request->getVar('major'),
					'event_category_id' => $this->request->getVar('kategori'),
					'subjects_id' => $subjects,
					'question_index' => $questionIndex + 1,
					'description' => $this->request->getVar('description')
				]);

				// If choosen means move to Wait Contents
				$is_choosen = $this->contentModel->getChoosen($id);
				if ($is_choosen == 1) {
					$data = [
						'event_category_id' => $this->request->getVar('kategori'),
						'class_id' => $this->request->getVar('major'),
						'subjects_id' => $subjects,
					];
					$this->waitContentModel->updateWait($id, $data);
				}

				for ($x = 1; $x <= 5; $x++) {
					$choosen = 0;
					switch ($x) {
						case 1:
							if ($this->request->getVar('choosen') == $x) {
								$choosen = 1;
							}
							$data = [
								'content_id' => $id,
								'option' => $x,
								'option_char' => "A",
								'answer' => $this->request->getVar('answerA'),
								'is_answer' => $choosen
							];
							break;
						case 2:
							if ($this->request->getVar('choosen') == $x) {
								$choosen = 1;
							}
							$data = [
								'content_id' => $id,
								'option' => $x,
								'option_char' => "B",
								'answer' => $this->request->getVar('answerB'),
								'is_answer' => $choosen
							];
							break;
						case 3:
							if ($this->request->getVar('choosen') == $x) {
								$choosen = 1;
							}
							$data = [
								'content_id' => $id,
								'option' => $x,
								'option_char' => "C",
								'answer' => $this->request->getVar('answerC'),
								'is_answer' => $choosen
							];
							break;
						case 4:
							if ($this->request->getVar('choosen') == $x) {
								$choosen = 1;
							}
							$data = [
								'content_id' => $id,
								'option' => $x,
								'option_char' => "D",
								'answer' => $this->request->getVar('answerD'),
								'is_answer' => $choosen
							];
							break;
						case 5:
							if ($this->request->getVar('choosen') == $x) {
								$choosen = 1;
							}
							$data = [
								'content_id' => $id,
								'option' => $x,
								'option_char' => "E",
								'answer' => $this->request->getVar('answerE'),
								'is_answer' => $choosen
							];
							break;
					}
					$this->contentOptionModel->updateContent($id, $data, $x);
				}

				session()->setFlashdata('message', 'soal ujian berhasil diperbaharui');

				return redirect()->to('../../admin/materi');
				break;
		}
	}
}
