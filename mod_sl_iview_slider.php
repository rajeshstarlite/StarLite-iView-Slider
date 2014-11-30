<?php
/**
 * @version		$Id: mod_sl_iview_slider.php 2012-09-30 StarLite $
 * @package		StarLite iView Slider
 * @copyright	Copyright (C) 2012 starliteweb.com All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// no direct access
defined('_JEXEC') or die;

// Require the base helper class only once
require_once dirname(__FILE__).DS.'helper.php';

$module_id	= $module->id;
$base_url	= rtrim(JURI::base(true), "/");
$doc =& JFactory::getDocument();

$doc->addStyleSheet(JURI::base().'modules/mod_sl_iview_slider/assets/css/iview.css');
$doc->addStyleSheet(JURI::base().'modules/mod_sl_iview_slider/assets/css/skin1/style.css');


$source = $params->get('jquery_source', 'local');
$version = $params->get('jquery_version', '1.8.2');

modSL_Iview_SliderHelper::addjQuery($source, $version);
$doc->addScript(JURI::base().'modules/mod_sl_iview_slider/assets/js/raphael-min.js');
$doc->addScript(JURI::base().'modules/mod_sl_iview_slider/assets/js/jquery.easing.js');
$doc->addScript(JURI::base().'modules/mod_sl_iview_slider/assets/js/iview.js');



$fx	= $params->get('fx');
$strips	= $params->get('strips',20);
$blockCols = $params->get('blockCols',10); 
$blockRows = $params->get('blockRows',5);
$animationSpeed = $params->get('animationSpeed',500);
$pauseTime = $params->get('pauseTime',5000);
$startSlide = $params->get('startSlide',0);
$captionSpeed = $params->get('captionSpeed',500);
$captionOpacity = $params->get('captionOpacity',1);
$captionBackground = $params->get('captionBackground','#000000');
$directionNav = $params->get('directionNav',1);
$directionNavHoverOpacity = $params->get('directionNavHoverOpacity',0.6);
$controlNav = $params->get('controlNav','0');
$controlNavHoverOpacity = $params->get('controlNavHoverOpacity',0.6);
$pauseOnHover = $params->get('pauseOnHover',0);
$previousLabel =htmlspecialchars($params->get('previousLabel','Prev'), ENT_QUOTES);
$nextLabel = htmlspecialchars($params->get('nextLabel','Next'), ENT_QUOTES);
$titleColor = $params->get('titleColor','#FFFFFF');
$titleFontSize = $params->get('titleFontSize',18);
$titleFontStyle	= $params->get('titleFontStyle');
$descColor = $params->get('descColor','#FFFFFF');
$descFontSize = $params->get('descFontSize',12);
$descFontStyle = $params->get('descFontStyle');
$descFontStyle	= $params->get('descFontStyle');
$timer	= $params->get('timer','Pie');
$timerPosition = $params->get('timerPosition','top-right');
$timerBg = $params->get('timerBg','#000000');
$timerColor = $params->get('timerColor','#EEEEEE');
$timerOpacity = $params->get('timerOpacity',0.5);
$timerDiameter = $params->get('timerDiameter',30);
$timerStroke = $params->get('timerStroke',3);
$timerBarStroke = $params->get('timerBarStroke',1);
$timerBarStrokeColor = $params->get('timerBarStrokeColor','#EEEEEE');

$params = modSL_Iview_SliderHelper::validParams($params);
$slide_width = $params->get('slide_width');
$slide_height = $params->get('slide_height');

$slider	= modSL_Iview_SliderHelper::getSlider($params);

if(empty($slider)) $slider_blank = JText::_('MOD_SL_IVIEW_SLIDER_ERROR_IMAGE_NOT_FOUND');

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
require JModuleHelper::getLayoutPath('mod_sl_iview_slider','default');
