<?php
/**
 * Plugin Name: Tx Responsive Slider 
 * Description: Tx Responsive Slider simple slider. Set it post & page useing shortcode
 * Plugin URI: https://themexpo.net
 * Author: Themexpo
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html 
 */

if ( ! defined('ABSPATH')) exit;  // if direct access 

require_once __DIR__ .'/vendor/autoload.php';

/**
 *  Main class
 */
final class txresponsiveslider
{
	
    /**
     * Plugin version
     *
     * @var string
     */

    const version = '1.0';

	function __construct()
	{
        $this->tx_responsive_define_constants();

        register_activation_hook( THEMEXPO_RESPONSIVE_FILE, [ $this, 'tx_responsive_activate' ] );

        add_action( 'plugins_loaded', [ $this, 'tx_responsive_init_plugin' ] );

	}

    /**
     * Define the required plugin constants
     *
     * @return void
     */ 
  
     public function tx_responsive_define_constants() {
        define( 'THEMEXPO_RESPONSIVE_VERSION', self::version );
        define( 'THEMEXPO_RESPONSIVE_FILE', __FILE__ );
        define( 'THEMEXPO_RESPONSIVE_PATH', __DIR__ );
        define( 'THEMEXPO_RESPONSIVE_URL', plugin_dir_url( __FILE__  ) );
    }
      
     /**
     * Initializes a singleton instance
     *
     * @return \WeDevs_Academy
     */

    public static function tx_responsive_slider_init() {
      static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    
    /**
     * Initialize the plugin
     *
     * @return void
     */

    public function tx_responsive_init_plugin() {
        
     if ( is_admin() ) {
            new themexpo\rkslide\AdminDashboardMain();

        } else {
            new themexpo\rkslide\FrontendResponsive();
        }
     }

    public function tx_responsive_activate() {

    $installed = get_option( 'themexpo_installed' );

    if ( ! $installed ) {
        update_option( 'themexpo_installed', time() );
    }

    update_option( 'themexpo_version', THEMEXPO_RESPONSIVE_VERSION );
    }

    
} /*End the class*/
 
 function tx_responsive_slider_show() {
    return txresponsiveslider::tx_responsive_slider_init();  
}

tx_responsive_slider_show(); 
