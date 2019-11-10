<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2018 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted access');

class SppagebuilderAddonArticles_scroller extends SppagebuilderAddons{

	public function render(){
		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';

		// Addon options
		$resource 		= (isset($this->addon->settings->resource) && $this->addon->settings->resource) ? $this->addon->settings->resource : 'article';
		$catid 			= (isset($this->addon->settings->catid) && $this->addon->settings->catid) ? $this->addon->settings->catid : 0;
		$k2catid 		= (isset($this->addon->settings->k2catid) && $this->addon->settings->k2catid) ? $this->addon->settings->k2catid : 0;
		$ordering 		= (isset($this->addon->settings->ordering) && $this->addon->settings->ordering) ? $this->addon->settings->ordering : 'latest';
		$intro_limit 	= (isset($this->addon->settings->intro_limit) && $this->addon->settings->intro_limit) ? $this->addon->settings->intro_limit : 100;
		$addon_style 	= (isset($this->addon->settings->addon_style)) ? $this->addon->settings->addon_style : 'ticker';
		$ticker_heading = (isset($this->addon->settings->ticker_heading)) ? $this->addon->settings->ticker_heading : 'Breaking News';


		$show_shape		= (isset($this->addon->settings->show_shape)) ? $this->addon->settings->show_shape : 0;
		$show_shape_class = ($show_shape) ? 'shape-enabled-need-extra-padding' : '';
		$heading_shape 	= (isset($this->addon->settings->heading_shape)) ? $this->addon->settings->heading_shape : 'arrow';
		$ticker_date_time = (isset($this->addon->settings->ticker_date_time)) ? $this->addon->settings->ticker_date_time : 0;
		$ticker_date_hour = (isset($this->addon->settings->ticker_date_hour)) ? $this->addon->settings->ticker_date_hour : 0;

		$ticker_date_time_class = ($ticker_date_time) ? 'date-wrapper-class' : '';
		$ticker_date_hour_class = ($ticker_date_hour) ? 'hour-wrapper-class' : '';

		$image_bg = (isset($this->addon->settings->image_bg)) ? $this->addon->settings->image_bg : 0;
		$image_bg_class = ($image_bg) ? 'article-image-as-bg' : '';
		$overlap_date_text = (isset($this->addon->settings->overlap_date_text)) ? $this->addon->settings->overlap_date_text : 0;
		$overlap_date_text_class = ($overlap_date_text) ? 'date-text-overlay' : '';

		$output   = '';
		//include k2 helper
		$k2helper 			= JPATH_ROOT . '/components/com_sppagebuilder/helpers/k2.php';
		$article_helper = JPATH_ROOT . '/components/com_sppagebuilder/helpers/articles.php';
		$isk2installed  = self::isComponentInstalled('com_k2');

		if ($resource == 'k2') {
			if ($isk2installed == 0) {
				$output .= '<p class="alert alert-danger">' . JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_ERORR_K2_NOTINSTALLED') . '</p>';
				return $output;
			} elseif(!file_exists($k2helper)) {
				$output .= '<p class="alert alert-danger">' . JText::_('COM_SPPAGEBUILDER_ADDON_K2_HELPER_FILE_MISSING') . '</p>';
				return $output;
			} else {
				require_once $k2helper;
			}
			$items = SppagebuilderHelperK2::getItems('', $ordering, $k2catid);
		} else {
			require_once $article_helper;
			$items = SppagebuilderHelperArticles::getArticles('', $ordering, $catid);
		}

		if (!count($items)) {
			$output .= '<p class="alert alert-warning">' . JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_NO_ITEMS_FOUND') . '</p>';
			return $output;
		}

		if(count((array) $items)) {
			$output  .= '<div class="sppb-addon sppb-addon-articles-'.$addon_style.' ' . $class . '">';

			$output .= '<div class="sppb-addon-content">';
				if($addon_style == 'scroller'){
					$output .= '<div class="sppb-article-scroller-wrap">';
					foreach ($items as $key => $item) {
						$intro_text = JHtmlString::truncate($item->introtext, $intro_limit, true, false);
						$intro_text = str_replace('...', '', $intro_text);
						$image = '';
						if ($resource == 'k2') {
							if(isset($item->image_medium) && $item->image_medium){
								$image = $item->image_medium;
							} elseif(isset($item->image_large) && $item->image_large){
								$image = $item->image_medium;
							}
						} else {
							$image = $item->image_thumbnail;
						}
						
						$bg_style = "";
						if($image_bg){
							$bg_style = 'style="background-image: url('. $image .');background-size: cover; background-position: center center;"';
						}
						$output .= '<div class="sppb-articles-scroller-content">';
						$output .= '<a href="'. $item->link .'" class="sppb-articles-scroller-link" itemprop="url">';
						
							$output .= '<div class="sppb-articles-scroller-date-left-date-container '.$image_bg_class .'" '.$bg_style.'>';
								$output .= '<div class="sppb-articles-scroller-date-left-date">';
									$output .= '<div class="sppb-articles-scroller-meta-date-left '.$overlap_date_text_class.'" itemprop="datePublished">';
									$output .='<span class="sppb-articles-scroller-day">' . Jhtml::_('date', $item->publish_up, 'd') . '</span>';
									$output .='<span class="sppb-articles-scroller-month">' . Jhtml::_('date', $item->publish_up, 'M') . '</span>';
									$output .= '</div>';
								$output .= '</div>';//.sppb-articles-scroller-date-left-date

								$output .= '<div class="sppb-articles-scroller-date-left-content">';
									$output .= '<div class="sppb-addon-articles-scroller-title">' . $item->title . '</div>';
									$output .= '<div class="sppb-articles-scroller-introtext">'. $intro_text .'...</div>';
								$output .= '</div>';//.sppb-articles-scroller-date-left-content
							$output .= '</div>';//.sppb-articles-scroller-date-left-date-container
						
						$output .= '</a>';
						$output .= '</div>';//.sppb-articles-scroller-content
					}
					$output .= '</div>';//.sppb-article-scroller-wrap
				} else {
						$output .= '<div class="sppb-articles-ticker-wrap">';
							$output .= '<div class="sppb-articles-ticker-heading">';
							$output .= $ticker_heading;

							if($show_shape){
								if($heading_shape == 'slanted-left'){
									$output .= '<svg class="sppb-articles-ticker-shape-left" width="50" height="100%" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" shape-rendering="geometricPrecision">';
									$output .= '<path d="M0 50h50L25 0H0z" fill="#E91E63"/>';
									$output .= '</svg>';
								} elseif ($heading_shape == 'slanted-right') {
									$output .= '<svg class="sppb-articles-ticker-shape-right" width="50" height="100%" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" shape-rendering="geometricPrecision">';
									$output .= '<path d="M0 0h50L25 50H0z" fill="#E91E63"/>';
									$output .= '</svg>';
								} else {
									$output .= '<svg class="sppb-articles-ticker-shape-arrow" width="50" height="100%" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" shape-rendering="geometricPrecision">';
									$output .= '<path d="M0 0h25l25 25-25 25H0z" fill="#E91E63"/>';
									$output .= '</svg>';
								}
							}
							
							$output .= '</div>';//.sppb-articles-ticker-heading
							$output .= '<div class="sppb-articles-ticker">';
							$output .= '<div class="sppb-articles-ticker-content">';
								foreach ($items as $key => $item) {
									$output .= '<div class="sppb-articles-ticker-text '.$show_shape_class.'">';
									$output .= '<a href="'. $item->link .'">' . $item->title . '</a>';
									if($ticker_date_time || $ticker_date_hour){
										$output .= '<div class="ticker-date-time-content-wrap '.$ticker_date_time_class.' '. $ticker_date_hour_class.'">';
											$output .= '<div class="ticker-date-time">';
											if($ticker_date_time){
												$output .= '<span class="ticker-date">'. Jhtml::_('date', $item->publish_up, 'd M') . '</span>';
											}
											if($ticker_date_hour){
												$output .= '<span class="ticker-hour">'. Jhtml::_('date', $item->publish_up, 'h:i:s A') . '</span>';
											}
											$output .= '</div>';
										$output .= '</div>';
									}
									$output .= '</div>';//.sppb-articles-ticker-text
								}
							$output .= '</div>';//.sppb-articles-ticker-content
							$output .= '<div class="sppb-articles-ticker-controller">';
								$output .= '<span class="sppb-articles-ticker-left-control"></span>';
								$output .= '<span class="sppb-articles-ticker-right-control"></span>';
							$output .= '</div>';//.sppb-articles-ticker-controller
							$output .= '</div>';//.sppb-articles-ticker
						$output .= '</div>';//.sppb-articles-ticker-wrap
				}

			$output  .= '</div>';

			$output  .= '</div>';
		}

		return $output;
	}

