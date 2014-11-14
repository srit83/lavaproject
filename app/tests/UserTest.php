<?php
/**
 * @created 04.11.14 - 09:23
 * @author stefanriedel
 */

namespace App\Tests;

use \Way\Tests\Factory;

class UserTest extends \TestCase {

	use \Way\Tests\ModelHelpers;

	/**
	 * @return \Cartalyst\Sentry\Users\UserInterface
	 */
	protected function _getUser($sEmail = 'sr@laravel-blog.de', $sPassword = '1234', $sFirstName = 'Stefan', $sLastName = 'Riedel', $blActivated = 1) {
		$oUser = \Sentry::createUser( array(
			'email'      => $sEmail,
			'password'   => $sPassword,
			'first_name' => $sFirstName,
			'last_name'  => $sLastName,
			'activated'  => $blActivated
		) );

		return $oUser;
	}

	/**
	 * @return \Cartalyst\Sentry\Groups\GroupInterface
	 */
	protected function _getAdminGroup() {
		$oAdminGroup = \Sentry::createGroup( array(
			'name'        => 'Admin',
			'permissions' => array(
				'superuser' => 1
			),
		) );

		return $oAdminGroup;
	}

	public function testScopeActive() {
		$this->_getUser();
		$this->_getUser('sr123@laravel-blog.de', '1234', 'Stefan', 'Riedel', 0);
		$this->_getUser('srsadasg@laravel-blog.de');

		$this->assertEquals(2, \User::active()->count());

	}

	public function testScopeDeactive() {
		$this->_getUser();
		$this->_getUser('sr123456789@laravel-blog.de', '1234', 'Stefan', 'Riedel', 0);
		$this->_getUser('sr123@laravel-blog.de', '1234', 'Stefan', 'Riedel', 0);

		$this->assertEquals(2, \User::deactive()->count());
	}

	public function testScopeIsAdmin() {
		$oUser3 = $this->_getUser();
		$oUser2 = $this->_getUser('sr12@laravel-blog.de', '1234', 'Stefan', 'Riedel');
		$oUser1 = $this->_getUser('sr123456789@laravel-blog.de', '1234', 'Stefan', 'Riedel', 0);

		$oEntwicklerGroiup = \Sentry::createGroup(array(
			'name' => 'Entwickler',
			'permissions' => array()
		));

		$oAdminGroup = $this->_getAdminGroup();

		$oUser1->addGroup($oAdminGroup);
		$oUser2->addGroup($oAdminGroup);
		$oUser3->addGroup($oEntwicklerGroiup);
		$this->assertEquals(2, \User::countIsAdmin());
		$this->assertEquals(1, \User::countIsActiveAdmin());


	}

	public function testScopeByEmail() {
		$this->_getUser();
		$this->assertEquals('Stefan Riedel', (string)\User::email('sr@laravel-blog.de')->first());
	}

	public function testToString() {
		$oUser = $this->_getUser();
		$this->assertEquals('Stefan Riedel', (string)$oUser);
	}

	public function testOneLogin() {
		$oUser = $this->_getUser();
		$oUser->oneLogin();
		$this->assertEquals(40, strlen($oUser->oneloginkey));
	}

	public function testSendRegisteredEmail() {
		$oUser = $this->_getUser();
		$oUser->isExternRegistered();
		$this->assertEquals(40, strlen($oUser->oneloginkey));
	}

	public function testScopeOneLoginKey() {
		$oUser = $this->_getUser();
		$oUser->oneLogin();

		$this->assertEquals('sr@laravel-blog.de', \User::oneLoginKey($oUser->oneloginkey)->first()->email);

	}

	public function testValidateNewPassword() {
		$aNewPasswordTrue = [
			'password' => '1234',
			'password_confirmation' => '1234'
		];
		$aNewPasswordFail = [
			'password' => '1234',
			'password_confirmation' => '1234ee'
		];
		$oUser = $this->_getUser();
		$this->assertTrue($oUser->changePassword($aNewPasswordTrue));
		$this->assertFalse($oUser->changePassword($aNewPasswordFail));
	}

	public function testBan() {
		$oUser = $this->_getUser();
		$this->assertTrue($oUser->ban());
	}

	public function testUnban() {
		$oUser = $this->_getUser();
		$oUser->ban();
		$this->assertTrue($oUser->unban());
	}

	public function testIsBan() {
		$oUser = $this->_getUser();
		$oUser->ban();
		return $this->assertTrue($oUser->isBanned());
	}


}
