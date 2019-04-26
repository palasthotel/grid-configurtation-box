<?php
/**
 * Created by PhpStorm.
 * User: edward
 * Date: 2019-04-26
 * Time: 15:05
 */

namespace Palasthotel\Grid\ConfigurationBox;


use Grid\Constants\Hook;

/**
 * @property Plugin plugin
 */
class ConfigurationBoxHandler {

	public function __construct( Plugin $plugin ) {
		$this->plugin = $plugin;
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
		if (
			class_exists( "Grid\Constants\Hook" )
			&&
			( $this->plugin->container->hasConfiguration() || $this->plugin->slot->hasConfiguration() )
		) {
			add_action( "grid_" . Hook::WILL_RENDER_CONTAINER, array(
				$this,
				'append_configs',
			) );
		}
	}

	public function append_configs( $obj ) {

		// do not touch anything in editmode
		if($obj->editmode) return;

		// init wit null only if there is a configuration else leave it alone
		if ( $this->plugin->container->hasConfiguration() ) {
			$obj->container->config = NULL;
		}

		foreach ( $obj->container->slots as $slot ) {

			// init wit null only if there is a configuration else leave it alone
			if ( $this->plugin->slot->hasConfiguration() ) {
				$slot->config = NULL;
			}

			// iterate over boxes to find configuration boxes
			foreach ( $slot->boxes as $box ) {

				if ( $this->plugin->container->hasConfiguration() && $box instanceof \grid_container_configuration_box ) {
					foreach ( $box->build( false ) as $key => $value ) {
						if ( ! is_array( $obj->container->config ) ) {
							$obj->container->config = array();
						}
						$obj->container->config[ $key ] = $value;
					}
				}
				if ( $this->plugin->slot->hasConfiguration() && $box instanceof \grid_slot_configuration_box ) {
					foreach ( $box->build( false ) as $key => $value ) {
						if ( ! is_array( $slot->config ) ) {
							$slot->config = array();
						}
						$slot->config[ $key ] = $value;
					}
				}
			}

			// remove from grid
			$slot->boxes = array_filter($slot->boxes, function($box){
				return !($box instanceof \grid_container_configuration_box || $box instanceof \grid_slot_configuration_box);
			});
		}

	}
}