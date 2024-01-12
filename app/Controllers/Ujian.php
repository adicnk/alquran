<?php

namespace App\Controllers;

use App\Models\UserMDL;
use App\Models\ContentOptionMDL;
use App\Models\UserHistoryMDL;
use App\Models\EventMDL;

class Ujian extends BaseController
{

	protected $userModel, $contentOptionModel, $eventModel;

	public function __construct()
	{
		$this->userModel = new UserMDL();
		$this->contentOptionModel = new ContentOptionMDL();
		$this->userHistoryModel = new UserHistoryMDL();
		$this->eventModel = new EventMDL();
	}

	public function index($number = false)
	{
		$event = session()->get('event');
		$startnumber = session()->get('startnumber');
		$isAnswer = $this->request->getVar('isAnswer'); //The submit answer from form
		$isDoubt = $this->request->getVar('isDoubt'); // The doubt answer from form
		$jawab =  session()->get('doneanswer');
		$jawabragu =  session()->get('doubtanswer');
		$jawabbenar =  session()->get('rightanswer');
		$question =  session()->get('question');

		// Fill the right answer 
		$totalQuestion = 0;
		foreach (session()->get('event') as $ev) :
			$totalQuestion = $ev['total_content'];
		endforeach;
		for ($x = 1; $x <= $totalQuestion; $x++) {
			//Find the right answer
			$jawabbenar[$x] = $this->contentOptionModel->getRightAnswer($question[$x]);
			session()->set('rightanswer', $jawabbenar);
		}

		if ($number == 1) {
			if (!$startnumber == 0) {
				session()->set('is_start', 1);
				$queryUser = session()->get('user');
				foreach ($queryUser as $qu) :
					$this->userModel->save([
						'id' => $qu['id'],
						'is_start' => 1
					]);
				endforeach;
			}
		}
		foreach ($event as $ev) :
			$data = [
				'title' => "Ujian Start - " . $ev['name']
			];
		endforeach;

		if ($number) {
			session()->set('startnumber', $number);
			return view('pages/ujian-detail', $data);
		} else if ($startnumber > 0) {

			session()->set('startnumber', $startnumber); //User had the answer			

			if (!$isAnswer == "") {
				session()->set('isAnswer', $isAnswer);
				if ($isDoubt == 0) {
					$jawab[$startnumber] = $isAnswer;
					session()->set('doneanswer', $jawab);
					$jawabragu[$startnumber] = "";
					session()->set('doubtanswer', $jawabragu);
				} else {
					$jawab[$startnumber] = "";
					session()->set('doneanswer', $jawab);
					$jawabragu[$startnumber] = $isAnswer;
					session()->set('doubtanswer', $jawabragu);
				}
			}

			return redirect()->to('../ujian/' . session()->get('startnumber'));
		} else {
			return view('pages/ujian', $data);
		}
	}

	public function score()
	{
		$event = session()->get('event');
		$user = session()->get('user');

		$totalQuestion = 0;
		$doneanswer = session()->get('doneanswer');
		$doubtanswer = session()->get('doubtanswer');
		$rightanswer = session()->get('rightanswer');
		$totalRight = 0;

		foreach ($event as $ev) :
			$totalQuestion = $ev['total_content'];
		endforeach;

		// dd(session()->get());

		for ($x = 1; $x <= $totalQuestion; $x++) {
			if ($doneanswer[$x] == $rightanswer[$x]) {
				$totalRight++;
			}
			if ($doubtanswer[$x] == $rightanswer[$x]) {
				$totalRight++;
			}
		}

		$totalScore = (round($totalRight / $totalQuestion * 100));

		// dd($totalScore);

		session()->set('score', $totalScore);

		foreach ($event as $ev) :
			foreach ($user as $usr) :
				$idEvent = $ev['id'];
				$idUser = $usr['id'];
				$this->userHistoryModel->setUserHistory($idUser, $idEvent, $totalScore);
			endforeach;
		endforeach;

		foreach ($event as $ev) :
			$data = [
				'title' => "Score - " . $ev['name']
			];
		endforeach;

		return view('pages/score', $data);
	}

	public function logout()
	{
		$queryUser = session()->get('user');
		foreach ($queryUser as $qu) :

			$this->userModel->save([
				'id' => $qu['id'],
				'is_start' => 0
			]);

			$event = session()->get('event');
			foreach ($event as $ev) :
				$this->eventModel->save([
					'id' =>	$ev['id'],
					'is_loaded'	=> 0
				]);
			endforeach;
		endforeach;

		session()->destroy(); // Initialize clear all session

		$data = [
			'title' => "Login"
		];

		return redirect()->to('/');
	}
}
