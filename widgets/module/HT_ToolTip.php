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
use \Elementor\Utils as Utils;
use \Elementor\Widget_Base as Widget_Base;

class HT_ToolTip extends Widget_Base {

	public function get_name() {
		return 'ht-tooltip';
	}

	public function get_title() {
		return esc_html__( 'HT Tooltip', 'hubtag-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-alert';
	}

   public function get_categories() {
        return [ 'hubtag-elementor-addons' ]; // category of the widget
	}

	protected function _register_controls() {
		/**
  		 * Tooltip Settings
  		 */
  		$this->start_controls_section(
  			'ht_section_tooltip_settings',
  			[
  				'label' => esc_html__( 'Content Settings', 'hubtag-elementor-addons' )
  			]
  		);
		$this->add_responsive_control(
			'ht_tooltip_type',
			[
				'label' => esc_html__( 'Content Type', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'icon' => [
						'title' => esc_html__( 'Icon', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-info',
					],
					'text' => [
						'title' => esc_html__( 'Text', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-text-width',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-image',
					],
					'shortcode' => [
						'title' => esc_html__( 'Shortcode', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-code',
					],
				],
				'default' => 'icon',
			]
		);
  		$this->add_control(
			'ht_tooltip_content',
			[
				'label' => esc_html__( 'Content', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => esc_html__( 'Hover Me!', 'hubtag-elementor-addons' ),
				'condition' => [
					'ht_tooltip_type' => [ 'text' ]
				],
				'dynamic' => [ 'active' => true ]
			]
		);
		$this->add_control(
		  'ht_tooltip_content_tag',
		  	[
		   		'label'       	=> esc_html__( 'Content Tag', 'hubtag-elementor-addons' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'span',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'h1'  	=> esc_html__( 'H1', 'hubtag-elementor-addons' ),
		     		'h2'  	=> esc_html__( 'H2', 'hubtag-elementor-addons' ),
		     		'h3'  	=> esc_html__( 'H3', 'hubtag-elementor-addons' ),
		     		'h4'  	=> esc_html__( 'H4', 'hubtag-elementor-addons' ),
		     		'h5'  	=> esc_html__( 'H5', 'hubtag-elementor-addons' ),
		     		'h6'  	=> esc_html__( 'H6', 'hubtag-elementor-addons' ),
		     		'div'  	=> esc_html__( 'DIV', 'hubtag-elementor-addons' ),
		     		'span'  => esc_html__( 'SPAN', 'hubtag-elementor-addons' ),
		     		'p'  	=> esc_html__( 'P', 'hubtag-elementor-addons' ),
		     	],
		     	'condition' => [
		     		'ht_tooltip_type' => 'text'
		     	]
		  	]
		);
		$this->add_control(
			'ht_tooltip_shortcode_content',
			[
				'label' => esc_html__( 'Shortcode', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( '[shortcode-here]', 'hubtag-elementor-addons' ),
				'condition' => [
					'ht_tooltip_type' => [ 'shortcode' ]
				]
			]
		);
		$this->add_control(
			'ht_tooltip_icon_content',
			[
				'label' => esc_html__( 'Icon', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-home',
				'condition' => [
					'ht_tooltip_type' => [ 'icon' ]
				]
			]
		);
		$this->add_control(
			'ht_tooltip_img_content',
			[
				'label' => esc_html__( 'Image', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ht_tooltip_type' => [ 'image' ]
				]
			]
		);
		$this->add_responsive_control(
			'ht_tooltip_content_alignment',
			[
				'label' => esc_html__( 'Content Alignment', 'hubtag-elementor-addons' ),
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
					'justify' => [
						'title' => __( 'Justified', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'left',
				'prefix_class' => 'ht-tooltip-align-',
			]
		);
		$this->add_control(
			'ht_tooltip_enable_link',
			[
				'label' => esc_html__( 'Enable Link', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'false',
				'return_value' => 'yes',
				'condition' => [
					'ht_tooltip_type!' => ['shortcode']
				]
			]
		);
		$this->add_control(
			'ht_tooltip_link',
			[
				'label' => esc_html__( 'Button Link', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
        			'url' => '#',
        			'is_external' => '',
     			],
     			'show_external' => true,
     			'condition' => [
     				'ht_tooltip_enable_link' => 'yes'
     			]
			]
		);
  		$this->end_controls_section();

  		/**
  		 * Tooltip Hover Content Settings
  		 */
  		$this->start_controls_section(
  			'ht_section_tooltip_hover_content_settings',
  			[
  				'label' => esc_html__( 'Tooltip Settings', 'hubtag-elementor-addons' )
  			]
  		);
  		$this->add_control(
			'ht_tooltip_hover_content',
			[
				'label' => esc_html__( 'Content', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => esc_html__( 'Tooltip content', 'hubtag-elementor-addons' ),
				'dynamic' => [ 'active' => true ]
			]
		);
		$this->add_control(
		  'ht_tooltip_hover_dir',
		  	[
		   		'label'       	=> esc_html__( 'Hover Direction', 'hubtag-elementor-addons' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'right',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'left'  	=> esc_html__( 'Left', 'hubtag-elementor-addons' ),
		     		'right'  	=> esc_html__( 'Right', 'hubtag-elementor-addons' ),
		     		'top'  		=> esc_html__( 'Top', 'hubtag-elementor-addons' ),
		     		'bottom'  	=> esc_html__( 'Bottom', 'hubtag-elementor-addons' ),
		     	],
		  	]
		);
		$this->add_control(
			'ht_tooltip_hover_speed',
			[
				'label' => esc_html__( 'Hover Speed', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '300', 'hubtag-elementor-addons' ),
				'selectors' => [
		            '{{WRAPPER}} .ht-tooltip:hover .ht-tooltip-text.ht-tooltip-top' => 'animation-duration: {{SIZE}}ms;',
		            '{{WRAPPER}} .ht-tooltip:hover .ht-tooltip-text.ht-tooltip-left' => 'animation-duration: {{SIZE}}ms;',
		            '{{WRAPPER}} .ht-tooltip:hover .ht-tooltip-text.ht-tooltip-bottom' => 'animation-duration: {{SIZE}}ms;',
		            '{{WRAPPER}} .ht-tooltip:hover .ht-tooltip-text.ht-tooltip-right' => 'animation-duration: {{SIZE}}ms;',
		        ]
			]
		);
  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Tooltip Content
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_tooltip_style_settings',
			[
				'label' => esc_html__( 'Content Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'ht_tooltip_max_width',
		    [
		        'label' => __( 'Content Max Width', 'hubtag-elementor-addons' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 1000,
		                'step' => 5,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .ht-tooltip' => 'max-width: {{SIZE}}{{UNIT}};',
		        ]
		    ]
		);
		$this->add_responsive_control(
			'ht_tooltip_content_padding',
			[
				'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'ht_tooltip_content_margin',
			[
				'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-tooltip' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->start_controls_tabs( 'ht_tooltip_content_style_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'ht_tooltip_content_normal', [ 'label' => esc_html__( 'Normal', 'hubtag-elementor-addons' ) ] );
				$this->add_control(
					'ht_tooltip_content_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .ht-tooltip' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'ht_tooltip_content_color',
					[
						'label' => esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .ht-tooltip' => 'color: {{VALUE}};',
							'{{WRAPPER}} .ht-tooltip a' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'ht_tooltip_shadow',
						'selector' => '{{WRAPPER}} .ht-tooltip',
						'separator' => 'before'
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'ht_tooltip_border',
						'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
						'selector' => '{{WRAPPER}} .ht-tooltip',
					]
				);
			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'ht_tooltip_content_hover', [ 'label' => esc_html__( 'Hover', 'hubtag-elementor-addons' ) ] );
				$this->add_control(
					'ht_tooltip_content_hover_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .ht-tooltip:hover' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'ht_tooltip_content_hover_color',
					[
						'label' => esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#212121',
						'selectors' => [
							'{{WRAPPER}} .ht-tooltip:hover' => 'color: {{VALUE}};',
							'{{WRAPPER}} .ht-tooltip:hover a' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'ht_tooltip_hover_shadow',
						'selector' => '{{WRAPPER}} .ht-tooltip:hover',
						'separator' => 'before'
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'ht_tooltip_hover_border',
						'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
						'selector' => '{{WRAPPER}} .ht-tooltip:hover',
					]
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'ht_tooltip_content_typography',
				'selector' => '{{WRAPPER}} .ht-tooltip',
			]
		);
		$this->add_responsive_control(
			'ht_tooltip_content_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Tab Style Tooltip Hover Content
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_tooltip_hover_style_settings',
			[
				'label' => esc_html__( 'Tooltip Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'ht_tooltip_hover_width',
		    [
		        'label' => __( 'Tooltip Width', 'hubtag-elementor-addons' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		        	'size' => '150'
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 1000,
		                'step' => 5,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .ht-tooltip .ht-tooltip-text' => 'width: {{SIZE}}{{UNIT}};',
		        ]
		    ]
		);
		$this->add_responsive_control(
			'ht_tooltip_hover_max_width',
		    [
		        'label' => __( 'Tooltip Max Width', 'hubtag-elementor-addons' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		        	'size' => '150'
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 1000,
		                'step' => 5,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .ht-tooltip .ht-tooltip-text' => 'max-width: {{SIZE}}{{UNIT}};',
		        ]
		    ]
		);
		$this->add_responsive_control(
			'ht_tooltip_hover_content_padding',
			[
				'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 				'{{WRAPPER}} .ht-tooltip .ht-tooltip-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'ht_tooltip_hover_content_margin',
			[
				'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 				'{{WRAPPER}} .ht-tooltip .ht-tooltip-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_control(
			'ht_tooltip_hover_content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#555',
				'selectors' => [
					'{{WRAPPER}} .ht-tooltip .ht-tooltip-text' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ht_tooltip_hover_content_color',
			[
				'label' => esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ht-tooltip .ht-tooltip-text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'ht_tooltip_hover_content_typography',
				'selector' => '{{WRAPPER}} .ht-tooltip .ht-tooltip-text',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ht_tooltip_box_shadow',
				'selector' => '{{WRAPPER}} .ht-tooltip .ht-tooltip-text',
			]
		);
		$this->add_responsive_control(
			'ht_tooltip_arrow_size',
			[
				'label' => __( 'Arrow Size', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 100,
		                'step' => 1,
		            ]
				],
				'selectors' => [
					'{{WRAPPER}} .ht-tooltip .ht-tooltip-text:after' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ht-tooltip .ht-tooltip-text.ht-tooltip-left::after' => 'top: calc( 50% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .ht-tooltip .ht-tooltip-text.ht-tooltip-right::after' => 'top: calc( 50% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .ht-tooltip .ht-tooltip-text.ht-tooltip-top::after' => 'left: calc( 50% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .ht-tooltip .ht-tooltip-text.ht-tooltip-bottom::after' => 'left: calc( 50% - {{SIZE}}{{UNIT}} );',
				],
			]
		);
		$this->add_control(
			'ht_tooltip_arrow_color',
			[
				'label' => esc_html__( 'Arrow Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#555',
				'selectors' => [
					'{{WRAPPER}} .ht-tooltip .ht-tooltip-text.ht-tooltip-top:after' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .ht-tooltip .ht-tooltip-text.ht-tooltip-bottom:after' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .ht-tooltip .ht-tooltip-text.ht-tooltip-left:after' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .ht-tooltip .ht-tooltip-text.ht-tooltip-right:after' => 'border-right-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}


	protected function render( ) {

   		$settings = $this->get_settings_for_display();
   		$target = $settings['ht_tooltip_link']['is_external'] ? 'target="_blank"' : '';
	  	$nofollow = $settings['ht_tooltip_link']['nofollow'] ? 'rel="nofollow"' : '';
	?>
	<div class="ht-tooltip">
		<?php if( $settings['ht_tooltip_type'] === 'text' ) : ?>
			<<?php echo esc_attr( $settings['ht_tooltip_content_tag'] ); ?> class="ht-tooltip-content"><?php if( $settings['ht_tooltip_enable_link'] === 'yes' ) : ?><a href="<?php echo esc_url( $settings['ht_tooltip_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> ><?php endif; ?><?php echo esc_html__( $settings['ht_tooltip_content'], 'hubtag-elementor-addons' ); ?><?php if( $settings['ht_tooltip_enable_link'] === 'yes' ) : ?></a><?php endif; ?></<?php echo esc_attr( $settings['ht_tooltip_content_tag'] ); ?>>
  			<span class="ht-tooltip-text ht-tooltip-<?php echo esc_attr( $settings['ht_tooltip_hover_dir'] ) ?>"><?php echo __( $settings['ht_tooltip_hover_content'] ); ?></span>
  		<?php elseif( $settings['ht_tooltip_type'] === 'icon' ) : ?>
			<span class="ht-tooltip-content"><?php if( $settings['ht_tooltip_enable_link'] === 'yes' ) : ?><a href="<?php echo esc_url( $settings['ht_tooltip_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> ><?php endif; ?><i class="<?php echo esc_attr( $settings['ht_tooltip_icon_content'] ); ?>"></i><?php if( $settings['ht_tooltip_enable_link'] === 'yes' ) : ?></a><?php endif; ?></span>
  			<span class="ht-tooltip-text ht-tooltip-<?php echo esc_attr( $settings['ht_tooltip_hover_dir'] ) ?>"><?php echo __( $settings['ht_tooltip_hover_content'] ); ?></span>
  		<?php elseif( $settings['ht_tooltip_type'] === 'image' ) : ?>
			<span class="ht-tooltip-content"><?php if( $settings['ht_tooltip_enable_link'] === 'yes' ) : ?><a href="<?php echo esc_url( $settings['ht_tooltip_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> ><?php endif; ?><img src="<?php echo esc_url( $settings['ht_tooltip_img_content']['url'] ); ?>" alt="<?php echo esc_attr( $settings['ht_tooltip_hover_content'] ); ?>"><?php if( $settings['ht_tooltip_enable_link'] === 'yes' ) : ?></a><?php endif; ?></span>
  			<span class="ht-tooltip-text ht-tooltip-<?php echo esc_attr( $settings['ht_tooltip_hover_dir'] ) ?>"><?php echo __( $settings['ht_tooltip_hover_content'] ); ?></span>
  		<?php elseif( $settings['ht_tooltip_type'] === 'shortcode' ) : ?>
			<div class="ht-tooltip-content"><?php echo do_shortcode( $settings['ht_tooltip_shortcode_content'] ); ?></div>
  			<span class="ht-tooltip-text ht-tooltip-<?php echo esc_attr( $settings['ht_tooltip_hover_dir'] ) ?>"><?php echo __( $settings['ht_tooltip_hover_content'] ); ?></span>
  		<?php endif; ?>
	</div>
	<?php
	}

	protected function content_template() {}
}
