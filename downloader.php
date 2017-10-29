<?php
/**
 * @author Nopik Purnawan <pikoncoder@gmail.com>
 * @license Private 1.0
 *
 * Code: Rapid-Cycle
 * 
 */
class Downloader {

	static protected $url;
	static protected $video_id;

	public static function __init__($value) {
		self::$url = $value; self::validation();
	}

	protected static function validation() {
		/**
		 * only allowed url
		 * 
		 */
		$allowed = 'youtube|vimeo';

		/**
		 * it can be http or https and start with www.$allowed
		 * @return $this->video_id;
		 * 
		 */
		if(preg_match('/^(http|https):\/\/(www\.)\b('.$allowed.')\b/i', self::$url)) {
			$video_id = explode('?v=', self::$url);
		}

		return self::$video_id = $video_id[1];
	}

	protected static function __cache__($folder, $video_id, $url = null) {
		$path = 'cache';

		if(file_exists($path . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR. $video_id)) {
			$data = file_get_contents($path . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $video_id);
		} else {
			/**
			 * Get from external content and
			 * store to cache folder
			 * 
			 */
			$data = file_get_contents($url);
			file_put_contents($path . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $video_id, $data);
		}

		return $data;
	}

	public static function youtube() {	
		/**
		 * check cache in __cache__ function, 
		 * 
		 */
		$url = 'http://youtube.com/get_video_info?video_id=' . self::$video_id;

		$content = self::__cache__('youtube', self::$video_id, $url);

		parse_str($content, $info);

		$streams = $info['url_encoded_fmt_stream_map'];
		$streams = explode(',', $streams);

		/**
		 * output json object
		 * 
		 */
		foreach($streams as $stream) {
			parse_str($stream, $data);
			echo json_encode($data);
		}
	}

	public static function vimeo() {
		phpinfo();
	}

}