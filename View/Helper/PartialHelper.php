<?php
/**
 * PartialHelper 
 * 
 * @uses AppHelper
 * @package 
 * @version 1.0
 * @author Joey Trapp <jtrapp07@gmail.com> 
 */
class PartialHelper extends AppHelper {

	/**
	 * Renders elements from the current viewPath directory instead of
	 * the Elements directory. 
	 * 
	 * @param string $method
	 * @param array $data
	 * @param array $options
	 * @access public
	 * @return string
	 */
	public function render($path, $data = array(), $options = array()) {
		$path = $this->_path($path);
		return $this->_View->element($path, $data, $options);
	}

	/**
	 * Parses the path and returns the path relative to the Elements
	 * directory.
	 * 
	 * @param string $path 
	 * @access protected
	 * @return string
	 */
	protected function _path($path) {
		$real_path = "";
		if ($path[0] === "/") {
			$_path = explode("/", $path);
			$_path[count($_path) - 1] = "_{$_path[count($_path) - 1]}";
			$path = implode("/", $_path);
			$real_path = "..{$path}";
		} else {
			$real_path = "../{$this->_View->viewPath}/_{$path}";
		}
		return $real_path;
	}
}

