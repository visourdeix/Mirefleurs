<?php
/**
* @version:	2.6.1.a2a4257 - 2014 September 15 10:13:22 +0300
* @package:	jbetolo
* @subpackage:	jbetolo
* @copyright:	Copyright (C) 2010 - 2014 jproven.com. All rights reserved. 
* @license:	GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
*/
 
// no direct access
defined('_JEXEC') or die('Restricted access');

$task = JRequest::getCmd('task');

require_once dirname(__FILE__).'/helpers/helper.php';

$lang = JFactory::getLanguage();
$lang->load('plg_system_jbetolo');

$app = JFactory::getApplication();

switch ($task) {
        case 'logclientsideerror':
                jbetoloComponentHelper::logClientsideError();
                $app->close();
                break;
        case 'serve':
                $file = JRequest::getString('file', false);
                $type = JRequest::getString('type', false);

                if ($file && $type) {
                        jbetoloComponentHelper::sendFile($type, $file);
                } else {
                        $file = JRequest::getString('cfile', false);
                        
                        if (!$file) die('Restricted access');

                        jbetoloComponentHelper::sendFile('htaccess', $file);
                }

                break;
        case 'clearcache':
                echo jbetoloComponentHelper::resetCache();
                $app->close();
                break;
        case 'resetsetting':
                echo jbetoloComponentHelper::resetSetting();
                $app->close();
                break;
        case 'savesetting':
                echo jbetoloComponentHelper::saveSetting();
                $app->close();
                break;
        case 'smushit':
                echo jbetoloComponentHelper::smushIt();
                $app->close();
                break;
        case 'ping':
                echo jbetoloComponentHelper::ping();
                $app->close();
                break;
        case 'htaccess':
                echo jbetoloComponentHelper::htaccess();
                $app->close();
                break;
        case 'cdnpurge':
                echo jbetoloComponentHelper::cdnPurge();
                $app->close();
                break;
        default:
                jbetoloComponentHelper::redirectToPlg('jbetolo', 'system');
                break;
}

?>