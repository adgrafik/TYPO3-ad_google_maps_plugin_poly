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
 * Model: Layer.
 * Nearly the same like the Google Maps API
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 * @api
 */
class Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline extends Tx_AdGoogleMaps_Domain_Model_Layer_Marker {

	/**
	 * Placing type of info windows.
	 */
	const INFO_WINDOW_PLACING_TYPE_MARKERS = 1;
	const INFO_WINDOW_PLACING_TYPE_SHAPE = 2;

	/**
	 * Placing type of list entries.
	 */
	const LIST_TYPE_MARKERS = 1;
	const LIST_TYPE_SHAPE = 2;

	/**
	 * @var boolean
	 */
	protected $pluginPolyClickable;

	/**
	 * @var boolean
	 */
	protected $pluginPolyGeodesic;

	/**
	 * @var integer
	 */
	protected $pluginPolyZindex;

	/**
	 * @var boolean
	 */
	protected $pluginPolyAddMarkers;

	/**
	 * @var string
	 */
	protected $pluginPolyStrokeColor;

	/**
	 * @var integer
	 */
	protected $pluginPolyStrokeOpacity;

	/**
	 * @var integer
	 */
	protected $pluginPolyStrokeWeight;

	/**
	 * @var integer
	 */
	protected $pluginPolyInfoWindowPlacingType;

	/**
	 * @var string
	 */
	protected $pluginPolyInfoWindowPosition;

	/**
	 * @var integer
	 */
	protected $pluginPolyListType;

	/**
	 * Sets this pluginPolyClickable
	 *
	 * @param boolean $pluginPolyClickable
	 * @return void
	 */
	public function setPluginPolyClickable($pluginPolyClickable) {
		$this->pluginPolyClickable = (boolean) $pluginPolyClickable;
	}

	/**
	 * Returns this pluginPolyClickable
	 *
	 * @return boolean
	 */
	public function isPluginPolyClickable() {
		return (boolean) $this->getPropertyValue('pluginPolyClickable', 'layer');
	}

	/**
	 * Sets this pluginPolyGeodesic
	 *
	 * @param boolean $pluginPolyGeodesic
	 * @return void
	 */
	public function setPluginPolyGeodesic($pluginPolyGeodesic) {
		$this->pluginPolyGeodesic = (boolean) $pluginPolyGeodesic;
	}

	/**
	 * Returns this pluginPolyGeodesic
	 *
	 * @return boolean
	 */
	public function isPluginPolyGeodesic() {
		return (boolean) $this->getPropertyValue('pluginPolyGeodesic', 'layer');
	}

	/**
	 * Sets this pluginPolyZindex
	 *
	 * @param integer $pluginPolyZindex
	 * @return void
	 */
	public function setPluginPolyZindex($pluginPolyZindex) {
		$this->pluginPolyZindex = $pluginPolyZindex;
	}

	/**
	 * Returns this pluginPolyZindex
	 *
	 * @return integer
	 */
	public function getPluginPolyZindex() {
		return (integer) $this->getPropertyValue('pluginPolyZindex', 'layer');
	}

	/**
	 * Sets this pluginPolyAddMarkers
	 *
	 * @param boolean $pluginPolyAddMarkers
	 * @return void
	 */
	public function setPluginPolyAddMarkers($pluginPolyAddMarkers) {
		$this->pluginPolyAddMarkers = (boolean) $pluginPolyAddMarkers;
	}

	/**
	 * Returns this pluginPolyAddMarkers
	 *
	 * @return boolean
	 */
	public function isPluginPolyAddMarkers() {
		return (boolean) $this->getPropertyValue('pluginPolyAddMarkers', 'layer');
	}

	/**
	 * Sets this pluginPolyStrokeColor
	 *
	 * @param string $pluginPolyStrokeColor
	 * @return void
	 */
	public function setPluginPolyStrokeColor($pluginPolyStrokeColor) {
		$this->pluginPolyStrokeColor = $pluginPolyStrokeColor;
	}

	/**
	 * Returns this pluginPolyStrokeColor
	 *
	 * @return string
	 */
	public function getPluginPolyStrokeColor() {
		return $this->getPropertyValue('pluginPolyStrokeColor', 'layer');
	}

	/**
	 * Sets this pluginPolyStrokeOpacity
	 *
	 * @param integer $pluginPolyStrokeOpacity
	 * @return void
	 */
	public function setPluginPolyStrokeOpacity($pluginPolyStrokeOpacity) {
		$this->pluginPolyStrokeOpacity = $pluginPolyStrokeOpacity;
	}

	/**
	 * Returns this pluginPolyStrokeOpacity
	 *
	 * @return integer
	 */
	public function getPluginPolyStrokeOpacity() {
		return (integer) $this->getPropertyValue('pluginPolyStrokeOpacity', 'layer');
	}

	/**
	 * Sets this pluginPolyStrokeWeight
	 *
	 * @param integer $pluginPolyStrokeWeight
	 * @return void
	 */
	public function setPluginPolyStrokeWeight($pluginPolyStrokeWeight) {
		$this->pluginPolyStrokeWeight = $pluginPolyStrokeWeight;
	}

	/**
	 * Returns this pluginPolyStrokeWeight
	 *
	 * @return integer
	 */
	public function getPluginPolyStrokeWeight() {
		return (integer) $this->getPropertyValue('pluginPolyStrokeWeight', 'layer');
	}

	/**
	 * Sets this pluginPolyInfoWindowPlacingType
	 *
	 * @param integer $pluginPolyInfoWindowPlacingType
	 * @return void
	 */
	public function setPluginPolyInfoWindowPlacingType($pluginPolyInfoWindowPlacingType) {
		$this->pluginPolyInfoWindowPlacingType = (integer) $pluginPolyInfoWindowPlacingType;
	}

	/**
	 * Returns this infoWindowPlacingType
	 *
	 * @return integer
	 */
	public function getPluginPolyInfoWindowPlacingType() {
		return (integer) $this->getPropertyValue('pluginPolyInfoWindowPlacingType', 'layer');
	}

	/**
	 * Sets this pluginPolyInfoWindowPosition
	 *
	 * @param string $pluginPolyInfoWindowPosition
	 * @return void
	 */
	public function setPluginPolyInfoWindowPosition($pluginPolyInfoWindowPosition) {
		$this->pluginPolyInfoWindowPosition = $pluginPolyInfoWindowPosition;
	}

	/**
	 * Returns this pluginPolyInfoWindowPosition
	 *
	 * @return string
	 */
	public function getPluginPolyInfoWindowPosition() {
		return $this->getPropertyValue('pluginPolyInfoWindowPosition', 'layer');
	}

	/**
	 * Sets this pluginPolyListType
	 *
	 * @param integer $pluginPolyListType
	 * @return void
	 */
	public function setPluginPolyListType($pluginPolyListType) {
		$this->pluginPolyListType = (integer) $pluginPolyListType;
	}

	/**
	 * Returns this pluginPolyListType
	 *
	 * @return integer
	 */
	public function getPluginPolyListType() {
		return (integer) $this->getPropertyValue('pluginPolyListType', 'layer');
	}

}

?>