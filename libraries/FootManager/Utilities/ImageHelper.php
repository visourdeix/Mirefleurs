<?php
/**
 * @package      FootManager
 * @subpackage   Utilities
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Utilities;

defined('JPATH_PLATFORM') or die;

/**
 * This is a class that provides functionality for managing images.
 *
 * @package      FootManager\Utilities
 * @subpackage   Images
 */
class ImageHelper
{
    protected static $images = array();
	/**
     * Method to render the layout.
     *
     * @param   string  $layoutFile   Dot separated path to the layout file, relative to base path
     * @param   object  $displayData  Object which properties are used inside the layout file to build displayed output
     * @param   string  $basePath     Base path to use when loading layout files
     * @param   mixed   $options      Optional custom options to load. Registry or array format
     *
     * @return  string
     *
     * @since   3.1
     */
	public static function render($filename, $attribs = array(), $async = true)
	{
        $localName = self::getLocalName($filename);

        if($filename !== '' & \JFile::exists($localName)) {
            if(isset(self::$images[$localName]))
                $cached_filename = self::$images[$localName];
            else {
                $cached_filename = self::cachedImagePath($localName);
                self::$images[$localName] = self::getRemoteName($cached_filename);
            }
            return \FootManager\UI\Html\Html::image($cached_filename, $attribs, $async);
        }
        return "";
	}

    public static function getLocalName($fileName) {
        $url_filename = str_replace(\JUri::root(), JPATH_ROOT, $fileName);
        //$url_filename = str_replace('\\', '/', $url_filename);
        //$url_filename = str_replace('\\/', '/', $url_filename);
        //$url_filename = str_replace('//', '/', $url_filename);

        return $url_filename;
    }

    public static function getRemoteName($fileName) {

        $uri = substr(\JUri::root(), 0, strlen(\JUri::root()) - 1);
        $url_filename = str_replace(JPATH_ROOT, $uri , $fileName);
        $url_filename = str_replace('\\/', '/', $url_filename);
        $url_filename = str_replace('\\', '/', $url_filename);
        //$url_filename = str_replace('//', '/', $url_filename);
        //$url_filename = str_replace(':/', '://', $url_filename);
        return $url_filename;
    }

    public static function cachedImagePath($filename) {
        try
        {
            $imagecache = new \FootManager\Image\Cache();
            $imagecache->cached_image_directory = JPATH_ROOT . '/cache/images';

            $cached_filename = $imagecache->cache($filename);

            return $cached_filename;

        }
        catch (Exception $exception)
        {
            \JLog::add($exception);
            return "";
        }
    }

    public static function createThumbnail($originaleFile, $thumbnailFile, $thumbnailWidth, $thumbnailHeight,$params) {
        if(\JFile::exists($originaleFile)) {

            if(\JFile::exists($thumbnailFile))
                \JFile::delete($thumbnailFile);

            //Don't do thumbnail if the file is smaller (width, height) than the possible thumbnail
            list($width, $height) = getimagesize(\FootManager\Utilities\ImageHelper::getRemoteName($originaleFile));

            if ($width > $thumbnailWidth || $height > $thumbnailHeight) {
                $imageMagic = static::imageMagic($originaleFile, $thumbnailFile, $thumbnailWidth , $thumbnailHeight, $params);
            } else {
                $imageMagic = static::imageMagic($originaleFile, $thumbnailFile, $width , $height, $params);
            }
            return $imageMagic;
        }
        return false;
    }

