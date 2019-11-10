<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2017 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('_JEXEC') or die ('restricted aceess');
SpAddonsConfig::addonConfig(
	array(
		'type'=>'repeatable',
		'addon_name'=>'sp_donation',
		'category'=>'Hope',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DONATION'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DONATION_DESC'),
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

				'title'=>array(
					'type'=>'textarea',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
					'std'=> ''
				),

				'desc'=>array(
					'type'=>'editor',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DESC'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DESC_DESC'),
					'std'=>''
				),


				'paypalid'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DONATION_PAYPAL_ID'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DONATION_PAYPAL_ID_DESC'),
					'std'=> ''
				),

				'currency'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DONATION_CURRENCY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DONATION_CURRENCY_DESC'),
					'values'=>array(
						'USD:$'=>'United States dollar($)',
						'GBP:£'=>'British pound(£)',
						'RUB:₽'=>'Russian Ruble(₽)',
						'BRL:R$'=>'Brazilian Real(R$)',
						'CAD:$'=>'Canadian Dollar($)',
						'CZK:Kč'=>'Czech Koruna(Kč)',
						'DKK:kr.'=>'Danish Krone(kr.)',
						'EUR:€'=>'Euro(€)',
						'HKD:HK$'=>'Hong Kong Dollar(HK$)',
						'HUF:Ft'=>'Hungarian Forint(Ft)',
						'ILS:₪'=>'Israeli New Sheqel(₪)',
						'JPY:¥'=>'Japanese Yen(¥)',
						'MYR:RM'=>'Malaysian Ringgit(RM)',
						'MXN:Mex$'=>'Mexican Peso(Mex$)',
						'NOK:kr'=>'Norwegian Krone(kr)',
						'NZD:$'=>'New Zealand Dollar($)',
						'PHP:₱'=>'Philippine Peso(₱)',
						'PLN:zł'=>'Polish Zloty(zł)',
						'SGD:$'=>'Singapore Dollar($)',
						'SEK:kr'=>'Swedish Krona(kr)',
						'CHF:CHF'=>'Swiss Franc(CHF)',
						'TWD:角'=>'Taiwan New Dollar(角)',
						'THB:฿'=>'Thai Baht(฿)',
						'TRY:TRY'=>'Turkish Lira(TRY)',
					),
					'std'=>'USD:$'
				),


				'more'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DONATION_MORE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DONATION_MORE_DESC'),
					'values'=>array(
						''=>JText::_('JNO'),
						'1'=>JText::_('JYES'),
					),
					'std'=>'1'
				),

				'target'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_DESC'),
					'values'=>array(
						'_self'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
						'_blank'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
					),
					'std'=>'_blank'
				),

				'class'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=> ''
				),

				// Repeatable Items
				'sp_donation_item'=>array(
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_BUTTONS_ITEM'),
					'attr'=>  array(
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DONATION_AMT_TITLE_TEXT'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DONATION_AMT_TITLE_TEXT_DESC'),
							'placeholder'=>'$50',
							'std'=>'$50',
						),
						'amount'=>array(
							'type'=>'number',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DONATION_AMT'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DONATION_AMT_DESC'),
							'placeholder'=>'50',
							'std'=>'10',
						),
					)
				),
			), // general
		)
	)
);
