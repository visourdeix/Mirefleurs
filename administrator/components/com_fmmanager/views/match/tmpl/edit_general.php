<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="row-fluid">
    <?php echo $this->form->renderField("state") ?>
    <div class="span6">
        <legend>
            <?php echo JText::_("COM_FMMANAGER_LEGEND_SCORE") ?>
        </legend>
        <center>
            <button onclick="Joomla.submitbutton('match.applyAndInvertTeams')" class="visible-phone btn btn-primary fm-margin-bottom-15">
                <i class="fa fa-arrows-h"></i>
                <?php echo JText::_("COM_FMMANAGER_INVERT_TEAMS") ?>
            </button>
        </center>
        <table style="width: 100%" class="fm-table-responsive">
            <thead>
                <tr>
                    <th></th>
                    <th>
                        <?php echo utf8_strtoupper($this->item->team1->name) ?>
                    </th>
                    <th>
                        <button onclick="Joomla.submitbutton('match.applyAndInvertTeams')" class="btn btn-primary hasTooltip" title="<?php echo JText::_("COM_FMMANAGER_INVERT_TEAMS") ?>">
                            <i class="fa fa-arrows-h"></i>
                        </button>
                    </th>
                    <th>
                        <?php echo utf8_strtoupper($this->item->team2->name) ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="fm-background-color-light-blue">
                    <td class="fm-padding-5 hasTooltip fm-text-bold" title="<?php echo JText::_("COM_FMMANAGER_FIELD_SCORE_DESC") ?>">
                        <?php echo JText::_("COM_FMMANAGER_FIELD_SCORE") ?>
                    </td>
                    <td class="fm-padding-5 center" data-title="<?php echo $this->item->team1->name ?>">
                        <?php echo $this->form->getField("score1")->input ?>
                    </td>
                    <td class="hidden-phone"></td>
                    <td class="fm-padding-5 center" data-title="<?php echo $this->item->team2->name ?>">
                        <?php echo $this->form->getField("score2")->input ?>
                    </td>
                </tr>

                <tr>
                    <td class="fm-padding-5 hasTooltip" title="<?php echo JText::_("COM_FMMANAGER_FIELD_WITHDRAW_DESC") ?>">
                        <?php echo JText::_("COM_FMMANAGER_FIELD_WITHDRAW") ?>
                    </td>
                    <td class="fm-padding-5 center" data-title="<?php echo $this->item->team1->name ?>">
                        <?php echo $this->form->getField("withdraw1")->input ?>
                    </td>
                    <td class="hidden-phone"></td>
                    <td class="fm-padding-5 center" data-title="<?php echo $this->item->team2->name ?>">
                        <?php echo $this->form->getField("withdraw2")->input ?>
                    </td>
                </tr>

                <?php if($this->item->matchday->competition->tournament->extra_time) : ?>
                <tr>
                    <td class="fm-padding-5 hasTooltip" title="<?php echo JText::_("COM_FMMANAGER_FIELD_EXTRA_TIME_DESC") ?>">
                        <?php echo JText::_("COM_FMMANAGER_FIELD_EXTRA_TIME") ?>
                    </td>
                    <td colspan="3" class="fm-padding-5 center">
                        <?php echo $this->form->getField("extra_time")->input ?>
                    </td>
                </tr>
                <?php endif; ?>

                <?php if($this->item->matchday->competition->tournament->penalties) : ?>
                <tr>
                    <td class="fm-padding-5 hasTooltip" title="<?php echo JText::_("COM_FMMANAGER_FIELD_PENALTIES_DESC") ?>">
                        <?php echo JText::_("COM_FMMANAGER_FIELD_PENALTIES") ?>
                    </td>
                    <td class="fm-padding-5 center" data-title="<?php echo $this->item->team1->name ?>">
                        <?php echo $this->form->getField("penalties1")->input ?>
                    </td>
                    <td class="hidden-phone"></td>
                    <td class="fm-padding-5 center" data-title="<?php echo $this->item->team2->name ?>">
                        <?php echo $this->form->getField("penalties2")->input ?>
                    </td>
                </tr>
                <?php endif; ?>

                <?php if($this->item->matchday->competition->tournament->type->has_ranking) : ?>
                <tr>
                    <td class="fm-padding-5 hasTooltip" title="<?php echo JText::_("COM_FMMANAGER_FIELD_BONUS_DESC") ?>">
                        <?php echo JText::_("COM_FMMANAGER_FIELD_BONUS") ?>
                    </td>
                    <td class="fm-padding-5 center" data-title="<?php echo $this->item->team1->name ?>">
                        <?php echo $this->form->getField("bonus1")->input ?>
                    </td>
                    <td class="hidden-phone"></td>
                    <td class="fm-padding-5 center" data-title="<?php echo $this->item->team2->name ?>">
                        <?php echo $this->form->getField("bonus2")->input ?>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="span6">
        <legend>
            <?php echo JText::_("FMLIB_LEGEND_INFORMATIONS") ?>
        </legend>
        <?php echo $this->form->renderField("date") ?>
        <?php echo $this->form->renderField("time") ?>
        <?php echo $this->form->renderField("stadium_id") ?>
        <?php echo $this->form->renderField("neutral_stadium") ?>
        <?php echo $this->form->renderField("referee") ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <legend>
            <?php echo JText::_("COM_FMMANAGER_LEGEND_SUMMARY") ?>
        </legend>
        <?php
        echo $this->form->getField("summary")->input;
        ?>
    </div>
</div>