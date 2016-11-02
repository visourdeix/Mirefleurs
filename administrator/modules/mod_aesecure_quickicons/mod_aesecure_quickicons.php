<?php
/**
 * Module Helper File
 *
 * @package         aeSecure's QuickIcon Administration module
 * @version         1.0
 *
 * @author          Christophe Avonture <christophe@avonture.com>
 * @link            http://www.aesecure.com
 * @copyright       Copyright © 2014-2015 NoNumber All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */


// no direct access
defined('_JEXEC') or die('Restricted access');

if (!defined('_AESECURE_QUICKICON_MODULE')) {

   /** ensure that functions are declared only once */
   define('_AESECURE_QUICKICON_MODULE', 1);
   
   // Get the relative path to the aeSecure module (f.i. /modules/mod_aesecure/)
   //$sPath=str_replace(DIRECTORY_SEPARATOR, '/', str_replace(str_replace('/', DIRECTORY_SEPARATOR,JPATH_ADMINISTRATOR),'',dirname(__FILE__))).'/';

   $lang=JFactory::getLanguage();
   
   
   $lang->load('mod_aesecure_quickicons', JPATH_ADMINISTRATOR, $lang->getTag(), true);
   
   // Check if aeSecure exists on the site
   if (!file_exists($file=JPATH_SITE.'/aesecure/configuration/configuration.json')) {
      $sLink="javascript:alert('".JText::_('MOD_AESECURE_QUICKICONS_MISSING',true)."');";
   } else {
      $info=file_get_contents($file, FILE_USE_INCLUDE_PATH);
      $arr=(array) json_decode($info,true);      
      $sLink='../aesecure/setup.php?'.$arr['key'];
   }  
   
   $sSetupLink='<a href="'.$sLink.'" target="_blank" title="'.JText::_('MOD_AESECURE_QUICKICONS_SETUP').'"><span>'.JText::_('aeSecure').'</span></a>';
   
   // Different layouts based on the published position
   
   switch ($module->position) {
   
      case 'cpanel': 
	     echo '<div class="row-striped"><div class="row-fluid"><div class="span12">'.$sSetupLink.'</div></div></div>';
		 break;
	  case 'icon' : 
	     echo '<div class="sidebar-nav quick-icons"><h2 class="nav-header">aeSecure</h2><ul class="j-links-group nav nav-list">'.
            '<li id="mod_aesecure_quickicons"><a href="'.$sLink.'" target="_blank" title="'.JText::_('MOD_AESECURE_QUICKICONS_SETUP').'">'.
            '<i class="icon-key"></i> <span class="j-links-link">'.JText::_('aeSecure').'</span></a></li></ul></div>';
         break;
      case 'menu': 
	     echo '<ul class="nav"><li>'.$sSetupLink.'</li></ul>';
		 break;
      case 'status': 
	     echo '<div class="btn-group aesecure"><i class="icon-key"></i>&nbsp;'.$sSetupLink.'&nbsp;&nbsp;</div>';
		 break;
      case 'title': 
	     echo '<h5 class="page-title"><span class="icon-key cpanel"></span>&nbsp;'.$sSetupLink.'</h5>';
		 break;
	  default: 
	     echo $sSetupLink;
   }
	  
}