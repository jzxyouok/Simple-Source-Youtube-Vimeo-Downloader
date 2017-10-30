<?php
/**
 * @author Nopik Purnawan <pikoncoder@gmail.com>
 * @license Private 1.0
 *
 * Code: Rapid-Cycle
 * 
 */

/**
 * Environment setup for debugging
 * 
 * development = enable
 * production = disable
 * 
 */
define('ENVIRONMENT', 'development'); 

switch(ENVIRONMENT) {
	case 'production': error_reporting(0); break;
	case 'development': error_reporting(E_ALL); break;
}

require_once "downloader.php";

if(isset($_REQUEST['video'])) {
	header("Content-Type: application/json"); // set header to json

	if(isset($_POST['url'])) {
		$url = htmlentities($_POST['url']);

		Downloader::__init__($url);

		switch($_POST['video']) {
			case 'youtube': Downloader::youtube(); break;
			case 'vimeo': Downloader::vimeo(); break;
			default:;
		}		
	}
}