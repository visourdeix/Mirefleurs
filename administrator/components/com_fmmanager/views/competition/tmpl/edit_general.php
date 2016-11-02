<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="row-fluid">
    <div class="span6">
        <legend>
            <?php echo JText::_("FMLIB_LEGEND_INFORMATIONS") ?>
        </legend>
        <?php
        echo $this->form->renderField("default_time");
        echo $this->form->renderField("statistics");
        ?>
        <div id="ranking">
            <legend>
                <?php echo JText::_("COM_FMMANAGER_LEGEND_RANKING") ?>
            </legend>
            <?php
            echo $this->form->renderField("victory_points");
            echo $this->form->renderField("draw_points");
            echo $this->form->renderField("defeat_points");
            echo $this->form->renderField("victory_to_penalties_points");
            echo $this->form->renderField("defeat_to_penalties_points");
            echo $this->form->renderField("ranking_legend");
            echo $this->form->renderField("ranking_sort");
            ?>
        </div>
    </div>
    <div class="span6">
        <legend>
            <?php echo JText::_("COM_FMMANAGER_LEGEND_TEAMS") ?>
        </legend>
        <?php
        echo $this->form->getField("competitionTeams")->input;
        ?>
    </div>
</div>