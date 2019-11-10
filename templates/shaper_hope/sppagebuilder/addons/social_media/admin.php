<?php

/**
 * @package Floox
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2017 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('resticted aceess');

SpAddonsConfig::addonConfig(
        array(
            'type' => 'repeatable',
            'addon_name' => 'sp_social_media',
            'category' => 'Hope',
            'title' => JText::_('COM_SPPAGEBUILDER_ADDON_SOCIAL_MEDIA'),
            'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_SOCIAL_MEDIA_DESC'),
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => ''
                    ),
                    'class' => array(
                        'type' => 'text',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                        'std' => ''
                    ),
                    'sp_social_media_items' => array(
                        'title' => 'Repetable',
                        'attr' => array(
                            'faicon' => array(
                                'type' => 'icon',
                                'title' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_ICON_NAME'),
                                'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_ICON_NAME_DESC'),
                                'std' => 'fa-facebook',
                            ),
                            'url' => array(
                                'type' => 'text',
                                'title' => JText::_('COM_SPPAGEBUILDER_ADDON_URL'),
                                'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_URL_DESC'),
                                'placeholder' => 'http://www.facebook.com/joomshaper',
                                'std' => '#',
                            ),
                            'class' => array(
                                'type' => 'text',
                                'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                                'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                                'placeholder' => 'custom class',
                                'std' => '',
                            ),
                        )
                    ),
                ),
            )
        )
);