	public function stylesheets() {
		$style_sheet = array(JURI::base(true) . '/components/com_sppagebuilder/assets/css/jquery.bxslider.min.css');
        return $style_sheet;
	}

	public function css() {
		$addon_id = '#sppb-addon-' .$this->addon->id;
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';

		$left_side_bg = (isset($this->addon->settings->left_side_bg)) ? $this->addon->settings->left_side_bg : '#0E0E40;';
		
		$left_text_color = (isset($this->addon->settings->left_text_color)) ? 'color:' .$this->addon->settings->left_text_color. ';' : 'color:#fff;';

		$content_bg = (isset($this->addon->settings->content_bg)) ? 'background-color:' .$this->addon->settings->content_bg. ';' : 'background-color:#cccccc;';
		$title_color = (isset($this->addon->settings->title_color)) ? 'color:' .$this->addon->settings->title_color. ';' : 'color:#000000;';
		
		$text_color = (isset($this->addon->settings->text_color)) ? 'color:' .$this->addon->settings->text_color. ';' : 'color:#ffffff;';

		$arrow_color = (isset($this->addon->settings->arrow_color)) ? 'color:' .$this->addon->settings->arrow_color. ';' : 'color:#ffffff;';
		
		$ticker_heading_font_weight = (isset($this->addon->settings->ticker_heading_font_weight)) ? 'font-weight:' .$this->addon->settings->ticker_heading_font_weight. ';' : '';

		$content_title_font_weight = (isset($this->addon->settings->content_title_font_weight)) ? 'font-weight:' .$this->addon->settings->content_title_font_weight. ';' : 700;
		
		$border_size = (isset($this->addon->settings->border_size)) ? 'border-width:' .$this->addon->settings->border_size. 'px;' : '';
		$border_color = (isset($this->addon->settings->border_color)) ? 'border-color:' .$this->addon->settings->border_color. ';' : '';
		$border_radius = (isset($this->addon->settings->border_radius)) ? $this->addon->settings->border_radius : 0;

		$image_bg = (isset($this->addon->settings->image_bg)) ? $this->addon->settings->image_bg : 0;

		$overlap_text_color = (isset($this->addon->settings->overlap_text_color)) ? 'color:' .$this->addon->settings->overlap_text_color. ';' : '';
		$overlap_text_right = (isset($this->addon->settings->overlap_text_right)) ? 'right:' . $this->addon->settings->overlap_text_right. 'px;' : '';

		$heading_letter_spacing = (isset($this->addon->settings->heading_letter_spacing)) ? 'letter-spacing:' . $this->addon->settings->heading_letter_spacing. 'px;' : '';

		$ticker_heading_font = '';
		if (isset($this->addon->settings->ticker_heading_fontsize) && $this->addon->settings->ticker_heading_fontsize) {
			if(is_object($this->addon->settings->ticker_heading_fontsize)){
				$ticker_heading_font .= 'font-size:' . $this->addon->settings->ticker_heading_fontsize->md . 'px;';
			} else{
				$ticker_heading_font .= 'font-size:' . $this->addon->settings->ticker_heading_fontsize . 'px;';
			}
		} else {
			$ticker_heading_font .= '';
		}

		$content_fontsize = '';
		if (isset($this->addon->settings->content_fontsize) && $this->addon->settings->content_fontsize) {
			if(is_object($this->addon->settings->content_fontsize)){
				$content_fontsize .= 'font-size:' . $this->addon->settings->content_fontsize->md . 'px;';
			} else{
				$content_fontsize .= 'font-size:' . $this->addon->settings->content_fontsize . 'px;';
			}
		} else {
			$content_fontsize .= '';
		}

		$right_title_font_size = '';
		if (isset($this->addon->settings->right_title_font_size) && $this->addon->settings->right_title_font_size) {
			if(is_object($this->addon->settings->right_title_font_size)){
				$right_title_font_size .= 'font-size:' . $this->addon->settings->right_title_font_size->md . 'px;';
			} else{
				$right_title_font_size .= 'font-size:' . $this->addon->settings->right_title_font_size . 'px;';
			}
		} else {
			$right_title_font_size .= '';
		}

		$overlap_text_font_size = '';
		if (isset($this->addon->settings->overlap_text_font_size) && $this->addon->settings->overlap_text_font_size) {
			if(is_object($this->addon->settings->overlap_text_font_size)){
				$overlap_text_font_size .= 'font-size:' . $this->addon->settings->overlap_text_font_size->md . 'px;';
			} else{
				$overlap_text_font_size .= 'font-size:' . $this->addon->settings->overlap_text_font_size . 'px;';
			}
		} else {
			$overlap_text_font_size .= '';
		}

		$ticker_heading_width = '';
		if (isset($this->addon->settings->ticker_heading_width) && $this->addon->settings->ticker_heading_width) {
			if(is_object($this->addon->settings->ticker_heading_width)){
				$ticker_heading_width = $this->addon->settings->ticker_heading_width->md;
			} else{
				$ticker_heading_width = $this->addon->settings->ticker_heading_width;
			}
		} else {
			$ticker_heading_width = '';
		}

		$ticker_heading_width_sm = '';
		if (isset($this->addon->settings->ticker_heading_width) && $this->addon->settings->ticker_heading_width) {
			if(is_object($this->addon->settings->ticker_heading_width)){
				$ticker_heading_width_sm = $this->addon->settings->ticker_heading_width->sm;
			} else{
				$ticker_heading_width_sm = $this->addon->settings->ticker_heading_width_sm;
			}
		} else {
			$ticker_heading_width_sm = '';
		}
		$ticker_heading_width_xs = '';
		if (isset($this->addon->settings->ticker_heading_width) && $this->addon->settings->ticker_heading_width) {
			if(is_object($this->addon->settings->ticker_heading_width)){
				$ticker_heading_width_xs = $this->addon->settings->ticker_heading_width->xs;
			} else{
				$ticker_heading_width_xs = $this->addon->settings->ticker_heading_width_xs;
			}
		} else {
			$ticker_heading_width_xs = '';
		}

		$item_bottom_gap = '';
		if (isset($this->addon->settings->item_bottom_gap) && $this->addon->settings->item_bottom_gap) {
			if(is_object($this->addon->settings->item_bottom_gap)){
				$item_bottom_gap = $this->addon->settings->item_bottom_gap->md;
			} else{
				$item_bottom_gap = $this->addon->settings->item_bottom_gap;
			}
		} else {
			$item_bottom_gap = 1;
		}

		$heading_date_font_family = '';
		if(isset($this->addon->settings->heading_date_font_family) && $this->addon->settings->heading_date_font_family) {
			$font_path = new JLayoutFile('addon.css.fontfamily', $layout_path);
			$font_path->render(array('font'=>$this->addon->settings->heading_date_font_family));
			$heading_date_font_family .= 'font-family: ' . $this->addon->settings->heading_date_font_family . ';';
		}

		$content_font_family = '';
		if(isset($this->addon->settings->content_font_family) && $this->addon->settings->content_font_family) {
			$font_path = new JLayoutFile('addon.css.fontfamily', $layout_path);
			$font_path->render(array('font'=>$this->addon->settings->content_font_family));
			$content_font_family .= 'font-family: ' . $this->addon->settings->content_font_family . ';';
		}

		//Start Css output
		$css = '';

		if($ticker_heading_font || $ticker_heading_font_weight){
			$css .= $addon_id . ' .sppb-articles-scroller-meta-date-left span.sppb-articles-scroller-day,';
			$css .= $addon_id . ' .sppb-articles-ticker-heading {';
				if($ticker_heading_font ){
					$css .= $ticker_heading_font;
				}
				if($ticker_heading_font_weight){
					$css .= $ticker_heading_font_weight;
				}
			$css .= '}';
		}

		if($content_fontsize){
			$css .= $addon_id . ' .sppb-articles-scroller-introtext,';
			$css .= $addon_id . ' .sppb-articles-ticker-text a {';
			$css .= $content_fontsize;
			$css .= '}';
		}

		if($right_title_font_size || $content_title_font_weight){
			$css .= $addon_id . ' .sppb-addon-articles-scroller-title{';
				if($right_title_font_size){
					$css .= $right_title_font_size;
				}
				if($content_title_font_weight){
					$css .= $content_title_font_weight;
				}
			$css .= '}';
		}

		if($heading_date_font_family){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-date,';
			$css .= $addon_id . ' .sppb-articles-ticker-heading {';
			$css .= $heading_date_font_family;
			$css .= '}';
		}

		if($content_font_family){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-content,';
			$css .= $addon_id . ' .sppb-articles-ticker-text {';
			$css .= $content_font_family;
			$css .= '}';
		}

		if($ticker_heading_width){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-date,';
			$css .= $addon_id . ' .sppb-articles-ticker-heading {';
			$css .= '-ms-flex: 0 0 '.$ticker_heading_width.'%;';
			$css .= 'flex: 0 0 '.$ticker_heading_width.'%;';
			$css .= '}';

			$css .= $addon_id . ' .sppb-articles-scroller-date-left-content,';
			$css .= $addon_id . ' .sppb-articles-ticker {';
			$css .= '-ms-flex: 0 0 '.(100-$ticker_heading_width).'%;';
			$css .= 'flex: 0 0 '.(100-$ticker_heading_width).'%;';
			$css .= '}';
		}

		if($ticker_heading_width_sm){
			$css .= '@media only screen and (max-width: 991px) {';
				$css .= $addon_id . ' .sppb-articles-scroller-date-left-date,';
				$css .= $addon_id . ' .sppb-articles-ticker-heading {';
				$css .= '-ms-flex: 0 0 '.$ticker_heading_width_sm.'%;';
				$css .= 'flex: 0 0 '.$ticker_heading_width_sm.'%;';
				$css .= '}';

				$css .= $addon_id . ' .sppb-articles-scroller-date-left-content,';
				$css .= $addon_id . ' .sppb-articles-ticker {';
				$css .= '-ms-flex: 0 0 '.(100-$ticker_heading_width_sm).'%;';
				$css .= 'flex: 0 0 '.(100-$ticker_heading_width_sm).'%;';
				$css .= '}';
			$css .= '}';
		}

		if($ticker_heading_width_xs){
			$css .= '@media only screen and (max-width: 767px) {';
				$css .= $addon_id . ' .sppb-articles-scroller-date-left-date,';
				$css .= $addon_id . ' .sppb-articles-ticker-heading {';
				$css .= '-ms-flex: 0 0 '.$ticker_heading_width_xs.'%;';
				$css .= 'flex: 0 0 '.$ticker_heading_width_xs.'%;';
				$css .= '}';

				$css .= $addon_id . ' .sppb-articles-scroller-date-left-content,';
				$css .= $addon_id . ' .sppb-articles-ticker {';
				$css .= '-ms-flex: 0 0 '.(100-$ticker_heading_width_xs).'%;';
				$css .= 'flex: 0 0 '.(100-$ticker_heading_width_xs).'%;';
				$css .= '}';
			$css .= '}';
		}

		if($border_radius){
			$css .= $addon_id . ' .sppb-articles-ticker-heading {';
			$css .= 'border-top-left-radius: '. $border_radius . 'px;';
			$css .= 'border-bottom-left-radius: '. $border_radius . 'px;';
			$css .= '}';
		}

		if($border_size || $border_color || $border_radius){
			$css .= $addon_id . ' .sppb-articles-ticker {';
				if($border_size){
					$css .= $border_size . 'border-style: solid; border-left: 0;';
				}
				if($border_color){
					$css .= $border_color;
				}
				if($border_radius){
					$css .= 'border-top-right-radius: '. $border_radius . 'px;';
					$css .= 'border-bottom-right-radius: '. $border_radius . 'px;';
				}
			$css .= '}';
		}

		if($border_size || $border_color){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-date-container {';
			if($border_size || $border_color){
				$css .= $border_size . 'border-style: solid; border-left: 0;';
				if($border_color){
					$css .= $border_color;
				}
			}
			$css .= '}';
		}
		
		if($item_bottom_gap){
			$css .= $addon_id . ' .sppb-articles-scroller-content a {';
				$css .= 'padding-bottom:'.$item_bottom_gap.'px;';
			$css .= '}';
		}

		if($left_side_bg || $left_text_color){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-date,';
			$css .= $addon_id . ' .sppb-articles-ticker-heading {';
			$css .= 'background-color:'.$left_side_bg.';';
			$css .= $left_text_color;
			$css .= '}';
		}

		if($left_side_bg || $left_text_color){
			$css .= $addon_id . ' .ticker-date-time {';
				if($left_side_bg){
					$css .= 'background:'.$left_side_bg.';';
				}
				if($left_text_color){
					$css .= $left_text_color;
				}
			$css .= '}';
		}

		if($left_text_color){
			$css .= $addon_id . ' .sppb-articles-scroller-meta-date-left span {';
			$css .= $left_text_color;
			$css .= '}';
		}

		if($overlap_text_color || $overlap_text_right || $overlap_text_font_size){
			$css .= $addon_id . ' .date-text-overlay .sppb-articles-scroller-month {';
			$css .= $overlap_text_color;
			if($overlap_text_right){
				$css .= $overlap_text_right;
			}
			if($overlap_text_font_size){
				$css .= $overlap_text_font_size;
			}
			$css .= '}';
		}

		if($content_bg){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-content,';
			$css .= $addon_id . ' .sppb-articles-ticker,';
			$css .= $addon_id . ' .sppb-articles-ticker-ticker-modern-content {';
			$css .= $content_bg;
			$css .= '}';
		}

		if($title_color){
			$css .= $addon_id . ' .sppb-addon-articles-scroller-title,';
			$css .= $addon_id . ' .sppb-articles-ticker-text a,';
			$css .= $addon_id . ' .sppb-articles-ticker-ticker-modern-content a {';
			$css .= $title_color;
			$css .= '}';
		}

		if($text_color){
			$css .= $addon_id . ' .sppb-articles-scroller-introtext,';
			$css .= $addon_id . ' .sppb-articles-ticker-modern-text {';
			$css .= $text_color;
			$css .= '}';
		}
		
		if($left_side_bg){
			$css .= $addon_id . ' .sppb-articles-ticker-heading svg path {';
			$css .= 'fill:'.$left_side_bg.';';
			$css .= '}';
		}

		if($arrow_color){
			$css .= $addon_id . ' .sppb-articles-ticker-left-control,';
			$css .= $addon_id . ' .sppb-articles-ticker-right-control{';
			$css .= $arrow_color;
			$css .= '}';

			$css .= $addon_id . ' .sppb-articles-ticker-left-control a,';
			$css .= $addon_id . ' .sppb-articles-ticker-right-control a{';
			$css .= $arrow_color;
			$css .= '}';
		}

		if($image_bg){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-date-container > div{';
				$css .= 'background: transparent;position: relative;';
			$css .= '}';
		}
		
		if($heading_letter_spacing){
			$css .= $addon_id . ' .sppb-articles-scroller-meta-date-left .sppb-articles-scroller-day {';
			$css .= $heading_letter_spacing;
			$css .= '}';
		}

		return $css;
	}

	public function scripts() {
        $base_url = JURI::base(true);
        $js = array($base_url . '/components/com_sppagebuilder/assets/js/jquery.bxslider.min.js');

        return $js;
	}
	public function js(){
		$addon_id = '#sppb-addon-' .$this->addon->id;
		$slide_speed = (isset($this->addon->settings->slide_speed) && $this->addon->settings->slide_speed) ? $this->addon->settings->slide_speed : 500;
		$addon_style = (isset($this->addon->settings->addon_style)) ? $this->addon->settings->addon_style : 'ticker';
		if ($addon_style == 'ticker') {
			return '
				jQuery(document).on("ready", function(){
					"use strict";
					jQuery("'.$addon_id.' .sppb-articles-ticker-content").bxSlider({
						minSlides: 1,
						maxSlides: 1,
						mode: "vertical",
						speed: '.$slide_speed.',
						pager: false,
						prevText: "<i aria-hidden=\'true\' class=\'fa fa-angle-left\'></i>",
						nextText: "<i aria-hidden=\'true\' class=\'fa fa-angle-right\'></i>",
						nextSelector: "'.$addon_id.' .sppb-articles-ticker-right-control",
						prevSelector: "'.$addon_id.' .sppb-articles-ticker-left-control",
						auto: true,
						adaptiveHeight:true,
						autoHover: true,
						touchEnabled:false,
						autoStart:true
					});
				});
			';
		} else {
			return '
				jQuery(document).on("ready", function(){
					"use strict";
					jQuery("'.$addon_id.' .sppb-article-scroller-wrap").bxSlider({
						minSlides: 3,
						mode: "vertical",
						speed: '.$slide_speed.',
						pager: false,
						controls: false,
						auto: true,
						moveSlides: 1,
						adaptiveHeight:true,
						touchEnabled:false,
						autoStart:true
					});
				});
			';
		}
	}
	static function isComponentInstalled($component_name){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select( 'a.enabled' );
		$query->from($db->quoteName('#__extensions', 'a'));
		$query->where($db->quoteName('a.name')." = ".$db->quote($component_name));
		$db->setQuery($query);
		$is_enabled = $db->loadResult();
		return $is_enabled;
	}

}
