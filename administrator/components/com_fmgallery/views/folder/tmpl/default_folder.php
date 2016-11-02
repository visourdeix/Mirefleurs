<?php defined('_JEXEC') or die('Restricted access'); ?>

<a class="fm-folder fm-hover-panel fm-hover-panel-horizontal" href="index.php?option=com_fmgallery&view=folder&tmpl=component&folder=<?php echo $this->folder->path; ?>&field=<?php echo $this->field; ?>">
    <i class="fa fa-folder-open fa-4x"></i>
    <div>
        <?php echo $this->folder->name; ?>
    </div>
</a>
<a href="#" onclick="if (window.parent) window.parent.<?php echo $this->fce; ?>('<?php echo $this->folder->path; ?>');" class="btn btn-small btn-primary">
    <i class="fa fa-check"></i>
    <?php echo ' '. JText::_("FMLIB_SELECT"); ?>
</a>