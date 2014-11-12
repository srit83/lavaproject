<?php

class HomeController extends BaseController {


	public function changeLang($sLocale=null) {
		LaravelGettext::setLocale($sLocale);
		Session::flash('success', _('Sprache erfolgreich geändert'));
		return Redirect::to(URL::previous());
	}

}
