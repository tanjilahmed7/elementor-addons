<?php
namespace HubTagAddonsElementor\Widgets;


// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Widget_Base as Widget_Base;

class HT_Dual_Color_Header extends Widget_Base {

	public function get_name() {
		return 'ht-dual-color-header';
	}

	public function get_title() {
		return esc_html__( 'HT Dual Color Heading', 'hubtag-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-animated-headline';
	}

   public function get_categories() {
        return ['hubtag-elementor-addons'];
	}

	protected function _register_controls() {

  		/**
  		 * Dual Color Heading Content Settings
  		 */
  		$this->start_controls_section(
  			'ht_section_hub_content_settings',
  			[
  				'label' => esc_html__( 'Content Settings', 'hubtag-elementor-addons' )
  			]
  		);

  		$this->add_control(
		  'ht_hub_type',
		  	[
		   	'label'       	=> esc_html__( 'Content Style', 'hubtag-elementor-addons' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'hub-default',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'hub-default'  					=> esc_html__( 'Default', 'hubtag-elementor-addons' ),
		     		'hub-icon-on-top'  				=> esc_html__( 'Icon on top', 'hubtag-elementor-addons' ),
		     		'hub-icon-subtext-on-top'  	=> esc_html__( 'Icon &amp; sub-text on top', 'hubtag-elementor-addons' ),
		     		'hub-subtext-on-top'  			=> esc_html__( 'Sub-text on top', 'hubtag-elementor-addons' ),
		     	],
		  	]
		);

		$this->add_control(
			'ht_show_hub_icon_content',
			[
				'label' => __( 'Show Icon', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'hubtag-elementor-addons' ),
				'label_off' => __( 'Hide', 'hubtag-elementor-addons' ),
				'return_value' => 'yes',
				'separator' => 'after',
			]
		);
		/**
		 * Condition: 'ht_show_hub_icon_content' => 'yes'
		 */
		$this->add_control(
			'ht_hub_icon',
			[
				'label' => esc_html__( 'Icon', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-snowflake-o',
				'condition' => [
					'ht_show_hub_icon_content' => 'yes'
				]
			]
		);

		$this->add_control(
			'ht_hub_first_title',
			[
				'label' => esc_html__( 'Title ( First Part )', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Dual Heading', 'hubtag-elementor-addons' ),
				'dynamic' => [ 'action' => true ]
			]
		);

		$this->add_control(
			'ht_hub_last_title',
			[
				'label' => esc_html__( 'Title ( Last Part )', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Example', 'hubtag-elementor-addons' ),
				'dynamic' => [ 'action' => true ]
			]
		);

		$this->add_control(
			'ht_hub_subtext',
			[
				'label' => esc_html__( 'Sub Text', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => esc_html__( 'Insert a meaningful line to evaluate the headline.', 'hubtag-elementor-addons' )
			]
		);

		$this->add_responsive_control(
			'ht_hub_content_alignment',
			[
				'label' => esc_html__( 'Alignment', 'hubtag-elementor-addons' ),
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
				'default' => 'center',
				'prefix_class' => 'ht-dual-header-content-align-'
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style ( Dual Heading Style )
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_hub_style_settings',
			[
				'label' => esc_html__( 'Dual Heading Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ht_hub_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-dual-header' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ht_hub_container_padding',
			[
				'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-dual-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_responsive_control(
			'ht_hub_container_margin',
			[
				'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-dual-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ht_hub_border',
				'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ht-dual-header',
			]
		);

		$this->add_control(
			'ht_hub_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ht-dual-header' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ht_hub_shadow',
				'selector' => '{{WRAPPER}} .ht-dual-header',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Icon Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_hub_icon_style_settings',
			[
				'label' => esc_html__( 'Icon Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
		     		'ht_show_hub_icon_content' => 'yes'
		     	]
			]
		);

		$this->add_control(
    		'ht_hub_icon_size',
    		[
        		'label' => __( 'Icon Size', 'hubtag-elementor-addons' ),
       		'type' => Controls_Manager::SLIDER,
        		'default' => [
            	'size' => 36,
        		],
        		'range' => [
            	'px' => [
                	'min' => 20,
                	'max' => 100,
                	'step' => 1,
            	]
        		],
        		'selectors' => [
            	'{{WRAPPER}} .ht-dual-header i' => 'font-size: {{SIZE}}px;',
        		],
    		]
		);

		$this->add_control(
			'ht_hub_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .ht-dual-header i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Title Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_hub_title_style_settings',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ht_hub_title_heading',
			[
				'label' => esc_html__( 'Title Style', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ht_hub_base_title_color',
			[
				'label' => esc_html__( 'Main Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .ht-dual-header .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_hub_dual_title_color',
			[
				'label' => esc_html__( 'Dual Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1abc9c',
				'selectors' => [
					'{{WRAPPER}} .ht-dual-header .title span.lead' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'ht_hub_first_title_typography',
				'selector' => '{{WRAPPER}} .ht-dual-header .title, {{WRAPPER}} .ht-dual-header .title span',
			]
		);

		$this->add_control(
			'ht_hub_sub_title_heading',
			[
				'label' => esc_html__( 'Sub-title Style ', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'ht_hub_subtext_color',
			[
				'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .ht-dual-header .subtext' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'ht_hub_subtext_typography',
				'selector' => '{{WRAPPER}} .ht-dual-header .subtext',
			]
		);

		$this->end_controls_section();

	}

	protected function render( ) {

   	$settings = $this->get_settings_for_display();

	?>
	<?php if( 'hub-default' == $settings['ht_hub_type'] ) : ?>
	<div class="ht-dual-header">
		<h2 class="title"><span class="lead"><?php esc_html_e( $settings['ht_hub_first_title'], 'hubtag-elementor-addons' ); ?></span> <span><?php esc_html_e( $settings['ht_hub_last_title'], 'hubtag-elementor-addons' ); ?></span></h2>
	   <span class="subtext"><?php echo $settings['ht_hub_subtext']; ?></span>
	   <?php if( 'yes' == $settings['ht_show_hub_icon_content'] ) : ?>
	   	<i class="<?php echo esc_attr( $settings['ht_hub_icon'] ); ?>"></i>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php if( 'hub-icon-on-top' == $settings['ht_hub_type'] ) : ?>
	<div class="ht-dual-header">
		<?php if( 'yes' == $settings['ht_show_hub_icon_content'] ) : ?>
	   	<i class="<?php echo esc_attr( $settings['ht_hub_icon'] ); ?>"></i>
		<?php endif; ?>
		<h2 class="title"><span class="lead"><?php esc_html_e( $settings['ht_hub_first_title'], 'hubtag-elementor-addons' ); ?></span> <span><?php esc_html_e( $settings['ht_hub_last_title'], 'hubtag-elementor-addons' ); ?></span></h2>
	   <span class="subtext"><?php echo $settings['ht_hub_subtext']; ?></span>
	</div>
	<?php endif; ?>

	<?php if( 'hub-icon-subtext-on-top' == $settings['ht_hub_type'] ) : ?>
	<div class="ht-dual-header">
		<?php if( 'yes' == $settings['ht_show_hub_icon_content'] ) : ?>
	   	<i class="<?php echo esc_attr( $settings['ht_hub_icon'] ); ?>"></i>
		<?php endif; ?>
	   <span class="subtext"><?php echo $settings['ht_hub_subtext']; ?></span>
	   <h2 class="title"><span class="lead"><?php esc_html_e( $settings['ht_hub_first_title'], 'hubtag-elementor-addons' ); ?></span> <span><?php esc_html_e( $settings['ht_hub_last_title'], 'hubtag-elementor-addons' ); ?></span></h2>
	</div>
	<?php endif; ?>

	<?php if( 'hub-subtext-on-top' == $settings['ht_hub_type'] ) : ?>
	<div class="ht-dual-header">
	   <span class="subtext"><?php echo $settings['ht_hub_subtext']; ?></span>
			<h2 class="title"><span class="lead"><?php esc_html_e( $settings['ht_hub_first_title'], 'hubtag-elementor-addons' ); ?></span> <span><?php esc_html_e( $settings['ht_hub_last_title'], 'hubtag-elementor-addons' ); ?></span></h2>
		<?php if( 'yes' == $settings['ht_show_hub_icon_content'] ) : ?>
	   	<i class="<?php echo esc_attr( $settings['ht_hub_icon'] ); ?>"></i>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php
	}

	protected function content_template() {}
}