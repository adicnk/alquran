<?php

namespace App\Controllers;

class Jawaban extends BaseController
{

	public function index($number = false)
	{
		$data = [
			'title'   => "Jawaban"
		];

		if (($number)) {
			session()->set('startnumber', $number);
			return view('pages/jawaban', $data);
		}
	}
}
