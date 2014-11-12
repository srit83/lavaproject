<?php
/**
 * User
 *
 * @created 04.11.14 - 14:32
 * @author stefanriedel
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $permissions
 * @property boolean $activated
 * @property string $activation_code
 * @property \Carbon\Carbon $activated_at
 * @property \Carbon\Carbon $last_login
 * @property string $persist_code
 * @property string $reset_password_code
 * @property string $first_name
 * @property string $last_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\static::$groupModel[] $groups
 * @method static \Illuminate\Database\Query\Builder|\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\User wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereActivated($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereActivationCode($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereActivatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\User wherePersistCode($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereResetPasswordCode($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereUpdatedAt($value)
 * @method static \User active()
 * @method static \User deactive()
 * @method static \User isAdmin()
 * @property string $oneloginkey
 * @method static \Illuminate\Database\Query\Builder|\User whereOneloginkey($value)
 * @method static \User email($sEmail)
 * @method static \User oneLoginKey($sOneLoginKey)
 */

class User extends Cartalyst\Sentry\Users\Eloquent\User {

	/**
	 * @return $this
	 */
	protected static function _prepareCountIsAdminQuery() {
		return DB::table( 'users_groups' )
		         ->join( 'groups', 'users_groups.group_id', '=', 'groups.id' )
		         ->where( 'groups.name', '=', 'Admin' );
	}

	public function __toString() {
		$sRet = $this->email;
		if($this->first_name) {
			$sRet = $this->first_name;
		}
		if($this->last_name) {
			$sRet .= ' ' . $this->last_name;
		}
		return $sRet;
	}

	public function scopeActive($oQuery) {
		return $oQuery->whereActivated(1);
	}

	public function scopeDeactive($oQuery) {
		return $oQuery->whereActivated(0);
	}

	public function scopeEmail($oQuery, $sEmail) {
		return $oQuery->whereEmail($sEmail);
	}

	public function scopeIsAdmin($oQuery) {
		return $oQuery->with(['groups' => function($oQuery){
			$oQuery->whereName('Admin');
		}]);
	}

	public function scopeOneLoginKey($oQuery, $sOneLoginKey) {
		return $oQuery->whereOneloginkey($sOneLoginKey);
	}

	public static function countIsAdmin() {
		return static::_prepareCountIsAdminQuery()->count();
	}

	public static function countIsActiveAdmin() {
		return static::_prepareCountIsAdminQuery()->join('users', 'users_groups.user_id', '=', 'users.id')->where('users.activated', '=', 1)->count();
	}

	public function recordLogin() {
		//one year
		Cookie::queue('login', $this->email, 60*60*24*365);
		parent::recordLogin();
	}

	public function isExternRegistered() {
		$this->oneLogin();
		Email::sendUserCreatedFromBackendWelcomeMail($this);
	}

	public function oneLogin() {
		if($this->exists) {
			$this->oneloginkey = Str::random(40);
			$this->save();
		} else {
			throw new Exception(_('Der Nutzer muss vorher schon gespeichert sein.'));
		}
	}

	public function changePassword($aCredentials) {
		$oValidator = Validator::make($aCredentials, [
			'password' => 'required|confirmed'
		]);
		if(!$oValidator->fails()) {
			$this->password = $aCredentials['password'];
			$this->oneloginkey = null;
			$this->save();
			Email::sendPasswordChangedMail($this);
			return true;
		} else {
			return false;
		}
	}

	public function sendForgetPasswordMail() {
		$this->oneLogin();
		Email::sendForgetPasswordMail($this);
	}

}