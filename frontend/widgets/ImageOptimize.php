<?php

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\VarDumper;

/**
 * Image optimization widget for Yii2 Framework with auto WebP image format generation from PNG/JPG files.
 * What it does? Instead of static images like this:
 * ```html
 * <img src="/images/product/extra.png" alt="Extra product">
 * ```
 * It will generate an extra WebP image file (in the same directory the provided
 * image is located) and serve it to your browser in HTML code, with a default
 * fallback to the original image for browsers that doesn't support WebP images.
 * Replace your IMG tag within your templates with a call to:
 * ```php
 * <?= \pelock\imgopt\ImgOpt::widget(["src" => "/images/product/extra.png", "alt" => "Extra product" ]) ?>
 * ```
 *  And it will generate a WebP image file (original image is left untouched) and
 *  the following HTML code gets generated:
 * ```html
 * <picture>
 *     <source type="image/webp" srcset="/images/product/extra.webp">
 *     <img src="/images/product/extra.png" alt="Extra product">
 * </picture>
 * ```
 * You can also generate Lightbox (https://lokeshdhakar.com/projects/lightbox2/) friendly images.
 * Instead of:
 * ```html
 * <a href="/images/sunset.jpg" data-lightbox="image-1" data-title="Sunset">
 *     <img src="/images/sunset-thumbnail.jpg" alt="Sunset">
 * </a>
 * ```
 * You can replace it with more compact widget code:
 * ```php
 * <?= \pelock\imgopt\ImgOpt::widget(["lightbox_data" => "image-1", "lightbox_src" => "/images/sunset.jpg', "src" => "/images/sunset-thumbnail.jpg', "alt" => "Sunset" ]) ?>
 * ```
 * And it will generate this HTML code:
 * ```html
 * <a href="/images/sunset.jpg" data-lightbox="image-1" data-title="Sunset">
 *     <picture>
 *         <source type="image/webp" srcset="/images/sunset-thumbnail.webp">
 *         <img src="/images/sunset-thumbnail.png" alt="Sunset">
 *     </picture>
 * </a>
 * ```
 * @property string $src image source relative to the @webroot Yii2 alias (required)
 * @property string $alt image alternative description used as alt="description" property (optional)
 * @property string $css image class list as a string (can contain multiple classes) used as class="one two three..." (optional)
 * @property string $style image custom CSS styles used as style="one; two; three;..." (optional)
 * @property string $loading lazy loading option (auto|lazy|eager) (https://web.dev/browser-level-image-lazy-loading/) (optional)
 * @property string $itemprop use schema itemprop="image" value (optional)
 * @property string $height  height used as height="value" (optional)
 * @property string $width width used as width="value" (optional)
 * @property string $lightbox_data Lightbox attribute data-lightbox="image-1" etc. (optional)
 * @property string $lightbox_src Lightbox HREF to the original image file, if not set $src param will be used (optional)
 * @property string $lightbox_title Lightbox description title, if not set $alt param will be used (optional)
 * @property bool $recreate set to TRUE to recreate the WebP file again (optional)
 * @property bool $disable set to TRUE to disable WebP images serving (optional)
 * @author Bartosz Wójcik <support@pelock.com>
 */
class ImageOptimize extends Widget{
	/**
	 * @var string image source relative to the @webroot Yii2 alias (required)
	 */
	public $src;
	public $srcset;
	public $sizes;
	public $sizes_line;
	
	/**
	 * @var string path to the generated WebP file format (short path) or null
	 */
	private $_webp;
	
	/**
	 * @var string image alternative description used as alt="description" property (optional)
	 */
	public $alt;
	
	/**
	 * @var string image class list as a string (can contain multiple classes) used as class="one two three..." (optional)
	 */
	public $css;
	
	/**
	 * @var string image custom CSS styles used as style="one; two; three;..." (optional)
	 */
	public $style;
	
	/**
	 * @var string lazy loading option (auto|lazy|eager) (https://web.dev/browser-level-image-lazy-loading/) (optional)
	 */
	public $lazyload = '';
	
	/**
	 * @var string use schema itemprop="image" value (optional)
	 */
	public $itemprop;
	
	/**
	 * @var string image height used as height="value" (optional)
	 */
	public $height;
	
	/**
	 * @var string image width used as width="value" (optional)
	 */
	public $width;
	
