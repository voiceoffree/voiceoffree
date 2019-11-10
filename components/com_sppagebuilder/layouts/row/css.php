<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

$options = $displayData['options'];

$doc 					= JFactory::getDocument();
$row_id     			= (isset($options->id) && $options->id )? $options->id : 'section-id-'.$options->dynamicId;

$row_styles = '';
$style ='';
$style_sm ='';
$style_xs ='';

if( isset( $options->padding ) ){
	if( is_object( $options->padding ) ){
		if (isset($options->padding->md) && $options->padding->md) $style .= SppagebuilderHelperSite::getPaddingMargin($options->padding->md, 'padding');
		if (isset($options->padding->sm) && $options->padding->sm) $style_sm .= SppagebuilderHelperSite::getPaddingMargin($options->padding->sm, 'padding');
		if (isset($options->padding->xs) && $options->padding->xs) $style_xs .= SppagebuilderHelperSite::getPaddingMargin($options->padding->xs, 'padding');
	} else {
		if ($options->padding) $style .= 'padding: '.$options->padding.';';
	}
}

if( isset( $options->margin ) ){
	if( is_object( $options->margin ) ){
		if (isset($options->margin->md) && $options->margin->md) $style .= SppagebuilderHelperSite::getPaddingMargin($options->margin->md, 'margin');
		if (isset($options->margin->sm) && $options->margin->sm) $style_sm .= SppagebuilderHelperSite::getPaddingMargin($options->margin->sm, 'margin');
		if (isset($options->margin->xs) && $options->margin->xs) $style_xs .= SppagebuilderHelperSite::getPaddingMargin($options->margin->xs, 'margin');
	} else {
		if ($options->margin) $style .= 'margin: '.$options->margin.';';
	}
}

if (isset($options->color) && $options->color) $style .= 'color:'.$options->color.';';

if(isset($options->background_type)){
	if (($options->background_type == 'image' || $options->background_type == 'color') && isset($options->background_color) && $options->background_color) $style .= 'background-color:'.$options->background_color.';';

	if ($options->background_type == 'image' && isset($options->background_image) && $options->background_image) {
	
		if(strpos($options->background_image, "http://") !== false || strpos($options->background_image, "https://") !== false){
			$style .= 'background-image:url(' . $options->background_image.');';
		} else {
			$style .= 'background-image:url('. JURI::base(true) . '/' . $options->background_image.');';
		}

		if (isset($options->background_repeat) && $options->background_repeat) $style .= 'background-repeat:'.$options->background_repeat.';';
		if (isset($options->background_size) && $options->background_size) $style .= 'background-size:'.$options->background_size.';';
		if (isset($options->background_attachment) && $options->background_attachment) $style .= 'background-attachment:'.$options->background_attachment.';';
		if (isset($options->background_position) && $options->background_position) $style .= 'background-position:'.$options->background_position.';';
	
	}

	if($options->background_type == 'gradient' && isset($options->background_gradient) && is_object($options->background_gradient)) {
		$radialPos = (isset($options->background_gradient->radialPos) && !empty($options->background_gradient->radialPos)) ? $options->background_gradient->radialPos : 'center center';
	
		$gradientColor = (isset($options->background_gradient->color) && !empty($options->background_gradient->color)) ? $options->background_gradient->color : '';
	
		$gradientColor2 = (isset($options->background_gradient->color2) && !empty($options->background_gradient->color2)) ? $options->background_gradient->color2 : '';
	
		$gradientDeg = (isset($options->background_gradient->deg) && !empty($options->background_gradient->deg)) ? $options->background_gradient->deg : '0';
	
		$gradientPos = (isset($options->background_gradient->pos) && !empty($options->background_gradient->pos)) ? $options->background_gradient->pos : '0';
	
		$gradientPos2 = (isset($options->background_gradient->pos2) && !empty($options->background_gradient->pos2)) ? $options->background_gradient->pos2 : '100';
	
		if(isset($options->background_gradient->type) && $options->background_gradient->type == 'radial'){
			$style .= "\tbackground-image: radial-gradient(at " . $radialPos . ", " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%);\n";
		} else {
			$style .= "\tbackground-image: linear-gradient(" . $gradientDeg . "deg, " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%);\n";
		}
	}
} else {
	if (isset($options->background_color) && $options->background_color) $style .= 'background-color:'.$options->background_color.';';

	if (isset($options->background_image) && $options->background_image) {
	
		if(strpos($options->background_image, "http://") !== false || strpos($options->background_image, "https://") !== false){
			$style .= 'background-image:url(' . $options->background_image.');';
		} else {
			$style .= 'background-image:url('. JURI::base(true) . '/' . $options->background_image.');';
		}

		if (isset($options->background_repeat) && $options->background_repeat) $style .= 'background-repeat:'.$options->background_repeat.';';
		if (isset($options->background_size) && $options->background_size) $style .= 'background-size:'.$options->background_size.';';
		if (isset($options->background_attachment) && $options->background_attachment) $style .= 'background-attachment:'.$options->background_attachment.';';
		if (isset($options->background_position) && $options->background_position) $style .= 'background-position:'.$options->background_position.';';
	
	}
}

