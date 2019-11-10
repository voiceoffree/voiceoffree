<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderHelperSite {

	public static function loadLanguage() {
        $lang = JFactory::getLanguage();

		$app = JFactory::getApplication();
		$template = $app->getTemplate();
		
		$com_option = $app->input->get('option','','STR');
		$com_view = $app->input->get('view','','STR');
		$com_id = $app->input->get('id',0,'INT');

		if( $com_option == 'com_sppagebuilder' && $com_view == 'form' && $com_id ){
			$lang->load('com_sppagebuilder', JPATH_ADMINISTRATOR, null, true);
		}

        // Load template language file
        $lang->load('tpl_' . $template, JPATH_SITE, null, true);

        require_once JPATH_ROOT .'/administrator/components/com_sppagebuilder/helpers/language.php';
    }

	public static function getPaddingMargin($main_value, $type){
		$css = '';
		$pos = array( 'top', 'right', 'bottom', 'left' );
		if(is_string($main_value) && trim($main_value) != "") {
				$values = explode(' ',  $main_value);
				foreach($values as $key => $value){
						if(trim($value) != ""){
								$css .= $type.'-'.$pos[$key].': '.$value.';';
						}
				}
		}

		return $css;
	}

	public static function getSvgShapes()
	{
		$shape_path = JPATH_ROOT .'/components/com_sppagebuilder/assets/shapes';
		$shapes = JFolder::files( $shape_path, '.svg' );

		$shapeArray = array();

		if(count((array) $shapes)){
			foreach($shapes as $shape){
				$shapeArray[str_replace('.svg', '', $shape)] = base64_encode(file_get_contents($shape_path.'/'.$shape));
			}
		}

		return $shapeArray;
	}

	public static function getSvgShapeCode($shapeName, $invert){
		if($invert){
			$shape_path = JPATH_ROOT .'/components/com_sppagebuilder/assets/shapes/'.$shapeName.'-invert.svg';
		} else {
			$shape_path = JPATH_ROOT .'/components/com_sppagebuilder/assets/shapes/'.$shapeName.'.svg';
		}

		$shapeCode = '';

		if(file_exists($shape_path)){
			$shapeCode = file_get_contents($shape_path);
		}

		return $shapeCode;
	}
}