	/**
	 * @var string Lightbox attribute data-lightbox="image-1" etc. (optional)
	 */
	public $lightbox_data;
	
	/**
	 * @var string Lightbox HREF to the original image file, if not set $src param will be used (optional)
	 */
	public $lightbox_src;
	
	/**
	 * @var string Lightbox description title, if not set $alt param will be used (optional)
	 */
	public $lightbox_title;
	
	/**
	 * @var bool set to TRUE to recreate the WebP file again (optional)
	 */
	public $recreate = false;
	
	/**
	 * @var bool set to TRUE to recreate *ALL* of the WebP files again (optional)
	 */
	const RECREATE_ALL = false;
	
	/**
	 * @var bool set to TRUE to disable WebP images serving (optional)
	 */
	public $disable = false;
	
	public $display_original = false;
	
	public $quality = 100;
	
	/**
	 * @var string disable WebP files usages at all (use it for debugging purposes) (optional)
	 */
	const DISABLE_WEBP = false;
	
	/**
	 * Generates optimized WebP file from the provided image, relative to the
	 * Yii2 @webroot file alias.
	 *
	 * @param string $img Relative path to the image in @webroot Yii2 directory
	 * @param bool $recreate Recreate the WebP file again
	 *
	 * @return string|null Path to the WebP file (relative to @webroot) or null (marks usage of the original image only)
	 */
	private function getOrConvertToWebp($img, $recreate = false){
		if(self::DISABLE_WEBP || $this->disable){
			return null;
		}
		
		// build full path to the image (relative to the webroot)
		$web_root = Yii::getAlias('@webroot');
		$img_full_path = $web_root.$img;
		// check if the source image exist
		if(file_exists($img_full_path) === false){
			return null;
		}
		
		// modification time of the original image
		$img_modification_time = filemtime($img_full_path);
		
		$original_file_size = filesize($img_full_path);
		
		if($original_file_size === 0){
			return null;
		}
		
		// get path details (full path & short path details)
		$short_file_info = pathinfo($img);
		$file_info       = pathinfo($img_full_path);

		$ext = strtolower($file_info["extension"]);
		
		if($ext == 'svg'){
			return null;
		}
		
		$webp_filename_with_extension = $short_file_info["filename"].".webp";
		
		$webp_short_path = $short_file_info["dirname"]."/".$webp_filename_with_extension;
		$webp_full_path  = $file_info["dirname"]."/".$webp_filename_with_extension;
		
		// if the WEBP file already exists check if we want to re-create it
		if($recreate === false && file_exists($webp_full_path)){
			
			// if the WEBP file is bigger than the original image
			// use the original image
			if(filesize($webp_full_path) >= $original_file_size){
				return null;
			}
			
			$webp_modification_time = filemtime($webp_full_path);
			
			// if the modification dates on the original image
			// and WEBP image are the same = use the WEBP image
			// in any other case - recreate the file
			if($img_modification_time !== false && $webp_modification_time !== false){
				if($img_modification_time === $webp_modification_time){
					return $webp_short_path;
				}
			}
		}
		
		if($ext === "png"){
			$img = imagecreatefrompng($img_full_path);
			imagepalettetotruecolor($img);
			imagealphablending($img, true);
			imagesavealpha($img, true);
		}else if($ext === "jpg" || $ext === "jpeg"){
			$img = imagecreatefromjpeg($img_full_path);
			imagepalettetotruecolor($img);
		}
		
		// start with 100 quality
		#$quality = 100;
		
		// generate WEBP in the best possible quality
		// and file size less than the original
		do{
			// generate output WEBP file
			imagewebp($img, $webp_full_path, $this->quality);
			
			// decrease quality
			$this->quality -= 5;
			
			// no point in going below 20% quality
			if($this->quality < 5){
				break;
			}
		}while(filesize($webp_full_path) >= $original_file_size);
		
		// release input image
		imagedestroy($img);
		
		
		// set modification time on the WEBP file to match the
		// modification time of the original image
		if($img_modification_time !== false){
			touch($webp_full_path, $img_modification_time);
		}
		
		
		// if the final WEBP image is bigger than the original file
		// don't use it (use the original only)
		if(filesize($webp_full_path) >= $original_file_size){
			return null;
		}
		
		return $webp_short_path;
	}
	
