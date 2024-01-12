<?php

namespace App\Controllers;

use App\Models\EventMDL;

class History extends BaseController
{

	protected $eventModel;

	public function __construct()
	{
		$this->eventModel = new EventMDL();
	}
	public function index()
	{
		$event = session()->get('event');

		foreach ($event as $ev) :
			$data = [
				'title' => "Score - " . $ev['name']
			];
		endforeach;

		return view('pages/history');
	}
}
