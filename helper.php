<?php
/**
 * @version		$Id: mod_sl_iview_slider.php 2012-09-30 StarLite $
 * @package		StarLite iView Slider
 * @copyright	Copyright (C) 2012 starliteweb.com All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// no direct access
defined('_JEXEC') or die;

class modSL_Iview_SliderHelper
{
	private function __construct(){
	}

	public static function &validParams($params){
		$slide_width	= trim($params->get('slide_width'));
		$slide_width	= (!strlen($slide_width) || ($slide_width == "auto")) ? "auto" : preg_replace('/((\s+)?px)?$/', "", $slide_width)."px";
		$params->set('slide_width', $slide_width);

		$slide_height	= trim($params->get('slide_height'));
		$slide_height	= (!strlen($slide_height) || ($slide_height == "auto")) ? "auto" : preg_replace('/((\s+)?px)?$/', "", $slide_height)."px";
		$params->set('slide_height', $slide_height);

		$titleFontStyle = $params->get('titleFontStyle');
		$titleFontStyle = self::getFontStyle($titleFontStyle);
		$params->set('titleFontStyle', $titleFontStyle);

		$descFontStyle = $params->get('descFontStyle');
		$descFontStyle = self::getFontStyle($descFontStyle);
		$params->set('descFontStyle', $descFontStyle);

		return $params;
	}

	/*
	 * Add jQuery Library to <head> tag
	 */
	public static function addjQuery($source='local', $version='1.8.2'){
		$source = strtolower(trim($source));
		$version = trim($version);
		$doc =& JFactory::getDocument();
		
		switch($source){
			case 'local':
				$doc->addScript("modules/mod_sl_iview_slider/assets/js/jquery-$version.min.js");
				break;
			case 'google':
				$doc->addScript("https://ajax.googleapis.com/ajax/libs/jquery/$version/jquery.min.js");
				break;
			default:
				return false;
		}
		return true;
	}

	
	/*
	 * Get a Parameter in a Parameters String which are separated by a specify symbol (default: vertical bar '|').
	 * Example: Parameters = "value1 | value2 | value3". Return "value2" if positon = 2
	 */
	public static function getParam($param, $position=1, $separator='|'){

		$position = intval($position);

		// Not found the separator in string
		if( strpos($param, $separator) === false ){
			if ( $position == 1 ) return $param;
		}
		// Found the separator in string
		else{
			$param = ($separator = "\n") ? str_replace(array("\r\n","\r"), "\n", $param) : $param;
			$items = explode($separator, $param);
			if ( ($position > 0) && ($position < count($items)+1) ) return $items[$position-1];
		}

		return '';
	}

	/*
	 * Get Vinaora Nivo Slider
	 */
	public static function getSlider($params, $separator = "\n"){


		$slide_width	= $params->get('slide_width');
		$slide_height	= $params->get('slide_height');
		$item_dir		= $params->get('item_dir');
		$captionPosition = $params->get('captionPosition','topleft');

		
		$titles	= $params->get('item_title');
		$titles	= str_replace("|", "\r\n", $titles);

		$descriptions = $params->get('item_description');
		$descriptions = str_replace("|", "\r\n", $descriptions);

		// Get all images
		$items	= self::getItems($params);

		if (empty($items) || !count($items)){
			return ;
		}

		$slider_html = '';
		foreach($items as $i=>$path){


			$title	= self::getParam($titles, $i+1, $separator);
			$title	= trim($title);
			$title	= htmlspecialchars($title, ENT_QUOTES);

			$desc	= self::getParam($descriptions, $i+1, $separator);
			$desc	= trim($desc);
			$desc	= htmlspecialchars($desc, ENT_QUOTES);

			// Get the image name in the full image path
			$image	= strrchr($path, "/");
		
			
			$slider_html.='<div data-iview:image="'.$path.'">';
			// The image has caption (title or description)
			if (strlen($title) || strlen($desc)){
				
				$transitions = array("wipeLeft", "wipeRight", "wipeTop", "wipeBottom", "fade");
				$rand_key = array_rand($transitions);
				$transition = $transitions[$rand_key];
			
				$slider_html.='<div class="iview-caption" data-cap_position="'.$captionPosition.'" data-transition="'.$transition.'">';
				if (strlen($title)) $slider_html .= '<div class="sl-iview-heading">'.$title.'</div>';
				if (strlen($desc)) $slider_html .= '<div class="sl-iview-description">'.$desc.'</div>';
				$slider_html.='</div>';
			}
			$slider_html.='</div>';
				
			
		}
	
		return $slider_html;
	}

	

	/*
	 * Get the font-family
	 */
	public static function getFontStyle($font=""){
		$str = "";
		$str = preg_replace('/(\w+)\s(\w+(\s\w+)?)/', "\"$1 $2\"", $font);
		return $str;
	}

	/*
	 * Get the Paths of Items
	 */
	public static function getItems($params){

		$param	= $params->get('item_path');
		$param	= str_replace(array("\r\n","\r"), "\n", $param);
		$param	= explode("\n", $param);

		// Get Paths from invidual paths
		foreach($param as $key=>$value){
			$param[$key] = self::validPath($value);
		}
		// Remove empty element
		$param = array_filter($param);
		// Get Paths from directory
		if (empty($param)){
			$param	= $params->get('item_dir');
			if ($param == "-1") return null;

			$filter		= '([^\s]+(\.(?i)(jpg|png|gif|bmp))$)';
			$exclude	= array('index.html', '.svn', 'CVS', '.DS_Store', '__MACOSX', '.htaccess');
			$excludefilter = array();
			// array_push($excludefilter, $params->get('controlNavThumbsReplace'));

			$param	= JFolder::files(JPATH_BASE.DS.'images'.DS.$param, $filter, true, true, $exclude, $excludefilter);
			
			foreach($param as $key=>$value){
				$value = substr($value, strlen(JPATH_BASE.DS) - strlen($value));
				$param[$key] = self::validPath($value);
			}
		}

		// Reset keys
		$param = array_values($param);
		
		return $param;
	}

	/*
	 * Get the Valid Path of Item
	 */
	public static function validPath($path){
		$path = trim($path);

		// Check file type is image or not
		if( !preg_match('/[^\s]+(\.(?i)(jpg|png|gif|bmp))$/', $path) ) return '';

		// The path includes http(s) or not
		if( preg_match('/^(?i)(https?):\/\//', $path) ){
			$base = JURI::base(false);
			if (substr($path, 0, strlen($base)) == $base){
				$path = substr($path, strlen($base) - strlen($path));
			}
			else return $path;
		}

		$path = JPath::clean($path, DS);
		$path = ltrim($path, DS);
		if (!is_file(JPATH_BASE.DS.$path)) return '';

		// Convert it to url path
		$path = JPath::clean(JURI::base(true)."/".$path, "/");
		
		return $path;
	}
}
