<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2018 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

SpAddonsConfig::addonConfig(
	array(
		'type'=>'content',
		'addon_name'=>'sp_articles_scroller',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_SCROLLER'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_SCROLLER_DESC'),
		'category'=>'Content',
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),
				'addon_style'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_STYLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_STYLE_DESC'),
					'values'=>array(
						'ticker'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TICKER'),
						'scroller'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER'),
					),
					'std'=>'ticker',
				),

				'resource'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_RESOURCE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_RESOURCE_DESC'),
					'values'=>array(
						'article'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_RESOURCE_ARTICLE'),
						'k2'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_RESOURCE_K2'),
					),
					'std'=>'article',
				),
				
				'catid'=>array(
					'type'=>'category',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_CATID'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_CATID_DESC'),
					'depends'=>array('resource'=>'article'),
					'multiple'=>true,
				),
				
				'k2catid'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_K2_CATID'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_K2_CATID_DESC'),
					'depends'=>array('resource'=>'k2'),
					'values'=> SpPgaeBuilderBase::k2CatList(),
					'multiple'=>true,
				),
				
				'ordering'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_ORDERING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_ORDERING_DESC'),
					'values'=>array(
						'latest'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_ORDERING_LATEST'),
						'oldest'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_ORDERING_OLDEST'),
						'hits'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_ORDERING_POPULAR'),
						'featured'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_ORDERING_FEATURED'),
					),
					'std'=>'latest',
				),

				'image_bg'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_IMAGE_BG'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_IMAGE_BG_DESC'),
					'values'=>array(
						0=> JText::_('NO'),
						1=> JText::_('YES')
					),
					'std'=>0,
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
					)
				),

				'slide_speed'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_SPEED'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_SPEED_DESC'),
					'std'=>500,
				),

				'separator_options'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ADDON_OPTIONS')
				),

				'ticker_heading'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_DESC'),
					'std'=>'Breaking News',
					'depends'=>array(
						array('addon_style', '!=', 'scroller')
					)
				),

				'ticker_heading_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_WIDTH_DESC'),
					'max'=>100,
					'std'=>'',
					'responsive' => true,
				),

				'ticker_heading_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_FONTSIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_FONTSIZE_DESC'),
					'max'=>200,
					'std'=>'',
				),

				'ticker_heading_font_weight' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_FONT_WEIGHT'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_FONT_WEIGHT_DESC'),
					'values'=>array(
						100=> 100,
						300=> 300,
						400=> 400,
						500=> 500,
						600=> 600,
						700=> 700,
						900=> 900,
					),
					'std'=>'',
				),

				'heading_date_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_HEADING_FONT_FAMILY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_HEADING_FONT_FAMILY_DESC'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>' h2 { font-family: {{ VALUE }}; }'
					)
				),

				'show_shape'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_SHAPE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_SHAPE_DESC'),
					'values'=>array(
						0=> JText::_('NO'),
						1=> JText::_('YES')
					),
					'std'=>1,
					'depends'=>array(
						array('addon_style', '!=', 'scroller'),
					)
				),

				'heading_letter_spacing'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_LETTER_SPACING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_LETTER_SPACING_DESC'),
					'std'=> '',
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
					)
				),

				'heading_shape'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_SHAPE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_SHAPE_DESC'),
					'values'=>array(
						'arrow'=> JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_ARROW_SHAPE'),
						'slanted-left'=> JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_SLANTED_L_SHAPE'),
						'slanted-right'=> JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_SLANTED_R_SHAPE')
					),
					'std'=>'arrow',
					'depends'=>array(
						array('addon_style', '!=', 'scroller'),
						array('show_shape', '!=', 0),
					)
				),

				'left_side_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_LEFT_BG'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_LEFT_BG_DESC'),
					'std'=>'',
				),

				'left_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_LEFT_TEXT_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_LEFT_TEXT_COLOR_DESC'),
					'std'=>'',
				),

				'overlap_date_text'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_DESC'),
					'values'=>array(
						0=> JText::_('NO'),
						1=> JText::_('YES')
					),
					'std'=>0,
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
					)
				),

				'overlap_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_COLOR_DESC'),
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('overlap_date_text', '!=', 0),
					),
				),

				'overlap_text_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_SIZE_DESC'),
					'max'=> 200,
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('overlap_date_text', '!=', 0),
					),
				),

				'overlap_text_right'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_RIGHT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_RIGHT_DESC'),
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('overlap_date_text', '!=', 0),
					),
				),

				'content_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_CONTENT_BG'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_CONTENT_BG_DESC'),
					'std'=>'',
				),

				'right_title_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TITLE_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TITLE_SIZE_DESC'),
					'max'=>200,
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
					),
				),

				'content_title_font_weight' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_HEADING_FONT_WEIGHT'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_HEADING_FONT_WEIGHT_DESC'),
					'values'=>array(
						100=> 100,
						300=> 300,
						400=> 400,
						500=> 500,
						600=> 600,
						700=> 700,
						900=> 900,
					),
					'std'=>700,
				),
				'content_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_CONTENT_FONT_FAMILY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_CONTENT_FONT_FAMILY_DESC'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>' h2 { font-family: {{ VALUE }}; }'
					)
				),
				'title_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TITLE_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TITLE_COLOR_DESC'),
					'std'=>'',
				),

				'intro_limit'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_INTRO_LIMIT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_INTRO_LIMIT_DESC'),
					'std'=>100,
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
					)
				),

				'content_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_CONTENT_FONTSIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_CONTENT_FONTSIZE_DESC'),
					'max'=>200,
					'std'=>'',
				),

				'ticker_date_time'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_DATE_TIME'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_DATE_TIME_DESC'),
					'values'=>array(
						0=> JText::_('NO'),
						1=> JText::_('YES')
					),
					'std'=>0,
					'depends'=>array(
						array('addon_style', '!=', 'scroller'),
					)
				),

				'ticker_date_hour'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HOUR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HOUR_DESC'),
					'values'=>array(
						0=> JText::_('NO'),
						1=> JText::_('YES')
					),
					'std'=>0,
					'depends'=>array(
						array('addon_style', '!=', 'scroller'),
					)
				),

				'text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TEXT_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TEXT_COLOR_DESC'),
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
					),
				),

				'item_bottom_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_BOTTOM_GAP'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_BOTTOM_GAP_DESC'),
					'max'=>200,
					'std'=>1,
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
					),
				),

				'border_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_BORDER_SIZE_DESC'),
					'std'=>0,
				),

				'border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_BORDER_COLOR_DESC'),
					'std'=>'',
				),

				'border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_BORDER_RADIUS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_BORDER_RADIUS_DESC'),
					'std'=>0,
					'depends'=>array(
						array('addon_style', '!=', 'scroller'),
					)
				),

				'arrow_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_ARROW_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_ARROW_COLOR_DESC'),
					'std'=>'',
					'depends'=>array(array('addon_style', '!=', 'scroller')),
				),

				'class'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=>''
				),
			),
		),
	)
);
	