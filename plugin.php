<?php
namespace HubTagAddonsElementor;

use HubTagAddon\HubTag_Addons_Elementor;


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

	public static $register_elements;

	public $transient_elements;


	public function widget_registerd_elements(){

		self::$register_elements = [

			'ht-call-to-action'	=>	[
				'class'			=> 'HT_Call_To_Action',
				'dependency'	=> [
					'css'		=>	['call-to-action.css']
				]	
			],

			'ht-creative-button'	=>	[
				'class'			=> 'HT_Creative_Button',
				'dependency'	=> [
					'css'		=>	['creative-button.css']
				]	
			],
			
			'ht-data-table'	=>	[
				'class'			=> 'HT_Datatable',
				'dependency'	=> [
					'css'		=>	['vendor/datatable/datatables.min.css'],
					'js'		=>	[
										'vendor/datatable/datatables.min.js',
										'datatable/index.js',
									],
				]	
			],
			
			'ht-dual-color-header'	=>	[
				'class'			=> 'HT_Dual_Color_Header',
				'dependency'	=> [
					'css'		=>	['dual-color-heading.css'],
				]	
			],
			
			
			'ht-fancy-text'	=>	[
				'class'			=> 'HT_Fancy_Text',
				'dependency'	=> [
					'css'		=>	[
									'fancy-text.css',
									'vendor/animate.css'
									],
					'js'		=>	[
									  'fancy-text/index.js',
									  'vendor/fancy-text/fancy-text.js',
									  'vendor/fancy-text/morphext.js',
									  'vendor/fancy-text/typed.js',
									],
				]	
			],
			
			'ht-feature-list'	=>	[
				'class'			=> 'HT_Feature_List',
				'dependency'	=> [
					'css'		=>	[
									'feature-list.css'
									],
				]	
			],

			'ht-flip-box'	=>	[
				'class'			=> 'HT_Filp_Box',
				'dependency'	=> [
					'css'		=>	[
									'filp-box.css'
									],
				]	
			],

			'ht-filterable-gallery'	=>	[
				'class'			=> 'HT_Filterable_Gallery',
				'dependency'	=> [
					'css'		=>	[
									'filterable-gallery.css'
									],
					'js'		=> [
										'filter-gallery/index.js',
										'vendor/isotope/isotope.pkgd.min.js',
										'vendor/load-more/load-more.js',
									]					
				]	
			],

			'ht-image-accordion'	=>	[
				'class'			=> 'HT_Image_Accordion',
				'dependency'	=> [
					'css'		=>	[
									'image-accordion.css'
									],
					'js'		=> [
										'image-accordion/index.js',
									]					
				]	
			],
			
			'ht-info-box'	=>	[
				'class'			=> 'HT_Info_Box',
				'dependency'	=> [
					'css'		=>	[
									'info-box.css'
									],
					'js'		=> []					
				]	
			],
			
			'ht-price-table'	=>	[
				'class'			=> 'HT_Price_Table',
				'dependency'	=> [
					'css'		=>	[
									'price-table.css'
									],
					'js'		=> []					
				]	
			],

			'ht-progress-bar'	=>	[
				'class'			=> 'HT_Progress_Bar',
				'dependency'	=> [
					'css'		=>	[
									'progressbar.css'
									],
					'js'		=> [
									'progressbar/index.js'
								]					
				]	
			],
			
			'hubtag-slick-slider'	=>	[
				'class'			=> 'HT_Slider',
				'dependency'	=> [
					'css'		=>	[
									'vendor/slick/slick.css',
									'vendor/slick/slick-theme.css',
									'vendor/jquery.mb.vimeo_player.min.css',
									],
					'js'		=> [
									'vendor/slick/slick.min.js',
									'vendor/jquery.mb.YTPlayer.js',
									'slider/index.js',
								]					
				]	
			],

			'ht-tabs'	=>	[
				'class'			=> 'HT_Tabs',
				'dependency'	=> [
					'css'		=>	[
									'tabs.css',
									],
					'js'		=> [
									'tabs/index.js',
								]					
				]	
			],

			'ht-testimonials'	=>	[
				'class'			=> 'HT_Testimonials',
				'dependency'	=> [
					'css'		=>	[
									'testimonials.css',
									'vendor/slick/slick.css',
									'vendor/slick/slick-theme.css',									
									],
					'js'		=> [
									'testimonials/index.js',
									'vendor/slick/slick.min.js',									
								]					
				]	
			],

			'ht-tooltip'	=>	[
				'class'			=> 'HT_ToolTip',
				'dependency'	=> [
					'css'		=>	[
									'tooltip.css',
									],
					'js'		=> [
									'testimonials/index.js',
								]					
				]	
			],

			'ht-countdown'	=>	[
				'class'			=> 'HT_Countdown',
				'dependency'	=> [
					'css'		=>	[
									'countdown.css',
									],
					'js'		=> [
									'countdown/index.js',
									'vendor/count-down/count-down.min.js',
									'vendor/count-down/countdown.js',
								]					
				]	
			],
		];
		
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

		$this->widget_registerd_elements();
		$register = self::$register_elements;

		foreach($register as $getClassName){
		// 	// includes in flies
			require_once( __DIR__ . '/widgets/module/'. $getClassName['class'] .'.php' );
			// Register Widgets
			$class = '\HubTagAddonsElementor\Widgets\\'. $getClassName['class'];
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class );
		}

	}

	/**
     * Collect elements in a page or post
     *
     * @since 3.0.0
     */
	
    public function collect_transient_elements($widget)
    {
		$this->transient_elements[] = $widget->get_name();

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

		$this->widget_registerd_elements();
		$register = self::$register_elements;
		
		if(!empty($this->transient_elements)){
			$value = $this->transient_elements;
			
			$allcomponent = array_keys($register);
			$applycss = array_intersect($value, $allcomponent);
			$uniquecss = array_unique($applycss);
			
			foreach($uniquecss as $value){
				$listed = $register[$value];
				foreach ($listed['dependency']['css'] as  $value) {
					$css_id = strtolower($listed['class']).uniqid();
					wp_register_style( $css_id, plugins_url( '/assets/css/'.$value, __FILE__ ), array(), HubTag_Addons_Elementor::VERSION, 'all');
					wp_enqueue_style ( $css_id );
				}
			}

		}

	}
	
	public function preview_widget_styles(){
		$this->widget_registerd_elements();
		$register = self::$register_elements;
		foreach ($register as $elements_style_data){
			foreach($elements_style_data['dependency']['css'] as $rowstyle){
			// echo $rowstyle.'<br>';
			$css_id = strtolower($elements_style_data['class']).uniqid();
			wp_register_style( $css_id, plugins_url( '/assets/css/'.$rowstyle, __FILE__ ), array(), HubTag_Addons_Elementor::VERSION, 'all');
			wp_enqueue_style ( $css_id );
			}
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
		$this->widget_registerd_elements();
		$register = self::$register_elements;

				
		if(!empty($this->transient_elements)){
			$value = $this->transient_elements;
			
			$allcomponent = array_keys($register);
			$applyjs = array_intersect($value, $allcomponent);
			$uniquejs = array_unique($applyjs);
			
		
			foreach($uniquejs as $value){
				$listed = $register[$value];
				if(!empty($listed['dependency']['js'])){
					foreach ($listed['dependency']['js'] as  $value) {
						$js_id = strtolower($listed['class']).uniqid();
						wp_register_script( $js_id, plugins_url( '/assets/js/'.$value, __FILE__ ), [ 'jquery' ], HubTag_Addons_Elementor::VERSION, true ); 
						wp_enqueue_script ( $js_id );		
					}
				}

			}

		}
	
	}


	public function preview_widget_scripts() { 

		$this->widget_registerd_elements();
		$register = self::$register_elements;
		
		foreach ($register as $elements_js_data){
			if(!empty($elements_js_data['dependency']['js'])){
				foreach($elements_js_data['dependency']['js'] as $rowscript){

					$js_id = strtolower($elements_js_data['class']).uniqid();
					wp_register_script( $js_id, plugins_url( '/assets/js/'.$rowscript, __FILE__ ), [ 'jquery' ], HubTag_Addons_Elementor::VERSION, true ); 
					wp_enqueue_script ( $js_id );					
				}
			}
		}

	
	}

	public function add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'hubtag-elementor-addons',   // the name of the category
			[
				'title' => esc_html__( 'HubTag Elements', 'hubtag' ),
				'icon' => 'fa fa-header', //default icon
			]
		);

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
		add_action( 'elementor/frontend/before_enqueue_styles', [ $this, 'widget_styles' ] );

		add_action( 'elementor/preview/init', [ $this, 'preview_widget_styles' ] );
		
		
		// Register widget scripts
		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'widget_scripts' ] );
		add_action( 'elementor/preview/init', [ $this, 'preview_widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Register Widget Categories
		add_action( 'elementor/elements/categories_registered', [$this,'add_elementor_widget_categories']);


		add_action('elementor/frontend/before_render', array($this, 'collect_transient_elements'));
		// add_action('loop_end', array($this, 'generate_frontend_scripts'));
		
	}
}

// Instantiate Plugin Class
Plugin::instance();