	public function init(){
		parent::init();
		
		if(strpos($this->src, '/frontend/web') !== false){
			$this->src = str_replace('/frontend/web', '', $this->src);
		}

		$this->_webp = $this->getOrConvertToWebp($this->src, (self::RECREATE_ALL == true || $this->recreate == true));
		
		$generate_sizes_auto = empty($this->sizes);
		
		if(is_array($this->srcset) && !empty($this->srcset)){
			foreach($this->srcset as $k => $v){
				if(strpos($v['src'], '/frontend/web') !== false){
					$v['src'] = str_replace('/frontend/web', '', $v['src']);
				}
				
				$_webp = $this->getOrConvertToWebp($v['src'], (self::RECREATE_ALL == true || $this->recreate == true));
				if($_webp)
					$this->srcset[$k]['src'] = $_webp;
				
				if(isset($v['media_point']) && isset($v['media_size'])){
					if($generate_sizes_auto){
						$this->sizes[] = sprintf('(%s: %s) %s', $v['media_point'], $v['media_size'], $v['media_size']);
					}
					$this->srcset[$k]['media'] = sprintf('(%s: %s) %s', $v['media_point'], $v['media_size'], $v['media_size']);
				}
			}
		}
		
		if(!empty($this->sizes)){
			if(is_array($this->sizes)){
				$this->sizes_line = implode(', ', $this->sizes);
			}
		}
		
		// handle Lightbox parameters
		if($this->lightbox_data){
			// if lightbox source image is not defined
			// use the default image source (you might want
			// to use thumbnail as an image BUT full res
			// image for lightbox presentation)
			if($this->lightbox_src === null){
				$this->lightbox_src = $this->src;
			}
			
			// same for lightbox title
			if($this->lightbox_title === null){
				$this->lightbox_title = $this->alt;
			}
		}
	}
	
	public function run(){
		// our unoptimized image (include all the possible attributes)
		$params = [
			"class"    => $this->css,
			"style"    => $this->style,
			"alt"      => $this->alt,
			"height"   => $this->height,
			"width"    => $this->width,
			"lazyload"  => $this->lazyload,
			"itemprop" => $this->itemprop,
			"sizes"    => $this->sizes_line,
		];
		
		if(!empty($this->srcset)){
			foreach($this->srcset as $k => $v){
				$params['srcset'][] = $v['src'].' '.$v['size'];
			}
			$params['srcset'] = implode(', ', $params['srcset']);
			if(!empty($this->lazyload)){
				$params['data-srcset'] = $params['srcset'];
				$params['data-sizes'] = $params['sizes'];
				unset($params['srcset'], $params['sizes']);
			}
		}
		
		if(!empty($this->lazyload)){
			$params['data-src'] = $this->src;
			if(strpos($this->src, '.svg') === false){
				$this->src = '';
			}
		}
		
		$img_original = Html::img($this->src, $params);
		
		// was WebP image generated from our unoptimized image?
		if($this->_webp){
			if(!empty($this->lazyload)){
				$params['data-src'] = $this->_webp;
				$params['data-lazy'] = $this->_webp;
				$img_webp = Yii::$app->Helpers->getImage($params);
			}else{
				$img_webp = Html::img($this->_webp, $params);
			}
			
			$html = '';
			
			// include it within <picture> tag
			/*$html .= "<picture>";
			if(!empty($this->srcset)){
				foreach($this->srcset as $k => $v){
					$html .= Html::tag("source", [], ["srcset" => $v['src'], "type" => "image/webp", "media" => $v['media']]);
				}
			}else{
				$html .= Html::tag("source", [], ["srcset" => $this->_webp, "type" => "image/webp"]);
			}*/
			$html .= $img_webp;
			
			// fallback image (unoptimized)
			if($this->display_original){
				$html .= $img_original;
			}
			#$html .= "</picture>";
			
		}else{
			#VarDumper::dump($img_original, 10, 1);
			$html = $img_original;
		}
		
		// if lightbox attribute is present - wrap the image into a lightbox friendly
		// <a href link
		if($this->lightbox_data){
			return Html::a($html, $this->lightbox_src, ["data-lightbox" => $this->lightbox_data, "data-title" => $this->lightbox_title]);
		}
		
		return $html;
	}
}
