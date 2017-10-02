<?php

class AccountController extends BaseController {

	### Sign In
	/* After submitting the sign-in form */
	public function postSignIn() {
		$validator = Validator::make(Input::all(),
			array(
				'username' 	=> 'required',
				'password'	=> 'required'
			)
		);
		if($validator->fails()) {
			// Redirect to the sign in page
			return Redirect::route('account-sign-in')
				->withErrors($validator)
				->withInput();   // redirect the input

		} else {

			$remember = (Input::has('remember')) ? true : false;
			$auth = Auth::attempt(array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
			), $remember);
		} 

		if($auth) {
			
			return Redirect::intended('/');

		} else {
			
			return Redirect::route('account-sign-in')
				->with('global', 'movais nom d\'utilisateur ou de mot de passe');
		}

		return Redirect::route('account-sign-in')
			->with('global', 'un probleme a été rencontré?');
	}

	/* Submitting the Create User form (POST) */
	public function postCreate() {
		$validator = Validator::make(Input::all(),
			array(
				'username'		=> 'required|max:20|min:3|unique:users',
				'password'		=> 'required',
				'password_again'=> 'required|same:password'
			)
		);

		if($validator->fails()) {
			return Redirect::route('account-create')
				->withErrors($validator)
				->withInput();   // fills the field with the old inputs what were correct

		} else {
			// create an account
			$username	= Input::get('username');
			$password 	= Input::get('password');

			$userdata = User::create(array(
				'username' 	=> $username,
				'password' 	=> Hash::make($password),	// Changed the default column for Password
				'verification_status ' 	=> 1	// Changed the default column for Password
			));

			if($userdata) {			


				return Redirect::route('account-sign-in')
					->with('global', 'Votre compte ac été crée avec success');				
			}
		}
	}

	public function getSignIn() {
		return View::make('account.signin');
	}

	/* Viewing the form (GET) */
	public function getCreate() {
		return View::make('account.create');
	}

	### Sign Out
	public function getSignOut() {
		Auth::logout();
		return Redirect::route('home');
	}


}  