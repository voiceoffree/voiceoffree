<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2016 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

$sppb_helper_path = JPATH_ADMINISTRATOR . '/components/com_sppagebuilder/helpers/sppagebuilder.php';
if (!file_exists($sppb_helper_path)) {
 return;
}

if(!class_exists('SppagebuilderHelper')) {
	require_once $sppb_helper_path;
}

class PlgContentSppagebuilder extends JPlugin {

	protected $autoloadLanguage = true;
	protected $sppagebuilder_content = '';
	protected $sppagebuilder_active = 0;

	// Common
	public static function __context() {
		$context = array(
			'option'=>'com_content',
			'view'=>'article',
			'id_alias'=>'id'
		);
		return $context;
	}

	function onContentAfterSave($context, $article, $isNew) {

		$isSppagebuilderEnabled = $this->isSppagebuilderEnabled();

		if ( !$isSppagebuilderEnabled ) return;

		$input = JFactory::getApplication()->input;
		$option = $input->get('option', '', 'STRING');
		$view = 'article';
		$form = $input->post->get('jform', array(), 'ARRAY');
		$sppagebuilder_active = (isset($form['attribs']['sppagebuilder_active']) && $form['attribs']['sppagebuilder_active']) ? $form['attribs']['sppagebuilder_active'] : 0;
		$sppagebuilder_content = (isset($form['attribs']['sppagebuilder_content']) && $form['attribs']['sppagebuilder_content']) ? $form['attribs']['sppagebuilder_content'] : '[]';

		if(!$sppagebuilder_content) return;

		if($context == 'com_content.article') {
			$values = array(
				'title' => $article->title,
				'text' => $sppagebuilder_content,
				'option' => $option,
				'view' => $view,
				'id' => $article->id,
				'active' => $sppagebuilder_active,
				'created_on' => $article->created,
				'created_by' => $article->created_by,
				'modified' => $article->modified,
				'modified_by' => $article->modified_by,
				'language' => '*'
			);

			SppagebuilderHelper::onAfterIntegrationSave($values);
		}
	}

	function onContentPrepare($context, $article, $params, $page) {
		$input  = JFactory::getApplication()->input;
		$option = $input->get('option', '', 'STRING');
		$view   = $input->get('view', '', 'STRING');
		$task   = $input->get('task', '', 'STRING');

    if (!isset($article->id) || !(int) $article->id) {
      return true;
    }

		$isSppagebuilderEnabled = $this->isSppagebuilderEnabled();

		if ( $isSppagebuilderEnabled ) {
			if(($option == 'com_content') && ($view == 'article')) {
				$article->text = SppagebuilderHelper::onIntegrationPrepareContent($article->text, $option, $view, $article->id);
			}

			if(($option == 'com_j2store') && ($view == 'products') && ($task == 'view') && ($context == 'com_content.article.productlist')) {
				$article->text = SppagebuilderHelper::onIntegrationPrepareContent($article->text, 'com_content', 'article', $article->id);
			}
		}
	}

	private function isSppagebuilderEnabled(){
		$db = JFactory::getDbo();
		$db->setQuery("SELECT enabled FROM #__extensions WHERE element = 'com_sppagebuilder' AND type = 'component'");
		return $is_enabled = $db->loadResult();
	}
}
