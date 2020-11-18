<?php

// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
include_once dirname(__FILE__) . '/helper.php';

use Joomla\CMS\Factory;

$user = Factory::getUser();

//se instantiaza class
$ObjPPVSB = new clsAqc;
$codSubiect = $_GET["sb"];
$iduser = $user->id;

if ($iduser <> 0) {
    $view = 'default';
} else {
    $view = 'nouser';
}


$layout = $params->get('layout', $view);

require JModuleHelper::getLayoutPath('mod_reactjs', $layout);
