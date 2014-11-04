<?php
/**
 * @created 04.11.14 - 12:22
 * @author stefanriedel
 */

namespace Lavaproject;

use Cartalyst\Sentry\Users\UserInterface;
use Illuminate\Support\Facades\Mail;

class Email extends Mail {

	public function sendUserCreatedFromBackendWelcomeMail(UserInterface $oUser, $sPassword) {
		try {
			static::send('emails.users.created_from_backend_welcome', array('user' => $oUser, 'password' => $sPassword), function($oMessage) use($oUser){
				$oMessage->to($oUser->email);
			});
			return true;
		} catch(\Exception $e) {
			throw $e;
		}
	}

}