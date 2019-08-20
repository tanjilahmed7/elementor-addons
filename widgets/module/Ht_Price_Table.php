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
use \Elementor\Utils as Utils;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Scheme_Color;
use \Elementor\Widget_Base as Widget_Base;
use \HubTagAddonsElementor\Plugin;


class HT_Price_Table extends Widget_Base{
    public function get_name(){
        return 'ht-price-table';
    }

    public function get_title(){
        return esc_html__('HT Price Table', 'hubtag_elementor_addons');
    }

    public function get_script_depends(){
        return [
            'ht-scripts',
        ];
    }

    public function get_icon(){
        return 'eicon-tabs';
    }

    public function get_categories(){
        return ['hubtag-elementor-addons'];
    }


    protected function _register_controls(){
        $this->start_controls_section(
			'ht_section_table_type',
			[
				'label' => __( 'Price Table Effect', 'hubtag-elementor-addons' ),
			]
        );

        $this->add_control(
			'ht_table_type',
			[
				'label' => __( 'Table Effect', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 
					'default'       => _x( 'Default', 'Table Effect', 'hubtag-elementor-addons' ), 
					'effect-two'    => _x( 'Effect Two', 'Table Effect', 'hubtag-elementor-addons' ), 
					'effect-three'  => _x( 'Effect Three', 'Table Effect', 'hubtag-elementor-addons' ), 
				],
				'default' => 'default',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'ht_price_table_banner',
			[
				'label' => __( 'Price Table Banner', 'hubtag-elementor-addons' ),
				'condition' => [
					'ht_table_type' => 'effect-two',
				],
			]
		);
		$this->add_control(
			'ht_banner_type',
			[
				'label' => __( 'Use Font Icon', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'ht_banner_image',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => HT_PLUGIN_URI.'assets/images/content-writing.png',
					//'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ht_banner_type' => '',
				],
			]
		);

		$this->add_control(
			'ht_banner_icon',
			[
				'label' => __( 'Icon', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-check-circle',
				'condition' => [
					'ht_banner_type' => 'yes',
				],
			]
		);
		
        $this->end_controls_section();
		
		//Heading Controllers
        $this->start_controls_section(
			'ht_section_header',
			[
				'label' => __( 'Header', 'hubtag-elementor-addons' ),
			]
		);

		$this->add_control(
			'ht_heading',
			[
				'label' => __( 'Title', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Enter your title', 'hubtag-elementor-addons' ),
			]
		);

		$this->add_control(
			'ht_sub_heading',
			[
				'label' => __( 'Description', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Enter your description', 'hubtag-elementor-addons' ),
				'condition' => [
					'ht_table_type' => 'effect-three',
				],
			]
		);
		$this->add_control(
			'ht_headings_position',
			[
				'label' => __( 'Table Effect', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 
					'before'       => _x( 'Icon Before', 'Table Effect', 'hubtag-elementor-addons' ), 
					'after'    => _x( 'Icon After', 'Table Effect', 'hubtag-elementor-addons' ),  
				],
				'default' => 'after',
			]
		);
        $this->end_controls_section();
        
        // Pricing Controller
        $this->start_controls_section(
			'ht_section_pricing',
			[
				'label' => __( 'Pricing', 'hubtag-elementor-addons' ),
			]
		);

		$this->add_control(
			'ht_currency_symbol',
			[
				'label' => __( 'Currency Symbol', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'None', 'hubtag-elementor-addons' ),
					'dollar' => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'euro' => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'baht' => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'franc' => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'guilder' => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'krona' => 'kr ' . _x( 'Krona', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'lira' => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'peseta' => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'peso' => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'pound' => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'real' => 'R$ ' . _x( 'Real', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'ruble' => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'rupee' => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'shekel' => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'yen' => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'won' => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'hubtag-elementor-addons' ),
					'custom' => __( 'Custom', 'hubtag-elementor-addons' ),
				],
				'default' => 'dollar',
			]
		);

		$this->add_control(
			'ht_currency_symbol_custom',
			[
				'label' => __( 'Custom Symbol', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'currency_symbol' => 'custom',
				],
			]
		);

		$this->add_control(
			'ht_price',
			[
				'label' => __( 'Price', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '39.99',
			]
		);

		$this->add_control(
			'ht_currency_format',
			[
				'label' => __( 'Currency Format', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => '1,234.56 (Default)',
					',' => '1.234,56',
				],
			]
		);

		$this->add_control(
			'ht_sale',
			[
				'label' => __( 'Sale', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'hubtag-elementor-addons' ),
				'label_off' => __( 'Off', 'hubtag-elementor-addons' ),
				'default' => '',
				'condition' => [
					'ht_table_type' => 'effect-three',
				],
			]
		);

		$this->add_control(
			'ht_original_price',
			[
				'label' => __( 'Original Price', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '59',
				'condition' => [
					'sale' => 'yes',
				],
			]
		);

		$this->add_control(
			'ht_period',
			[
				'label' => __( 'Period', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Monthly', 'hubtag-elementor-addons' ),
			]
		);

        $this->end_controls_section();
        
        // Features Controllers
        $this->start_controls_section(
			'ht_section_features',
			[
				'label' => __( 'Features', 'hubtag-elementor-addons' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'ht_item_text',
			[
				'label' => __( 'Text', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'List Item', 'hubtag-elementor-addons' ),
			]
		);  

		$repeater->add_control(
			'ht_item_icon_type',
			[
				'label' => __( 'Icon Type', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false, 
				'options' => [
					'icon' => [
						'title' => __( 'Icon', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-info-circle',
					],
					'image' => [
						'title' => __( 'Image', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-picture-o',
					],
				], 
				'default'	=> 'icon',
			]
		);
		
		$repeater->add_control(
			'ht_item_icon',
			[
				'label' => __( 'Icon', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-check-circle', 
				'condition' => [
					'ht_item_icon_type' => 'icon',
				],
			]
		);

		$repeater->add_control(
			'ht_item_icon_color',
			[
				'label' => __( 'Icon Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'ht_item_icon_type' => 'icon',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
				] 
			]
		); 

		$repeater->add_control(
			'ht_item_image',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => HT_PLUGIN_URI.'assets/images/content-writing.png',
					//'url' => \Elementor\Utils::get_placeholder_image_src(),
				], 
				'condition' => [
					'ht_item_icon_type' => 'image',
				],
			]
		); 

		$repeater->add_control(
			'ht_item_image_height',
			[
				'label' => __( 'Size', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-features-list {{CURRENT_ITEM}} img' => 'width: {{SIZE}}px',
				],
				'condition' => [
					'ht_item_icon_type' => 'image',
				],
			]
		);

		$this->add_control(
			'ht_features_list',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'ht_item_text' => __( 'List Item #1', 'hubtag-elementor-addons' ),
						'ht_item_icon' => 'fa fa-check-circle',
						'ht_item_icon_type' =>'icon',
					],
					[
						'ht_item_text' => __( 'List Item #2', 'hubtag-elementor-addons' ),
						'ht_item_icon' => 'fa fa-check-circle', 
						'ht_item_icon_type' =>'icon',
					],
					[
						'ht_item_text' => __( 'List Item #3', 'hubtag-elementor-addons' ),
						'ht_item_icon' => 'fa fa-check-circle', 
						'ht_item_icon_type' =>'icon',
					],
				],
				'title_field' => '{{{ ht_item_text }}}',
			]
		);

        $this->end_controls_section();
        

        //Footer Controllers
        $this->start_controls_section(
			'ht_section_footer',
			[
				'label' => __( 'Footer', 'hubtag-elementor-addons' ),
			]
		);

		$this->add_control(
			'ht_button_text',
			[
				'label' => __( 'Button Text', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'hubtag-elementor-addons' ),
			]
		);

		$this->add_control(
			'ht_link',
			[
				'label' => __( 'Link', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'hubtag-elementor-addons' ),
				'default' => [
					'url' => '#',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'ht_footer_additional_info',
			[
				'label' => __( 'Additional Info', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'This is text element', 'hubtag-elementor-addons' ),
				'rows' => 2,
				'condition' => [
					'ht_table_type' => 'effect-three',
				],
			]
		);

        $this->end_controls_section();
        

        //Ribbon Controllers
        $this->start_controls_section(
			'ht_section_ribbon',
			[
				'label' => __( 'Ribbon', 'hubtag-elementor-addons' ),
			]
		);

		$this->add_control(
			'ht_show_ribbon',
			[
				'label' => __( 'Show', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ht_ribbon_title',
			[
				'label' => __( 'Title', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Popular', 'hubtag-elementor-addons' ),
				'condition' => [
					'ht_show_ribbon' => 'yes',
				],
			]
		);

		$this->add_control(
			'ht_ribbon_horizontal_position',
			[
				'label' => __( 'Position', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'hubtag-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'hubtag-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default'	=> 'right',
				'condition' => [
					'ht_show_ribbon' => 'yes',
				],
			]
		);

        $this->end_controls_section();
        

        // Custom Style Controllers
        $this->start_controls_section(
			'ht_section_header_style',
			[
				'label' => __( 'Header', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'ht_header_bg_color',
			[
				'label' => __( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				], 
				'selectors' => [
					'{{WRAPPER}} .price-table-header' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ht_header_padding',
			[
				'label' => __( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .price-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ht_heading_heading_style',
			[
				'label' => __( 'Title', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ht_heading_color',
			[
				'label' => __( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .price-table-header .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ht_heading_typography',
				'selector' => '{{WRAPPER}} .price-table-header .title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'ht_heading_sub_heading_style',
			[
				'label' => __( 'Sub Title', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ht_sub_heading_color',
			[
				'label' => __( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .price-table-header .sub-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ht_sub_heading_typography',
				'selector' => '{{WRAPPER}} .price-table-header .sub-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ht_section_pricing_element_style',
			[
				'label' => __( 'Pricing', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ht_pricing_element_bg',
				'label' => __( 'Background', 'hubtag-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'default' => 'classic',	
				'selector' => '{{WRAPPER}} .price-table-price',
			]
		); 

		$this->add_responsive_control(
			'ht_pricing_element_padding',
			[
				'label' => __( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .price-table-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ht_price_color',
			[
				'label' => __( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .price-table-price .currency-symbol, {{WRAPPER}} .price-table-price .price-value, {{WRAPPER}} .price-table-price .price-after' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ht_price_typography',
				'selector' => '{{WRAPPER}} .price-table-price, {{WRAPPER}} .price-table-price .price-value',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'ht_heading_currency_style',
			[
				'label' => __( 'Currency Symbol', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'ht_currency_symbol!' => '',
				],
			]
		);

		$this->add_control(
			'ht_currency_size',
			[
				'label' => __( 'Size', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-price .currency-symbol' => 'font-size: calc({{SIZE}}em/100)',
				],
				'condition' => [
					'ht_currency_symbol!' => '',
				],
			]
		);

		$this->add_control(
			'ht_currency_position',
			[
				'label' => __( 'Position', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'before',
				'options' => [
					'before' => [
						'title' => __( 'Before', 'hubtag-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [
						'title' => __( 'After', 'hubtag-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
			]
		);

		$this->add_control(
			'ht_currency_vertical_position',
			[
				'label' => __( 'Vertical Position', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'hubtag-elementor-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'hubtag-elementor-addons' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'hubtag-elementor-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'bottom',
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-price .currency-symbol' => 'align-self: {{VALUE}}',
				],
				'condition' => [
					'ht_currency_symbol!' => '',
				],
			]
		);

		$this->add_control(
			'ht_fractional_part_style',
			[
				'label' => __( 'Fractional Part', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ht_fractional-part_size',
			[
				'label' => __( 'Size', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-price .price-after' => 'font-size: calc({{SIZE}}em/100)',
				],
			]
		);

		$this->add_control(
			'ht_fractional_part_vertical_position',
			[
				'label' => __( 'Vertical Position', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'hubtag-elementor-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'hubtag-elementor-addons' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'hubtag-elementor-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-price .price-after' => 'align-self: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ht_heading_original_price_style',
			[
				'label' => __( 'Original Price', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'sale' => 'yes',
					'ht_original_price!' => '',
				],
			]
		);

		$this->add_control(
			'ht_original_price_color',
			[
				'label' => __( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-price-table__original-price' => 'color: {{VALUE}}',
				],
				'condition' => [
					'sale' => 'yes',
					'original_price!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ht_original_price_typography',
				'selector' => '{{WRAPPER}} .elementor-price-table__original-price',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'condition' => [
					'sale' => 'yes',
					'original_price!' => '',
				],
			]
		);

		$this->add_control(
			'ht_original_price_vertical_position',
			[
				'label' => __( 'Vertical Position', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'hubtag-elementor-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'hubtag-elementor-addons' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'hubtag-elementor-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'default' => 'bottom',
				'selectors' => [
					'{{WRAPPER}} .elementor-price-table__original-price' => 'align-self: {{VALUE}}',
				],
				'condition' => [
					'sale' => 'yes',
					'original_price!' => '',
				],
			]
		);

		$this->add_control(
			'ht_heading_period_style',
			[
				'label' => __( 'Period', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'period!' => '',
				],
			]
		);

		$this->add_control(
			'ht_period_color',
			[
				'label' => __( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-price .price-period' => 'color: {{VALUE}}',
				],
				'condition' => [
					'period!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ht_period_typography',
				'selector' => '{{WRAPPER}} .price-table-price .price-period',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'condition' => [
					'period!' => '',
				],
			]
		);

		$this->add_control(
			'ht_period_position',
			[
				'label' => __( 'Position', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'below' => __( 'Below', 'hubtag-elementor-addons' ),
					'beside' => __( 'Beside', 'hubtag-elementor-addons' ),
				],
				'default' => 'below',
				'condition' => [
					'period!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ht_section_features_list_style',
			[
				'label' => __( 'Features', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'ht_features_list_bg_color',
			[
				'label' => __( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .price-table-features-list' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ht_features_list_padding',
			[
				'label' => __( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .price-table-features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ht_features_list_color',
			[
				'label' => __( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .price-table-features-list li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ht_features_list_typography',
				'selector' => '{{WRAPPER}} .price-table-features-list li',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_control(
			'ht_features_list_alignment',
			[
				'label' => __( 'Alignment', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'flex-start' => [
						'title' => __( 'Left', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'hubtag-elementor-addons' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-features-list li' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ht_item_width',
			[
				'label' => __( 'Width', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 25,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-price-table__feature-inner' => 'margin-left: calc((100% - {{SIZE}}%)/2); margin-right: calc((100% - {{SIZE}}%)/2)',
				],
			]
		);

		$this->add_control(
			'ht_list_divider',
			[
				'label' => __( 'Divider', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ht_divider_style',
			[
				'label' => __( 'Style', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => __( 'Solid', 'hubtag-elementor-addons' ),
					'double' => __( 'Double', 'hubtag-elementor-addons' ),
					'dotted' => __( 'Dotted', 'hubtag-elementor-addons' ),
					'dashed' => __( 'Dashed', 'hubtag-elementor-addons' ),
				],
				'default' => 'solid',
				'condition' => [
					'ht_list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-features-list li:before' => 'border-top-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_divider_color',
			[
				'label' => __( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'ht_list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-features-list li:before' => 'border-top-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ht_divider_weight',
			[
				'label' => __( 'Weight', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 2,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'condition' => [
					'ht_list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-features-list li:before' => 'border-top-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ht_divider_width',
			[
				'label' => __( 'Width', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'ht_list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-features-list li:not(:first-child):before' => 'width: {{SIZE}}%',
				],
			]
		);

		$this->add_control(
			'ht_divider_gap',
			[
				'label' => __( 'Gap', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'condition' => [
					'ht_list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-features-list li:not(:first-child)' => 'margin-top: {{SIZE}}px;',
					'{{WRAPPER}} .price-table-features-list li:not(:first-child):before' => 'top: calc(-{{SIZE}}px / 2)',
				],
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'ht_section_footer_style',
			[
				'label' => __( 'Footer', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'ht_footer_bg_color',
			[
				'label' => __( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .price-table-footer' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ht_footer_padding',
			[
				'label' => __( 'Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .price-table-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ht_heading_footer_button',
			[
				'label' => __( 'Button', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'ht_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ht_button_size',
			[
				'label' => __( 'Size', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => [
					'xs' => __( 'Extra Small', 'hubtag-elementor-addons' ),
					'sm' => __( 'Small', 'hubtag-elementor-addons' ),
					'md' => __( 'Medium', 'hubtag-elementor-addons' ),
					'lg' => __( 'Large', 'hubtag-elementor-addons' ),
					'xl' => __( 'Extra Large', 'hubtag-elementor-addons' ),
				],
				'condition' => [
					'ht_button_text!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'ht_tab_button_normal',
			[
				'label' => __( 'Normal', 'hubtag-elementor-addons' ),
				'condition' => [
					'ht_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ht_button_text_color',
			[
				'label' => __( 'Text Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .price-table-footer .price-button' => 'color: {{VALUE}};',
				],
				'condition' => [
					'ht_button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ht_button_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .price-table-footer .price-button',
				'condition' => [
					'ht_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ht_button_background_color',
			[
				'label' => __( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-footer .price-button' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'ht_button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'ht_button_border',
				'selector' => '{{WRAPPER}} .price-table-footer .price-button',
				'condition' => [
					'ht_button_text!' => '',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ht_button_border_radius',
			[
				'label' => __( 'Border Radius', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .price-table-footer .price-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ht_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ht_button_text_padding',
			[
				'label' => __( 'Text Padding', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .price-table-footer .price-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ht_button_text!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ht_tab_button_hover',
			[
				'label' => __( 'Hover', 'hubtag-elementor-addons' ),
				'condition' => [
					'ht_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ht_button_hover_color',
			[
				'label' => __( 'Text Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .price-table-footer .price-button:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'ht_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ht_button_background_hover_color',
			[
				'label' => __( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .price-table-footer .price-button:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'ht_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ht_button_hover_border_color',
			[
				'label' => __( 'Border Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .price-table-footer .price-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'ht_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ht_button_hover_animation',
			[
				'label' => __( 'Animation', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'condition' => [
					'ht_button_text!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'ht_heading_additional_info',
			[
				'label' => __( 'Additional Info', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'footer_additional_info!' => '',
				],
			]
		);

		$this->add_control(
			'ht_additional_info_color',
			[
				'label' => __( 'Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-price-table__additional_info' => 'color: {{VALUE}}',
				],
				'condition' => [
					'footer_additional_info!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ht_additional_info_typography',
				'selector' => '{{WRAPPER}} .elementor-price-table__additional_info',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'condition' => [
					'footer_additional_info!' => '',
				],
			]
		);

		$this->add_control(
			'ht_additional_info_margin',
			[
				'label' => __( 'Margin', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 15,
					'right' => 30,
					'bottom' => 0,
					'left' => 30,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-price-table__additional_info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition' => [
					'footer_additional_info!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ht_section_ribbon_style',
			[
				'label' => __( 'Ribbon', 'hubtag-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'ht_show_ribbon' => 'yes',
				],
			]
		);

		$this->add_control(
			'ht_ribbon_bg_color',
			[
				'label' => __( 'Background Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-ribbon .riboon-text' => 'background-color: {{VALUE}}',
				],
			]
		);

		$ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

		$this->add_responsive_control(
			'ht_ribbon_distance',
			[
				'label' => __( 'Distance', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .price-table-ribbon .riboon-text' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
				],
			]
		);

		$this->add_control(
			'ht_ribbon_text_color',
			[
				'label' => __( 'Text Color', 'hubtag-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .price-table-ribbon .riboon-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ht_ribbon_typography',
				'selector' => '{{WRAPPER}} .price-table-ribbon .riboon-text',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ht_box_shadow',
				'selector' => '{{WRAPPER}} .price-table-ribbon .riboon-text',
			]
		);

		$this->end_controls_section();
	}
	

	private function render_currency_symbol( $symbol, $location ) {
		$currency_position = $this->get_settings( 'ht_currency_position' );
		$location_setting = ! empty( $currency_position ) ? $currency_position : 'before';
		if ( ! empty( $symbol ) && $location === $location_setting ) {
			echo '<span class="elementor-price-table__currency elementor-currency--' . $location . '">' . $symbol . '</span>';
		}
	}

	private function get_currency_symbol( $symbol_name ) {
		$symbols = [
			'dollar' => '&#36;',
			'euro' => '&#128;',
			'franc' => '&#8355;',
			'pound' => '&#163;',
			'ruble' => '&#8381;',
			'shekel' => '&#8362;',
			'baht' => '&#3647;',
			'yen' => '&#165;',
			'won' => '&#8361;',
			'guilder' => '&fnof;',
			'peso' => '&#8369;',
			'peseta' => '&#8359',
			'lira' => '&#8356;',
			'rupee' => '&#8360;',
			'indian_rupee' => '&#8377;',
			'real' => 'R$',
			'krona' => 'kr',
		];

		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
	}

    protected function render(){
        Plugin::widget_scripts_load();
        $settings = $this->get_settings_for_display();
		$outPutHtml = '';
		$symbol = '';

		if ( ! empty( $settings['ht_currency_symbol'] ) ) {
			if ( 'custom' !== $settings['ht_currency_symbol'] ) {
				$symbol = $this->get_currency_symbol( $settings['ht_currency_symbol'] );
			} else {
				$symbol = $settings['ht_currency_symbol_custom'];
			}
		}
		$currency_format = empty( $settings['ht_currency_format'] ) ? '.' : $settings['ht_currency_format'];
		$price = explode( $currency_format, $settings['ht_price'] );
		$intpart = $price[0];
		$fraction = '';
		if ( 2 === count( $price ) ) {
			$fraction = $price[1];
		}

        //$this->add_render_attribute( 'heading', 'class', 'elementor-price-table__heading' );
        if ( ! empty( $settings['ht_link']['url'] ) ) {
			$this->add_render_attribute( 'ht_button_text', 'href', $settings['ht_link']['url'] );

			if ( ! empty( $settings['ht_link']['is_external'] ) ) {
				$this->add_render_attribute( 'ht_button_text', 'target', '_blank' );
			}

			if ( $settings['ht_link']['nofollow'] ) {
				$this->add_render_attribute( 'ht_button_text', 'rel', 'nofollow' );
			}
        }
        

        $this->add_inline_editing_attributes( 'ht_button_text' );

        $outPutHtml .= '<div class="ht-price-table '.$settings['ht_table_type'].'">';

            if($settings['ht_table_type'] == 'effect-two' ){

				//Before Header
            	if($settings['ht_headings_position'] == 'before' ){
					$outPutHtml .= '<div class="price-table-header">';
						$outPutHtml .= '<h3 class="title">Personal</h3>';
					$outPutHtml .= '</div>';
				}

				$outPutHtml .= '<div class="price-table-thumb">';
				if( empty($settings['ht_banner_type']) ){
					if($settings['ht_banner_image']['id'] > 0){
						$outPutHtml .= '<img src="'.wp_get_attachment_url( $settings['ht_banner_image']['id'], 'thumbnail' ).'" />';
					}else{
						$outPutHtml .= '<img src="'.$settings['ht_banner_image']['url'].'" />';
					}
				}else{
					$outPutHtml .= '<i class="'.$settings['ht_banner_icon'].'" aria-hidden="true"></i>';
				}
                $outPutHtml .= '</div>';

				//After Header
            	if($settings['ht_headings_position'] == 'after' ){
					$outPutHtml .= '<div class="price-table-header">';
						$outPutHtml .= '<h3 class="title">Personal</h3>';
					$outPutHtml .= '</div>';
				}
            } else {
                $outPutHtml .= '<div class="price-table-header">';
                    $outPutHtml .= '<h3 class="title">'.$settings['ht_heading'].'</h3>';
                    $outPutHtml .= '<span class="sub-title">'.$settings['ht_sub_heading'].'</span>';
                $outPutHtml .= '</div>';
            }

            $outPutHtml .= '<div class="price-table-price">';
				$outPutHtml .= '<div class="price-inner">';
					$outPutHtml .= '<span class="currency-symbol">'.$this->get_currency_symbol( $settings['ht_currency_symbol'] ).'</span>';
					$outPutHtml .= '<span class="price-value">'.$intpart.'</span>';
					if ( '' !== $fraction  ) :
						$outPutHtml .= '<span class="price-after">'.$fraction.'</span>';
					endif;
					if( ! empty( $settings['ht_period'] ) ){
						$outPutHtml .= '<span class="price-period">'.$settings['ht_period'].'</span>';
					}
				$outPutHtml .= '</div>';
            $outPutHtml .= '</div>';
            
            if ( ! empty( $settings['ht_features_list'] ) ) :
                $outPutHtml .= '<ul class="price-table-features-list">';
                    foreach ( $settings['ht_features_list'] as $index => $item ) :
						$outPutHtml .= '<li class="elementor-repeater-item-'.( !empty($item['_id'])? $item['_id']: '' ).'">'; 
                            if (  $item['ht_item_icon_type'] == 'icon' && ! empty( $item['ht_item_icon'] ) ) : 
                                $outPutHtml .= '<i class="'.$item['ht_item_icon'].'" aria-hidden="true"></i>'; 
							endif;
							
							if (  $item['ht_item_icon_type'] == 'image' && ! empty( $item['ht_item_image'] ) ) : 
								if($settings['ht_banner_image']['id'] > 0){
									$outPutHtml .= '<img class="icon-img" src="'.wp_get_attachment_url( $item['ht_item_image']['id'], 'thumbnail' ).'" />'; 
								}else{
									$outPutHtml .= '<img class="icon-img" src="'.$item['ht_item_image']['url'].'" />';
								}
                            endif;

                            if ( ! empty( $item['ht_item_text'] ) ) :
                                $outPutHtml .= $item['ht_item_text']; 
                            endif;
                        $outPutHtml .= '</li>'; 
                    endforeach;
                $outPutHtml .= '</ul>';
            endif;

            if ( ! empty( $settings['ht_button_text'] ) || ! empty( $settings['ht_footer_additional_info'] ) ) :
                $outPutHtml .= '<div class="price-table-footer">'; 
                    if ( ! empty( $settings['ht_button_text'] ) ) :
                        $outPutHtml .= '<a class="price-button" '.$this->get_render_attribute_string( 'ht_button_text' ).'>'.$settings['ht_button_text'].'</a>';
					endif;
					if ( ! empty( $settings['ht_footer_additional_info'] ) ) :
						$outPutHtml .= '<div>'.$this->get_render_attribute_string( 'ht_footer_additional_info' ).''.$settings['ht_footer_additional_info'].'</div>';
					endif;
                $outPutHtml .= '</div>';
			endif;
			
			if ( 'yes' === $settings['ht_show_ribbon'] && ! empty( $settings['ht_ribbon_title'] ) ) :
				if ( ! empty( $settings['ht_ribbon_horizontal_position'] ) ) : 
					$this->add_render_attribute( 
						'price-table-ribbon', 
						[
							'class' => ['price-table-ribbon', 'elementor-ribbon-' . $settings['ht_ribbon_horizontal_position'] ]
						] 
					); 
				endif;
				$outPutHtml .= '<div '.$this->get_render_attribute_string( 'price-table-ribbon' ).' ><span class="riboon-text">'.$settings['ht_ribbon_title'].'</span></div>';
			endif;
        $outPutHtml .= '</div>';
        echo $outPutHtml;
    }

    protected function content_template(){}
}