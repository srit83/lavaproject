<?php
/**
 * @created 27.10.14 - 16:14
 * @author stefanriedel
 */
class UserController extends BaseController {

	public function forget_password() {
		if(Request::isMethod('POST')) {
			$aCr = Input::get( 'cr' );
			if($oUser = User::email($aCr['email'])->first() AND !$oUser->isBanned()) {
				$oUser->sendForgetPasswordMail();
				Session::flash('success', _('Es wurde eine E-Mail an dich gesendet.'));
			} else {
				Session::flash('success', _('Es wurde eine E-Mail an dich gesendet.'));
			}
		}

		return View::make('user.forget_password');
	}

	public function login() {

		if($iFlush = Input::get('flush', null) AND $iFlush == 1) {
			Cookie::queue('login', null, -1024);
			return Redirect::to(URL::previous());
		}

		if(Request::isMethod('POST')) {
			$aCr = Input::get('cr');
			try {
				Sentry::authenticate($aCr, Input::get('remember', false));
				Session::flash('success', _('Login erfolgreich'));
				return Redirect::to('/');
			} catch(Exception $e) {
				Session::flash('login_failed', _('Login fehlgeschlagen'));
				return Redirect::to('login')->withInput();
			}
		}
		return View::make('user.login')->with('login_cookie', Cookie::get('login', null));
	}

	public function logout() {
		Sentry::logout();
		Session::flash('success', _('Logout erfolgreich'));
		return Redirect::to('login');
	}

	public function fresh_password($sOneLoginKey) {
		if(Sentry::getUser()) {
			return Redirect::route('root');
		}

		if($oUser = User::oneLoginKey($sOneLoginKey)->first()) {
			if(Request::isMethod('POST') && $aCredentials = Input::get('cr')) {
				if($oUser->changePassword($aCredentials)) {
					Sentry::login($oUser);
					Session::flash('success', _('Dein Passwort wurde erfolgreich gesetzt'));
					return Redirect::route('root');
				} else {
					Session::flash('warning', _('Dein Passwort konnte nicht gesetzt werden. Achte bitte darauf, das die beiden Passwörter übereinstimmen.'));
				}
			}
			return View::make('user.fresh_password');
		} else {
			return App::abort(404);
		}
	}

}