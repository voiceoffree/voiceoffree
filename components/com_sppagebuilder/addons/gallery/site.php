<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonGallery extends SppagebuilderAddons{

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';
		$item_alignment = (isset($this->addon->settings->item_alignment) && $this->addon->settings->item_alignment) ? $this->addon->settings->item_alignment : '';

		$output  = '<div class="sppb-addon sppb-addon-gallery ' . $class . '">';
		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
		$output .= '<div class="sppb-addon-content">';
		$output .= '<ul class="sppb-gallery clearfix gallery-item-'.$item_alignment.'">';

		if(isset($this->addon->settings->sp_gallery_item) && count((array) $this->addon->settings->sp_gallery_item)){
			foreach ($this->addon->settings->sp_gallery_item as $key => $value) {
				if($value->thumb) {
					$output .= '<li>';
					$output .= ($value->full) ? '<a href="' . $value->full . '" class="sppb-gallery-btn">' : '';
					$output .= '<img class="sppb-img-responsive" src="' . $value->thumb . '" alt="' . $value->title . '">';
					$output .= ($value->full) ? '</a>' : '';
					$output .= '</li>';
				}
			}
		}

		$output .= '</ul>';
		$output	.= '</div>';
		$output .= '</div>';

		return $output;
	}

	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/css/magnific-popup.css');
	}

	public function scripts() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/js/jquery.magnific-popup.min.js');
	}

	public function js() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$js ='jQuery(function($){
			$("'.$addon_id.' ul li").magnificPopup({
				delegate: "a",
				type: "image",
				mainClass: "mfp-no-margins mfp-with-zoom",
				gallery:{
					enabled:true
				},
				image: {
					verticalFit: true
				},
				zoom: {
					enabled: true,
					duration: 300
				}
			});
		})';

		return $js;
	}
        
    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;

        $width = (isset($this->addon->settings->width) && $this->addon->settings->width) ? $this->addon->settings->width : '';
        $width_sm = (isset($this->addon->settings->width_sm) && $this->addon->settings->width_sm) ? $this->addon->settings->width_sm : '';
        $width_xs = (isset($this->addon->settings->width_xs) && $this->addon->settings->width_xs) ? $this->addon->settings->width_xs : '';

        $height = (isset($this->addon->settings->height) && $this->addon->settings->height) ? $this->addon->settings->height : '';
        $height_sm = (isset($this->addon->settings->height_sm) && $this->addon->settings->height_sm) ? $this->addon->settings->height_sm : '';
        $height_xs = (isset($this->addon->settings->height_xs) && $this->addon->settings->height_xs) ? $this->addon->settings->height_xs : '';
        
        $item_gap = (isset($this->addon->settings->item_gap) && $this->addon->settings->item_gap) ? $this->addon->settings->item_gap : '';
        $item_gap_sm = (isset($this->addon->settings->item_gap_sm) && $this->addon->settings->item_gap_sm) ? $this->addon->settings->item_gap_sm : '';
        $item_gap_xs = (isset($this->addon->settings->item_gap_xs) && $this->addon->settings->item_gap_xs) ? $this->addon->settings->item_gap_xs : '';

        $css = '';
        if($width || $height || $item_gap){
            $css .= $addon_id .' .sppb-gallery img {';
            $css .= 'width:'.$width.'px;';
            $css .= 'height:'.$height.'px;';
            $css .= '}';
            
            if(!empty($item_gap)){
                $css .= $addon_id .' .sppb-gallery li {';
                $css .= 'margin:'.$item_gap.'px;';
                $css .= '}';
                $css .= $addon_id .' .sppb-gallery {';
                $css .= 'margin:-'.$item_gap.'px;';
                $css .= '}';
            }
            
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';

            $css .= $addon_id .' .sppb-gallery img {';
            $css .= 'width:'.$width_sm.'px;';
            $css .= 'height:'.$height_sm.'px;';
            $css .= '}';
            
            if(!empty($item_gap_sm)){
                $css .= $addon_id .' .sppb-gallery li {';
                $css .= 'margin:'.$item_gap_sm.'px;';
                $css .= '}';
                $css .= $addon_id .' .sppb-gallery {';
                $css .= 'margin:-'.$item_gap_sm.'px;';
                $css .= '}';
            }

            $css .= '}';

            $css .= '@media (max-width: 767px) {';

            $css .= $addon_id .' .sppb-gallery img {';
            $css .= 'width:'.$width_xs.'px;';
            $css .= 'height:'.$height_xs.'px;';
            $css .= '}';
            
            if(!empty($item_gap_xs)){
                $css .= $addon_id .' .sppb-gallery li {';
                $css .= 'margin:'.$item_gap_xs.'px;';
                $css .= '}';
                $css .= $addon_id .' .sppb-gallery {';
                $css .= 'margin:-'.$item_gap_xs.'px;';
                $css .= '}';
            }

            $css .= '}';
        }
        return $css;
    }

	public static function getTemplate() {
		$output = '
		<style type="text/css">
            #sppb-addon-{{ data.id }} .sppb-gallery img {
                <# if(_.isObject(data.width)){ #>
                    width: {{data.width.md}}px;
                <# } else { #>
                    width: {{data.width}}px;
                <# } #>
                <# if(_.isObject(data.height)){ #>
                    height: {{data.height.md}}px;
                <# } else { #>
                    height: {{data.height}}px;
                <# } #>
            }
            #sppb-addon-{{ data.id }} .sppb-gallery li {
                <# if(_.isObject(data.item_gap)){ #>
                    margin: {{data.item_gap.md}}px;
                <# } else { #>
                    margin: {{data.item_gap}}px;
                <# } #>
            }
            #sppb-addon-{{ data.id }} .sppb-gallery {
                <# if(_.isObject(data.item_gap)){ #>
                    margin: -{{data.item_gap.md}}px;
                <# } else { #>
                    margin: -{{data.item_gap}}px;
                <# } #>
            }
            @media (min-width: 768px) and (max-width: 991px) {
                #sppb-addon-{{ data.id }} .sppb-gallery img {
                    <# if(_.isObject(data.width)){ #>
                        width: {{data.width.sm}}px;
                    <# } #>
                    <# if(_.isObject(data.height)){ #>
                        height: {{data.height.sm}}px;
                    <# } #>
                }
                
                #sppb-addon-{{ data.id }} .sppb-gallery li {
                    <# if(_.isObject(data.item_gap)){ #>
                        margin: {{data.item_gap.sm}}px;
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-gallery {
                    <# if(_.isObject(data.item_gap)){ #>
                        margin: -{{data.item_gap.sm}}px;
                    <# } #>
                }
            }
            @media (max-width: 767px) {
                #sppb-addon-{{ data.id }} .sppb-gallery img {
                    <# if(_.isObject(data.width)){ #>
                        width: {{data.width.xs}}px;
                    <# } #>
                    <# if(_.isObject(data.height)){ #>
                        height: {{data.height.xs}}px;
                    <# } #>
                }
                
                #sppb-addon-{{ data.id }} .sppb-gallery li {
                    <# if(_.isObject(data.item_gap)){ #>
                        margin: {{data.item_gap.xs}}px;
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-gallery {
                    <# if(_.isObject(data.item_gap)){ #>
                        margin: -{{data.item_gap.xs}}px;
                    <# } #>
                }
            }
        </style>
		<div class="sppb-addon sppb-addon-gallery {{ data.class }}">
			<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{ data.title }}</{{ data.heading_selector }}><# } #>
			<div class="sppb-addon-content">
				<ul class="sppb-gallery clearfix gallery-item-{{data.item_alignment}}">
				<# _.each(data.sp_gallery_item, function (value, key) { #>
					<# if(value.thumb) { #>
						<li>
						<# if(value.full && value.full.indexOf("http://") == -1 && value.full.indexOf("https://") == -1){ #>
							<a href=\'{{ pagebuilder_base + value.full }}\' class="sppb-gallery-btn">
						<# } else if(value.full){ #>
							<a href=\'{{ value.full }}\' class="sppb-gallery-btn">
						<# } #>
							<# if(value.thumb && value.thumb.indexOf("http://") == -1 && value.thumb.indexOf("https://") == -1){ #>
								<img class="sppb-img-responsive" src=\'{{ pagebuilder_base + value.thumb }}\' alt="{{ value.title }}">
							<# } else if(value.thumb){ #>
								<img class="sppb-img-responsive" src=\'{{ value.thumb }}\' alt="{{ value.title }}">
							<# } #>
						<# if(value.full){ #>
							</a>
						<# } #>
						</li>
					<# } #>
				<# }); #>
				</ul>
			</div>
		</div>
		';

		return $output;
	}

}
