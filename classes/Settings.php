<?php
/**
 * Created by PhpStorm.
 * User: edward
 * Date: 2019-04-26
 * Time: 16:35
 */

namespace Palasthotel\Grid\ConfigurationBox;


/**
 * @property Plugin plugin
 */
class Settings {
	public function __construct(Plugin $plugin) {
		$this->plugin = $plugin;
//		add_action( 'admin_menu', array( $this, 'admin_menu' ), 11 );
	}

	public function admin_menu(){
		add_submenu_page(
			'grid_settings',
			'Configuration Box',
			'Configuration Box',
			'manage_options',
			'grid_configuration_box',
			array( $this, 'render_settings_form' )
		);
	}

	public function render_settings_form(){
		?>
		<div class="wrap">
			<h2><?php _e('Configuration Box Settings', 'grid'); ?></h2>
			<pre><?php
				var_dump($this->plugin->container->getContentStructure());
				?></pre>
		</div>
		<?php
	}
}