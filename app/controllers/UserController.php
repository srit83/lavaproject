<?php
/**
 * @created 27.10.14 - 16:14
 * @author stefanriedel
 */
class UserController extends BaseController {

	public function login() {
		if(Request::isMethod('POST')) {
			$aCr = Input::get('cr');
			try {
				Sentry::authenticate($aCr, Input::get('remember', false));
				Session::flash('success', __('Login erfolgreich'));
				return Redirect::to('/');
			} catch(Exception $e) {
				Session::flash('login_failed', __('Login fehlgeschlagen'));
				return Redirect::to('login');
			}
		}
		return View::make('user.login');
	}

	public function logout() {
		Sentry::logout();
		Session::flash('success', __('Logout erfolgreich'));
		return Redirect::to('login');
	}

}