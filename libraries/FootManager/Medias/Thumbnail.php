<?php
/**
 * @package      FootManager
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Medias;

defined('JPATH_PLATFORM') or die;

abstract class Thumbnail {

    protected $_item;
    protected $_size;
    protected $_category_type;
    protected $properties = array();

    public function __construct($item, $size = "medium", $category_type = "category") {
        $this->_item = $item;
        $this->_size = $size;
        $this->_category_type = $category_type;
    }

    public abstract function image($size);
    protected abstract function title();
    protected abstract function url();
    protected function category_url() {
        return "";
    }

    protected function category() {
        return "";
    }

    protected function icon() {
        return "camera";
    }

    protected function visibleIcon() {
        return "";
    }

    protected function mask() {
        return '<span>
                    <i class="fa fa-'.$this->icon().'"></i>
                </span>';
    }

    protected function visibleMask() {
        if($this->visibleIcon())
            return '<span>
                    <i class="fa fa-'.$this->visibleIcon().'"></i>
                </span>';
        return "";
    }

    protected function caption() {
        return "";
    }

    protected function attribs() {
        return [];
    }

    protected function subtitle() {
        return "";
    }

    protected function desc() {
        return "";
    }

    public function __get($name) {

        if($name == "item") return $this->_item;
        if($name == "image") return $this->image($this->_size);

        if(isset($this->properties[$name]))
            return $this->properties[$name];
        elseif($name == "image") {
            $this->properties[$name] = $this->image($this->_size);
            return $this->properties[$name];
        }
        elseif(method_exists($this, $name)) {
            $this->properties[$name] = $this->$name();
            return $this->properties[$name];
        }

        return null;
    }

    public function __set($name, $value) {

        if(method_exists($this, $name)) {
            $this->properties[$name] = $value;
        }
    }

}