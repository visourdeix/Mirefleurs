<?php

$fields = $this->getFields();
$function = \JFactory::getApplication()->input->getCmd('function', 'fmSelectItems');

foreach ($this->items as $i => $item) :

    $editLink = \JRoute::_('index.php?option='.$this->component.'&task='.$this->getEditView().'.edit&id='.(int) $item->id);
?>
<tr class="row<?php echo $i % 2; ?> <?php echo $this->getClassRow($item, $i); ?>">

    <?php if($this->canOrdering()) : ?>
    <td class="order nowrap center hidden-phone">
        <?php
              $iconClass = '';
              if ($this->order_field != "ordering")
              {
                  $iconClass = ' inactive tip-top hasTooltip" title="' . \JHtml::tooltipText('JORDERINGDISABLED');
              }
        ?>
        <span class="sortable-handler<?php echo $iconClass ?>">
            <i class="icon-menu"></i>
        </span>
        <?php if ($this->order_field == "ordering") : ?>
        <input type="text" style="display:none" name="order[]" size="5"
            value="<?php echo $item->ordering; ?>" class="width-20 text-area-order " />
        <?php endif; ?>
    </td>
    <?php endif; ?>

    <td class="center">
        <?php echo JHtml::_('grid.id', $i, $item->id); ?>
    </td>

    <?php foreach($fields as $key => $field) :
              $class = isset($field["class"]) ? $field["class"] : "";
              $width = isset($field["width"]) ? $field["width"] : "";
    ?>

    <td <?php echo $width ? 'width="'.$width.'"' : ''; ?> class="<?php echo $class ?>">
        <?php if(isset($field["linkable"]) && $field["linkable"]) : ?>

        <?php if($this->getLayout() == 'modal') : ?>

        <!-- Modal -->
        <a href="#" class="pointer" onclick="if (window.parent) window.parent.<?php echo $function;?>('<?php echo $item->id; ?>');">
            <?php echo $this->formatValue($key, $item, $i); ?>
        </a>

        <?php else : ?>

        <?php if($this->canEdit($item->id, $i)) : ?>

        <!-- Link -->
        <a href="<?php echo $editLink; ?>">
            <?php echo $this->formatValue($key, $item, $i); ?>
        </a>

        <?php else : ?>

        <!-- Normal -->
        <?php echo $this->formatValue($key, $item, $i); ?>

        <?php endif; ?>

        <?php endif; ?>

        <?php else : ?>

        <!-- Normal -->
        <?php echo $this->formatValue($key, $item, $i); ?>

        <?php endif; ?>
    </td>

    <?php endforeach; ?>

    <?php if($this->canAdd()) { ?>
    <td class="center hidden-phone">
        <?php echo $item->id; ?>
    </td>
    <?php } ?>
</tr>
<?php endforeach; ?>