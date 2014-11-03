<?php
/**
 * @created 29.10.14 - 11:02
 * @author stefanriedel
 */

class DashBoardController extends BaseController {

	public function show() {
		return View::make('dashboard/show');
	}

}