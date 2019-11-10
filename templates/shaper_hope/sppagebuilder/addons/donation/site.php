<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2017 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('resticted aceess');

class SppagebuilderAddonDonation extends SppagebuilderAddons {

    public function render() {
        $class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
        $desc = (isset($this->addon->settings->desc) && $this->addon->settings->desc) ? $this->addon->settings->desc : '';
        $more = (isset($this->addon->settings->more) && $this->addon->settings->more) ? $this->addon->settings->more : '';
        $paypalid = (isset($this->addon->settings->paypalid) && $this->addon->settings->paypalid) ? $this->addon->settings->paypalid : '';
        $currency = (isset($this->addon->settings->currency) && $this->addon->settings->currency) ? $this->addon->settings->currency : '';
        $target = (isset($this->addon->settings->target) && $this->addon->settings->target) ? $this->addon->settings->target : '';


        $crcy_code = explode(':', $currency);

        //Output
        $output = '';
        $output .= '<div class="sppb-addon sppb-addon-donation ' . $class . '">';

        if ($title)
            $output .= '<h2 class="sppb-title-heading">' . $title . '</h2>';
        if ($desc)
            $output .= '<p class="sppb-title-subheading">' . $desc . '</p>';

        $output .= '<div class="donation-ammount-wrap" data-currency="' . $currency . '" data-pid="' . $paypalid . '">';
        foreach ($this->addon->settings->sp_donation_item as $key => $donation) {
            $active = ( $key > 1 && ((count($this->addon->settings->sp_donation_item) / $key) == $key) ) ? 'active' : '';

            $output .= '<input class="donation-input ' . $active . '" type="text" name="amount" value="' . $crcy_code[1] . $donation->amount . '" readonly>';
        }
        if ($more) {
            $output .= '<input class="donation-input input-text" type="number" name="amount" autocomplete="off" placeholder="More" min="1">';
        }

        $output .= '</div>'; //.donation-ammount

        $output .= '<div class="donation-button">';
        $output .= '<a href="#" target="' . $target . '" class="btn btn-primary donation-button-link">' . JText::_('COM_SPPAGEBUILDER_ADDON_DONATE_NOW') . '</a>';
        $output .= '</div>'; //.donation-button


        $output .= '</div>'; //.sppb-addon-donation

        $donations = array();

        return $output;
    }

    public static function getTemplate() {
        $lang = JText::_("COM_SPPAGEBUILDER_ADDON_DONATE_NOW");
        $output = '
                <#
                    var contentClass = (data.class !=="undefined") ? data.class : "";
                    var title = (data.title !=="undefined") ? data.title : "";
                    var desc = (data.desc !=="undefined") ? data.desc : "";
                    var more = (data.more !=="undefined") ? data.more : "";
                    var paypalid = (data.paypalid !=="undefined") ? data.paypalid : "";
                    var currency = (data.currency !=="undefined") ? data.currency : "";
                    var target 	= (data.target !=="undefined") ? data.target : "";
                    var crcy_code = currency.split(":")[1];
                #>
		<div class="sppb-addon sppb-addon-donation {{contentClass}}">

		<# if(title) { #>
                <h2 class="sppb-title-heading">{{{title}}}</h2>
                <# } #>
		<# if(desc) { #>
                <p class="sppb-title-subheading">{{{desc}}}</p>
                <# } #>

		<div class="donation-ammount-wrap" data-currency="{{currency}}" data-pid="{{paypalid}}">
		<# _.each (data.sp_donation_item, function(donation, key) {
                    var active = ( key > 1 && (((data.sp_donation_item.length)/key) == key) ) ? "active" : "";
                #>
                    <input class="donation-input {{active}}" type="text" name="amount" value="{{crcy_code}} {{donation.amount}}" readonly>
		<# }) #>
		<# if (more) { #>
                    <input class="donation-input input-text" type="number" name="amount" autocomplete="off" placeholder="More" min="1">
		<# } #>
		</div>

		<div class="donation-button">
		<a href="#" target="{{target}}" class="btn btn-primary donation-button-link">' . $lang . '</a>
		</div>

		</div>
                <#
		var donations = [];
                #>
                ';
        return $output;
    }

}
