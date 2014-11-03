<?php
/**
 * @created 28.10.14 - 15:05
 * @author stefanriedel
 */

function __($sId, $aParameters = array(), $sDomain = 'messages', $sLocale = null) {
	return trans($sId, $aParameters, $sDomain, $sLocale);
}

function hasAccess($mxAccess) {
	$oUser = Sentry::getUser();
	if(is_array($mxAccess)) {
		$blAccess = $oUser->hasAnyAccess($mxAccess);
	} else {
		$blAccess = $oUser->hasAccess($mxAccess);
	}
	return $oUser->isSuperUser() || $blAccess;
}
