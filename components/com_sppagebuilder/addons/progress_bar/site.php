<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonProgress_bar extends SppagebuilderAddons {

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$class .= (isset($this->addon->settings->shape) && $this->addon->settings->shape) ? 'sppb-progress-' . $this->addon->settings->shape : '';
		$type = (isset($this->addon->settings->type) && $this->addon->settings->type) ? $this->addon->settings->type : '';
		$progress = (isset($this->addon->settings->progress) && $this->addon->settings->progress) ? $this->addon->settings->progress : '';
		$text = (isset($this->addon->settings->text) && $this->addon->settings->text) ? $this->addon->settings->text : '';
		$stripped = (isset($this->addon->settings->stripped) && $this->addon->settings->stripped) ? $this->addon->settings->stripped : '';
		$show_percentage = (isset($this->addon->settings->show_percentage) && $this->addon->settings->show_percentage) ? $this->addon->settings->show_percentage : 0;

		//Output
		$output  = ($show_percentage) ? '<div class="sppb-progress-label clearfix">'.  $text .'<span>'. (int) $progress .'%</span></div>' : '';
		$output .= '<div class="sppb-progress ' . $class . '">';
		$output .= '<div class="sppb-progress-bar ' . $type . ' ' . $stripped . '" role="progressbar" aria-valuenow="' . (int) $progress . '" aria-valuemin="0" aria-valuemax="100" data-width="' . (int) $progress . '%">';
		if(!$show_percentage) {
			$output .= ($text) ? $text : '';
		}
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$bar_height = (isset($this->addon->settings->bar_height) && $this->addon->settings->bar_height) ? $this->addon->settings->bar_height : 0;
		$type = (isset($this->addon->settings->type) && $this->addon->settings->type) ? $this->addon->settings->type : '';
		$bar_background = (isset($this->addon->settings->bar_background) && $this->addon->settings->bar_background) ? $this->addon->settings->bar_background : '';
		$progress_bar_background = (isset($this->addon->settings->progress_bar_background) && $this->addon->settings->progress_bar_background) ? $this->addon->settings->progress_bar_background : '';

		$css = '';
		if($bar_height) {
			$css .= $addon_id . ' .sppb-progress {height: '. $bar_height .'px;}';
			$css .= $addon_id . ' .sppb-progress-bar {line-height: '. $bar_height .'px;}';
		}

		if($type == 'custom') {
			if($bar_background) {
				$css .= $addon_id . ' .sppb-progress {background-color: '. $bar_background .';}';
			}

			if($progress_bar_background) {
				$css .= $addon_id . ' .sppb-progress-bar {background-color: '. $progress_bar_background .';}';
			}
		}

		return $css;

	}

	public static function getTemplate(){

		$output = '
			<#
				let show_percentage = data.show_percentage || 0
				let progressClass = data.class
						progressClass += (!_.isEmpty(data.shape)) ? "sppb-progress-"+data.shape:""

				let bar_height = data.bar_height || 0

			#>

			<style type="text/css">
				<# if(bar_height) { #>
					#sppb-addon-{{ data.id }} .sppb-progress {
						height: {{bar_height}}px;
					}
					#sppb-addon-{{ data.id }} .sppb-progress-bar {
						line-height: {{ bar_height }}px;
					}
				<# } #>

				<# if(data.type == "custom") { #>
					<# if(!_.isEmpty(data.bar_background)) { #>
						#sppb-addon-{{ data.id }} .sppb-progress{
							background-color: {{ data.bar_background }}
						}
					<# } #>

					<# if(!_.isEmpty(data.progress_bar_background)) { #>
						#sppb-addon-{{ data.id }} .sppb-progress-bar{
							background-color: {{ data.progress_bar_background }}
						}
					<# } #>
				<# } #>
			</style>

			<# if( show_percentage != 0 ) {#>
			<div class="sppb-progress-label clearfix">
				{{ data.text }}
				<span> {{ data.progress }}%</span>
			</div>
			<# } #>

			<div class="sppb-progress {{ progressClass }}">
			<div class="sppb-progress-bar {{ data.type }} {{ data.stripped }}" role="progressbar" aria-valuenow="{{ data.progress }}" aria-valuemin="0" aria-valuemax="100" data-width="{{ data.progress }}%">
				<# if(show_percentage == 0) { #>
					{{ data.text }}
				<# } #>
			</div>
			</div>
			';

			return $output;
	}

}
