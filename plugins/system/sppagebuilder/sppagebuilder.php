<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2016 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted access');

require_once JPATH_ADMINISTRATOR . '/components/com_sppagebuilder/helpers/integrations.php';

class  plgSystemSppagebuilder extends JPlugin {

  protected $autoloadLanguage = true;
  protected $pagebuilder_content = '[]';
  protected $pagebuilder_active = 0;

  function onBeforeRender() {
    $app = JFactory::getApplication();

    if($app->isAdmin()) {
      $integrations = $this->getIntegrations();
      if(!$integrations) return;

      $input = $app->input;
      $option = $input->get('option', '', 'STRING');
      $view = $input->get('view', '', 'STRING');
      $layout = $input->get('layout', '', 'STRING');
      $context = $option . '.' . $view;

      if(!array_key_exists($context, $integrations)) return;
      $integration = $integrations[$context];

      // Get ID
      $id = $input->get($integration['id_alias'], 0, 'INT');

      require_once JPATH_ROOT .'/administrator/components/com_sppagebuilder/builder/classes/base.php';
      require_once JPATH_ROOT .'/administrator/components/com_sppagebuilder/builder/classes/config.php';

      $this->loadPageBuilderLanguage();

      JHtml::_('jquery.ui', array('core', 'sortable'));
      $doc = JFactory::getDocument();
      $doc->addStylesheet( JURI::base(true) . '/components/com_sppagebuilder/assets/css/font-awesome.min.css' );
      $doc->addStylesheet( JURI::base(true) . '/components/com_sppagebuilder/assets/css/pbfont.css' );
      $doc->addStylesheet( JURI::base(true) . '/components/com_sppagebuilder/assets/css/react-select.css' );
      $doc->addStylesheet( JURI::base(true) . '/components/com_sppagebuilder/assets/css/sppagebuilder.css' );
      $doc->addScript( JURI::root(true) . '/plugins/system/sppagebuilder/assets/js/init.js' );
      if (JFactory::getConfig()->get('editor') === 'tinymce') {
        $doc->addScript( JURI::root(true) . '/media/editors/tinymce/tinymce.min.js' );
      }
      $doc->addScript( JURI::base(true) . '/components/com_sppagebuilder/assets/js/script.js' );
      $doc->addScriptdeclaration('var pagebuilder_base="' . JURI::root() . '";');


      // Addon List Initialize
      SpPgaeBuilderBase::loadAddons();
      $fa_icon_list     = SpPgaeBuilderBase::getIconList(); // Icon List
      $animateNames     = SpPgaeBuilderBase::getAnimationsList(); // Animation Names
      $accessLevels     = SpPgaeBuilderBase::getAccessLevelList(); // Access Levels
      $article_cats     = SpPgaeBuilderBase::getArticleCategories(); // Article Categories
      $moduleAttr       = SpPgaeBuilderBase::getModuleAttributes(); // Module Postions and Module Lits
      $rowSettings      = SpPgaeBuilderBase::getRowGlobalSettings(); // Row Settings Attributes
      $columnSettings   = SpPgaeBuilderBase::getColumnGlobalSettings(); // Column Settings Attributes
      $global_attributes = SpPgaeBuilderBase::addonOptions();

      // Addon List
      $addons_list    = SpAddonsConfig::$addons;
      $globalDefault = SpPgaeBuilderBase::getSettingsDefaultValue($global_attributes);

      JPluginHelper::importPlugin( 'system' );
	    $dispatcher = JEventDispatcher::getInstance();

      foreach ( $addons_list as $key => &$addon ) {
        $new_default_value = SpPgaeBuilderBase::getSettingsDefaultValue($addon['attr']);
        $addon['default'] = array_merge($new_default_value['default'], $globalDefault['default']);
        $results = $dispatcher->trigger( 'onBeforeAddonConfigure', array($key, &$addon) );
      }

      $row_default_value = SpPgaeBuilderBase::getSettingsDefaultValue($rowSettings['attr']);
      $rowSettings['default'] = $row_default_value;

      $column_default_value = SpPgaeBuilderBase::getSettingsDefaultValue($columnSettings['attr']);
      $columnSettings['default'] = $column_default_value;

      $doc->addScriptdeclaration('var addonsJSON=' . json_encode($addons_list) . ';');

      // Addon Categories
      $addon_cats = SpPgaeBuilderBase::getAddonCategories($addons_list);
      $doc->addScriptdeclaration('var addonCats=' . json_encode($addon_cats) . ';');

      // Global Attributes
      $doc->addScriptdeclaration('var globalAttr=' . json_encode( $global_attributes ) . ';');
      $doc->addScriptdeclaration('var faIconList=' . json_encode( $fa_icon_list ) . ';');
      $doc->addScriptdeclaration('var animateNames=' . json_encode( $animateNames ) . ';');
      $doc->addScriptdeclaration('var accessLevels=' . json_encode( $accessLevels ) . ';');
      $doc->addScriptdeclaration('var articleCats=' . json_encode( $article_cats ) . ';');
      $doc->addScriptdeclaration('var moduleAttr=' . json_encode( $moduleAttr ) . ';');
      $doc->addScriptdeclaration('var rowSettings=' . json_encode( $rowSettings ) . ';');
      $doc->addScriptdeclaration('var colSettings=' . json_encode( $columnSettings ) . ';');
      $doc->addScriptdeclaration('var sppbMediaPath=\'/images\';');

      // Retrive content
      $pagebuilder_enbaled = 0;
      $initialState = '[]';

      if($page_content = $this->getPageContent($option, $view, $id)) {
        $pagebuilder_enbaled = $page_content->active;

        if(($page_content->text != '') && ($page_content->text != '[]')) {
          $initialState = $page_content->text;
          $this->pagebuilder_content = $page_content->text;
        }
        $this->pagebuilder_active = $pagebuilder_enbaled;
      }

      $integration_element = '.adminform';

      if($option == 'com_content') {
        $integration_element = '.adminform';
      } else if($option == 'com_k2') {
        $integration_element = '.k2ItemFormEditor';
      }

      $doc->addScriptdeclaration('var spIntergationElement="'. $integration_element .'";');
      $doc->addScriptdeclaration('var spPagebuilderEnabled='. $pagebuilder_enbaled .';');
      $doc->addScriptdeclaration('var initialState='. $initialState .';');
    } else {
      $input  = $app->input;
      $option = $input->get('option', '', 'STRING');
      $view   = $input->get('view', '', 'STRING');
      $task   = $input->get('task', '', 'STRING');
      $id     = $input->get('id', 0, 'INT');
      $pageName = '';

      if($option == 'com_content' && $view == 'article'){
        $pageName = "{$view}-{$id}.css";
      } elseif( $option == 'com_j2store' && $view == 'products' && $task == 'view' ){
        $pageName = "article-{$id}.css";
      } elseif( $option == 'com_k2' && $view == 'item'){
        $pageName = "item-{$id}.css";
      }elseif ($option == 'com_sppagebuilder' && $view == 'page') {
        $pageName = "{$view}-{$id}.css";
      }

      $file_path  = JPATH_ROOT . '/media/sppagebuilder/css/'.$pageName;
      $file_url   = JUri::base(true) . '/media/sppagebuilder/css/'.$pageName;
      if(file_exists($file_path)){
        $doc = JFactory::getDocument();
        $doc->addStyleSheet($file_url);
      }
    }
  }


