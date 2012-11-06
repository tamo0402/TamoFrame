<?php

namespace TamoFrame\Core;


require_once COREPATH . '/vender/Twig/Autoloader.php';

class Twig {

	public $twig;

	// classにする意味あんまないな。
	public function __construct($addPath) {

		\Twig_Autoloader::register();

		if ($addPath != "") {
    		$loader = new \Twig_Loader_Filesystem(APPPATH.$addPath.'/view/');
		} else {
		    $loader = new \Twig_Loader_Filesystem(APPPATH.'view/');
		}

		// extension
		$escaper = new \Twig_Extension_Escaper(true);

		// options
		$options = array('cache' => APPPATH . 'cache/', 'debug' => true);

		$this->twig = new \Twig_Environment($loader, $options);
		$this->twig->addExtension($escaper);
	}

	public function getTwig() {
		return $this->twig;
	}
}