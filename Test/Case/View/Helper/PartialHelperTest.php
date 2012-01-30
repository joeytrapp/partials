<?php

App::uses('Controller', 'Controller');
App::uses('Helper', 'View');
App::uses('AppHelper', 'View/Helper');
App::uses('PartialHelper', 'Partials.View/Helper');

if (!defined('FULL_BASE_URL')) {
	define('FULL_BASE_URL', 'http://cakephp.org');
}

class PartialTestController extends Controller {

	$this->name = "PartialTest";

	$this->uses = null;

}

class TestPartialHelper extends PartialHelper {

}

class PartialHelperTest extends CakeTestCase {

	/**
	 * setUp method
	 *
	 */
	public function setUp() {
		parent::setUp();
		$this->View = $this->getMock(
			'View',
			array('addScript'),
			array(new PartialTestController())
		);
		$this->Partial = new TestPartialHelper($this->View);
		$this->Partial->request = new CakeRequest(null, false);
		$this->Partial->request->webroot = '';

		ClassRegistry::addObject('Contact', new Contact());		

		Configure::write('Asset.timestamp', false);
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		parent::tearDown();
		unset($this->TwitterBootstrap, $this->View);
	}

	public function test

}

