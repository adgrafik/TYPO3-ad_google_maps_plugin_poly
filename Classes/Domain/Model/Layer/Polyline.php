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
	 * @var boolean
	 */
	protected $clickable;

	/**
	 * @var boolean
	 */
	protected $geodesic;

	/**
	 * @var integer
	 */
	protected $zindex;

	/**
	 * @var boolean
	 */
	protected $addMarkers;

	/**
	 * @var boolean
	 */
	protected $forceListing;

	/**
	 * @var string
	 */
	protected $strokeColor;

	/**
	 * @var integer
	 */
	protected $strokeOpacity;

	/**
	 * @var integer
	 */
	protected $strokeWeight;

	/**
	 * @var integer
	 */
	protected $infoWindowPlacingType;

	/**
	 * @var string
	 */
	protected $infoWindowPosition;

	/**
	 * Sets this clickable
	 *
	 * @param boolean $clickable
	 * @return void
	 */
	public function setClickable($clickable) {
		$this->clickable = (boolean) $clickable;
	}

	/**
	 * Returns this clickable
	 *
	 * @return boolean
	 */
	public function isClickable() {
		return (boolean) $this->clickable;
	}

	/**
	 * Sets this geodesic
	 *
	 * @param boolean $geodesic
	 * @return void
	 */
	public function setGeodesic($geodesic) {
		$this->geodesic = (boolean) $geodesic;
	}

	/**
	 * Returns this geodesic
	 *
	 * @return boolean
	 */
	public function isGeodesic() {
		return (boolean) $this->geodesic;
	}

	/**
	 * Sets this zindex
	 *
	 * @param integer $zindex
	 * @return void
	 */
	public function setZindex($zindex) {
		$this->zindex = $zindex;
	}

	/**
	 * Returns this zindex
	 *
	 * @return integer
	 */
	public function getZindex() {
		return (integer) $this->zindex;
	}

	/**
	 * Sets this addMarkers
	 *
	 * @param boolean $addMarkers
	 * @return void
	 */
	public function setAddMarkers($addMarkers) {
		$this->addMarkers = (boolean) $addMarkers;
	}

	/**
	 * Returns this addMarkers
	 *
	 * @return boolean
	 */
	public function isAddMarkers() {
		return (boolean) $this->addMarkers;
	}

	/**
	 * Returns this addMarkers
	 *
	 * @return boolean
	 */
	public function getAddMarkers() {
		return (boolean) $this->addMarkers;
	}

	/**
	 * Sets this forceListing
	 *
	 * @param boolean $forceListing
	 * @return void
	 */
	public function setForceListing($forceListing) {
		$this->forceListing = (boolean) $forceListing;
	}

	/**
	 * Returns this forceListing
	 *
	 * @return boolean
	 */
	public function isForceListing() {
		return (boolean) ($this->isAddMarkers() === FALSE || ($this->isAddMarkers() === TRUE && (boolean) $this->forceListing === TRUE));
	}

	/**
	 * Sets this strokeColor
	 *
	 * @param string $strokeColor
	 * @return void
	 */
	public function setStrokeColor($strokeColor) {
		$this->strokeColor = $strokeColor;
	}

	/**
	 * Returns this strokeColor
	 *
	 * @return string
	 */
	public function getStrokeColor() {
		return $this->strokeColor;
	}

	/**
	 * Sets this strokeOpacity
	 *
	 * @param integer $strokeOpacity
	 * @return void
	 */
	public function setStrokeOpacity($strokeOpacity) {
		$this->strokeOpacity = $strokeOpacity;
	}

	/**
	 * Returns this strokeOpacity
	 *
	 * @return integer
	 */
	public function getStrokeOpacity() {
		return (integer) $this->strokeOpacity;
	}

	/**
	 * Sets this strokeWeight
	 *
	 * @param integer $strokeWeight
	 * @return void
	 */
	public function setStrokeWeight($strokeWeight) {
		$this->strokeWeight = $strokeWeight;
	}

	/**
	 * Returns this strokeWeight
	 *
	 * @return integer
	 */
	public function getStrokeWeight() {
		return (integer) $this->strokeWeight;
	}

	/**
	 * Sets this infoWindowPlacingType
	 *
	 * @param integer $infoWindowPlacingType
	 * @return void
	 */
	public function setInfoWindowPlacingType($infoWindowPlacingType) {
		$this->infoWindowPlacingType = (integer) $infoWindowPlacingType;
	}

	/**
	 * Returns this infoWindowPlacingType
	 *
	 * @return integer
	 */
	public function getInfoWindowPlacingType() {
		return (integer) $this->infoWindowPlacingType;
	}

	/**
	 * Sets this infoWindowPosition
	 *
	 * @param string $infoWindowPosition
	 * @return void
	 */
	public function setInfoWindowPosition($infoWindowPosition) {
		$this->infoWindowPosition = $infoWindowPosition;
	}

	/**
	 * Returns this infoWindowPosition
	 *
	 * @return string
	 */
	public function getInfoWindowPosition() {
		return $this->infoWindowPosition;
	}

}

?>