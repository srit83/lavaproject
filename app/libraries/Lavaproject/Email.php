<?php
/**
 * @created 04.11.14 - 12:22
 * @author stefanriedel
 */

namespace Lavaproject;

use Cartalyst\Sentry\Users\UserInterface;
use Illuminate\Support\Facades\Mail;

class Email extends Mail {

	public function sendUserCreatedFromBackendWelcomeMail( UserInterface $oUser ) {
		return $this->_sendEmailToUser( $oUser, 'emails.users.created_from_backend_welcome', _('Ein Account wurde für dich angelegt.'));
	}

	public function sendPasswordChangedMail( UserInterface $oUser ) {
		return $this->_sendEmailToUser( $oUser, 'emails.users.password_changed', _('Dein Passwort wurde geändert.'));
	}

	public function sendForgetPasswordMail( UserInterface $oUser ) {
		return $this->_sendEmailToUser( $oUser, 'emails.users.forget_password', _('Du hast dein Passwort vergessen?'));
	}

	protected function _sendEmailToUser( UserInterface $oUser, $sViewName, $sSubject ) {
		try {
			static::send( $sViewName, array( 'user' => $oUser ), function ( $oMessage ) use ( $oUser, $sSubject ) {
				$oMessage->to( $oUser->email );
				$oMessage->subject($sSubject);
			} );

			return true;
		} catch ( \Exception $e ) {
			throw $e;
		}
	}

}