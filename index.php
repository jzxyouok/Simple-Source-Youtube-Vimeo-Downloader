<?php
require_once "downloader.php";

if(isset($_REQUEST['video'])) {
	header("Content-Type: application/json"); // set header to json

	if(isset($_GET['url'])) {
		$url = htmlentities($_GET['url']);

		Downloader::__init__($url);

		switch($_GET['video']) {
			case 'youtube':
				Downloader::youtube();
				break;
			case 'vimeo':
				Downloader::vimeo();
				break;
			default:;
		}		
	}
}