<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

class SppagebuilderAddonPie_progress extends SppagebuilderAddons {

    public function render() {

        $class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
        $heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

        //Options
        $percentage = (isset($this->addon->settings->percentage) && $this->addon->settings->percentage) ? $this->addon->settings->percentage : '';
        $border_color = (isset($this->addon->settings->border_color) && $this->addon->settings->border_color) ? $this->addon->settings->border_color : '#eeeeee';
        $border_active_color = (isset($this->addon->settings->border_active_color) && $this->addon->settings->border_active_color) ? $this->addon->settings->border_active_color : '';
        $border_width = (isset($this->addon->settings->border_width) && $this->addon->settings->border_width) ? $this->addon->settings->border_width : '';
        $size = (isset($this->addon->settings->size) && $this->addon->settings->size) ? $this->addon->settings->size : '';
        $icon_name = (isset($this->addon->settings->icon_name) && $this->addon->settings->icon_name) ? $this->addon->settings->icon_name : '';
        $icon_size = (isset($this->addon->settings->icon_size) && $this->addon->settings->icon_size) ? $this->addon->settings->icon_size : '';
        $text = (isset($this->addon->settings->text) && $this->addon->settings->text) ? $this->addon->settings->text : '';

        $output = '<div class="sppb-addon sppb-addon-pie-progress ' . $class . '">';
        $output .= '<div class="sppb-addon-content sppb-text-center">';
        $output .= '<div class="sppb-pie-chart" data-size="' . (int) $size . '" data-percent="' . $percentage . '" data-width="' . $border_width . '" data-barcolor="' . $border_active_color . '" data-trackcolor="' . $border_color . '">';

        if ($icon_name) {
            $output .= '<div class="sppb-chart-icon"><span><i class="fa ' . $icon_name . ' ' . $icon_size . '"></i></span></div>';
        } else {
            $output .= '<div class="sppb-chart-percent"><span></span></div>';
        }

        $output .= '</div>';
        $output .= ($title) ? '<' . $heading_selector . ' class="sppb-addon-title">' . $title . '</' . $heading_selector . '>' : '';
        $output .= '<div class="sppb-addon-text">';
        $output .= $text;
        $output .= '</div>';

        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }

    public function scripts() {
        $js[] = JURI::base(true) . '/components/com_sppagebuilder/assets/js/jquery.easypiechart.min.js';
        return $js;
    }

    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $css = '';
        $style = (isset($this->addon->settings->size) && $this->addon->settings->size) ? 'height: ' . (int) $this->addon->settings->size . 'px; width: ' . (int) $this->addon->settings->size . 'px;' : '';
        //Added version 3.1.3
        $percent_style = '';
        $percent_style_sm = '';
        $percent_style_xs = '';
        $percent_style .= (isset($this->addon->settings->percentage_font_size) && $this->addon->settings->percentage_font_size) ? 'font-size:' . (int) $this->addon->settings->percentage_font_size . 'px;' : '';
        $percent_style .= (isset($this->addon->settings->percentage_color) && $this->addon->settings->percentage_color) ? 'color:' . $this->addon->settings->percentage_color . ';' : '';

        $percent_style_sm .= (isset($this->addon->settings->percentage_font_size_sm) && $this->addon->settings->percentage_font_size_sm) ? 'font-size:' . (int) $this->addon->settings->percentage_font_size_sm . 'px;' : '';
        $percent_style_xs .= (isset($this->addon->settings->percentage_font_size_xs) && $this->addon->settings->percentage_font_size_xs) ? 'font-size:' . (int) $this->addon->settings->percentage_font_size_xs . 'px;' : '';

        if ($style) {
            $css .= $addon_id . ' .sppb-pie-chart {';
            $css .= $style;
            $css .= '}';
        }

        if ($percent_style) {
            $css .= $addon_id . ' .sppb-chart-percent span{';
            $css .= $percent_style;
            $css .= '}';
        }
        if (!empty($percent_style_sm)) {
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
            if ($percent_style_sm) {
                $css .= $addon_id . ' .sppb-chart-percent span{';
                $css .= $percent_style_sm;
                $css .= '}';
            }
            $css .= '}';
        }
        if (!empty($percent_style_xs)) {
            $css .= '@media (max-width: 767px) {';
            if ($percent_style_xs) {
                $css .= $addon_id . ' .sppb-chart-percent span{';
                $css .= $percent_style_xs;
                $css .= '}';
            }
            $css .= '}';
        }

        return $css;
    }

    public static function getTemplate() {

        $output = '
			<#
                let border_color = data.border_color || "#eeeeee"
			#>

			<style type="text/css">
                #sppb-addon-{{ data.id }} .sppb-pie-chart {
                    height: {{ data.size }}px;
                    width: {{ data.size }}px;
                }
                <# if(_.isObject(data.percentage_font_size)){ #>
                    #sppb-addon-{{ data.id }} .sppb-chart-percent span{
                        font-size: {{data.percentage_font_size.md}}px;
                    }
                <# } else { #>
                    #sppb-addon-{{ data.id }} .sppb-chart-percent span{
                        font-size: {{data.percentage_font_size}}px;
                    }
                <# } #>
                <# if(!_.isEmpty(data.percentage_color)){ #>
                    #sppb-addon-{{ data.id }} .sppb-chart-percent span{
                        color: {{data.percentage_color}};
                    }
                <# } #>
                @media (min-width: 768px) and (max-width: 991px) {
                    <# if(_.isObject(data.percentage_font_size)){ #>
                        #sppb-addon-{{ data.id }} .sppb-chart-percent span{
                            font-size: {{data.percentage_font_size.sm}}px;
                        }
                    <# } #>
                }
                @media (max-width: 767px) {
                    <# if(_.isObject(data.percentage_font_size)){ #>
                        #sppb-addon-{{ data.id }} .sppb-chart-percent span{
                            font-size: {{data.percentage_font_size.xs}}px;
                        }
                    <# } #>
                }
			</style>

			<div class="sppb-addon sppb-addon-pie-progress {{ data.class }}">
                <div class="sppb-addon-content sppb-text-center">
                    <div class="sppb-pie-chart" data-size="{{ data.size }}" data-percent="{{ data.percentage }}" data-width="{{ data.border_width }}" data-barcolor="{{ data.border_active_color }}" data-trackcolor="{{ border_color }}">

                    <# if(!_.isEmpty(data.icon_name)) { #>
                        <div class="sppb-chart-icon"><span><i class="fa {{ data.icon_name }} {{ data.icon_size }}"></i></span></div>
                    <# } else { #>
                        <div class="sppb-chart-percent"><span></span></div>
                    <# } #>

                    </div>

                    <# if(!_.isEmpty(data.title) && data.heading_selector) { #>
                    <{{data.heading_selector}} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{ data.title }}</{{data.heading_selector}}>
                    <# } #>

                    <div id="addon-text-{{data.id}}" class="sppb-addon-text sp-editable-content" data-id={{data.id}} data-fieldName="text">
                        {{{ data.text }}}
                    </div>
                </div>
			</div>
			';

        return $output;
    }

}
