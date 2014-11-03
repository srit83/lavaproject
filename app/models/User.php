<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * User
 *
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
 */
class User extends Cartalyst\Sentry\Users\Eloquent\User {

	protected $fillable = array('first_name', 'last_name', 'email');

	public function validate() {
		$oUser = $this;
		Validator::extend('user_exists', function($sAttribute, $sValue) use ($oUser) {
			$oQuery = $this->newQuery();
			$oPersistedUser = $oQuery->where($sAttribute, '=', $sValue)->first();
			$blExists = false ;
			if ($oPersistedUser and $oPersistedUser->getId() != $oUser->getId()) {
				$blExists = true;
			}
			return $blExists;
		});
		$oValidation = Validator::make($this->toArray(), array('first_name' => 'required', 'last_name' => 'required', 'email' => 'required|email|user_exists'));
		return $oValidation->valid();
	}




}
