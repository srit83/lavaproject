<?php
/**
 * @created 29.10.14 - 12:47
 * @author stefanriedel
 */

class UsersController extends BaseController {

	public function all() {


		return View::make('users.all');
	}

	public function create() {
		$oUser = new User;
		if(Request::isMethod('POST')) {
			$aNewUser = Input::get('us');
			$oUser->fill($aNewUser);
			$oUser->validate();
		}
		return View::make('users.create')->with('user', $oUser);
	}

}