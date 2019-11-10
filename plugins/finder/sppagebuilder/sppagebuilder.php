<?php
/**
 * @package     SP Page Builder Plugins
 * @subpackage  Finder.Sppagebuilder
 *
 * @copyright   Copyright (C) 2018 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

JLoader::register('FinderIndexerAdapter', JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/adapter.php');

class PlgFinderSppagebuilder extends FinderIndexerAdapter
{
	/**
	 * The plugin identifier.
	 */
	protected $context = 'Sppagebuilder';

	/**
	 * The extension name.
	 */
	protected $extension = 'com_sppagebuilder';

	/**
	 * The sublayout to use when rendering the results.
	 */
	protected $layout = 'page';

	/**
	 * The type of content that the adapter indexes.
	 */
	protected $type_title = 'Page';

	/**
	 * The table name.
	 */
	protected $table = '#__sppagebuilder';

	/**
	 * The field the published state is stored in.
	 */
	protected $state_field = 'published';

	/**
	 * Load the language file on instantiation.
	 */
	protected $autoloadLanguage = true;

	/**
	 * Method to remove the link information for items that have been deleted.
	 */
	public function onFinderAfterDelete($context, $table)
	{
		if ($context === 'com_sppagebuilder.page')
		{
			$id = $table->id;
		}
		elseif ($context === 'com_finder.index')
		{
			$id = $table->link_id;
		}
		else
		{
			return true;
		}

		// Remove the items.
		return $this->remove($id);
	}

	/**
	 * Method to determine if the access level of an item changed.
	 */
	public function onFinderAfterSave($context, $row, $isNew)
	{
		if ($context === 'com_sppagebuilder.page')
		{
			if (!$isNew && $this->old_access != $row->access)
			{
				$this->itemAccessChange($row);
			}

			$this->reindex($row->id);
		}

		return true;
	}

	/**
	 * Method to reindex the link information for an item that has been saved.
	 * This event is fired before the data is actually saved so we are going
	 * to queue the item to be indexed later.
	 */
	public function onFinderBeforeSave($context, $row, $isNew)
	{
		if ($context === 'com_sppagebuilder.page')
		{
			if (!$isNew)
			{
				$this->checkItemAccess($row);
			}
		}

		return true;
	}

	/**
	 * Method to update the link information for items that have been changed
	 * from outside the edit screen. This is fired when the item is published,
	 * unpublished, archived, or unarchived from the list view.
	 */
	public function onFinderChangeState($context, $pks, $value)
	{
		if ($context === 'com_sppagebuilder.page')
		{
			$this->itemStateChange($pks, $value);
		}

		if ($context === 'com_plugins.plugin' && $value === 0)
		{
			$this->pluginDisable($pks);
		}
	}

	/**
	 * Method to index an item. The item must be a FinderIndexerResult object.
	 */
	protected function index(FinderIndexerResult $item, $format = 'html')
	{
		// Check if the extension is enabled
		if (JComponentHelper::isEnabled($this->extension) === false)
		{
			return;
		}

		$item->setLanguage();
		if($item->view_id){
			$item->url = $this->getUrl($item->view_id, $item->extension, $item->extension_view).'&page=sppb';
			if($item->extension_view == 'article') {
				$item->route = ContentHelperRoute::getArticleRoute($item->view_id, $item->catid, '*');
			} else {
				$item->route = $this->getUrl($item->view_id, $item->extension, $item->extension_view);
			}
		} else {
			$item->url = $this->getUrl($item->id, $this->extension, $this->layout);
			$item->route = self::getPageRoute($item->id, $item->language);
		}

		$item->path = $item->route;

		// Get the menu title if it exists.
		$title = $this->getItemMenuTitle($item->url);

		// Adjust the title if necessary.
		if (!empty($title) && $this->params->get('use_menu_title', true))
		{
			$item->title = $title;
		}
	
		// Handle the page author data.
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'user');

		// Add the type taxonomy data.
		$item->addTaxonomy('Type', 'Page');

		// Add the language taxonomy data.
		$item->addTaxonomy('Language', $item->language);

		// Index the item.
		$this->indexer->index($item);
	}

	/**
	 * Method to setup the indexer to be run.
	 */
	protected function setup()
	{
		JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');

		return true;
	}

	/**
	 * Method to get the SQL query used to retrieve the list of page items.
	 */
	protected function getListQuery($query = null)
	{
		$db = JFactory::getDbo();

		// Check if we can use the supplied SQL query.
		$query = $query instanceof JDatabaseQuery ? $query : $db->getQuery(true)
			->select('a.id, a.view_id, a.title AS title, a.text AS body, a.created_on AS start_date')
			->select('a.created_by, a.modified, a.modified_by, a.language')
			->select('a.access, a.catid, a.extension, a.extension_view, a.published AS state, a.ordering')

			->select('u.name')
			->from('#__sppagebuilder AS a')
			->join('LEFT', '#__users AS u ON u.id = a.created_by');

		return $query;
	}

	/**
	 * Method to get the page URL.
	 */
	public static function getPageRoute($id, $language = 0)
	{
		$link = 'index.php?option=com_sppagebuilder&view=page&id='.$id;

		if ($language && $language !== '*' && JLanguageMultilang::isEnabled())
		{
			$link .= '&lang=' . $language;
		}

		return $link;
	}
}
