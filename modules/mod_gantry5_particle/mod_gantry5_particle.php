<?php
/**
 * @package   Gantry 5
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2016 RocketTheme, LLC
 * @license   GNU/GPLv2 and later
 *
 * http://www.gnu.org/licenses/gpl-2.0.html
 */
defined('_JEXEC') or die;

// Detect Gantry Framework or fail gracefully.
if (!class_exists('Gantry\Framework\Gantry')) {
    $lang = JFactory::getLanguage();
    JFactory::getApplication()->enqueueMessage(
        JText::sprintf('MOD_GANTRY5_PARTICLE_NOT_INITIALIZED', JText::_('MOD_GANTRY5_PARTICLE')),
        'warning'
    );
    return;
}

include_once dirname(__FILE__) . '/helper.php';

/** @var object $params */

$gantry = \Gantry\Framework\Gantry::instance();

GANTRY_DEBUGGER && \Gantry\Debugger::startTimer("module-{$module->id}", "Rendering Particle Module #{$module->id}");

// Set up caching.
$cacheid = md5($module->id);

$cacheparams = (object) [
    'cachemode'    => 'id',
    'class'        => 'ModGantryParticlesHelper',
    'method'       => 'render',
    'methodparams' => [$module, $params],
    'modeparams'   => $cacheid
];

$data = JModuleHelper::moduleCache($module, $params, $cacheparams);

if (!is_array($data)) {
    $data = ModGantryParticlesHelper::render($module, $params);
}

list ($html, $assets) = $data;

/** @var \Gantry\Framework\Document $document */
$document = $gantry['document'];
$document->appendHeaderTags($assets);

echo $html;

GANTRY_DEBUGGER && \Gantry\Debugger::stopTimer("module-{$module->id}");
