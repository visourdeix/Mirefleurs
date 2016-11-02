<?php
/**
* @version:	2.6.1.a2a4257 - 2014 September 15 10:13:22 +0300
* @package:	jbetolo
* @subpackage:	jbetolo
* @copyright:	Copyright (C) 2010 - 2014 jproven.com. All rights reserved. 
* @license:	GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

if (jbetoloHelper::isJ16()) {
        class JFormFieldCDNJS extends JFormFieldList {
                public $type = 'CDNJS';
                
                protected function getOptions() {
                        $options = array();
                        
                        require_once dirname(__FILE__) . '/../assets/cdnjs.php';
                        

                        foreach ($cdnjs as $key => $option)
                        {

                                // Create a new option object based on the <option /> element.
                                $tmp = JHtml::_(
                                        'select.option', $option,
                                        JText::alt(trim($key), preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname)), 'value', 'text',
                                        false
                                );

                                // Add the option object to the result set.
                                $options[] = $tmp;
                        }

                        reset($options);
                        
                        return $options;
                }
        }
} else {
        class JElementCDNJS extends JElement {
                public function fetchElement($name, $value, &$node, $control_name) {
                        return 'CDNJS';
                }
        }
}

?>
