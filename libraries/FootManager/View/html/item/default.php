<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$item = $this->item;
$plugins = $this->plugins;
$params = $this->params;
$state = $this->state;

?>

<div id="fm" class="container-fluid">

    <?php
    // Params
    echo \FootManager\UI\Html\Form::hidden(array("id" => "fm-id", "value" => $this->state->get($this->getName().'.id')));
    echo \FootManager\UI\Html\Form::hidden(array("id" => "fm-view", "value" => $this->getName()));
    echo \FootManager\UI\Html\Form::hidden(array("id" => "fm-component", "value" => $this->component));
    ?>
    <input type="hidden" id="fm-params" value='<?php echo base64_encode($this->params->toString()) ?>' />

    <?php
    if($this->getLayout() == 'default') {
		if($this->params && $this->params->get('show_page_heading', 1)) {
			$this->displayHeader();
            echo $plugins->afterDisplayTitle;
        }
    }

    if($plugins->beforeDisplayContent)
        echo '<div class="fm-before-display-content">'.$plugins->beforeDisplayContent.'</div>';
    $this->displayBody();
    if($plugins->afterDisplayContent)
        echo '<div class="fm-after-display-content">'.$plugins->afterDisplayContent.'</div>';
    ?>
</div>