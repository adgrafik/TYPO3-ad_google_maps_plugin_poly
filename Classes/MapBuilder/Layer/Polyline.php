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
class Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polyline extends Tx_AdGoogleMaps_MapBuilder_Layer_AbstractLayer {

	/**
	 * @var array
	 */
	protected $layerOptions;

	/**
	 * @var boolean
	 */
	protected $addMarkers;

	/**
	 * @var Tx_AdGoogleMaps_MapBuilder_Layer_Marker
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
	 * @var Tx_AdGoogleMaps_MapBuilder_Layer_InfoWindow
	 */
	protected $infoWindows;

	/**
	 * @var boolean
	 */
	protected $listTitleAddCount;

	/**
	 * @var array
	 */
	protected $listTitle;

	/**
	 * @var array
	 */
	protected $listTitleObjectNumberConf;

	/**
	 * @var array
	 */
	protected $listType;

	/**
	 * Initialize this objectManager.
	 *
	 * @return void
	 */
	public function initializeObject() {
		parent::initializeObject();
		$this->useCoordinatesProvider = TRUE;
		$this->addCountCoordinates = TRUE;
	}

	/**
	 * Pre processor to set options e.g. for all markers in the coordinates provider. 
	 *
	 * @return void
	 */
	public function buildItemPreProcessing() {
		Tx_AdGoogleMaps_Utility_FrontEnd::includeFrontEndResources('Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polyline');

		// Get list titles.
		$this->listType = $this->layer->getPluginPolyListType();
		$this->listTitleAddCount = ($this->listType & Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::LIST_TYPE_SHAPE) !== 0;
		$listTitle = $this->layer->getListTitle();
		$this->listTitles = ($listTitle !== '') ? t3lib_div::trimExplode(LF, $listTitle) : array();
		$listTitleObjectNumber = $this->layer->getListTitleObjectNumber();
		$this->listTitleObjectNumberConf = $this->getObjectNumberConf($listTitleObjectNumber, $this->getCountCoordinates($this->listTitleAddCount));

		// Get list icons.
		$listIcon = $this->layer->getListIcon();
		$this->listIcons = ($listIcon !== '') ? explode(',', $listIcon) : array();
		$listIconObjectNumber = $this->layer->getListIconObjectNumber();
		$this->listIconObjectNumberConf = $this->getObjectNumberConf($listIconObjectNumber, $this->getCountCoordinates());
		$this->listIconOptions = array(
			'width' => $this->layer->getListIconWidth(),
			'height' => $this->layer->getListIconHeight(),
		);

		// Get options.
		$this->layerOptions = array(
			'clickable' => $this->layer->isPluginPolyClickable(),
			'geodesic' => $this->layer->isPluginPolyGeodesic(),
			'zindex' => $this->layer->getPluginPolyZindex(),
			'strokeColor' => $this->layer->getPluginPolyStrokeColor(),
			'strokeOpacity' => ($this->layer->getPluginPolyStrokeOpacity() / 100),
			'strokeWeight' => $this->layer->getPluginPolyStrokeWeight(),
		);

		$this->addMarkers = $this->layer->isPluginPolyAddMarkers();
		$this->infoWindowPlacingType = $this->getInfoWindowOptionValueByInfoWindowBehaviour('pluginPolyInfoWindowPlacingType');
		$this->infoWindowPosition = $this->getInfoWindowOptionValueByInfoWindowBehaviour('pluginPolyInfoWindowPosition');

		// Build markers.
		if ($this->addMarkers === TRUE) {
			$this->markers = $this->objectManager->create('Tx_AdGoogleMaps_MapBuilder_Layer_Marker');
			$this->markers->setSettings($this->settings);
			$this->markers->setMapBuilder($this->mapBuilder);
			$this->markers->setGoogleMapsPlugin($this->googleMapsPlugin);
			$this->markers->setMap($this->map);
			$this->markers->setCategory($this->category);
			$this->markers->setLayer($this->layer);
			$this->markers->setCoordinatesProvider($this->coordinatesProvider);
			if ($this->infoWindowPlacingType === Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_SHAPE) {
				$this->markers->setPreventAddInfoWindows(TRUE);
			}
			if ($this->listType === Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::LIST_TYPE_SHAPE) {
				$this->markers->setPreventAddListItems(TRUE);
			}
			// If listType contains a shape this means, 
			// that there should be a title and an icon on every item. In this case it must be one more.
			$this->markers->setAddCountCoordinates($this->listTitleAddCount);
			$this->markers->buildItemPreProcessing();
			$this->markers->buildItems();

			if (count($this->listTitles) === 0) {
				$this->listTitles = $this->markers->getListTitles();
				$this->listTitleObjectNumberConf = $this->markers->getListTitleObjectNumberConf();
			}
			if (count($this->listIcons) === 0) {
				$this->listIcons = $this->markers->getListIcons();
				$this->listIconObjectNumberConf = $this->markers->getListIconObjectNumberConf();
				$this->listIconOptions = $this->markers->getListIconOptions();
			}
		}

		// Build info window.
		$this->infoWindows = $this->objectManager->create('Tx_AdGoogleMaps_MapBuilder_Layer_InfoWindow');
		$this->infoWindows->setSettings($this->settings);
		$this->infoWindows->setMapBuilder($this->mapBuilder);
		$this->infoWindows->setGoogleMapsPlugin($this->googleMapsPlugin);
		$this->infoWindows->setMap($this->map);
		$this->infoWindows->setCategory($this->category);
		$this->infoWindows->setLayer($this->layer);
		$this->infoWindows->setCoordinatesProvider($this->coordinatesProvider);
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
	 * @return Tx_AdGoogleMaps_Plugin_Options_Layer_LayerInterface
	 */
	public function buildItem($index, $coordinates) {
		$countCoordinates = count($this->coordinatesProvider->getCoordinates());
		// Index for info windows if infoWindowPlacingType is set to only on shape.
		$indexInfoWindow = ($this->infoWindowPlacingType === Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_SHAPE) ?
			0 : $countCoordinates;
		// Index for the list if listType is set to list only the shape.
		$indexList = ($this->listType === Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::LIST_TYPE_SHAPE) ?
			0 : $countCoordinates;
		// Default index if addMarkers is set to FALSE.
		$index = ($this->addMarkers === FALSE) ?
			0 : $countCoordinates;

		$layerUid = sprintf('Polyline_%d_%d', $this->layer->getUid(), $index);
		$infoWindowObjectNumber = $this->getInfoWindowOptionValueByInfoWindowBehaviour('infoWindowObjectNumber');
		$infoWindowObjectNumberConf = $this->getObjectNumberConf($infoWindowObjectNumber, $this->getCountCoordinates());
		$itemData = $this->getContentByObjectNumberConf($this->coordinatesProvider->getData(), $this->infoWindowObjectNumberConf, $indexInfoWindow, NULL, FALSE, array());

		// Set options.
		$this->layerOptions['path'] = $this->objectManager->create('Tx_AdGoogleMaps_Api_MVC_MVCArray');
		foreach ($this->coordinatesProvider->getCoordinates() as $coordinate) {
			$coordinate = $this->objectManager->create('Tx_AdGoogleMaps_Api_Base_LatLng', $coordinate);
			$this->layerOptions['path']->attach($coordinate);
		}

		// Create shape.
		$layer = $this->objectManager->create('Tx_AdGoogleMapsPluginPoly_Api_Overlay_Polyline', $this->layerOptions);

		// Create option object.
		$layerOptionsObject = $this->objectManager->create('Tx_AdGoogleMapsPluginPoly_Plugin_Options_Layer_Polyline');
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
		} else if (($infoWindowPositionCoordinates = $this->coordinatesProvider->getCoordinatesByIndex($this->infoWindowPosition - 1)) !== NULL) {
			$infoWindowCoordinates = $infoWindowPositionCoordinates;
		}
		// Set info window after shape to draw the shape before the info window in the JavaScript.
		$infoWindowOptionsObject = NULL;
		if (($this->infoWindowPlacingType & Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::INFO_WINDOW_PLACING_TYPE_SHAPE) !== 0) {
			$infoWindowOptionsObject = $this->infoWindows->buildItem($indexInfoWindow, $infoWindowCoordinates);
			if ($infoWindowOptionsObject !== NULL) {
				$infoWindowOptionsObject->setLinkToLayerUid($layerUid);
			}
		}

		// Get list title.
		$listTitle = $this->getContentByObjectNumberConf($this->listTitles, $this->listTitleObjectNumberConf, $indexList, $itemData, TRUE);
		// Make list icons.
		if (($listIconUrl = $this->getContentByObjectNumberConf($this->listIcons, $this->listIconObjectNumberConf, $index, NULL, TRUE))) {
			$listIconOptions = $this->listIconOptions;
			$listIconOptions['url'] = Tx_AdGoogleMaps_Utility_BackEnd::getRelativeUploadPathAndFileName('ad_google_maps', 'markerIcons', $listIconUrl);
		}

		// Create list item.
		if (($this->listType & Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline::LIST_TYPE_SHAPE) !== 0) {
			$pluginMapObjectIdentifier = $this->googleMapsPlugin->getPluginMapObjectIdentifier();
			$infoWindowUid = ($infoWindowOptionsObject !== NULL ? $infoWindowOptionsObject->getUid() : NULL);
			$item = $this->objectManager->create('Tx_AdGoogleMaps_Domain_Model_Item');
			$item->setTitle($listTitle);
			$item->setIcon($listIconOptions['url']);
			$item->setIconWidth($listIconOptions['width']);
			$item->setIconHeight($listIconOptions['height']);
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