  function onAfterRender() {
    $app = JFactory::getApplication();

    if($app->isAdmin()) {
      $integrations = $this->getIntegrations();
      if(!$integrations) return;

      $input = $app->input;
      $option = $input->get('option', '', 'STRING');
      $view = $input->get('view', '', 'STRING');
      $layout = $input->get('layout', '', 'STRING');
      $context = $option . '.' . $view;

      if(!array_key_exists($context, $integrations)) return;

      // Add script
      $body = JResponse::getBody();
      if($option == 'com_k2') {
        $body = str_replace('<div class="k2ItemFormEditor">', '<div class="sp-pagebuilder-btn-group sp-pagebuilder-btns-alt"><a href="#" class="sp-pagebuilder-btn sp-pagebuilder-btn-default sp-pagebuilder-btn-switcher btn-action-editor" data-action="editor">Joomla Editor</a><a data-action="sppagebuilder" href="#" class="sp-pagebuilder-btn sp-pagebuilder-btn-default sp-pagebuilder-btn-switcher btn-action-sppagebuilder">SP Page Builder</a></div><div class="sp-pagebuilder-admin pagebuilder-'. str_replace('_', '-', $option) .'" style="display: none;"><div id="sp-pagebuilder-page-tools" class="clearfix sp-pagebuilder-page-tools"></div><div class="sp-pagebuilder-sidebar-and-builder"><div id="sp-pagebuilder-section-lib" class="clearfix sp-pagebuilder-section-lib"></div><div id="container"></div></div></div><div class="k2ItemFormEditor">', $body);
      } else {
        $body = str_replace('<fieldset class="adminform">', '<div class="sp-pagebuilder-btn-group sp-pagebuilder-btns-alt"><a href="#" class="sp-pagebuilder-btn sp-pagebuilder-btn-default sp-pagebuilder-btn-switcher btn-action-editor" data-action="editor">Joomla Editor</a><a data-action="sppagebuilder" href="#" class="sp-pagebuilder-btn sp-pagebuilder-btn-default sp-pagebuilder-btn-switcher btn-action-sppagebuilder">SP Page Builder</a></div><div class="sp-pagebuilder-admin pagebuilder-'. str_replace('_', '-', $option) .'" style="display: none;"><div id="sp-pagebuilder-page-tools" class="clearfix sp-pagebuilder-page-tools"></div><div class="sp-pagebuilder-sidebar-and-builder"><div id="sp-pagebuilder-section-lib" class="clearfix sp-pagebuilder-section-lib"></div><div id="container"></div></div></div><fieldset class="adminform">', $body);
      }

      // Page Builder fields
      $body = str_replace('</form>', '<input type="hidden" id="jform_attribs_sppagebuilder_content" name="jform[attribs][sppagebuilder_content]"></form>'. "\n", $body);
      $body = str_replace('</form>', '<input type="hidden" id="jform_attribs_sppagebuilder_active" name="jform[attribs][sppagebuilder_active]" value="'. $this->pagebuilder_active .'"></form>'. "\n", $body);

      //Add script
      $body = str_replace('</body>', '<script type="text/javascript" src="' . JURI::base(true) . '/components/com_sppagebuilder/assets/js/engine.js"></script>' ."\n</body>", $body);
      JResponse::setBody($body);

    }
  }

