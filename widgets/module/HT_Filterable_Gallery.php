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

class HT_Filterable_Gallery extends Widget_Base {

	public function get_name() {
		return 'ht-filterable-gallery';
	}

	public function get_title() {
		return esc_html__( 'HT Filterable Gallery', 'hubtag-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

   	public function get_categories() {
		return ['hubtag-elementor-addons'];
	}

	public function get_script_depends() {
        return [
			'ht-scripts',
			'imagesloaded',
			'jquery-resize',
			'hubtag_addons_isotope-js'
        ];
    }

	protected function _register_controls() {
		/**
  		 * Filter Gallery Settings
  		 */
  		$this->start_controls_section(
  			'ht_section_fg_settings',
  			[
  				'label' => esc_html__( 'Settings', 'hubtag-elementor-addons' )
  			]
		);
		  
		$this->add_control(
			'ht_fg_items_to_show',
			[
				'label'			=> esc_html__( 'Items to show', 'hubtag-elementor-addons' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> false,
				'default'		=> 6
			]
		);

		$this->add_control(
			'ht_fg_filter_duration',
			[
				'label' => esc_html__( 'Animation Duration (ms)', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => 500,
			]
		);

		$this->add_responsive_control(
            'columns',
            [
                'label'                 => __( 'Columns', 'hubtag-elementor-addons' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => '3',
                'tablet_default'        => '2',
                'mobile_default'        => '1',
                'options'               => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6'
                ],
                'prefix_class'          => 'elementor-grid%s-',
                'frontend_available'    => true,
            ]
        );

		$this->add_control(
			'ht_fg_grid_style',
			[
				'label' => esc_html__( 'Layout', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid'		=> esc_html__( 'Grid', 'hubtag-elementor-addons' ),
					'masonry'	=> esc_html__( 'Masonry', 'hubtag-elementor-addons' )
				],
			]
		);

		$this->add_control(
			'ht_fg_grid_item_height',
			[
				'label'		=> esc_html__( 'Image Height', 'hubtag-elementor-addons' ),
				'type'		=> Controls_Manager::TEXT,
				'default'	=> '300',
				'condition'	=> [
					'ht_fg_grid_style'	=> 'grid'
				],
				'selectors'	=> [
					'{{WRAPPER}} .ht-filterable-gallery-item-wrap .gallery-grid-item .gallery-item-thumbnail-wrap'	=> 'height: {{VALUE}}px;'
				]
			]
		);

		$this->add_control(
			'ht_fg_caption_style',
			[
				'label' => esc_html__( 'Caption Style', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'hoverer',
				'options' => [
					'hoverer'	=> __( 'Overlay', 'hubtag-elementor-addons' ),
					'card'		=> __( 'Card', 'hubtag-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'ht_fg_grid_hover_style',
			[
				'label'		=> esc_html__( 'Hover Style', 'hubtag-elementor-addons' ),
				'type'		=> Controls_Manager::SELECT,
				'default'	=> 'ht-slide-up',
				'options'	=> [
					'ht-none'		=> esc_html__( 'None', 'hubtag-elementor-addons' ),
					'ht-slide-up'	=> esc_html__( 'Slide In Up', 'hubtag-elementor-addons' ),
					'ht-fade-in' 	=> esc_html__( 'Fade In',   'hubtag-elementor-addons' ),
					'ht-zoom-in' 	=> esc_html__( 'Zoom In ', 'hubtag-elementor-addons' )
				],
				'condition'	=> [
					'ht_fg_caption_style'	=> 'hoverer'
				]
				
			]
		);
		$this->add_control(
			'ht_fg_grid_hover_transition',
			[
				'label' => esc_html__( 'Hover Transition', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 500,
				],
				'range' => [
					'px' => [
						'max' => 4000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap' => 'transition: {{SIZE}}ms;',
				],
				'condition'	=> [
					'ht_fg_grid_hover_style!'	=> 'ht-none'
				]
			]
		);

		$this->add_control(
			'ht_fg_show_popup',
			[
				'label' => esc_html__( 'Link to', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'buttons',
				'options' => [
					'none' 		=> esc_html__( 'None', 'hubtag-elementor-addons' ),
					'media' 	=> esc_html__( 'Media',   'hubtag-elementor-addons' ),
					'buttons' 	=> esc_html__( 'Buttons', 'hubtag-elementor-addons' )
				],
			]
		);

  		$this->add_control(
			'ht_section_fg_zoom_icon',
			[
				'label'		=> esc_html__( 'Lightbox Icon', 'hubtag-elementor-addons' ),
				'type'		=> Controls_Manager::ICON,
				'default'	=> 'fa fa-search-plus',
				'condition'	=> [
					'ht_fg_show_popup'	=> 'buttons'
				]
			]
		);

		$this->add_control(
			'ht_section_fg_link_icon',
			[
				'label'		=> esc_html__( 'Link Icon', 'hubtag-elementor-addons' ),
				'type'		=> Controls_Manager::ICON,
				'default'	=> 'fa fa-link',
				'condition'	=> [
					'ht_fg_show_popup'	=> 'buttons'
				]
			]
		);

  		$this->end_controls_section();

		/**
  		 * Filter Gallery Control Settings
  		 */
  		$this->start_controls_section(
  			'ht_section_fg_control_settings',
  			[
  				'label' => esc_html__( 'Filterable Controls', 'hubtag-elementor-addons' )
  			]
		);

		$this->add_control(
			'filter_enable',
			[
				'label'                 => __( 'Enable Filter', 'hubtag-elementor-addons' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
			]
		);
		  
		$this->add_control(
			'ht_fg_all_label_text',
			[
				'label'		=> esc_html__( 'Gallery All Label', 'hubtag-elementor-addons' ),
				'type'		=> Controls_Manager::TEXT,
				'default'	=> 'All',
				'condition'	=> [
					'filter_enable'	=> 'yes'
				]
			]
		);

  		$this->add_control(
			'ht_fg_controls',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'ht_fg_control' => 'Gallery Item' ],
				],
				'fields' => [
					[
						'name' => 'ht_fg_control',
						'label' => esc_html__( 'List Item', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( 'Gallery Item', 'hubtag-elementor-addons' )
					],
				],
				'title_field' => '{{ht_fg_control}}',
			]
		);

  		$this->end_controls_section();

  		/**
  		 * Filter Gallery Grid Settings
  		 */
  		$this->start_controls_section(
  			'ht_section_fg_grid_settings',
  			[
  				'label' => esc_html__( 'Gallery Items', 'hubtag-elementor-addons' )
  			]
		);
		  
		$this->add_control(
			'photo_gallery',
			[
				'label'                 => __( 'Enable Photo Gallery', 'hubtag-elementor-addons' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
                'frontend_available'    => true,
			]
		);

  		$this->add_control(
			'ht_fg_gallery_items',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'ht_fg_gallery_item_name' => 'Gallery Item Name' ],
					[ 'ht_fg_gallery_item_name' => 'Gallery Item Name' ],
					[ 'ht_fg_gallery_item_name' => 'Gallery Item Name' ],
					[ 'ht_fg_gallery_item_name' => 'Gallery Item Name' ],
					[ 'ht_fg_gallery_item_name' => 'Gallery Item Name' ],
					[ 'ht_fg_gallery_item_name' => 'Gallery Item Name' ],
				],
				'fields' => [
					// [
					// 	'name'		=> 'fg_video_gallery_switch',
					// 	'label'		=> __( 'Video Gallery?', 'hubtag-elementor-addons' ),
					// 	'type'		=> Controls_Manager::SWITCHER,
					// 	'default'	=> 'false',
					// 	'label_on'	=> esc_html__( 'Yes', 'hubtag-elementor-addons' ),
					// 	'label_off'	=> esc_html__( 'No', 'hubtag-elementor-addons' ),
					// 	'return_value' => 'true',
					// ],
					[
						'name'		=> 'ht_fg_gallery_item_video_link',
						'label'		=> esc_html__( 'Video Link', 'hubtag-elementor-addons' ),
						'type'		=> Controls_Manager::TEXT,
						'label_block'	=> true,
						'default'		=> 'https://www.youtube.com/watch?v=kB4U67tiQLA',
						'condition'		=> [
							'fg_video_gallery_switch'	=> 'true'
						]
					],
					[
						'name' => 'ht_fg_gallery_control_name',
						'label' => esc_html__( 'Control Name', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default'		=> '',
						'description' => __( 'Use the gallery control name from Control Settings. Separate multiple items with comma (e.g. <strong>Gallery Item, Gallery Item 2</strong>)', 'hubtag-elementor-addons' )
					],
					[
						'name' => 'ht_fg_gallery_item_name',
						'label' => esc_html__( 'Item Name', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( 'Gallery item name', 'hubtag-elementor-addons' ),
					],
					[
						'name' => 'ht_fg_gallery_item_content',
						'label' => esc_html__( 'Item Content', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::TEXTAREA,
						'label_block' => true,
						'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, provident.', 'hubtag-elementor-addons' ),
					],
					[
						'name' => 'ht_fg_gallery_img',
						'label' => esc_html__( 'Image', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => plugin_dir_url('/') . 'hubtag-addons-elementor/assets/images/demo.png',
						],
					],
					[
						'name'		=> 'fg_video_gallery_play_icon',
						'label'		=> __( 'Video play icon', 'hubtag-elementor-addons' ),
						'type'		=> Controls_Manager::MEDIA,
						'default' => [
							'url' => plugin_dir_url('/') . 'hubtag-addons-elementor/assets/images/play-icon.png',
						],
						'condition'	=> [
							'fg_video_gallery_switch'	=> 'true'
						]
					],
					[
						'name'		=> 'ht_fg_gallery_lightbox',
						'label'		=> __( 'Gallery Lightbox Button?', 'hubtag-elementor-addons' ),
						'type'		=> Controls_Manager::SWITCHER,
						'default'	=> 'true',
						'label_on'	=> esc_html__( 'Yes', 'hubtag-elementor-addons' ),
						'label_off'	=> esc_html__( 'No', 'hubtag-elementor-addons' ),
						'return_value' => 'true',
						'condition'	=> [
							'fg_video_gallery_switch!'	=> 'true'
						]
				  	],
					[
						'name'		=> 'ht_fg_gallery_link',
						'label'		=> __( 'Gallery Link Button?', 'hubtag-elementor-addons' ),
						'type'		=> Controls_Manager::SWITCHER,
						'default'	=> 'true',
						'label_on'	=> esc_html__( 'Yes', 'hubtag-elementor-addons' ),
						'label_off'	=> esc_html__( 'No', 'hubtag-elementor-addons' ),
						'return_value' => 'true',
						'condition'	=> [
							'fg_video_gallery_switch!'	=> 'true'
						]
					],
				  	[
						'name' => 'ht_fg_gallery_img_link',
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'default' => [
		        			'url' => '#',
		        			'is_external' => '',
		     			],
		     			'show_external' => true,
		     			'condition' => [
							'fg_video_gallery_switch!'	=> 'true',
		     				'ht_fg_gallery_link' => 'true'
		     			]
					],
				],
				'title_field' => '{{ht_fg_gallery_item_name}}',
			]
		);

		$this->end_controls_section();
		  
		/**
         * Content Tab: Gallery Load More Button
         */
        $this->start_controls_section(
            'section_pagination',
            [
                'label'                 => __( 'Load More Button', 'hubtag-elementor-addons' ),
            ]
		);

		$this->add_control(
			'pagination',
			[
				'label'                 => __( 'Load More Button', 'hubtag-elementor-addons' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'false',
                'frontend_available'    => true,
			]
		);
		
		$this->add_control(
			'images_per_page',
			[
				'label'                 => __('Images Per Page', 'hubtag-elementor-addons'),
				'type'                  => Controls_Manager::TEXT,
				'default'			    => 6,
				'condition'			    => [
					'pagination'		=> 'yes'
				]
			]
		);

		$this->add_control(
			'load_more_text',
			[
				'label'				    => __('Button Text', 'hubtag-elementor-addons'),
				'type'				    => Controls_Manager::TEXT,
				'default'			    => __('Load More', 'hubtag-elementor-addons'),
				'condition'			    => [
					'pagination'		=> 'yes'
				]
			]
		);

		$this->add_control(
			'nomore_items_text',
			[
				'label'				    => __('No More Items Text', 'hubtag-elementor-addons'),
				'type'				    => Controls_Manager::TEXT,
				'default'			    => __('No more items!', 'hubtag-elementor-addons'),
				'condition'			    => [
					'pagination'		=> 'yes'
				]
			]
		);

		$this->add_control(
			'button_size',
			[
				'label'                 => __( 'Size', 'hubtag-elementor-addons' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'sm',
				'options'               => [
					'xs' => __( 'Extra Small', 'hubtag-elementor-addons' ),
					'sm' => __( 'Small', 'hubtag-elementor-addons' ),
					'md' => __( 'Medium', 'hubtag-elementor-addons' ),
					'lg' => __( 'Large', 'hubtag-elementor-addons' ),
					'xl' => __( 'Extra Large', 'hubtag-elementor-addons' ),
				],
				'condition'             => [
					'pagination'        => 'yes',
					'load_more_text!'   => '',
				],
			]
		);

        $this->add_control(
            'load_more_icon',
            [
                'label'                 => __( 'Button Icon', 'hubtag-elementor-addons' ),
                'type'                  => Controls_Manager::ICON,
                'default'               => '',
                'condition'             => [
                    'pagination'		=> 'yes'
                ],
            ]
        );
        
        $this->add_control(
            'button_icon_position',
            [
                'label'                 => __( 'Icon Position', 'hubtag-elementor-addons' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'after',
                'options'               => [
                    'after'     => __( 'After', 'hubtag-elementor-addons' ),
                    'before'    => __( 'Before', 'hubtag-elementor-addons' ),
                ],
                'condition'             => [
                    'pagination'		=> 'yes'
                ],
            ]
        );
        
        $this->add_responsive_control(
			'load_more_align',
			[
				'label'                 => __( 'Alignment', 'hubtag-elementor-addons' ),
				'type'                  => Controls_Manager::CHOOSE,
				'options'               => [
					'left'          => [
						'title'     => __( 'Left', 'hubtag-elementor-addons' ),
						'icon'      => 'eicon-h-align-left',
					],
					'center'        => [
						'title'     => __( 'Center', 'hubtag-elementor-addons' ),
						'icon'      => 'eicon-h-align-center',
					],
					'right'         => [
						'title'     => __( 'Right', 'hubtag-elementor-addons' ),
						'icon'      => 'eicon-h-align-right',
					],
				],
				'default'               => 'center',
				'selectors'             => [
					'{{WRAPPER}} .ht-filterable-gallery-loadmore'   => 'text-align: {{VALUE}};',
				],
                'condition'             => [
                    'pagination'		=> 'yes'
                ],
			]
		);

		$this->end_controls_section();

	

  		/**
		 * -------------------------------------------
		 * Tab Style (Filterable Gallery Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_fg_style_settings',
			[
				'label' => esc_html__( 'General Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ht_fg_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ht-filter-gallery-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ht_fg_container_padding',
			[
				'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-filter-gallery-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_responsive_control(
			'ht_fg_container_margin',
			[
				'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-filter-gallery-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ht_fg_border',
				'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ht-filter-gallery-wrapper',
			]
		);

		$this->add_control(
			'ht_fg_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ht-filter-gallery-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ht_fg_shadow',
				'selector' => '{{WRAPPER}} .ht-filter-gallery-wrapper',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Filterable Gallery Control Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_fg_control_style_settings',
			[
				'label' => esc_html__( 'Control Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'ht_fg_control_padding',
			[
				'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-filter-gallery-control ul li.control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_responsive_control(
			'ht_fg_control_margin',
			[
				'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-filter-gallery-control ul li.control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
	         'name' => 'ht_fg_control_typography',
				'selector' => '{{WRAPPER}} .ht-filter-gallery-control ul li.control',
			]
		);
		// Tabs
		$this->start_controls_tabs( 'ht_fg_control_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'ht_fg_control_normal', [ 'label' => esc_html__( 'Normal', 'hubtag-elementor-addons' ) ] );

			$this->add_control(
				'ht_fg_control_normal_text_color',
				[
					'label' => esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#444',
					'selectors' => [
						'{{WRAPPER}} .ht-filter-gallery-control ul li.control' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'ht_fg_control_normal_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .ht-filter-gallery-control ul li.control' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'ht_fg_control_normal_border',
					'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
					'selector' => '{{WRAPPER}} .ht-filter-gallery-control ul > li.control',
				]
			);

			$this->add_control(
				'ht_fg_control_normal_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'hubtag-elementor-addons' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 0
					],
					'range' => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ht-filter-gallery-control ul > li.control' => 'border-radius: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'ht_fg_control_shadow',
					'selector' => '{{WRAPPER}} .ht-filter-gallery-control ul li.control',
					'separator' => 'before'
				]
			);

			$this->end_controls_tab();

			// Active State Tab
			$this->start_controls_tab( 'ht_cta_btn_hover', [ 'label' => esc_html__( 'Active', 'hubtag-elementor-addons' ) ] );

			$this->add_control(
				'ht_fg_control_active_text_color',
				[
					'label' => esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .ht-filter-gallery-control ul li.active' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'ht_fg_control_active_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#333',
					'selectors' => [
						'{{WRAPPER}} .ht-filter-gallery-control ul li.control.active' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'ht_fg_control_active_border',
					'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
					'selector' => '{{WRAPPER}} .ht-filter-gallery-control ul > li.control.active',
				]
			);

			$this->add_control(
				'ht_fg_control_active_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'hubtag-elementor-addons' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 0
					],
					'range' => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ht-filter-gallery-control ul li.control.active' => 'border-radius: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'ht_fg_control_active_shadow',
					'selector' => '{{WRAPPER}} .ht-filter-gallery-control ul li.control.active',
					'separator' => 'before'
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Filterable Gallery Item Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_fg_item_style_settings',
			[
				'label' => esc_html__( 'Item Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'ht_fg_item_container_padding',
			[
				'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-filterable-gallery-item-wrap .gallery-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_responsive_control(
			'ht_fg_item_container_margin',
			[
				'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-filterable-gallery-item-wrap .gallery-grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ht_fg_item_border',
				'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ht-filterable-gallery-item-wrap .gallery-grid-item',
			]
		);

		$this->add_control(
			'ht_fg_item_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ht-filterable-gallery-item-wrap .gallery-grid-item' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ht_fg_item_shadow',
				'selector' => '{{WRAPPER}} .ht-filterable-gallery-item-wrap .gallery-grid-item',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Filterable Gallery Hoverer Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_fg_item_cap_style_settings',
			[
				'label'		=> esc_html__( 'Item Hover Style', 'hubtag-elementor-addons' ),
				'tab'		=> Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'ht_fg_caption_style'	=> 'hoverer'
				]
			]
		);

		$this->add_control(
			'ht_fg_item_cap_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.7)',
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap .gallery-item-hoverer-bg' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ht_fg_item_cap_container_padding',
			[
				'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .gallery-item-caption-wrap.caption-style-hoverer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_control(
			'ht_fg_item_hover_title_typography_heading',
			[
				'label' => esc_html__( 'Title Typography', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'ht_fg_item_hover_title_color',
			[
				'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap.caption-style-hoverer .fg-item-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_fg_item_hover_title_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap.caption-style-hoverer .fg-item-title:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             	'name' => 'ht_fg_item_hover_title_typography',
				'selector' => '{{WRAPPER}} .gallery-item-caption-wrap.caption-style-hoverer .fg-item-title',
			]
		);

		$this->add_control(
			'ht_fg_item_hover_content_typography_heading',
			[
				'label' => esc_html__( 'Content Typography', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'ht_fg_item_hover_content_color',
			[
				'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap.caption-style-hoverer .fg-item-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'		=> 'ht_fg_item_hover_content_typography',
				'selector'	=> '{{WRAPPER}} .gallery-item-caption-wrap.caption-style-hoverer .fg-item-content'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ht_fg_item_cap_border',
				'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
				'selector' => '{{WRAPPER}} .gallery-item-caption-wrap.caption-style-hoverer',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ht_fg_item_cap_shadow',
				'selector' => '{{WRAPPER}} .gallery-item-thumbnail-wrap .gallery-item-caption-wrap',
			]
		);

		$this->add_responsive_control(
			'ht_fg_item_hoverer_content_alignment',
			[
				'label' => esc_html__( 'Content Alignment', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'separator' => 'before',
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
				'prefix_class' => 'ht-fg-hoverer-content-align-',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Filterable Gallery card Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_fg_item_card_hover_style',
			[
				'label'		=> esc_html__( 'Item Hover Style', 'hubtag-elementor-addons' ),
				'tab'		=> Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'ht_fg_caption_style'	=> 'card'
				]
			]
		);

		$this->add_control(
			'ht_fg_item_card_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.7)',
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap.card-hover-bg' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Tab Style (Card Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_fg_item_content_style_settings',
			[
				'label' => esc_html__( 'Item Card Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'ht_fg_caption_style'	=> 'card'
				]
			]
		);

		$this->add_control(
			'ht_fg_item_content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f1f2f9',
				'selectors' => [
					'{{WRAPPER}} .ht-filterable-gallery-item-wrap .gallery-item-caption-wrap.caption-style-card' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ht_fg_item_content_container_padding',
			[
				'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ht-filterable-gallery-item-wrap .gallery-item-caption-wrap.caption-style-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ht_fg_item_content_border',
				'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ht-filterable-gallery-item-wrap .gallery-item-caption-wrap.caption-style-card',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ht_fg_item_content_shadow',
				'selector' => '{{WRAPPER}} .ht-filterable-gallery-item-wrap .gallery-item-caption-wrap.caption-style-card',
			]
		);

		$this->add_control(
			'ht_fg_item_content_title_typography_settings',
			[
				'label' => esc_html__( 'Title Typography', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'ht_fg_item_content_title_color',
			[
				'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#F56A6A',
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap.caption-style-card .fg-item-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_fg_item_content_title_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap.caption-style-card .fg-item-title:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             	'name' => 'ht_fg_item_content_title_typography',
				'selector' => '{{WRAPPER}} .gallery-item-caption-wrap.caption-style-card .fg-item-title',
			]
		);

		$this->add_control(
			'ht_fg_item_content_text_typography_settings',
			[
				'label' => esc_html__( 'Content Typography', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'ht_fg_item_content_text_color',
			[
				'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#444',
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap.caption-style-card .fg-item-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             	'name' => 'ht_fg_item_content_text_typography',
				'selector' => '{{WRAPPER}} .gallery-item-caption-wrap.caption-style-card .fg-item-content',
			]
		);

		$this->add_responsive_control(
			'ht_fg_item_content_alignment',
			[
				'label' => esc_html__( 'Content Alignment', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'separator' => 'before',
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
				'prefix_class' => 'ht-fg-card-content-align-',
			]
		);

		$this->end_controls_section();
		

		/**
		 * -------------------------------------------
		 * Tab Style (Hoverer Icon Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_fg_item_hover_icons_style',
			[
				'label'		=> esc_html__( 'Icons Style', 'hubtag-elementor-addons' ),
				'tab'		=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ht_fg_item_icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ff622a',
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap .gallery-item-buttons > a' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_fg_item_icon_color',
			[
				'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap .gallery-item-buttons > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ht_fg_item_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 				'{{WRAPPER}} .gallery-item-caption-wrap .gallery-item-buttons > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_responsive_control(
			'ht_fg_item_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 				'{{WRAPPER}} .gallery-item-caption-wrap .gallery-item-buttons > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_control(
			'ht_fg_item_icon_exact_size',
			[
				'label' => esc_html__( 'Icon Size', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min'	=> 50,
						'max'	=> 120,
					],
					'em' => [
						'min'	=> 10,
						'max'	=> 50,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 50
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap .gallery-item-buttons > a' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ht_fg_item_icon_size',
			[
				'label' => esc_html__( 'Icon Font Size', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 50,
					],
					'em' => [
						'max' => 50,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 18
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap .gallery-item-buttons > a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'		=> 'ht_fg_item_icon_border',
				'label'		=> esc_html__( 'Border', 'hubtag-elementor-addons' ),
				'selector'	=> '{{WRAPPER}} .gallery-item-caption-wrap .gallery-item-buttons > a',
			]
		);

		$this->add_control(
			'ht_fg_item_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-item-caption-wrap .gallery-item-buttons > a' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();


		/**
		 * Style Tab: Load More Button
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_loadmore_button_style',
			[
				'label'                 => __( 'Load More Button', 'hubtag-elementor-addons' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'pagination'        => 'yes',
					'load_more_text!'   => '',
				],
			]
		);
			
			$this->add_responsive_control(
				'button_margin_top',
				[
					'label'                 => __( 'Top Spacing', 'hubtag-elementor-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px' => [
							'min'   => 0,
							'max'   => 80,
							'step'  => 1,
						],
					],
					'size_units'            => '',
					'selectors'             => [
						'{{WRAPPER}} .ht-gallery-load-more' => 'margin-top: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_ht_load_more_button_style' );

			$this->start_controls_tab(
				'tab_load_more_button_normal',
				[
					'label'                 => __( 'Normal', 'hubtag-elementor-addons' ),
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_text!'   => '',
					],
				]
			);

			$this->add_control(
				'load_more_button_bg_color_normal',
				[
					'label'                 => __( 'Background Color', 'hubtag-elementor-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '#333',
					'selectors'             => [
						'{{WRAPPER}} .ht-gallery-load-more' => 'background-color: {{VALUE}}',
					],
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_text!'   => '',
					],
				]
			);

			$this->add_control(
				'load_more_button_text_color_normal',
				[
					'label'                 => __( 'Text Color', 'hubtag-elementor-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '#fff',
					'selectors'             => [
						'{{WRAPPER}} .ht-gallery-load-more' => 'color: {{VALUE}}',
					],
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_text!'   => '',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'                  => 'load_more_button_border_normal',
					'label'                 => __( 'Border', 'hubtag-elementor-addons' ),
					'placeholder'           => '1px',
					'default'               => '1px',
					'selector'              => '{{WRAPPER}} .ht-gallery-load-more',
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_text!'   => '',
					],
				]
			);

			$this->add_control(
				'load_more_button_border_radius',
				[
					'label'                 => __( 'Border Radius', 'hubtag-elementor-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => [ 'px', '%' ],
					'selectors'             => [
						'{{WRAPPER}} .ht-gallery-load-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_text!'   => '',
					],
				]
			);
			
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'load_more_button_typography',
					'label'                 => __( 'Typography', 'hubtag-elementor-addons' ),
					'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
					'selector'              => '{{WRAPPER}} .ht-gallery-load-more',
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_text!'   => '',
					],
				]
			);

			$this->add_responsive_control(
				'load_more_button_padding',
				[
					'label'                 => __( 'Padding', 'hubtag-elementor-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => [ 'px', 'em', '%' ],
					'selectors'             => [
						'{{WRAPPER}} .ht-gallery-load-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_text!'   => '',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'                  => 'load_more_button_box_shadow',
					'selector'              => '{{WRAPPER}} .ht-gallery-load-more',
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_text!'   => '',
					],
				]
			);
			
			$this->add_control(
				'load_more_button_icon_heading',
				[
					'label'                 => __( 'Button Icon', 'hubtag-elementor-addons' ),
					'type'                  => Controls_Manager::HEADING,
					'separator'             => 'before',
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_icon!'   => '',
					],
				]
			);

			$this->add_responsive_control(
				'load_more_button_icon_margin',
				[
					'label'                 => __( 'Margin', 'hubtag-elementor-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => [ 'px', '%' ],
					'placeholder'       => [
						'top'      => '',
						'right'    => '',
						'bottom'   => '',
						'left'     => '',
					],
					'selectors'             => [
						'{{WRAPPER}} .ht-gallery-load-more .ht-filterable-gallery-load-more-icon' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
					],
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_icon!'   => '',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_button_hover',
				[
					'label'                 => __( 'Hover', 'hubtag-elementor-addons' ),
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_text!'   => '',
					],
				]
			);

			$this->add_control(
				'button_bg_color_hover',
				[
					'label'                 => __( 'Background Color', 'hubtag-elementor-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .ht-gallery-load-more:hover' => 'background-color: {{VALUE}}',
					],
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_text!'   => '',
					],
				]
			);

			$this->add_control(
				'button_text_color_hover',
				[
					'label'                 => __( 'Text Color', 'hubtag-elementor-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .ht-gallery-load-more:hover' => 'color: {{VALUE}}',
					],
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_text!'   => '',
					],
				]
			);

			$this->add_control(
				'button_border_color_hover',
				[
					'label'                 => __( 'Border Color', 'hubtag-elementor-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .ht-gallery-load-more:hover' => 'border-color: {{VALUE}}',
					],
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_text!'   => '',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'                  => 'button_box_shadow_hover',
					'selector'              => '{{WRAPPER}} .ht-gallery-load-more:hover',
					'condition'             => [
						'pagination'        => 'yes',
						'load_more_text!'   => '',
					],
				]
			);

			$this->end_controls_tab();
			$this->end_controls_tabs();
			
		$this->end_controls_section();

	}

	public function sorter_class( $string ) {
		$sorter_class = strtolower( $string );
		$sorter_class = str_replace(' ', '-', $sorter_class);
		$sorter_class = str_replace(',-', ' ht-cf-', $sorter_class);
		$sorter_class = str_replace('.', '-', $sorter_class);
		$sorter_class = str_replace(',', ' ', $sorter_class);
		return $sorter_class;
	}

	protected function render_filters() {
		$settings = $this->get_settings_for_display();
		$all_text = ($settings['ht_fg_all_label_text'] != '') ? $settings['ht_fg_all_label_text'] : esc_html__( 'All', 'hubtag-elementor-addons');

		if( $settings['filter_enable'] == 'yes' ) {
			?>
			<div class="ht-filter-gallery-control">
				<ul>
					<?php if ($settings['ht_fg_all_label_text']) { ?>
						<li class="control active" data-filter="*"><?php echo $all_text; ?></li>
					<?php } ?>

					<?php foreach( $settings['ht_fg_controls'] as $key => $control ) :
						$sorter_filter = $this->sorter_class( $control['ht_fg_control'] ); ?>
						<li class="control <?php if ($key == 0 && empty($settings['ht_fg_all_label_text'])) {echo 'active';} ?>" data-filter=".ht-cf-<?php echo esc_attr( $sorter_filter ); ?>"><?php echo esc_html__($control['ht_fg_control']); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php
		}
	}

	protected function render_loadmore_button() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'load-more-button', 'class', [
				'ht-gallery-load-more',
				'elementor-button',
				'elementor-size-' . $settings['button_size'],
			]
		);

		if ( $settings['pagination'] == 'yes' ) { ?>
			<div class="ht-filterable-gallery-loadmore">
				<a href="#" <?php echo $this->get_render_attribute_string( 'load-more-button' ); ?>>
					<span class="ht-button-loader"></span>
					<?php if ( ! empty( $settings['load_more_icon'] ) && $settings['button_icon_position'] == 'before' ) { ?>
						<span class="ht-filterable-gallery-load-more-icon <?php echo esc_attr( $settings['load_more_icon'] ); ?>" aria-hidden="true"></span>
					<?php } ?>
					<span class="ht-filterable-gallery-load-more-text">
						<?php echo $settings['load_more_text']; ?>
					</span>
					<?php if ( ! empty( $settings['load_more_icon'] ) && $settings['button_icon_position'] == 'after' ) { ?>
						<span class="ht-filterable-gallery-load-more-icon <?php echo esc_attr( $settings['load_more_icon'] ); ?>" aria-hidden="true"></span>
					<?php } ?>
				</a>
			</div>
		<?php }

	}

	protected function gallery_item_store() {
		$settings		= $this->get_settings_for_display();
		$gallery_items	= $settings['ht_fg_gallery_items'];
		$gallery_store	= [];
		$counter = 0;
		
		foreach( $gallery_items as $gallery ) {
			$gallery_store[$counter]['title'] = $gallery['ht_fg_gallery_item_name'];
			$gallery_store[$counter]['content'] = $gallery['ht_fg_gallery_item_content'];
			$gallery_store[$counter]['id'] = $gallery['_id'];
			$gallery_store[$counter]['image'] = $gallery['ht_fg_gallery_img'];
			$gallery_store[$counter]['image'] = $gallery['ht_fg_gallery_img']['url'];
			$gallery_store[$counter]['maybe_link'] = $gallery['ht_fg_gallery_link'];
			$gallery_store[$counter]['link'] = $gallery['ht_fg_gallery_img_link'];
			$gallery_store[$counter]['video_gallery_switch'] = 'false';
			$gallery_store[$counter]['video_link'] = $gallery['ht_fg_gallery_item_video_link'];
			$gallery_store[$counter]['show_lightbox'] = $gallery['ht_fg_gallery_lightbox'];
			$gallery_store[$counter]['play_icon'] = $gallery['fg_video_gallery_play_icon'];
			$gallery_store[$counter]['controls'] = $this->sorter_class($gallery['ht_fg_gallery_control_name']);
			$counter++;
		}

		return $gallery_store;
	}

	protected function ht_render_fg_buttons($settings, $item) {
		$html = '<div class="gallery-item-buttons">';
						
		if( ! empty($settings['ht_section_fg_zoom_icon']) && ($item['show_lightbox'] == true) ) {
			$html .='<a href="'.esc_url($item['image']).'" class="ht-magnific-link"><i class="'.$settings['ht_section_fg_zoom_icon'].'" aria-hidden="true"></i></a>';
		}

		if( $item['maybe_link'] == 'true' ) {
			$a_string = 'href="'.esc_url($item['link']['url']).'"';

			if($item['link']['nofollow']) {
				$a_string .= 'rel="nofollow"';
			}

			if($item['link']['is_external']) {
				$a_string .= 'target="_blank"';
			}

			if( ! empty($settings['ht_section_fg_link_icon']) ) {
				$html .= '<a '.$a_string.'><i class="'.$settings['ht_section_fg_link_icon'].'" aria-hidden="true"></i></a>';
			}
		}

		$html .= '</div>';
		return $html;
	}

	protected function render_gallery_items( $init_show = 0 ) {
		$settings = $this->get_settings_for_display();
		$gallery = $this->gallery_item_store();
		$gallery_markup = [];

		$caption_style = $settings['ht_fg_caption_style'] == 'card' ? 'caption-style-card' : 'caption-style-hoverer';

		foreach( $gallery as $item ) {
			if($item['controls'] != '') {
				$html = '<div class="ht-filterable-gallery-item-wrap ht-cf-'.$item['controls'].'">
				<div class="gallery-grid-item">';
			}else {
				$html = '<div class="ht-filterable-gallery-item-wrap">
				<div class="gallery-grid-item">';
			}
					if($settings['ht_fg_caption_style'] === 'card' && $item['video_gallery_switch'] === 'false' && $settings['ht_fg_show_popup'] === 'media') {
						$html .= '<a href="'.esc_url($item['image']).'" class="ht-magnific-link media-content-wrap">';
					}
					$html .= '<div class="gallery-item-thumbnail-wrap">
							<img src="'.$item['image'].'" alt="'.$item['title'].'">';

							if( $settings['ht_fg_show_popup'] == 'buttons' && $settings['ht_fg_caption_style'] === 'card') {
								$html .= '<div class="gallery-item-caption-wrap card-hover-bg caption-style-hoverer '.$settings['ht_fg_grid_hover_style'].'">';
								$html .= ($this->ht_render_fg_buttons($settings, $item));
								$html .= '</div>';
							}

						if( isset($item['video_gallery_switch']) && ($item['video_gallery_switch'] === 'true') ) {
							$icon_url = isset($item['play_icon']['url']) ? $item['play_icon']['url'] : '';
							$video_url = isset($item['video_link']) ? $item['video_link'] : '#';
						
							$html .= '<a href="'.esc_url($video_url).'" class="video-popup ht-magnific-video-link">
								<div class="video-popup-bg"></div>';
							
							if( ! empty($icon_url) ) {
								$html .= '<img src="'.esc_url($icon_url).'">';
							}
							
							$html .='</a>';
						}

						$html .= '</div>';

					if( $settings['ht_fg_caption_style'] == 'card' ) {
						$html .='</a>';
					}

					
					if( $settings['ht_fg_show_popup'] == 'media' && $settings['ht_fg_caption_style'] !== 'card' ) {
						$html .= '<a href="'.esc_url($item['image']).'" class="ht-magnific-link media-content-wrap">';
					}
					

					if( $item['video_gallery_switch'] === 'false' || $settings['ht_fg_caption_style'] === 'card' ) {
						
						if($settings['ht_fg_grid_hover_style'] !== 'ht-none') {
						
							if(isset($item['title']) && ! empty($item['title']) || isset($item['content']) && ! empty($item['content']) ) {

								$html .= '<div class="gallery-item-caption-wrap '.$caption_style.' '.$settings['ht_fg_grid_hover_style'].'">';
								
									if( 'hoverer' == $settings['ht_fg_caption_style'] ) {
										$html .= '<div class="gallery-item-hoverer-bg"></div>';
									}
									
									$html .= '<div class="gallery-item-caption-over">';

									if( ! empty($item['title']) ) {
										$html .= '<h5 class="fg-item-title">'.$item['title'].'</h5>';
									}
									if( ! empty($item['content']) ) {
										$html .='<p class="fg-item-content">'.$item['content'].'</p>';
									}

										if( $settings['ht_fg_show_popup'] == 'buttons' && $settings['ht_fg_caption_style'] !== 'card') {
											$html .= ($this->ht_render_fg_buttons($settings, $item));
										}
									$html .= '</div>';
								$html .= '</div>';
							}
						}
					
					}
					
					if( $settings['ht_fg_show_popup'] == 'media') {
						$html .='</a>';
					}


				$html .='
				</div>
			</div>';

			$gallery_markup[] = $html;
		}
		return $gallery_markup;
	}

	protected function render() {
   		$settings = $this->get_settings();

		if( !empty( $settings['ht_fg_filter_duration'] ) ) {
			$filter_duration = $settings['ht_fg_filter_duration'];
		}else {
			$filter_duration = 500;
		}

		$this->add_render_attribute(
			'gallery',
			[
				'id'				=> 'ht-filter-gallery-wrapper-'.esc_attr($this->get_id()),
				'class'				=> 'ht-filter-gallery-wrapper'
			]
		);

		$gallery_settings = [
			'grid_style'		=> $settings['ht_fg_grid_style'],
			'popup'				=> $settings['ht_fg_show_popup'],
			'duration'			=> $filter_duration,
			'gallery_enabled'	=> $settings['photo_gallery']
		];

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$gallery_settings['post_id'] = \Elementor\Plugin::$instance->editor->get_post_id();
		} else {
			$gallery_settings['post_id'] = get_the_ID();
		}

		$gallery_settings['widget_id'] = $this->get_id();

		$no_more_items_text = esc_html__( $settings['nomore_items_text'], 'hubtag-elementor-addons' );
		
		$this->add_render_attribute('gallery-items-wrap', [
			'class'	=> [
				'ht-filter-gallery-container',
				esc_attr($settings['ht_fg_grid_style'])
			],
			'data-images-per-page'		=> $settings['images_per_page'],
			'data-total-gallery-items'	=> count($settings['ht_fg_gallery_items']),
			'data-nomore-item-text'		=> $no_more_items_text
		]);
	
		$this->add_render_attribute('gallery-items-wrap', 'data-settings', wp_json_encode($gallery_settings));
		$this->add_render_attribute('gallery-items-wrap', 'data-gallery-items', wp_json_encode($this->render_gallery_items()));
		$this->add_render_attribute('gallery-items-wrap', 'data-init-show', esc_attr($settings['ht_fg_items_to_show']));
	?>
		<div <?php echo $this->get_render_attribute_string('gallery'); ?>>
			<?php $this->render_filters(); ?>
			<div <?php echo $this->get_render_attribute_string('gallery-items-wrap'); ?>>
				<?php
					$init_show = absint($settings['ht_fg_items_to_show']);

					for( $i = 0; $i < $init_show; $i++ ) {
						if( array_key_exists($i, $this->render_gallery_items() ) ) {
							echo $this->render_gallery_items()[$i];
						}
					}
				?>
			</div>
			<?php
				if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
					$this->render_editor_script();
				}
				$this->render_loadmore_button();
			?>
		</div>
	<?php
	}

	/**
	 * Render masonry script
	 * 
	 * @access protected
	 */
	protected function render_editor_script() { ?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('.ht-filter-gallery-container').each(function() {
					var $node_id = '<?php echo $this->get_id(); ?>',
						$scope = $('[data-id="' + $node_id + '"]'),
						$gallery = $(this),
						$settings = $gallery.data('settings'),
				        $gallery_items = $gallery.data('gallery-items'),
						$layout_mode = ($settings.grid_style == 'masonry' ? 'masonry' : 'fitRows'),
						$gallery_enabled = ($settings.gallery_enabled == 'yes' ? true : false);

					if ($gallery.closest($scope).length < 1) {
        				return;
        			}

			         // init isotope
					 var $isotope_gallery = $gallery.isotope({
					     itemSelector: '.ht-filterable-gallery-item-wrap',
					     layoutMode: $layout_mode,
					     percentPosition: true,
					     filter: $('.ht-filter-gallery-control .control.active', $scope).data('filter')
					 });

					 // not necessary, just in case
					 $isotope_gallery.imagesLoaded().progress(function() {
					     $isotope_gallery.isotope('layout');
					 });

					 // resize
					 $('.ht-filterable-gallery-item-wrap', $gallery).resize(function() {
						$isotope_gallery.isotope('layout');
					});

					 // filter
					 $scope.on('click', '.control', function() {
					     var $this = $(this),
					         $filterValue = $this.data('filter');

					     $this.siblings().removeClass('active');
					     $this.addClass('active');
					     $isotope_gallery.isotope({
					         filter: $filterValue
					     });
					 });


					 // Load more button
				    $scope.on('click', '.ht-gallery-load-more', function(e) {
				        e.preventDefault();

				        var $this = $(this),
				            $init_show = $('.ht-filter-gallery-container', $scope).children('.ht-filterable-gallery-item-wrap').length,
				            $total_items = $gallery.data('total-gallery-items'),
				            $images_per_page = $gallery.data('images-per-page'),
				            $nomore_text = $gallery.data('nomore-item-text'),
				            $items = [];

				        if ($init_show == $total_items) {
				            $this.html('<div class="no-more-items-text">' + $nomore_text + '</div>');
				            setTimeout(function() {
				                $this.fadeOut('slow');
				            }, 600);
				        }

				        // new items html
					    for (var i = $init_show; i < ($init_show + $images_per_page); i++) {
					        $items.push($($gallery_items[i])[0]);
					    }

				        // append items
				        $gallery.append($items)
				        $isotope_gallery.isotope('appended', $items)
				        $isotope_gallery.imagesLoaded().progress(function() {
				            $isotope_gallery.isotope('layout')
				        })


				    });

				});
			});
		</script>
	<?php
	}

	protected function content_template() {}
}