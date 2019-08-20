<?php
namespace HubTagAddonsElementor\Widgets;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Frontend;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Utils as Utils;
use \Elementor\Widget_Base as Widget_Base;
use HubTagAddonsElementor\Widgets\Inc\Helper as Helper;


class HT_Datatable extends Widget_Base {

	use Helper;

	public $unique_id = null;
	public function get_name() {
		return 'ht-data-table';
	}

	public function get_title() {
		return esc_html__( 'HT Data Table', 'hubtag-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-table';
	}

	public function get_script_depends() {
        return [
			'ht-scripts'
        ];
    }

   public function get_categories() {
        return ['hubtag-elementor-addons'];
	}

	protected function _register_controls() {

  		/**
  		 * Data Table Header
  		 */
  		$this->start_controls_section(
  			'ht_section_data_table_header',
  			[
  				'label' => esc_html__( 'Header', 'hubtag-elementor-addons' )
  			]
  		);

  		$this->add_control(
		  'ht_section_data_table_enabled',
		  	[
				'label' => __( 'Enable Data Table', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'hubtag-elementor-addons' ),
				'label_off' => esc_html__( 'No', 'hubtag-elementor-addons' ),
				'return_value' => 'true',
		  	]
		);

	

  		$this->add_control(
			'ht_data_table_header_cols_data',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'ht_data_table_header_col' => 'Table Header' ],
					[ 'ht_data_table_header_col' => 'Table Header' ],
					[ 'ht_data_table_header_col' => 'Table Header' ],
					[ 'ht_data_table_header_col' => 'Table Header' ],
				],
				'fields' => [
					[
						'name' => 'ht_data_table_header_col',
						'label' => esc_html__( 'Column Name', 'hubtag-elementor-addons' ),
						'default' => 'Table Header',
						'type' => Controls_Manager::TEXT,
						'label_block' => false,
					],
					[
						'name' => 'ht_data_table_header_col_span',
						'label' => esc_html__( 'Column Span', 'hubtag-elementor-addons' ),
						'default' => '',
						'type' => Controls_Manager::TEXT,
						'label_block' => false,
					],
					[
						'name' => 'ht_data_table_header_col_icon_enabled',
						'label' => esc_html__( 'Enable Header Icon', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::SWITCHER,
						'label_on' => __( 'yes', 'hubtag-elementor-addons' ),
						'label_off' => __( 'no', 'hubtag-elementor-addons' ),
						'default' => 'false',
						'return_value' => 'true',
					],
					[
						'name'	=> 'ht_data_table_header_icon_type',
						'label'	=> esc_html__( 'Header Icon Type', 'hubtag-elementor-addons' ),
						'type'	=> Controls_Manager::CHOOSE,
						'options'               => [
							'none'        => [
								'title'   => esc_html__( 'None', 'hubtag-elementor-addons' ),
								'icon'    => 'fa fa-ban',
							],
							'icon'        => [
								'title'   => esc_html__( 'Icon', 'hubtag-elementor-addons' ),
								'icon'    => 'fa fa-star',
							],
							'image'       => [
								'title'   => esc_html__( 'Image', 'hubtag-elementor-addons' ),
								'icon'    => 'fa fa-picture-o',
							],
						],
						'default'               => 'icon',
						'condition' => [
							'ht_data_table_header_col_icon_enabled' => 'true'
						]
					],
					[
						'name' => 'ht_data_table_header_col_icon',
						'label' => esc_html__( 'Icon', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::ICON,
						'default' => '',
						'condition' => [
							'ht_data_table_header_col_icon_enabled' => 'true',
							'ht_data_table_header_icon_type'	=> 'icon'
						]
					],
					[
						'name' => 'ht_data_table_header_col_img',
						'label' => esc_html__( 'Image', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'condition' => [
							'ht_data_table_header_icon_type'	=> 'image'
						]
					],
					[
						'name' => 'ht_data_table_header_col_img_size',
						'label' => esc_html__( 'Image Size(px)', 'hubtag-elementor-addons' ),
						'default' => '25',
						'type' => Controls_Manager::NUMBER,
						'label_block' => false,
						'condition' => [
							'ht_data_table_header_icon_type'	=> 'image'
						]
					],
					[
						'name'			=> 'ht_data_table_header_css_class',
						'label'			=> esc_html__( 'CSS Class', 'hubtag-elementor-addons' ),
						'type'			=> Controls_Manager::TEXT,
						'label_block' 	=> false,
					],
					[
						'name'			=> 'ht_data_table_header_css_id',
						'label'			=> esc_html__( 'CSS ID', 'hubtag-elementor-addons' ),
						'type'			=> Controls_Manager::TEXT,
						'label_block'	=> false,
					],

				],
				'title_field' => '{{ht_data_table_header_col}}',
			]
		);

  		$this->end_controls_section();

  		/**
  		 * Data Table Content
  		 */
  		$this->start_controls_section(
  			'ht_section_data_table_cotnent',
  			[
  				'label' => esc_html__( 'Content', 'hubtag-elementor-addons' )
  			]
  		);

  		$this->add_control(
			'ht_data_table_content_rows',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'ht_data_table_content_row_type' => 'row' ],
					[ 'ht_data_table_content_row_type' => 'col' ],
					[ 'ht_data_table_content_row_type' => 'col' ],
					[ 'ht_data_table_content_row_type' => 'col' ],
					[ 'ht_data_table_content_row_type' => 'col' ],
				],
				'fields' => [
					[
						'name' => 'ht_data_table_content_row_type',
						'label' => esc_html__( 'Row Type', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'row',
						'label_block' => false,
						'options' => [
							'row' => esc_html__( 'Row', 'hubtag-elementor-addons' ),
							'col' => esc_html__( 'Column', 'hubtag-elementor-addons' ),
						]
					],
					[
						'name'			=> 'ht_data_table_content_row_colspan',
						'label'			=> esc_html__( 'Col Span', 'hubtag-elementor-addons' ),
						'type'			=> Controls_Manager::NUMBER,
						'description'	=> esc_html__( 'Default: 1 (optional).'),
						'default' 		=> 1,
						'min'     		=> 1,
						'label_block'	=> true,
						'condition' 	=> [
							'ht_data_table_content_row_type' => 'col'
						]
					],
					[
						'name'			=> 'ht_data_table_content_row_rowspan',
						'label'			=> esc_html__( 'Row Span', 'hubtag-elementor-addons' ),
						'type'			=> Controls_Manager::NUMBER,
						'description'	=> esc_html__( 'Default: 1 (optional).'),
						'default' 		=> 1,
						'min'     		=> 1,
						'label_block'	=> true,
						'condition' 	=> [
							'ht_data_table_content_row_type' => 'col'
						]
					],
					[
						'name'		=> 'ht_data_table_content_type',
						'label'		=> esc_html__( 'Content Type', 'hubtag-elementor-addons' ),
						'type'	=> Controls_Manager::CHOOSE,
						'options'               => [
							'textarea'        => [
								'title'   => esc_html__( 'Textarea', 'hubtag-elementor-addons' ),
								'icon'    => 'fa fa-text-width',
							],
							'editor'       => [
								'title'   => esc_html__( 'Editor', 'hubtag-elementor-addons' ),
								'icon'    => 'fa fa-pencil',
							],
							'template'        => [
								'title'   => esc_html__( 'Templates', 'hubtag-elementor-addons' ),
								'icon'    => 'fa fa-file',
							]
						],
						'default'	=> 'textarea',
						'condition' => [
							'ht_data_table_content_row_type' => 'col'
						]
					],
					[
		                'name'					=> 'ht_primary_templates_for_tables',
		                'label'                 => __( 'Choose Template', 'hubtag-elementor-addons' ),
		                'type'                  => Controls_Manager::SELECT,
		                'options'               => $this->ht_get_page_templates(),
						'condition'             => [
							'ht_data_table_content_type'      => 'template',
						],
		            ],
					[
						'name' => 'ht_data_table_content_row_title',
						'label' => esc_html__( 'Cell Text', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::TEXTAREA,
						'label_block' => true,
						'default' => esc_html__( 'Content', 'hubtag-elementor-addons' ),
						'condition' => [
							'ht_data_table_content_row_type' => 'col',
							'ht_data_table_content_type' => 'textarea'
						]
					],
					[
						'name' => 'ht_data_table_content_row_content',
						'label' => esc_html__( 'Cell Text', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::WYSIWYG,
						'label_block' => true,
						'default' => esc_html__( 'Content', 'hubtag-elementor-addons' ),
						'condition' => [
							'ht_data_table_content_row_type' => 'col',
							'ht_data_table_content_type' => 'editor'
						]
					],
					[
						'name' => 'ht_data_table_content_row_title_link',
						'label' => esc_html__( 'Link', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'default' => [
		        				'url' => '',
		        				'is_external' => '',
		     				],
		     				'show_external' => true,
		     				'separator' => 'before',
		     			'condition' => [
							'ht_data_table_content_row_type' => 'col',
							'ht_data_table_content_type' => 'textarea'
						],
					],
					[
						'name'			=> 'ht_data_table_content_row_css_class',
						'label'			=> esc_html__( 'CSS Class', 'hubtag-elementor-addons' ),
						'type'			=> Controls_Manager::TEXT,
						'label_block'	=> false,
						'condition' 	=> [
							'ht_data_table_content_row_type' => 'col'
						]
					],
					[
						'name'			=> 'ht_data_table_content_row_css_id',
						'label'			=> esc_html__( 'CSS ID', 'hubtag-elementor-addons' ),
						'type'			=> Controls_Manager::TEXT,
						'label_block'	=> false,
						'condition' 	=> [
							'ht_data_table_content_row_type' => 'col'
						]
					]
				],
				'title_field' => '{{ht_data_table_content_row_type}}::{{ht_data_table_content_row_title || ht_data_table_content_row_content}}',
			]
		);

  		$this->end_controls_section();


  		/**
		 * -------------------------------------------
		 * Tab Style (Data Table Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_data_table_style_settings',
			[
				'label' => esc_html__( 'General Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
            'table_width',
            [
                'label'                 => __( 'Width', 'hubtag-elementor-addons' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'size_units'            => [ '%', 'px' ],
                'range'                 => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1200,
                    ],
                ],
                'selectors'             => [
                    '{{WRAPPER}} .ht-data-table' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
		);

		$this->add_control(
            'table_alignment',
            [
                'label'                 => __( 'Alignment', 'hubtag-elementor-addons' ),
                'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
                'default'               => 'center',
                'options'               => [
                    'left' 		=> [
                        'title' => __( 'Left', 'hubtag-elementor-addons' ),
                        'icon' 	=> 'eicon-h-align-left',
                    ],
                    'center' 	=> [
                        'title' => __( 'Center', 'hubtag-elementor-addons' ),
                        'icon' 	=> 'eicon-h-align-center',
                    ],
                    'right' 	=> [
                        'title' => __( 'Right', 'hubtag-elementor-addons' ),
                        'icon' 	=> 'eicon-h-align-right',
                    ],
				],
                'prefix_class'           => 'ht-table-align-',
            ]
        );

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Data Table Header Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_data_table_title_style_settings',
			[
				'label' => esc_html__( 'Header Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_control(
			'ht_section_data_table_header_radius',
			[
				'label' => esc_html__( 'Header Border Radius', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ht-data-table thead tr th:first-child' => 'border-radius: {{SIZE}}px 0px 0px 0px;',
					'{{WRAPPER}} .ht-data-table thead tr th:last-child' => 'border-radius: 0px {{SIZE}}px 0px 0px;',
				],
			]
		);

		$this->add_responsive_control(
			'ht_data_table_each_header_padding',
			[
				'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ht-data-table .table-header th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ht-data-table tbody tr td .th-mobile-screen' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('ht_data_table_header_title_clrbg');

			$this->start_controls_tab( 'ht_data_table_header_title_normal', [ 'label' => esc_html__( 'Normal', 'hubtag-elementor-addons' ) ] );

				$this->add_control(
					'ht_data_table_header_title_color',
					[
						'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							'{{WRAPPER}} .ht-data-table thead tr th' => 'color: {{VALUE}};',
							'{{WRAPPER}} table.dataTable thead .sorting:after' => 'color: {{VALUE}};',
							'{{WRAPPER}} table.dataTable thead .sorting_asc:after' => 'color: {{VALUE}};',
							'{{WRAPPER}} table.dataTable thead .sorting_desc:after' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'ht_data_table_header_title_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#4a4893',
						'selectors' => [
							'{{WRAPPER}} .ht-data-table thead tr th' => 'background-color: {{VALUE}};'
						],
					]
				);
				
				$this->add_group_control(
					Group_Control_Border::get_type(),
						[
							'name' => 'ht_data_table_header_border',
							'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
							'selector' => '{{WRAPPER}} .ht-data-table thead tr th'
						]
				);

			$this->end_controls_tab();
			
			$this->start_controls_tab( 'ht_data_table_header_title_hover', [ 'label' => esc_html__( 'Hover', 'hubtag-elementor-addons' ) ] );

				$this->add_control(
					'ht_data_table_header_title_hover_color',
					[
						'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							'{{WRAPPER}} .ht-data-table thead tr th:hover' => 'color: {{VALUE}};',
							'{{WRAPPER}} table.dataTable thead .sorting:after:hover' => 'color: {{VALUE}};',
							'{{WRAPPER}} table.dataTable thead .sorting_asc:after:hover' => 'color: {{VALUE}};',
							'{{WRAPPER}} table.dataTable thead .sorting_desc:after:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'ht_data_table_header_title_hover_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ht-data-table thead tr th:hover' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
						[
							'name' => 'ht_data_table_header_hover_border',
							'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
							'selector' => '{{WRAPPER}} .ht-data-table thead tr th:hover',
						]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             	'name' => 'ht_data_table_header_title_typography',
				'selector' => '{{WRAPPER}} .ht-data-table thead > tr th',
			]
		);

		$this->add_responsive_control(
			'ht_data_table_header_title_alignment',
			[
				'label' => esc_html__( 'Title Alignment', 'hubtag-elementor-addons' ),
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
				'prefix_class' => 'ht-dt-th-align-',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Data Table Content Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_data_table_content_style_settings',
			[
				'label' => esc_html__( 'Content Style', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->start_controls_tabs('ht_data_table_content_row_cell_styles');

			$this->start_controls_tab('ht_data_table_odd_cell_style', ['label' => esc_html__( 'Normal', 'hubtag-elementor-addons')]);

				$this->add_control(
					'ht_data_table_content_odd_style_heading',
					[
						'label' => esc_html__( 'ODD Cell', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::HEADING,
					]
				);

				$this->add_control(
					'ht_data_table_content_color_odd',
					[
						'label' => esc_html__( 'Color ( Odd Row )', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#6d7882',
						'selectors' => [
							'{{WRAPPER}} .ht-data-table tbody > tr:nth-child(2n) td' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'ht_data_table_content_bg_odd',
					[
						'label' => esc_html__( 'Background ( Odd Row )', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#f2f2f2',
						'selectors' => [
							'{{WRAPPER}} .ht-data-table tbody > tr:nth-child(2n) td' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'ht_data_table_content_even_style_heading',
					[
						'label' => esc_html__( 'Even Cell', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::HEADING,
						'separator'	=> 'before'
					]
				);

				$this->add_control(
					'ht_data_table_content_even_color',
					[
						'label' => esc_html__( 'Color ( Even Row )', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#6d7882',
						'selectors' => [
							'{{WRAPPER}} .ht-data-table tbody > tr:nth-child(2n+1) td' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'ht_data_table_content_bg_even_color',
					[
						'label' => esc_html__( 'Background Color (Even Row)', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .ht-data-table tbody > tr:nth-child(2n+1) td' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
						[
							'name' => 'ht_data_table_cell_border',
							'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
							'selector' => '{{WRAPPER}} .ht-data-table tbody tr td',
							'separator'	=> 'before'
						]
				);

				$this->add_responsive_control(
					'ht_data_table_each_cell_padding',
					[
						'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em' ],
						'selectors' => [
								 '{{WRAPPER}} .ht-data-table tbody tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						 ],
					]
				);

			$this->end_controls_tab();
			
			$this->start_controls_tab('ht_data_table_odd_cell_hover_style', ['label' => esc_html__( 'Hover', 'hubtag-elementor-addons')]);

				$this->add_control(
					'ht_data_table_content_hover_color_odd',
					[
						'label' => esc_html__( 'Color ( Odd Row )', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ht-data-table tbody > tr:nth-child(2n) td:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'ht_data_table_content_hover_bg_odd',
					[
						'label' => esc_html__( 'Background ( Odd Row )', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ht-data-table tbody > tr:nth-child(2n) td:hover' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'ht_data_table_content_even_hover_style_heading',
					[
						'label' => esc_html__( 'Even Cell', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::HEADING,
					]
				);

				$this->add_control(
					'ht_data_table_content_hover_color_even',
					[
						'label' => esc_html__( 'Color ( Even Row )', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#6d7882',
						'selectors' => [
							'{{WRAPPER}} .ht-data-table tbody > tr:nth-child(2n+1) td:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'ht_data_table_content_bg_even_hover_color',
					[
						'label' => esc_html__( 'Background Color (Even Row)', 'hubtag-elementor-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .ht-data-table tbody > tr:nth-child(2n+1) td:hover' => 'background-color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             	'name' => 'ht_data_table_content_typography',
				'selector' => '{{WRAPPER}} .ht-data-table tbody tr td'
			]
		);

		$this->add_control(
			'ht_data_table_content_link_typo',
			[
				'label' => esc_html__( 'Link Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator'	=> 'before'
			]
		);

		/* Table Content Link */
		$this->start_controls_tabs( 'ht_data_table_link_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'ht_data_table_link_normal', [ 'label' => esc_html__( 'Normal', 'hubtag-elementor-addons' ) ] );

			$this->add_control(
				'ht_data_table_link_normal_text_color',
				[
					'label' => esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#c15959',
					'selectors' => [
						'{{WRAPPER}} .ht-data-table-wrap table td a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'ht_data_table_link_hover', [ 'label' => esc_html__( 'Hover', 'hubtag-elementor-addons' ) ] );

			$this->add_control(
				'ht_data_table_link_hover_text_color',
				[
					'label' => esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#6d7882',
					'selectors' => [
						'{{WRAPPER}} .ht-data-table-wrap table td a:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'ht_data_table_content_alignment',
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
				'default' => 'left',
				'prefix_class' => 'ht-dt-td-align-',
			]
		);
		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Responsive Style (Data Table Content Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ht_section_data_table_responsive_style_settings',
			[
				'label'		=> esc_html__( 'Responsive Options', 'hubtag-elementor-addons' ),
				'devices'	=> [ 'tablet', 'mobile' ],
				'tab'		=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
		  'ht_enable_responsive_header_styles',
		  	[
				'label'			=> __( 'Enable Responsive Table', 'hubtag-elementor-addons' ),
				'description'	=> esc_html__( 'If enabled, table header will be automatically responsive for mobile.', 'hubtag-elementor-addons' ),
				'type'			=> Controls_Manager::SWITCHER,
				'label_on'		=> esc_html__( 'Yes', 'hubtag-elementor-addons' ),
				'label_off' 	=> esc_html__( 'No', 'hubtag-elementor-addons' ),
				'return_value' 	=> 'yes',
		  	]
		);

		$this->add_responsive_control(
            'mobile_table_header_width',
            [
                'label'                 => __( 'Width', 'hubtag-elementor-addons' ),
				'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size' => 100,
                    'unit' => 'px',
                ],
                'size_units'            => [ 'px' ],
                'range'                 => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors'             => [
                    '{{WRAPPER}} .ht-data-table .th-mobile-screen' => 'flex-basis: {{SIZE}}px;',
                ],
                'condition'	=> [
                	'ht_enable_responsive_header_styles'	=> 'yes'
                ]
            ]
		);

		$this->add_responsive_control(
			'ht_data_table_responsive_header_color',
			[
				'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-data-table tbody .th-mobile-screen'	=> 'color: {{VALUE}};'
				],
				'condition'	=> [
                	'ht_enable_responsive_header_styles'	=> 'yes'
                ]
			]
		);

		$this->add_responsive_control(
			'ht_data_table_responsive_header_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ht-data-table tbody .th-mobile-screen'	=> 'background-color: {{VALUE}};'
				],
				'condition'	=> [
                	'ht_enable_responsive_header_styles'	=> 'yes'
                ]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'		=> 'ht_data_table_responsive_header_typography',
				'selector'	=> '{{WRAPPER}} .ht-data-table .th-mobile-screen',
				'condition'	=> [
                	'ht_enable_responsive_header_styles'	=> 'yes'
                ]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'ht_data_table_responsive_header_border',
					'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
					'selector' => '{{WRAPPER}} tbody td .th-mobile-screen',
					'condition'	=> [
	                	'ht_enable_responsive_header_styles'	=> 'yes'
	                ]
				]
		);


		$this->end_controls_section();

	}


	protected function render( ) {
   		$settings = $this->get_settings();

	  	$table_tr = [];
		$table_td = [];

	  	// Storing Data table content values
	  	foreach( $settings['ht_data_table_content_rows'] as $content_row ) {

	  		$row_id = uniqid();
	  		if( $content_row['ht_data_table_content_row_type'] == 'row' ) {
	  			$table_tr[] = [
	  				'id' => $row_id,
	  				'type' => $content_row['ht_data_table_content_row_type'],
	  			];

	  		}
	  		if( $content_row['ht_data_table_content_row_type'] == 'col' ) {
	  			$target = $content_row['ht_data_table_content_row_title_link']['is_external'] ? 'target="_blank"' : '';
	  			$nofollow = $content_row['ht_data_table_content_row_title_link']['nofollow'] ? 'rel="nofollow"' : '';

	  			$table_tr_keys = array_keys( $table_tr );
				  $last_key = end( $table_tr_keys );
				  
				$tbody_content = ($content_row['ht_data_table_content_type'] == 'editor') ? $content_row['ht_data_table_content_row_content'] : $content_row['ht_data_table_content_row_title'];

	  			$table_td[] = [
	  				'row_id'		=> $table_tr[$last_key]['id'],
	  				'type'			=> $content_row['ht_data_table_content_row_type'],
					'content_type'	=> $content_row['ht_data_table_content_type'],
					'template'		=> $content_row['ht_primary_templates_for_tables'],
	  				'title'			=> $tbody_content,
	  				'link_url'		=> $content_row['ht_data_table_content_row_title_link']['url'],
	  				'link_target'	=> $target,
	  				'nofollow'		=> $nofollow,
					'colspan'		=> $content_row['ht_data_table_content_row_colspan'],
					'rowspan'		=> $content_row['ht_data_table_content_row_rowspan'],
					'tr_class'		=> $content_row['ht_data_table_content_row_css_class'],
					'tr_id'			=> $content_row['ht_data_table_content_row_css_id']
	  			];
	  		}
		}  
		$table_th_count = count($settings['ht_data_table_header_cols_data']);
		$this->add_render_attribute('ht_data_table_wrap', [
			'class'	=> 'ht-data-table-wrap',
			'data-table_id'			=> esc_attr($this->get_id()),
			'data-custom_responsive'	=> $settings['ht_enable_responsive_header_styles'] ? 'true' : 'false'
		]);
		$this->add_render_attribute('ht_data_table', [
			'class'	=> [ 'tablesorter ht-data-table', esc_attr($settings['table_alignment']) ],
			'id'	=> 'ht-data-table-'.esc_attr($this->get_id())
		]);

		$this->add_render_attribute( 'td_content', [
			'class'	=> 'td-content'
		]);

		if('yes' == $settings['ht_enable_responsive_header_styles']) {
			$this->add_render_attribute('ht_data_table_wrap', 'class', 'custom-responsive-option-enable');
		}

	  	?>
		<div <?php echo $this->get_render_attribute_string('ht_data_table_wrap'); ?>>
			<table <?php echo $this->get_render_attribute_string('ht_data_table'); ?> data-datatable="<?php echo $settings['ht_section_data_table_enabled']; ?>">
			    <thead>
			        <tr class="table-header">
						<?php $i = 0; foreach( $settings['ht_data_table_header_cols_data'] as $header_title ) :
							$this->add_render_attribute('th_class'.$i, [
								'class'		=> [ $header_title['ht_data_table_header_css_class'] ],
								'id'		=> $header_title['ht_data_table_header_css_id'],
								'colspan'	=> $header_title['ht_data_table_header_col_span']
							]);
						?>
			            <th <?php echo $this->get_render_attribute_string('th_class'.$i); ?>>
							<?php
								if( $header_title['ht_data_table_header_col_icon_enabled'] == 'true' && $header_title['ht_data_table_header_icon_type'] == 'icon' ) :
									$this->add_render_attribute('table_header_col_icon'.$i, [
										'class'	=> [ 'data-header-icon', esc_attr( $header_title['ht_data_table_header_col_icon'] )]
									]);
							?>
			            		<i <?php echo $this->get_render_attribute_string('table_header_col_icon'.$i); ?>></i>
			            	<?php endif; ?>
							<?php
								if( $header_title['ht_data_table_header_col_icon_enabled'] == 'true' && $header_title['ht_data_table_header_icon_type'] == 'image' ) :
									$this->add_render_attribute('data_table_th_img'.$i, [
										'src'	=> esc_url( $header_title['ht_data_table_header_col_img']['url'] ),
										'class'	=> 'ht-data-table-th-img',
										'style'	=> "width:{$header_title['ht_data_table_header_col_img_size']}px;",
										'alt'	=> esc_attr( $header_title['ht_data_table_header_col'] )
									]);
							?><img <?php echo $this->get_render_attribute_string('data_table_th_img'.$i); ?>><?php endif; ?><?php echo __( $header_title['ht_data_table_header_col'], 'hubtag-elementor-addons' ); ?></th>
			        	<?php $i++; endforeach; ?>
			        </tr>
			    </thead>
			  	<tbody>
					<?php for( $i = 0; $i < count( $table_tr ); $i++ ) : ?>
						<tr>
							<?php
								for( $j = 0; $j < count( $table_td ); $j++ ) {
									if( $table_tr[$i]['id'] == $table_td[$j]['row_id'] ) {

										$this->add_render_attribute('table_inside_td'.$i.$j,
											[
												'colspan' => $table_td[$j]['colspan'] > 1 ? $table_td[$j]['colspan'] : '',
												'rowspan' => $table_td[$j]['rowspan'] > 1 ? $table_td[$j]['rowspan'] : '',
												'class'		=> $table_td[$j]['tr_class'],
												'id'		=> $table_td[$j]['tr_id']
											]
										);
										?>
										<?php if(  $table_td[$j]['content_type'] == 'textarea' && !empty($table_td[$j]['link_url']) ) : ?>
											<td <?php echo $this->get_render_attribute_string('table_inside_td'.$i.$j); ?>>
												<div class="td-content-wrapper">
													<a href="<?php echo esc_url( $table_td[$j]['link_url'] ); ?>" <?php echo $table_td[$j]['link_target'] ?> <?php echo $table_td[$j]['nofollow'] ?>><?php echo wp_kses_post($table_td[$j]['title']); ?></a>
												</div>
											</td>

										<?php elseif( $table_td[$j]['content_type'] == 'template' && ! empty($table_td[$j]['template']) ) : ?>
										<td <?php echo $this->get_render_attribute_string('table_inside_td'.$i.$j); ?>>
											<div class="td-content-wrapper">
												<div <?php echo $this->get_render_attribute_string('td_content'); ?>>
													<?php
														$ht_frontend = new Frontend;
														echo $ht_frontend->get_builder_content( intval($table_td[$j]['template']), true );
													?>
												</div>
											</div>
										</td>
										<?php else: ?>
											<td <?php echo $this->get_render_attribute_string('table_inside_td'.$i.$j); ?>>
												<div class="td-content-wrapper"><div <?php echo $this->get_render_attribute_string('td_content'); ?>><?php echo $table_td[$j]['title']; ?></div></div>
											</td>
										<?php endif; ?>
										<?php
									}
								}
							?>
						</tr>
			        <?php endfor; ?>
			    </tbody>
			</table>
		</div>
	  	<?php
	}

	protected function content_template() {}
	
   
}