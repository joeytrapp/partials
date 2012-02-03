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
		$content = "";
		$_path = $this->_path($path);
		if (array_key_exists("collection", $options) && is_array($options["collection"])) {
			foreach ($options["collection"] as $item) {
				$_data = array_merge($data, array($this->_partialName($path) => $item));
				$content .= $this->_element($_path, $_data, $options);
			}
		} else {
			$content = $this->_element($_path, $data, $options);
		}
		return $content;
	}

	/**
	 * Wrapping the View::element call in its own method to make
	 * testing easier. 
	 * 
	 * @param mixed $path 
	 * @param mixed $data 
	 * @param mixed $options 
	 * @access protected
	 * @return void
	 */
	protected function _element($path, $data, $options) {
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

	/**
	 * Splits the path by / and returns the last item in the array.
	 * 
	 * @param string $path 
	 * @access protected
	 * @return string
	 */
	protected function _partialName($path) {
		$_path = explode("/", $path);
		return $_path[(count($_path) - 1)];
	}
}

