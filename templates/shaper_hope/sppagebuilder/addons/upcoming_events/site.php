<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2017 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('restricted access');

class SppagebuilderAddonUpcoming_events extends SppagebuilderAddons {

    public function render() {

        $date = (isset($this->addon->settings->date) && $this->addon->settings->date) ? $this->addon->settings->date : '';
        $image = (isset($this->addon->settings->image) && $this->addon->settings->image) ? $this->addon->settings->image : '';
        $event_title = (isset($this->addon->settings->event_title) && $this->addon->settings->event_title) ? $this->addon->settings->event_title : '';
        $event_info = (isset($this->addon->settings->event_info) && $this->addon->settings->event_info) ? $this->addon->settings->event_info : '';
        $text = (isset($this->addon->settings->text) && $this->addon->settings->text) ? $this->addon->settings->text : '';


        $output = '<div class="sppb-addon sppb-addon-upcoming-events">';

        $output .= '<div class="sppb-addon-content">';

        $output .= '<div class="sppb-col-xs-12 sppb-col-sm-2 upcoming-events-date">';
        $output .= $date;
        $output .= '</div>'; //End: .upcoming-events-date

        $output .= '<div class="sppb-col-xs-12 sppb-col-sm-10 upcoming-events-details">';

        $output .= '<div class="upcoming-events-details-top-wrapper">';
        $output .= '<div class="event-image">';
        $output .= '<img class="sppb-img-responsive" src="' . $image . '">';
        $output .= '</div>'; //End: .event-image

        $output .= '<div class="event-address">';
        $output .= $event_title;
        $output .= '<br/>';
        $output .= $event_info;
        $output .= '</div>'; //End: .event-address
        $output .= '</div>'; //End: .upcoming-events-details-top-wrapper

        $output .= '<div class="upcoming-events-details-bottom-wrapper">';
        $output .= $text;
        $output .= '</div>'; //End: .upcoming-events-details-bottom-wrapper

        $output .= '</div>'; //End: .upcoming-events-details

        $output .= '</div>'; //End: .sppb-addon-content

        $output .= '</div>'; //End: .sppb-addon-upcoming-events


        return $output;
    }

    public static function getTemplate() {
        $output = '
            <#
                var date = (!_.isEmpty(data.date)) ? data.date : "";
                var image = (!_.isEmpty(data.image)) ? data.image : "";
                var event_title = (!_.isEmpty(data.event_title)) ? data.event_title : "";
                var event_info = (!_.isEmpty(data.event_info)) ? data.event_info : "";
                var text = (!_.isEmpty(data.text)) ? data.text : "";
            #>
                <div class="sppb-addon sppb-addon-upcoming-events">
                <div class="sppb-addon-content">

                <div class="sppb-col-xs-12 sppb-col-sm-2 upcoming-events-date">
                    {{{date}}}
                </div>

                <div class="sppb-col-xs-12 sppb-col-sm-10 upcoming-events-details">
                <div class="upcoming-events-details-top-wrapper">

                <div class="event-image">
                    <img class="sppb-img-responsive" src="{{image}}">
                </div>

                <div class="event-address">
                    {{{event_title}}}
                    <br/>
                    {{{event_info}}}
                    </div>
                    </div>

                    <div class="upcoming-events-details-bottom-wrapper">
                    {{text}}
                    </div>
                </div>

                </div>
                </div>
        ';
        return $output;
    }

}
