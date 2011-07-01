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
			'size' => 15,
			'eval' => 'trim',
		),
	),
);

t3lib_extMgm::addTCAcolumns('tx_adgooglemaps_domain_model_map', $tempColumns, 1);
t3lib_extMgm::addLLrefForTCAdescr('tx_adgooglemaps_domain_model_map', 'EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca_csh_map.xml');

// Set palettes.
$TCA['tx_adgooglemaps_domain_model_map']['palettes']['infoWindowPosition'] = array('showitem' => 'tx_adgooglemapspluginpoly_info_window_placing_type, tx_adgooglemapspluginpoly_info_window_position');
t3lib_extMgm::addToAllTCAtypes(
	'tx_adgooglemaps_domain_model_map',
	'--palette--;LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_map.paletteTitle.infoWindowPlacement;infoWindowPosition',
	'',
	'after:--palette--;;infoWindowArrangement'
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
		),
	),
	'tx_adgooglemapspluginpoly_list_type' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.listType',
		'exclude' => true,
		'l10n_mode' => $excludeProperties,
		'config' => array(
			'type' => 'select',
			'default' => Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::LIST_TYPE_MARKERS | Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::LIST_TYPE_SHAPE,
			'items' => array (
				array('LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.listType.both', Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::LIST_TYPE_MARKERS | Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::LIST_TYPE_SHAPE),
				array('LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.listType.markers', Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::LIST_TYPE_MARKERS),
				array('LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.listType.shape', Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::LIST_TYPE_SHAPE),
			),
		),
	),
);

t3lib_extMgm::addTCAcolumns('tx_adgooglemaps_domain_model_layer', $tempColumns, 1);
t3lib_extMgm::addLLrefForTCAdescr('tx_adgooglemaps_domain_model_layer', 'EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca_csh_layer.xml');

// Add layer type icon.
$TCA['tx_adgooglemaps_domain_model_layer']['ctrl']['typeicons']['Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polyline'] = t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/TCA/IconPolyline.gif';
$TCA['tx_adgooglemaps_domain_model_layer']['ctrl']['typeicons']['Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polygon'] = t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/TCA/IconPolygon.gif';

// Append record type.
$TCA['tx_adgooglemaps_domain_model_layer']['columns']['type']['config']['items'][] = array('LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.type.polyline', 'Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polyline', 'EXT:ad_google_maps_plugin_poly/Resources/Public/Icons/TCA/IconPolyline.gif');
$TCA['tx_adgooglemaps_domain_model_layer']['columns']['type']['config']['items'][] = array('LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.type.polygon', 'Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polygon', 'EXT:ad_google_maps_plugin_poly/Resources/Public/Icons/TCA/IconPolygon.gif');

// Set palettes.
$TCA['tx_adgooglemaps_domain_model_layer']['palettes']['pluginPolyStroke'] = array('canNotCollapse' => true, 'showitem' => 'tx_adgooglemapspluginpoly_stroke_color, tx_adgooglemapspluginpoly_stroke_opacity, tx_adgooglemapspluginpoly_stroke_weight');
$TCA['tx_adgooglemaps_domain_model_layer']['palettes']['pluginPolyFill'] = array('canNotCollapse' => true, 'showitem' => 'tx_adgooglemapspluginpoly_fill_color, tx_adgooglemapspluginpoly_fill_opacity');
$TCA['tx_adgooglemaps_domain_model_layer']['palettes']['pluginPolyProperties'] = array('showitem' => 'tx_adgooglemapspluginpoly_clickable, tx_adgooglemapspluginpoly_geodesic, tx_adgooglemapspluginpoly_zindex');
$TCA['tx_adgooglemaps_domain_model_layer']['palettes']['pluginPolyInfoWindowPlacement'] = array('showitem' => 'tx_adgooglemapspluginpoly_info_window_placing_type, tx_adgooglemapspluginpoly_info_window_position');

// Set types.
$TCA['tx_adgooglemaps_domain_model_layer']['types']['Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polygon']['showitem'] = 
	$TCA['tx_adgooglemaps_domain_model_layer']['types']['Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polyline']['showitem'] = 
		$TCA['tx_adgooglemaps_domain_model_layer']['types']['Tx_AdGoogleMaps_MapBuilder_Layer_Marker']['showitem'];

// Add fields for polylines and polygons.
t3lib_extMgm::addToAllTCAtypes(
	'tx_adgooglemaps_domain_model_layer',
	'tx_adgooglemapspluginpoly_add_markers',
	'Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polyline,Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polygon',
	'before:marker_title'
);

t3lib_extMgm::addToAllTCAtypes(
	'tx_adgooglemaps_domain_model_layer',
	'--div--;LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.sheetAppearance, 
		--palette--;;pluginPolyStroke,
		--palette--;LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.paletteTitle.polyProperties;pluginPolyProperties', 
	'Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polyline,Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polygon',
	'after:categories'
);

t3lib_extMgm::addToAllTCAtypes(
	'tx_adgooglemaps_domain_model_layer',
	'--palette--;LLL:EXT:ad_google_maps_plugin_poly/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.paletteTitle.infoWindowPlacement;pluginPolyInfoWindowPlacement',
	'Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polyline,Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polygon',
	'after:--palette--;;infoWindowArrangement'
);

t3lib_extMgm::addToAllTCAtypes(
	'tx_adgooglemaps_domain_model_layer',
	'tx_adgooglemapspluginpoly_list_type',
	'Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polyline,Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polygon',
	'before:list_title'
);

// Add fields only for polygons.
t3lib_extMgm::addToAllTCAtypes(
	'tx_adgooglemaps_domain_model_layer',
	'--palette--;;pluginPolyFill',
	'Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polygon',
	'after:--palette--;;pluginPolyStroke'
);

// Add static TypoScript
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/', 'ad: Google Maps Plugin Poly-Layer');

?>