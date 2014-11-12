<?php
/**
 * @created 29.10.14 - 12:47
 * @author stefanriedel
 */

class UsersController extends BaseController {

	public function all() {
		$sFilter = Input::get('filter', 'active');

		switch($sFilter) {
			case 'active':
				$oUsers = User::active()->get();
				$iUserCnt = User::active()->count();
				break;
			case 'deactive':
				$oUsers = User::deactive()->get();
				$iUserCnt = User::deactive()->count();
				break;
			case 'admins':
				$oUsers = User::isAdmin()->active()->get();
				$iUserCnt = User::countIsActiveAdmin();
				break;
		}

		return View::make('users.all')
			->with('filter', $sFilter)
			->with('users', $oUsers)
			->with('user_cnt', $iUserCnt)
			->with('all_filters', [
				'active' => [
					'label' => _('Aktiv'),
					'route' => URL::route('users_all'),
					'cnt' => User::active()->count()
				],
				'deactive' => [
					'label' => _('Deaktiviert'),
					'route' => URL::route('users_all') . '?filter=deactive',
					'cnt' => User::deactive()->count()
				],
				'admins' => [
					'label' => _('Admins'),
					'route' => URL::route('users_all') . '?filter=admins',
					'cnt' => User::countIsActiveAdmin()
				]
			]);
	}

	public function delete($sEmail) {
		if($oUser = User::email($sEmail)->first()) {
			$oUser->delete();
			Session::flash('danger', _('Nutzer erfolgreich gelöscht.'));
		} else {
			Session::flash('danger', _('Nutzer konnte nicht gelöscht werden.'));
		}
	}

	public function create() {
		if(Request::isMethod('POST')) {
			$aNewUser = Input::get('us');
			$iGroup = $aNewUser['group'];
			unset($aNewUser['group']);
			try {
				User::created(function($oModel){
					$oModel->isExternRegistered();
				});
				$aNewUser['activated'] = (isset($aNewUser['activated'])) ?: false;
				$aNewUser['password'] = Str::random();
				$oUser = Sentry::createUser( $aNewUser );
				if($oGroup = Sentry::findGroupById($iGroup)) {
					$oUser->addGroup($oGroup);
				}
				Session::flash('success', _('Nutzer wurde erfolgreich angelegt.'));
				return Redirect::to(URL::previous());
			} catch (Exception $e) {
				Session::flash('danger', $e->getMessage());
			}
		}
		return View::make('users.create');
	}

	public function edit($sName) {

	}



}