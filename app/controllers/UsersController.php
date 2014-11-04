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
		if(Request::isMethod('POST')) {
			$aNewUser = Input::get('us');
			$iGroup = $aNewUser['group'];
			unset($aNewUser['group']);
			try {
				//$aNewUser['activated'] = (isset($aNewUser['activated'])) ? (bool)$aNewUser['activated'] : false;
				$aNewUser['activated'] = true;
				\Cartalyst\Sentry\Users\Eloquent\User::creating(function(){

				});
				Sentry::createUser( $aNewUser );
			} catch (Exception $e) {
				Session::flash('danger', $e->getMessage());
			}
		}
		return View::make('users.create');
	}



}