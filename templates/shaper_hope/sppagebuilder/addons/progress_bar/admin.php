<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('restricted aceess');

SpAddonsConfig::addonConfig(
        array(
            'type' => 'general',
            'addon_name' => 'sp_progress_bar',
            'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR'),
            'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_DESC'),
            'category' => 'Content',
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => ''
                    ),
                    'progress' => array(
                        'type' => 'slider',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_PROGRESS'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_PROGRESS_DESC'),
                        'std' => 60,
                        'min' => 1,
                        'max' => 100
                    ),
                    'bar_height' => array(
                        'type' => 'slider',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_HEIGHT'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_HEIGHT_DESC'),
                        'std' => 24,
                        'min' => 1,
                        'max' => 100
                    ),
                    'text' => array(
                        'type' => 'text',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_TEXT'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_TEXT_DESC'),
                        'std' => '',
                    ),
                    'class' => array(
                        'type' => 'text',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                        'std' => ''
                    ),
                ),
            ),
        )
);
