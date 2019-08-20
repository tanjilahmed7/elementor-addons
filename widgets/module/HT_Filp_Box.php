<?php
namespace HubTagAddonsElementor\Widgets;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size as Group_Control_Image_Size;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils as Utils;
use \Elementor\Widget_Base as Widget_Base;
use Elementor\Group_Control_Background;

class HT_Filp_Box extends Widget_Base {

	public function get_name() {
		return 'ht-flip-box';
	}

	public function get_title() {
		return esc_html__( 'HT Flip Box', 'hubTag-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-flip-box';
	}

   public function get_categories() {
		return ['hubtag-elementor-addons'];
	}

	protected function _register_controls() {

		/**
		 * Flipbox Content
		 */
		$this->start_controls_section(
			'ht_flipbox_content',
			[
				'label' => esc_html__( 'Flipbox Content', 'hubTag-addons-elementor' ),
			]
		);

		$this->start_controls_tabs('ht_flipbox_content_tabs');

			$this->start_controls_tab(
				'ht_flipbox_content_front',
				[
					'label'	=> __( 'Front', 'hubTag-addons-elementor' )
				]
			);


			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'front_background',
					'label' => __( 'Background', 'hubTag-addons-elementor' ),
					'types' => [ 'classic', 'gradient' ],
					'default' => 'classic',	
					'selector' => '{{WRAPPER}} .ht-flip-box-front-container',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
					[
						'name' => 'ht_filbpox_front_border',
						'label' => esc_html__( 'Border Style', 'hubTag-addons-elementor' ),
						'selector' => '{{WRAPPER}} .ht-flip-box-front-container' ,
					]
			);			

			$this->add_control(
				'ht_flipbox_front_title',
				[
					'label' => esc_html__( 'Front Title', 'hubTag-addons-elementor' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'Front Title', 'hubTag-addons-elementor' ),
				]
			);

			$this->add_control(
				'ht_flipbox_front_text',
				[
					'label' => esc_html__( 'Front Text', 'hubTag-addons-elementor' ),
					'type' => Controls_Manager::WYSIWYG,
					'label_block' => true,
					'default' => __( 'This is front side content.', 'hubTag-addons-elementor' ),
				]
			);

			$this->end_controls_tab();
			
			
			$this->start_controls_tab(
				'ht_flipbox_content_back',
				[
					'label'	=> __( 'Back', 'hubTag-addons-elementor' )
				]
			);

			
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'back_background',
					'label' => __( 'Background', 'hubTag-addons-elementor' ),
					'types' => [ 'classic', 'gradient' ],
					'default' => 'classic',	
					'selector' => '{{WRAPPER}} .ht-flip-box-rear-container',
				]
			);

			
			$this->add_group_control(
				Group_Control_Border::get_type(),
					[
						'name' => 'ht_filbpox_back_border',
						'label' => esc_html__( 'Border Style', 'hubTag-addons-elementor' ),
						'selector' => '{{WRAPPER}} .ht-flip-box-rear-container' ,
					]
			);			


			$this->add_control(
				'ht_flipbox_back_title',
				[
					'label' => esc_html__( 'Back Title', 'hubTag-addons-elementor' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'Back Title', 'hubTag-addons-elementor' ),
				]
			);

			$this->add_control(
				'ht_flipbox_back_text',
				[
					'label' => esc_html__( 'Back Text', 'hubTag-addons-elementor' ),
					'type' => Controls_Manager::WYSIWYG,
					'label_block' => true,
					'default' => __( 'This is back side content.', 'hubTag-addons-elementor' ),
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();
			
		$this->add_control(
			'ht_flipbox_content_alignment',
			[
				'label' => esc_html__( 'Content Alignment', 'hubTag-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'hubTag-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'hubTag-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'hubTag-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'prefix_class' => 'ht-flipbox-content-align-',
			]
		);

		$this->end_controls_section();
				
  		/**
  		 * Flipbox Image Settings
  		 */
  		$this->start_controls_section(
  			'ht_section_flipbox_content_settings',
  			[
  				'label' => esc_html__( 'Flipbox Settings', 'hubTag-addons-elementor' )
  			]
  		);

  		$this->add_control(
		  'ht_flipbox_type',
		  	[
		   	'label'       	=> esc_html__( 'Flipbox Type', 'hubTag-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'animate-left',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'animate-left'  		=> esc_html__( 'Flip Left', 'hubTag-addons-elementor' ),
		     		'animate-right' 		=> esc_html__( 'Flip Right', 'hubTag-addons-elementor' ),
		     		'animate-up' 			=> esc_html__( 'Flip Top', 'hubTag-addons-elementor' ),
		     		'animate-down' 		=> esc_html__( 'Flip Bottom', 'hubTag-addons-elementor' ),
		     		'animate-zoom-in' 	=> esc_html__( 'Zoom In', 'hubTag-addons-elementor' ),
		     		'animate-zoom-out' 	=> esc_html__( 'Zoom Out', 'hubTag-addons-elementor' ),
		     		'animate-push ht-animate-up' 	=> esc_html__( '3D Flip Top', 'hubTag-addons-elementor' ),
		     		'animate-push ht-animate-down' 	=> esc_html__( '3D Flip Bottom', 'hubTag-addons-elementor' ),
		     		'animate-push ht-animate-left' 	=> esc_html__( '3D Flip Left', 'hubTag-addons-elementor' ),
		     		'animate-push ht-animate-right' 	=> esc_html__( '3D Flip Right', 'hubTag-addons-elementor' ),
		     	],
		  	]
		);

		$this->start_controls_tabs('icon_image_front_back');

			$this->start_controls_tab(
				'front',
				[
					'label'	=> __( 'Front', 'hubTag-addons-elementor' )
				]
			);

			$this->add_control(
				'ht_flipbox_img_or_icon',
				[
					'label' => esc_html__( 'Icon Type', 'hubTag-addons-elementor' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'none'	=> __( 'None', 'hubTag-addons-elementor' ),
						'img'	=> __( 'Image', 'hubTag-addons-elementor' ),
						'icon'	=> __( 'Icon', 'hubTag-addons-elementor' )
					],
					'default' => 'icon',
				]
			);

			$this->add_control(
				'ht_flipbox_image',
				[
					'label' => esc_html__( 'Flipbox Image', 'hubTag-addons-elementor' ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'condition' => [
						'ht_flipbox_img_or_icon' => 'img'
					]
				]
			);

			$this->add_control(
				'ht_flipbox_icon',
				[
					'label' => esc_html__( 'Icon', 'hubTag-addons-elementor' ),
					'type' => Controls_Manager::ICON,
					'default' => 'fa fa-snowflake-o',
					'condition' => [
						'ht_flipbox_img_or_icon' => 'icon'
					]
				]
			);

			$this->add_responsive_control(
				'ht_flipbox_image_resizer',
				[
					'label' => esc_html__( 'Image Resizer', 'hubTag-addons-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => '100'
					],
					'range' => [
						'px' => [
							'max' => 500,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ht-flip-box-front-container .ht-flip-box-icon-image > img' => 'width: {{SIZE}}px;'
					],
					'condition'	=> [
						'ht_flipbox_img_or_icon'	=> 'img'
					]
				]
			);

				$this->add_group_control(
					Group_Control_Image_Size::get_type(),
					[
						'name' => 'thumbnail',
						'default' => 'full',
						'condition' => [
							'ht_flipbox_image[url]!' => '',
							'ht_flipbox_img_or_icon'	=> 'img'
						],
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'back',
				[
					'label'	=> __( 'Back', 'hubTag-addons-elementor' )
				]
			);

				$this->add_control(
					'ht_flipbox_img_or_icon_back',
					[
						'label' => esc_html__( 'Icon Type', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'none'	=> __( 'None', 'hubTag-addons-elementor' ),
							'img'	=> __( 'Image', 'hubTag-addons-elementor' ),
							'icon'	=> __( 'Icon', 'hubTag-addons-elementor' )
						],
						'default' => 'icon'
					]
				);

				$this->add_control(
					'ht_flipbox_image_back',
					[
						'label' => esc_html__( 'Flipbox Image', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'condition'	=> [
							'ht_flipbox_img_or_icon_back'	=> 'img'
						]
					]
				);

				$this->add_control(
					'ht_flipbox_icon_back',
					[
						'label' => esc_html__( 'Icon', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::ICON,
						'default' => 'fa fa-snowflake-o',
						'condition'	=> [
							'ht_flipbox_img_or_icon_back'	=> 'icon'
						]
					]
				);

				$this->add_responsive_control(
					'ht_flipbox_image_resizer_back',
					[
						'label' => esc_html__( 'Image Resizer', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => '100'
						],
						'range' => [
							'px' => [
								'max' => 500,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .ht-flip-box-rear-container .ht-flip-box-icon-image > img' => 'width: {{SIZE}}px;'
						],
						'condition'	=> [
							'ht_flipbox_img_or_icon_back'	=> 'img'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Image_Size::get_type(),
					[
						'name' => 'thumbnail_back',
						'default' => 'full',
						'condition' => [
							'ht_flipbox_image[url]!' => '',
							'ht_flipbox_img_or_icon_back'	=> 'img'
						],
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();



		/**
		 * ----------------------------------------------
		 * Flipbox Link
		 * ----------------------------------------------
		 */
		$this->start_controls_section(
			'ht_flixbox_link_section',
			[
				'label' => esc_html__( 'Link', 'hubTag-addons-elementor' )
			]
		);

		$this->add_control(
            'flipbox_link_type',
            [
                'label'                 => __( 'Link Type', 'hubTag-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'none',
                'options'               => [
                    'none'      => __( 'None', 'hubTag-addons-elementor' ),
                    'box'       => __( 'Box', 'hubTag-addons-elementor' ),
                    'title'     => __( 'Title', 'hubTag-addons-elementor' ),
                    'button'    => __( 'Button', 'hubTag-addons-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'flipbox_link',
            [
                'label'                 => __( 'Link', 'hubTag-addons-elementor' ),
                'type'                  => Controls_Manager::URL,
				'dynamic'               => [
					'active'        => true,
                    'categories'    => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY
                    ],
				],
                'placeholder'           => 'https://www.your-link.com',
                'default'               => [
                    'url' => '#',
                ],
                'condition'             => [
                    'flipbox_link_type!'   => 'none',
                ],
            ]
        );

        $this->add_control(
            'flipbox_button_text',
            [
                'label'                 => __( 'Button Text', 'hubTag-addons-elementor' ),
                'type'                  => Controls_Manager::TEXT,
				'dynamic'               => [
					'active'   => true,
				],
                'default'               => __( 'Get Started', 'hubTag-addons-elementor' ),
                'condition'             => [
                    'flipbox_link_type'   => 'button',
                ],
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label'                 => __( 'Button Icon', 'hubTag-addons-elementor' ),
                'type'                  => Controls_Manager::ICON,
                'default'               => '',
                'condition'             => [
                    'flipbox_link_type'   => 'button',
                ],
            ]
        );
        
        $this->add_control(
            'button_icon_position',
            [
                'label'                 => __( 'Icon Position', 'hubTag-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'after',
                'options'               => [
                    'after'     => __( 'After', 'hubTag-addons-elementor' ),
                    'before'    => __( 'Before', 'hubTag-addons-elementor' ),
                ],
                'condition'             => [
                    'flipbox_link_type'     => 'button',
                    'button_icon!'  => '',
                ],
            ]
        );

		$this->end_controls_section();

        
		/**
		 * -------------------------------------------
		 * Tab Style (Flipbox Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_flipbox_style_settings',
			[
				'label' => esc_html__( 'Filp Box Style', 'hubTag-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ht_widht_flipbox',
			[
				'label' => esc_html__( 'Width', 'hubTag-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'min'	=> 0,
						'step'	=> 1,
						'max'	=> 500,
					],
					'%'	=> [
						'min'	=> 40,
						'step'	=> 3,
						'max'	=> 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .ht-flip-box-container'	=> 'width: {{SIZE}}{{UNIT}};',

				],
				
			]
		);
		

		$this->add_control(
			'ht_height_flipbox',
			[
				'label' => esc_html__( 'Height', 'hubTag-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'min'	=> 0,
						'step'	=> 1,
						'max'	=> 500,
					],
					'%'	=> [
						'min'	=> 40,
						'step'	=> 3,
						'max'	=> 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .ht-flip-box-container'	=> 'height: {{SIZE}}{{UNIT}};',

				],
				
			]
		);
		

		$this->add_responsive_control(
			'ht_flipbox_front_back_padding',
			[
				'label' => esc_html__( 'Content Padding', 'hubTag-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-flip-box-front-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 					'{{WRAPPER}} .ht-flip-box-rear-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'ht_filbpox_border',
					'label' => esc_html__( 'Border Style', 'hubTag-addons-elementor' ),
					'selector' => '{{WRAPPER}} .ht-flip-box-front-container, {{WRAPPER}} .ht-flip-box-rear-container',
				]
		);

		$this->add_control(
			'ht_flipbox_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hubTag-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'min'	=> 0,
						'step'	=> 1,
						'max'	=> 500,
					],
					'%'	=> [
						'min'	=> 0,
						'step'	=> 3,
						'max'	=> 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .ht-flip-box-front-container'	=> 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ht-flip-box-rear-container'	=> 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ht_flipbox_shadow',
				'selector' => '{{WRAPPER}} .ht-flip-box-front-container, {{WRAPPER}} .ht-flip-box-rear-container'
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Image)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_flipbox_imgae_style_settings',
			[
				'label' => esc_html__( 'Image Style', 'hubTag-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
		     		'ht_flipbox_img_or_icon' => 'img'
		     	]
			]
		);

		$this->add_control(
		  'ht_flipbox_img_type',
		  	[
		   	'label'       	=> esc_html__( 'Image Type', 'hubTag-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'default',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'circle'  	=> esc_html__( 'Circle', 'hubTag-addons-elementor' ),
		     		'radius' 	=> esc_html__( 'Radius', 'hubTag-addons-elementor' ),
		     		'default' 	=> esc_html__( 'Default', 'hubTag-addons-elementor' ),
		     	],
		     	'prefix_class' => 'ht-flipbox-img-',
		     	'condition' => [
		     		'ht_flipbox_img_or_icon' => 'img'
		     	]
		  	]
		);

		/**
		 * Condition: 'ht_flipbox_img_type' => 'radius'
		 */
		$this->add_control(
			'ht_filpbox_img_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hubTag-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ht-flip-box-icon-image img' => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .ht-flip-box-icon-image img' => 'border-radius: {{SIZE}}px;',
				],
				'condition' => [
					'ht_flipbox_img_or_icon' => 'img',
					'ht_flipbox_img_type' => 'radius'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Icon Style)
		 * -------------------------------------------
		 */		
		$this->start_controls_section(
			'ht_section_flipbox_icon_style_settings',
			[
				'label' => esc_html__( 'Icon Style', 'hubTag-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
		     		'ht_flipbox_img_or_icon' => 'icon'
		     	]
			]
		);

		$this->start_controls_tabs('ht_section_icon_style_settings');
			$this->start_controls_tab('ht_section_icon_front_style_settings', [
				'label' => esc_html__( 'Front', 'hubTag-addons-elementor' )
			]);

			$this->add_group_control(
				Group_Control_Border::get_type(),
					[
						'name' => 'ht_flipbox_icon_front_border',
						'label' => esc_html__( 'Border', 'hubTag-addons-elementor' ),
						'selector' => '{{WRAPPER}} .ht-flip-box-front-container .ht-flip-box-icon-image',
						'condition' => [
							'ht_flipbox_img_or_icon' => 'icon'
						]
					]
			);
	
			$this->add_responsive_control(
				'ht_flipbox_icon_front_padding',
				[
					'label' => esc_html__( 'Padding', 'hubTag-addons-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em' ],
					'selectors' => [
						 '{{WRAPPER}} .ht-flip-box-front-container .ht-flip-box-icon-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					 ],
				]
			);
	
			$this->add_control(
				'ht_flipbox_icon_front_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'hubTag-addons-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units'	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min'	=> 0,
							'step'	=> 1,
							'max'	=> 500,
						],
						'%'	=> [
							'min'	=> 0,
							'step'	=> 3,
							'max'	=> 100
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ht-flip-box-front-container .ht-flip-box-icon-image'	=> 'border-radius: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'ht_flipbox_img_or_icon' => 'icon'
					]
				]
			);
			
			$this->end_controls_tab();
			
			$this->start_controls_tab('ht_section_icon_back_style_settings', [
				'label' => esc_html__( 'Back', 'hubTag-addons-elementor' )
			]);

			$this->add_group_control(
				Group_Control_Border::get_type(),
					[
						'name' => 'ht_flipbox_icon_back_border',
						'label' => esc_html__( 'Border', 'hubTag-addons-elementor' ),
						'selector' => '{{WRAPPER}} .ht-flip-box-rear-container .ht-flip-box-icon-image',
						'condition' => [
							'ht_flipbox_img_or_icon' => 'icon'
						]
					]
			);
	
			$this->add_responsive_control(
				'ht_flipbox_icon_back_padding',
				[
					'label' => esc_html__( 'Padding', 'hubTag-addons-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em' ],
					'selectors' => [
						 '{{WRAPPER}} .ht-flip-box-rear-container .ht-flip-box-icon-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					 ],
				]
			);
	
			$this->add_control(
				'ht_flipbox_icon_back_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'hubTag-addons-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units'	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min'	=> 0,
							'step'	=> 1,
							'max'	=> 500,
						],
						'%'	=> [
							'min'	=> 0,
							'step'	=> 3,
							'max'	=> 100
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ht-flip-box-rear-container .ht-flip-box-icon-image'	=> 'border-radius: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'ht_flipbox_img_or_icon' => 'icon'
					]
				]
			);

			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Title Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_flipbox_title_style_settings',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'hubTag-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->start_controls_tabs('ht_section_flipbox_typo_style_settings');
			$this->start_controls_tab('ht_section_flipbox_typo_style_front_settings', [
				'label' => esc_html__( 'Front', 'hubTag-addons-elementor' )
			]);

				/**
				 * Icon
				 */
				$this->add_control(
					'ht_flipbox_front_icon_heading',
					[
						'label' => esc_html__( 'Icon Style', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::HEADING,
					]
				);

				$this->add_control(
					'ht_flipbox_front_icon_color',
					[
						'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							'{{WRAPPER}} .ht-flip-box-front-container .ht-flip-box-icon-image i' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
		            	'name' => 'ht_flipbox_front_icon_typography',
						'selector' => '{{WRAPPER}} .ht-flip-box-front-container .ht-flip-box-icon-image i',
					]
				);

				/**
				 * Title
				 */
				$this->add_control(
					'ht_flipbox_front_title_heading',
					[
						'label' => esc_html__( 'Title Style', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before'
					]
				);

				$this->add_control(
					'ht_flipbox_front_title_color',
					[
						'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							'{{WRAPPER}} .ht-flip-box-front-container .ht-flip-box-heading' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
		            	'name' => 'ht_flipbox_front_title_typography',
						'selector' => '{{WRAPPER}} .ht-flip-box-front-container .ht-flip-box-heading'
					]
				);

				/**
				 * Content
				 */
				$this->add_control(
					'ht_flipbox_front_content_heading',
					[
						'label' => esc_html__( 'Content Style', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before'
					]
				);

				$this->add_control(
					'ht_flipbox_front_content_color',
					[
						'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							'{{WRAPPER}} .ht-flip-box-front-container .ht-flip-box-content' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
		            	'name' => 'ht_flipbox_front_content_typography',
						'selector' => '{{WRAPPER}} .ht-flip-box-front-container .ht-flip-box-content'
					]
				);
				
			$this->end_controls_tab();

			$this->start_controls_tab('ht_section_flipbox_typo_style_back_settings', [
				'label' => esc_html__( 'Back', 'hubTag-addons-elementor' )
			]);

				/**
				 * Icon
				 */
				$this->add_control(
					'ht_flipbox_back_icon_heading',
					[
						'label' => esc_html__( 'Icon Style', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::HEADING,
					]
				);

				$this->add_control(
					'ht_flipbox_back_icon_color',
					[
						'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							'{{WRAPPER}} .ht-flip-box-rear-container .ht-flip-box-icon-image i' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
		            	'name' => 'ht_flipbox_back_icon_typography',
						'selector' => '{{WRAPPER}} .ht-flip-box-rear-container .ht-flip-box-icon-image i'
					]
				);

				/**
				 * Title
				 */
				$this->add_control(
					'ht_flipbox_back_title_heading',
					[
						'label' => esc_html__( 'Title Style', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before'
					]
				);

				$this->add_control(
					'ht_flipbox_back_title_color',
					[
						'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							'{{WRAPPER}} .ht-flip-box-rear-container .ht-flip-box-heading' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
		            	'name' => 'ht_flipbox_back_title_typography',
						'selector' => '{{WRAPPER}} .ht-flip-box-rear-container .ht-flip-box-heading'
					]
				);

				/**
				 * Content
				 */
				$this->add_control(
					'ht_flipbox_back_content_heading',
					[
						'label' => esc_html__( 'Content Style', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before'
					]
				);

				$this->add_control(
					'ht_flipbox_back_content_color',
					[
						'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							'{{WRAPPER}} .ht-flip-box-rear-container .ht-flip-box-content' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
		            	'name' => 'ht_flipbox_back_content_typography',
						'selector' => '{{WRAPPER}} .ht-flip-box-rear-container .ht-flip-box-content'
					]
				);

			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_flipbox_button_style_settings',
			[
				'label' => esc_html__( 'Button Style', 'hubTag-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'flipbox_link_type'	=> 'button'
				]
			]
		);

		$this->start_controls_tabs( 'flipbox_button_style_settings' );

			$this->start_controls_tab(
				'flipbox_button_normal_style',
				[
					'label'	=> __( 'Normal', 'hubTag-addons-elementor' )
				]
			);


			
				$this->add_responsive_control(
					'ht_flipbox_button_margin',
					[
						'label' => esc_html__( 'Margin', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em' ],
						'selectors' => [
			 				'{{WRAPPER}} .ht-flip-box-container .flipbox-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			 			],
					]
				);

				$this->add_responsive_control(
					'ht_flipbox_button_padding',
					[
						'label' => esc_html__( 'Padding', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em' ],
						'selectors' => [
			 				'{{WRAPPER}} .ht-flip-box-container .flipbox-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			 			],
					]
				);

				$this->add_control(
					'ht_flipbox_button_color',
					[
						'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .ht-flip-box-container .flipbox-button' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'ht_flipbox_button_bg_color',
					[
						'label' => esc_html__( 'Background', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#000000',
						'selectors' => [
							'{{WRAPPER}} .ht-flip-box-container .flipbox-button' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'ht_flipbox_button_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::SLIDER,
						'size_units'	=> [ 'px' ],
						'range' => [
							'px' => [
								'min'	=> 0,
								'step'	=> 1,
								'max'	=> 100,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .ht-flip-box-container .flipbox-button'	=> 'border-radius: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
		            	'name'		=> 'ht_flipbox_button_typography',
						'selector'	=> '{{WRAPPER}} .ht-flip-box-container .flipbox-button'
					]
				);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'flipbox_button_hover_style',
				[
					'label'	=> __( 'Hover', 'hubTag-addons-elementor' )
				]
			);
				$this->add_control(
					'ht_flipbox_button_hover_color',
					[
						'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .ht-flip-box-container .flipbox-button:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'ht_flipbox_button_hover_bg_color',
					[
						'label' => esc_html__( 'Background', 'hubTag-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#000000',
						'selectors' => [
							'{{WRAPPER}} .ht-flip-box-container .flipbox-button:hover' => 'background: {{VALUE}};',
						],
					]
				);
			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings();
		$flipbox_image = $this->get_settings( 'ht_flipbox_image' );
	  	$flipbox_image_url = Group_Control_Image_Size::get_attachment_image_src( $flipbox_image['id'], 'thumbnail', $settings );
	  	( empty( $flipbox_image_url ) ) ? $flipbox_image_url = $flipbox_image['url'] : $flipbox_image_url = $flipbox_image_url;

	  	$flipbox_if_html_tag = 'div';
	  	$flipbox_if_html_title_tag = 'h2';
	  	$this->add_render_attribute('flipbox-container', 'class', 'ht-flip-box-flip-card');
	  	$this->add_render_attribute('flipbox-title-container', 'class', 'ht-flip-box-heading');

	  	if( $settings['flipbox_link_type'] != 'none' ) {
	  		if( ! empty($settings['flipbox_link']['url']) ) {
	  			if( $settings['flipbox_link_type'] == 'box' ) {
	  				$flipbox_if_html_tag = 'a';

	  				$this->add_render_attribute( 'flipbox-container', 'href', esc_url($settings['flipbox_link']['url']) );

	  				if( $settings['flipbox_link']['is_external'] ) {
	  					$this->add_render_attribute( 'flipbox-container', 'target', '_blank' );
	  				}

	  				if( $settings['flipbox_link']['nofollow'] ) {
	  					$this->add_render_attribute('flipbox-container', 'rel', 'nofollow');
	  				}
	  			} elseif( $settings['flipbox_link_type'] == 'title' ) {
	  				$flipbox_if_html_title_tag = 'a';

	  				$this->add_render_attribute(
	  					'flipbox-title-container',
		  				[
		  					'class'	=> 'flipbox-linked-title',
		  					'href' => $settings['flipbox_link']['url']
		  				]
		  			);

	  				if( $settings['flipbox_link']['is_external'] ) {
	  					$this->add_render_attribute('flipbox-title-container', 'target', '_blank');
	  				}

	  				if( $settings['flipbox_link']['nofollow'] ) {
	  					$this->add_render_attribute('flipbox-title-container', 'rel', 'nofollow');
	  				}
	  			} elseif( $settings['flipbox_link_type'] == 'button' ) {
	  				$this->add_render_attribute(
	  					'flipbox-button-container',
	  					[
	  						'class'	=> 'flipbox-button',
	  						'href'	=> $settings['flipbox_link']['url']
	  					]
	  				);

	  				if($settings['flipbox_link']['is_external']) {
	  					$this->add_render_attribute('flipbox-button-container', 'target', '_blank' );
	  				}

	  				if($settings['flipbox_link']['nofollow']) {
	  					$this->add_render_attribute('flipbox-button-container', 'rel', 'nofollow' );
	  				}
	  			}
	  		}
	  	}


		$flipbox_image_back = $this->get_settings( 'ht_flipbox_image_back' );
	  	$flipbox_back_image_url = Group_Control_Image_Size::get_attachment_image_src( $flipbox_image_back['id'], 'thumbnail_back', $settings );
	  	$flipbox_back_image_url = empty($flipbox_back_image_url) ? $flipbox_back_image_url['url'] : $flipbox_back_image_url;

	  	if( $settings['ht_flipbox_img_or_icon_back'] != 'none' ) {
	  		if( 'img' == $settings['ht_flipbox_img_or_icon_back'] ) {
	  			$this->add_render_attribute(
	  				'flipbox-back-icon-image-container',
	  				[
	  					'src'	=> $flipbox_back_image_url,
	  					'alt'	=> 'flipbox-image'
	  				]
	  			);
	  		}elseif( 'icon' == $settings['ht_flipbox_img_or_icon_back'] ) {
	  			$this->add_render_attribute(
	  				'flipbox-back-icon-container',
	  				[
	  					'class'	=> $settings['ht_flipbox_icon_back'],
	  					'aria-hidden' => 'true'
	  				]
	  			);
	  		}
	  	}

	  	$this->add_render_attribute(
	  		'ht_flipbox_main_wrap',
	  		[
	  			'class'	=> [
	  				'ht-flip-box-container',
	  				'ht-animate-flip',
	  				'ht-'.esc_attr( $settings['ht_flipbox_type'] )
	  			]
	  		]
		  );

		if($settings['ht_filbpox_front_border_border'] !== 'none'){
			$class_front = "front-end-border";
		}elseif($settings['ht_filbpox_back_border'] !== 'none'){
			$class_back = "back-end-border";
		}


	?>

	<div <?php echo $this->get_render_attribute_string('ht_flipbox_main_wrap'); ?>>

	    <<?php echo $flipbox_if_html_tag,' ',$this->get_render_attribute_string('flipbox-container'); ?>>
	        <div class="ht-flip-box-front-container <?php echo $class_front; ?>">
	            <div class="ht-slider-display-table" >
	                <div class="ht-flip-box-vertical-align">
	                    <div class="ht-flip-box-padding">
	                        <div class="ht-flip-box-icon-image">
								<?php if( 'icon' === $settings['ht_flipbox_img_or_icon'] ) : ?>
									<i class="<?php echo esc_attr( $settings['ht_flipbox_icon'] ); ?>"></i>
								<?php elseif( 'img' === $settings['ht_flipbox_img_or_icon'] ): ?>
									<img src="<?php echo esc_url( $flipbox_image_url ); ?>" alt="">
								<?php endif; ?>
	                        </div>
	                        <h2 class="ht-flip-box-heading"><?php echo esc_html__( $settings['ht_flipbox_front_title'], 'hubTag-addons-elementor' ); ?></h2>
	                        <div class="ht-flip-box-content">
	                           <p><?php echo __( $settings['ht_flipbox_front_text'], 'hubTag-addons-elementor' ); ?></p>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>

	        <div class="ht-flip-box-rear-container <?php echo $class_back; ?>">
	            <div class="ht-slider-display-table">
	                <div class="ht-flip-box-vertical-align">
	                    <div class="ht-flip-box-padding">
	                    	<?php if( 'none' != $settings['ht_flipbox_img_or_icon_back'] ) : ?>
	                    		<div class="ht-flip-box-icon-image">
	                    			<?php if('img' == $settings['ht_flipbox_img_or_icon_back']) : ?>
	                    				<img <?php echo $this->get_render_attribute_string('flipbox-back-icon-image-container'); ?>>
	                				<?php elseif('icon' == $settings['ht_flipbox_img_or_icon_back']): ?>
	                					<i <?php echo $this->get_render_attribute_string('flipbox-back-icon-container'); ?>></i>
	                				<?php endif; ?>
	                			</div>
	                    	<?php endif; ?>

	                        <<?php echo $flipbox_if_html_title_tag,' ', $this->get_render_attribute_string('flipbox-title-container'); ?>><?php echo esc_html__( $settings['ht_flipbox_back_title'], 'hubTag-addons-elementor' ); ?></<?php echo $flipbox_if_html_title_tag; ?>>
	                        <div class="ht-flip-box-content">
	                           <p><?php echo __( $settings['ht_flipbox_back_text'], 'hubTag-addons-elementor' ); ?></p>
	                        </div>

	                        <?php if( $settings['flipbox_link_type'] == 'button' && ! empty($settings['flipbox_button_text']) ) : ?>
	                        	<a <?php echo $this->get_render_attribute_string('flipbox-button-container'); ?>>
	                        		<?php if( ! empty($settings['button_icon']) && 'before' == $settings['button_icon_position'] ) : ?>
	                        			<i class="<?php echo $settings['button_icon']; ?>"></i>
	                        		<?php endif; ?>
	                        		<?php echo esc_attr($settings['flipbox_button_text']); ?>
	                        		<?php if( ! empty($settings['button_icon']) && 'after' == $settings['button_icon_position'] ) : ?>
	                        			<i class="<?php echo $settings['button_icon']; ?>"></i>
	                        		<?php endif; ?>
	                        	</a>
	                        <?php endif; ?>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </<?php echo $flipbox_if_html_tag; ?>>
	</div>

	<?php
	}

	protected function content_template() {}
}