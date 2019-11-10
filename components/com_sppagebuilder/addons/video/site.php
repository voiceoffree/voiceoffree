<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonVideo extends SppagebuilderAddons {

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Options
		$url = (isset($this->addon->settings->url) && $this->addon->settings->url) ? $this->addon->settings->url : '';
		$hideinfo = (isset($this->addon->settings->hideinfo)) ? $this->addon->settings->hideinfo : false;
		$suggested_video = (isset($this->addon->settings->suggested_video)) ? $this->addon->settings->suggested_video : 0;
		$no_cookie = (isset($this->addon->settings->no_cookie)) ? $this->addon->settings->no_cookie : 0;

		$mp4_enable = (isset($this->addon->settings->mp4_enable) && $this->addon->settings->mp4_enable) ? $this->addon->settings->mp4_enable : 0;

		$mp4_video = (isset($this->addon->settings->mp4_video) && $this->addon->settings->mp4_video) ? $this->addon->settings->mp4_video : '';
		if($mp4_video && (strpos($this->addon->settings->mp4_video, "http://") !== false || strpos($this->addon->settings->mp4_video, "https://") !== false)){
			$mp4_video = $this->addon->settings->mp4_video;
		} else {
			if(!empty($mp4_video)){
				$mp4_video = JURI::base(true) . '/' . $this->addon->settings->mp4_video;
			}
		}

		$ogv_video = (isset($this->addon->settings->ogv_video) && $this->addon->settings->ogv_video) ? $this->addon->settings->ogv_video : '';
		if($ogv_video && (strpos($this->addon->settings->ogv_video, "http://") !== false || strpos($this->addon->settings->ogv_video, "https://") !== false)){
			$ogv_video = $this->addon->settings->ogv_video;
		} else {
			if(!empty($ogv_video)){
				$ogv_video = JURI::base(true) . '/' . $this->addon->settings->ogv_video;
			}
		}

		$show_control = (isset($this->addon->settings->show_control) && $this->addon->settings->show_control) ? $this->addon->settings->show_control : 0;
		$video_loop = (isset($this->addon->settings->video_loop) && $this->addon->settings->video_loop) ? $this->addon->settings->video_loop : 0;
		$autoplay_video = (isset($this->addon->settings->autoplay_video) && $this->addon->settings->autoplay_video) ? $this->addon->settings->autoplay_video : 0;
		$video_poster = (isset($this->addon->settings->video_poster) && $this->addon->settings->video_poster) ? $this->addon->settings->video_poster : '';
		if($video_poster && (strpos($this->addon->settings->video_poster, "http://") !== false || strpos($this->addon->settings->video_poster, "https://") !== false)){
			$video_poster = $this->addon->settings->video_poster;
		} else {
			if(!empty($video_poster)){
				$video_poster = JURI::base(true) . '/' . $this->addon->settings->video_poster;
			}
		}

		//Output
		$output  = '';
		$src = '';
		
		if($url) {
			$video = parse_url($url);

			$infoParam = $hideinfo ? '&showinfo=0' : '';
			$infoParamVimeo = $hideinfo ? '?title=0&byline=0&portrait=0' : '';
			$video_suggest = $suggested_video ? '&rel=0' : '';
			$youtube_no_cookie = $no_cookie ? '-nocookie' : '';

			switch($video['host']) {
				case 'youtu.be':
				$id = trim($video['path'],'/');
				$src = '//www.youtube'.$youtube_no_cookie.'.com/embed/' . $id .'?iv_load_policy=3'. $infoParam . $video_suggest;
				break;

				case 'www.youtube.com':
				case 'youtube.com':
				parse_str($video['query'], $query);
				$id = $query['v'];
				$src = '//www.youtube'.$youtube_no_cookie.'.com/embed/' . $id .'?iv_load_policy=3' . $infoParam . $video_suggest;
				break;

				case 'vimeo.com':
				case 'www.vimeo.com':
				$id = trim($video['path'],'/');
				$src = "//player.vimeo.com/video/{$id}{$infoParamVimeo}";
			}
			
		}

		$output  .= '<div class="sppb-addon sppb-addon-video ' . $class . '">';
		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
		if($mp4_enable != 1){
			$output .= '<div class="sppb-video-block sppb-embed-responsive sppb-embed-responsive-16by9">';
			$output .= '<iframe class="sppb-embed-responsive-item" src="' . $src . '" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			$output .= '</div>';
		} else {
			if($mp4_video || $ogv_video){
				$output .= '<div class="sppb-addon-video-local-video-wrap">';
				$output .= '<video class="sppb-addon-video-local-source" '.($video_loop != 0 ? 'loop' : '').' '.($autoplay_video!=0 ? 'autoplay' : '').' '.($show_control!=0 ? 'controls' : '').' poster="'.$video_poster.'" controlsList="nodownload" webkit-playsinline playsinline>';
				if(!empty($mp4_video)){
					$output .= '<source src="'.$mp4_video.'" type="video/mp4">';
				}
				if(!empty($ogv_video)){
					$output .= '<source src="'.$ogv_video.'" type="video/ogg">';
				}
				$output .= '</video>';
				$output .= '</div>';
			}
		}
		$output .= '</div>';

		return $output;

	}

	public static function getTemplate() {

		$output = '

			<#
				let videoUrl = data.url || ""
				let embedSrc = ""
				let infoParam = data.hideinfo ? "&showinfo=0" : ""
				infoParamVimeo = data.hideinfo ? "?title=0&byline=0&portrait=0" : "";
				let suggested_video = data.suggested_video ? "&rel=0" : ""
				let youtube_no_cookie = data.no_cookie ? "-nocookie" : ""
				let mp4_enable = (typeof data.mp4_enable == "undefined") ? 0 : data.mp4_enable;
				let mp4_video = (!_.isEmpty(data.mp4_video) && data.mp4_video) ? data.mp4_video : "https://www.joomshaper.com/media/videos/2017/11/10/pb-intro-video.mp4";

				if ( videoUrl ) {
					let tempAchor = document.createElement("a")
						tempAchor.href = videoUrl

					let videoObj = {
						host    :   tempAchor.hostname,
						path    :   tempAchor.pathname,
						query   :   tempAchor.search.substr(tempAchor.search.indexOf("?") + 1)
					}

					switch( videoObj.host ){
						case "youtu.be":
							var videoId = videoObj.path.trim();
								embedSrc = "//www.youtube"+youtube_no_cookie+".com/embed"+ videoId + "?iv_load_policy=3" + infoParam + suggested_video
							break;

						case "www.youtube.com":
						case "youtube.com":
							var queryStr = videoObj.query.split("=");
								embedSrc = "//www.youtube"+youtube_no_cookie+".com/embed/"+ queryStr[1]+ "?iv_load_policy=3" + infoParam + suggested_video
							break;

						case "www.vimeo.com":
						case "vimeo.com":
							var videoId = videoObj.path.trim();
								embedSrc = "//player.vimeo.com/video"+ videoId + infoParamVimeo;
							break;
					}
				}
			#>

	 		<div class="sppb-addon sppb-addon-video {{ data.class }}">
		 		<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{{ data.title }}}</{{ data.heading_selector }}><# } #>
				<# if(mp4_enable != 1){ #>
					<div class="sppb-iframe-drag-overlay"></div>
					<div class="sppb-video-block sppb-embed-responsive sppb-embed-responsive-16by9">
						<# if(embedSrc){ #>
						<iframe class="sppb-embed-responsive-item" src=\'{{ embedSrc }}\' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						<# } #>
					</div>
				 <# } else {
					if(mp4_video || data.ogv_video){
						#>
						<div class="sppb-addon-video-local-video-wrap">
							<video class="sppb-addon-video-local-source" {{(data.video_loop != 0 ? "loop" : "")}} {{(data.autoplay_video!=0 ? "autoplay" : "")}}  {{(data.show_control!=0 ? "controls" : "")}} 
							<# if(!_.isEmpty(data.video_poster)){
							if(data.video_poster.indexOf("http://") == -1 && data.video_poster.indexOf("https://") == -1){ #>
								poster=\'{{ pagebuilder_base + data.video_poster }}\'
							<# } else { #>
								poster=\'{{ data.video_poster }}\'
							<# }
							} #> 
							controlsList="nodownload">
							<# if(!_.isEmpty(mp4_video)){ #>
								<# if(mp4_video.indexOf("http://") == -1 && mp4_video.indexOf("https://") == -1){ #>
									<source src=\'{{ pagebuilder_base + mp4_video }}\' type="video/mp4">
								<# } else { #>
									<source src=\'{{ mp4_video }}\' type="video/mp4">
								<# } #> 
							<# }
							if(!_.isEmpty(data.ogv_video)){
							#>
								<# if(data.ogv_video.indexOf("http://") == -1 && data.ogv_video.indexOf("https://") == -1){ #>
									<source src=\'{{ pagebuilder_base + data.ogv_video }}\' type="video/mp4">
								<# } else { #>
									<source src=\'{{ data.ogv_video }}\' type="video/mp4">
								<# } #>
							<# } #>
							</video>
						</div>
					<# } #>
				<# } #>
	 		</div>
		';

		return $output;
 }
}
