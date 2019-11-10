<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonText_block extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
		$title = (isset($settings->title) && $settings->title) ? $settings->title : '';
		$heading_selector = (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : 'h3';

		//Options
		$text = (isset($settings->text) && $settings->text) ? $settings->text : '';
		$alignment = (isset($settings->alignment) && $settings->alignment) ? $settings->alignment : '';
		$dropcap = (isset($settings->dropcap) && $settings->dropcap) ? $settings->dropcap : 0;

		$dropcapCls = '';
		if($dropcap){
			$dropcap = 'sppb-dropcap';
		}

		//Output
		$output  = '<div class="sppb-addon sppb-addon-text-block ' . $dropcap . ' ' . $alignment . ' ' . $class . '">';
		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
		$output .= '<div class="sppb-addon-content">';
		$output .= $text;
		$output .= '</div>';
		$output .= '</div>';

		return $output;

	}

	public function css() {
		$settings = $this->addon->settings;
		$css = '';
		$dropcap_style = (isset($settings->dropcap_color) && $settings->dropcap_color) ? "color: " . $settings->dropcap_color . ";" : "";

		$style = '';
		$style_sm = '';
		$style_xs = '';

		$style .= (isset($settings->text_fontsize) && $settings->text_fontsize) ? "font-size: " . $settings->text_fontsize . "px;" : "";
		$style .= (isset($settings->text_fontweight) && $settings->text_fontweight) ? "font-weight: " . $settings->text_fontweight . ";" : "";
		$style_sm .= (isset($settings->text_fontsize_sm) && $settings->text_fontsize_sm) ? "font-size: " . $settings->text_fontsize_sm . "px;" : "";
		$style_xs .= (isset($settings->text_fontsize_xs) && $settings->text_fontsize_xs) ? "font-size: " . $settings->text_fontsize_xs . "px;" : "";

		$style .= (isset($settings->text_lineheight) && $settings->text_lineheight) ? "line-height: " . $settings->text_lineheight . "px;" : "";
		$style_sm .= (isset($settings->text_lineheight_sm) && $settings->text_lineheight_sm) ? "line-height: " . $settings->text_lineheight_sm . "px;" : "";
		$style_xs .= (isset($settings->text_lineheight_xs) && $settings->text_lineheight_xs) ? "line-height: " . $settings->text_lineheight_xs . "px;" : "";

		if(isset($settings->dropcap) && $settings->dropcap && !empty($dropcap_style)){
			$css .= '#sppb-addon-' . $this->addon->id . ' .sppb-dropcap .sppb-addon-content:first-letter{ ' . $dropcap_style . ' }';
		}

		if($style){
			$css .= '#sppb-addon-' . $this->addon->id . '{ ' . $style . ' }';
		}

		if($style_sm){
			$css .= '@media (min-width: 768px) and (max-width: 991px) {#sppb-addon-' . $this->addon->id . '{ ' . $style_sm . ' }}';
		}

		if($style_xs){
			$css .= '@media (max-width: 767px) {#sppb-addon-' . $this->addon->id . '{ ' . $style_xs . ' }}';
		}

		return $css;
	}

	public static function getTemplate()
	{
		$output = '
		<#
			var dropcap = "";

			if(data.dropcap){
				dropcap = "sppb-dropcap";
			}

			if(!data.heading_selector){
				data.heading_selector = "h3";
			}
		#>
		<style type="text/css">
			#sppb-addon-{{ data.id }}{
				<# if(_.isObject(data.text_fontsize)){ #>
					font-size: {{ data.text_fontsize.md }}px;
				<# } else { #>
					font-size: {{ data.text_fontsize }}px;
				<# } #>

				<# if(_.isObject(data.text_lineheight)){ #>
					line-height: {{ data.text_lineheight.md }}px;
				<# } else { #>
					line-height: {{ data.text_lineheight }}px;
				<# } #>
				font-weight:{{data.text_fontweight}};
			}
			#sppb-addon-{{ data.id }} .sppb-dropcap .sppb-addon-content:first-letter {
				color: {{ data.dropcap_color }};
			}

			@media (min-width: 768px) and (max-width: 991px) {
				#sppb-addon-{{ data.id }}{
					<# if(_.isObject(data.text_fontsize)){ #>
						font-size: {{ data.text_fontsize.sm }}px;
					<# } #>

					<# if(_.isObject(data.text_lineheight)){ #>
						line-height: {{ data.text_lineheight.sm }}px;
					<# } #>
				}
			}
			@media (max-width: 767px) {
				#sppb-addon-{{ data.id }}{
					<# if(_.isObject(data.text_fontsize)){ #>
						font-size: {{ data.text_fontsize.xs }}px;
					<# } #>

					<# if(_.isObject(data.text_lineheight)){ #>
						line-height: {{ data.text_lineheight.xs }}px;
					<# } #>
				}
			}
		</style>
		<div class="sppb-addon sppb-addon-text-block {{ dropcap }} {{ data.alignment }} {{ data.class }}">
			<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{{ data.title }}}</{{ data.heading_selector }}><# } #>
			<div id="addon-text-{{data.id}}" class="sppb-addon-content sp-editable-content" data-id={{data.id}} data-fieldName="text">{{{ data.text }}}</div>
		</div>';
		return $output;
	}
}