if($style) {
	$row_styles .= '.sp-page-builder .page-content #' . $row_id . '{'. $style .'}';
}

if($style_sm) {
	$row_styles .=  '@media (min-width: 768px) and (max-width: 991px) { .sp-page-builder .page-content #' . $row_id . '{'. $style_sm .'} }';
}
if($style_xs) {
	$row_styles .= '@media (max-width: 767px) { .sp-page-builder .page-content #' . $row_id . '{'. $style_xs .'} }';
}

// Overlay
if(isset($options->background_type)){
	if ($options->background_type == 'image' || $options->background_type == 'video') {
		if(!isset($options->overlay_type)){
			$options->overlay_type = 'overlay_color';
		}
		if(isset($options->overlay) && $options->overlay && $options->overlay_type == 'overlay_color'){
			$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {background-color: '. $options->overlay .'}';
		}
		if(isset($options->gradient_overlay) && $options->gradient_overlay && $options->overlay_type == 'overlay_gradient'){
			$overlay_radialPos = (isset($options->gradient_overlay->radialPos) && !empty($options->gradient_overlay->radialPos)) ? $options->gradient_overlay->radialPos : 'center center';
	
			$overlay_gradientColor = (isset($options->gradient_overlay->color) && !empty($options->gradient_overlay->color)) ? $options->gradient_overlay->color : '';
		
			$overlay_gradientColor2 = (isset($options->gradient_overlay->color2) && !empty($options->gradient_overlay->color2)) ? $options->gradient_overlay->color2 : '';
		
			$overlay_gradientDeg = (isset($options->gradient_overlay->deg) && !empty($options->gradient_overlay->deg)) ? $options->gradient_overlay->deg : '0';
		
			$overlay_gradientPos = (isset($options->gradient_overlay->pos) && !empty($options->gradient_overlay->pos)) ? $options->gradient_overlay->pos : '0';
		
			$overlay_gradientPos2 = (isset($options->gradient_overlay->pos2) && !empty($options->gradient_overlay->pos2)) ? $options->gradient_overlay->pos2 : '100';
		
			if(isset($options->gradient_overlay->type) && $options->gradient_overlay->type == 'radial'){
				$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
					background: radial-gradient(at '. $overlay_radialPos .', '. $overlay_gradientColor .' '. $overlay_gradientPos .'%, '. $overlay_gradientColor2 .' '. $overlay_gradientPos2 . '%) transparent;
				}';
				
			} else {
				$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
					background: linear-gradient('. $overlay_gradientDeg .'deg, '. $overlay_gradientColor .' '. $overlay_gradientPos .'%, '. $overlay_gradientColor2 .' '. $overlay_gradientPos2 .'%) transparent;
				}';
			}
		}
		if(isset($options->pattern_overlay) && $options->pattern_overlay && $options->overlay_type == 'overlay_pattern'){
			if(strpos($options->pattern_overlay, "http://") !== false || strpos($options->pattern_overlay, "https://") !== false){
				$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
					background-image:url(' . $options->pattern_overlay.');
					background-attachment: scroll;
				}';
				if(isset($options->overlay_pattern_color)){
					$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
						background-color:' . $options->overlay_pattern_color.';
					}';
				}
			} else {
				$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
					background-image:url('. JURI::base(true) . '/' . $options->pattern_overlay.');
					background-attachment: scroll;
				}';
				if(isset($options->overlay_pattern_color)){
					$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
						background-color:' . $options->overlay_pattern_color.';
					}';
				}
			}
		}
	}
} else {
	if(!isset($options->overlay_type)){
		$options->overlay_type = 'overlay_color';
	}
	if(isset($options->overlay) && $options->overlay && $options->overlay_type == 'overlay_color'){
		$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {background-color: '. $options->overlay .'}';
	}
	if(isset($options->gradient_overlay) && $options->gradient_overlay && $options->overlay_type == 'overlay_gradient'){
		$overlay_radialPos = (isset($options->gradient_overlay->radialPos) && !empty($options->gradient_overlay->radialPos)) ? $options->gradient_overlay->radialPos : 'center center';

		$overlay_gradientColor = (isset($options->gradient_overlay->color) && !empty($options->gradient_overlay->color)) ? $options->gradient_overlay->color : '';
	
		$overlay_gradientColor2 = (isset($options->gradient_overlay->color2) && !empty($options->gradient_overlay->color2)) ? $options->gradient_overlay->color2 : '';
	
		$overlay_gradientDeg = (isset($options->gradient_overlay->deg) && !empty($options->gradient_overlay->deg)) ? $options->gradient_overlay->deg : '0';
	
		$overlay_gradientPos = (isset($options->gradient_overlay->pos) && !empty($options->gradient_overlay->pos)) ? $options->gradient_overlay->pos : '0';
	
		$overlay_gradientPos2 = (isset($options->gradient_overlay->pos2) && !empty($options->gradient_overlay->pos2)) ? $options->gradient_overlay->pos2 : '100';
	
		if(isset($options->gradient_overlay->type) && $options->gradient_overlay->type == 'radial'){
			$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
				background: radial-gradient(at '. $overlay_radialPos .', '. $overlay_gradientColor .' '. $overlay_gradientPos .'%, '. $overlay_gradientColor2 .' '. $overlay_gradientPos2 . '%) transparent;
			}';
			
		} else {
			$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
				background: linear-gradient('. $overlay_gradientDeg .'deg, '. $overlay_gradientColor .' '. $overlay_gradientPos .'%, '. $overlay_gradientColor2 .' '. $overlay_gradientPos2 .'%) transparent;
			}';
		}
	}
	if(isset($options->pattern_overlay) && $options->pattern_overlay && $options->overlay_type == 'overlay_pattern'){
		if(strpos($options->pattern_overlay, "http://") !== false || strpos($options->pattern_overlay, "https://") !== false){
			$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
				background-image:url(' . $options->pattern_overlay.');
				background-attachment: scroll;
			}';
			if(isset($options->overlay_pattern_color)){
				$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
					background-color:' . $options->overlay_pattern_color.';
				}';
			}
		} else {
			$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
				background-image:url('. JURI::base(true) . '/' . $options->pattern_overlay.');
				background-attachment: scroll;
			}';
			if(isset($options->overlay_pattern_color)){
				$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
					background-color:' . $options->overlay_pattern_color.';
				}';
			}
		}
	}
}

