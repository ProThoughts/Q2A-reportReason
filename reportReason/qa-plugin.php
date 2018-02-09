<?php

/*
	Plugin Name: Report-reason
	Plugin URI:
	Plugin Description: Plugin dodaje możliwość dodania powodu dla zgłoszenia
	Plugin Version: 1.0
	Plugin Date: 2018-02-07
	Plugin Author: Mariusz08
	Plugin Author URI: https://forum.pasja-informatyki.pl
	Plugin License:
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Update Check URI:
*/

if (!defined('QA_VERSION')) 
{
	header('Location: ../../');
	exit;
}

qa_register_plugin_layer('reportReason-layer.php', 'ReportReason');
qa_register_plugin_module('event', 'adminMenu.php', 'adminMenu', 'ReportReason');