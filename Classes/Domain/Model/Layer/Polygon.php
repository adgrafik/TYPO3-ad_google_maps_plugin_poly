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
class Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polygon extends Tx_AdGoogleMapsPluginPoly_Domain_Model_Layer_Polyline {

	/**
	 * @var string
	 */
	protected $pluginPolyFillColor;

	/**
	 * @var integer
	 */
	protected $pluginPolyFillOpacity;

	/**
	 * Sets this pluginPolyFillColor
	 *
	 * @param string $pluginPolyFillColor
	 * @return void
	 */
	public function setPluginPolyFillColor($pluginPolyFillColor) {
		$this->pluginPolyFillColor = $pluginPolyFillColor;
	}

	/**
	 * Returns this pluginPolyFillColor
	 *
	 * @return string
	 */
	public function getPluginPolyFillColor() {
		return $this->getPropertyValue('pluginPolyFillColor', 'layer');
	}

	/**
	 * Sets this pluginPolyFillOpacity
	 *
	 * @param integer $pluginPolyFillOpacity
	 * @return void
	 */
	public function setPluginPolyFillOpacity($pluginPolyFillOpacity) {
		$this->pluginPolyFillOpacity = $pluginPolyFillOpacity;
	}

	/**
	 * Returns this pluginPolyFillOpacity
	 *
	 * @return integer
	 */
	public function getPluginPolyFillOpacity() {
		return (integer) $this->getPropertyValue('pluginPolyFillOpacity', 'layer');
	}

}

?>