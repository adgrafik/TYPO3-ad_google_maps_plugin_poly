<?php

########################################################################
# Extension Manager/Repository config file for ext "ad_google_maps_plugin_poly".
#
# Auto generated 25-04-2011 12:49
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'ad: Google Maps Plugin Poly-Layer',
	'description' => 'Extends the extension ad: Google Maps (ad_google_maps) with a polyline and polygon layer.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '0.0.0',
	'dependencies' => 'ad_google_maps',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 1,
	'lockType' => '',
	'author' => 'Arno Dudek',
	'author_email' => 'webmaster@adgrafik.at',
	'author_company' => 'ad:grafik',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.5.0-',
			'extbase' => '1.3.0-',
			'fluid' => '1.3.0-',
			'ad_google_maps' => '1.1.0-',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:25:{s:9:"ChangeLog";s:4:"c76b";s:16:"ext_autoload.php";s:4:"24c8";s:12:"ext_icon.gif";s:4:"f587";s:14:"ext_tables.php";s:4:"bcf3";s:14:"ext_tables.sql";s:4:"2e61";s:29:"Classes/Api/Layer/Polygon.php";s:4:"3ea1";s:30:"Classes/Api/Layer/Polyline.php";s:4:"e66c";s:28:"Classes/Domain/Model/Map.php";s:4:"eb0c";s:38:"Classes/Domain/Model/Layer/Polygon.php";s:4:"3c6a";s:39:"Classes/Domain/Model/Layer/Polyline.php";s:4:"eaaa";s:35:"Classes/MapDrawer/Layer/Polygon.php";s:4:"42cf";s:36:"Classes/MapDrawer/Layer/Polyline.php";s:4:"3658";s:40:"Classes/Plugin/Options/Layer/Polygon.php";s:4:"e9b4";s:41:"Classes/Plugin/Options/Layer/Polyline.php";s:4:"b913";s:46:"Classes/MapBuilder/Layer/Polygon.php";s:4:"dc63";s:47:"Classes/MapBuilder/Layer/Polyline.php";s:4:"5a11";s:34:"Configuration/TypoScript/setup.txt";s:4:"5c22";s:44:"Resources/Private/Language/locallang_tca.xml";s:4:"f0fa";s:54:"Resources/Private/Language/locallang_tca_csh_layer.xml";s:4:"a45c";s:52:"Resources/Private/Language/locallang_tca_csh_map.xml";s:4:"e28e";s:42:"Resources/Public/Icons/TCA/IconPolygon.gif";s:4:"1a1d";s:43:"Resources/Public/Icons/TCA/IconPolyline.gif";s:4:"7226";s:87:"Resources/Public/JavaScript/MapDrawer/Tx_AdGoogleMapsPluginPoly_MapDrawer_Layer_Poly.js";s:4:"51b3";s:70:"Resources/Public/JavaScript/Plugin/Tx_AdGoogleMapsPluginPoly_Plugin.js";s:4:"5a27";s:14:"doc/manual.sxw";s:4:"2d48";}',
	'suggests' => array(
	),
);

?>