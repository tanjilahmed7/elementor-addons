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
use \Elementor\Scheme_Typography as Scheme_Typography;
use \Elementor\Widget_Base as Widget_Base;

class HT_Creative_Button extends Widget_Base {
	

	public function get_name() {
		return 'ht-creative-button';
	}

	public function get_title() {
		return esc_html__( 'HT Creative Button', 'hubtag-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

   public function get_categories() {
        return ['hubtag-elementor-addons'];
	}


	protected function _register_controls() {

		// Content Controls
  		$this->start_controls_section(
  			'ht_section_creative_button_content',
  			[
  				'label' => esc_html__( 'Button Content', 'hubtag-elementor-addons' )
  			]
  		);


		$this->add_control(
			'creative_button_text',
			[
				'label' => __( 'Button Text', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Click Me!',
				'placeholder' => __( 'Enter button text', 'hubtag-elementor-addons' ),
				'title' => __( 'Enter button text here', 'hubtag-elementor-addons' ),
			]
		);

		$this->add_control(
			'creative_button_secondary_text',
			[
				'label' => __( 'Button Secondary Text', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Go!',
				'placeholder' => __( 'Enter button secondary text', 'hubtag-elementor-addons' ),
				'title' => __( 'Enter button secondary text here', 'hubtag-elementor-addons' ),
			]
		);


		$this->add_control(
			'creative_button_link_url',
			[
				'label' => esc_html__( 'Link URL', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
        			'url' => '#',
        			'is_external' => '',
     			],
     			'show_external' => true,
			]
		);

		$this->add_control(
			'ht_creative_button_icon',
			[
				'label' => esc_html__( 'Icon', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::ICON,
			]
		);

		$this->add_control(
			'ht_creative_button_icon_alignment',
			[
				'label' => esc_html__( 'Icon Position', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'hubtag-elementor-addons' ),
					'right' => esc_html__( 'After', 'hubtag-elementor-addons' ),
				],
				'condition' => [
					'ht_creative_button_icon!' => '',
				],
			]
		);
		

		$this->add_control(
			'ht_creative_button_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 60,
					],
				],
				'condition' => [
					'ht_creative_button_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ht-creative-button-icon-right' => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .ht-creative-button-icon-left' => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .ht-creative-button--shikoba i' => 'left: -{{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();

  		// Style Controls
		$this->start_controls_section(
			'ht_section_creative_button_settings',
			[
				'label' => esc_html__( 'Button Effects &amp; Styles', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'creative_button_effect',
			[
				'label' => esc_html__( 'Set Button Effect', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ht-creative-button--default',
				'options' => [
					'ht-creative-button--default' 	=> esc_html__( 'Default', 		'hubtag-elementor-addons' ),
					'ht-creative-button--winona' 		=> esc_html__( 'Winona', 		'hubtag-elementor-addons' ),
					'ht-creative-button--ujarak' 		=> esc_html__( 'Ujarak', 		'hubtag-elementor-addons' ),
					'ht-creative-button--wayra' 		=> esc_html__( 'Wayra', 		'hubtag-elementor-addons' ),
					'ht-creative-button--tamaya' 		=> esc_html__( 'Tamaya', 		'hubtag-elementor-addons' ),
					'ht-creative-button--rayen' 		=> esc_html__( 'Rayen', 		'hubtag-elementor-addons' ),
					'ht-creative-button--pipaluk' 	=> esc_html__( 'Pipaluk',       'hubtag-elementor-addons' ),
					'ht-creative-button--moema' 	    => esc_html__( 'Moema', 	    'hubtag-elementor-addons' ),
					'ht-creative-button--aylen' 	    => esc_html__( 'Aylen', 	    'hubtag-elementor-addons' ),
					'ht-creative-button--saqui' 	    => esc_html__( 'Saqui', 	    'hubtag-elementor-addons' ),
					'ht-creative-button--wapasha' 	=> esc_html__( 'Wapasha',       'hubtag-elementor-addons' ),
					'ht-creative-button--nuka' 	    => esc_html__( 'Nuka', 			'hubtag-elementor-addons' ),
					'ht-creative-button--antiman' 	=> esc_html__( 'Antiman', 		'hubtag-elementor-addons' ),
					'ht-creative-button--quidel' 	    => esc_html__( 'Quidel', 		'hubtag-elementor-addons' ),
					'ht-creative-button--shikoba' 	=> esc_html__( 'Shikoba', 		'hubtag-elementor-addons' ),
				],
				
			]
		);

		$this->add_responsive_control(
			'ht_creative_button_alignment',
			[
				'label' => esc_html__( 'Button Alignment', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-creative-button-wrapper' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ht_creative_button_width',
			[
				'label' => esc_html__( 'Width', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ht-creative-button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);	

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'ht_creative_button_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ht-creative-button',
			]
		);
		
		$this->add_responsive_control(
			'ht_creative_button_padding',
			[
				'label' => esc_html__( 'Button Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ht-creative-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--winona::after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--winona > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--tamaya::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--rayen::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--rayen > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		
		$this->start_controls_tabs( 'ht_creative_button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'hubtag-elementor-addons' ) ] );

		$this->add_control(
			'ht_creative_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ht-creative-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--tamaya::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--tamaya::after' => 'color: {{VALUE}};',
				],
			]
		);
		

		
		$this->add_control(
			'ht_creative_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .ht-creative-button' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--ujarak:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--wayra:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--tamaya::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--tamaya::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--rayen:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button--nuka::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button--nuka::after' => 'background-color: {{VALUE}};',

				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ht_creative_button_border',
				'selector' => '{{WRAPPER}} .ht-creative-button',
			]
		);
		
		$this->add_control(
			'ht_creative_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ht-creative-button' => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .ht-creative-button::before' => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .ht-creative-button::after' => 'border-radius: {{SIZE}}px;',
				],
			]
		);
		

		
		$this->end_controls_tab();

		$this->start_controls_tab( 'ht_creative_button_hover', [ 'label' => esc_html__( 'Hover', 'hubtag-elementor-addons' ) ] );

		$this->add_control(
			'ht_creative_button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ht-creative-button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--winona::after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_creative_button_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f54',
				'selectors' => [
					'{{WRAPPER}} .ht-creative-button:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--ujarak::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--wayra:hover::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--tamaya:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--rayen::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button--aylen::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} ..ht-creative-button--nuka:hover::after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_creative_button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-creative-button:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--wapasha::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--antiman::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--pipaluk::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button.ht-creative-button--quidel::before'  => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ht-creative-button--pipaluk::before'  => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .ht-creative-button',
			]
		);
		
		
		$this->end_controls_section();
		
		
		$this->end_controls_section();	
		
		
	}


	protected function render( ) {
		
		
	  $settings = $this->get_settings();
	  $target = $settings['creative_button_link_url']['is_external'] ? 'target="_blank"' : '';
	  $nofollow = $settings['creative_button_link_url']['nofollow'] ? 'rel="nofollow"' : '';

	?>

	<div class="ht-creative-button-wrapper">	
		<a class="ht-creative-button <?php echo esc_attr($settings['creative_button_effect'] ); ?>"
			href="<?php echo esc_attr($settings['creative_button_link_url']['url'] ); ?>" <?php echo $target; ?> <?php $nofollow; ?> data-text="<?php echo esc_attr($settings['creative_button_secondary_text'] ); ?>">
			<span>
				<?php if ( ! empty( $settings['ht_creative_button_icon'] ) && $settings['ht_creative_button_icon_alignment'] == 'left' ) : ?>
					<i class="<?php echo esc_attr($settings['ht_creative_button_icon'] ); ?> ht-creative-button-icon-left" aria-hidden="true"></i> 
				<?php endif; ?>

				<?php echo  $settings['creative_button_text'];?>

				<?php if ( ! empty( $settings['ht_creative_button_icon'] ) && $settings['ht_creative_button_icon_alignment'] == 'right' ) : ?>
					<i class="<?php echo esc_attr($settings['ht_creative_button_icon'] ); ?> ht-creative-button-icon-right" aria-hidden="true"></i> 
				<?php endif; ?>
			</span>
		</a>
	</div>

	<?php
	
	}

	protected function content_template() {}
}