    /**
     * need GD library (first PHP line WIN: dl("php_gd.dll"); UNIX: dl("gd.so");
     * www.boutell.com/gd/
     * interval.cz/clanky/php-skript-pro-generovani-galerie-obrazku-2/
     * cz.php.net/imagecopyresampled
     * www.linuxsoft.cz/sw_detail.php?id_item=871
     * www.webtip.cz/art/wt_tech_php/liquid_ir.html
     * php.vrana.cz/zmensovani-obrazku.php
     * diskuse.jakpsatweb.cz/
     *
     * @param string $fileIn Vstupni soubor (mel by existovat)
     * @param string $fileOut Vystupni soubor, null ho jenom zobrazi (taky kdyz nema pravo se zapsat :)
     * @param int $width Vysledna sirka (maximalni)
     * @param int $height Vysledna vyska (maximalni)
     * @param bool $crop Orez (true, obrazek bude presne tak velky), jinak jenom Resample (udane maximalni rozmery)
     * @param int $typeOut IMAGETYPE_type vystupniho obrazku
     * @return bool Chyba kdyz vrati false
     */
	public static function imageMagic($fileIn, $fileOut = null, $width = null, $height = null, $params = array()) {
		$watermarkParams['image']	= (isset($params["watermark"]) && \JFile::exists($params["watermark"]) && is_file($params["watermark"])) ? $params["watermark"] : "";
        $watermarkParams['x']	= isset($params["watermark_x"]) ? $params["watermark_x"] : "center";
        $watermarkParams['y']	= isset($params["watermark_y"]) ? $params["watermark_y"] : "middle";
        $crop	= isset($params["crop"]) ? $params["crop"] : true;
        $jpeg_quality	= isset($params["jpeg_quality"]) ? $params["jpeg_quality"] : 85;
        if($jpeg_quality < 0) $jpeg_quality = 0;
        if($jpeg_quality >100) $jpeg_quality = 100;

		// Memory - - - - - - - -
		$memory = 8;
		$memoryLimitChanged = 0;
		$memory = (int)ini_get( 'memory_limit' );
		if ($memory == 0) {
			$memory = 8;
		}

		// - - - - - - - - - - -
        $dst = array();
        $src = array();
        $watermarkImage = null;
        $locationX = 0;
        $locationY = 0;
        $wW = 0;
        $hW = 0;
		if ($fileIn !== '' && \JFile::exists($fileIn)) {
			// array of width, height, IMAGETYPE, "height=x width=x" (string)
	        list($w, $h, $type) = getimagesize($fileIn);
			if ($w > 0 && $h > 0) {// we got the info from GetImageSize
		        // size of the image
		        if ($width == null || $width == 0) { // no width added
		            $width = $w;
		        }
				else if ($height == null || $height == 0) { // no height, adding the same as width
		            $height = $width;
		        }
				if ($height == null || $height == 0) { // no height, no width
		            $height = $h;
		        }
		        // miniaturizing
		        if (!$crop) { // new size - nw, nh (new width/height)
		            $scale = (($width / $w) < ($height / $h)) ? ($width / $w) : ($height / $h); // smaller rate
		            $src = array(0,0, $w, $h);
		            $dst = array(0,0, floor($w*$scale), floor($h*$scale));
		        }
		        else { // will be cropped
		            $scale = (($width / $w) > ($height / $h)) ? ($width / $w) : ($height / $h); // greater rate
		            $newW = $width/$scale;    // check the size of in file
		            $newH = $height/$scale;
		            // which side is larger (rounding error)
		            if (($w - $newW) > ($h - $newH)) {
		                $src = array(floor(($w - $newW)/2), 0, floor($newW), $h);
		            }
		            else {
		                $src = array(0, floor(($h - $newH)/2), $w, floor($newH));
		            }
		            $dst = array(0,0, floor($width), floor($height));
		        }

				// Watermark - - - - - - - - - - -
				if ($watermarkParams['image'] !== '') {
                    list($wW, $hW)	= getimagesize($watermarkParams['image']);
                    switch ($watermarkParams['x']) {
                        case 'left':
                            $locationX	= 0;
                            break;
                        case 'right':
                            $locationX	= $dst[2] - $wW;
                            break;
                        case 'center':
                        Default:
                            $locationX	= ($dst[2] / 2) - ($wW / 2);
                            break;
                    }
                    switch ($watermarkParams['y']) {
                        case 'top':
                            $locationY	= 0;
                            break;
                        case 'bottom':
                            $locationY	= $dst[3] - $hW;
                            break;
                        case 'middle':
                        Default:
                            $locationY	= ($dst[3] / 2) - ($hW / 2);
                            break;
                    }
                }
                if ($memory < 50) {
                    ini_set('memory_limit', '50M');
                    $memoryLimitChanged = 1;
                }

                if ($watermarkParams['image'] !== '') {
                    if (function_exists('ImageCreateFromPNG')) {
                        $watermarkImage=ImageCreateFromPNG($watermarkParams['image']);
                    }
                }
            }
			// End Watermark - - - - - - - - - - - - - - - - - -
            $image = null;
	        switch($type) {
	            case IMAGETYPE_JPEG:
					if (function_exists('ImageCreateFromJPEG')) {
						$image = ImageCreateFromJPEG($fileIn);
					}
                    break;
	            case IMAGETYPE_PNG :
					if (function_exists('ImageCreateFromPNG')) {
						$image = ImageCreateFromPNG($fileIn);
					}
                    break;
	            case IMAGETYPE_GIF :
					if (function_exists('ImageCreateFromGIF')) {
						$image = ImageCreateFromGIF($fileIn);
					}
                    break;
	            case IMAGETYPE_WBMP:
					if (function_exists('ImageCreateFromWBMP')) {
						$image = ImageCreateFromWBMP($fileIn);
					}
					break;
	            Default:
					return false;
	        }
			if ($image) {
				$image2 = @ImageCreateTruecolor($dst[2], $dst[3]);
				if (!$image2) {
					return false;
				}
				switch($type) {
					case IMAGETYPE_PNG:
						//imagealphablending($image1, false);
						@imagealphablending($image2, false);
						//imagesavealpha($image1, true);
						@imagesavealpha($image2, true);
                        break;
				}
				ImageCopyResampled($image2, $image, $dst[0],$dst[1], $src[0],$src[1], $dst[2],$dst[3], $src[2],$src[3]);
				// Watermark - - - - - -
				if ($watermarkParams['image'] !== '') {
					ImageCopy($image2, $watermarkImage, $locationX, $locationY, 0, 0, $wW, $hW);
				}

				// End Watermark - - - -
				// Create the file
				switch($type) {
		            case IMAGETYPE_JPEG:
						if (!function_exists('ImageJPEG')) {
							return false;
						}

						if (!@ImageJPEG($image2, $fileOut, $jpeg_quality)) {

                            \JLog::add($fileOut);
                            return false;
                        }

                        break;
					case IMAGETYPE_PNG :
						if (!function_exists('ImagePNG')) {
							return false;
						}
						if (!@ImagePNG($image2, $fileOut, $jpeg_quality)) {
                            return false;
                        }
					case IMAGETYPE_GIF :
						if (!function_exists('ImageGIF')) {
							return false;
						}
						if (!@ImageGIF($image2, $fileOut, $jpeg_quality)) {
                            return false;
                        }
                        break;
					Default:
						return false;
				}

				// free memory
				ImageDestroy($image);
	            ImageDestroy($image2);
				if (isset($watermarkImage)) {
					ImageDestroy($watermarkImage);
				}
				if ($memoryLimitChanged == 1) {
					$memoryString = $memory . 'M';
					ini_set('memory_limit', $memoryString);
				}
                return true;
	        }
            if ($memoryLimitChanged == 1) {
				$memoryString = $memory . 'M';
				ini_set('memory_limit', $memoryString);
			}
        }
        return false;
    }
}