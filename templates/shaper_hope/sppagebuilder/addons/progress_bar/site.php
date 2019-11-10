<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('restricted aceess');

class SppagebuilderAddonProgress_bar extends SppagebuilderAddons {

    public function render() {

        $class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $progress = (isset($this->addon->settings->progress) && $this->addon->settings->progress) ? $this->addon->settings->progress : '';
        $text = (isset($this->addon->settings->text) && $this->addon->settings->text) ? $this->addon->settings->text : '';

        //Output
        $output = ($text) ? '<div class="sppb-progress-label clearfix">' . $text . '</div>' : '';
        $output .= '<div class="sppb-progress ' . $class . '">';
        $output .= '<div class="sppb-progress-bar" role="progressbar" aria-valuenow="' . (int) $progress . '" aria-valuemin="0" aria-valuemax="100" data-width="' . (int) $progress . '%">';
        $output .= '<span>' . (int) $progress . '%</span>';
        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }

    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $bar_height = (isset($this->addon->settings->bar_height) && $this->addon->settings->bar_height) ? $this->addon->settings->bar_height : 0;
        $css = '';
        if ($bar_height) {
            $css .= $addon_id . ' .sppb-progress {height: ' . $bar_height . 'px;}';
            $css .= $addon_id . ' .sppb-progress-bar {line-height: ' . $bar_height . 'px;}';
        }

        return $css;
    }

    public static function getTemplate() {

        $output = '
			<#
                            let progressClass = data.class;
                            let bar_height = data.bar_height || 0;
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
			</style>

			<div class="sppb-progress-label clearfix">
                        <# if(data.text){ #>
                        {{ data.text }}
                        <# } #>
			</div>

			<div class="sppb-progress {{ progressClass }}">
			<div class="sppb-progress-bar {{ data.type }} {{ data.stripped }}" role="progressbar" aria-valuenow="{{ data.progress }}" aria-valuemin="0" aria-valuemax="100" data-width="{{ data.progress }}%">
                            <span> {{ data.progress }}%</span>
			</div>
			</div>
			';

        return $output;
    }

}
