<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2018 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined('_JEXEC') or die('restricted access');

class SppagebuilderAddonInstagram_gallery extends SppagebuilderAddons {
	public static $assets = array();
	
	public function render() {
		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$count = (isset($this->addon->settings->limit) && $this->addon->settings->limit) ? $this->addon->settings->limit : 0;
		$show_stats = (isset($this->addon->settings->show_stats) && $this->addon->settings->show_stats) ? $this->addon->settings->show_stats : array();
		$thumb_per_row  = (isset($this->addon->settings->thumb_per_row) && $this->addon->settings->thumb_per_row) ? $this->addon->settings->thumb_per_row : 4;
		
		$layout_type  = (isset($this->addon->settings->layout_type) && $this->addon->settings->layout_type) ? $this->addon->settings->layout_type : 'default';
		
		$output = '';
		$output .= '<div class="sppb-addon sppb-addon-instagram-gallery ' . $class . ' layout-' . $layout_type . '">';
		
		if ($title) {
			$output .= '<div class="sppb-addon-instagram-text-wrap">';
			$output .= '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>';
			$output .= '</div>'; //.sppb-addon-instagram-text-wrap
		}
		
		$items = $this->getImages();
		$total_items = count($items);
		
		if ( !$items ) {
			$output .= '<p class="alert alert-warning">' . JText::_('COM_SPPAGEBUILDER_ADDON_INSTAGRAM_ERORR') . '</p>';
		} else {
			$output .= '<ul class="sppb-instagram-images">';
			for ($i=0; $i < $count; $i++) {
				// break if total items less than count
				if($i == $total_items){
					break;
				}
				if($layout_type == 'classic'){
				$output .= '<li class="sppb-instagram-image">';
					$output .= '<div class="sppb-instagram-classic-content-wrap">';
						if (in_array('author', $show_stats)) {
							$output .= '<div class="addon-instagram-item-author-wrap">';
								$author_image = ( isset($items[$i]->user->profile_picture) && $items[$i]->user->profile_picture ) ? $items[$i]->user->profile_picture: false;
								
								$author_name = false;
								if ( isset($items[$i]->user->full_name) && $items[$i]->user->full_name ) {
									$author_name = $items[$i]->user->full_name;
								} elseif( isset($items[$i]->user->username) && $items[$i]->user->username ) {
									$author_name = $items[$i]->user->username;
								}
								
								$output .= '<div class="addon-instagram-author-info">';
								if($author_image){
									$output .= '<a class="instagram-author-image" href="' . $items[$i]->link . '" target="_blank"><img src="' . $author_image. '" alt="' . $author_name  .'"></a>';
								}
								$output .= '<div class="instagram-author-meta-content">';
								if ($author_name) {
									$output .= '<a href="' . $items[$i]->link . '" target="_blank">' . $author_name .'</a>';
								}
								$output .= '<span>' . date('F j', $items[$i]->created_time).'</span>';
								$output .= '</div>'; //.instagram-author-meta-content
								$output .= '</div>'; //.addon-instagram-author-info
								$output .= '<a class="instagram-redirect-link" href="' . $items[$i]->link . '" target="_blank"><i class="fa fa-instagram"></i></a>';
							$output .= '</div>'; //.addon-instagram-item-author-wrap
						}
						$output .= (!empty($items[$i]->images->standard_resolution->url)) ? '<a class="sppb-instagram-gallery-btn" href="' . $items[$i]->images->standard_resolution->url . '">' : '';
						$output .= '<div class="addon-instagram-image-wrap">';
						$output .= '<img class="instagram-image sppb-img-responsive" src="' . $items[$i]->images->standard_resolution->url . '" alt="">';
						$output .= '</div>'; //.addon-instagram-image-wrap
						if (in_array('likes', $show_stats) || in_array('comments', $show_stats) || in_array('caption', $show_stats)) {
							
							$output .= '<div class="addon-instagram-classic-meta-content">';
							if ( in_array('likes', $show_stats) || in_array('comments', $show_stats) ) {
								// get stats
								$likes = ( isset($items[$i]->likes->count) && $items[$i]->likes->count ) ? $items[$i]->likes->count: 0;
								$comments = ( isset($items[$i]->comments->count) && $items[$i]->comments->count ) ? $items[$i]->comments->count: 0;
								
								$output .= '<div class="addon-instagram-item-info">';
								if ( in_array('likes', $show_stats) ) {
									$output .= '<span class="addon-instagram-item-likes"><i class="fa fa-heart-o"></i><span class="intagram-like-number">' . $likes . '</span></span>';
								}
								if ( in_array('comments', $show_stats) ) {
									$output .= '<span class="addon-instagram-item-comments"><i class="fa fa-comment-o"></i><span class="intagram-comment-number">' . $comments . '</span></span>';
								}
								$output .= '</div>'; //.addon-instagram-item-info
							}
							if ( in_array('caption', $show_stats) ) {
								$caption_txt = ( isset($items[$i]->caption->text) && $items[$i]->caption->text ) ? $items[$i]->caption->text: false;
								if($caption_txt){
									$output .= '<div class="addon-instagram-caption">';
									$output .= '<p><strong>'.$items[$i]->user->username.' </strong>' .  JHtmlString::truncate(strip_tags($caption_txt), 100) . '</p>';
									$output .= '</div>'; //.addon-instagram-item-info
								}
							}
							$output .= '</div>'; //.addon-instagram-classic-meta-content
						}
						$output .= (!empty($items[$i]->images->standard_resolution->url)) ? '</a>' : '';
					$output .='</div>'; //.sppb-instagram-classic-content-wrap
				$output .= '</li>';//.sppb-instagram-image
				} else {
					$output .= '<li class="sppb-instagram-image">';
					$output .= (!empty($items[$i]->images->standard_resolution->url)) ? '<a class="sppb-instagram-gallery-btn" href="' . $items[$i]->images->standard_resolution->url . '">' : '';
					$output .= '<div class="addon-instagram-item-wrap">';
					if ( in_array('likes', $show_stats) || in_array('comments', $show_stats) || in_array('author', $show_stats) || in_array('caption', $show_stats) ) {
						$output .= '<div class="addon-instagram-item-overlay">';
							$output .= '<div class="addon-instagram-meta-content">';
							if ( in_array('likes', $show_stats) || in_array('comments', $show_stats) ) {
								// get stats
								$likes = ( isset($items[$i]->likes->count) && $items[$i]->likes->count ) ? $items[$i]->likes->count: 0;
								$comments = ( isset($items[$i]->comments->count) && $items[$i]->comments->count ) ? $items[$i]->comments->count: 0;
								
								$output .= '<div class="addon-instagram-item-info">';
								if ( in_array('likes', $show_stats) ) {
									$output .= '<span class="addon-instagram-item-likes"><i class="fa fa-heart-o"></i><span class="intagram-like-number">' . $likes . '</span></span>';
								}
								if ( in_array('comments', $show_stats) ) {
									$output .= '<span class="addon-instagram-item-comments"><i class="fa fa-comment-o"></i><span class="intagram-comment-number">' . $comments . '</span></span>';
								}
								$output .= '</div>'; //.addon-instagram-item-info
							}
							if ( in_array('caption', $show_stats) ) {
								$caption_txt = ( isset($items[$i]->caption->text) && $items[$i]->caption->text ) ? $items[$i]->caption->text: false;
								if($caption_txt){
									$output .= '<div class="addon-instagram-caption">';
									$output .= '<p>' .  JHtmlString::truncate(strip_tags($caption_txt), 100) . '</p>';
									$output .= '</div>'; //.addon-instagram-caption
								}
							}
							$output .= '</div>'; //.addon-instagram-meta-content
						$output .= '</div>'; //.addon-instagram-item-overlay
					}
					
					$output .= '<div class="addon-instagram-image-wrap">';
					$output .= '<img class="instagram-image sppb-img-responsive" src="' . $items[$i]->images->standard_resolution->url . '" alt="">';
					$output .= '</div>'; //.addon-instagram-image-wrap
					
					$output .= '</div>'; //.addon-instagram-item-wrap
					
					$output .= (!empty($items[$i]->images->standard_resolution->url)) ? '</a>' : '';
					$output .= '</li>';//.sppb-instagram-image
				}
			}
			$output .= '</ul>'; //.sppb-instagram-images
		}
		
		$output .= '</div>'; //.sppb-addon-instagram-gallery
		return $output;
	}
	
