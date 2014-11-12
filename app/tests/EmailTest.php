<?php
/**
 * @created 04.11.14 - 12:36
 * @author stefanriedel
 */

namespace Lavaproject\Tests;

use Lavaproject\Facades\Email;
use Way\Tests\Assert;

class EmailTest extends \TestCase {

	/**
	 * @var Email
	 */
	protected $_oEmail;

	public function testSendCreateUserFromBackendMail() {
		$aCredentials = array(
			'email'    => 'foo@bar.com',
			'password' => 'sdf_sdf',
		);

		$oUser = \Sentry::register($aCredentials, true);
		Assert::true(Email::sendUserCreatedFromBackendWelcomeMail($oUser, $aCredentials['password']));
	}

}
