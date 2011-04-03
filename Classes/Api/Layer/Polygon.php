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
 * Google Maps API class.
 * Nearly the same like the Google Maps API
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @api
 */
class Tx_AdGoogleMapsPluginPoly_Api_Layer_Polygon extends Tx_AdGoogleMapsApi_Api_Layer_AbstractLayer {

	/**
	 * @var Tx_AdGoogleMapsApi_Api_Map
	 * @javaScriptHelper dontSetValue = TRUE
	 */
	protected $map;

	/**
	 * @var Tx_AdGoogleMapsApi_Api_LatLngArray
	 * @javaScriptHelper getFunction = __toString
	 */
	protected $paths;

	/**
	 * @var boolean
	 * @javaScriptHelper dontSetIfValueIs = TRUE
	 */
	protected $clickable;

	/**
	 * @var boolean
	 * @javaScriptHelper dontSetIfValueIs = FALSE
	 */
	protected $geodesic;

	/**
	 * @var integer
	 * @javaScriptHelper dontSetIfValueIs = 0
	 */
	protected $zindex;

	/**
	 * @var string
	 * @javaScriptHelper dontSetIfValueIs = ''
	 */
	protected $strokeColor;

	/**
	 * @var float
	 * @javaScriptHelper dontSetIfValueIs = 0
	 */
	protected $strokeOpacity;

	/**
	 * @var integer
	 * @javaScriptHelper dontSetIfValueIs = 0
	 */
	protected $strokeWeight;

	/**
	 * @var string
	 * @javaScriptHelper dontSetIfValueIs = ''
	 */
	protected $fillColor;

	/**
	 * @var float
	 * @javaScriptHelper dontSetIfValueIs = 0
	 */
	protected $fillOpacity;

	/**
	 * Sets this map.
	 *
	 * @param Tx_AdGoogleMapsApi_Api_Map $map
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polygon
	 */
	public function setMap($map) {
		$this->map = $map;
		return $this;
	}

	/**
	 * Returns this map.
	 *
	 * @return Tx_AdGoogleMapsApi_Api_Map
	 */
	public function getMap() {
		return $this->map;
	}

	/**
	 * Sets this paths.
	 *
	 * @param Tx_AdGoogleMapsApi_Api_LatLngArray $paths
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polygon
	 */
	public function setPaths(Tx_AdGoogleMapsApi_Api_LatLngArray $paths) {
		$this->paths = $paths;
		return $this;
	}

	/**
	 * Adds a point to the path.
	 *
	 * @param Tx_AdGoogleMapsApi_Api_LatLng $point
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polygon
	 */
	public function addPoint(Tx_AdGoogleMapsApi_Api_LatLng $point) {
		$this->paths->addLatLng($point);
		return $this;
	}

	/**
	 * Returns this paths.
	 *
	 * @return Tx_AdGoogleMapsApi_Api_LatLngArray
	 */
	public function getPaths() {
		return $this->paths;
	}

	/**
	 * Sets this clickable.
	 *
	 * @param boolean $clickable
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polygon
	 */
	public function setClickable($clickable) {
		$this->clickable = (boolean) $clickable;
		return $this;
	}

	/**
	 * Returns this clickable.
	 *
	 * @return boolean
	 */
	public function isClickable() {
		return (boolean) $this->clickable;
	}

	/**
	 * Sets this geodesic.
	 *
	 * @param boolean $geodesic
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polygon
	 */
	public function setGeodesic($geodesic) {
		$this->geodesic = (boolean) $geodesic;
		return $this;
	}

	/**
	 * Returns this geodesic.
	 *
	 * @return boolean
	 */
	public function isGeodesic() {
		return (boolean) $this->geodesic;
	}

	/**
	 * Sets this zindex.
	 *
	 * @param integer $zindex
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polygon
	 */
	public function setZindex($zindex) {
		$this->zindex = (integer) $zindex;
		return $this;
	}

	/**
	 * Returns this zindex.
	 *
	 * @return integer
	 */
	public function getZindex() {
		return (integer) $this->zindex;
	}

	/**
	 * Sets this strokeColor.
	 *
	 * @param string $strokeColor
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polygon
	 */
	public function setStrokeColor($strokeColor) {
		$this->strokeColor = $strokeColor;
		return $this;
	}

	/**
	 * Returns this strokeColor.
	 *
	 * @return string
	 */
	public function getStrokeColor() {
		return $this->strokeColor;
	}

	/**
	 * Sets this strokeOpacity.
	 *
	 * @param float $strokeOpacity
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polygon
	 */
	public function setStrokeOpacity($strokeOpacity) {
		$this->strokeOpacity = (float) $strokeOpacity;
		return $this;
	}

	/**
	 * Returns this strokeOpacity.
	 *
	 * @return float
	 */
	public function getStrokeOpacity() {
		return (float) $this->strokeOpacity;
	}

	/**
	 * Sets this strokeWeight.
	 *
	 * @param integer $strokeWeight
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polygon
	 */
	public function setStrokeWeight($strokeWeight) {
		$this->strokeWeight = (integer) $strokeWeight;
		return $this;
	}

	/**
	 * Returns this strokeWeight.
	 *
	 * @return integer
	 */
	public function getStrokeWeight() {
		return (integer) $this->strokeWeight;
	}

	/**
	 * Sets this fillColor.
	 *
	 * @param string $fillColor
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polygon
	 */
	public function setFillColor($fillColor) {
		$this->fillColor = $fillColor;
		return $this;
	}

	/**
	 * Returns this fillColor.
	 *
	 * @return string
	 */
	public function getFillColor() {
		return $this->fillColor;
	}

	/**
	 * Sets this fillOpacity.
	 *
	 * @param float $fillOpacity
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polygon
	 */
	public function setFillOpacity($fillOpacity) {
		$this->fillOpacity = (float) $fillOpacity;
		return $this;
	}

	/**
	 * Returns this fillOpacity.
	 *
	 * @return float
	 */
	public function getFillOpacity() {
		return (float) $this->fillOpacity;
	}

	/**
	 * Returns the polygon as JavaScript string.
	 *
	 * @return string
	 */
	public function getPrint() {
		return 'new google.maps.Polygon(' . $this->getPrintOptions() . ')';
	}

}

?>