	public function css() {
		$addon_id    = '#sppb-addon-' . $this->addon->id;
		$thumb_per_row  = (isset($this->addon->settings->thumb_per_row) && $this->addon->settings->thumb_per_row) ? $this->addon->settings->thumb_per_row : 4;
		$item_height  = (isset($this->addon->settings->item_height) && $this->addon->settings->item_height) ? $this->addon->settings->item_height : '';
		$layout_type  = (isset($this->addon->settings->layout_type) && $this->addon->settings->layout_type) ? $this->addon->settings->layout_type : 'default';
		
		$width = round((100/$thumb_per_row), 4);
		
		$css = '';
		if($thumb_per_row) {
			$css .= $addon_id . ' .sppb-instagram-images .sppb-instagram-image {';
			$css .= 'width:'.$width.'%;';
			$css .= 'height:auto;';
			$css .= '}';
			if($layout_type == 'classic'){
				$css .= $addon_id . ' .sppb-instagram-images .sppb-instagram-image {';
				$css .= 'flex: 0 0 '.$width.'%;';
				$css .= '}';
			}
			if($thumb_per_row>3){
				$css .= '@media only screen and (max-width: 992px) {';
					$css .= $addon_id . ' .sppb-instagram-images .sppb-instagram-image {';
					$css .= 'flex: 0 0 33.3333%;';
					$css .= 'width: 33.3333%;';
					$css .= '}';
				$css .= '}';
			}
			$css .= '@media only screen and (max-width: 767px) {';
				$css .= $addon_id . ' .sppb-instagram-images .sppb-instagram-image {';
				$css .= 'flex: 0 0 50%;';
				$css .= 'width: 50%;';
				$css .= '}';
			$css .= '}';
			$css .= '@media only screen and (max-width: 480px) {';
				$css .= $addon_id . ' .sppb-instagram-images .sppb-instagram-image {';
				$css .= 'flex: 0 0 100%;';
				$css .= 'width: 100%;';
				$css .= '}';
			$css .= '}';
		}

		return $css;
	}
	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/css/magnific-popup.css');
	}

	public function scripts() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/js/jquery.magnific-popup.min.js');
	}
	public function js() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
			$js ='jQuery(function($){
				$("'.$addon_id.' .sppb-instagram-gallery-btn").magnificPopup({
					type: "image",
					gallery: {
						enabled: true
					  },
				});
			});
			';
  
			return $js;
		}
	private function getImages() {
		jimport( 'joomla.filesystem.folder' );
		$cache_path = JPATH_CACHE . '/com_sppagebuilder/addons/addon-' . $this->addon->id;
		$cache_file = $cache_path . '/instagram.json';
		
		if(!file_exists($cache_path)) {
			JFolder::create($cache_path, 0755);
		}
		
		if (file_exists($cache_file) && (filemtime($cache_file) > (time() - 60 * 30 ))) {
			$images = file_get_contents($cache_file);
		} else {
			$user_id      = (isset($this->addon->settings->user_id) && $this->addon->settings->user_id) ? $this->addon->settings->user_id : '7583938101';
			$access_token = (isset($this->addon->settings->access_token) && $this->addon->settings->access_token) ? $this->addon->settings->access_token : '7583938101.1677ed0.99f074be46624ffa97f1eb27d690f657';
			$item_resource = (isset($this->addon->settings->item_resource) && $this->addon->settings->item_resource) ? $this->addon->settings->item_resource : 'userid';
			$hashtag 	   = (isset($this->addon->settings->hashtag) && $this->addon->settings->hashtag) ? $this->addon->settings->hashtag : '';
			$limit        = (isset($this->addon->settings->limit) && $this->addon->settings->limit) ? $this->addon->settings->limit : '3';
			if (!$user_id || !$access_token) {
				echo '<p class="alert alert-warning">' . JText::_('COM_SPPAGEBUILDER_ADDON_INSTAGRAM_ERROR') . '</p>';
				return;
			}
			
			if( $item_resource == 'hashtag' && $hashtag) {
				$api = "https://api.instagram.com/v1/tags/". $hashtag  ."/media/recent/?access_token=" . $access_token . "&count=". $limit;
			} else {
				$api = "https://api.instagram.com/v1/users/". $user_id  ."/media/recent/?access_token=" . $access_token . "&count=". $limit;
			}
			
			if( ini_get('allow_url_fopen') ) {
				$images = file_get_contents($api);
				file_put_contents($cache_file, $images, LOCK_EX);
			} else {
				$images = $this->curl($api);
			}
		}
		$json = json_decode($images);
		if(isset($json->data)) {
			return $json->data;
		}
		
		return array();
	}
	
	function curl($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
			
}