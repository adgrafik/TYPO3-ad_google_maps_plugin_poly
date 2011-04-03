<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

// l10n_mode for property fields.
$excludeProperties = Tx_AdGoogleMaps_Utility_BackEnd::getExtensionConfigurationValue('excludeProperties');

// Class used for constants.
$extensionClassesPath = t3lib_extMgm::extPath($_EXTKEY) . 'Classes/';
include_once($extensionClassesPath . 'Domain/Model/Layer/Polyline.php');
include_once($extensionClassesPath . 'Domain/Model/Layer/Polygon.php');

// TCA configuration for tx_adgooglemaps_domain_model_map
t3lib_div::loadTCA('tx_adgooglemaps_domain_model_map');

$tempColumns = array(
	'tx_adgooglemapspluginpoly_info_window_placing_type' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_map.infoWindowPlacingType',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'displayCond' => 'FIELD:info_window_behaviour:!=:' . Tx_AdGoogleMaps_Domain_Model_Map::INFO_WINDOW_BEHAVIOUR_BY_LAYER,
		'config' => array(
			'type' => 'select',
			'default' => Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_MARKERS | Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_SHAPE,
			'items' => array (
				array('LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_map.infoWindowPlacingType.both', Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_MARKERS | Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_SHAPE),
				array('LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_map.infoWindowPlacingType.markers', Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_MARKERS),
				array('LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_map.infoWindowPlacingType.shape', Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_SHAPE),
			),
		),
	),
	'tx_adgooglemapspluginpoly_info_window_position' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_map.infoWindowPosition',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'displayCond' => 'FIELD:info_window_behaviour:!=:' . Tx_AdGoogleMaps_Domain_Model_Map::INFO_WINDOW_BEHAVIOUR_BY_LAYER,
		'config' => array(
			'type' => 'input',
			'default' => '0',
			'checkbox' => '0',
			'size' => 15,
			'eval' => 'trim',
		),
	),
);

t3lib_extMgm::addTCAcolumns('tx_adgooglemaps_domain_model_map', $tempColumns, 1);
t3lib_extMgm::addLLrefForTCAdescr('tx_adgooglemaps_domain_model_map', 'EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca_csh_map.xml');

// Set palettes.
$TCA['tx_adgooglemaps_domain_model_map']['palettes']['layer_poly_a'] = array('showitem' => 'tx_adgooglemapspluginpoly_info_window_placing_type, tx_adgooglemapspluginpoly_info_window_position');
t3lib_extMgm::addToAllTCAtypes(
	'tx_adgooglemaps_domain_model_map',
	'--palette--;;layer_poly_a',
	'',
	'after:--palette--;;12c'
);

// TCA configuration for tx_adgooglemaps_domain_model_layer
t3lib_div::loadTCA('tx_adgooglemaps_domain_model_layer');

