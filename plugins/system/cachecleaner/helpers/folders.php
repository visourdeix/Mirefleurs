<?php
/**
 * @package         Cache Cleaner
 * @version         5.2.0
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2016 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

require_once __DIR__ . '/cache.php';

class PlgSystemCacheCleanerHelperFolders extends PlgSystemCacheCleanerHelperCache
{
	// Empty tmp folder
	public function purge_tmp()
	{
		$this->emptyFolder(JPATH_SITE . '/tmp');
	}

}
