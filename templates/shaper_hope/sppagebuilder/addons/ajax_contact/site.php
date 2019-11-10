<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('restricted aceess');

class SppagebuilderAddonAjax_contact extends SppagebuilderAddons {

    public function render() {

        $class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
        $heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

        // Addon options
        $recipient_email = (isset($this->addon->settings->recipient_email) && $this->addon->settings->recipient_email) ? $this->addon->settings->recipient_email : '';
        $from_email = (isset($this->addon->settings->from_email) && $this->addon->settings->from_email) ? $this->addon->settings->from_email : '';
        $from_name = (isset($this->addon->settings->from_name) && $this->addon->settings->from_name) ? $this->addon->settings->from_name : '';
        $formcaptcha = (isset($this->addon->settings->formcaptcha) && $this->addon->settings->formcaptcha) ? $this->addon->settings->formcaptcha : '';
        $captcha_type = (isset($this->addon->settings->captcha_type)) ? $this->addon->settings->captcha_type : 'default';
        $captcha_question = (isset($this->addon->settings->captcha_question) && $this->addon->settings->captcha_question) ? $this->addon->settings->captcha_question : '';
        $captcha_answer = (isset($this->addon->settings->captcha_answer) && $this->addon->settings->captcha_answer) ? $this->addon->settings->captcha_answer : '';
        $button_text = JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_SEND');
        $use_custom_button = (isset($this->addon->settings->use_custom_button) && $this->addon->settings->use_custom_button) ? $this->addon->settings->use_custom_button : 0;
        $button_class = (isset($this->addon->settings->button_type) && $this->addon->settings->button_type) ? ' sppb-btn-' . $this->addon->settings->button_type : ' sppb-btn-success';

        $name_input_col = (isset($this->addon->settings->name_input_col) && $this->addon->settings->name_input_col) ? ' sppb-col-sm-' . $this->addon->settings->name_input_col : 'sppb-col-sm-12';
        $email_input_col = (isset($this->addon->settings->email_input_col) && $this->addon->settings->email_input_col) ? ' sppb-col-sm-' . $this->addon->settings->email_input_col : 'sppb-col-sm-12';
        $captcha_input_col = (isset($this->addon->settings->captcha_input_col) && $this->addon->settings->captcha_input_col) ? ' sppb-col-sm-' . $this->addon->settings->captcha_input_col : 'sppb-col-sm-12';
        $subject_input_col = (isset($this->addon->settings->subject_input_col) && $this->addon->settings->subject_input_col) ? ' sppb-col-sm-' . $this->addon->settings->subject_input_col : 'sppb-col-sm-12';
        $message_input_col = (isset($this->addon->settings->message_input_col) && $this->addon->settings->message_input_col) ? ' sppb-col-sm-' . $this->addon->settings->message_input_col : 'sppb-col-sm-12';

        $show_label = (isset($this->addon->settings->show_label) && $this->addon->settings->show_label) ? $this->addon->settings->show_label : false;

        if ($use_custom_button) {
            $button_text = (isset($this->addon->settings->button_text) && $this->addon->settings->button_text) ? $this->addon->settings->button_text : JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_SEND');
            $button_class .= (isset($this->addon->settings->button_size) && $this->addon->settings->button_size) ? ' sppb-btn-' . $this->addon->settings->button_size : '';
            $button_class .= (isset($this->addon->settings->button_shape) && $this->addon->settings->button_shape) ? ' sppb-btn-' . $this->addon->settings->button_shape : ' sppb-btn-rounded';
            $button_class .= (isset($this->addon->settings->button_appearance) && $this->addon->settings->button_appearance) ? ' sppb-btn-' . $this->addon->settings->button_appearance : '';
            $button_class .= (isset($this->addon->settings->button_block) && $this->addon->settings->button_block) ? ' ' . $this->addon->settings->button_block : '';
            $button_icon = (isset($this->addon->settings->button_icon) && $this->addon->settings->button_icon) ? $this->addon->settings->button_icon : '';
            $button_icon_position = (isset($this->addon->settings->button_icon_position) && $this->addon->settings->button_icon_position) ? $this->addon->settings->button_icon_position : 'left';

            if ($button_icon_position == 'left') {
                $button_text = ($button_icon) ? '<i class="fa ' . $button_icon . '"></i> ' . $button_text : $button_text;
            } else {
                $button_text = ($button_icon) ? $button_text . ' <i class="fa ' . $button_icon . '"></i>' : $button_text;
            }
        }

        $output = '<div class="sppb-addon sppb-addon-ajax-contact ' . $class . '">';

        if ($title) {
            $output .= '<' . $heading_selector . ' class="sppb-addon-title">' . $title . '</' . $heading_selector . '>';
        }

        $output .= '<div class="sppb-ajax-contact-content">';
        $output .= '<form class="sppb-ajaxt-contact-form">';
        $output .= '<div class="sppb-row">';

        $output .= '<div class="sppb-form-group ' . $name_input_col . '">';
        if ($show_label) {
            $output .= '<label for="name">' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_NAME') . '</label>';
        }
        $output .= '<input type="text" name="name" class="sppb-form-control" placeholder="' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_NAME') . '" required="required">';
        $output .= '</div>';

        $output .= '<div class="sppb-form-group ' . $email_input_col . '">';
        if ($show_label) {
            $output .= '<label for="email">' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_EMAIL') . '</label>';
        }
        $output .= '<input type="email" name="email" class="sppb-form-control" placeholder="' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_EMAIL') . '" required="required">';
        $output .= '</div>';

        $output .= '<div class="sppb-form-group ' . $subject_input_col . '">';
        if ($show_label) {
            $output .= '<label for="subject">' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_SUBJECT') . '</label>';
        }
        $output .= '<input type="text" name="subject" class="sppb-form-control" placeholder="' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_SUBJECT') . '" required="required">';
        $output .= '</div>';

        if ($formcaptcha && $captcha_type == 'default') {
            $output .= '<div class="sppb-form-group ' . $captcha_input_col . '">';
            if ($show_label) {
                $output .= '<label for="captcha_question">' . $captcha_question . '</label>';
            }
            $output .= '<input type="text" name="captcha_question" class="sppb-form-control" placeholder="' . $captcha_question . '" required="required">';
            $output .= '</div>';
        }

        $output .= '<div class="sppb-form-group ' . $message_input_col . '">';
        if ($show_label) {
            $output .= '<label for="message">' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_MESSAGE') . '</label>';
        }
        $output .= '<textarea name="message" rows="5" class="sppb-form-control" placeholder="' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_MESSAGE') . '" required="required"></textarea>';
        $output .= '</div>';
        $output .= '</div>';

        $output .= '<input type="hidden" name="recipient" value="' . base64_encode($recipient_email) . '">';
        $output .= '<input type="hidden" name="from_email" value="' . base64_encode($from_email) . '">';
        $output .= '<input type="hidden" name="from_name" value="' . base64_encode($from_name) . '">';

        if ($formcaptcha && $captcha_type == 'default') {
            $output .= '<input type="hidden" name="captcha_answer" value="' . md5($captcha_answer) . '">';
        } elseif ($formcaptcha && $captcha_type == 'gcaptcha') {
            JPluginHelper::importPlugin('captcha', 'recaptcha');
            $dispatcher = JDispatcher::getInstance();
            $dispatcher->trigger('onInit', 'dynamic_recaptcha_' . $this->addon->id);
            $recaptcha = $dispatcher->trigger('onDisplay', array(null, 'dynamic_recaptcha_' . $this->addon->id, 'class="sppb-dynamic-recaptcha"'));

            $output .= (isset($recaptcha[0])) ? $recaptcha[0] : '<p class="sppb-text-danger">' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_CAPTCHA_NOT_INSTALLED') . '</p>';
        }

        $output .= '<input type="hidden" name="captcha_type" value="' . $captcha_type . '">';
        $output .= '<button type="submit" id="btn-' . $this->addon->id . '" class="sppb-btn' . $button_class . '"><i class="fa"></i> ' . $button_text . '</button>';

        $output .= '</form>';

        $output .= '<div style="display:none;margin-top:10px;" class="sppb-ajax-contact-status"></div>';

        $output .= '</div>';

        $output .= '</div>';

        return $output;
    }