  private function loadPageBuilderLanguage() {
    $lang = JFactory::getLanguage();
    $lang->load('com_sppagebuilder', JPATH_ADMINISTRATOR, $lang->getName(), true);
    $lang->load('tpl_' . $this->getTemplate(), JPATH_SITE, $lang->getName(), true);
    require_once JPATH_ROOT .'/administrator/components/com_sppagebuilder/helpers/language.php';
  }

  private function getPageContent($extension = 'com_content', $extension_view = 'article', $view_id = 0) {
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select($db->quoteName(array('text', 'active')));
    $query->from($db->quoteName('#__sppagebuilder'));
    $query->where($db->quoteName('extension') . ' = '. $db->quote($extension));
    $query->where($db->quoteName('extension_view') . ' = '. $db->quote($extension_view));
    $query->where($db->quoteName('view_id') . ' = '. $view_id);
    $db->setQuery($query);
    $result = $db->loadObject();

    if($result) {
      return $result;
    }

    return false;
  }

  private function getIntegrations() {
    $app = JFactory::getApplication();
    $option = $app->input->get('option', '', "STRING");
    $integrations_list = SppagebuilderHelperIntegrations::integrations();

    if(!in_array($option, $integrations_list)) {
      return false;
    }

    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $user = JFactory::getUser();
    $query->select('a.id, a.component, a.plugin, a.state');
    $query->from('#__sppagebuilder_integrations as a');
    $query->where($db->quoteName('state') . ' = 1');
    $db->setQuery($query);
    $results = $db->loadObjectList();

    $contexts = array();

    foreach ($results as $key => $result) {
      $plugin = json_decode($result->plugin);
      $path = JPATH_PLUGINS . '/' . $plugin->group . '/' . $plugin->name . '/' . $plugin->name . '.php';

      if(file_exists($path)) {
        if(JPluginHelper::isEnabled($plugin->group, $plugin->name)) {
          require_once($path);
          $className = 'Plg' . ucfirst($plugin->group) . ucfirst($plugin->name);
          if(method_exists($className, '__context')) {
            $context = $className::__context();
            $contexts[$context['option'] . '.' . $context['view']] = $className::__context();
          }
        }
      }
    }

    if(count($contexts)) return $contexts;

    return false;
  }

  private function getTemplate() {
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select($db->quoteName(array('template')));
    $query->from($db->quoteName('#__template_styles'));
    $query->where($db->quoteName('client_id') . ' = '. $db->quote(0));
    $query->where($db->quoteName('home') . ' = '. $db->quote(1));
    $db->setQuery($query);
    return $db->loadResult();
  }

  public function onExtensionAfterSave($option, $data) {
    if ( ($option == 'com_config.component') && ( $data->element == 'com_sppagebuilder' ) ) {
      jimport('joomla.filesystem.folder');
      $admin_cache = JPATH_ROOT . '/administrator/cache/sppagebuilder';
      if(JFolder::exists($admin_cache)) {
        JFolder::delete($admin_cache);
      }

      $site_cache = JPATH_ROOT . '/cache/sppagebuilder';
      if(JFolder::exists($site_cache)) {
        JFolder::delete($site_cache);
      }
    }
  }
}
