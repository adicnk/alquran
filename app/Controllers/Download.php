<?php

namespace App\Controllers;

use App\Models\ClassMDL;

class Download extends BaseController
{
	protected $classModel;

	public function __construct()
	{
		$this->classModel = new ClassMDL();
	}

	public function index()
	{
		$prodi = $this->request->getVar('prodi');

		if ($prodi) {
			switch ($prodi) {
				case 1:
					$data = [
						'title'   => 'Hasil Ujian All Prodi',
						'prodi' => 2,
						'result' => $this->classModel->historyByClass(1)
					];
					break;
				case 2:
					$data = [
						'title'   => 'Hasil Ujian D3 Keperawatan',
						'prodi' => 2,
						'result' => $this->classModel->historyByClass(2)
					];
					break;
				case 3:
					$data = [
						'title'   => 'Hasil Ujian Profesi Ners',
						'prodi' => 3,
						'result' => $this->classModel->historyByClass(3)
					];
					break;
			}
			return view('/pages/file-download', $data);
		} else {
			$data = [
				'title'   => 'Dashboard Administrator',
				'prodi' => 0
			];
		}

		// this session check put in other folder
		//  expired time check in 60 * 5 is 5 minute
		$sessionTime = session()->get('__ci_last_regenerate');
		if (date('Y/m/d H:i:s', $sessionTime + 60 * 5) > $sessionTime) :
			return redirect()->to('/admin');
		endif;

		return view('/pages/admin-download', $data);
	}
}
