#
# Table structure for table 'tx_adgooglemaps_domain_model_map'
#
CREATE TABLE tx_adgooglemaps_domain_model_map (
	tx_adgooglemapspluginpoly_info_window_placing_type tinyint(4) unsigned NOT NULL DEFAULT '0',
	tx_adgooglemapspluginpoly_info_window_position varchar(64) DEFAULT '' NOT NULL
);


#
# Table structure for table 'tx_adgooglemaps_domain_model_layer'
#
CREATE TABLE tx_adgooglemaps_domain_model_layer (
	tx_adgooglemapspluginpoly_clickable tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_adgooglemapspluginpoly_zindex mediumint(11) unsigned DEFAULT '0' NOT NULL,
	tx_adgooglemapspluginpoly_add_markers tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_adgooglemapspluginpoly_force_listing tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_adgooglemapspluginpoly_geodesic tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_adgooglemapspluginpoly_stroke_color varchar(7) DEFAULT '' NOT NULL,
	tx_adgooglemapspluginpoly_stroke_opacity tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_adgooglemapspluginpoly_stroke_weight tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_adgooglemapspluginpoly_fill_color varchar(7) DEFAULT '' NOT NULL,
	tx_adgooglemapspluginpoly_fill_opacity tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_adgooglemapspluginpoly_info_window_placing_type tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_adgooglemapspluginpoly_info_window_position varchar(64) DEFAULT '' NOT NULL
);