<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2016 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

$row_settings = array(
	'type' 	=> 'content',
	'title' => 'Section',
	'attr' 	=> array(
		'general' => array(
			'admin_label'=>array(
				'type'=>'text',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADMIN_LABEL'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADMIN_LABEL_DESC'),
				'std'=>''
			),

			'separator1'=>array(
				'type'=>'separator',
				'title'=>JText::_('Title Options')
			),

			'title'=>array(
				'type'=>'textarea',
				'title'=>JText::_('COM_SPPAGEBUILDER_SECTION_TITLE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_SECTION_TITLE_DESC'),
				'css'=> 'min-height: 80px;',
				'std'=>''
			),

			'heading_selector'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_DESC'),
				'values'=>array(
					'h1'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_H1'),
					'h2'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_H2'),
					'h3'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_H3'),
					'h4'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_H4'),
					'h5'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_H5'),
					'h6'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_H6'),
				),
				'std'=>'h3',
				'depends' => array(
					array('title', '!=', ''),
				),
			),

			'title_fontsize'=>array(
				'type'=>'slider',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TITLE_FONT_SIZE'),
				'std'=>'',
				'depends' => array(
					array('title', '!=', ''),
				),
				'responsive' => true,
				'max'=>500
			),

			'title_fontweight'=>array(
				'type'=>'text',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TITLE_FONT_WEIGHT'),
				'std'=>'',
				'depends' => array(
					array('title', '!=', ''),
				),
			),

			'title_text_color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TITLE_TEXT_COLOR'),
				'depends' => array(
					array('title', '!=', ''),
				),
			),

			'title_margin_top'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_TOP'),
				'placeholder'=>'10',
				'depends' => array(
					array('title', '!=', ''),
				),
				'responsive' => true
			),

			'title_margin_bottom'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_BOTTOM'),
				'placeholder'=>'10',
				'depends' => array(
					array('title', '!=', ''),
				),
				'responsive' => true
			),

			'separator2'=>array(
				'type'=>'separator',
				'title'=>JText::_('Subtitle Options')
			),

			'subtitle'=>array(
				'type'=>'textarea',
				'title'=>JText::_('COM_SPPAGEBUILDER_SECTION_SUBTITLE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_SECTION_SUBTITLE_DESC'),
				'css'=> 'min-height: 120px;',
			),

			'subtitle_fontsize'=>array(
				'type'=>'slider',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_SUB_TITLE_FONT_SIZE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_SUB_TITLE_FONT_SIZE_DESC'),
				'responsive'=>true,
				'depends' => array(
					array('subtitle', '!=', ''),
				),
			),

			'title_position'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_TITLE_SUBTITLE_POSITION'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_TITLE_SUBTITLE_POSITION_DESC'),
				'values'=>array(
					'sppb-text-left'=>JText::_('COM_SPPAGEBUILDER_LEFT'),
					'sppb-text-center'=>JText::_('COM_SPPAGEBUILDER_CENTER'),
					'sppb-text-right'=>JText::_('COM_SPPAGEBUILDER_RIGHT')
				),
				'std'=>'sppb-text-center',
			),

			'columns_align_center'=>array(
				'type'=>'checkbox',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_COLUMNS_ALIGN_CENTER'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ROW_COLUMNS_ALIGN_CENTER_DESC'),
				'std'=>0
			),

			'fullscreen'=>array(
				'type'=>'checkbox',
				'title'=>JText::_('COM_SPPAGEBUILDER_FULLSCREEN'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_FULLSCREEN_DESC'),
				'std'=>0,
			),

			'no_gutter'=>array(
				'type'=>'checkbox',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_NO_GUTTER'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ROW_NO_GUTTER_DESC'),
				'std'=>0,
			),

			'id'=>array(
				'type'=>'text',
				'title'=>JText::_('COM_SPPAGEBUILDER_SECTION_ID'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_SECTION_ID_DESC')
			),

			'class'=>array(
				'type'=>'text',
				'title'=>JText::_('COM_SPPAGEBUILDER_CSS_CLASS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_CSS_CLASS_DESC')
			),

		),

		'style' => array(

			'padding'=>array(
				'type'=>'padding',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
				'std'=>'50px 0px 50px 0px',
				'placeholder'=>'10px 10px 10px 10px',
				'responsive' => true
			),

			'margin'=>array(
				'type'=>'margin',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
				'std'=>'0px 0px 0px 0px',
				'placeholder'=>'10px 10px 10px 10px',
				'responsive' => true
			),

			'color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_COLOR'),
			),

			'background_type'=>array(
				'type'=>'buttons',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ENABLE_BACKGROUND_OPTIONS'),
				'std'=>'none',
				'values'=>array(
					array(
						'label' => 'None',
						'value' => 'none'
					),
					array(
						'label' => 'Color',
						'value' => 'color'
					),
					array(
						'label' => 'Image',
						'value' => 'image'
					),
					array(
						'label' => 'Gradient',
						'value' => 'gradient'
					),
					array(
						'label' => 'Video',
						'value' => 'video'
					),
				)
			),

			'background_color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
				'depends'=>array(
					array('background_type', '!=', 'none'),
					array('background_type', '!=', 'video'),
					array('background_type', '!=', 'gradient'),
					array('background_type', '!=', 'image'),
				)
			),
			'background_gradient'=>array(
				'type'=>'gradient',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
				'std'=> array(
					"color" => "#00c6fb",
					"color2" => "#005bea",
					"deg" => "45",
					"type" => "linear"
				),
				'depends'=>array(
					array('background_type', '=', 'gradient')
				)
			),

			'background_image'=>array(
				'type'=>'media',
				'format'=>'image',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_IMAGE'),
				'std'=>'',
				'show_input' => true,
				'depends'=>array(
					array('background_type', '=', 'image')
				)
			),

			'background_parallax'=>array(
				'type'=>'checkbox',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_PARALLAX_ENABLE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_PARALLAX_ENABLE_DESC'),
				'std'=>'0',
				'depends'=>array(
					array('background_type', '=', 'image')
				)
			),
			
			'background_repeat'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT'),
				'values'=>array(
					'no-repeat'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_NO_REPEAT'),
					'repeat'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_ALL'),
					'repeat-x'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_HORIZONTALLY'),
					'repeat-y'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_VERTICALLY'),
					'inherit'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INHERIT'),
				),
				'std'=>'no-repeat',
				'depends'=>array(
					array('background_type', '=', 'image'),
					array('background_image', '!=', '')
				)
			),

			'background_size'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE_DESC'),
				'values'=>array(
					'cover'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE_COVER'),
					'contain'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE_CONTAIN'),
					'inherit'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INHERIT'),
				),
				'std'=>'cover',
				'depends'=>array(
					array('background_type', '=', 'image'),
					array('background_image', '!=', '')
				)
			),

			'background_attachment'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT'),
				'values'=>array(
					'fixed'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT_FIXED'),
					'scroll'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT_SCROLL'),
					'inherit'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INHERIT'),
				),
				'std'=>'fixed',
				'depends'=>array(
					array('background_type', '=', 'image'),
					array('background_image', '!=', '')
				)
			),

			'background_position'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_POSITION'),
				'values'=>array(
					'0 0'=>JText::_('COM_SPPAGEBUILDER_LEFT_TOP'),
					'0 50%'=>JText::_('COM_SPPAGEBUILDER_LEFT_CENTER'),
					'0 100%'=>JText::_('COM_SPPAGEBUILDER_LEFT_BOTTOM'),
					'50% 0'=>JText::_('COM_SPPAGEBUILDER_CENTER_TOP'),
					'50% 50%'=>JText::_('COM_SPPAGEBUILDER_CENTER_CENTER'),
					'50% 100%'=>JText::_('COM_SPPAGEBUILDER_CENTER_BOTTOM'),
					'100% 0'=>JText::_('COM_SPPAGEBUILDER_RIGHT_TOP'),
					'100% 50%'=>JText::_('COM_SPPAGEBUILDER_RIGHT_CENTER'),
					'100% 100%'=>JText::_('COM_SPPAGEBUILDER_RIGHT_BOTTOM'),
				),
				'std'=>'0 0',
				'depends'=>array(
					array('background_type', '=', 'image'),
					array('background_image', '!=', '')
				)
			),

			'external_background_video'=>array(
				'type'=>'checkbox',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_EXTERNAL_VIDEO_ENABLE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_EXTERNAL_VIDEO_ENABLE_DESC'),
				'std'=>'0',
				'depends'=>array(
					array('background_type', '=', 'video'),
				)
			),

			'background_video_mp4'=>array(
				'type'=>'media',
				'format'=>'video',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_VIDEO_MP4'),
				'depends'=>array(
					array('background_type', '=', 'video'),
					array('external_background_video','=',0)
				)
			),

			'background_video_ogv'=>array(
				'type'=>'media',
				'format'=>'video',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_VIDEO_OGV'),
				'depends'=>array(
					array('background_type', '=', 'video'),
					array('external_background_video','=',0)
				)
			),

			'background_external_video'=>array(
				'type'=>'text',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_VIDEO_YOUTUBE_VIMEO'),
				'depends'=>array(
					array('background_type', '=', 'video'),
					array('external_background_video','=',1)
				)
			),

			'video_loop'=> array(
				'type'=> 'checkbox',
				'title'=> JText::_('COM_SPPAGEBUILDER_ROW_VIDEO_LOOP'),
				'desc'=> JText::_('COM_SPPAGEBUILDER_ROW_VIDEO_LOOP_DESC'),
				'std'=> 1,
				'depends'=>array(
					array('background_type', '=', 'video'),
					array('external_background_video', '!=', 1),
				)
			),

			'overlay_separator'=>array(
				'type'=>'separator',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_OVERLAY_OPTIONS'),
				'depends'=>array(
					array('background_type', '!=', 'none'),
					array('background_type', '!=', 'color'),
					array('background_type', '!=', 'gradient'),
				),
			),

			'overlay_type'=>array(
				'type'=>'buttons',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_CHOOSE'),
				'std'=>'overlay_color',
				'values'=>array(
					array(
						'label' => 'None',
						'value' => 'overlay_none'
					),
					array(
						'label' => 'Color',
						'value' => 'overlay_color'
					),
					array(
						'label' => 'Gradient',
						'value' => 'overlay_gradient'
					),
					array(
						'label' => 'Pattern',
						'value' => 'overlay_pattern'
					)
				),
				'depends'=>array(
					array('background_type', '!=', 'none'),
					array('background_type', '!=', 'color'),
					array('background_type', '!=', 'gradient'),
				),
			),

			'overlay'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_OVERLAY_DESC'),
				'depends'=>array(
					array('background_type', '!=', 'none'),
					array('background_type', '!=', 'color'),
					array('background_type', '!=', 'gradient'),
					array('overlay_type', '=', 'overlay_color'),
				)
			),

			'gradient_overlay'=>array(
				'type'=>'gradient',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_GRADIENT'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_GRADIENT_DESC'),
				'std'=> array(
					"color" => "rgba(127, 0, 255, 0.8)",
					"color2" => "rgba(225, 0, 255, 0.7)",
					"deg" => "45",
					"type" => "linear"
				),
				'depends'=>array(
					array('background_type', '!=', 'none'),
					array('background_type', '!=', 'color'),
					array('background_type', '!=', 'gradient'),
					array('overlay_type', '=', 'overlay_gradient'),
				)
			),

			'pattern_overlay'=>array(
				'type'=>'media',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_PATTERN'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_PATTERN_DESC'),
				'std'=> '',
				'depends'=>array(
					array('background_type', '!=', 'none'),
					array('background_type', '!=', 'color'),
					array('background_type', '!=', 'gradient'),
					array('overlay_type', '=', 'overlay_pattern'),
				)
			),

			'overlay_pattern_color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_PATTERN_COLOR'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_PATTERN_COLOR_DESC'),
				'std'=> '',
				'depends'=>array(
					array('background_type', '!=', 'none'),
					array('background_type', '!=', 'color'),
					array('background_type', '!=', 'gradient'),
					array('overlay_type', '=', 'overlay_pattern'),
					array('pattern_overlay', '!=', ''),
				)
			),

			'separator_shape_top'=>array(
				'type'=>'separator',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_TOP_SHAPE')
			),

			'show_top_shape' 		=> array(
				'type'		=> 'checkbox',
				'title'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHOW_SHAPE'),
				'desc'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHOW_TOP_SHAPE_DESC'),
				'std'		=> '',
			),

			'shape_name'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE'),
				'values'=>array(
					'clouds-flat'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_CLOUDS_FLAT'),
					'clouds-opacity'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_CLOUDS_OPACITY'),
					'paper-torn'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_PAPER_TORN'),
					'pointy-wave'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_POINTY_WAVE'),
					'rocky-mountain'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_ROCKY_MOUNTAIN'),
					'single-wave'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_SINGLE_WAVE'),
					'slope-opacity'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_SLOPE_OPACITY'),
					'slope'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_SLOPE'),
					'waves3-opacity'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_WAVES3_OPACITY'),
					'drip'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_DRIP'),
					'turning-slope'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_TURNING_SLOPE'),
				),
				'std'=>'clouds-flat',
				'depends'=>array(
					array('show_top_shape','=',1)
				)
			),

			'shape_color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_COLOR'),
				'std'=>'#e5e5e5',
				'depends'=>array(
					array('show_top_shape','=',1)
				)
			),

			'shape_width'=>array(
				'type'=>'slider',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_WIDTH'),
				'std'=>array(
					'md' => 100,
					'sm' => 100,
					'xs' => 100
				),
				'max'=>600,
				'min'=>100,
				'responsive'=>true,
				'depends'=>array(
					array('show_top_shape','=',1)
				)
			),

			'shape_height'=>array(
				'type'=>'slider',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_HEIGHT'),
				'std'=>'',
				'max'=>600,
				'responsive'=>true,
				'depends'=>array(
					array('show_top_shape','=',1)
				)
			),
			'shape_flip' 		=> array(
				'type'		=> 'checkbox',
				'title'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_FLIP'),
				'desc'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_FLIP_DESC'),
				'std'		=> false,
				'depends'=>array(
					array('show_top_shape','=',1)
				)
			),
			'shape_invert' 		=> array(
				'type'		=> 'checkbox',
				'title'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_INVERT'),
				'std'		=> false,
				'depends'=>array(
					array('show_top_shape','=',1),
					array('shape_name','!=','clouds-opacity'),
					array('shape_name','!=','slope-opacity'),
					array('shape_name','!=','waves3-opacity'),
					array('shape_name','!=','paper-torn'),
				)
			),
			'shape_to_front' 		=> array(
				'type'		=> 'checkbox',
				'title'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_TO_FRONT'),
				'desc'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_TO_FRONT_DESC'),
				'std'		=> false,
				'depends'=>array(
					array('show_top_shape','=',1)
				)
			),

			'separator_shape_bottom'=>array(
				'type'=>'separator',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_BOTTOM_SHAPE')
			),

			'show_bottom_shape' 		=> array(
				'type'		=> 'checkbox',
				'title'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHOW_SHAPE'),
				'desc'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHOW_BOTTOM_SHAPE_DESC'),
				'std'		=> '',
			),

			'bottom_shape_name'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE'),
				'values'=>array(
					'clouds-flat'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_CLOUDS_FLAT'),
					'clouds-opacity'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_CLOUDS_OPACITY'),
					'paper-torn'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_PAPER_TORN'),
					'pointy-wave'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_POINTY_WAVE'),
					'rocky-mountain'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_ROCKY_MOUNTAIN'),
					'single-wave'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_SINGLE_WAVE'),
					'slope-opacity'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_SLOPE_OPACITY'),
					'slope'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_SLOPE'),
					'waves3-opacity'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_WAVES3_OPACITY'),
					'drip'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_DRIP'),
					'turning-slope'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_TURNING_SLOPE'),
				),
				'std'=>'clouds-opacity',
				'depends'=>array(
					array('show_bottom_shape','=',1)
				)
			),

			'bottom_shape_color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_COLOR'),
				'std'=>'#e5e5e5',
				'depends'=>array(
					array('show_bottom_shape','=',1)
				)
			),

			'bottom_shape_width'=>array(
				'type'=>'slider',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_WIDTH'),
				'std'=>array(
					'md' => 100,
					'sm' => 100,
					'xs' => 100
				),
				'max'=>600,
				'min'=>100,
				'responsive'=>true,
				'depends'=>array(
					array('show_bottom_shape','=',1)
				)
			),

			'bottom_shape_height'=>array(
				'type'=>'slider',
				'title'=>JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_HEIGHT'),
				'std'=>'',
				'max'=>600,
				'responsive'=>true,
				'depends'=>array(
					array('show_bottom_shape','=',1)
				)
			),
			'bottom_shape_flip' 		=> array(
				'type'		=> 'checkbox',
				'title'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_FLIP'),
				'desc'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_FLIP_DESC'),
				'std'		=> false,
				'depends'=>array(
					array('show_bottom_shape','=',1)
				)
			),
			'bottom_shape_invert' 		=> array(
				'type'		=> 'checkbox',
				'title'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_INVERT'),
				'std'		=> false,
				'depends'=>array(
					array('show_bottom_shape','=',1),
					array('bottom_shape_name','!=','clouds-opacity'),
					array('bottom_shape_name','!=','slope-opacity'),
					array('bottom_shape_name','!=','waves3-opacity'),
					array('bottom_shape_name','!=','paper-torn'),
				)
			),
			'bottom_shape_to_front' 		=> array(
				'type'		=> 'checkbox',
				'title'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_TO_FRONT'),
				'desc'		=> JText::_('COM_SPPAGEBUILDER_ROW_SHAPE_TO_FRONT_DESC'),
				'std'		=> false,
				'depends'=>array(
					array('show_bottom_shape','=',1)
				)
			),

		),

		'responsive' => array(

			'hidden_xs' 		=> array(
				'type'		=> 'checkbox',
				'title'		=> JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_XS'),
				'desc'		=> JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_XS_DESC'),
				'std'		=> '',
			),
			'hidden_sm' 		=> array(
				'type'		=> 'checkbox',
				'title'		=> JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_SM'),
				'desc'		=> JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_SM_DESC'),
				'std'		=> '',
			),
			'hidden_md' 		=> array(
				'type'		=> 'checkbox',
				'title'		=> JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_MD'),
				'desc'		=> JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_MD_DESC'),
				'std'		=> '',
			),
		),

		'animation' => array(
			'animation'=>array(
				'type'=>'animation',
				'title'=>JText::_('COM_SPPAGEBUILDER_ANIMATION'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ANIMATION_DESC')
			),

			'animationduration'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ANIMATION_DURATION'),
				'desc'=> JText::_('COM_SPPAGEBUILDER_ANIMATION_DURATION_DESC'),
				'std'=>'300',
				'placeholder'=>'300',
			),

			'animationdelay'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ANIMATION_DELAY'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ANIMATION_DELAY_DESC'),
				'std'=>'0',
				'placeholder'=>'300',
			),
		),
		)
	);
