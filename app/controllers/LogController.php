<?php

class LogController extends \BaseController {

	public function index()
	{

		$logs = Logs::select('id','book_issue_id','student_id','issued_at')
			->where('return_time', '=', 0)
			->orderBy('issued_at', 'DESC');
		
		$logs = $logs->get();

		for($i=0; $i<count($logs); $i++){
	        
	        $issue_id = $logs[$i]['book_issue_id'];
	        $student_id = $logs[$i]['student_id'];
	        
	        // to get the name of the book from book issue id
	        $issue = Issue::find($issue_id);
	        $book_id = $issue->book_id;
	        $book = Books::find($book_id);
			$logs[$i]['book_name'] = $book->title;

			// to get the name of the student from student id
			$student = Student::find($student_id);
			$logs[$i]['student_name'] = $student->first_name . ' ' . $student->last_name;

			// change issue date and return date in human readable format
			$logs[$i]['issued_at'] = date('d-M', $logs[$i]['issued_at']);
			$logs[$i]['return_at'] = date('d-M', $logs[$i]['issued_at'] + 1209600);

		}

        return $logs;
	}

	public function create()
	{
		//
	}

	public function store()
	{
		$data = Input::all()['data'];
		$bookID = $data['bookID'];
		$studentID = $data['studentID'];
		
		$student = Student::find($studentID);
		
		if($student == NULL){
			throw new Exception('l\'identifient de le l\'etudient n\'est pas corect ');
		} else {
			$approved = $student->approved;
			
			if($approved == 0){
				throw new Exception('cette etudient na pas encore été aprouvé par le bibliothequere');
			} else {
				$books_issued = $student->books_issued;
				$category = $student->category;

				$max_allowed = StudentCategories::where('cat_id', '=', $category)->firstOrFail()->max_allowed;
				
				if($books_issued >= $max_allowed){
					throw new Exception('l\'etudient ne peux pas empreunter plus de livre');
				} else {

					$book = Issue::where('book_id', '=', $bookID)->firstOrFail();
					
					if($book == NULL){
						throw new Exception('identifient du libre invalide');
					} else {
						$book_availability = $book->available_status;
						if($book_availability != 1){
							throw new Exception('le document ne peux pas etre empreunté');
						} else {

							// book is to be issued
							DB::transaction( function() use($bookID, $studentID) {
								$log = new Logs;

								$log->book_issue_id = $bookID;
								$log->student_id	= $studentID;
								$log->issue_by		= Auth::id();
								$log->issued_at		= time();
								$log->return_time	= 0;

								$log->save();

								// changing the availability status
								$book = Issue::where('book_id', '=', $bookID)->firstOrFail();
								$book->available_status = 0;
								$book->save();

								// increasing number of books issed by student
								$student = Student::find($studentID);
								$student->books_issued = $student->books_issued + 1;
								$student->save();
							});

							return 'emprun validé';
						}
					}
				}
			}
		}
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		$issueID = $id;

		$conditions = array(
			'book_issue_id'	=> $issueID,
			'return_time'	=> 0
		);

		$log = Logs::where($conditions);

		if(!$log->count()){
			throw new Exception(' identifient du document invalide ou le document a deja été retourné');
		} else {
		
			$log = Logs::where($conditions)
				->firstOrFail();


			$log_id = $log['id'];
			$student_id = $log['student_id'];
			$issue_id = $log['book_issue_id'];


			DB::transaction( function() use($log_id, $student_id, $issue_id) {
				// change log status by changing return time
				$log_change = Logs::find($log_id);
				$log_change->return_time = time();
				$log_change->save();

				// decrease student book issue counter
				$student = Student::find($student_id);
				$student->books_issued = $student->books_issued - 1;
				$student->save();

				// change issue availability status
				$issue = Issue::where('book_id', '=', $issue_id)->firstOrFail();
				$issue->available_status = 1;
				$issue->save();
				
			});

			return 'Retourner avec success';
			
		}
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

    public function renderLogs() {
        return View::make('panel.logs');
    }

    public function renderIssueReturn() {
        return View::make('panel.issue-return');
    }

}
