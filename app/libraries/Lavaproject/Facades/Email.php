<?php
/**
 * @created 05.11.14 - 13:44
 * @author stefanriedel
 */

namespace Lavaproject\Facades;


use Illuminate\Support\Facades\Facade;

class Email extends Facade {
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'Lavaproject\Email';
	}
}