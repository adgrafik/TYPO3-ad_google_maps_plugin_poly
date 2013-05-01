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
class Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polygon extends Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polyline {

	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Pre processor to set options e.g. for all markers in the coordinates provider. 
	 *
	 * @return void
	 */
	public function buildItemPreProcessing() {
		parent::buildItemPreProcessing();

		Tx_AdGoogleMaps_Utility_FrontEnd::includeFrontEndResources('Tx_AdGoogleMapsPluginPoly_MapBuilder_Layer_Polygon');

		$this->layerOptions['fillColor'] = $this->layer->getPluginPolyFillColor();
		$this->layerOptions['fillOpacity'] = $this->layer->getPluginPolyFillOpacity() / 100;
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

		$layerUid = sprintf('Polygon_%d_%d', $this->layer->getUid(), $index);
		$infoWindowObjectNumber = $this->getInfoWindowOptionValueByInfoWindowBehaviour('infoWindowObjectNumber');
		$infoWindowObjectNumberConf = $this->getObjectNumberConf($infoWindowObjectNumber, $this->getCountCoordinates());
		$itemData = $this->getContentByObjectNumberConf($this->coordinatesProvider->getData(), $this->infoWindowObjectNumberConf, $indexInfoWindow, NULL, FALSE, array());

		// Set options.
		$this->layerOptions['paths'] = t3lib_div::makeInstance('Tx_AdGoogleMaps_Api_LatLngArray', $this->coordinatesProvider->getCoordinates());

		// Create shape.
		$layer = t3lib_div::makeInstance('Tx_AdGoogleMapsPluginPoly_Api_Layer_Polygon', $this->layerOptions);

		// Create option object.
		$layerOptionsObject = t3lib_div::makeInstance('Tx_AdGoogleMapsPluginPoly_Plugin_Options_Layer_Polygon');
		$layerOptionsObject->setUid($layerUid);
		$layerOptionsObject->setDrawFunctionName('drawPolygon');
		$layerOptionsObject->setOptions($layer);

		// Add layer options object to layer options.
		$pluginOptions = $this->googleMapsPlugin->getPluginOptions();
		$pluginOptions->addLayerOptions($layerOptionsObject);

		// $this->infoWindowPosition can be a coordinate or a position of the given coordinates.
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
			$item = t3lib_div::makeInstance('Tx_AdGoogleMaps_Domain_Model_Item');
			$item->setTitle($listTitle);
			$item->setIcon($listIconOptions['url']);
			$item->setIconWidth($listIconOptions['width']);
			$item->setIconHeight($listIconOptions['height']);
			$item->setPosition($this->layerOptions['paths']);
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