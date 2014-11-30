<?php
/**
 * @version		$Id: mod_sl_iview_slider.php 2012-09-30 StarLite $
 * @package		StarLite iView Slider
 * @copyright	Copyright (C) 2012 starliteweb.com All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// no direct access
defined('_JEXEC') or die;
?>
<div  class="sl_iview_slider<?php echo $moduleclass_sfx?>"> 
<?php
if(!empty($slider)){ 
?>
<style type="text/css">
#iview<?php echo $module_id; ?> {
	display: block;
	width:<?php echo $slide_width;?> !important; /* Make sure your images are the same size */
	height:<?php echo $slide_height;?>  !important; /* Make sure your images are the same size */
	background: #000;
	background: rgba(0, 0, 0, 0.7);
	padding: 5px;
	border-radius: 5px;
	position: relative;
	/*-webkit-box-shadow: 0 38px 30px -18px rgba(0, 0, 0, 0.5);
	-moz-box-shadow: 0 38px 30px -18px rgba(0, 0, 0, 0.5);
	box-shadow: 0 38px 30px -18px rgba(0, 0, 0, 0.5);*/
	margin: 40px auto;
}

#iview<?php echo $module_id; ?> .iviewSlider {
	display: block;
	width:<?php echo $slide_width;?>; /* Make sure your images are the same size */
	height:<?php echo $slide_height;?>; /* Make sure your images are the same size */
	overflow: hidden;
	border-radius: 4px;
}
#iview<?php echo $module_id; ?> .iview-caption {
	background: <?php echo $captionBackground;?>;
}
#iview<?php echo $module_id; ?> .sl-iview-heading{
	<?php if(strlen($titleFontStyle)) { ?>
	font-family: <?php echo $titleFontStyle;?> !important;
<?php } ?>
	font-size:<?php echo $titleFontSize;?>px !important;
	color:<?php echo $titleColor;?> !important;
}
#iview<?php echo $module_id; ?> .sl-iview-description{
	<?php if(strlen($descFontStyle)) { ?>
	font-family: <?php echo $descFontStyle;?> !important;
<?php } ?>
	font-size:<?php echo $descFontSize;?>px !important;
	color:<?php echo $descColor;?> !important;
}

#iview<?php echo $module_id; ?> #iview-tooltip {
	display: none;
	position: absolute;
	width: 124px;
	height: 100px;
	bottom: 30px;
	left: -67px;
	padding: 10px;
	z-index: 100;
}

#iview<?php echo $module_id; ?> #iview-tooltip div.holder {
	display: block;
	width: 124px;
	height: 84px;
	overflow: hidden;
	border-radius: 2px;
}

#iview<?php echo $module_id; ?> #iview-tooltip div.holder div.container {
	display: block;
	width: 4000px;
}

#iview<?php echo $module_id; ?> #iview-tooltip div.holder div.container div {
	float: left;
	display: block;
	overflow: hidden;
	width: 124px;
	height: 84px;
	left: -50%;
	text-align: center;
}

#iview<?php echo $module_id; ?> #iview-tooltip div.holder div.container div img {
	height: 84px;
	margin: 0 auto;
}
</style>
<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function(){
	jQuery('#iview<?php echo $module_id; ?>').iView({
		fx: '<?php echo $fx;?>', // Specify sets like: 'left-curtain,fade,zigzag-top,strip-left-fade'
        strips: <?php echo $strips;?>, // Number of strips for strip animations
        blockCols: <?php echo $blockCols;?>, // Number of block columns for block animations
        blockRows: <?php echo $blockRows;?>, // Number of block rows for block animations
        captionSpeed: <?php echo $captionSpeed;?>, // Caption transition speed
        captionOpacity: <?php echo $captionOpacity;?>, // Caption opacity
        animationSpeed: <?php echo $animationSpeed;?>, // Slide transition speed
        pauseTime: <?php echo $pauseTime; ?>, // How long each slide will show
        startSlide: <?php echo $startSlide;?>, // Set starting Slide (0 index)
        directionNav: <?php echo $directionNav;?>, // Next & Previous navigation
        directionNavHoverOpacity: <?php echo $directionNavHoverOpacity;?>, // Fade on hover
        controlNav: <?php echo $controlNav;?>, // 1,2,3,4... navigation
        controlNavNextPrev: <?php echo $controlNav;?>, // previous,next navigation
        controlNavHoverOpacity: <?php echo $controlNavHoverOpacity;?>, // Navigation fade on hover
        controlNavThumbs: false, // Show thumbs navigation
        controlNavTooltip: <?php echo $controlNav;?>, // Show tooltip image previewer
        autoAdvance: true, // Force auto transitions
        keyboardNav: true, // Use left & right arrows
        pauseOnHover: <?php echo $pauseOnHover;?>, // Stop slider while hovering
        nextLabel: "<?php echo $previousLabel?>", // To set the string of the next button (Multilanguage use)
        previousLabel: "<?php echo $nextLabel?>", // To set the string of the previous button (Multilanguage use)
        timer: '<?php echo $timer;?>', // Timer style: "Pie", "360Bar" or "Bar"
		timerPosition:'<?php echo $timerPosition;?>',
        timerBg: '<?php echo $timerBg;?>', // Timer background 
        timerColor: '<?php echo $timerColor;?>', // Timer color
        timerOpacity: <?php echo $timerOpacity;?>, // Timer opacity
        timerDiameter: <?php echo $timerDiameter;?>, // Timer diameter
        timerPadding: 4, // Timer padding
        timerStroke: <?php echo $timerStroke;?>, // Timer stroke width
        timerBarStroke: <?php echo $timerBarStroke;?>, // Timer Bar stroke width
        timerBarStrokeColor: '<?php echo $timerBarStrokeColor;?>', // Timer Bar stroke color
        timerBarStrokeStyle: 'solid' // Timer Bar stroke style     
	});
});
</script>
<div id="iview<?php echo $module_id; ?>" >
			<?php echo $slider;?>
</div>
<?php }else{ echo $slider_blank; } ?>
</div>
	



