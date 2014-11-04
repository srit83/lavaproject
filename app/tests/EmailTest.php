<?php
/**
 * @created 04.11.14 - 12:36
 * @author stefanriedel
 */

namespace Lavaproject\Tests;

use Lavaproject\Email;
use Way\Tests\Assert;

class EmailTest extends \TestCase {

	/**
	 * @var Email
	 */
	protected $_oEmail;

	public function setUp() {
		parent::setUp();
		\Artisan::call('migrate', array('--package' => 'cartalyst/sentry'));
		$this->_oEmail = new Email();
	}

	public function testSendCreateUserFromBackendMail() {
		$aCredentials = array(
			'email'    => 'foo@bar.com',
			'password' => 'sdf_sdf',
		);

		$oUser = \Sentry::register($aCredentials, true);
		Assert::true($this->_oEmail->sendUserCreatedFromBackendWelcomeMail($oUser, $aCredentials['password']));
	}

}
