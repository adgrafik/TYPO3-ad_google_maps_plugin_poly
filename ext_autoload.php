<?php
$extensionClassesPath = t3lib_extMgm::extPath('ad_google_maps_plugin_poly') . 'Classes/';
return array(
	'tx_adgooglemapspluginpoly_mapdrawer_layer_polyline' => $extensionClassesPath . 'MapDrawer/Layer/Polyline.php',
	'tx_adgooglemapspluginpoly_mapdrawer_layer_polygon' => $extensionClassesPath . 'MapDrawer/Layer/Polygon.php',
);
?>