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
class Tx_AdGoogleMapsPluginPoly_Api_Layer_Polyline extends Tx_AdGoogleMaps_Api_Layer_AbstractLayer {

	/**
	 * @var Tx_AdGoogleMaps_Api_Map
	 * @javaScriptHelper dontSetValue = TRUE
	 */
	protected $map;

	/**
	 * @var Tx_AdGoogleMaps_Api_LatLngArray
	 * @javaScriptHelper getFunction = __toString
	 */
	protected $path;

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
	 * Sets this map.
	 *
	 * @param Tx_AdGoogleMaps_Api_Map $map
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polyline
	 */
	public function setMap($map) {
		$this->map = $map;
		return $this;
	}

	/**
	 * Sets this path.
	 *
	 * @param Tx_AdGoogleMaps_Api_LatLngArray $path
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polyline
	 */
	public function setPath(Tx_AdGoogleMaps_Api_LatLngArray $path) {
		$this->path = $path;
		return $this;
	}

	/**
	 * Adds a point to the path.
	 *
	 * @param Tx_AdGoogleMaps_Api_LatLng $point
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polyline
	 */
	public function addPoint(Tx_AdGoogleMaps_Api_LatLng $point) {
		$this->path->addLatLng($point);
		return $this;
	}

	/**
	 * Returns this path.
	 *
	 * @return Tx_AdGoogleMaps_Api_LatLngArray
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * Sets this clickable.
	 *
	 * @param boolean $clickable
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polyline
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
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polyline
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
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polyline
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
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polyline
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
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polyline
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
	 * @return Tx_AdGoogleMapsPluginPoly_Api_Layer_Polyline
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
	 * Returns the polyline as JavaScript string.
	 *
	 * @return string
	 */
	public function getPrint() {
		return 'new google.maps.Polyline(' . $this->getPrintOptions() . ')';
	}

}

?>