$tempColumns = array(
	'tx_adgooglemapspluginpoly_clickable' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.clickable',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'config' => array(
			'type' => 'check',
			'default' => 1,
		),
	),
	'tx_adgooglemapspluginpoly_zindex' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.zIndex',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'config' => array(
			'type' => 'input',
			'default' => '0',
			'checkbox' => '0',
			'size' => 4,
			'eval' => 'num,int,trim',
		),
	),
	'tx_adgooglemapspluginpoly_add_markers' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.addMarkers',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'config' => array(
			'type' => 'check',
			'default' => 1,
		),
	),
	'tx_adgooglemapspluginpoly_force_listing' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.forceListing',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'config' => array(
			'type' => 'check',
			'default' => 1,
		),
	),
	'tx_adgooglemapspluginpoly_geodesic' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.geodesic',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'config' => array(
			'type' => 'check',
			'default' => 0,
		),
	),
	'tx_adgooglemapspluginpoly_stroke_color' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.strokeColor',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'config' => array(
			'type' => 'input',
			'default' => '0',
			'checkbox' => '0',
			'size' => 7,
			'eval' => 'trim',
			'wizards' =>array(
				'colorpick' => array(
					'type' => 'colorbox',
					'title' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.colorPickerTitle',
					'script' => 'wizard_colorpicker.php',
					'dim' => '20x20',
					'tableStyle' => 'margin-left: 5px;',
					'JSopenParams' => 'height=300,width=365,status=0,menubar=0,scrollbars=0',
				),
			),
		),
	),
	'tx_adgooglemapspluginpoly_stroke_opacity' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.strokeOpacity',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'config' => array(
			'type' => 'input',
			'default' => '0',
			'checkbox' => '0',
			'size' => 3,
			'eval' => 'num,int,trim',
			'range' => array(
				'lower' => 0,
				'upper' => 100,
			),
		),
	),
	'tx_adgooglemapspluginpoly_stroke_weight' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.strokeWeight',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'config' => array(
			'type' => 'input',
			'default' => '0',
			'checkbox' => '0',
			'size' => 3,
			'eval' => 'num,int,trim',
		),
	),
	'tx_adgooglemapspluginpoly_fill_color' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.fillColor',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'config' => array(
			'type' => 'input',
			'default' => '0',
			'checkbox' => '0',
			'size' => 7,
			'eval' => 'trim',
			'wizards' =>array(
				'colorpick' => array(
					'type' => 'colorbox',
					'title' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.colorPickerTitle',
					'script' => 'wizard_colorpicker.php',
					'dim' => '20x20',
					'tableStyle' => 'margin-left: 5px;',
					'JSopenParams' => 'height=300,width=365,status=0,menubar=0,scrollbars=0',
				),
			),
		),
	),
	'tx_adgooglemapspluginpoly_fill_opacity' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.fillOpacity',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'config' => array(
			'type' => 'input',
			'default' => '0',
			'checkbox' => '0',
			'size' => 3,
			'eval' => 'num,int,trim',
			'range' => array(
				'lower' => 0,
				'upper' => 100,
			),
		),
	),
	'tx_adgooglemapspluginpoly_info_window_placing_type' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.infoWindowPlacingType',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'config' => array(
			'type' => 'select',
			'default' => Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_MARKERS | Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_SHAPE,
			'items' => array (
				array('LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.infoWindowPlacingType.both', Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_MARKERS | Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_SHAPE),
				array('LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.infoWindowPlacingType.markers', Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_MARKERS),
				array('LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.infoWindowPlacingType.shape', Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_SHAPE),
			),
		),
	),
	'tx_adgooglemapspluginpoly_info_window_position' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.infoWindowPosition',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'config' => array(
			'type' => 'input',
			'size' => 15,
			'eval' => 'trim',
			'default' => '0',
			'checkbox' => '0',
		),
	),
);

t3lib_extMgm::addTCAcolumns('tx_adgooglemaps_domain_model_layer', $tempColumns, 1);
t3lib_extMgm::addLLrefForTCAdescr('tx_adgooglemaps_domain_model_layer', 'EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca_csh_layer.xml');

// Add layer type icon.
$TCA['tx_adgooglemaps_domain_model_layer']['ctrl']['typeicons']['Tx_AdGoogleMapsPluginPoly_PluginAdapter_LayerBuilder_Polyline'] = t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/TCA/IconPolyline.gif';
$TCA['tx_adgooglemaps_domain_model_layer']['ctrl']['typeicons']['Tx_AdGoogleMapsPluginPoly_PluginAdapter_LayerBuilder_Polygon'] = t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/TCA/IconPolygon.gif';

// Append record type.
$TCA['tx_adgooglemaps_domain_model_layer']['columns']['type']['config']['items'][] = array('LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.type.polyline', 'Tx_AdGoogleMapsPluginPoly_PluginAdapter_LayerBuilder_Polyline', 'EXT:ad_google_maps_plugin_poly/Resources/Public/Icons/TCA/IconPolyline.gif');
$TCA['tx_adgooglemaps_domain_model_layer']['columns']['type']['config']['items'][] = array('LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.type.polygon', 'Tx_AdGoogleMapsPluginPoly_PluginAdapter_LayerBuilder_Polygon', 'EXT:ad_google_maps_plugin_poly/Resources/Public/Icons/TCA/IconPolygon.gif');

