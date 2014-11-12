<?php
/**
 * @created 05.11.14 - 13:38
 * @author stefanriedel
 */

namespace Lavaproject;


use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LavaprojectServiceProvider extends ServiceProvider {

	/**
	 * @var AliasLoader
	 */
	protected $_oAliasLoader;

	public function register() {
		$this->_oAliasLoader = AliasLoader::getInstance();
		foreach (
			[
				'Email'
			] as $sObject
		) {
			$this->{"register$sObject"}();
		}
	}

	public function registerEmail() {
		$this->app->booting( function () {
			$this->_oAliasLoader->alias( 'Email', 'Lavaproject\Facades\Email' );
		} );
	}

}