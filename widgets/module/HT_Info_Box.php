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
use \Elementor\Group_Control_Image_Size as Group_Control_Image_Size;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Utils as Utils;
use \Elementor\Widget_Base as Widget_Base;
use HubTagAddonsElementor\Widgets\Inc\Helper as Helper;

class HT_Info_Box extends Widget_Base {
	use Helper;
	public function get_name() {
		return 'ht-info-box';
	}

	public function get_title() {
		return esc_html__( 'HT Info Box', 'hubtag-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-info-box';
	}

	public function get_categories() {
		return ['hubtag-elementor-addons'];
	}

	protected function _register_controls() {

  		/**
  		 * Infobox Image Settings
  		 */
  		$this->start_controls_section(
  			'ht_section_infobox_content_settings',
  			[
  				'label' => esc_html__( 'Infobox Image', 'hubtag-elementor-addons' )
  			]
  		);

  		$this->add_control(
		  'ht_infobox_img_type',
		  	[
		   	'label'       	=> esc_html__( 'Infobox Type', 'hubtag-elementor-addons' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'img-on-top',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'img-on-top'  	=> esc_html__( 'Image/Icon On Top', 'hubtag-elementor-addons' ),
		     		'img-on-left' 	=> esc_html__( 'Image/Icon On Left', 'hubtag-elementor-addons' ),
		     		'img-on-right' 	=> esc_html__( 'Image/Icon On Right', 'hubtag-elementor-addons' ),
		     	],
		  	]
		);

		$this->add_responsive_control(
			'ht_infobox_img_or_icon',
			[
				'label' => esc_html__( 'Image or Icon', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'none' => [
						'title' => esc_html__( 'None', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-ban',
					],
					'number' => [
						'title' => esc_html__( 'Number', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-sort-numeric-desc',
					],
					'icon' => [
						'title' => esc_html__( 'Icon', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-info-circle',
					],
					'img' => [
						'title' => esc_html__( 'Image', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-picture-o',
					]
				],
				'default' => 'icon',
			]
		);

		$this->add_responsive_control(
			'icon_vertical_position',
			[
				'label'                 => __( 'Icon Position', 'hubtag-elementor-addons' ),
				'type'                  => Controls_Manager::CHOOSE,
				'default'               => 'top',
				'condition'			=> [
					'ht_infobox_img_type!'	=> 'img-on-top'
				],
				'options'               => [
					'top'          => [
						'title'    => __( 'Top', 'hubtag-elementor-addons' ),
						'icon'     => 'eicon-v-align-top',
					],
					'middle'       => [
						'title'    => __( 'Middle', 'hubtag-elementor-addons' ),
						'icon'     => 'eicon-v-align-middle',
					],
					'bottom'       => [
						'title'    => __( 'Bottom', 'hubtag-elementor-addons' ),
						'icon'     => 'eicon-v-align-bottom',
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .ht-infobox .infobox-icon'	=> 'align-self: {{VALUE}};'
				],
				'selectors_dictionary'  => [
					'top'          => 'baseline',
					'middle'       => 'center',
					'bottom'       => 'flex-end',
				],
			]
		);

		/**
		 * Condition: 'ht_infobox_img_or_icon' => 'img'
		 */
		$this->add_control(
			'ht_infobox_image',
			[
				'label' => esc_html__( 'Infobox Image', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ht_infobox_img_or_icon' => 'img'
				]
			]
		);


		/**
		 * Condition: 'ht_infobox_img_or_icon' => 'icon'
		 */
		$this->add_control(
			'ht_infobox_icon',
			[
				'label' => esc_html__( 'Icon', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-building-o',
				'condition' => [
					'ht_infobox_img_or_icon' => 'icon'
				]
			]
		);

		/**
		 * Condition: 'ht_infobox_img_or_icon' => 'number'
		 */
		$this->add_control(
			'ht_infobox_number',
			[
				'label' => esc_html__( 'Number', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'ht_infobox_img_or_icon' => 'number'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Infobox Content
		 */
		$this->start_controls_section(
			'ht_infobox_content',
			[
				'label' => esc_html__( 'Infobox Content', 'hubtag-elementor-addons' ),
			]
		);
		$this->add_control(
			'ht_infobox_title',
			[
				'label' => esc_html__( 'Infobox Title', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [
					'active' => true
				],
				'default' => esc_html__( 'This is an icon box', 'hubtag-elementor-addons' )
			]
		);
		$this->add_control(
            'ht_infobox_text_type',
            [
                'label'                 => __( 'Content Type', 'hubtag-elementor-addons' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                    'content'       => __( 'Content', 'hubtag-elementor-addons' ),
                    'template'      => __( 'Saved Templates', 'hubtag-elementor-addons' ),
                ],
                'default'               => 'content',
            ]
        );

        $this->add_control(
            'ht_primary_templates',
            [
                'label'                 => __( 'Choose Template', 'hubtag-elementor-addons' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => $this->ht_get_page_templates(),
				'condition'             => [
					'ht_infobox_text_type'      => 'template',
				],
            ]
        );
		$this->add_control(
			'ht_infobox_text',
			[
				'label' => esc_html__( 'Infobox Content', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'dynamic' => [
					'active' => true
				],
				'default' => esc_html__( 'Write a short description, that will describe the title or something informational and useful.', 'hubtag-elementor-addons' ),
				'condition'             => [
					'ht_infobox_text_type'      => 'content',
				],
			]
		);
		$this->add_control(
			'ht_show_infobox_content',
			[
				'label' => __( 'Show Content', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'hubtag-elementor-addons' ),
				'label_off' => __( 'Hide', 'hubtag-elementor-addons' ),
				'return_value' => 'yes',
			]
		);
		$this->add_responsive_control(
			'ht_infobox_content_alignment',
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
				],
				'default' => 'center',
				'prefix_class' => 'ht-infobox-content-align-',
				'condition' => [
					'ht_infobox_img_type' => 'img-on-top'
				]
			]
		);
		$this->end_controls_section();

		/**
		 * ----------------------------------------------
		 * Infobox Button
		 * ----------------------------------------------
		 */
		$this->start_controls_section(
			'ht_infobox_button',
			[
				'label' => esc_html__( 'Link', 'hubtag-elementor-addons' )
			]
		);

		$this->add_control(
			'ht_show_infobox_button',
			[
				'label' => __( 'Show Infobox Button', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'hubtag-elementor-addons' ),
				'label_off' => __( 'No', 'hubtag-elementor-addons' ),
				'condition'	=> [
					'ht_show_infobox_clickable!'	=> 'yes'
				]
			]
		);

		$this->add_control(
			'ht_show_infobox_clickable',
			[
				'label' => __( 'Infobox Clickable', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'hubtag-elementor-addons' ),
				'label_off' => __( 'No', 'hubtag-elementor-addons' ),
				'return_value' => 'yes',
				'condition'	=> [
					'ht_show_infobox_button!'	=> 'yes'
				]
			]
		);

		$this->add_control(
			'ht_show_infobox_clickable_link',
			[
				'label' => esc_html__( 'Infobox Link', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
        			'url' => 'http://',
        			'is_external' => '',
     			],
     			'show_external' => true,
     			'condition' => [
     				'ht_show_infobox_clickable' => 'yes'
     			]
			]
		);

		$this->add_control(
			'infobox_button_text',
			[
				'label' => __( 'Button Text', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Click Me!',
				'separator'	=> 'before',
				'placeholder' => __( 'Enter button text', 'hubtag-elementor-addons' ),
				'title' => __( 'Enter button text here', 'hubtag-elementor-addons' ),
				'condition'	=> [
					'ht_show_infobox_button'	=> 'yes'
				]
			]
		);

		$this->add_control(
			'infobox_button_link_url',
			[
				'label' => __( 'Link URL', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __( 'Enter link URL for the button', 'hubtag-elementor-addons' ),
				'show_external'	=> true,
				'default'		=> [
					'url'	=> '#'
				],
				'title' => __( 'Enter heading for the button', 'hubtag-elementor-addons' ),
				'condition'	=> [
					'ht_show_infobox_button'	=> 'yes'
				]
			]
		);
		
		$this->add_control(
			'ht_infobox_button_icon',
			[
				'label' => esc_html__( 'Icon', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::ICON,
				'condition'	=> [
					'ht_show_infobox_button'	=> 'yes'
				]
			]
		);

		$this->add_control(
			'ht_infobox_button_icon_alignment',
			[
				'label' => esc_html__( 'Icon Position', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'hubtag-elementor-addons' ),
					'right' => esc_html__( 'After', 'hubtag-elementor-addons' ),
				],
				'condition' => [
					'ht_infobox_button_icon!' => '',
					'ht_show_infobox_button'	=> 'yes'
				],
			]
		);

		$this->add_control(
			'ht_infobox_button_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 60,
					],
				],
				'condition' => [
					'ht_infobox_button_icon!' => '',
					'ht_show_infobox_button'	=> 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .ht_infobox_button_icon_right' => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .ht_infobox_button_icon_left' => 'margin-right: {{SIZE}}px;',
				],
			]
		);
		$this->end_controls_section();



		/**
		 * -------------------------------------------
		 * Tab Style (Info Box Image)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_infobox_imgae_style_settings',
			[
				'label' => esc_html__( 'Image Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
		     		'ht_infobox_img_or_icon' => 'img'
		     	]
			]
		);

		$this->start_controls_tabs('ht_infobox_image_style');
			
			$this->start_controls_tab(
				'ht_infobox_image_icon_normal',
				[
					'label'		=> __( 'Normal', 'hubtag-elementor-addons' )
				]
			);

				$this->add_control(
					'ht_infobox_image_icon_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .ht-infobox .infobox-icon img' => 'background-color: {{VALUE}};',
						]
					]
				);

				$this->add_responsive_control(
					'ht_infobox_image_icon_padding',
					[
						'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							'{{WRAPPER}} .ht-infobox .infobox-icon img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						 ],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
						[
							'name' => 'ht_infobox_image_border',
							'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
							'selector' => '{{WRAPPER}} .ht-infobox .infobox-icon img'
						]
				);
		
				$this->add_control(
				'ht_infobox_img_shape',
					[
					'label'     	=> esc_html__( 'Image Shape', 'hubtag-elementor-addons' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> 'square',
						'label_block' 	=> false,
						'options' 		=> [
							'square'  	=> esc_html__( 'Square', 'hubtag-elementor-addons' ),
							'circle' 	=> esc_html__( 'Circle', 'hubtag-elementor-addons' ),
							'radius' 	=> esc_html__( 'Radius', 'hubtag-elementor-addons' ),
						],
						'prefix_class' => 'ht-infobox-shape-',
						'condition' => [
							'ht_infobox_img_or_icon' => 'img'
						]
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'ht_infobox_image_icon_hover',
				[
					'label'		=> __( 'Hover', 'hubtag-elementor-addons' )
				]
			);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'ht_infobox_image_icon_hover_shadow',
						'selectors' => [
							'{{WRAPPER}} .ht-infobox .infobox-icon:hover img' => 'background-color: {{VALUE}};',
						]
					]
				);

				$this->add_control(
					'ht_infobox_image_icon_hover_animation',
					[
						'label' => esc_html__( 'Animation', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::HOVER_ANIMATION
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
						[
							'name' => 'ht_infobox_hover_image_border',
							'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
							'selector' => '{{WRAPPER}} .ht-infobox:hover .infobox-icon img'
						]
				);
		
				$this->add_control(
				'ht_infobox_hover_img_shape',
					[
					'label'     	=> esc_html__( 'Image Shape', 'hubtag-elementor-addons' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> 'square',
						'label_block' 	=> false,
						'options' 		=> [
							'square'  	=> esc_html__( 'Square', 'hubtag-elementor-addons' ),
							'circle' 	=> esc_html__( 'Circle', 'hubtag-elementor-addons' ),
							'radius' 	=> esc_html__( 'Radius', 'hubtag-elementor-addons' ),
						],
						'prefix_class' => 'ht-infobox-hover-img-shape-',
						'condition' => [
							'ht_infobox_img_or_icon' => 'img'
						]
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'ht_infobox_image_resizer',
			[
				'label' => esc_html__( 'Image Resizer', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100
				],
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ht-infobox .infobox-icon img' => 'width: {{SIZE}}px;',
					'{{WRAPPER}} .ht-infobox.icon-on-left .infobox-icon' => 'width: {{SIZE}}px;',
					'{{WRAPPER}} .ht-infobox.icon-on-right .infobox-icon' => 'width: {{SIZE}}px;',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'ht_infobox_image[url]!' => '',
				],
				'condition' => [
					'ht_infobox_img_or_icon' => 'img',
				]
			]
		);

		$this->add_responsive_control(
			'ht_infobox_img_margin',
			[
				'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-infobox .infobox-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Tab Style (Info Box Number Icon Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_infobox_number_icon_style_settings',
			[
				'label' => esc_html__( 'Number Icon Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
		     		'ht_infobox_img_or_icon' => 'number'
		     	]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
			'name' => 'ht_infobox_number_icon_typography',
				'selector' => '{{WRAPPER}} .ht-infobox .infobox-icon .infobox-icon-number',
			]
		);

		$this->add_responsive_control(
    		'ht_infobox_number_icon_bg_size',
    		[
        		'label' => __( 'Icon Background Size', 'hubtag-elementor-addons' ),
       			'type' => Controls_Manager::SLIDER,
        		'default' => [
            		'size' => 90,
        		],
        		'range' => [
            		'px' => [
                		'min' => 0,
                		'max' => 300,
                		'step' => 1,
            		]
        		],
        		'selectors' => [
            		'{{WRAPPER}} .ht-infobox .infobox-icon .infobox-icon-wrap' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
        		],
        		'condition' => [
					'ht_infobox_icon_bg_shape!' => 'none'
				]
    		]
		);

		$this->add_responsive_control(
			'ht_infobox_number_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-infobox .infobox-icon-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->start_controls_tabs( 'ht_infobox_numbericon_style_controls' );

			$this->start_controls_tab(
				'ht_infobox_number_icon_normal',
				[
					'label'		=> esc_html__( 'Normal', 'hubtag-elementor-addons' ),
				]
			);

				$this->add_control(
					'ht_infobox_number_icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#4d4d4d',
						'selectors' => [
							'{{WRAPPER}} .ht-infobox .infobox-icon .infobox-icon-number' => 'color: {{VALUE}};',
							'{{WRAPPER}} .ht-infobox.icon-beside-title .infobox-content .title figure .infobox-icon-number' => 'color: {{VALUE}};',
						],
					]
				);
		
				$this->add_control(
					'ht_infobox_number_icon_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .ht-infobox .infobox-icon .infobox-icon-wrap' => 'background: {{VALUE}};',
						],
						'condition' => [
							'ht_infobox_icon_bg_shape!' => 'none',
						]
					]
				);
		
				$this->add_control(
				'ht_infobox_number_icon_bg_shape',
					[
					'label'     	=> esc_html__( 'Background Shape', 'hubtag-elementor-addons' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> 'none',
						'label_block' 	=> false,
						'options' 		=> [
							'none'  	=> esc_html__( 'None', 'hubtag-elementor-addons' ),
							'circle' 	=> esc_html__( 'Circle', 'hubtag-elementor-addons' ),
							'radius' 	=> esc_html__( 'Radius', 'hubtag-elementor-addons' ),
							'square' 	=> esc_html__( 'Square', 'hubtag-elementor-addons' ),
						],
						'prefix_class' => 'ht-infobox-icon-bg-shape-'
					]
				);
		
				$this->add_group_control(
					Group_Control_Border::get_type(),
						[
							'name' => 'ht_infobox_number_icon_border',
							'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
							'selector' => '{{WRAPPER}} .ht-infobox .infobox-icon-wrap'
						]
				);
		
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'ht_infobox_number_icon_shadow',
						'selector' => '{{WRAPPER}} .ht-infobox .infobox-icon-wrap',
					]
				);

			$this->end_controls_tab();


			$this->start_controls_tab(
				'ht_infobox_number_icon_hover',
				[
					'label'		=> esc_html__( 'Hover', 'hubtag-elementor-addons' ),
				]
			);

			$this->add_control(
				'ht_infobox_number_icon_hover_animation',
				[
					'label' => esc_html__( 'Animation', 'hubtag-elementor-addons' ),
					'type' => Controls_Manager::HOVER_ANIMATION
				]
			);

			$this->add_control(
				'ht_infobox_number_icon_hover_color',
				[
					'label' => esc_html__( 'Icon Color', 'hubtag-elementor-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#4d4d4d',
					'selectors' => [
						'{{WRAPPER}} .ht-infobox:hover .infobox-icon .infobox-icon-number' => 'color: {{VALUE}};',
						'{{WRAPPER}} .ht-infobox.icon-beside-title:hover .infobox-content .title figure .infobox-icon-number' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'ht_infobox_number_icon_hover_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .ht-infobox:hover .infobox-icon .infobox-icon-wrap' => 'background: {{VALUE}};',
					],
					'condition' => [
						'ht_infobox_img_type!' => ['img-on-left', 'img-on-right'],
						'ht_infobox_icon_bg_shape!' => 'none',
					]
				]
			);

			$this->add_control(
			'ht_infobox_number_icon_hover_bg_shape',
				[
				'label'     	=> esc_html__( 'Background Shape', 'hubtag-elementor-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'none',
					'label_block' 	=> false,
					'options' 		=> [
						'none'  	=> esc_html__( 'None', 'hubtag-elementor-addons' ),
						'circle' 	=> esc_html__( 'Circle', 'hubtag-elementor-addons' ),
						'radius' 	=> esc_html__( 'Radius', 'hubtag-elementor-addons' ),
						'square' 	=> esc_html__( 'Square', 'hubtag-elementor-addons' ),
					],
					'prefix_class' => 'ht-infobox-icon-hover-bg-shape-',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
					[
						'name' => 'ht_infobox_hover_number_icon_border',
						'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
						'selector' => '{{WRAPPER}} .ht-infobox:hover .infobox-icon-wrap'
					]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'ht_infobox_number_icon_hover_shadow',
					'selector' => '{{WRAPPER}} .ht-infobox:hover .infobox-icon-wrap',
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Info Box Icon Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_infobox_icon_style_settings',
			[
				'label' => esc_html__( 'Icon Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
		     		'ht_infobox_img_or_icon' => 'icon'
		     	]
			]
		);

		$this->add_responsive_control(
    		'ht_infobox_icon_size',
    		[
        		'label' => __( 'Icon Size', 'hubtag-elementor-addons' ),
       		'type' => Controls_Manager::SLIDER,
        		'default' => [
            	'size' => 40,
        		],
        		'range' => [
            	'px' => [
                	'min' => 20,
                	'max' => 100,
                	'step' => 1,
            	]
        		],
        		'selectors' => [
            	'{{WRAPPER}} .ht-infobox .infobox-icon i' => 'font-size: {{SIZE}}px;',
        		],
    		]
		);

		$this->add_responsive_control(
    		'ht_infobox_icon_bg_size',
    		[
        		'label' => __( 'Icon Background Size', 'hubtag-elementor-addons' ),
       			'type' => Controls_Manager::SLIDER,
        		'default' => [
            		'size' => 90,
        		],
        		'range' => [
            		'px' => [
                		'min' => 0,
                		'max' => 300,
                		'step' => 1,
            		]
        		],
        		'selectors' => [
            		'{{WRAPPER}} .ht-infobox .infobox-icon .infobox-icon-wrap' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
        		],
        		'condition' => [
					'ht_infobox_icon_bg_shape!' => 'none'
				]
    		]
		);

		$this->add_responsive_control(
			'ht_infobox_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-infobox .infobox-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

			$this->start_controls_tabs( 'ht_infobox_icon_style_controls' );

				$this->start_controls_tab(
					'ht_infobox_icon_normal',
					[
						'label'		=> esc_html__( 'Normal', 'hubtag-elementor-addons' ),
					]
				);

					$this->add_control(
						'ht_infobox_icon_color',
						[
							'label' => esc_html__( 'Icon Color', 'hubtag-elementor-addons' ),
							'type' => Controls_Manager::COLOR,
							'default' => '#4d4d4d',
							'selectors' => [
								'{{WRAPPER}} .ht-infobox .infobox-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .ht-infobox.icon-beside-title .infobox-content .title figure i' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'ht_infobox_icon_bg_shape',
						[
						'label'     	=> esc_html__( 'Background Shape', 'hubtag-elementor-addons' ),
							'type' 			=> Controls_Manager::SELECT,
							'default' 		=> 'none',
							'label_block' 	=> false,
							'options' 		=> [
								'none'  	=> esc_html__( 'None', 'hubtag-elementor-addons' ),
								'circle' 	=> esc_html__( 'Circle', 'hubtag-elementor-addons' ),
								'radius' 	=> esc_html__( 'Radius', 'hubtag-elementor-addons' ),
								'square' 	=> esc_html__( 'Square', 'hubtag-elementor-addons' ),
							],
							'prefix_class' => 'ht-infobox-icon-bg-shape-'
						]
					);
			
					$this->add_control(
						'ht_infobox_icon_bg_color',
						[
							'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .ht-infobox .infobox-icon .infobox-icon-wrap' => 'background: {{VALUE}};',
							],
							'condition' => [
								'ht_infobox_icon_bg_shape!' => 'none',
							]
						]
					);
			
					$this->add_group_control(
						Group_Control_Border::get_type(),
							[
								'name' => 'ht_infobox_icon_border',
								'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
								'selector' => '{{WRAPPER}} .ht-infobox .infobox-icon-wrap'
							]
					);
			
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'ht_infobox_icon_shadow',
							'selector' => '{{WRAPPER}} .ht-infobox .infobox-icon-wrap',
						]
					);

				$this->end_controls_tab();


				$this->start_controls_tab(
					'ht_infobox_icon_hover',
					[
						'label'		=> esc_html__( 'Hover', 'hubtag-elementor-addons' ),
					]
				);

				$this->add_control(
					'ht_infobox_icon_hover_animation',
					[
						'label' => esc_html__( 'Animation', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::HOVER_ANIMATION
					]
				);

				$this->add_control(
					'ht_infobox_icon_hover_color',
					[
						'label' => esc_html__( 'Icon Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#4d4d4d',
						'selectors' => [
							'{{WRAPPER}} .ht-infobox:hover .infobox-icon i' => 'color: {{VALUE}};',
							'{{WRAPPER}} .ht-infobox.icon-beside-title:hover .infobox-content .title figure i' => 'color: {{VALUE}};',
						],
					]
				);
		
				$this->add_control(
					'ht_infobox_icon_hover_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .ht-infobox:hover .infobox-icon .infobox-icon-wrap' => 'background: {{VALUE}};',
						],
						'condition' => [
							'ht_infobox_img_type!' => ['img-on-left', 'img-on-right'],
							'ht_infobox_icon_bg_shape!' => 'none',
						]
					]
				);
		
				$this->add_control(
				  'ht_infobox_icon_hover_bg_shape',
					  [
					   'label'     	=> esc_html__( 'Background Shape', 'hubtag-elementor-addons' ),
						 'type' 			=> Controls_Manager::SELECT,
						 'default' 		=> 'none',
						 'label_block' 	=> false,
						 'options' 		=> [
							 'none'  	=> esc_html__( 'None', 'hubtag-elementor-addons' ),
							 'circle' 	=> esc_html__( 'Circle', 'hubtag-elementor-addons' ),
							 'radius' 	=> esc_html__( 'Radius', 'hubtag-elementor-addons' ),
							 'square' 	=> esc_html__( 'Square', 'hubtag-elementor-addons' ),
						 ],
						 'prefix_class' => 'ht-infobox-icon-hover-bg-shape-',
					  ]
				);
		
				$this->add_group_control(
					Group_Control_Border::get_type(),
						[
							'name' => 'ht_infobox_hover_icon_border',
							'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
							'selector' => '{{WRAPPER}} .ht-infobox:hover .infobox-icon-wrap'
						]
				);
		
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'ht_infobox_icon_hover_shadow',
						'selector' => '{{WRAPPER}} .ht-infobox:hover .infobox-icon-wrap',
					]
				);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style ( Info Box Button Style )
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_infobox_button_settings',
			[
				'label' => esc_html__( 'Button Styles', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'ht_show_infobox_button'	=> 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
			'name' => 'ht_infobox_button_typography',
				'selector' => '{{WRAPPER}} .ht-infobox .infobox-button a.ht-infobox-button',
			]
		);

		$this->add_responsive_control(
			'ht_creative_button_padding',
			[
				'label' => esc_html__( 'Button Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ht-infobox .infobox-button a.ht-infobox-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ht_infobox_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ht-infobox .infobox-button a.ht-infobox-button' => 'border-radius: {{SIZE}}px;'
				],
			]
		);

		$this->start_controls_tabs('infobox_button_styles_controls_tabs');

			$this->start_controls_tab('infobox_button_normal', [
				'label' => esc_html__( 'Normal', 'hubtag-elementor-addons' )
			]);

				$this->add_control(
					'ht_infobox_button_text_color',
					[
						'label' => esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#ffffff',
						'selectors'	=> [
							'{{WRAPPER}} .ht-infobox .ht-infobox-button' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'ht_infobox_button_background_color',
					[
						'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#333333',
						'selectors'	=> [
							'{{WRAPPER}} .ht-infobox .ht-infobox-button' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'ht_infobox_button_border',
						'selector' => '{{WRAPPER}} .ht-infobox .ht-infobox-button',
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'button_box_shadow',
						'selector' => '{{WRAPPER}} .ht-infobox .ht-infobox-button',
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab('infobox_button_hover', [
				'label' => esc_html__( 'Hover', 'hubtag-elementor-addons' )
			]);

				$this->add_control(
					'ht_infobox_button_hover_text_color',
					[
						'label' => esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#ffffff',
						'selectors'	=> [
							'{{WRAPPER}} .ht-infobox .ht-infobox-button:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'ht_infobox_button_hover_background_color',
					[
						'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#333333',
						'selectors'	=> [
							'{{WRAPPER}} .ht-infobox .ht-infobox-button:hover' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'ht_infobox_button_hover_border',
						'selector' => '{{WRAPPER}} .ht-infobox .ht-infobox-button:hover',
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'button_hover_box_shadow',
						'selector' => '{{WRAPPER}} .ht-infobox .ht-infobox-button:hover',
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Info Box Title Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_infobox_title_style_settings',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

			$this->start_controls_tabs('infobox_content_hover_style_tab');

					$this->start_controls_tab('infobox_content_normal_style', [
						'label'	=> esc_html__( 'Normal', 'hubtag-elementor-addons' )
					]);

					$this->add_control(
						'ht_infobox_title_heading',
						[
							'label' => esc_html__( 'Title Style', 'hubtag-elementor-addons' ),
							'type' => Controls_Manager::HEADING,
						]
					);
			
					$this->add_control(
						'ht_infobox_title_color',
						[
							'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
							'type' => Controls_Manager::COLOR,
							'default' => '#4d4d4d',
							'selectors' => [
								'{{WRAPPER}} .ht-infobox .infobox-content .title' => 'color: {{VALUE}};',
							],
						]
					);
			
					$this->add_group_control(
						Group_Control_Typography::get_type(),
						[
						'name' => 'ht_infobox_title_typography',
							'selector' => '{{WRAPPER}} .ht-infobox .infobox-content .title',
						]
					);
			
					$this->add_responsive_control(
						'ht_infobox_title_margin',
						[
							'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', 'em', '%' ],
							'selectors' => [
									'{{WRAPPER}} .ht-infobox .infobox-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'ht_infobox_content_heading',
						[
							'label' => esc_html__( 'Content Style', 'hubtag-elementor-addons' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before'
						]
					);

					$this->add_responsive_control(
						'ht_infobox_content_margin',
						[
							'label' => esc_html__( 'Content Only Margin', 'hubtag-elementor-addons' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', 'em', '%' ],
							'selectors' => [
									'{{WRAPPER}} .ht-infobox .infobox-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_control(
						'ht_infobox_content_background',
						[
							'label' => esc_html__( 'Content Only Background', 'hubtag-elementor-addons' ),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .ht-infobox .infobox-content' => 'background: {{VALUE}};',
							],
						]
					);

					$this->add_responsive_control(
						'ht_infobox_content_only_padding',
						[
							'label' => esc_html__( 'Content Only Padding', 'hubtag-elementor-addons' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', 'em', '%' ],
							'selectors' => [
								'{{WRAPPER}} .ht-infobox .infobox-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_control(
						'ht_infobox_content_color',
						[
							'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
							'type' => Controls_Manager::COLOR,
							'default' => '#4d4d4d',
							'selectors' => [
								'{{WRAPPER}} .ht-infobox .infobox-content p' => 'color: {{VALUE}};',
							],
						]
					);
			
					$this->add_group_control(
						Group_Control_Typography::get_type(),
						[
						'name' => 'ht_infobox_content_typography_hover',
							'selector' => '{{WRAPPER}} .ht-infobox .infobox-content p',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab('infobox_content_hover_style', [
					'label'	=> esc_html__( 'Hover', 'hubtag-elementor-addons' )
				]);

					$this->add_control(
						'ht_infobox_title_hover_color',
						[
							'label' => esc_html__( 'Title Color', 'hubtag-elementor-addons' ),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .ht-infobox:hover .infobox-content h4' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'ht_infobox_content_hover_color',
						[
							'label' => esc_html__( 'Content Color', 'hubtag-elementor-addons' ),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .ht-infobox:hover .infobox-content p' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'ht_infobox_content_transition',
						[
							'label'		=> esc_html__( 'Transition', 'hubtag-elementor-addons' ),
							'description'		=> esc_html__( 'Transition will applied to ms (ex: 300ms).', 'hubtag-elementor-addons' ),
							'type'		=> Controls_Manager::NUMBER,
							'separator'	=> 'before',
							'min'		=> 100,
							'max'		=> 1000,
							'default'	=> 100,
							'selectors'	=> [
								'{{WRAPPER}} .ht-infobox:hover .infobox-content h4' => 'transition: {{SIZE}}ms;',
								'{{WRAPPER}} .ht-infobox:hover .infobox-content p' => 'transition: {{SIZE}}ms;'
							]
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
		
		$this->start_controls_section(
			'_section_style',
			[
				'label' => esc_html__( 'Info Box Advanced', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_ADVANCED,
				'name' => 'advanced',
			]
		);  // \Elementor\Controls_Manager::TAB_ADVANCED

		$this->add_responsive_control(
			'_margin',
			[
				'label' => __( '', 'elementor' ),
				'name' => '_margin',
			]
		);

		$this->add_responsive_control(
			'ht_infobox_container_padding',
			[
				'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-infobox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * This function is responsible for rendering divs and contents
	 * for infobox before partial.
	 * 
	 * @param	$settings
	 */
	protected function ht_infobox_before( $settings ) {

		$this->add_render_attribute('ht_infobox_inner', 'class', 'ht-infobox');

		if( 'img-on-left' == $settings['ht_infobox_img_type'] )
			$this->add_render_attribute('ht_infobox_inner', 'class', 'icon-on-left');

		if( 'img-on-right' == $settings['ht_infobox_img_type'] )
			$this->add_render_attribute('ht_infobox_inner', 'class', 'icon-on-right');

		$target = $settings['ht_show_infobox_clickable_link']['is_external'] ? 'target="_blank"' : '';
		$nofollow = $settings['ht_show_infobox_clickable_link']['nofollow'] ? 'rel="nofollow"' : '';

		ob_start();
		?>
		<?php if( 'yes' == $settings['ht_show_infobox_clickable'] ) : ?><a href="<?php echo esc_url( $settings['ht_show_infobox_clickable_link']['url'] ) ?>" <?php echo $target; ?> <?php echo $nofollow; ?>><?php endif;?>
		<div <?php echo $this->get_render_attribute_string('ht_infobox_inner'); ?>>
		<?php
		echo ob_get_clean();
	}

	/**
	 * This function is rendering closing divs and tags
	 * of before partial for infobox.
	 * 
	 * @param	$settings
	 */
	protected function ht_infobox_after($settings) {
		ob_start();?></div><?php
		if( 'yes' == $settings['ht_show_infobox_clickable'] ) : ?></a><?php endif;
		echo ob_get_clean();
	}

	/**
	 * This function is rendering appropriate icon for infobox.
	 * 
	 * @param $settings
	 */
	protected function render_infobox_icon($settings) {

		if( 'none' == $settings['ht_infobox_img_or_icon'] ) return;

		$infobox_image = $this->get_settings( 'ht_infobox_image' );
		$infobox_image_url = Group_Control_Image_Size::get_attachment_image_src( $infobox_image['id'], 'thumbnail', $settings );
		if( empty( $infobox_image_url ) ) : $infobox_image_url = $infobox_image['url']; else: $infobox_image_url = $infobox_image_url; endif;

		$this->add_render_attribute(
			'infobox_icon',
			[
				'class' => ['infobox-icon']
			]
		);

		if( $settings['ht_infobox_icon_hover_animation'] ) {
			$this->add_render_attribute('infobox_icon', 'class', 'elementor-animation-' . $settings['ht_infobox_icon_hover_animation']);
		}

		if( $settings['ht_infobox_image_icon_hover_animation'] ) {
			$this->add_render_attribute('infobox_icon', 'class', 'elementor-animation-' . $settings['ht_infobox_image_icon_hover_animation']);
		}
		
		if( $settings['ht_infobox_number_icon_hover_animation'] ) {
			$this->add_render_attribute('infobox_icon', 'class', 'elementor-animation-' . $settings['ht_infobox_number_icon_hover_animation']);
		}
		
		if( 'icon' == $settings['ht_infobox_img_or_icon'] ) {
			$this->add_render_attribute('infobox_icon', 'class', 'ht-icon-only');
		}

		ob_start();
		?>
			<div <?php echo $this->get_render_attribute_string('infobox_icon'); ?>>

				<?php if( 'img' == $settings['ht_infobox_img_or_icon'] ) : ?>
					<img src="<?php echo esc_url( $infobox_image_url ); ?>" alt="Icon Image">
				<?php endif; ?>

				<?php if( 'icon' == $settings['ht_infobox_img_or_icon'] ) : ?>
				<div class="infobox-icon-wrap">
					<i class="<?php echo esc_attr( $settings['ht_infobox_icon'] ); ?>"></i>
				</div>
				<?php endif; ?>

				<?php if( 'number' == $settings['ht_infobox_img_or_icon'] ) : ?>
				<div class="infobox-icon-wrap">
					<span class="infobox-icon-number"><?php echo esc_attr( $settings['ht_infobox_number'] ); ?></span>
				</div>
				<?php endif; ?>

			</div>
		<?php
		echo ob_get_clean();
	}


	protected function render_infobox_content( $settings ) {

		$this->add_render_attribute( 'infobox_content', 'class', 'infobox-content' );
		if( 'icon' == $settings['ht_infobox_img_or_icon'] )
			$this->add_render_attribute( 'infobox_content', 'class', 'ht-icon-only' );

		ob_start();
		?>
			<div <?php echo $this->get_render_attribute_string('infobox_content'); ?>>
				<h4 class="title"><?php echo $settings['ht_infobox_title']; ?></h4>
				<?php if( 'yes' == $settings['ht_show_infobox_content'] ) : ?>
					<?php if( 'content' === $settings['ht_infobox_text_type'] ) : ?>
						<?php if ( ! empty( $settings['ht_infobox_text'] ) ) : ?>
							<p><?php echo $settings['ht_infobox_text']; ?></p>
						<?php endif; ?>
						<?php $this->render_infobox_button($this->get_settings_for_display()); ?>
					<?php elseif( 'template' === $settings['ht_infobox_text_type'] ) :
						if ( !empty( $settings['ht_primary_templates'] ) ) {
							$ht_template_id = $settings['ht_primary_templates'];
							$ht_frontend = new Frontend;

							echo $ht_frontend->get_builder_content( $ht_template_id, true );
						}
					endif; ?>
				<?php endif; ?>
			</div>
		<?php

		echo ob_get_clean();
	}

	/**
	 * This function rendering infobox button
	 * 
	 * @param $settings
	 */
	protected function render_infobox_button( $settings ) {
		if('yes' == $settings['ht_show_infobox_clickable'] || 'yes' != $settings['ht_show_infobox_button']) return;

		$this->add_render_attribute('infobox_button', 'class', 'ht-infobox-button' );

		if($settings['infobox_button_link_url']['url'])
			$this->add_render_attribute('infobox_button', 'href', esc_url($settings['infobox_button_link_url']['url']) );

		if('on' == $settings['infobox_button_link_url']['is_external'])
			$this->add_render_attribute('infobox_button', 'target', '_blank');

		if('on' == $settings['infobox_button_link_url']['nofollow'])
			$this->add_render_attribute('infobox_button', 'rel', 'nofollow');

		$this->add_render_attribute('button_icon', [
			'class'	=> esc_attr($settings['ht_infobox_button_icon']),
			'aria-hidden'	=> 'true'
		]);

		if( 'left' == $settings['ht_infobox_button_icon_alignment'])
			$this->add_render_attribute('button_icon', 'class', 'ht_infobox_button_icon_left');

		if( 'right' == $settings['ht_infobox_button_icon_alignment'])
			$this->add_render_attribute('button_icon', 'class', 'ht_infobox_button_icon_right');

		ob_start();
		?>
		<div class="infobox-button">
			<a <?php echo $this->get_render_attribute_string('infobox_button'); ?>>
				<?php if( 'left' == $settings['ht_infobox_button_icon_alignment']) : ?><i <?php echo $this->get_render_attribute_string('button_icon'); ?>></i><?php endif; ?>
				<?php echo esc_attr($settings['infobox_button_text']); ?>
				<?php if( 'right' == $settings['ht_infobox_button_icon_alignment']) : ?><i <?php echo $this->get_render_attribute_string('button_icon'); ?>></i><?php endif; ?>
			</a>
		</div>
		<?php
		echo ob_get_clean();
    }

 

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->ht_infobox_before( $settings );
		$this->render_infobox_icon( $settings );
		$this->render_infobox_content( $settings );
		$this->ht_infobox_after( $settings );
	}

	protected function content_template() {}
}