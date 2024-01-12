<?php

namespace App\Controllers;

class Error extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function back()
	{
		return view('errors/errorback');
	}
}
