<?php
namespace HubTagAddonsElementor\Widgets;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Scheme_Typography as Scheme_Typography;
use \Elementor\Widget_Base as Widget_Base;
use \Elementor\Repeater;

class HT_Fancy_Text extends Widget_Base {


	public function get_name() {
		return 'ht-fancy-text';
	}

	public function get_title() {
		return esc_html__( 'HT Fancy Text', 'hubtag-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-animation-text';
	}

    public function get_categories() {
		return [ 'hubtag-elementor-addons' ]; // category of the widget
	}

	protected $allowed_html = array(
		'strong' => array(
			'style' => array()
		),
		'span' => array(
			'style' => array()
		),
		'em' => array(
			'style' => array()
		),
		'a' => array(
			'href' => array(),
			'style' => array()
		),
	);

	protected function _register_controls() {

		// Content Controls
  		$this->start_controls_section(
  			'ht_fancy_text_content',
  			[
  				'label' => esc_html__( 'Fancy Text', 'hubtag-elementor-addons' )
  			]
  		);


		$this->add_control(
			'ht_fancy_text_prefix',
			[
				'label' => esc_html__( 'Prefix Text', 'hubtag-elementor-addons' ),
				'placeholder' => esc_html__( 'Place your prefix text', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'This is the ', 'hubtag-elementor-addons' ),
				'dynamic' => [ 'active' => true ]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'ht_fancy_text_strings_text_field',
			[
				'label'			=> esc_html__( 'Fancy String', 'hubtag-elementor-addons' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> true,
				'dynamic'		=> [ 'active' => true ]
			]
		);

		$this->add_control(
			'ht_fancy_text_strings',
			[
				'label'       => __( 'Fancy Text Strings', 'hubtag-elementor-addons' ),
				'type'        => Controls_Manager::REPEATER,
				'show_label'  => true,
				'fields'      => array_values( $repeater->get_controls() ),
				'title_field' => '{{{ ht_fancy_text_strings_text_field }}}',
				'default'     => [
					[
						'ht_fancy_text_strings_text_field' => __( 'First string', 'hubtag-elementor-addons' ),
					],
					[
						'ht_fancy_text_strings_text_field' => __( 'Second string', 'hubtag-elementor-addons' ),
					],
					[
						'ht_fancy_text_strings_text_field' => __( 'Third string', 'hubtag-elementor-addons' ),
					]
				],
			]
		);

		$this->add_control(
			'ht_fancy_text_suffix',
			[
				'label' => esc_html__( 'Suffix Text', 'hubtag-elementor-addons' ),
				'placeholder' => esc_html__( 'Place your suffix text', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( ' of the sentence.', 'hubtag-elementor-addons' ),
				'dynamic' => [ 'active' => true ]
			]
		);

		$this->end_controls_section();

		// Settings Control
  		$this->start_controls_section(
  			'ht_fancy_text_settings',
  			[
  				'label' => esc_html__( 'Fancy Text Settings', 'hubtag-elementor-addons' )
  			]
		);
		




		$this->add_responsive_control(
			'ht_fancy_text_alignment',
			[
				'label' => esc_html__( 'Alignment', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .ht-fancy-text-container' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ht_fancy_text_transition_type',
			[
				'label' => esc_html__( 'Animation Type', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'typing',
				'options' => [
					'typing'      => esc_html__( 'Typing', 'hubtag-elementor-addons' ),
					'fadeIn'      => esc_html__( 'Fade', 'hubtag-elementor-addons' ),
					'fadeInUp'    => esc_html__( 'Fade Up', 'hubtag-elementor-addons' ),
					'fadeInDown'  => esc_html__( 'Fade Down', 'hubtag-elementor-addons' ),
					'fadeInLeft'  => esc_html__( 'Fade Left', 'hubtag-elementor-addons' ),
					'fadeInRight' => esc_html__( 'Fade Right', 'hubtag-elementor-addons' ),
					'zoomIn'      => esc_html__( 'Zoom', 'hubtag-elementor-addons' ),
					'bounceIn'    => esc_html__( 'Bounce', 'hubtag-elementor-addons' ),
					'swing'       => esc_html__( 'Swing', 'hubtag-elementor-addons' ),
				],
			]
		);


		$this->add_control(
			'ht_fancy_text_speed',
			[
				'label' => esc_html__( 'Typing Speed', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '50',
				'condition' => [
					'ht_fancy_text_transition_type' => 'typing',
				],
			]
		);

		$this->add_control(
			'ht_fancy_text_delay',
			[
				'label' => esc_html__( 'Delay on Change', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '2500'
			]
		);

		$this->add_control(
			'ht_fancy_text_loop',
			[
				'label' => esc_html__( 'Loop the Typing', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'ht_fancy_text_transition_type' => 'typing',
				],
			]
		);

		$this->add_control(
			'ht_fancy_text_cursor',
			[
				'label' => esc_html__( 'Display Type Cursor', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'ht_fancy_text_transition_type' => 'typing',
				],
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'ht_fancy_text_prefix_styles',
			[
				'label' => esc_html__( 'Prefix Text Styles', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ht_fancy_text_prefix_color',
			[
				'label' => esc_html__( 'Prefix Text Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ht-fancy-text-prefix' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ht-fancy-text-prefix',
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'ht_fancy_text_strings_styles',
			[
				'label' => esc_html__( 'Fancy Text Styles', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ht_fancy_text_strings_color',
			[
				'label' => esc_html__( 'Fancy Text Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ht-fancy-text-strings' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'ht_fancy_text_strings_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ht-fancy-text-strings, {{WRAPPER}} .typed-cursor',
			]
		);

		$this->add_control(
			'ht_fancy_text_strings_background_color',
			[
				'label' => esc_html__( 'Background', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-fancy-text-strings' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_fancy_text_cursor_color',
			[
				'label' => esc_html__( 'Typing Cursor Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .typed-cursor' => 'color: {{VALUE}};',
				],
				'condition' => [
					'ht_fancy_text_cursor' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'ht_fancy_text_strings_padding',
			[
				'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ht-fancy-text-strings' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ht_fancy_text_strings_margin',
			[
				'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ht-fancy-text-strings' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ht_fancy_text_strings_border',
				'selector' => '{{WRAPPER}} .ht-fancy-text-strings',
			]
		);

		$this->add_control(
			'ht_fancy_text_strings_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ht-fancy-text-strings' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'ht_fancy_text_suffix_styles',
			[
				'label' => esc_html__( 'Suffix Text Styles', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ht_fancy_text_suffix_color',
			[
				'label' => esc_html__( 'Suffix Text Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ht-fancy-text-suffix' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'ending_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ht-fancy-text-suffix',
			]
		);


		$this->end_controls_section();

	}

	public function fancy_text($settings) {
		$fancy_text = array();
		foreach ( $settings as $item ) {
			if ( ! empty( $item['ht_fancy_text_strings_text_field'] ) )  {
				$fancy_text[] = $item['ht_fancy_text_strings_text_field'] ;
			}
		}
		$fancy_text = implode("|",$fancy_text);
		return $fancy_text;
	}

	protected function render( ) {


	  $settings = $this->get_settings_for_display();
	  $fancy_text = $this->fancy_text($settings['ht_fancy_text_strings']);


	  $this->add_render_attribute( 'fancy-text', 'class', 'ht-fancy-text-container' );
	
	  $this->add_render_attribute( 'fancy-text', 'data-fancy-text-id', esc_attr($this->get_id()) );
	  $this->add_render_attribute( 'fancy-text', 'data-fancy-text', $fancy_text );
	  $this->add_render_attribute( 'fancy-text', 'data-fancy-text-transition-type', $settings['ht_fancy_text_transition_type'] );
	  $this->add_render_attribute( 'fancy-text', 'data-fancy-text-speed', $settings['ht_fancy_text_speed'] );
	  $this->add_render_attribute( 'fancy-text', 'data-fancy-text-delay', $settings['ht_fancy_text_delay'] );
	  $this->add_render_attribute( 'fancy-text', 'data-fancy-text-cursor', $settings['ht_fancy_text_cursor'] );
	  $this->add_render_attribute( 'fancy-text', 'data-fancy-text-loop', $settings['ht_fancy_text_loop'] );
	?>

	<div  <?php echo $this->get_render_attribute_string( 'fancy-text' ); ?> >
		<?php if ( ! empty( $settings['ht_fancy_text_prefix'] ) ) : ?>
			<span class="ht-fancy-text-prefix"><?php echo wp_kses(($settings['ht_fancy_text_prefix'] ), $this->allowed_html ); ?> </span>
		<?php endif; ?>

		<?php if ( $settings['ht_fancy_text_transition_type']  == 'fancy' ) : ?>
			<span id="ht-fancy-text-<?php echo esc_attr($this->get_id()); ?>" class="ht-fancy-text-strings"></span>
		<?php endif; ?>

		<?php if ( $settings['ht_fancy_text_transition_type']  != 'fancy' ) : ?>
			<span id="ht-fancy-text-<?php echo esc_attr($this->get_id()); ?>" class="ht-fancy-text-strings"><?php
				$ht_fancy_text_strings_list = "";
				foreach ( $settings['ht_fancy_text_strings'] as $item ) {
					$ht_fancy_text_strings_list .=  $item['ht_fancy_text_strings_text_field'] . ', ';
				}
				echo rtrim($ht_fancy_text_strings_list, ", "); ?>
			</span>
		<?php endif; ?>

		<?php if ( ! empty( $settings['ht_fancy_text_suffix'] ) ) : ?>
			<span class="ht-fancy-text-suffix"> <?php echo wp_kses(($settings['ht_fancy_text_suffix'] ), $this->allowed_html ); ?></span>
		<?php endif; ?>
	</div><!-- close .ht-fancy-text-container -->

	<div class="clearfix"></div>

	<?php

	}

	protected function content_template() {}
}