    public static function getAjax() {

        $input = JFactory::getApplication()->input;
        $mail = JFactory::getMailer();

        $showcaptcha = false;

        //inputs
        $inputs = $input->get('data', array(), 'ARRAY');

        foreach ($inputs as $input) {

            if ($input['name'] == 'captcha_type') {
                $captcha_type = $input['value'];
            }

            if ($input['name'] == 'recipient') {
                $recipient = base64_decode($input['value']);
            }

            if ($input['name'] == 'from_email') {
                $from_email = base64_decode($input['value']);
            }

            if ($input['name'] == 'from_name') {
                $from_name = base64_decode($input['value']);
            }

            if ($input['name'] == 'email') {
                $email = $input['value'];
            }

            if ($input['name'] == 'name') {
                $name = $input['value'];
            }

            if ($input['name'] == 'subject') {
                $subject = $input['value'];
            }

            if ($input['name'] == 'message') {
                $message = nl2br($input['value']);
            }

            if ($input['name'] == 'captcha_question') {
                $captcha_question = $input['value'];
            }

            if ($input['name'] == 'captcha_answer') {
                $captcha_answer = $input['value'];
                $showcaptcha = true;
            }

            if ($input['name'] == 'g-recaptcha-response') {
                $gcaptcha = $input['value'];
                $showcaptcha = true;
            }
        }

        $output = array();
        $output['status'] = false;

        if ($showcaptcha) {
            if ($captcha_type == 'gcaptcha') {
                JPluginHelper::importPlugin('captcha');
                $dispatcher = JEventDispatcher::getInstance();
                $res = $dispatcher->trigger('onCheckAnswer');
                if (!$res[0]) {
                    $output['content'] = '<span class="sppb-text-danger">' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_INVALID_CAPTCHA') . '</span>';
                    return json_encode($output);
                }
            } else {
                if (md5($captcha_question) != $captcha_answer) {
                    $output['content'] = '<span class="sppb-text-danger">' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_WRONG_CAPTCHA') . '</span>';
                    return json_encode($output);
                }
            }
        }

        $sender = array($email, $name);

        if (!empty($from_email)) {
            $sender = array($from_email, $from_name);
            $mail->addReplyTo($email, $name);
        }

        $mail->setSender($sender);
        $mail->addRecipient($recipient);
        $mail->setSubject($subject);
        $mail->isHTML(true);
        $mail->Encoding = 'base64';
        $mail->setBody($message);

        if ($mail->Send()) {
            $output['status'] = true;
            $output['content'] = '<span class="sppb-text-success">' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_SUCCESS') . '</span>';
        } else {
            $output['content'] = '<span class="sppb-text-danger">' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_FAILED') . '</span>';
        }

        return json_encode($output);
    }

    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
        $css_path = new JLayoutFile('addon.css.button', $layout_path);

