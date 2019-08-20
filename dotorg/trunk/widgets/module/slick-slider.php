<?php
namespace HubTagAddonsElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use \HubTagAddonsElementor\Plugin;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Slick Slider
 *
 * Elementor widget for Slick Slider.
 *
 * @since 1.0.0
 */

class Slick_Slider extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'hubtag-slick-slider';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'HT Slider', 'hubtag-slick-slider' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-picture-o';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'hubtag-elements' ]; // category of the widget
	}


	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'hubtag-slick-slider' ];
	}


	public static function get_button_sizes() {
		return [
			'xs' => __( 'Extra Small', 'hubtag' ),
			'sm' => __( 'Small', 'hubtag' ),
			'md' => __( 'Medium', 'hubtag' ),
			'lg' => __( 'Large', 'hubtag' ),
			'xl' => __( 'Extra Large', 'hubtag' ),
		];
	}


	public static function get_content_effects() {
		$contentEffect = array('None', 'bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','jello','heartBeat','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceOut','bounceOutDown','bounceOutLeft','bounceOutRight','bounceOutUp','fadeIn','fadeInDown','fadeInDownBig','fadeInLeft','fadeInLeftBig','fadeInRight','fadeInRightBig','fadeInUp','fadeInUpBig','fadeOut','fadeOutDown','fadeOutDownBig','fadeOutLeft','fadeOutLeftBig','fadeOutRight','fadeOutRightBig','fadeOutUp','fadeOutUpBig','flip','flipInX','flipInY','flipOutX','flipOutY','lightSpeedIn','lightSpeedOut','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','rotateOut','rotateOutDownLeft','rotateOutDownRight','rotateOutUpLeft','rotateOutUpRight','slideInUp','slideInDown','slideInLeft','slideInRight','slideOutUp','slideOutDown','slideOutLeft','slideOutRight','zoomIn','zoomInDown','zoomInLeft','zoomInRight','zoomInUp','zoomOut','zoomOutDown','zoomOutLeft','zoomOutRight','zoomOutUp','hinge','jackInTheBox','rollIn','rollOut');
		$newContentEffect = [];
		foreach($contentEffect as $effect ){
			$newContentEffect[$effect] = __( ucfirst($effect), 'hubtag' );
		} 
		return $newContentEffect;
	}


	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_slides',
			[
				'label' => __( 'Slides', 'hubtag' ),
			]
		);

		$repeater = new Repeater(); 

		$repeater->start_controls_tabs( 'slides_repeater' );

		$repeater->start_controls_tab( 'background', [ 'label' => __( 'Background', 'hubtag' ) ] );

		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'hubtag-pro' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'default' => 'classic',	
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		); 

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'content', [ 'label' => __( 'Content', 'hubtag' ) ] );

		$repeater->add_control(
			'heading',
			[
				'label' => __( 'Title & Description', 'hubtag' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Slide Heading', 'hubtag' ),
				'label_block' => true,
			]
		); 

		$repeater->add_control(
			'description',
			[
				'label' => __( 'Description', 'hubtag' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'hubtag' ),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'hubtag' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'hubtag' ),
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'hubtag' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'hubtag' ),
			]
		);

		

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'style', [ 'label' => __( 'Style', 'hubtag' ) ] );

		$repeater->add_control(
			'custom_style',
			[
				'label' => __( 'Custom', 'hubtag' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => __( 'Set custom style that will only affect this specific slide.', 'hubtag' ),
			]
		);

		$repeater->add_control(
			'bg_overlay_color',
			[
				'label' => __( 'Background Overlay', 'hubtag' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.5)', 
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider  {{CURRENT_ITEM}} .slide-content-wrapper, .vimeo_player_overlay' => 'background-color: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],				
			]
		);

		$repeater->add_control(
			'horizontal_position',
			[
				'label' => __( 'Horizontal Position', 'hubtag' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'flex-start' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'hubtag' ),
						'icon' => 'eicon-h-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider {{CURRENT_ITEM}} .slide-content-wrapper' => 'justify-content:{{VALUE}}',
				], 
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

	

		$repeater->add_control(
			'text_align',
			[
				'label' => __( 'Text Align', 'hubtag' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'hubtag' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'hubtag' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'hubtag' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider {{CURRENT_ITEM}} .slide-content-wrapper .slide-inner-content' => 'text-align: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_responsive_control(
			'content_max_width',
			[
				'label' => __( 'Content Width', 'hubtag' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'default' => [
					'size' => '77',
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider {{CURRENT_ITEM}} .slide-content-wrapper .slide-inner-content' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'title_color',
			[
				'label' => __( 'Heading Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider {{CURRENT_ITEM}} .slide-content-wrapper .slide-inner-content .title' => 'color: {{VALUE}}', 
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'content_color',
			[
				'label' => __( 'Description Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider {{CURRENT_ITEM}} .slide-content-wrapper .slide-inner-content .description' => 'color: {{VALUE}}', 

				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'button_text_color',
			[
				'label' => __( 'Button Text Color', 'hubtag' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff', 
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider  {{CURRENT_ITEM}} .slide-content-wrapper .slide-inner-content .btn_warp .btn' => 'color: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],				
			]
		);

		$repeater->add_control(
			'button_background_color',
			[
				'label' => __( 'Button Background Color', 'hubtag' ),
				'type' => Controls_Manager::COLOR,
				'default' 	=> '', 
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider {{CURRENT_ITEM}} .slide-content-wrapper .slide-inner-content .btn_warp .btn' => 'background-color: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],				
			]
		);

		$repeater->add_control(
			'button_border_color',
			[
				'label' => __( 'Button Border Color', 'hubtag' ),
				'type' => Controls_Manager::COLOR,
				'default' =>'#fff', 
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider {{CURRENT_ITEM}} .slide-content-wrapper .slide-inner-content .btn_warp .btn' => 'border-color: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],				
			]
		);

		$repeater->add_control(
			'button_hover_text_color',
			[
				'label' => __( 'Button Hover Text Color', 'hubtag' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff', 
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider {{CURRENT_ITEM}} .slide-content-wrapper .slide-inner-content .btn_warp .btn:hover' => 'color: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],				
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'slides',
			[
				'label' => __( 'Slides', 'hubtag' ),
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'heading' => __( 'Slide 1 Heading', 'hubtag' ),
						'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'hubtag' ),
						'button_text' => __( 'Click Here', 'hubtag' ),
						'background_background'	=> 'classic',
						'background_color' => '#833ca3',
					],
					[
						'heading' => __( 'Slide 2 Heading', 'hubtag' ),
						'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'hubtag' ),
						'button_text' => __( 'Click Here', 'hubtag' ),
						'background_background'	=> 'classic',
						'background_color' => '#4054b2',
					],
					[
						'heading' => __( 'Slide 3 Heading', 'hubtag' ),
						'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'hubtag' ),
						'button_text' => __( 'Click Here', 'hubtag' ),
						'background_background'	=> 'classic',
						'background_color' => '#72820a',
					],
				],
				'title_field' => '{{{ heading }}}',
			]
		);

		

		$this->end_controls_section();

		// Slider Options Settings
		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => __( 'Slider Options', 'hubtag' ),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'slider',
			[
				'label' => __( 'Slider', 'hubtag' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'single-item',
				'options' => [
					'single-item' => __( 'Single Item', 'hubtag' ),
					'multiple-item' => __( 'Multiple Items', 'hubtag' )
				],
				'frontend_available' => true,
			]
		);


		$slides_to_show = range( 1, 10 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label' => __( 'Slides to Show', 'hubtag' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'hubtag' ),
				] + $slides_to_show,
				'default' => '2',
				'condition' => [
					'slider!' => 'single-item',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'slides_to_scroll',
			[
				'label' => __( 'Slides to Scroll', 'hubtag' ),
				'type' => Controls_Manager::SELECT,
				'description' => __( 'Set how many slides are scrolled per swipe.', 'hubtag' ),
				'default' => '1',
				'options' => $slides_to_show,
				'condition' => [
					'slides_to_show!' => '1',
					'slider!' => 'single-item',
				],
				'frontend_available' => true,
			]
		);


		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'hubtag' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => __( 'Arrows and Dots', 'hubtag' ),
					'arrows' => __( 'Arrows', 'hubtag' ),
					'dots' => __( 'Dots', 'hubtag' ),
					'none' => __( 'None', 'hubtag' ),
				],
			]
		);

		$this->add_control(
			'center_mode',
			[
				'label' => __( 'Center Mode', 'hubtag' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no', 
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'Pause on Hover', 'hubtag' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'hubtag' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'hubtag' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => __( 'Infinite Loop', 'hubtag' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'transition',
			[
				'label' => __( 'Transition', 'hubtag' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'hubtag' ),
					'fade' => __( 'Fade', 'hubtag' ),
				],
			]
		);

		$this->add_control(
			'transition_speed',
			[
				'label' => __( 'Transition Speed (ms)', 'hubtag' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);
		
		$this->add_control(
			'content_animation',
			[
				'label' => __( 'Content Animation', 'hubtag' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => $this->get_content_effects(),
			]
		);

		$this->end_controls_section();

		// Slider Options Settings for mobile responsive
		$this->start_controls_section(
			'slider_responsive_options_mobile',
			[
				'label' => __( 'Responsive Options ( Mobile )', 'hubtag' ),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'slides_breakpoint_mb',
			[
				'label' => __( 'Mobile Breakpoint ', 'hubtag' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				], 
				'default' => [
					'size' => 500,
					'unit' => 'px',
				],
			]
		);  

		$this->add_control(
			'navigation_mb',
			[
				'label' => __( 'Navigation', 'hubtag' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => __( 'Arrows and Dots', 'hubtag' ),
					'arrows' => __( 'Arrows', 'hubtag' ),
					'dots' => __( 'Dots', 'hubtag' ),
					'none' => __( 'None', 'hubtag' ),
				],
			]
		);

		$this->add_control(
			'center_mode_mb',
			[
				'label' => __( 'Center Mode', 'hubtag' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no', 
			]
		);

		$this->add_control(
			'pause_on_hover_mb',
			[
				'label' => __( 'Pause on Hover', 'hubtag' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_mb',
			[
				'label' => __( 'Autoplay', 'hubtag' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed_mb',
			[
				'label' => __( 'Autoplay Speed', 'hubtag' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
				'condition' => [
					'autoplay' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
			]
		);

		$this->add_control(
			'infinite_mb',
			[
				'label' => __( 'Infinite Loop', 'hubtag' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();


		// Slider Options Settings
		$this->start_controls_section(
			'slider_responsive_options_tablet',
			[
				'label' => __( 'Responsive Options ( Tablet )', 'hubtag' ),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'slides_breakpoint_tb',
			[
				'label' => __( 'Tablet Breakpoint ', 'hubtag' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				], 
				'default' => [
					'size' => 767,
					'unit' => 'px',
				],
			]
		);

		$this->add_responsive_control(
			'slides_to_show_tb',
			[
				'label' => __( 'Slides to Show', 'hubtag' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'hubtag' ),
				] + $slides_to_show,
				'default' => '1', 
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'slides_to_scroll_tb',
			[
				'label' => __( 'Slides to Scroll', 'hubtag' ),
				'type' => Controls_Manager::SELECT,
				'description' => __( 'Set how many slides are scrolled per swipe.', 'hubtag' ),
				'default' => '1',
				'options' => $slides_to_show, 
				'frontend_available' => true,
			]
		);


		$this->add_control(
			'navigation_tb',
			[
				'label' => __( 'Navigation', 'hubtag' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => __( 'Arrows and Dots', 'hubtag' ),
					'arrows' => __( 'Arrows', 'hubtag' ),
					'dots' => __( 'Dots', 'hubtag' ),
					'none' => __( 'None', 'hubtag' ),
				],
			]
		);

		$this->add_control(
			'center_mode_tb',
			[
				'label' => __( 'Center Mode', 'hubtag' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no', 
			]
		);

		$this->add_control(
			'pause_on_hover_tb',
			[
				'label' => __( 'Pause on Hover', 'hubtag' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_tb',
			[
				'label' => __( 'Autoplay', 'hubtag' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed_tb',
			[
				'label' => __( 'Autoplay Speed', 'hubtag' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
				'condition' => [
					'autoplay' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
			]
		);

		$this->add_control(
			'infinite_tb',
			[
				'label' => __( 'Infinite Loop', 'hubtag' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_slides',
			[
				'label' => __( 'Slides', 'hubtag' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slides_height',
			[
				'label' => __( 'Height', 'hubtag' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 400,
				],
				'size_units' => [ 'px', 'vh', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-item' => 'height: {{SIZE}}{{UNIT}}  !important;',
					'{{WRAPPER}} .hubtag-slick-slider .slide-item .hubtag-background-video-embed-player' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'content_max_width',
			[
				'label' => __( 'Content Width', 'hubtag' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'default' => [
					'size' => '66',
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-item .slide-inner-content' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_padding',
			[
				'label' => __( 'Padding', 'hubtag' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'slides_horizontal_position',
			[
				'label' => __( 'Horizontal Position', 'hubtag' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'hubtag' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'hubtag' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'hubtag' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'hubtag--h-position-',
			]
		);

		$this->add_control(
			'slides_vertical_position',
			[
				'label' => __( 'Vertical Position', 'hubtag' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'middle',
				'options' => [
					'top' => [
						'title' => __( 'Top', 'hubtag' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'hubtag' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'hubtag' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'hubtag--v-position-',
			]
		);

		$this->add_control(
			'slides_text_align',
			[
				'label' => __( 'Text Align', 'hubtag' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'hubtag' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'hubtag' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'hubtag' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'hubtag' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_spacing',
			[
				'label' => __( 'Spacing', 'hubtag' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

	

		$this->add_control(
			'heading_color',
			[
				'label' 	=> __( 'Text Color', 'hubtag' ),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '#fff',
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .title' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_description',
			[
				'label' => __( 'Description', 'hubtag' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_spacing',
			[
				'label' => __( 'Spacing', 'hubtag' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .description' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

	
		$this->add_control(
			'description_color',
			[
				'label' 	=> __( 'Text Color', 'hubtag' ),
				'type' 		=> Controls_Manager::COLOR, 
				'default' 	=> '#fff',
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .description' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __( 'Button', 'hubtag' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		

		$this->add_responsive_control(
			'button_padding',
			[

				'label' => __( 'Button Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 5,
					'right' => 20,
					'bottom' => 5,
					'left' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .btn_warp .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'selector' 	=> '{{WRAPPER}} .hubtag-slide-button',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_4,
				'selector'	=> '{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .btn_warp .btn'
			]
		);

		$this->add_control(
			'button_border_width',
			[
				'label' => __( 'Border Width', 'hubtag' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'default' => [
					'size' => 2,
				], 
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .btn_warp .btn' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_border_style',
			[
				'label' => __( 'Border Style', 'hubtag' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid' 	=> __( 'Solid', 'hubtag' ),
					'dotted' 	=> __( 'dotted', 'hubtag' ),
					'dashed' 	=> __( 'dashed', 'hubtag' ),
					'double' 	=> __( 'double', 'hubtag' ),
					'groove' 	=> __( 'groove', 'hubtag' ),
					'ridge' 	=> __( 'ridge', 'hubtag' ),
					'inset' 	=> __( 'inset', 'hubtag' ),
					'outset' 	=> __( 'outset', 'hubtag' ),
				],
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .btn_warp .btn' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'hubtag' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .btn_warp .btn' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		
		// Strat Button Style Tab Controls
		$this->start_controls_tabs( 'button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => __( 'Normal', 'hubtag' ) ] );

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'hubtag' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff', 
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .btn_warp .btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => __( 'Background Color', 'hubtag' ),
				'type' => Controls_Manager::COLOR,
				'default' 	=> '', 
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .btn_warp .btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'Border Color', 'hubtag' ),
				'type' => Controls_Manager::COLOR,
				'default' =>'#fff', 
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .btn_warp .btn' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover', [ 'label' => __( 'Hover', 'hubtag' ) ] );

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => __( 'Text Color', 'hubtag' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee', 
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .btn_warp .btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_background_color',
			[
				'label' => __( 'Background Color', 'hubtag' ),
				'type' => Controls_Manager::COLOR,
				'default' 	=> '', 
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .btn_warp .btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'hubtag' ),
				'type' => Controls_Manager::COLOR,
				'default' => '', 
				'selectors' => [
					'{{WRAPPER}} .hubtag-slick-slider .slide-content-wrapper .slide-inner-content .btn_warp .btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		// End Button Style Tabs Controls

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function sliderInnerContentHtml($singleSlide){
		$SliderHeading 					= $singleSlide['heading'];
		$SliderDescription 				= $singleSlide['description'];  
		$slideContentCustomCss 			= ''; 
		$output 						= '';


		$output .= '<div class="slide-content-wrapper">';
			$output .= '<div class="slide-inner-content">';
				$output .= '<h3 class="title">'.$SliderHeading.'</h3>';
				$output .= '<p class="description">'.$SliderDescription.'</p>';
				if($singleSlide['link']['is_external'] == 'on'){
					$output .= '<div class="btn_warp"><a class="btn" href="'.$singleSlide['link']['url'].'" target="_blank">'.$singleSlide['button_text'].'</a></div>';
				}else {
					$output .= '<div class="btn_warp"><a class="btn" href="'.$singleSlide['link']['url'].'">'.$singleSlide['button_text'].'</a></div>';
				} 
			$output .= '</div>';
		$output .= '</div>';
		return $output;
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		Plugin::widget_scripts_load();
		$settings = $this->get_settings_for_display();
		
		$config = [
			'sliderType' 			=> $settings['slider'], 
			'slidesToShow'			=> $settings['slides_to_show'],  
			'slidesToScroll'		=> $settings['slides_to_scroll'], 
			'navigation'			=> $settings['navigation'],
			'pause_on_hover'		=> $settings['pause_on_hover'],
			'autoplay' 				=> $settings['autoplay'],
			'autoplay_speed' 		=> !empty($settings['autoplay_speed']) ? $settings['autoplay_speed'] : 5000,
			'infinite' 				=> $settings['infinite'],
			'transition' 			=> $settings['transition'], 
			'transition_speed' 		=> $settings['transition_speed'], 
			'content_animation' 	=> $settings['content_animation'],
			'centerMode'			=> $settings['center_mode'],

			'slides_breakpoint_mb' 	=> $settings['slides_breakpoint_mb'],
			'navigation_mb' 		=> $settings['navigation_mb'],
			'center_mode_mb' 		=> $settings['center_mode_mb'],
			'pause_on_hover_mb' 	=> $settings['pause_on_hover_mb'],
			'autoplay_mb' 			=> $settings['autoplay_mb'],
			'autoplay_speed_mb' 	=> !empty($settings['autoplay_speed_mb']) ? $settings['autoplay_speed_mb'] : 5000,
			'infinite_mb' 			=> $settings['infinite_mb'],

			'slides_breakpoint_tb' 	=> $settings['slides_breakpoint_tb'],
			'slides_to_show_tb' 	=> $settings['slides_to_show_tb'],
			'slides_to_scroll_tb' 	=> $settings['slides_to_scroll_tb'],
			'navigation_tb' 		=> $settings['navigation_tb'],
			'center_mode_tb' 		=> $settings['center_mode_tb'],
			'pause_on_hover_tb' 	=> $settings['pause_on_hover_tb'],
			'autoplay_tb' 			=> $settings['autoplay_tb'],
			'autoplay_speed_tb' 	=> !empty($settings['autoplay_speed_tb']) ? $settings['autoplay_speed_tb'] : 5000,
			'infinite_tb' 			=> $settings['infinite_tb'],
		];
		$config = wp_json_encode($config); 
		
		?> 

		<!-- Slider Wapper -->
		<section class="vertical-center hubtag-slick-slider navigation-<?php echo $settings['navigation']; ?>" data-config='<?php echo $config; ?>'>
			<?php
				if ( !empty($settings) && isset($settings['slides']) ) {
					$htmlOutput = '';
					foreach ($settings['slides'] as $singleSlide ) {

						$BackgroundImage 				= $singleSlide['background_image']['url'];
						$BackgroundSize 				= $singleSlide['background_size'];
						$Background_Background 			= $singleSlide['background_background'];
						$BackgroundColor1 				= $singleSlide['background_color'];
						$BackgroundColor2 				= $singleSlide['background_color_b'];
						$BackgroundPosition 			= $singleSlide['background_position'];
						$BackgroundAttachment 			= $singleSlide['background_attachment'];
						$BackgroundRepeat 				= $singleSlide['background_repeat'];
						$backgroundSize 				= $singleSlide['background_size'];						
						$Background_Gradient_Type 		= $singleSlide['background_gradient_type'];
						$Background_Gradient_Position 	= $singleSlide['background_gradient_position'];
						$SliderHeightSize 				= $settings['slides_height']['size'];
						$SliderHeightUnit 				= $settings['slides_height']['unit'];
						$colorAL						= $singleSlide['background_color_stop']['size'].$singleSlide['background_color_stop']['unit']; 
						$colorBL						= $singleSlide['background_color_b_stop']['size'].$singleSlide['background_color_b_stop']['unit']; 
						$colorAG						= $singleSlide['background_gradient_angle']['size'].$singleSlide['background_gradient_angle']['unit'];

						$slideItemCss = ''; 
						$slideItemCss .= 'height:'.$SliderHeightSize.$SliderHeightUnit.';';
						if ( ($Background_Background == 'classic') || ( $Background_Background == '') ) {  
							if (!empty($BackgroundImage)) {
								$slideItemCss .= 'background-image: url('.$BackgroundImage.');';
								$slideItemCss .= 'background-repeat: '.$BackgroundRepeat.';';
								$slideItemCss .= 'background-position: '.$BackgroundPosition.';';
								$slideItemCss .= 'background-size: '.$backgroundSize.';'; 
							}else {
								$slideItemCss .= 'background-color: '.$BackgroundColor1.';';
							}  
							$htmlOutput .= '<div class="slide-item slide-item-'.$singleSlide['_id'].' elementor-repeater-item-'.$singleSlide['_id'].'" style="'.$slideItemCss.'" >';
								$htmlOutput .= $this->sliderInnerContentHtml($singleSlide);
							$htmlOutput .= '</div>';
						}elseif ($Background_Background == 'gradient') {
							if($Background_Gradient_Type == 'radial'){
								$colorRP = $Background_Gradient_Position;
								$slideItemCss .= 'background-image: radial-gradient(circle at '.$colorRP.', '.$BackgroundColor1.' '.$colorAL.', '.$BackgroundColor2.' '.$colorBL.');';
							}else {
								$slideItemCss .= 'background-image: linear-gradient('.$colorAG.', '.$BackgroundColor1.' '.$colorAL.', '.$BackgroundColor2.' '.$colorBL.');';
							}  
							$htmlOutput .= '<div class="slide-item slide-item-'.$singleSlide['_id'].' elementor-repeater-item-'.$singleSlide['_id'].'" style="'.$slideItemCss.'" >';
								$htmlOutput .= $this->sliderInnerContentHtml($singleSlide);
							$htmlOutput .= '</div>';
						}elseif($Background_Background == 'video' && !empty($singleSlide['background_video_link']) ){
							$startTime 	= !empty($singleSlide['background_video_start']) ? $singleSlide['background_video_start'] : 0 ;
							$endTime 	= !empty($singleSlide['background_video_end']) ? $singleSlide['background_video_end'] : 0 ;
							$videoPlayerOptions = [
								'videoURL'		=> $singleSlide['background_video_link'],  
								'containment' 	=>'#'.$singleSlide['_id'], 
								'showControls'	=> false, 
								'autoPlay'		=> true, 
								'loop'			=> true, 
								'mute'			=> true,  
								'opacity'		=> 1, 
								'addRaster'		=> false, 
								'quality'		=> 'hd720', 
								'ratio' 		=> 'auto',
								
								
							];
							
							if( !empty($singleSlide['background_video_fallback']['url']) ){ 
								$videoPlayerOptions['mobileFallbackImage'] = $singleSlide['background_video_fallback']['url'];
							}
							if( !empty($singleSlide['background_video_start']) ){
								$videoPlayerOptions['startAt'] = $startTime; 
							}
							if( !empty($singleSlide['background_video_end'])){ 
								$videoPlayerOptions['stopAt'] = $endTime;
							}
							
							if(strpos($singleSlide['background_video_link'], 'vimeo.com') > 0){
								$videoPlayerOptions['optimizeDisplay'] 	= true; 
								$videoPlayerOptions['printUrl'] 		= false;
								$videoPlayerOptions['vol'] 				= 30;
								$videoPlayerOptions['realfullscreen'] 	= true;
								$videoPlayerOptions['gaTrack'] 			= false;
								$videoPlayerOptions['stopMovieOnBlur'] 	= false;   
							}
							
							$videoPlayerOptions = wp_json_encode($videoPlayerOptions );
							
							//var_dump($videoPlayerOptions); 
							$htmlOutput .= '<div id="'.$singleSlide['_id'].'" class="slide-item slide-item-'.$singleSlide['_id'].' elementor-repeater-item-'.$singleSlide['_id'].'">';
								if(strpos($singleSlide['background_video_link'], 'vimeo.com')> 0){
									$htmlOutput .= '<div id="'.$singleSlide['_id'].'" class="hubtag-background-vimeo-embed-player">';
									$htmlOutput .= '<div id="" class="hubtag-background-video-embed" data-videotype="vimeo" data-property=\''.$videoPlayerOptions.'\'></div>';
									$htmlOutput .= '</div>';
								}else{
									$htmlOutput .= '<div id="'.$singleSlide['_id'].'" class="hubtag-background-video-embed-player" style="height: 600px; width: 100%; position: relative; background-color: #333" ></div>';
									$htmlOutput .= '<div class="hubtag-background-video-embed" data-videotype="youtube" data-property=\''.$videoPlayerOptions.'\'></div>';
								}
								$htmlOutput .= $this->sliderInnerContentHtml($singleSlide);
							$htmlOutput .= '</div>';
						}else {
							$htmlOutput .= '<div class="slide-item slide-item-'.$singleSlide['_id'].' elementor-repeater-item-'.$singleSlide['_id'].'" style="'.$slideItemCss.'" >';
								$htmlOutput .= $this->sliderInnerContentHtml($singleSlide);
							$htmlOutput .= '</div>';
						}
						
					} 
					echo $htmlOutput;

				}
			?> 
		</section>

		<?php			
	}  

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */

	protected function _content_template() {
		?>
			<#
				var config = {
					sliderType 				: settings.slider, 
					slidesToShow 			: settings.slides_to_show, 
					slidesToScroll 			: settings.slides_to_scroll, 
					navigation 				: settings.navigation,
					pause_on_hover 			: settings.pause_on_hover,
					autoplay 				: settings.autoplay,
					autoplay_speed 			: settings.autoplay_speed,
					infinite 				: settings.infinite,
					transition 				: settings.transition, 
					transition_speed 		: settings.transition_speed, 
					content_animation 		: settings.content_animation, 
					centerMode				: settings.center_mode,

					slides_breakpoint_mb	:	settings.slides_breakpoint_mb,  
					navigation_mb			:	settings.navigation_mb, 
					center_mode_mb			:	settings.center_mode_mb, 
					pause_on_hover_mb		:	settings.pause_on_hover_mb, 
					autoplay_mb				:	settings.autoplay_mb, 
					autoplay_speed_mb		:	settings.autoplay_speed_mb, 
					infinite_mb				:	settings.infinite_mb, 

					slides_breakpoint_tb	:	settings.slides_breakpoint_tb, 
					slides_to_show_tb		:	settings.slides_to_show_tb, 
					slides_to_scroll_tb		:	settings.slides_to_scroll_tb,
					navigation_tb			:	settings.navigation_tb, 
					center_mode_tb			:	settings.center_mode_tb, 
					pause_on_hover_tb		:	settings.pause_on_hover_tb, 	
					autoplay_tb				:	settings.autoplay_tb, 
					autoplay_speed_tb		:	settings.autoplay_speed_tb, 
					infinite_tb				:	settings.infinite_tb
					
				};
				config = JSON.stringify(config);

				

			#>
			
			<section class="vertical-center hubtag-slick-slider" data-config='{{{ config }}}'>
				<# 

					// display slider inner content
					function sliderInnerContent(slide){  
						#>
							<div class="slide-content-wrapper">
								<div class="slide-inner-content">
									<h3 class="title">{{{ slide.heading }}}</h3>
									<p class="description">{{{ slide.description }}}</p>
									<div class="btn_warp"><a class="btn button-{{{ settings.button_size }}}" href="{{{ slide.link.url }}}" target="_blank">{{{ slide.button_text }}}</a></div>
								</div>
							</div>
						<#
					}

					settings.slides.forEach(function(slide, index, array) {

						if( ( slide.background_background == "classic" ) ||  (slide.background_background == "") ){
						  	if(slide.background_image.url){
							  	#>
							  		<div class="slide-item slide-item-{{ slide._id }} elementor-repeater-item-{{ slide._id }}" style="
							  		background-image: url({{{ slide.background_image.url }}});
							  		background-repeat: {{{ slide.background_repeat }}};
							  		background-position: {{{ slide.background_position }}};
							  		background-size: {{{ slide.background_size }}};
							  		"> 
										
										<# sliderInnerContent(slide); #>
									</div>
							  	<#
							}else {
	  							#>
							  		<div  class="slide-item slide-item-{{ slide._id }} elementor-repeater-item-{{ slide._id }}" style="
							  		background-color: {{{ slide.background_color }}}; 
							  		"> 
									  <div class="bg-control"></div>
							  			<# sliderInnerContent(slide); #>
									</div>
							  	<#
							}
						}else if(slide.background_background == "gradient"){
							var gradientColor 	= "",
								colorA 			= slide.background_color,
								colorB 			= slide.background_color_b,
								colorAL			= slide.background_color_stop.size + slide.background_color_stop.unit, 
								colorBL			= slide.background_color_b_stop.size + slide.background_color_b_stop.unit, 
								colorAG			= slide.background_gradient_angle.size + slide.background_gradient_angle.unit;

							if(slide.background_gradient_type == "radial"){
								var colorRP = slide.background_gradient_position;
								gradientColor = 'radial-gradient(circle at '+colorRP+', '+colorA+' '+colorAL+ ', '+colorB+' '+colorBL+')';
							}else {
								gradientColor = 'linear-gradient('+colorAG+', '+colorA+' '+colorAL+ ', '+colorB+' '+colorBL+')';
							}  
							#>
						  		<div class="slide-item slide-item-{{ slide._id }} elementor-repeater-item-{{ slide._id }}" style="
						  		background-image: {{{ gradientColor }}};
						  		background-repeat: {{{ slide.background_repeat }}};
						  		background-position: {{{ slide.background_position }}};
						  		background-size: {{{ slide.background_size }}};
						  		"> 
									<# sliderInnerContent(slide); #>
								</div>
						  	<#
						}else if( slide.background_background == "video" &&  slide.background_video_link !== '' ){ 
							var videoUrlIsvimeo = slide.background_video_link.search(/vimeo.com/);
							if(videoUrlIsvimeo <= 0){
								var  url 		= new URL(slide.background_video_link),
									urlParams  = new URLSearchParams(url.search),
									ytCode		= urlParams.get('v');
							}

							var videoPlayerOptions = {
								videoURL: ytCode,containment:'#'+slide._id, 
								showControls:false, autoPlay:true, loop:true, 
								mute:true, opacity:1, addRaster:false, 
								quality:'hd720', ratio : 'auto'
								
							};
							if(slide.background_video_fallback.url !== ''){
								videoPlayerOptions.mobileFallbackImage = slide.background_video_fallback.url; 
							}
							if(slide.background_video_start !== ''){
								videoPlayerOptions.startAt = slide.background_video_start; 
							}
							if(slide.background_video_end !== ''){ 
								videoPlayerOptions.stopAt = slide.background_video_end;
							}
							if(videoUrlIsvimeo > 0){
								videoPlayerOptions.videoURL 		= slide.background_video_link;
								videoPlayerOptions.optimizeDisplay 	= true;
								videoPlayerOptions.printUrl        	= false;
								videoPlayerOptions.realfullscreen  	= true;
								videoPlayerOptions.gaTrack  		= false;
								videoPlayerOptions.stopMovieOnBlur  = false;
								#>
									<div  class="slide-item slide-item-{{ slide._id }} elementor-repeater-item-{{ slide._id }}"> 
										<div id="{{ slide._id }}" class="hubtag-background-vimeo-embed-player">
											<div id="" class="hubtag-background-video-embed player"  data-videotype="vimeo" data-property='{{ JSON.stringify(videoPlayerOptions) }}' >My video</div>
										</div>
										<# sliderInnerContent(slide); #>
									</div>
								<# 
							}else{
								#>
									<div  class="slide-item slide-item-{{ slide._id }} elementor-repeater-item-{{ slide._id }}"> 
											<div id="{{slide._id}}" class="hubtag-background-video-embed-player" style="height: 600px; width: 100%; position: relative; background-color : #333 " ></div>
											<div class="hubtag-background-video-embed" data-videotype="youtube" data-property='{{ JSON.stringify(videoPlayerOptions) }}'></div>
											<# sliderInnerContent(slide); #>
									</div>
								<# 
							}
						}

					});
				#> 
			</section>
		<?php
	}

}