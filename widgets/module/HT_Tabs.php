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
use \Elementor\Widget_Base as Widget_Base;
use \HubTagAddonsElementor\Plugin;
use HubTagAddonsElementor\Widgets\Inc\Helper as Helper;

class HT_Tabs extends Widget_Base
{
    use Helper;    


    public function get_name()
    {
        return 'ht-tabs';
    }

    public function get_title()
    {
        return esc_html__('HT Tabs', 'hubtag_elementor_addons');
    }

    public function get_script_depends()
    {
        return [
            'ht-scripts',
        ];
    }

    public function get_icon()
    {
        return 'eicon-tabs';
    }

    public function get_categories()
    {
        return ['hubtag-elementor-addons'];
    }


    protected function _register_controls()
    {
        /**
         * Advance Tabs Settings
         */
        $this->start_controls_section(
            'ht_tabs_settings',
            [
                'label' => esc_html__('General Settings', 'hubtag-elementor-addons'),
            ]
        );
        $this->add_control(
            'ht_tab_layout',
            [
                'label' => esc_html__('Layout', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'ht-tabs-top',
                'label_block' => false,
                'options' => [
                    'ht-tabs-top' => esc_html__('Top', 'hubtag-elementor-addons'),
                    'ht-tabs-left' => esc_html__('Left', 'hubtag-elementor-addons'),
                    'ht-tabs-right' => esc_html__('Right', 'hubtag-elementor-addons'),
                    'ht-tabs-bottom' => esc_html__('Bottom', 'hubtag-elementor-addons'),
                ],
            ]
        );
        $this->add_control(
            'ht_tabs_icon_show',
            [
                'label' => esc_html__('Enable Icon', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'ht_tab_icon_position',
            [
                'label' => esc_html__('Icon Position', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'ht-tab-inline-icon',
                'label_block' => false,
                'options' => [
                    'ht-tab-top-icon' => esc_html__('Stacked', 'hubtag-elementor-addons'),
                    'ht-tab-inline-icon' => esc_html__('Inline', 'hubtag-elementor-addons'),
                ],
                'condition' => [
                    'ht_tabs_icon_show' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * Advance Tabs Content Settings
         */
        $this->start_controls_section(
            'ht_content_settings',
            [
                'label' => esc_html__('Content', 'hubtag-elementor-addons'),
            ]
        );
        $this->add_control(
            'ht_tabs_tab',
            [
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => [
                    ['ht_tabs_tab_title' => esc_html__('Tab Title 1', 'hubtag-elementor-addons')],
                    ['ht_tabs_tab_title' => esc_html__('Tab Title 2', 'hubtag-elementor-addons')],
                    ['ht_tabs_tab_title' => esc_html__('Tab Title 3', 'hubtag-elementor-addons')],
                ],
                'fields' => [
                    [
                        'name' => 'ht_tabs_tab_show_as_default',
                        'label' => __('Set as Default', 'hubtag-elementor-addons'),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => 'inactive',
                        'return_value' => 'active-default',
                    ],
                    [
                        'name' => 'ht_tabs_icon_type',
                        'label' => esc_html__('Icon Type', 'hubtag-elementor-addons'),
                        'type' => Controls_Manager::CHOOSE,
                        'label_block' => false,
                        'options' => [
                            'none' => [
                                'title' => esc_html__('None', 'hubtag-elementor-addons'),
                                'icon' => 'fa fa-ban',
                            ],
                            'icon' => [
                                'title' => esc_html__('Icon', 'hubtag-elementor-addons'),
                                'icon' => 'fa fa-gear',
                            ],
                            'image' => [
                                'title' => esc_html__('Image', 'hubtag-elementor-addons'),
                                'icon' => 'fa fa-picture-o',
                            ],
                        ],
                        'default' => 'icon',
                    ],
                    [
                        'name' => 'ht_tabs_tab_title_icon',
                        'label' => esc_html__('Icon', 'hubtag-elementor-addons'),
                        'type' => Controls_Manager::ICON,
                        'default' => 'fa fa-home',
                        'condition' => [
                            'ht_tabs_icon_type' => 'icon',
                        ],
                    ],
                    [
                        'name' => 'ht_tabs_tab_title_image',
                        'label' => esc_html__('Image', 'hubtag-elementor-addons'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'condition' => [
                            'ht_tabs_icon_type' => 'image',
                        ],
                    ],
                    [
                        'name' => 'ht_tabs_tab_title',
                        'label' => esc_html__('Tab Title', 'hubtag-elementor-addons'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__('Tab Title', 'hubtag-elementor-addons'),
                        'dynamic' => ['active' => true],
                    ],
                    [
                        'name' => 'ht_tabs_text_type',
                        'label' => __('Content Type', 'hubtag-elementor-addons'),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'content' => __('Content', 'hubtag-elementor-addons'),
                            'template' => __('Saved Templates', 'hubtag-elementor-addons'),
                        ],
                        'default' => 'content',
                    ],
                    [
                        'name' => 'ht_primary_templates',
                        'label' => __('Choose Template', 'hubtag-elementor-addons'),
                        'type' => Controls_Manager::SELECT,
                        'options' => $this->ht_get_page_templates(),
                        'condition' => [
                            'ht_tabs_text_type' => 'template',
                        ],
                    ],

                    [
                        'name' => 'ht_tabs_tab_content',
                        'label' => esc_html__('Tab Content', 'hubtag-elementor-addons'),
                        'type' => Controls_Manager::WYSIWYG,
                        'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'hubtag-elementor-addons'),
                        'dynamic' => ['active' => true],
                        'condition' => [
                            'ht_tabs_text_type' => 'content',
                        ],
                    ],
                ],
                'title_field' => '{{ht_tabs_tab_title}}',
            ]
        );
        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style Advance Tabs Generel Style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ht_tabs_style_settings',
            [
                'label' => esc_html__('General', 'hubtag-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'ht_tabs_padding',
            [
                'label' => esc_html__('Padding', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ht_tabs_margin',
            [
                'label' => esc_html__('Margin', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ht_tabs_border',
                'label' => esc_html__('Border', 'hubtag-elementor-addons'),
                'selector' => '{{WRAPPER}} .ht-advance-tabs',
            ]
        );
        $this->add_responsive_control(
            'ht_tabs_border_radius',
            [
                'label' => esc_html__('Border Radius', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ht_tabs_box_shadow',
                'selector' => '{{WRAPPER}} .ht-advance-tabs',
            ]
        );
        $this->end_controls_section();
        /**
         * -------------------------------------------
         * Tab Style Advance Tabs Content Style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ht_tabs_tab_style_settings',
            [
                'label' => esc_html__('Tab Title', 'hubtag-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ht_tabs_tab_title_typography',
                'selector' => '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li',
            ]
        );
        $this->add_responsive_control(
            'ht_tabs_title_width',
            [
                'label' => __('Title Min Width', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs.ht-tabs-vertica .ht-tabs-nav > ul' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ht_tab_layout' => 'ht-tabs-vertica',
                ],
            ]
        );
        $this->add_responsive_control(
            'ht_tabs_tab_icon_size',
            [
                'label' => __('Icon Size', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ht_tabs_tab_icon_gap',
            [
                'label' => __('Icon Gap', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ht-tab-inline-icon li i, {{WRAPPER}} .ht-tab-inline-icon li img' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ht-tab-top-icon li i, {{WRAPPER}} .ht-tab-top-icon li img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ht_tabs_tab_padding',
            [
                'label' => esc_html__('Padding', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ht_tabs_tab_margin',
            [
                'label' => esc_html__('Margin', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('ht_tabs_header_tabs');
        // Normal State Tab
        $this->start_controls_tab('ht_tabs_header_normal', ['label' => esc_html__('Normal', 'hubtag-elementor-addons')]);
        $this->add_control(
            'ht_tabs_tab_color',
            [
                'label' => esc_html__('Tab Background Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f1f1f1',
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ht_tabs_tab_text_color',
            [
                'label' => esc_html__('Text Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ht_tabs_tab_icon_color',
            [
                'label' => esc_html__('Icon Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'ht_tabs_icon_show' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ht_tabs_tab_border',
                'label' => esc_html__('Border', 'hubtag-elementor-addons'),
                'selector' => '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li',
            ]
        );
        $this->add_responsive_control(
            'ht_tabs_tab_border_radius',
            [
                'label' => esc_html__('Border Radius', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // Hover State Tab
        $this->start_controls_tab('ht_tabs_header_hover', ['label' => esc_html__('Hover', 'hubtag-elementor-addons')]);
        $this->add_control(
            'ht_tabs_tab_color_hover',
            [
                'label' => esc_html__('Tab Background Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f1f1f1',
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ht_tabs_tab_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ht_tabs_tab_icon_color_hover',
            [
                'label' => esc_html__('Icon Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li:hover .fa' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'ht_tabs_icon_show' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ht_tabs_tab_border_hover',
                'label' => esc_html__('Border', 'hubtag-elementor-addons'),
                'selector' => '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li:hover',
            ]
        );
        $this->add_responsive_control(
            'ht_tabs_tab_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // Active State Tab
        $this->start_controls_tab('ht_tabs_header_active', ['label' => esc_html__('Active', 'hubtag-elementor-addons')]);
        $this->add_control(
            'ht_tabs_tab_color_active',
            [
                'label' => esc_html__('Tab Background Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li.active' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li.active-default' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ht_tabs_tab_text_color_active',
            [
                'label' => esc_html__('Text Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li.active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li.active-deafult' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ht_tabs_tab_icon_color_active',
            [
                'label' => esc_html__('Icon Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li.active .fa' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li.active-default .fa' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'ht_tabs_icon_show' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ht_tabs_tab_border_active',
                'label' => esc_html__('Border', 'hubtag-elementor-addons'),
                'selector' => '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li.active, {{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li.active-default',
            ]
        );
        $this->add_responsive_control(
            'ht_tabs_tab_border_radius_active',
            [
                'label' => esc_html__('Border Radius', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li.active-default' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style Advance Tabs Content Style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ht_tabs_tab_content_style_settings',
            [
                'label' => esc_html__('Content', 'hubtag-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'adv_tabs_content_bg_color',
            [
                'label' => esc_html__('Background Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-content > div' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'adv_tabs_content_text_color',
            [
                'label' => esc_html__('Text Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-content > div' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ht_tabs_content_typography',
                'selector' => '{{WRAPPER}} .ht-advance-tabs .ht-tabs-content > div',
            ]
        );
        $this->add_responsive_control(
            'ht_tabs_content_padding',
            [
                'label' => esc_html__('Padding', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-content > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ht_tabs_content_margin',
            [
                'label' => esc_html__('Margin', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-content > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ht_tabs_content_border',
                'label' => esc_html__('Border', 'hubtag-elementor-addons'),
                'selector' => '{{WRAPPER}} .ht-advance-tabs .ht-tabs-content > div',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ht_tabs_content_shadow',
                'selector' => '{{WRAPPER}} .ht-advance-tabs .ht-tabs-content > div',
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style Advance Tabs Caret Style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ht_tabs_tab_caret_style_settings',
            [
                'label' => esc_html__('Caret', 'hubtag-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ht_tabs_tab_caret_show',
            [
                'label' => esc_html__('Show Caret on Active Tab', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'ht_tabs_tab_caret_size',
            [
                'label' => esc_html__('Caret Size', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li:after' => 'border-width: {{SIZE}}px; bottom: -{{SIZE}}px',
                    '{{WRAPPER}} .ht-advance-tabs.ht-tabs-vertica .ht-tabs-nav > ul li:after' => 'right: -{{SIZE}}px; top: calc(50% - {{SIZE}}px) !important;',
                ],
                'condition' => [
                    'ht_tabs_tab_caret_show' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'ht_tabs_tab_caret_color',
            [
                'label' => esc_html__('Caret Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .ht-advance-tabs .ht-tabs-nav > ul li:after' => 'border-top-color: {{VALUE}};',
                    '{{WRAPPER}} .ht-advance-tabs.ht-tabs-vertica .ht-tabs-nav > ul li:after' => 'border-top-color: transparent; border-left-color: {{VALUE}};',
                ],
                'condition' => [
                    'ht_tabs_tab_caret_show' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $ht_default_tab = array();
        $ht_tab_id = 1;
        $ht_tab_content_id = 1;

        $this->add_render_attribute(
            'ht_tab_wrapper',
            [
                'id' => "ht-advance-tabs-{$this->get_id()}",
                'class' => ['ht-advance-tabs', $settings['ht_tab_layout']],
                'data-tabid' => $this->get_id(),
            ]
        );
        if ($settings['ht_tabs_tab_caret_show'] != 'yes') {
            $this->add_render_attribute('ht_tab_wrapper', 'class', 'active-caret-on');
        }

        $this->add_render_attribute('ht_tab_icon_position', 'class', esc_attr($settings['ht_tab_icon_position']));
        ?>
    <div <?php echo $this->get_render_attribute_string('ht_tab_wrapper'); ?>>
        
  		<div class="ht-tabs-nav">
		  <ul <?php echo $this->get_render_attribute_string('ht_tab_icon_position'); ?>>
            <?php foreach ($settings['ht_tabs_tab'] as $tab): ?>
	      		<li class="<?php echo esc_attr($tab['ht_tabs_tab_show_as_default']); ?>"><?php if ($settings['ht_tabs_icon_show'] === 'yes'):
            if ($tab['ht_tabs_icon_type'] === 'icon'): ?>
			      					<i class="<?php echo esc_attr($tab['ht_tabs_tab_title_icon']); ?>"></i>
			      				<?php elseif ($tab['ht_tabs_icon_type'] === 'image'): ?>
	      					<img src="<?php echo esc_attr($tab['ht_tabs_tab_title_image']['url']); ?>">
	      				<?php endif;?>
	      		<?php endif;?> <span class="ht-tab-title"><?php echo $tab['ht_tabs_tab_title']; ?></span></li>
	      	<?php endforeach;?>
    		</ul>
          </div>
          
  		<div class="ht-tabs-content">
  			<?php foreach ($settings['ht_tabs_tab'] as $tab) : $ht_default_tab[] = $tab['ht_tabs_tab_show_as_default']; ?>
		    			<div class="clearfix <?php echo esc_attr($tab['ht_tabs_tab_show_as_default']); ?>">
		      				<?php if ('content' == $tab['ht_tabs_text_type']): ?>
								<?php echo do_shortcode($tab['ht_tabs_tab_content']); ?>
                                <?php elseif ('template' == $tab['ht_tabs_text_type']): ?>
                                <?php
                                if (!empty($tab['ht_primary_templates'])) {
                                        $ht_template_id = $tab['ht_primary_templates'];
                                        $ht_frontend = new Frontend;
                                        echo $ht_frontend->get_builder_content($ht_template_id, true);
                                }
                                ?>
					

					<?php endif;?>
    			</div>
			<?php endforeach;?>
  		</div>
	</div>
	<?php
}

    protected function content_template(){}

}