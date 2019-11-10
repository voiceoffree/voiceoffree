<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2017 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted access');

SpAddonsConfig::addonConfig(
	array(
		'type'=>'content',
		'addon_name'=>'sp_upcoming_events',
		'category' => 'Hope',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_UPCOMING_EVENTS'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_UPCOMING_EVENTS_DESC'),
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),
				'date'=>array(
					'type'=>'textarea',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_UPCOMING_EVENTS_DATE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_UPCOMING_EVENTS_DATE_DESC'),
					'placeholder'=>'15 Nov 2017',
				),
				'image'=>array(
					'type'=>'media',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_SELECT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_SELECT_DESC'),
					'show_input' => true
				),
				// Title
				'event_title'=>array(
					'type'=>'textarea',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_EVENT_TITLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_EVENT_TITLE_DESC'),
					'std'=>  'Lorem ipsum dolor sit amet'
				),
				//Event Address
				'event_info'=>array(
					'type'=>'textarea',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_EVENT_INFO'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_EVENT_INFO_DESC'),
					'std'=>  ''
				),
				'text'=>array(
					'type'=>'editor',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CONTENT'),
					'std'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing erat eget risus sollicitudin pellentesque et non erat. Maecenas nibh dolor, malesuada et bibendum a, sagittis accumsan ipsum. Pellentesque ultrices ultrices sapien, nec tincidunt nunc posuere ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam scelerisque tristique dolor vitae tincidunt. Aenean quis massa uada mi elementum elementum. Nec sapien convallis vulputate rhoncus vel dui.'
				),
			),
		),
	)
);
