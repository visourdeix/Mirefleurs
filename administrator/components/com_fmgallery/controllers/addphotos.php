<?php
/**
 * @package      Fmmanager
 * @subpackage   Positions
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

jimport('joomla.application.component.controllerform');

/**
 * Positions list controller class.
 *
 */
class FmgalleryControllerAddPhotos extends JControllerLegacy
{

    /**
     * The context for storing internal data, e.g. record.
     *
     * @var    string
     * @since  12.2
     */
	protected $context;

	/**
     * The URL option for the component.
     *
     * @var    string
     * @since  12.2
     */
	protected $option;

    /**
     * The URL view list variable.
     *
     * @var    string
     * @since  12.2
     */
	protected $view_list;

    /**
     * The URL view list variable.
     *
     * @var    string
     * @since  12.2
     */
	protected $view_item;

    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     JControllerLegacy
     * @since   12.2
     * @throws  Exception
     */
	public function __construct($config = array())
	{
		parent::__construct($config);

		// Guess the option as com_NameOfController
		if (empty($this->option))
		{
			$this->option = 'com_' . strtolower($this->getName());
		}

		// Guess the context as the suffix, eg: OptionControllerContent.
		if (empty($this->context))
		{
			$r = null;

			if (!preg_match('/(.*)Controller(.*)/i', get_class($this), $r))
			{
				throw new Exception(JText::_('JLIB_APPLICATION_ERROR_CONTROLLER_GET_NAME'), 500);
			}

			$this->context = strtolower($r[2]);
		}

        $this->view_list = "photos";
        $this->view_item = "addphotos";

		// Apply, Save & New, and Save As copy should be standard on forms.
		$this->registerTask('apply', 'save');
		$this->registerTask('save2new', 'save');
	}

    /**
     * Method to cancel an edit.
     *
     * @param   string  $key  The name of the primary key of the URL variable.
     *
     * @return  boolean  True if access level checks pass, false otherwise.
     *
     * @since   12.2
     */
	public function cancel($key = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$this->setRedirect(
			JRoute::_(
				'index.php?option=' . $this->option . '&view=' . $this->view_list
				. $this->getRedirectToListAppend(), false
			)
		);

		return true;
	}

    /**
     * Gets the URL arguments to append to a list redirect.
     *
     * @return  string  The arguments to append to the redirect URL.
     *
     * @since   12.2
     */
	protected function getRedirectToListAppend()
	{
		$tmpl = JFactory::getApplication()->input->get('tmpl');
		$append = '';

		// Setup redirect info.
		if ($tmpl)
		{
			$append .= '&tmpl=' . $tmpl;
		}

		return $append;
	}

    /**
     * Method to save a record.
     *
     * @param   string  $key     The name of the primary key of the URL variable.
     * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return  boolean  True if successful, false otherwise.
     *
     * @since   12.2
     */
	public function save($key = null, $urlVar = null)
	{

        // Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$app   = JFactory::getApplication();
		$model = $this->getModel('AddPhotos', 'FmgalleryModel', array());
		$data  = $this->input->post->get('jform', array(), 'array');
		$context = "$this->option.edit.$this->context";
		$task = $this->getTask();

		// Validate the posted data.
		// Sometimes the form needs some posted data, such as for plugins and modules.
        $form = $model->getForm($data, false);

        if (!$form)
        {
            $app->enqueueMessage($model->getError(), 'error');

            return false;
        }

        // Test whether the data is valid.
        $validData = $model->validate($form, $data);

        // Check for validation errors.
        if ($validData === false)
        {

            // Get the validation messages.
            $errors = $model->getErrors();

            // Push up to three validation messages out to the user.
            for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
            {
                if ($errors[$i] instanceof Exception)
                {
                    $app->enqueueMessage($errors[$i]->getMessage(), 'warning');
                }
                else
                {
                    $app->enqueueMessage($errors[$i], 'warning');
                }
            }

            // Redirect back to the edit screen.
            $this->setRedirect(
                JRoute::_(
                    'index.php?option=' . $this->option . '&view=' . $this->view_item, false
                )
            );

            return false;
        }

        // Attempt to save the data.
        if (!$model->save($validData))
        {
            // Save the data in the session.
            $app->setUserState($context . '.data', $validData);

            // Redirect back to the edit screen.
            $this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
            $this->setMessage($this->getError(), 'error');

            // Redirect back to the edit screen.
            $this->setRedirect(
                JRoute::_(
                    'index.php?option=' . $this->option . '&view=' . $this->view_item, false
                )
            );

            return false;
        }

        // Redirect the user and adjust session state based on the chosen task.
		switch ($task)
		{

			case 'save2new':
				// Clear the record id and data from the session.
				$app->setUserState($context . '.data', $data);

				// Redirect back to the edit screen.
				$this->setRedirect(
					JRoute::_(
						'index.php?option=' . $this->option . '&view=' . $this->view_item, false
					)
				);
				break;

			default:
				// Clear the record id and data from the session.
				$app->setUserState($context . '.data', $data);

				// Redirect to the list screen.
				$this->setRedirect(
					JRoute::_(
						'index.php?option=' . $this->option . '&view=' . $this->view_list
						. $this->getRedirectToListAppend(), false
					)
				);
				break;
		}

        $this->setMessage(JText::_("COM_FMGALLERY_MESSAGE_PHOTOS_SAVED"));

		return true;
	}

    /**
     * Method to save a record.
     *
     * @param   string  $key     The name of the primary key of the URL variable.
     * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return  boolean  True if successful, false otherwise.
     *
     * @since   12.2
     */
	public function upload()
	{

        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        jimport("FMGallery.library");

        $app = JFactory::getApplication();

        $targetDir = $app->getCfg('tmp_path'). DIRECTORY_SEPARATOR . "plupload/";

        // Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

        // Remove old temp files
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }

        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off
            rename("{$filePath}.part", $filePath);
        }

        $model = $this->getModel('Addphotos', 'FmgalleryModel', array());

        // 1 - Get Category
        $category = $model->getCategory($_REQUEST["category"]);

        if(!empty($category)) {

            // 1 - Create Folders
            \FMGallery\Utilities\FileHelper::createThumbnailsFolders($category->folder);

            // 2 - Rename and Move file in folder
            $newfile = \FMGallery\Utilities\FileHelper::moveInCategoryFolder($filePath, $category);

            // 3 - Create thumbnail
            $thumbs = \FMGallery\Utilities\FileHelper::createThumbnails($newfile);

            // 5 - Save in database
            $data["catid"] = $category->id;
            $data["file"] = str_replace(JPATH_ROOT.DS, "", $newfile);
            $data["title"] = JArrayHelper::getValue($_REQUEST, "title", "");
            $data["state"] = JArrayHelper::getValue($_REQUEST, "state", 1);
            $data["date"] = JArrayHelper::getValue($_REQUEST, "date", "");
            $data["tags"] = JArrayHelper::getValue($_REQUEST, "tags", array());

            foreach ($thumbs as $size => $file)
                $data["thumb_".$size] = str_replace(JPATH_ROOT.DS, "", $file);

            $model = $this->getModel('Photo', 'FmgalleryModel', array());
            if(!$model->save($data))
                die($model->getError());

            // Return Success JSON-RPC response
            //die("{'jsonrpc' : '2.0', 'result' : '".$filePath."', 'id' : 'id'}");
            die($filePath);
        } else {
            die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Category is not defined."}, "id" : "id"}');
        }
	}

}