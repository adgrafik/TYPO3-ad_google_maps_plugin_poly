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

Ext.ns('TYPO3');

/**
 * A Google Maps Api JavaScript class for the MapDrawer.
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
TYPO3.Tx_AdGoogleMapsPluginPoly_MapDrawer_Layer_Polyline = Ext.extend(TYPO3.Tx_AdGoogleMaps_MapDrawer_Layer_Marker, {

	shape: null,
	shapeOptions: {},

	/**
	 * Constructor
	 *
	 * @param object options
	 * @return void
	 */
	constructor: function(options){
		// Call parent constructor to initialize the map.
		TYPO3.Tx_AdGoogleMapsPluginPoly_MapDrawer_Layer_Polyline.superclass.constructor.call(this, options);
	},

	/**
	 * Load markers from coordinates field.
	 *
	 * @param boolean resetMap
	 * @return void
	 */
	drawLayer: function(resetMap){
		// Draw markers.
		TYPO3.Tx_AdGoogleMapsPluginPoly_MapDrawer_Layer_Polyline.superclass.drawLayer.call(this, resetMap);

		if (resetMap){
			this.shape.setMap(null);
		}

		var shapeOptions = {
			map: this.map,	
			path: this.latlngs,
			clickable: false,
		};
		Ext.apply(shapeOptions, this.shapeOptions);

		this.shape = new google.maps.Polyline(shapeOptions);
	}

});


/**
 * A Google Maps Api JavaScript class for the MapDrawer.
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
TYPO3.Tx_AdGoogleMapsPluginPoly_MapDrawer_Layer_Polygon = Ext.extend(TYPO3.Tx_AdGoogleMapsPluginPoly_MapDrawer_Layer_Polyline, {

	shape: null,
	shapeOptions: {},

	/**
	 * Constructor
	 *
	 * @param object options
	 * @return void
	 */
	constructor: function(options){
		// Call parent constructor to initialize the map.
		TYPO3.Tx_AdGoogleMapsPluginPoly_MapDrawer_Layer_Polygon.superclass.constructor.call(this, options);
	},

	/**
	 * Load markers from coordinates field.
	 *
	 * @param boolean resetMap
	 * @return void
	 */
	drawLayer: function(resetMap){
		// Draw markers.
		TYPO3.Tx_AdGoogleMapsPluginPoly_MapDrawer_Layer_Polyline.superclass.drawLayer.call(this, resetMap);

		if (resetMap){
			this.shape.setMap(null);
		}

		var shapeOptions = {
			map: this.map,	
			paths: this.latlngs,
			clickable: false,
		};
		Ext.apply(shapeOptions, this.shapeOptions);

		this.shape = new google.maps.Polygon(shapeOptions);
	}

});