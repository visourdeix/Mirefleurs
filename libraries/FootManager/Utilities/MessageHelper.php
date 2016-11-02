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
 * This is a class that provides functionality for managing messages.
 *
 * @package      FootManager\Utilities
 * @subpackage   Urls
 */
abstract class MessageHelper
{
    /**
     * This method parse the message.
     * The message can be array, object ( Exception,... ), string,...
     *
     * @param mixed $message
     *
     * @return string
     */
    public static function prepareMessage($message)
    {
        if (is_array($message)) {

            $result = '';

            foreach ($message as $value) {
                if (is_object($value)) {
                    if ($value instanceof \Exception) {
                        $result .= (string)$value->getMessage() . "\n";
                    }
                } else {
                    $result .= (string)$value . "\n";
                }
            }

        } elseif (is_object($message)) {

            if ($message instanceof \Exception) {
                $result = (string)$message->getMessage();
            } else {
                $result = (string)$message . "\n";
            }

        } else {
            $result = (string)$message;
        }

        return $result;
    }
}