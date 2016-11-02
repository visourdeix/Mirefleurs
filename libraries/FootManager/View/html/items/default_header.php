<?php $fields = $this->getFields(); ?>

<tr>

    <?php if($this->canOrdering()) : ?>
    <th width="1%" class="nowrap center hidden-phone">
        <?php echo JHtml::_('searchtools.sort', '', 'ordering', $this->order_direction, $this->order_field, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
    </th>
    <?php endif; ?>

    <th width="1%">
        <?php echo \JHtml::_('grid.checkall'); ?>
    </th>

    <?php foreach($fields as $key => $field) :
              $class = isset($field["class"]) ? $field["class"] : "";
              $width = isset($field["width"]) ? $field["width"] : "";
              $sort = isset($field["sort"]) ? $field["sort"] : $key;
              $header = isset($field["header"]) ? $field["header"] : strtoupper($this->component).'_FIELD_'.strtoupper($key);
    ?>

    <th <?php echo $width ? 'width="'.$width.'"' : ''; ?> class="<?php echo $class ?>">
        <?php if(isset($field["sortable"]) && $field["sortable"]) : ?>
        <?php echo  \JHtml::_('searchtools.sort', $header, $sort, $this->order_direction, $this->order_field); ?>
        <?php else : ?>
        <?php echo  \JText::_($header); ?>
        <?php endif; ?>
    </th>

    <?php endforeach; ?>

    <?php if($this->canAdd()) { ?>
    <th width="1%" class="nowrap center hidden-phone">
        <?php echo  \JHtml::_('searchtools.sort', 'FMLIB_FIELD_ID', 'id', $this->order_direction, $this->order_field); ?>
    </th>
    <?php } ?>
</tr>