<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonCountdown extends SppagebuilderAddons{

	public function render() {

		// Options
		$class 	 			= (isset($this->addon->settings->class) && $this->addon->settings->class) ? ' ' . $this->addon->settings->class : '';
		$title 				= (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector 	= (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		$output  = '';
		$output .= '<div class="sppb-addon sppb-addon-countdown ' . $class . '">';
		$output .= '<div class="countdown-text-wrap">';
		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
		$output .= '</div>';
		$output .= "<div class='sppb-countdown-timer sppb-row'></div>";
		$output .= '</div>';

		return $output;
	}

	public function scripts() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/js/jquery.countdown.min.js');
	}

	public function js() {
		$date 		  			= JHtml::_('date', $this->addon->settings->date, 'Y/m/d');
		$time 		  			= $this->addon->settings->time;
		$finish_text 			= addslashes($this->addon->settings->finish_text);

		$js ="jQuery(function($){
			var addon_id = '#sppb-addon-'+'".$this->addon->id."';
			//console.log(addon_id +' .sppb-addon-countdown .sppb-countdown-timer');
			$( addon_id +' .sppb-addon-countdown .sppb-countdown-timer').each(function () {
					var cdDateFormate = '".$date."' + ' ' + '".$time."';
					//console.log(cdDateFormate);
					$(this).countdown(cdDateFormate, function (event) {
							$(this).html(event.strftime('<div class=\"sppb-countdown-days sppb-col-xs-6 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%-D</span><span class=\"sppb-countdown-text\">%!D: ' + '".JTEXT::_('COM_SPPAGEBUILDER_DAY')."' + ',' + '".JTEXT::_('COM_SPPAGEBUILDER_DAYS')."' + ';</span></div><div class=\"sppb-countdown-hours sppb-col-xs-6 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%H</span><span class=\"sppb-countdown-text\">%!H: ' + '".JTEXT::_('COM_SPPAGEBUILDER_HOUR')."' + ',' + '".JTEXT::_('COM_SPPAGEBUILDER_HOURS')."' + ';</span></div><div class=\"sppb-countdown-minutes sppb-col-xs-6 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%M</span><span class=\"sppb-countdown-text\">%!M:' + '".JTEXT::_('COM_SPPAGEBUILDER_MINUTE')."' + ',' + '".JTEXT::_('COM_SPPAGEBUILDER_MINUTES')."' + ';</span></div><div class=\"sppb-countdown-seconds sppb-col-xs-6 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%S</span><span class=\"sppb-countdown-text\">%!S:' + '".JTEXT::_('COM_SPPAGEBUILDER_SECOND')."' + ',' + '".JTEXT::_('COM_SPPAGEBUILDER_SECONDS')."' + ';</span></div>'))
							.on('finish.countdown', function () {
									$(this).html('<div class=\"sppb-countdown-finishedtext-wrap sppb-col-xs-12 sppb-col-sm-12 sppb-text-center\"><h3 class=\"sppb-countdown-finishedtext\">' + '".$finish_text."' + '</h3></div>');
							});
					});
			});
		})";
		return $js;
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;

		// Counter
		$counter_style = '';
		$counter_style_sm = '';
		$counter_style_xs = '';

		$counter_style   .= (isset($this->addon->settings->counter_height) && $this->addon->settings->counter_height) ? "height: " . (int) $this->addon->settings->counter_height  . "px; line-height: " . (int) $this->addon->settings->counter_height  . "px;" : '';
		$counter_style_sm   .= (isset($this->addon->settings->counter_height_sm) && $this->addon->settings->counter_height_sm) ? "height: " . (int) $this->addon->settings->counter_height_sm  . "px; line-height: " . (int) $this->addon->settings->counter_height_sm  . "px;" : '';
		$counter_style_xs   .= (isset($this->addon->settings->counter_height_xs) && $this->addon->settings->counter_height_xs) ? "height: " . (int) $this->addon->settings->counter_height_xs  . "px; line-height: " . (int) $this->addon->settings->counter_height_xs  . "px;" : '';

		$counter_style  .= (isset($this->addon->settings->counter_width) && $this->addon->settings->counter_width) ? "width: " . (int) $this->addon->settings->counter_width  . "px;" : '';
		$counter_style_sm  .= (isset($this->addon->settings->counter_width_sm) && $this->addon->settings->counter_width_sm) ? "width: " . (int) $this->addon->settings->counter_width_sm  . "px;" : '';
		$counter_style_xs  .= (isset($this->addon->settings->counter_width_xs) && $this->addon->settings->counter_width_xs) ? "width: " . (int) $this->addon->settings->counter_width_xs  . "px;" : '';
		
		$counter_style  .= (isset($this->addon->settings->counter_font_size) && $this->addon->settings->counter_font_size) ? "font-size: " . (int) $this->addon->settings->counter_font_size  . "px;" : '';
		$counter_style_sm  .= (isset($this->addon->settings->counter_font_size_sm) && $this->addon->settings->counter_font_size_sm) ? "font-size: " . (int) $this->addon->settings->counter_font_size_sm  . "px;" : '';
		$counter_style_xs  .= (isset($this->addon->settings->counter_font_size_xs) && $this->addon->settings->counter_font_size_xs) ? "font-size: " . (int) $this->addon->settings->counter_font_size_xs . "px;" : '';
		
		$counter_style  .= (isset($this->addon->settings->counter_text_color) && $this->addon->settings->counter_text_color) ? "color: " . $this->addon->settings->counter_text_color  . ";" : '';
		$counter_style  .= (isset($this->addon->settings->counter_background_color) && $this->addon->settings->counter_background_color) ? "background-color: " . $this->addon->settings->counter_background_color  . ";" : '';

		$counter_style  .= (isset($this->addon->settings->counter_border_radius) && $this->addon->settings->counter_border_radius) ? "border-radius: " . $this->addon->settings->counter_border_radius . "px;" : '';
		$counter_style_sm  .= (isset($this->addon->settings->counter_border_radius_sm) && $this->addon->settings->counter_border_radius_sm) ? "border-radius: " . $this->addon->settings->counter_border_radius_sm . "px;" : '';
		$counter_style_xs  .= (isset($this->addon->settings->counter_border_radius_xs) && $this->addon->settings->counter_border_radius_xs) ? "border-radius: " . $this->addon->settings->counter_border_radius_xs . "px;" : '';

		$use_border = (isset($this->addon->settings->counter_user_border) && $this->addon->settings->counter_user_border) ? 1 : 0;
		if($use_border) {
			$counter_style  .= (isset($this->addon->settings->counter_border_width) && $this->addon->settings->counter_border_width) ? "border-width: " . $this->addon->settings->counter_border_width . "px;" : '';
			$counter_style  .= (isset($this->addon->settings->counter_border_style) && $this->addon->settings->counter_border_style) ? "border-style: " . $this->addon->settings->counter_border_style  . ";" : '';
			$counter_style  .= (isset($this->addon->settings->counter_border_color) && $this->addon->settings->counter_border_color) ? "border-color: " . $this->addon->settings->counter_border_color  . ";" : '';
			$counter_style_sm  .= (isset($this->addon->settings->counter_border_width_sm) && $this->addon->settings->counter_border_width_sm) ? "border-width: " . $this->addon->settings->counter_border_width_sm  . "px;" : '';
			$counter_style_xs .= (isset($this->addon->settings->counter_border_width_xs) && $this->addon->settings->counter_border_width_xs) ? "border-width: " . $this->addon->settings->counter_border_width_xs . "px;" : '';
		}

		// Label
		$label_style = '';
		$label_style_sm = '';
		$label_style_xs = '';
		$label_style .= (isset($this->addon->settings->label_font_size) && $this->addon->settings->label_font_size) ? "font-size: " . (int) $this->addon->settings->label_font_size  . "px;" : '';
		$label_style .= (isset($this->addon->settings->label_color) && $this->addon->settings->label_color) ? "color: " . $this->addon->settings->label_color  . ";" : '';
		$label_style_sm .= (isset($this->addon->settings->label_font_size_sm) && $this->addon->settings->label_font_size_sm) ? "font-size: " . (int) $this->addon->settings->label_font_size_sm  . "px;" : '';
		$label_style_xs .= (isset($this->addon->settings->label_font_size_xs) && $this->addon->settings->label_font_size_xs) ? "font-size: " . (int) $this->addon->settings->label_font_size_xs  . "px;" : '';

		$css = '';
		if($counter_style) {
			$css .= $addon_id . ' .sppb-countdown-number, '. $addon_id .' .sppb-countdown-finishedtext {';
			$css .= $counter_style;
			$css .= '}';
		}

		if($label_style) {
			$css .= $addon_id . ' .sppb-countdown-text {';
			$css .= $label_style;
			$css .= '}';
		}

		if(!empty($counter_style_sm) || !empty($label_style_sm)){
			$css .= '@media (min-width: 768px) and (max-width: 991px) {';
				if($counter_style_sm) {
					$css .= $addon_id . ' .sppb-countdown-number, '. $addon_id .' .sppb-countdown-finishedtext {';
					$css .= $counter_style_sm;
					$css .= '}';
				}
		
				if($label_style_sm) {
					$css .= $addon_id . ' .sppb-countdown-text {';
					$css .= $label_style_sm;
					$css .= '}';
				}
			$css .= '}';
		}

		if(!empty($counter_style_xs) || !empty($label_style_xs)){
			$css .= '@media (max-width: 767px) {';
				if($counter_style_xs) {
					$css .= $addon_id . ' .sppb-countdown-number, '. $addon_id .' .sppb-countdown-finishedtext {';
					$css .= $counter_style_xs;
					$css .= '}';
				}
		
				if($label_style_xs) {
					$css .= $addon_id . ' .sppb-countdown-text {';
					$css .= $label_style_xs;
					$css .= '}';
				}
			$css .= '}';
		}

		return $css;
	}

	public static function getTemplate(){
		$output = '
		<style type="text/css">
			#sppb-addon-{{ data.id }} .sppb-countdown-number, #sppb-addon-{{ data.id }} .sppb-countdown-finishedtext {
				<# if(_.isObject(data.counter_height)){ #>
					height: {{ data.counter_height.md }}px;
					line-height: {{ data.counter_height.md }}px;
				<# } else { #>
					height: {{ data.counter_height }}px;
					line-height: {{ data.counter_height }}px;
				<# } #>

				<# if(_.isObject(data.counter_width)){ #>
					width: {{ data.counter_width.md }}px;
				<# } else { #>
					width: {{ data.counter_width }}px;
				<# } #>
				
				<# if(_.isObject(data.counter_font_size)){ #>
					font-size: {{ data.counter_font_size.md }}px;
				<# } else { #>
					font-size: {{ data.counter_font_size }}px;
				<# } #>
				color: {{ data.counter_text_color }};
				background-color: {{ data.counter_background_color }};
				

				<# if(_.isObject(data.counter_border_radius)){ #>
					border-radius: {{ data.counter_border_radius.md }}px;
				<# } else { #>
					border-radius: {{ data.counter_border_radius }}px;
				<# } #>

				<# if(data.counter_user_border){ #>
					<# if(_.isObject(data.counter_border_width)){ #>
						border-width: {{ data.counter_border_width.md }}px;
					<# } else { #>
						border-width: {{ data.counter_border_width }}px;
					<# } #>
					
					border-style: {{ data.counter_border_style }};
					border-color: {{ data.counter_border_color }};
				<# } #>
			}
			#sppb-addon-{{ data.id }} .sppb-countdown-text {
				<# if(_.isObject(data.label_font_size)){ #>
					font-size: {{ data.label_font_size.md }}px;
				<# } else { #>
					font-size: {{ data.label_font_size }}px;
				<# } #>
				color: {{ data.label_color }};
			}

			@media (min-width: 768px) and (max-width: 991px) {
				#sppb-addon-{{ data.id }} .sppb-countdown-number, #sppb-addon-{{ data.id }} .sppb-countdown-finishedtext {
					<# if(_.isObject(data.counter_height)){ #>
						height: {{ data.counter_height.sm }}px;
						line-height: {{ data.counter_height.sm }}px;
					<# } #>
	
					<# if(_.isObject(data.counter_width)){ #>
						width: {{ data.counter_width.sm }}px;
					<# } #>
					
					<# if(_.isObject(data.counter_font_size)){ #>
						font-size: {{ data.counter_font_size.sm }}px;
					<# } #>
					
	
					<# if(_.isObject(data.counter_border_radius)){ #>
						border-radius: {{ data.counter_border_radius.sm }}px;
					<# } #>
	
					<# if(data.counter_user_border){ #>
						<# if(_.isObject(data.counter_border_width)){ #>
							border-width: {{ data.counter_border_width.sm }}px;
						<# } #>
					<# } #>
				}
				#sppb-addon-{{ data.id }} .sppb-countdown-text {
					<# if(_.isObject(data.label_font_size)){ #>
						font-size: {{ data.label_font_size.sm }}px;
					<# } #>
				}
			}
			@media (max-width: 767px) {
				#sppb-addon-{{ data.id }} .sppb-countdown-number, #sppb-addon-{{ data.id }} .sppb-countdown-finishedtext {
					<# if(_.isObject(data.counter_height)){ #>
						height: {{ data.counter_height.xs }}px;
						line-height: {{ data.counter_height.xs }}px;
					<# } #>
	
					<# if(_.isObject(data.counter_width)){ #>
						width: {{ data.counter_width.xs }}px;
					<# } #>
					
					<# if(_.isObject(data.counter_font_size)){ #>
						font-size: {{ data.counter_font_size.xs }}px;
					<# } #>
					
	
					<# if(_.isObject(data.counter_border_radius)){ #>
						border-radius: {{ data.counter_border_radius.xs }}px;
					<# } #>
	
					<# if(data.counter_user_border){ #>
						<# if(_.isObject(data.counter_border_width)){ #>
							border-width: {{ data.counter_border_width.xs }}px;
						<# } #>
					<# } #>
				}
				#sppb-addon-{{ data.id }} .sppb-countdown-text {
					<# if(_.isObject(data.label_font_size)){ #>
						font-size: {{ data.label_font_size.xs }}px;
					<# } #>
				}
			}
		</style>
		<div class="sppb-addon sppb-addon-countdown {{ data.class }}">
			<div class="countdown-text-wrap">
				<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{ data.title }}</{{ data.heading_selector }}><# } #>
			</div>
			<div class="sppb-countdown-timer sppb-row" data-date="{{ data.date }}" data-time="{{ data.time }}" data-finish-text="{{ data.finish_text }}"></div>
		</div>
		';

		return $output;
	}

}
