<?php
namespace HubTagAddonsElementor\Widgets;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Frontend;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Scheme_Typography as Scheme_Typography;
use \Elementor\Widget_Base as Widget_Base;
use HubTagAddonsElementor\Widgets\Inc\Helper as Helper;
class HT_Countdown extends Widget_Base {
	use Helper;

	public function get_name() {
		return 'ht-countdown';
	}

	public function get_title() {
		return esc_html__( 'HT Countdown', 'hubtag-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-countdown';
	}

   public function get_categories() {
        return ['hubtag-elementor-addons'];
	}
	
	
	protected function _register_controls() {

		
  		$this->start_controls_section(
  			'ht_section_countdown_settings_general',
  			[
  				'label' => esc_html__( 'Timer Settings', 'hubtag-elementor-addons' )
  			]
  		);
		
		$this->add_control(
			'ht_countdown_due_time',
			[
				'label' => esc_html__( 'Countdown Due Date', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DATE_TIME,
				'default' => date("Y-m-d", strtotime("+ 1 day")),
				'description' => esc_html__( 'Set the due date and time', 'hubtag-elementor-addons' ),
			]
		);

		$this->add_control(
			'ht_countdown_label_view',
			[
				'label' => esc_html__( 'Label Position', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ht-countdown-label-block',
				'options' => [
					'ht-countdown-label-block' => esc_html__( 'Block', 'hubtag-elementor-addons' ),
					'ht-countdown-label-inline' => esc_html__( 'Inline', 'hubtag-elementor-addons' ),
				],
			]
		);

		$this->add_responsive_control(
			'ht_countdown_label_padding_left',
			[
				'label' => esc_html__( 'Left spacing for Labels', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'description' => esc_html__( 'Use when you select inline labels', 'hubtag-elementor-addons' ),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-label' => 'padding-left:{{SIZE}}px;',
				],
				'condition' => [
					'ht_countdown_label_view' => 'ht-countdown-label-inline',
				],
			]
		);


		$this->end_controls_section();


  		$this->start_controls_section(
  			'ht_section_countdown_settings_content',
  			[
  				'label' => esc_html__( 'Content Settings', 'hubtag-elementor-addons' )
  			]
  		);

  		$this->add_control(
		  'ht_section_countdown_style',
		  	[
		   	'label'       	=> esc_html__( 'Countdown Style', 'hubtag-elementor-addons' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'style-1',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'style-1'  	=> esc_html__( 'Style 1', 'hubtag-elementor-addons' ),
		     		'style-2' 	=> esc_html__( 'Style 2', 'hubtag-elementor-addons' ),
		     		'style-3' 	=> esc_html__( 'Style 3', 'hubtag-elementor-addons' ),
		     	],
		  	]
		);


		$this->add_control(
			'ht_countdown_days',
			[
				'label' => esc_html__( 'Display Days', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'ht_countdown_days_label',
			[
				'label' => esc_html__( 'Custom Label for Days', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Days', 'hubtag-elementor-addons' ),
				'description' => esc_html__( 'Leave blank to hide', 'hubtag-elementor-addons' ),
				'condition' => [
					'ht_countdown_days' => 'yes',
				],
			]
		);
		

		$this->add_control(
			'ht_countdown_hours',
			[
				'label' => esc_html__( 'Display Hours', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'ht_countdown_hours_label',
			[
				'label' => esc_html__( 'Custom Label for Hours', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Hours', 'hubtag-elementor-addons' ),
				'description' => esc_html__( 'Leave blank to hide', 'hubtag-elementor-addons' ),
				'condition' => [
					'ht_countdown_hours' => 'yes',
				],
			]
		);

		$this->add_control(
			'ht_countdown_minutes',
			[
				'label' => esc_html__( 'Display Minutes', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'ht_countdown_minutes_label',
			[
				'label' => esc_html__( 'Custom Label for Minutes', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Minutes', 'hubtag-elementor-addons' ),
				'description' => esc_html__( 'Leave blank to hide', 'hubtag-elementor-addons' ),
				'condition' => [
					'ht_countdown_minutes' => 'yes',
				],
			]
		);
			
		$this->add_control(
			'ht_countdown_seconds',
			[
				'label' => esc_html__( 'Display Seconds', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'ht_countdown_seconds_label',
			[
				'label' => esc_html__( 'Custom Label for Seconds', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Seconds', 'hubtag-elementor-addons' ),
				'description' => esc_html__( 'Leave blank to hide', 'hubtag-elementor-addons' ),
				'condition' => [
					'ht_countdown_seconds' => 'yes',
				],
			]
		);

		$this->add_control(
			'ht_countdown_separator_heading',
			[
				'label' => __( 'Countdown Separator', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ht_countdown_separator',
			[
				'label' => esc_html__( 'Display Separator', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'ht-countdown-show-separator',
				'default' => '',
			]
		);

		$this->add_control(
			'ht_countdown_separator_color',
			[
				'label' => esc_html__( 'Separator Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'ht_countdown_separator' => 'ht-countdown-show-separator',
				],
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-digits::after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'ht_countdown_separator_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .ht-countdown-digits::after',
				'condition' => [
					'ht_countdown_separator' => 'ht-countdown-show-separator',
				],
			]
		);


		$this->end_controls_section();
		

		$this->start_controls_section(
			'countdown_on_expire_settings',
			[
				'label' => esc_html__( 'Expire Action' , 'hubtag-elementor-addons' )
			]
		);

		$this->add_control(
			'countdown_expire_type',
			[
				'label'			=> esc_html__('Expire Type', 'hubtag-elementor-addons'),
				'label_block'	=> false,
				'type'			=> Controls_Manager::SELECT,
                'description'   => esc_html__('Choose whether if you want to set a message or a redirect link', 'hubtag-elementor-addons'),
				'options'		=> [
					'none'		=> esc_html__('None', 'hubtag-elementor-addons'),
					'text'		=> esc_html__('Message', 'hubtag-elementor-addons'),
					'url'		=> esc_html__('Redirection Link', 'hubtag-elementor-addons'),
					'template'		=> esc_html__('Saved Templates', 'hubtag-elementor-addons')
				],
				'default'		=> 'none'
			]
		);

		$this->add_control(
			'countdown_expiry_text_title',
			[
				'label'			=> esc_html__('On Expiry Title', 'hubtag-elementor-addons'),
				'type'			=> Controls_Manager::TEXTAREA,
				'default'		=> esc_html__('Countdown is finished!','hubtag-elementor-addons'),
				'condition'		=> [
					'countdown_expire_type' => 'text'
				]
			]
		);

		$this->add_control(
			'countdown_expiry_text',
			[
				'label'			=> esc_html__('On Expiry Content', 'hubtag-elementor-addons'),
				'type'			=> Controls_Manager::WYSIWYG,
				'default'		=> esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s','hubtag-elementor-addons'),
				'condition'		=> [
					'countdown_expire_type' => 'text'
				]
			]
		);

		$this->add_control(
			'countdown_expiry_redirection',
			[
				'label'			=> esc_html__('Redirect To (URL)', 'hubtag-elementor-addons'),
				'type'			=> Controls_Manager::TEXT,
				'condition'		=> [
					'countdown_expire_type' => 'url'
				],
				'default'		=> '#'
			]
		);

		$this->add_control(
            'countdown_expiry_templates',
            [
                'label'                 => __( 'Choose Template', 'hubtag-elementor-addons' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => $this->ht_get_page_templates(),
				'condition'             => [
					'countdown_expire_type'      => 'template',
				],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'ht_section_countdown_styles_general',
			[
				'label' => esc_html__( 'Countdown Styles', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'ht_countdown_background',
			[
				'label' => esc_html__( 'Box Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-item > div' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ht_countdown_spacing',
			[
				'label' => esc_html__( 'Space Between Boxes', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-item > div' => 'margin-right:{{SIZE}}px; margin-left:{{SIZE}}px;',
					'{{WRAPPER}} .ht-countdown-container' => 'margin-right: -{{SIZE}}px; margin-left: -{{SIZE}}px;',
				],
				'condition' => [
					'ht_section_countdown_style' => ['style-1', 'style-3']
				]
			]
		);
		
		$this->add_responsive_control(
			'ht_countdown_container_margin_bottom',
			[
				'label' => esc_html__( 'Space Below Container', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-container' => 'margin-bottom:{{SIZE}}px;',
				],
			]
		);
		
		$this->add_responsive_control(
			'ht_countdown_box_padding',
			[
				'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-item > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ht_countdown_box_border',
				'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ht-countdown-item > div',
			]
		);

		$this->add_control(
			'ht_countdown_box_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-item > div' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ht_countdown_box_shadow',
				'selector' => '{{WRAPPER}} .ht-countdown-item > div',
			]
		);

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'ht_section_countdown_styles_content',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ht_countdown_digits_heading',
			[
				'label' => __( 'Countdown Digits', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ht_countdown_digits_color',
			[
				'label' => esc_html__( 'Digits Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fec503',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-digits' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'ht_countdown_digit_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .ht-countdown-digits',
			]
		);

		$this->add_control(
			'ht_countdown_label_heading',
			[
				'label' => __( 'Countdown Labels', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ht_countdown_label_color',
			[
				'label' => esc_html__( 'Label Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-label' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'ht_countdown_label_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .ht-countdown-label',
			]
		);		


		$this->end_controls_section();


		
		$this->start_controls_section(
			'ht_section_countdown_styles_individual',
			[
				'label' => esc_html__( 'Individual Box Styling', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ht_countdown_days_label_heading',
			[
				'label' => __( 'Days', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ht_countdown_days_background_color',
			[
				'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-item > div.ht-countdown-days' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_days_digit_color',
			[
				'label' => esc_html__( 'Digit Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-days .ht-countdown-digits' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_days_label_color',
			[
				'label' => esc_html__( 'Label Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-days .ht-countdown-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_days_border_color',
			[
				'label' => esc_html__( 'Border Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-item > div.ht-countdown-days' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_hours_label_heading',
			[
				'label' => __( 'Hours', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ht_countdown_hours_background_color',
			[
				'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-item > div.ht-countdown-hours' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_hours_digit_color',
			[
				'label' => esc_html__( 'Digit Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-hours .ht-countdown-digits' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_hours_label_color',
			[
				'label' => esc_html__( 'Label Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-hours .ht-countdown-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_hours_border_color',
			[
				'label' => esc_html__( 'Border Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-item > div.ht-countdown-hours' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_minutes_label_heading',
			[
				'label' => __( 'Minutes', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ht_countdown_minutes_background_color',
			[
				'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-item > div.ht-countdown-minutes' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_minutes_digit_color',
			[
				'label' => esc_html__( 'Digit Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-minutes .ht-countdown-digits' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_minutes_label_color',
			[
				'label' => esc_html__( 'Label Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-minutes .ht-countdown-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_minutes_border_color',
			[
				'label' => esc_html__( 'Border Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-item > div.ht-countdown-minutes' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_seconds_label_heading',
			[
				'label' => __( 'Seconds', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ht_countdown_seconds_background_color',
			[
				'label'		=> esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-item > div.ht-countdown-seconds' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_seconds_digit_color',
			[
				'label'		=> esc_html__( 'Digit Color', 'hubtag-elementor-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-seconds .ht-countdown-digits' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_seconds_label_color',
			[
				'label'		=> esc_html__( 'Label Color', 'hubtag-elementor-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .ht-countdown-seconds .ht-countdown-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_countdown_seconds_border_color',
			[
				'label'		=> esc_html__( 'Border Color', 'hubtag-elementor-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .ht-countdown-item > div.ht-countdown-seconds' => 'border-color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();

		
		$this->start_controls_section(
			'ht_section_countdown_expire_style',
			[
				'label'	=> esc_html__( 'Expire Message', 'hubtag-elementor-addons' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'countdown_expire_type'	=> 'text'
				]
			]
		);

		$this->add_responsive_control(
			'ht_countdown_expire_message_alignment',
			[
				'label' => esc_html__( 'Text Alignment', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-finish-message' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_ht_countdown_expire_title',
			[
				'label'		=> __( 'Title Style', 'hubtag-elementor-addons' ),
				'type'		=> Controls_Manager::HEADING,
				'separator'	=> 'before'
			]
		);

		$this->add_control(
			'ht_countdown_expire_title_color',
			[
				'label'		=> esc_html__( 'Title Color', 'hubtag-elementor-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .ht-countdown-finish-message .expiry-title' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'countdown_expire_type' => 'text',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name'			=> 'ht_countdown_expire_title_typography',
				'scheme'	=> Scheme_Typography::TYPOGRAPHY_2,
				'selector'	=> '{{WRAPPER}} .ht-countdown-finish-message .expiry-title',
				'condition'	=> [
					'countdown_expire_type' => 'text',
				],
			]
		);

		$this->add_responsive_control(
			'ht_expire_title_margin',
			[
				'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ht-countdown-finish-message .expiry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'heading_ht_countdown_expire_message',
			[
				'label'		=> __( 'Content Style', 'hubtag-elementor-addons' ),
				'type'		=> Controls_Manager::HEADING,
				'separator'	=> 'before'
			]
		);

		$this->add_control(
			'ht_countdown_expire_message_color',
			[
				'label'		=> esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .ht-countdown-finish-text' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'countdown_expire_type' => 'text',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name'			=> 'ht_countdown_expire_message_typography',
				'scheme'	=> Scheme_Typography::TYPOGRAPHY_2,
				'selector'	=> '.ht-countdown-finish-text',
				'condition'	=> [
					'countdown_expire_type' => 'text',
				],
			]
		);

		$this->add_responsive_control(
			'ht_countdown_expire_message_padding',
			[
				'label'			=> esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', '%', 'em' ],
				'separator'		=> 'before',
				'selectors'		=> [
					'{{WRAPPER}} .ht-countdown-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'countdown_expire_type' => 'text',
				],
			]
		);

		$this->end_controls_section();
		

	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		
		$get_due_date =  esc_attr($settings['ht_countdown_due_time']);
		$due_date = date("M d Y G:i:s", strtotime($get_due_date));
		if( 'style-1' === $settings['ht_section_countdown_style'] ) {
			$ht_countdown_style = 'style-1';
		}elseif( 'style-2' === $settings['ht_section_countdown_style'] ) {
			$ht_countdown_style = 'style-2';
		}elseif( 'style-3' === $settings['ht_section_countdown_style'] ) {
			$ht_countdown_style = 'style-3';
		}

		if( 'template' == $settings['countdown_expire_type'] ) {
			if ( !empty( $settings['countdown_expiry_templates'] ) ) {
				$ht_template_id = $settings['countdown_expiry_templates'];
				$ht_frontend = new Frontend;
				$template =  $ht_frontend->get_builder_content( $ht_template_id, true );
			}
		}
		
		$this->add_render_attribute( 'ht-countdown', 'class', 'ht-countdown-wrapper' );
		$this->add_render_attribute( 'ht-countdown', 'data-countdown-id', esc_attr($this->get_id()) );
		$this->add_render_attribute( 'ht-countdown', 'data-expire-type', $settings['countdown_expire_type'] );

        if ( $settings['countdown_expire_type'] == 'text' ) {
			if( ! empty($settings['countdown_expiry_text']) ) {
				$this->add_render_attribute( 'ht-countdown', 'data-expiry-text', wp_kses_post($settings['countdown_expiry_text']) );
			}
			   
			if( ! empty($settings['countdown_expiry_text_title']) ) {
				$this->add_render_attribute('ht-countdown', 'data-expiry-title', wp_kses_post($settings['countdown_expiry_text_title']) );
			}
        }
        elseif ( $settings['countdown_expire_type'] == 'url' ) {
			$this->add_render_attribute( 'ht-countdown', 'data-redirect-url', $settings['countdown_expiry_redirection'] );
        }
        elseif ( $settings['countdown_expire_type'] == 'template' ) {
			$this->add_render_attribute( 'ht-countdown', 'data-template', esc_attr($template) );
        }
        else {
           //do nothing
        }

	?>

	<div <?php echo $this->get_render_attribute_string( 'ht-countdown' ); ?>>
		<div class="ht-countdown-container <?php echo esc_attr($settings['ht_countdown_label_view'] ); ?> <?php echo esc_attr($settings['ht_countdown_separator'] ); ?>">
			<ul id="ht-countdown-<?php echo esc_attr($this->get_id()); ?>" class="ht-countdown-items <?php echo esc_attr( $ht_countdown_style ); ?>" data-date="<?php echo esc_attr($due_date) ; ?>">
			    <?php if ( ! empty( $settings['ht_countdown_days'] ) ) : ?><li class="ht-countdown-item"><div class="ht-countdown-days"><span data-days class="ht-countdown-digits">00</span><?php if ( ! empty( $settings['ht_countdown_days_label'] ) ) : ?><span class="ht-countdown-label"><?php echo esc_attr($settings['ht_countdown_days_label'] ); ?></span><?php endif; ?></div></li><?php endif; ?>
			    <?php if ( ! empty( $settings['ht_countdown_hours'] ) ) : ?><li class="ht-countdown-item"><div class="ht-countdown-hours"><span data-hours class="ht-countdown-digits">00</span><?php if ( ! empty( $settings['ht_countdown_hours_label'] ) ) : ?><span class="ht-countdown-label"><?php echo esc_attr($settings['ht_countdown_hours_label'] ); ?></span><?php endif; ?></div></li><?php endif; ?>
			   <?php if ( ! empty( $settings['ht_countdown_minutes'] ) ) : ?><li class="ht-countdown-item"><div class="ht-countdown-minutes"><span data-minutes class="ht-countdown-digits">00</span><?php if ( ! empty( $settings['ht_countdown_minutes_label'] ) ) : ?><span class="ht-countdown-label"><?php echo esc_attr($settings['ht_countdown_minutes_label'] ); ?></span><?php endif; ?></div></li><?php endif; ?>
			   <?php if ( ! empty( $settings['ht_countdown_seconds'] ) ) : ?><li class="ht-countdown-item"><div class="ht-countdown-seconds"><span data-seconds class="ht-countdown-digits">00</span><?php if ( ! empty( $settings['ht_countdown_seconds_label'] ) ) : ?><span class="ht-countdown-label"><?php echo esc_attr($settings['ht_countdown_seconds_label'] ); ?></span><?php endif; ?></div></li><?php endif; ?>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<?php
	
	}

	protected function content_template() {}
}