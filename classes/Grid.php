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
class Grid {

	public function __construct(Plugin $plugin) {
		$this->plugin = $plugin;
		add_action('grid_load_classes', array($this, 'grid_load_classes'));
	}

	public function grid_load_classes(){
		if($this->plugin->container->hasConfiguration()){
			require_once $this->plugin->path."/grid/grid_container_configuration_box.php";
		}
		if($this->plugin->slot->hasConfiguration()){
			require_once $this->plugin->path."/grid/grid_slot_configuration_box.php";
		}
	}
}