<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\VarDumper;

class Helpers extends Component{

	public static function get_svg_inline($filename){
		$filename = Yii::getAlias('@app/web/img/'.$filename);
		
		return file_get_contents($filename);
	}

	public function getImage($params){
		if($params['from_cdn']){
			$params['src'] = ltrim($params['src'], '/');
			$params['src'] = Yii::$app->params['cdnUrl'].DIRECTORY_SEPARATOR.$params['src'];
		}
		
		if($params['lazyload']){
			$image_attrs = $this->getImageSize(Yii::getAlias('@frontend/web/'.trim($params['src'], '/')));
			if($image_attrs !== false){
				$params = array_merge($params, $image_attrs);
			}
			#VarDumper::dump($params, 10, 1);
			
			if(!isset($params['data-src'])){
				$params['data-src'] = $params['src'];
				unset($params['src']);
			}
			
			if(!isset($params['class'])){
				$params['class'] = '';
			}
			$params['class'] .= ' lazy';
		}
		
		return '<img '.implode(' ', array_map(function($k, $v){return $k.'="'.$v.'"';}, array_keys($params), array_values($params))).' />';
	}
	
	/**
	 * Separate HTML elements and comments from the text.
	 *
	 * @since 4.2.4
	 *
	 * @param string $input The text which has to be formatted.
	 * @return string[] Array of the formatted text.
	 */
	public static function yii_html_split( $input ) {
		return preg_split( self::get_html_split_regex(), $input, -1, PREG_SPLIT_DELIM_CAPTURE );
	}
	
	/**
	 * Retrieve the regular expression for an HTML element.
	 *
	 * @since 4.4.0
	 *
	 * @return string The regular expression
	 */
	public static function get_html_split_regex() {
		static $regex;
		
		if ( ! isset( $regex ) ) {
			// phpcs:disable Squiz.Strings.ConcatenationSpacing.PaddingFound -- don't remove regex indentation
			$comments =
				'!'             // Start of comment, after the <.
				. '(?:'         // Unroll the loop: Consume everything until --> is found.
				.     '-(?!->)' // Dash not followed by end of comment.
				.     '[^\-]*+' // Consume non-dashes.
				. ')*+'         // Loop possessively.
				. '(?:-->)?';   // End of comment. If not found, match all input.
			
			$cdata =
				'!\[CDATA\['    // Start of comment, after the <.
				. '[^\]]*+'     // Consume non-].
				. '(?:'         // Unroll the loop: Consume everything until ]]> is found.
				.     '](?!]>)' // One ] not followed by end of comment.
				.     '[^\]]*+' // Consume non-].
				. ')*+'         // Loop possessively.
				. '(?:]]>)?';   // End of comment. If not found, match all input.
			
			$escaped =
				'(?='             // Is the element escaped?
				.    '!--'
				. '|'
				.    '!\[CDATA\['
				. ')'
				. '(?(?=!-)'      // If yes, which type?
				.     $comments
				. '|'
				.     $cdata
				. ')';
			
			$regex =
				'/('                // Capture the entire match.
				.     '<'           // Find start of element.
				.     '(?'          // Conditional expression follows.
				.         $escaped  // Find end of escaped element.
				.     '|'           // ...else...
				.         '[^>]*>?' // Find end of normal element.
				.     ')'
				. ')/';
			// phpcs:enable
		}
		
		return $regex;
	}
	
