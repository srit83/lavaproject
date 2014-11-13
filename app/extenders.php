<?php
/**
 * @created 13.11.14 - 11:02
 * @author stefanriedel
 */

\Illuminate\Support\Facades\Blade::extend(function($value) {
	return preg_replace('/\{\?(.+)\?\}/', '<?php ${1} ?>', $value);
});