        $use_custom_button = (isset($this->addon->settings->use_custom_button) && $this->addon->settings->use_custom_button) ? $this->addon->settings->use_custom_button : 0;

        if ($use_custom_button) {
            return $css_path->render(array('addon_id' => $addon_id, 'options' => $this->addon->settings, 'id' => 'btn-' . $this->addon->id));
        }
    }

    public static function getTemplate() {
        $output = '
		<#
		var classList = "";
		classList += " sppb-btn-"+data.button_type;
		classList += " sppb-btn-"+data.button_size;
		classList += " sppb-btn-"+data.button_shape;
		if(!_.isEmpty(data.appearance)){
			classList += " sppb-btn-"+data.button_appearance;
		}

		classList += " "+data.button_block;

		var modern_font_style = false;
		var button_fontstyle = data.button_fontstyle || "";
		var button_font_style = data.button_font_style || "";
		#>
		<style type="text/css">

			#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-{{ data.button_type }}{
				letter-spacing: {{ data.button_letterspace }};
				<# if(_.isObject(button_font_style) && button_font_style.underline) { #>
					text-decoration: underline;
					<# modern_font_style = true #>
				<# } #>

				<# if(_.isObject(button_font_style) && button_font_style.italic) { #>
					font-style: italic;
					<# modern_font_style = true #>
				<# } #>

				<# if(_.isObject(button_font_style) && button_font_style.uppercase) { #>
					text-transform: uppercase;
					<# modern_font_style = true #>
				<# } #>

				<# if(_.isObject(button_font_style) && button_font_style.weight) { #>
					font-weight: {{ button_font_style.weight }};
					<# modern_font_style = true #>
				<# } #>

				<# if(!modern_font_style) { #>
					<# if(_.isArray(button_fontstyle)) { #>
						<# if(button_fontstyle.indexOf("underline") !== -1){ #>
							text-decoration: underline;
						<# } #>
						<# if(button_fontstyle.indexOf("uppercase") !== -1){ #>
							text-transform: uppercase;
						<# } #>
						<# if(button_fontstyle.indexOf("italic") !== -1){ #>
							font-style: italic;
						<# } #>
						<# if(button_fontstyle.indexOf("lighter") !== -1){ #>
							font-weight: lighter;
						<# } else if(button_fontstyle.indexOf("normal") !== -1){#>
							font-weight: normal;
						<# } else if(button_fontstyle.indexOf("bold") !== -1){#>
							font-weight: bold;
						<# } else if(button_fontstyle.indexOf("bolder") !== -1){#>
							font-weight: bolder;
						<# } #>
					<# } #>
				<# } #>
			}

			<# if(data.button_type == "custom"){ #>
				#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
					color: {{ data.button_color }};
					<# if(data.button_appearance == "outline"){ #>
						border-color: {{ data.button_background_color }}
					<# } else if(data.button_appearance == "3d"){ #>
						border-bottom-color: {{ data.button_background_color_hover }};
						background-color: {{ data.button_background_color }};
					<# } else { #>
						background-color: {{ data.button_background_color }};
					<# } #>
				}

				#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom:hover{
					color: {{ data.button_color_hover }};
					background-color: {{ data.button_background_color_hover }};
					<# if(data.button_appearance == "outline"){ #>
						border-color: {{ data.button_background_color_hover }}
					<# } #>
				}

			<# } #>

		</style>
		<div class="sppb-addon sppb-addon-ajax-contact {{ data.class }}">
			<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title">{{{ data.title }}}</{{ data.heading_selector }}><# } #>
			<div class="sppb-ajax-contact-content">
				<form class="sppb-ajaxt-contact-form">
					<div class="row">
						<div class="sppb-form-group col-sm-{{ data.name_input_col || 12 }}">
							<# if(data.show_label){ #>
								<label for="name">' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_NAME') . '</label>
							<# } #>
							<input type="text" name="name" class="sppb-form-control" placeholder="' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_NAME') . '" required="required">
						</div>

						<div class="sppb-form-group col-sm-{{ data.email_input_col || 12 }}">
							<# if(data.show_label){ #>
								<label for="email">' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_EMAIL') . '</label>
							<# } #>
							<input type="email" name="email" class="sppb-form-control" placeholder="' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_EMAIL') . '" required="required">
						</div>

						<div class="sppb-form-group col-sm-{{ data.subject_input_col || 12 }}">
							<# if(data.show_label){ #>
								<label for="subject">' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_SUBJECT') . '</label>
							<# } #>
							<input type="text" name="subject" class="sppb-form-control" placeholder="' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_SUBJECT') . '" required="required">
						</div>
						<# if(data.formcaptcha && data.captcha_type == "default") { #>
							<div class="sppb-form-group col-sm-{{ data.captcha_input_col || 12 }}">
								<# if(data.show_label){ #>
									<label for="captcha_question">{{ data.captcha_question }}</label>
								<# } #>
								<input type="text" name="captcha_question" class="sppb-form-control" placeholder="{{ data.captcha_question }}" required="required">
							</div>
						<# } #>
						<div class="sppb-form-group col-sm-{{ data.message_input_col || 12 }}">
							<# if(data.show_label){ #>
								<label for="message">' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_MESSAGE') . '</label>
							<# } #>
							<textarea name="message" rows="5" class="sppb-form-control" placeholder="' . JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_MESSAGE') . '" required="required"></textarea>
						</div>
					</div>
					<# if(data.formcaptcha && data.captcha_type == "gcaptcha"){ #>
						<img src="components/com_sppagebuilder/assets/images/captcha.jpg" >
					<# } #>
					<button type="submit" id="btn-{{ data.id }}" class="sppb-btn {{ classList }}"><i class="fa"></i>  {{ data.button_text }}</button>
				</form>
			</div>
		</div>';

        return $output;
    }

}
