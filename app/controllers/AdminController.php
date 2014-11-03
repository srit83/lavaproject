<?php
/**
 * @created 29.10.14 - 12:08
 * @author stefanriedel
 */

class AdminController extends BaseController {
	public function index() {
		return View::make('admin.index');
	}
}