<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Arno Dudek <webmaster@adgrafik.at>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Layer builder class.
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_AdGoogleMapsPluginPoly_PluginAdapter_LayerBuilder_Polyline extends Tx_AdGoogleMaps_PluginAdapter_LayerBuilder_AbstractLayerBuilder {

	/**
	 * @var boolean
	 */
	protected $addMarkers;

	/**
	 * @var boolean
	 */
	protected $forceListing;

	/**
	 * @var Tx_AdGoogleMaps_PluginAdapter_LayerBuilder_Marker
	 */
	protected $markers;

	/**
	 * @var integer
	 */
	protected $infoWindowPlacingType;

	/**
	 * @var string
	 */
	protected $infoWindowPosition;

	/**
	 * @var Tx_AdGoogleMaps_PluginAdapter_LayerBuilder_InfoWindow
	 */
	protected $infoWindows;

	/**
	 * @var array
	 */
	protected $layerOptions;

	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->useCoordinatesProvider = TRUE;
		$this->addCountCoordinates = TRUE;
		Tx_AdGoogleMapsApi_Utility_FrontEnd::includeFrontEndResources('Tx_AdGoogleMapsPluginPoly_PluginAdapter_LayerBuilder_Polyline');
	}

	/**
	 * Pre processor to set options e.g. for all markers in the coordinates provider. 
	 *
	 * @return void
	 */
	public function buildItemPreProcessing() {
		// Get options.
		$this->layerOptions = array(
			'clickable' => $this->mapBuilder->getPropertyValue('clickable', $this->layer, $this->settings['layer']),
			'geodesic' => $this->mapBuilder->getPropertyValue('geodesic', $this->layer, $this->settings['layer']),
			'zindex' => $this->mapBuilder->getPropertyValue('zindex', $this->layer, $this->settings['layer']),
			'strokeColor' => $this->mapBuilder->getPropertyValue('strokeColor', $this->layer, $this->settings['layer']),
			'strokeOpacity' => ($this->mapBuilder->getPropertyValue('strokeOpacity', $this->layer, $this->settings['layer']) / 100),
			'strokeWeight' => $this->mapBuilder->getPropertyValue('strokeWeight', $this->layer, $this->settings['layer']),
			'flat' => $this->mapBuilder->getPropertyValue('flat', $this->layer, $this->settings['layer']),
			'cursor' => $this->mapBuilder->getPropertyValue('mouseCursor', $this->layer, $this->settings['layer']),
			'url' => $this->mapBuilder->getPropertyValue('mouseCursor', $this->layer, $this->settings['layer']),
		);

		$this->addMarkers = $this->mapBuilder->getPropertyValue('addMarkers', $this->layer, $this->settings['layer']);
		$this->forceListing = $this->mapBuilder->getPropertyValue('forceListing', $this->layer, $this->settings['layer']);
		$this->infoWindowPlacingType = $this->getInfoWindowOptionValueByInfoWindowBehaviour('infoWindowPlacingType');
		$this->infoWindowPosition = $this->getInfoWindowOptionValueByInfoWindowBehaviour('infoWindowPosition');

		// Build markers.
		if ($this->addMarkers === TRUE) {
			$this->markers = t3lib_div::makeInstance('Tx_AdGoogleMaps_PluginAdapter_LayerBuilder_Marker');
			$this->markers->injectSettings($this->settings);
			$this->markers->injectMapBuilder($this->mapBuilder);
			$this->markers->injectGoogleMapsPlugin($this->googleMapsPlugin);
			$this->markers->injectMap($this->map);
			$this->markers->injectCategory($this->category);
			$this->markers->injectLayer($this->layer);
			$this->markers->injectCoordinatesProvider($this->coordinatesProvider);
			if ($this->infoWindowPlacingType === Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_SHAPE) {
				$this->markers->setPreventAddInfoWindows(TRUE);
			}
			// If addMarkers and forceListing is set this means, 
			// that there should be an marker on every item. In this case it must be one more.
			if (($this->addMarkers === TRUE && $this->forceListing === TRUE)) {
				$this->markers->setAddCountCoordinates(TRUE);
			}
			$this->markers->buildItemPreProcessing();
			$this->markers->buildItems();
		}

		// Build info window.
		$this->infoWindowPlacingType = $this->mapBuilder->getPropertyValue('infoWindowPlacingType', $this->layer, $this->settings['layer']);
		$this->infoWindows = t3lib_div::makeInstance('Tx_AdGoogleMaps_PluginAdapter_LayerBuilder_InfoWindow');
		$this->infoWindows->injectSettings($this->settings);
		$this->infoWindows->injectMapBuilder($this->mapBuilder);
		$this->infoWindows->injectGoogleMapsPlugin($this->googleMapsPlugin);
		$this->infoWindows->injectMap($this->map);
		$this->infoWindows->injectCategory($this->category);
		$this->infoWindows->injectLayer($this->layer);
		$this->infoWindows->injectCoordinatesProvider($this->coordinatesProvider);
		$this->infoWindows->setPreventAddListItems(TRUE);
		// If placing type of the info windows is set to shape or both this means, 
		// that there should be an info window on every item. In this case it must be one more.
		if (($this->infoWindowPlacingType & Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_SHAPE) !== 0) {
			$this->infoWindows->setAddCountCoordinates(TRUE);
		}
		$this->infoWindows->buildItemPreProcessing();
	}

	/**
	 * Builds the layer items.
	 *
	 * @param integer $index
	 * @param string $coordinates
	 * @return Tx_AdGoogleMapsApi_Plugin_Options_Layer_LayerInterface
	 */
	public function buildItem($index, $coordinates) {
		// If addMarkers and forceListing is set, than the index begins next the marks.
		if ($this->addMarkers === TRUE) {
			$index = count($this->coordinatesProvider->getCoordinates());
		} else {
			$index = 0;
		}
		$layerUid = sprintf('Polyline_%d_%d', $this->layer->getUid(), $index);
		$infoWindowObjectNumber = $this->getInfoWindowOptionValueByInfoWindowBehaviour('infoWindowObjectNumber');
		$infoWindowObjectNumberConf = $this->getObjectNumberConf($infoWindowObjectNumber, $this->getCountCoordinates());
		$itemData = $this->getContentByObjectNumberConf($this->coordinatesProvider->getData(), $this->infoWindowObjectNumberConf, $index, NULL, FALSE, array());

		$itemIcons = explode(',', $this->mapBuilder->getPropertyValue('icon', $this->layer, $this->settings['layer']));
		$itemIconObjectNumberConf = $this->getObjectNumberConf($this->mapBuilder->getPropertyValue('iconObjectNumber', $this->layer, $this->settings['layer']), $this->getCountCoordinates());

		// Set all over icon and shadow options.
		$itemIconWidth = $this->mapBuilder->getPropertyValue('iconWidth', $this->layer, $this->settings['layer']);
		$itemIconHeight = $this->mapBuilder->getPropertyValue('iconHeight', $this->layer, $this->settings['layer']);
		$this->markerIcons = explode(',', $this->mapBuilder->getPropertyValue('icon', $this->layer, $this->settings['layer']));
		$this->markerIconObjectNumberConf = $this->getObjectNumberConf($this->mapBuilder->getPropertyValue('iconObjectNumber', $this->layer, $this->settings['layer']), $this->getCountCoordinates());

		if (($itemIconUrl = $this->getContentByObjectNumberConf($itemIcons, $itemIconObjectNumberConf, $index, NULL, TRUE))) {
			$itemIconUrl = Tx_AdGoogleMaps_Utility_BackEnd::getRelativeUploadPathAndFileName('ad_google_maps', 'markerIcons', $itemIconUrl);
		}

		// Set options.
		$this->layerOptions['title'] = $this->getItemTitle($index, $itemData, FALSE);
		$this->layerOptions['path'] = t3lib_div::makeInstance('Tx_AdGoogleMapsApi_Api_LatLngArray', $this->coordinatesProvider->getCoordinates());

		// Create shape.
		$layer = t3lib_div::makeInstance('Tx_AdGoogleMapsPluginPoly_Api_Layer_Polyline', $this->layerOptions);

		// Create option object.
		$layerOptionsObject = t3lib_div::makeInstance('Tx_AdGoogleMapsPluginPoly_Plugin_Options_Layer_Polyline');
		$layerOptionsObject->setUid($layerUid);
		$layerOptionsObject->setDrawFunctionName('drawPolyline');
		$layerOptionsObject->setOptions($layer);

		// Add layer options object to layer options.
		$pluginOptions = $this->googleMapsPlugin->getPluginOptions();
		$pluginOptions->addLayerOptions($layerOptionsObject);

		// $this->infoWindowPosition can be a coordinate, a position of the given coordinates or NULL.
		$infoWindowCoordinates = NULL;
		if (preg_match('/^-?\d+\.?\d*\s*,\s*-?\d+\.?\d*$/', $this->infoWindowPosition) === TRUE) {
			$infoWindowCoordinates = $this->infoWindowPosition;
		} else if (($infoWindowPositionCoordinates = $this->coordinatesProvider->getCoordinatesByIndex(--$this->infoWindowPosition)) !== NULL) {
			$infoWindowCoordinates = $infoWindowPositionCoordinates;
		}
		// Set info window after shape to draw the shape before the info window in the JavaScript.
		$infoWindowOptionsObject = NULL;
		if ($this->preventAddInfoWindows === FALSE) {
			$infoWindowOptionsObject = $this->infoWindows->buildItem($index, $infoWindowCoordinates);
			if ($infoWindowOptionsObject !== NULL) {
				$infoWindowOptionsObject->setLinkToLayerUid($layerUid);
			}
		}

		// Create list item.
		if ($this->addMarkers === FALSE || ($this->addMarkers === TRUE && $this->forceListing === TRUE)) {
			$pluginMapObjectIdentifier = $this->googleMapsPlugin->getPluginMapObjectIdentifier();
			$infoWindowUid = ($infoWindowOptionsObject !== NULL ? $infoWindowOptionsObject->getUid() : NULL);
			$item = t3lib_div::makeInstance('Tx_AdGoogleMaps_Domain_Model_Item');
			$item->setTitle($this->layerOptions['title']);
			$item->setIcon($itemIconUrl);
			$item->setIconWidth($itemIconWidth);
			$item->setIconHeight($itemIconHeight);
			$item->setPosition($this->layerOptions['path']);
			$item->setMapControlFunctions($this->getItemMapControlFunctions($layerUid, ($infoWindowOptionsObject !== NULL ? $infoWindowOptionsObject->getUid() : NULL)));
			$item->setLayerOptions($this->layerOptions);
			$item->setInfoWindow($infoWindowOptionsObject);
			$item->setDataProvider($itemData);
			$this->layer->addItem($item);
		}

		$this->categoryItemKeys[] = $layerUid;

		return $layer;
	}

}

?>