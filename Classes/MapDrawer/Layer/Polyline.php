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
 * The TCA service MapDrawer. 
 *
 * @package Extbase
 * @subpackage GoogleMaps\MapDrawer
 * @scope prototype
 * @entity
 * @api
 */
class Tx_AdGoogleMapsPluginPoly_MapDrawer_Layer_Polyline extends Tx_AdGoogleMaps_MapDrawer_Layer_AbstractLayer {

	/**
	 * @var array
	 */
	protected $shapeOptions;

	/**
	 * User function for Google Maps database fields. 
	 *
	 * @return void
	 */
	public function draw() {
		$this->shapeOptions = array();
		$columnsMapping = $this->recordTypeConfiguration['columnsMapping'];
		if (array_key_exists($columnsMapping['geodesic'], $this->currentField['row']) === TRUE && (boolean) $this->currentField['row'][$columnsMapping['geodesic']] === TRUE) {
			$this->shapeOptions['geodesic'] = 'geodesic: true';
		}
		if (array_key_exists($columnsMapping['strokeColor'], $this->currentField['row']) === TRUE && $this->currentField['row'][$columnsMapping['strokeColor']]) {
			$this->shapeOptions['strokeColor'] = 'strokeColor: ' . '\'' . $this->currentField['row'][$columnsMapping['strokeColor']] . '\'';
		}
		if (array_key_exists($columnsMapping['strokeWeight'], $this->currentField['row']) === TRUE && $this->currentField['row'][$columnsMapping['strokeWeight']]) {
			$this->shapeOptions['strokeWeight'] = 'strokeWeight: ' . intval($this->currentField['row'][$columnsMapping['strokeWeight']]);
		}
		if (array_key_exists($columnsMapping['strokeOpacity'], $this->currentField['row']) === TRUE && $this->currentField['row'][$columnsMapping['strokeOpacity']]) {
			$this->shapeOptions['strokeOpacity'] = 'strokeOpacity: ' . (intval($this->currentField['row'][$columnsMapping['strokeOpacity']]) / 100);
		}
		$this->mapDrawerOptions['shapeOptions'] = 'shapeOptions: ' . '{ ' . implode(', ', $this->shapeOptions) . ' }';
		$this->mapDrawerOptions['fitBoundsOnLoad'] = 'fitBoundsOnLoad: ' . ((array_key_exists('fitBoundsOnLoad', $this->recordTypeConfiguration) === TRUE && (boolean) $this->recordTypeConfiguration['fitBoundsOnLoad'] === TRUE) ? 'true' : 'false');
	}

}

?>