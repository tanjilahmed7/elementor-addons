<?php
namespace HubTagAddonsElementor;

use HubTagAddon\HubTag_Addons_Elementor;

// Add a custom category for panel widgets
add_action( 'elementor/init', function() {
	\Elementor\Plugin::$instance->elements_manager->add_category( 
		'hubtag-elements',                 // the name of the category
		[
			'title' => esc_html__( 'HubTag Elements', 'hubtag' ),
			'icon' => 'fa fa-header', //default icon
		],
		1 // position
	);
 } );

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	
	/**
	 * widget_styles
	 *
	 * Register required plugin core files Load only on preview mod.
	 *
	 * @since 1.2.0
	 * @access public
	 */

	public function widget_styles() {
		wp_register_style( 'hubtag-slick', plugins_url( '/assets/css/slick.css', __FILE__ ), array(), HubTag_Addons_Elementor::VERSION, 'all');
		wp_register_style( 'hubtag-slick-theme', plugins_url( '/assets/css/slick-theme.css', __FILE__ ), array(), HubTag_Addons_Elementor::VERSION, 'all');
		wp_register_style( 'hubtag-animate', plugins_url( '/assets/css/animate.css', __FILE__ ), array(), HubTag_Addons_Elementor::VERSION, 'all');
		wp_register_style( 'hubtag-vimeoPlayer', plugins_url( '/assets/css/jquery.mb.vimeo_player.min.css', __FILE__ ), array(), HubTag_Addons_Elementor::VERSION, 'all');
		wp_register_style( 'hubtag-slick-style', plugins_url( '/assets/css/style.css', __FILE__ ), array('hubtag-slick', 'hubtag-slick-theme', 'hubtag-animate', 'hubtag-vimeoPlayer'), HubTag_Addons_Elementor::VERSION, 'all');
		if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			wp_enqueue_style( 'hubtag-elemnentor-slick' );
			wp_enqueue_style( 'hubtag-slick-theme' );
			wp_enqueue_style( 'hubtag-slick-style' );
			wp_enqueue_style( 'hubtag-animate' );
			wp_enqueue_style( 'hubtag-vimeoPlayer' );
		}
	}
	

	/**
	 * widget_scripts
	 *
	 * Register required plugin core files and Load only on preview mod.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() { 
		wp_register_script( 'hubtag-slick', plugins_url( '/assets/js/slick.min.js', __FILE__ ), [ 'jquery' ], HubTag_Addons_Elementor::VERSION, true ); 
		wp_register_script( 'hubtag-YTPlayer', plugins_url( '/assets/js/jquery.mb.YTPlayer.js', __FILE__ ), [ 'jquery' ], HubTag_Addons_Elementor::VERSION, true ); 
		wp_register_script( 'hubtag-vimeoPlayer', plugins_url( '/assets/js/jquery.mb.vimeo_player.min.js', __FILE__ ), [ 'jquery' ], HubTag_Addons_Elementor::VERSION, true ); 
		wp_register_script( 'hubtag-custom-slick', plugins_url( '/assets/js/slick-slider-elementor.js', __FILE__ ), [ 'jquery', 'hubtag-slick', 'hubtag-slick', 'hubtag-vimeoPlayer' ], HubTag_Addons_Elementor::VERSION, true );
		if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			wp_enqueue_script ( 'hubtag-slick' ); 
			wp_enqueue_script ( 'hubtag-YTPlayer' ); 
			wp_enqueue_script ( 'hubtag-vimeoPlayer' ); 
			wp_enqueue_script ( 'hubtag-custom-slick' );
		}
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin scripts on front-end.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public static function widget_scripts_load() {  
		wp_enqueue_style( 'hubtag-elemnentor-slick' );
		wp_enqueue_style( 'hubtag-slick-theme' );
		wp_enqueue_style( 'hubtag-animate' );
		wp_enqueue_style( 'hubtag-vimeoPlayer' );
		wp_enqueue_style( 'hubtag-slick-style' );

		wp_enqueue_script ( 'hubtag-slick' ); 
		wp_enqueue_script ( 'hubtag-YTPlayer' ); 
		wp_enqueue_script ( 'hubtag-vimeoPlayer' ); 
		wp_enqueue_script ( 'hubtag-custom-slick' );
	}

	
	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/module/slick-slider.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Slick_Slider() );
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */

	 
	public function __construct() {

		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'widget_scripts_load']);

	}
}

// Instantiate Plugin Class
Plugin::instance();
