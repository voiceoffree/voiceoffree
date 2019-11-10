<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonBlocknumber extends SppagebuilderAddons{

	public function render() {

		$class  	= (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title  	= (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : '';
		$text     	= (isset($this->addon->settings->text) && $this->addon->settings->text) ? $this->addon->settings->text : '';
		$number     = (isset($this->addon->settings->number) && $this->addon->settings->number) ? $this->addon->settings->number : '';
		$alignment  = (isset($this->addon->settings->alignment) && $this->addon->settings->alignment) ? $this->addon->settings->alignment : '';
		$heading  	= (isset($this->addon->settings->heading) && $this->addon->settings->heading) ? $this->addon->settings->heading : '';

		if ($number) {
			$block_number = '<span class="sppb-blocknumber-number">' . $number . '</span>';
		}

		if($text) {
			$output  = '<div class="sppb-addon sppb-addon-blocknumber ' . $class . '">';

			if($title) {
				$output  .= '<' . $heading_selector . ' class="sppb-addon-title">' . $title .'</' . $heading_selector . '>';
			}

			$output .= '<div class="sppb-addon-content">';
			$output .= '<div class="sppb-blocknumber sppb-media">';
			if( $alignment =='center' ) {
				if ($number) {
					$output .= '<div class="sppb-text-center">'.$block_number.'</div>';
				}
				$output .= '<div class="sppb-media-body sppb-text-center">';
				if($heading) $output .= '<h3 class="sppb-media-heading">'.$heading.'</h3>';
				$output .= $text;
			} else {
				if ($number) {
					$output .= '<div class="pull-'.$alignment.'">'.$block_number.'</div>';
				}
				$output .= '<div class="sppb-media-body sppb-text-'. $alignment .'">';
				if($heading) $output .= '<h3 class="sppb-media-heading">'.$heading.'</h3>';
				$output .= $text;
			}

			$output .= '</div>'; //.sppb-media-body
			$output .= '</div>'; //.sppb-media
			$output .= '</div>'; //.sppb-addon-content
			$output .= '</div>'; //.sppb-addon-blocknumber

			return $output;
		}

		return ;
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$number_style = '';
		$number_style_sm = '';
		$number_style_xs = '';

		//number_style
		$number_style .= (isset($this->addon->settings->size) && $this->addon->settings->size) ? 'width: ' . (int) $this->addon->settings->size . 'px; height: ' . (int) $this->addon->settings->size . 'px; line-height: ' . (int) $this->addon->settings->size . 'px;' : '';
		$number_style_sm .= (isset($this->addon->settings->size_sm) && $this->addon->settings->size_sm) ? 'width: ' . (int) $this->addon->settings->size_sm . 'px; height: ' . (int) $this->addon->settings->size_sm . 'px; line-height: ' . (int) $this->addon->settings->size_sm . 'px;' : '';
		$number_style_xs .= (isset($this->addon->settings->size_xs) && $this->addon->settings->size_xs) ? 'width: ' . (int) $this->addon->settings->size_xs . 'px; height: ' . (int) $this->addon->settings->size_xs . 'px; line-height: ' . (int) $this->addon->settings->size_xs . 'px;' : '';

		if($this->addon->settings->background) $number_style .= 'background-color: ' . $this->addon->settings->background . ';';
		if($this->addon->settings->color) $number_style .= 'color: ' . $this->addon->settings->color . ';';
		if($this->addon->settings->border_radius) $number_style .= 'border-radius: ' . (int) $this->addon->settings->border_radius . 'px;';

		$css = '';

		if($number_style) {
			$css .= $addon_id . ' .sppb-blocknumber-number {';
			$css .= $number_style;
			$css .= "\n" . '}' . "\n"	;
		}

		if($number_style_sm) {
			$css .= '@media (min-width: 768px) and (max-width: 991px) {';
				$css .= $addon_id . ' .sppb-blocknumber-number {';
				$css .= $number_style_sm;
				$css .= "\n" . '}' . "\n"	;
			$css .= '}';
		}

		if($number_style_xs) {
			$css .= '@media (max-width: 767px) {';
				$css .= $addon_id . ' .sppb-blocknumber-number {';
				$css .= $number_style_xs;
				$css .= "\n" . '}' . "\n"	;
			$css .= '}';
		}

		return $css;
	}

	public static function getTemplate(){
		$output  = '
		<style type="text/css">
			#sppb-addon-{{ data.id }} .sppb-blocknumber-number {
				<# if(_.isObject(data.size)){ #>
					width: {{ data.size.md }}px;
					height: {{ data.size.md }}px;
					line-height: {{ data.size.md }}px;
				<# } else { #>
					width: {{ data.size }}px;
					height: {{ data.size }}px;
					line-height: {{ data.size }}px;
				<# } #>
				background-color: {{ data.background }};
				color: {{ data.color }};
				border-radius: {{ data.border_radius }}px;
			}

			@media (min-width: 768px) and (max-width: 991px) {
				#sppb-addon-{{ data.id }} .sppb-blocknumber-number {
					<# if(_.isObject(data.size)){ #>
						width: {{ data.size.sm }}px;
						height: {{ data.size.sm }}px;
						line-height: {{ data.size.sm }}px;
					<# } #>
				}
			}
			@media (max-width: 767px) {
				#sppb-addon-{{ data.id }} .sppb-blocknumber-number {
					<# if(_.isObject(data.size)){ #>
						width: {{ data.size.xs }}px;
						height: {{ data.size.xs }}px;
						line-height: {{ data.size.xs }}px;
					<# } #>
				}
			}
		</style>
		<div class="sppb-addon sppb-addon-blocknumber {{ data.class }}">
			<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{{ data.title }}}</{{ data.heading_selector }}><# } #>
			<div class="sppb-addon-content">
				<div class="sppb-blocknumber sppb-media">
					<# if( data.alignment == "center" ) { #>
						<# if(data.number){ #>
							<div class="sppb-text-center"><span class="sppb-blocknumber-number sp-inline-editable-element" data-id={{data.id}} data-fieldName="number" contenteditable="true">{{ data.number }}</span></div>
						<# } #>
						<div class="sppb-media-body sppb-text-center">
							<# if(data.heading){ #>
								<h3 class="sppb-media-heading sp-inline-editable-element" data-id={{data.id}} data-fieldName="heading" contenteditable="true">{{{ data.heading }}}</h3>
							<# } #>
							<div class="sp-inline-editable-element" data-id={{data.id}} data-fieldName="text" contenteditable="true">{{ data.text }}</div>
						</div>
					<# } else { #>
						<# if(data.number){ #>
							<div class="pull-{{ data.alignment }}"><span class="sppb-blocknumber-number sp-inline-editable-element" data-id={{data.id}} data-fieldName="number" contenteditable="true">{{ data.number }}</span></div>
						<# } #>
						<div class="sppb-media-body sppb-text-{{ data.alignment }}">
							<# if(data.heading){ #>
								<h3 class="sppb-media-heading sp-inline-editable-element" data-id={{data.id}} data-fieldName="heading" contenteditable="true">{{{ data.heading }}}</h3>
							<# } #>
							<div class="sp-inline-editable-element" data-id={{data.id}} data-fieldName="text" contenteditable="true">{{ data.text }}</div>
						</div>
					<# } #>
				</div>
			</div>
		</div>';

		return $output;
	}
}