// Row Title
if ( (isset($options->title) && $options->title) || (isset($options->subtitle) && $options->subtitle) ) {

	if(isset($options->title) && $options->title) {
		$title_style = '';
		$title_style_sm = '';
		$title_style_xs = '';
    	//Title Font Size
		if(isset($options->title_fontsize)) {
			if(is_object($options->title_fontsize)) {
				$title_style .= (isset($options->title_fontsize->md) && $options->title_fontsize->md != '') ? 'font-size:'.$options->title_fontsize->md.'px;line-height: '.$options->title_fontsize->md.'px;' : '';
				$title_style_sm .= (isset($options->title_fontsize->sm) && $options->title_fontsize->sm != '') ? 'font-size:'.$options->title_fontsize->sm.'px;line-height: '.$options->title_fontsize->sm.'px;' : '';
				$title_style_xs .= (isset($options->title_fontsize->xs) && $options->title_fontsize->xs != '') ? 'font-size:'.$options->title_fontsize->xs.'px;line-height: '.$options->title_fontsize->xs.'px;' : '';
			} else {
				$title_style .= (isset($options->title_fontsize) && $options->title_fontsize != '') ? 'font-size:'.$options->title_fontsize.'px;line-height: '.$options->title_fontsize.'px;' : '';
			}
		}

    	//Title Font Weight
		if(isset($options->title_fontweight)) {
			if($options->title_fontweight != '') {
				$title_style .= 'font-weight:'.$options->title_fontweight.';';
			}
		}

        //Title Text Color
		if(isset($options->title_text_color)) {
			if($options->title_text_color != '') {
				$title_style .= 'color:'.$options->title_text_color. ';';
			}
		}

        //Title Margin Top
		if(isset($options->title_margin_top)) {
			if(is_object($options->title_margin_top)) {
				$title_style .= (isset($options->title_margin_top->md) && $options->title_margin_top->md != '') ? 'margin-top:' . $options->title_margin_top->md . 'px;' : '';
				$title_style_sm .= (isset($options->title_margin_top->sm) && $options->title_margin_top->sm != '') ? 'margin-top:' . $options->title_margin_top->sm . 'px;' : '';
				$title_style_xs .= (isset($options->title_margin_top->xs) && $options->title_margin_top->xs != '') ? 'margin-top:' . $options->title_margin_top->xs . 'px;' : '';
			} else {
				$title_style .= (isset($options->title_margin_top) && $options->title_margin_top != '') ? 'margin-top:' . $options->title_margin_top . 'px;' : '';
			}
		}

		//Title Margin Bottom
		if(isset($options->title_margin_bottom)) {
			if(is_object($options->title_margin_bottom)) {
				$title_style .= (isset($options->title_margin_bottom->md) && $options->title_margin_bottom->md != '') ? 'margin-bottom:' . $options->title_margin_bottom->md . 'px;' : '';
				$title_style_sm .= (isset($options->title_margin_bottom->sm) && $options->title_margin_bottom->sm != '') ? 'margin-bottom:' . $options->title_margin_bottom->sm . 'px;' : '';
				$title_style_xs .= (isset($options->title_margin_bottom->xs) && $options->title_margin_bottom->xs != '') ? 'margin-bottom:' . $options->title_margin_bottom->xs . 'px;' : '';
			} else {
				$title_style .= (isset($options->title_margin_bottom) && $options->title_margin_bottom != '') ? 'margin-bottom:' . $options->title_margin_bottom . 'px;' : '';
			}
		}

		$row_styles .= ($title_style) ? '.sp-page-builder .page-content #' . $row_id . ' .sppb-section-title .sppb-title-heading {'. $title_style .'}' : '';
		$row_styles .= ($title_style_sm) ? '@media (min-width: 768px) and (max-width: 991px) { .sp-page-builder .page-content #' . $row_id . ' .sppb-section-title .sppb-title-heading {'. $title_style_sm .'}}' : '';
		$row_styles .= ($title_style_xs) ? '@media (max-width: 767px) { .sp-page-builder .page-content #' . $row_id . ' .sppb-section-title .sppb-title-heading {'. $title_style_xs .'}}' : '';

	}

	// Subtitle font size
	if( isset( $options->subtitle ) && $options->subtitle ) {
		if( isset( $options->subtitle_fontsize ) ) {
			$subtitle_fontsize = '';
			$subtitle_fontsize_sm = '';
			$subtitle_fontsize_xs = '';

			if(is_object($options->subtitle_fontsize)) {
				$subtitle_fontsize = (isset($options->subtitle_fontsize->md) && $options->subtitle_fontsize->md != '') ? 'font-size:'.$options->subtitle_fontsize->md.'px;' : '';
				$subtitle_fontsize_sm = (isset($options->subtitle_fontsize->sm) && $options->subtitle_fontsize->sm != '') ? 'font-size:'.$options->subtitle_fontsize->sm.'px;' : '';
				$subtitle_fontsize_xs = (isset($options->subtitle_fontsize->xs) && $options->subtitle_fontsize->xs != '') ? 'font-size:'.$options->subtitle_fontsize->xs.'px;' : '';
			} else {
				$subtitle_fontsize = (isset($options->subtitle_fontsize) && $options->subtitle_fontsize != '') ? 'font-size:'.$options->subtitle_fontsize.'px;' : '';
			}
			$row_styles .= ($subtitle_fontsize) ? '.sp-page-builder .page-content #' . $row_id . ' .sppb-section-title .sppb-title-subheading {'. $subtitle_fontsize .'}' : '';
			$row_styles .= ($subtitle_fontsize_sm) ? '@media (min-width: 768px) and (max-width: 991px) {.sp-page-builder .page-content #' . $row_id . ' .sppb-section-title .sppb-title-subheading {'. $subtitle_fontsize_sm .'}}' : '';
			$row_styles .= ($subtitle_fontsize_xs) ? '@media (max-width: 767px) {.sp-page-builder .page-content #' . $row_id . ' .sppb-section-title .sppb-title-subheading {'. $subtitle_fontsize_xs .'}}' : '';
		}
	}
}

echo $row_styles;