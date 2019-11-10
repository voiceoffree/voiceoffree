<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<div class="latestnews<?php echo $moduleclass_sfx; ?>">
<?php foreach ($list as $item) {

	$attrbs 		= json_decode($item->attribs);
	$images 		= json_decode($item->images);
	$intro_image 	= '';

	if(isset($attrbs->spfeatured_image) && $attrbs->spfeatured_image != '') {

		$intro_image = $attrbs->spfeatured_image;
		$basename = basename($intro_image);
		$list_image = JPATH_ROOT . '/' . dirname($intro_image) . '/' . JFile::stripExt($basename) . '_thumbnail.' . JFile::getExt($basename);
		if(file_exists($list_image)) {
			$thumb_image = JURI::root(true) . '/' . dirname($intro_image) . '/' . JFile::stripExt($basename) . '_thumbnail.' . JFile::getExt($basename);
		}

	} elseif(isset($images->image_intro) && !empty($images->image_intro)) {
		$thumb_image = $images->image_intro;
	}

?>
	<div itemscope itemtype="http://schema.org/Article">
		<?php if (!empty($thumb_image)) {?>
			<div class="img-responsive article-list-img">
				<img src="<?php echo $thumb_image; ?>">
			</div>
		<?php } ?>
		<a href="<?php echo $item->link; ?>" class="hope-news-title" itemprop="url">
			<span itemprop="name">
				<?php echo $item->title; ?>
			</span>
		</a>
		
	</div>
<?php } ?>
</div>
