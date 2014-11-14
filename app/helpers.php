<?php
/**
 * @created 28.10.14 - 15:05
 * @author stefanriedel
 */

function _v($sMessage, $aParams) {
	return vsprintf(_($sMessage), $aParams);
}

/*function _($sId, $aParameters = array(), $sDomain = 'messages', $sLocale = null) {
	return trans($sId, $aParameters, $sDomain, $sLocale);
}*/

function hasAccess($mxAccess) {
	$blAccess = false;
	if($oUser = Sentry::getUser()) {
		if ( is_array( $mxAccess ) ) {
			$blAccess = $oUser->hasAnyAccess( $mxAccess );
		} else {
			$blAccess = $oUser->hasAccess( $mxAccess );
		}
	}
	return  $blAccess;
}

function getGravatar($sEmail, $iSize=null, $sD='identicon') {
	$sUri = Request::isSecure() ? 'https://' : 'http://';
	$sUri .= 'www.gravatar.com/avatar/';
	$sUri .= md5($sEmail);
	if($iSize) {
		$sUri .= '?s=' . (int)$iSize;
	}
	$sUri .= (strstr('?', $sUri)) ? '&d=' . $sD : '?d=' . $sD;
	return $sUri;
}

function concat($sSeparator) {
	$sRetValue = '';
	foreach(func_get_args() as $iI => $sValue) {
		if($iI > 0 && !empty($sValue)) {
			$sRetValue .= $sValue . $sSeparator;
		}
	}
	$iCatting = strlen($sSeparator);
	return substr($sRetValue, 0, -$iCatting);
}