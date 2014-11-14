<?php

class BaseController extends Controller {

	protected $_sAction = null;

	protected $_sController = null;

	protected $_sNamespace = null;

	protected $_sPermission = null;

	protected $_sPermissionsPrefix = null;

	protected $_sPermissionsSuffix = null;

	protected static $_aAllAllowedControllerActions = [
		'user.login',
		'user.logout',
		'user.fresh_password',
		'user.forget_password'
	];

	public function __construct() {
		$this->beforeFilter('@filterPermissions');
	}

	public function filterPermissions() {
		$sCompleteAction = Route::getCurrentRoute()->getActionName();
		list($this->_sController, $this->_sAction) = explode('@', $sCompleteAction);
		$sControllerSnakeCased = snake_case($this->_sController);
		$sControllerNameAllone = explode('_', $sControllerSnakeCased)[0];
		$this->_sPermission = concat('.', $this->_sPermissionsPrefix, $sControllerNameAllone, $this->_sAction, $this->_sPermissionsSuffix);
		if(!in_array($this->_sPermission, static::$_aAllAllowedControllerActions) && !hasAccess($this->_sPermission)) {
			App::abort(403, _('Keine Berechtigung'));
		}
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public static function addAllowedControllerActions(array $aControllerActions) {
		static::$_aAllAllowedControllerActions = array_merge(static::$_aAllAllowedControllerActions, $aControllerActions);
	}

}