	/**
	 * Retrieve a list of protocols to allow in HTML attributes.
	 *
	 * @since 3.3.0
	 * @since 4.3.0 Added 'webcal' to the protocols array.
	 * @since 4.7.0 Added 'urn' to the protocols array.
	 * @since 5.3.0 Added 'sms' to the protocols array.
	 *
	 * @see wp_kses()
	 * @see esc_url()
	 *
	 * @return string[] Array of allowed protocols. Defaults to an array containing 'http', 'https',
	 *                  'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet',
	 *                  'mms', 'rtsp', 'sms', 'svn', 'tel', 'fax', 'xmpp', 'webcal', and 'urn'.
	 *                  This covers all common link protocols, except for 'javascript' which should not
	 *                  be allowed for untrusted users.
	 */
	public static function yii_allowed_protocols() {
		static $protocols = array();
		
		if ( empty( $protocols ) ) {
			$protocols = array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'mms', 'rtsp', 'sms', 'svn', 'tel', 'fax', 'xmpp', 'webcal', 'urn' );
		}
		
		
		return $protocols;
	}
	
	public function getImageSize($image_file){
		if(!file_exists($image_file)){
			return false;
		}
		
		$path_parts = pathinfo($image_file);
		
		if($path_parts['extension'] == 'svg'){
			$image_info = $this->getSVGSize($image_file);
			$params['width']  = $image_info['width'];
			$params['height'] = $image_info['height'];
			$params['type']   = $path_parts['extension'];
			
			return $params;
		}else{
			if(function_exists('getimagesize')){
				list($img_width, $img_height, $img_type, $img_attr) = @getimagesize($image_file);
				
				$params['width']  = $img_width;
				$params['height'] = $img_height;
				$params['type']   = $img_type;
				
				return $params;
			}else{
				#VarDumper::dump('Function not found: getimagesize', 10, 1);
				return false;
			}
		}
	}
	
	public function getSVGSize($file_path){
		if(!file_exists($file_path)){
			return '';
		}

		$svg_content = file_get_contents($file_path);
		$svgXML = simplexml_load_string($svg_content);
		list($originX, $originY, $relWidth, $relHeight) = explode(' ', $svgXML['viewBox']);
		unset($svgXML);
		
		return [
			'x' => $originX,
			'y' => $originY,
			'width' => $relWidth,
			'height' => $relHeight,
			#'xml' => $svg_content
		];

	}
	
	public function bootstrap_icon($icon_name, $wrap_class = '', $return_attrs = false){
		$ret = '';
		
		$icons_list = json_decode(file_get_contents(CSS_DIR.'/bootstrap-icons.json'), true);
		
		if(!in_array($icon_name, array_keys($icons_list)))
			return $ret;
		
		$file_path = ICONS_DIR.'/bootstrap/'.$icon_name.'.svg';
		
		if($return_attrs){
			$svg_content = file_get_contents($file_path);
			$svgXML = simplexml_load_string($svg_content);
			list($originX, $originY, $relWidth, $relHeight) = explode(' ', $svgXML['viewBox']);
			unset($svgXML);
			
			$ret = ['x' => $originX, 'y' => $originY, 'width' => $relWidth, 'height' => $relHeight, 'xml' => $svg_content];
		}else{
			$ret = '<i class="b-icon '.$icon_name.' '.$wrap_class.'">'.file_get_contents($file_path).'</i>';
		}
		
		return $ret;
	}
	
	public function createExcerpt($text, $max_length = 100){
		$_text = strip_tags($text);
		if(mb_strlen($_text, 'utf-8') <= $max_length){
			return $_text;
		}
		
		$_text = trim($_text, ".,?:><;");
		$a = explode(' ', $_text);
		
		$r = '';
		$n = array();
		foreach($a as $k => $t){
			$r .= $t.' ';
			if(mb_strlen($r, 'utf-8') >= $max_length){
				continue;
			}else{
				$n[$k] = $t;
			}
		}
		
		return implode(' ', $n).'...';
		
	}
	
	/**
	 * This routine calculates the distance between two points (given the
	 * latitude/longitude of those points). It is being used to calculate
	 * the distance between two locations using GeoDataSource(TM) Products
	 *
	 * Definitions: South latitudes are negative, east longitudes are positive
	 *
	 * Passed to function:
	 *    lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)
	 *    lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)
	 *    unit = the unit you desire for results
	 *           where: 'M' is statute miles (default)
	 *                  'K' is kilometers
	 *                  'N' is nautical miles
	 * Worldwide cities and other features databases with latitude longitude are available at https://www.geodatasource.com
	 * Official Web site: https://www.geodatasource.com
	 *
	 * Examples:
	 * echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
	 * echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";
	 * echo distance(32.9697, -96.80322, 29.46786, -98.53506, "N") . " Nautical Miles<br>";
	 */
	public function distance($lat1, $lon1, $lat2, $lon2, $unit, $round = 2){
		$ret = 0;
		
		if(($lat1 == $lat2) && ($lon1 == $lon2)){

		}else{
			$theta = $lon1 - $lon2;
			$dist  = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist  = rad2deg(acos($dist));
			$miles = $dist * 60 * 1.1515;
			$unit  = strtoupper($unit);
			
			if($unit == "K"){
				$ret = ($miles * 1.609344);
			}else if($unit == "N"){
				$ret = ($miles * 0.8684);
			}else{
				$ret = $miles;
			}
		}
		
		return number_format($ret, $round, '.', '');
	}
	
}
