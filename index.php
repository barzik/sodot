<?php 
/**
 * @file
 * index.php
 *
 * Calls the controller.
 */
	include_once("controller/controller.php");

	$controller = new Controller();
	$controller->invoke();