// Set palettes.
$TCA['tx_adgooglemaps_domain_model_layer']['palettes']['layer_poly_a'] = array('canNotCollapse' => true, 'showitem' => 'tx_adgooglemapspluginpoly_clickable, tx_adgooglemapspluginpoly_geodesic, tx_adgooglemapspluginpoly_zindex');
$TCA['tx_adgooglemaps_domain_model_layer']['palettes']['layer_poly_b'] = array('canNotCollapse' => true, 'showitem' => 'tx_adgooglemapspluginpoly_stroke_color, tx_adgooglemapspluginpoly_stroke_opacity, tx_adgooglemapspluginpoly_stroke_weight');
$TCA['tx_adgooglemaps_domain_model_layer']['palettes']['layer_poly_c'] = array('canNotCollapse' => true, 'showitem' => 'tx_adgooglemapspluginpoly_fill_color, tx_adgooglemapspluginpoly_fill_opacity');
$TCA['tx_adgooglemaps_domain_model_layer']['palettes']['layer_poly_d'] = array('showitem' => 'tx_adgooglemapspluginpoly_force_listing');
$TCA['tx_adgooglemaps_domain_model_layer']['palettes']['layer_poly_e'] = array('showitem' => 'tx_adgooglemapspluginpoly_info_window_placing_type, tx_adgooglemapspluginpoly_info_window_position');

// Set types.
$TCA['tx_adgooglemaps_domain_model_layer']['types']['Tx_AdGoogleMapsPluginPoly_PluginAdapter_LayerBuilder_Polyline']['showitem'] = '
	type;;1;;1-1-1, title, coordinates_provider, coordinates, categories;;;;1-1-1,
	--div--;LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.sheetAppearance, 
	--palette--;;layer_poly_a, --palette--;;layer_poly_b,
	--div--;LLL:EXT:ad_google_maps/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.sheetMarkers, 
	tx_adgooglemapspluginpoly_add_markers;;layer_poly_d, item_titles, --palette--;;markers_a, --palette--;;markers_b, icon, --palette--;LLL:EXT:ad_google_maps/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.iconExtendedSettingsLabel;icon_a, --palette--;;icon_b, --palette--;;icon_c, shadow, --palette--;LLL:EXT:ad_google_maps/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.shadowExtendedSettingsLabel;shadow_a, --palette--;;shadow_b, --palette--;;shadow_c, --palette--;;shadow_d, shape_type;;shape_a, mouse_cursor;;;;1-1-1,
	--div--;LLL:EXT:ad_google_maps/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.sheetInfoWindow, 
	info_window, --palette--;LLL:EXT:ad_google_maps/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.infoWindowExtendedSettingsLabel;info_window_a, --palette--;;info_window_b, --palette--;;info_window_c, --palette--;;layer_poly_e,
	--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access, 
	starttime, endtime, fe_group';

$TCA['tx_adgooglemaps_domain_model_layer']['types']['Tx_AdGoogleMapsPluginPoly_PluginAdapter_LayerBuilder_Polygon']['showitem'] = '
	type;;1;;1-1-1, title, coordinates_provider, coordinates, categories;;;;1-1-1,
	--div--;LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.sheetAppearance, 
	--palette--;;layer_poly_a, --palette--;;layer_poly_b, --palette--;;layer_poly_c,
	--div--;LLL:EXT:ad_google_maps/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.sheetMarkers, 
	tx_adgooglemapspluginpoly_add_markers;;layer_poly_d, item_titles, --palette--;;markers_a, --palette--;;markers_b, icon, --palette--;LLL:EXT:ad_google_maps/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.iconExtendedSettingsLabel;icon_a, --palette--;;icon_b, --palette--;;icon_c, shadow, --palette--;LLL:EXT:ad_google_maps/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.shadowExtendedSettingsLabel;shadow_a, --palette--;;shadow_b, --palette--;;shadow_c, --palette--;;shadow_d, shape_type;;shape_a, mouse_cursor;;;;1-1-1,
	--div--;LLL:EXT:ad_google_maps/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.sheetInfoWindow, 
	info_window, --palette--;LLL:EXT:ad_google_maps/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.infoWindowExtendedSettingsLabel;info_window_a, --palette--;;info_window_b, --palette--;;info_window_c, --palette--;;layer_poly_e,
	--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access, 
	starttime, endtime, fe_group';

// Add static TypoScript
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/', 'ad: Google Maps Plugin Poly-Layer');

?>