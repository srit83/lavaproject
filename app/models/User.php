<?php
/**
 * @created 04.11.14 - 14:32
 * @author stefanriedel
 */

class User extends Cartalyst\Sentry\Users\Eloquent\User {

	public function __toString() {
		$sRet = '';
		if($this->first_name) {
			$sRet = $this->first_name;
		}
		if($this->last_name) {
			$sRet .= ' ' . $this->first_name;
		}
		return $sRet;
	}

}