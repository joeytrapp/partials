<?php

App::uses('Controller', 'Controller');
App::uses('Helper', 'View');
App::uses('AppHelper', 'View/Helper');
App::uses('PartialHelper', 'Partials.View/Helper');

if (!defined('FULL_BASE_URL')) {
	define('FULL_BASE_URL', 'http://cakephp.org');
}

class PartialTestController extends Controller {

	public $name = "PartialTest";

	public $uses = null;

}

class TestPartialHelper extends PartialHelper {

	public function path($path) {
		return $this->_path($path);
	}

	public function partialName($path) {
		return $this->_partialName($path);
	}

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

		App::build(array(
			'plugins' => array(CAKE . 'Test' . DS . 'test_app' . DS . 'Plugin' . DS),
			'View' => array(
				CAKE . 'Test' . DS . 'test_app' . DS . 'View'. DS
			)
		), true);
		CakePlugin::load(array('TestPlugin', 'TestPlugin', 'PluginJs'));
		Configure::write('debug', 2);
		
		Configure::write('Asset.timestamp', false);
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		parent::tearDown();
		unset($this->Partial, $this->View);
	}

	/**
	 * testExposesRenderMethod 
	 * 
	 * @access public
	 * @return void
	 */
	public function testExposesRenderMethod() {
		$this->assertTrue(method_exists($this->Partial, "render"));
	}

	/**
	 * testParsesPartialName 
	 * 
	 * @access public
	 * @return void
	 */
	public function testParsesPartialName() {
		$expected = "../PartialTest/_partial";
		$path = $this->Partial->path("partial");
		$this->assertEquals($path, $expected);
	}

	/**
	 * testParsesPartialNameWithASlash 
	 * 
	 * @access public
	 * @return void
	 */
	public function testParsesPartialNameWithASlash() {
		$expected = "../Something/_partial";
		$path = $this->Partial->path("/Something/partial");
		$this->assertEquals($path, $expected);
	}

	/**
	 * testPartialName 
	 * 
	 * @access public
	 * @return void
	 */
	public function testPartialName() {
		$expected = "partial";
		$partial = $this->Partial->partialName("partial");
		$this->assertEquals($partial, $expected);
		$partial = $this->Partial->partialName("SubDir/partial");
		$this->assertEquals($partial, $expected);
		$partial = $this->Partial->partialName("/Elements/partial");
		$this->assertEquals($partial, $expected);
	}

}

