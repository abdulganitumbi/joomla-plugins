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
	
}