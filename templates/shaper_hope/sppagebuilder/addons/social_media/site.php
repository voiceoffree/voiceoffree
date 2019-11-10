<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2017 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('restricted aceess');

class SppagebuilderAddonSocial_media extends SppagebuilderAddons {

    public function render() {
        //Addon Options
        $class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $social_items = (isset($this->addon->settings->sp_social_media_items) && $this->addon->settings->sp_social_media_items) ? $this->addon->settings->sp_social_media_items : '';


        $output = '';
        $output .= '<div class="sppb-addon sppb-addon-social-media ' . $class . '">';
        $output .= '<div class="social-media-text-wrap">';

        foreach ($social_items as $social_item) {
            if ($social_item->url) {
                $output .= '<a href="' . $social_item->url . '" target="_blank" data-toggle="tooltip" data-placement="top" title="' . $social_item->class . '" class="' . $social_item->class . '">';
            }
            $output .= '<i class="fa ' . $social_item->faicon . ' "></i>';

            if ($social_item->url) {
                $output .= '</a>';
            }
        }

        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }

    public static function getTemplate() {
        $output = '
                <#
                    var contentClass = (data.class !== "undefined") ? data.class : "";
                    var social_items = (data.sp_social_media_items !== "undefined") ? data.sp_social_media_items : "";
                #>
                <div class="sppb-addon sppb-addon-social-media {{data.class}}">
                <div class="social-media-text-wrap">

                <# _.each (social_items, function (social_item) { #>
                   <# if (social_item.url) { #>
                        <a href=\'{{social_item.url}}\' target="_blank" data-toggle="tooltip" data-placement="top" title="{{social_item.class}}" class="{{social_item.class}}">
                    <# } #>
                    <i class="fa {{social_item.faicon}}"></i>
                    <# if (social_item.url) { #>
                      </a>
                    <# } #>
                <#})#>

                </div>
                </div>
                ';
        return $output;
    }

}
