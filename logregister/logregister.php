<?php
/**
 * @copyright	Copyright (c) 2015 Logregister. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * search - Logregister Plugin
 *
 * @package		Joomla.Plugin
 * @subpakage	Logregister.Logregister
 */
class plgsearchLogregister extends JPlugin {

	/**
	 * Constructor.
	 *
	 * @param 	$subject
	 * @param	array $config
	 */
	function __construct(&$subject, $config = array()) {
		// call parent constructor
		parent::__construct($subject, $config);
	}
	function onRegisterLog($component, $resource , $id, $title, $action,$metadata = null,$note = null)
	 {
	 	// Initialiase variables.
	 	$db    = JFactory::getDbo();
	 	if ($action == "add")
	 	{
	 		$status = "created";
	 	}
	 	elseif ($action == "edit")
	 	{
	 		$status = "updated";
	 	}
	 	elseif ($action == "delete")
	 	{
	 		$status = "deleted";
	 	}
	 	elseif ($action == "login")
	 	{
	 		$status = "Login from " . $_SERVER['REMOTE_ADDR'];
	 	}
	 	elseif ($action == "logut")
	 	{
	 		$status = "Logout from " . $_SERVER['REMOTE_ADDR'];
	 	}
	 	else
	 	{
	 		$status = "none";
	 	}
		$date = date('m/d/Y h:i:s a', time());
	 	$input  = JFactory::getApplication()->input;
		$option = $input->get('option');
		$type   = substr($option,0,strpos($option, "_"));
		$date = date ("d/m/Y");

	 	$user = JFactory::getUser();
	 	// $db    = $this->getDbo();
	 	$query = $db->getQuery(true);
	 	$query = "INSERT INTO #__activities_activities (`note`,`created_on`,`type`,`package`,`name`,`row`,`title`,`action`,`status`,`metadata`,`created_by`,`ip`,`date`) VALUES ('".$note."','".$date."','".$type."','".$component."','".$resource."','".$id."','".$title."','".$action."','".$status."','".json_encode($metadata)."',".$user->id.",'".$_SERVER['REMOTE_ADDR']."','".$date."')";

	 	// Set the query and load the result.
	 	$db->setQuery($query);
	 	$db->query();

	 	// Check for a database error.
	 	if ($db->getErrorNum())
	 	{
	 		JError::raiseWarning(500, $db->getErrorMsg());

	 		return null;
	 	}

		/*
		 * Plugin code goes here.
		 * You can access database and application objects and parameters via $this->db,
		 * $this->app and $this->params respectively
		 */
		return true;
	}
}