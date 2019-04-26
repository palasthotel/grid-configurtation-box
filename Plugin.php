<?php
/**
 * Plugin Name: Grid – Configuration box
 * Description: Adds two configuration boxes, one for container configurations and one for slot configurations.
 * Version: 1.0
 * Author: Palasthotel ( Edward Bock <edward.bock@palasthotel.de> )
 * Author URI: https://palasthotel.de
 */

namespace Palasthotel\Grid\ConfigurationBox;

/**
 * @property string path
 * @property string url
 * @property ConfigurationStructure container
 * @property ConfigurationStructure slot
 * @property ConfigurationBoxHandler configurationBoxHandler
 * @property Grid grid
 */
class Plugin {

	const FILTER_CONTAINER_CONFIGURATION_STRUCTURE = "grid_configuration_box_container_content_structure";

	const FILTER_SLOT_CONFIGURATION_STRUCTURE = "grid_configuration_box_slot_content_structure";

	private function __construct() {
		require_once dirname( __FILE__ ) . "/vendor/autoload.php";

		$this->path = plugin_dir_path( __FILE__ );
		$this->url  = plugin_dir_url( __FILE__ );

		$this->container               = new ConfigurationStructure( Plugin::FILTER_CONTAINER_CONFIGURATION_STRUCTURE );
		$this->slot                    = new ConfigurationStructure( Plugin::FILTER_SLOT_CONFIGURATION_STRUCTURE );
		$this->configurationBoxHandler = new ConfigurationBoxHandler( $this );
		$this->grid                    = new Grid( $this );
//		$this->settings                = new Settings( $this );

	}

	private static $instance = NULL;

	public static function instance() {
		if ( self::$instance == NULL ) {
			self::$instance = new Plugin();
		}

		return self::$instance;
	}
}

Plugin::instance();