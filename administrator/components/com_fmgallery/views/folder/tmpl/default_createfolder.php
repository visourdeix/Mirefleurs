<?php defined('_JEXEC') or die('Restricted access');

      $currentFolder = '';
      if (isset($this->state->folder) && $this->state->folder != '') {
          $currentFolder = $this->state->folder;
      }

      $uri = JFactory::getURI();
      $pageURL = $uri->toString();
      $return_page = base64_encode($pageURL);

?>

<legend><?php echo JText::_('COM_FMGALLERY_CREATE_FOLDER') ?></legend>
<form action="index.php?option=com_fmgallery&task=folders.createfolder" name="folderForm" id="folderForm" method="post" class="form-horizontal">

    <input class="inputbox" type="text" name="foldername" />
    <input type="hidden" name="folderbase" value="<?php echo $currentFolder ?>" />
    <input type="hidden" name="return_page" value="<?php echo $return_page ?>" />
    <button class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i><?php echo ' '.JText::_( 'FMLIB_CREATE' ) ?></button>
    <?php echo JHTML::_( 'form.token' ) ?>
</form>