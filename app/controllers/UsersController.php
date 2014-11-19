<?php
/**
 * @created 29.10.14 - 12:47
 * @author stefanriedel
 */

class UsersController extends AdminBaseController {

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

	public function block($sEmail) {
		if($oUser = User::email($sEmail)->first()) {
			$oUser->ban();
			Session::flash('danger', _('Nutzer erfolgreich geblock.'));
		} else {
			Session::flash('danger', _('Nutzer konnte nicht geblockt werden.'));
		}
	}

	public function unblock($sEmail) {
		if($oUser = User::email($sEmail)->first()) {
			$oUser->unban();
			Session::flash('danger', _('Nutzer erfolgreich freigegeben.'));
		} else {
			Session::flash('danger', _('Nutzer konnte nicht freigegeben werden.'));
		}
	}

	public function create() {
		$this->_beforeCreate();
		if(Request::isMethod('POST')) {
			if(!User::validateCreate()) {
				list( $aUser, $iGroup ) = $this->_getUserDataFromInput();
				try {
					$aUser['password'] = Str::random();
					$oUser             = Sentry::createUser( $aUser );
					if ( $oGroup = Sentry::findGroupById( $iGroup ) ) {
						$oUser->addGroup( $oGroup );
					}
					Session::flash( 'success', _( 'Nutzer wurde erfolgreich angelegt.' ) );

					return Redirect::to( URL::previous() );
				} catch ( Exception $e ) {
					Session::flash( 'danger', $e->getMessage() );
				}
			} else {
				Session::flash( 'danger', _('Der Nutzer konnte nicht angelegt werden') );
				Former::withErrors(User::getValidator());
			}
		}
		return View::make('users.create');
	}

	/**
	 * @param $sName
	 *
	 * @todo refactoring with create
	 *
	 * @return $this|\Illuminate\Http\RedirectResponse
	 */
	public function edit($sName) {
		$oUser = Sentry::findUserByLogin($sName);
		if(Request::isMethod('POST')) {
			if(!User::validateUpdate($oUser)) {
				list( $aUser, $iGroup ) = $this->_getUserDataFromInput();
				$oUser->fill( $aUser );
				/**
				 * @todo try catch
				 */
				$oUser->save();
				if ( $oGroup = Sentry::findGroupById( $iGroup ) ) {
					$oUser->removeGroup( Sentry::findGroupById( $oUser->getGroups()->first()->id ) );
					$oUser->addGroup( $oGroup );
				}
				Session::flash( 'success', _( 'Nutzer wurde erfolgreich geändert.' ) );
				return Redirect::to( URL::previous() );
			} else {
				Session::flash( 'danger', _('Der Nutzer konnte nicht geändert werden') );
				Former::withErrors(User::getValidator());
			}
		}
		return View::make('users.edit')->with('user', $oUser);
	}

	/**
	 * @return array
	 */
	protected function _getUserDataFromInput() {
		$aUser  = Input::all();
		$aUser['activated'] = (isset($aUser['activated'])) ?: false;
		$iGroup = $aUser['group'];
		unset( $aUser['group'], $aUser['commit'] );

		return array( $aUser, $iGroup );
	}

	protected function _beforeCreate() {
		User::created( function ( $oModel ) {
			$oModel->isExternRegistered();
		} );
	}


}