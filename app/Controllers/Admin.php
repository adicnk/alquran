<?php

namespace App\Controllers;

use App\Models\UserMDL;
use App\Models\UserInfoMDL;
use App\Models\SchoolMDL;
use App\Models\EventMDL;
use App\Models\ContentMDL;
use App\Models\ClassMDL;

class Admin extends BaseController
{

	protected $userModel, $userInfoModel, $schoolModel, $eventModel, $contentModel, $classModel;

	public function __construct()
	{
		$this->userModel = new UserMDL();
		$this->userInfoModel = new UserInfoMDL();
		$this->schoolModel = new SchoolMDL();
		$this->eventModel = new EventMDL();
		$this->contentModel = new ContentMDL();
		$this->classModel = new ClassMDL();
	}

	public function index()
	{
		$data = [
			'title'   => "Login"
		];
		return view('/form/admin-login', $data);
	}

	public function dashboard()
	{

		$data = [
			'title'   => 'Dashboard Administrator'
		];

		// this session check put in other folder
		//  expired time check in 60 * 5 is 5 minute
		$sessionTime = session()->get('__ci_last_regenerate');
		if (date('Y/m/d H:i:s', $sessionTime + 60 * 5) > $sessionTime) :
			return redirect()->to('/admin');
		endif;

		return view('/pages/admin-dashboard', $data);
	}

	public function user($id)
	{

		$data = [
			'title'   => 'Dashboard Administrator',
			'event'  => $this->eventModel->search($id)
		];

		return view('/pages/admin-wait-user', $data);
	}

	public function mahasiswa($id = false)
	{
		if ($id) :
			$this->userModel->setRecovery($id);
			$user = $this->userModel->getUserByID($id);
			foreach ($user as $usr) :
				session()->setFlashdata('message', $usr['name'] . ' berhasil di recovery');
			endforeach;
			return redirect()->to('/admin/mahasiswa');
		endif;

		// Search Block
		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$userInfo = $this->userInfoModel->search($keyword);
			$title = "User NIM Search : " . $keyword;
			$filter = 0;
		} else {
			// Filter Block
			$filter = $this->request->getVar('filter-class');
			if (!$filter == 0) {
				$userInfo = $this->userInfoModel->filter($filter);
				$className = $this->classModel->getClass($filter);
				foreach ($className as $cn) :
					$title = "Prodi Search : " . $cn['name'];
				endforeach;
			} else {
				$userInfo = $this->userInfoModel->search();
				$title = "User List : All";
			}
		}

		// Pagination
		$paginate = $this->userInfoModel->paginate(10, 'user');
		$pager = $this->userInfoModel->pager;
		// Making the count number properly
		$currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;

		$data = [
			'title'     => $title,
			'user'  => $paginate,
			'pager' => $pager,
			'currentPage'   => $currentPage,
			'keyword' => $keyword,
			'content'  => false,
			'filter' => $filter
		];

		return view('/list/mahasiswa', $data);
	}

	public function administrator()
	{
		// Search Block
		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$userInfo = $this->userInfoModel->searchAdmin($keyword);
			$title = "Admin Search : " . $keyword;
		} else {
			$userInfo = $this->userInfoModel->searchAdmin();
			$title = "Admin List : All";
		}

		// Pagination
		$paginate = $this->userInfoModel->paginate(10, 'user');
		$pager = $this->userInfoModel->pager;
		// Making the count number properly
		$currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;

		$data = [
			'title'     => $title,
			'user'  => $paginate,
			'pager' => $pager,
			'currentPage'   => $currentPage,
			'keyword' => $keyword,
			'content'  => false
		];

		return view('/list/administrator', $data);
	}

	public function jadwal()
	{
		// Search Block
		$filter = 0;
		$subjects = 0;
		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$userInfo = $this->eventModel->search($keyword);
			$title = "Jadwal Name Search : " . $keyword;
		} else {

			// Filter Block
			$filter = $this->request->getVar('filter-kategori');
			if (!$filter == 0) {
				if ($filter == 2) {
					$subjects = $this->request->getVar('filter-subjects');
					$userInfo = $this->eventModel->searchCategory($filter, $subjects);
				} else {
					$userInfo = $this->eventModel->searchCategory($filter);
				}
				$title = "Kategori Search : Unavailable";
			} else {
				$userInfo = $this->eventModel->search();
				$title = "Jadwal List : All";
			}
		}

		// Pagination
		$paginate = $this->eventModel->paginate(5, 'event');
		$pager = $this->eventModel->pager;
		// Making the count number properly
		$currentPage = $this->request->getVar('page_event') ? $this->request->getVar('page_event') : 1;

		$data = [
			'title'     => $title,
			'event'  => $paginate,
			'pager' => $pager,
			'currentPage'   => $currentPage,
			'keyword' => $keyword,
			'content'  => false,
			'filter' => $filter,
			'subjects' => $subjects
		];

		return view('/list/jadwal', $data);
	}

	public function materi()
	{
		// Search Block
		$filter = 0;
		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$content = $this->contentModel->search($keyword);
			$title = "Materi Search : " . $keyword;
		} else {
			// Filter Block
			$filter = $this->request->getVar('filter-class');
			if (!$filter == 0) {
				$content = $this->contentModel->searchClass($filter);
				$className = $this->classModel->getClass($filter);
				foreach ($className as $cn) :
					$title = "Prodi Search : " . $cn['name'];
				endforeach;
			} else {
				$content = $this->contentModel->search();
				$title = "Materi List : All";
			}
		}

		// Pagination
		$paginate = $this->contentModel->paginate(5, 'content');
		$pager = $this->contentModel->pager;
		// Making the count number properly
		$currentPage = $this->request->getVar('page_content') ? $this->request->getVar('page_content') : 1;

		$data = [
			'title'     => $title,
			'content'  => $paginate,
			'pager' => $pager,
			'currentPage' => $currentPage,
			'keyword' => $keyword,
			'filter' => $filter
		];

		return view('/list/materi', $data);
	}

	public function active($id)
	{
		$this->userModel->setActive($id);
		return redirect()->to('../admin');
	}

	public function submit()
	{
		$userEmail = $this->request->getVar('email');
		$userPassword = $this->request->getVar('password');

		$authLogin = $this->userModel->authLoginAdmin($userEmail, $userPassword); //is user correct

		if (!$authLogin) {
			// Menambahkan flash message di menu jika authorisasi gagal
			session()->setFlashdata('message', 'Username atau Password anda salah');
			return redirect()->to('/admin');
		}

		$data = [
			'title'   => 'Administrator',
			'school' => $this->schoolModel->getSchool(1),
			'useradmin' => $this->userModel->getUserAdmin($userEmail)
		];

		session()->set($data);
		return redirect()->to('../admin/dashboard');
	}

	public function logout()
	{
		session()->destroy(); // Initialize clear all session

		$data = [
			'title' => "Login"
		];

		return redirect()->to('/admin');
	}
}
