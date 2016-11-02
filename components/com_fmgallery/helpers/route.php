<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport("FMGallery.library");

/**
 * Content Component Route Helper.
 *
 * @since  1.5
 */
abstract class FmgalleryHelperRoute
{
	protected static $lookup = array();

    /**
     * Get the category route.
     *
     * @param   integer  $catid     The category ID.
     * @param   integer  $language  The language code.
     *
     * @return  string  The article route.
     *
     * @since   1.5
     */
	public static function video($item)
	{
        $item = ($item instanceof Illuminate\Database\Eloquent\Model) ? $item : FMGallery\Database\Models\Video::find($item);
        $catids = array();

        $id       = (int) $item->catid;
        $category = JCategories::getInstance('Fmgallery')->get($id);

		if ($id > 1 && $category instanceof JCategoryNode)
		{
			$path                = array_reverse($category->getPath());
            foreach ($path as $cat)
            {
            	$catids[] = explode(":", $cat)[0];
            }

		}

        $catids[]                = "1";
        $needles["videos"]   = $catids;
        $needles["category"]   = $catids;

		return self::route("video", $item->id, $needles);
	}

    /**
     * Get the category route.
     *
     * @param   integer  $catid     The category ID.
     * @param   integer  $language  The language code.
     *
     * @return  string  The article route.
     *
     * @since   1.5
     */
	public static function files($id)
	{
		return self::medias($id, "files");
	}

    /**
     * Get the category route.
     *
     * @param   integer  $catid     The category ID.
     * @param   integer  $language  The language code.
     *
     * @return  string  The article route.
     *
     * @since   1.5
     */
	public static function videos($id)
	{
		return self::medias($id, "videos");
	}

    /**
     * Get the category route.
     *
     * @param   integer  $catid     The category ID.
     * @param   integer  $language  The language code.
     *
     * @return  string  The article route.
     *
     * @since   1.5
     */
	public static function photos($id)
	{
		return self::medias($id, "photos");
	}

	/**
     * Get the category route.
     *
     * @param   integer  $catid     The category ID.
     * @param   integer  $language  The language code.
     *
     * @return  string  The article route.
     *
     * @since   1.5
     */
	public static function medias($catid, $view = "photos")
	{
        $catids = array();
		if ($catid instanceof JCategoryNode)
		{
			$id       = $catid->id;
			$category = $catid;
		}
		else
		{
			$id       = (int) $catid;
			$category = JCategories::getInstance('Fmgallery')->get($id);
		}

		if ($id > 1 && $category instanceof JCategoryNode)
		{
			$path                = array_reverse($category->getPath());
            foreach ($path as $cat)
            {
            	$catids[] = explode(":", $cat)[0];
            }
		}

        $catids[]                = "1";
        $needles[$view]   = $catids;

		return self::route($view, $id, $needles);
	}

    /**
     * Route an item.
     * @param string $view
     * @param mixed $item
     * @param array $needles
     * @return string
     */
	public static function route($view, $id, $needles = array())
	{
        $needles               = array_merge(array($view => $id), $needles);
        $link = 'index.php?';
        $params["option"] = FM_GALLERY_COMPONENT;
        $params["view"] = $view;
        if($id) $params["id"] = $id;

        if ($item = FootManager\Helpers\Route::findItem($needles, FM_GALLERY_COMPONENT))
            $params["Itemid"] = $item;

        $link = $link.FootManager\Utilities\UrlHelper::prepareParameters($params);
		return JRoute::_($link);
	}

}