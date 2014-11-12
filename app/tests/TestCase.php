<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	public function setUp() {
		parent::setUp();
		$this->_prepareForTests();
	}

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	protected function _prepareForTests()
	{
		\Artisan::call('migrate', [
			'--package' => 'cartalyst/sentry'
		]);
		Artisan::call('migrate');
	}

}
