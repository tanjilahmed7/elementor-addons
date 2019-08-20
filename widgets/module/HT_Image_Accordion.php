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

class HT_Image_Accordion extends Widget_Base
{
    public function get_name()
    {
        return 'ht-image-accordion';
    }

    public function get_title()
    {
        return esc_html__('HT Image Accordion', 'hubtag-elementor-addons');
    }

    public function get_icon()
    {
        return 'eicon-call-to-action';
    }

    public function get_categories()
    {
        return ['hubtag-elementor-addons'];
    }

    protected function _register_controls()
    {
        /**
         * Image accordion Content Settings
         */
        $this->start_controls_section(
            'ht_section_img_accordion_settings',
            [
                'label' => esc_html__('Image Accordion Settings', 'hubtag-elementor-addons'),
            ]
        );

        $this->add_control(
            'ht_img_accordion_type',
            [
                'label' => esc_html__('Accordion Style', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'on-hover',
                'label_block' => false,
                'options' => [
                    'on-hover' => esc_html__('On Hover', 'hubtag-elementor-addons'),
                    'on-click' => esc_html__('On Click', 'hubtag-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'ht_img_accordions',
            [
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => [
                    ['ht_accordion_bg' => plugin_dir_url('/') . 'hubtag-addons-elementor/assets/images/demo.png'],
                    ['ht_accordion_bg' => plugin_dir_url('/') . 'hubtag-addons-elementor/assets/images/demo.png'],
                    ['ht_accordion_bg' => plugin_dir_url('/') . 'hubtag-addons-elementor/assets/images/demo.png'],
                    ['ht_accordion_bg' => plugin_dir_url('/') . 'hubtag-addons-elementor/assets/images/demo.png'],
                ],
                'fields' => [
                    [
                        'name' => 'ht_accordion_bg',
                        'label' => esc_html__('Background Image', 'hubtag-elementor-addons'),
                        'type' => Controls_Manager::MEDIA,
                        'label_block' => true,
                        'default' => [
                            'url' => plugin_dir_url('/') . 'hubtag-addons-elementor/assets/images/demo.png',
                        ],
                    ],
                    [
                        'name' => 'ht_accordion_tittle',
                        'label' => esc_html__('Title', 'hubtag-elementor-addons'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__('Accordion item title', 'hubtag-elementor-addons'),
                        'dynamic' => ['active' => true],
                    ],
                    [
                        'name' => 'ht_accordion_content',
                        'label' => esc_html__('Content', 'hubtag-elementor-addons'),
                        'type' => Controls_Manager::WYSIWYG,
                        'label_block' => true,
                        'default' => esc_html__('Accordion content goes here!', 'hubtag-elementor-addons'),
                    ],
                    [
                        'name' => 'ht_accordion_title_link',
                        'label' => esc_html__('Title Link', 'hubtag-elementor-addons'),
                        'type' => Controls_Manager::URL,
                        'label_block' => true,
                        'default' => [
                            'url' => '#',
                            'is_external' => '',
                        ],
                        'show_external' => true,
                    ],
                ],
                'title_field' => '{{ht_accordion_tittle}}',
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Image accordion)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ht_section_img_accordion_style_settings',
            [
                'label' => esc_html__('Image Accordion Style', 'hubtag-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ht_accordion_height',
            [
                'label' => esc_html__('Height', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '400',
                'description' => 'Unit in px',
                'selectors' => [
                    '{{WRAPPER}} .ht-img-accordion ' => 'height: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'ht_accordion_bg_color',
            [
                'label' => esc_html__('Background Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ht-img-accordion' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ht_accordion_container_padding',
            [
                'label' => esc_html__('Padding', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ht-img-accordion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ht_accordion_container_margin',
            [
                'label' => esc_html__('Margin', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ht-img-accordion' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ht_accordion_border',
                'label' => esc_html__('Border', 'hubtag-elementor-addons'),
                'selector' => '{{WRAPPER}} .ht-img-accordion',
            ]
        );

        $this->add_control(
            'ht_accordion_border_radius',
            [
                'label' => esc_html__('Border Radius', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 4,
                ],
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ht-img-accordion' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ht_accordion_shadow',
                'selector' => '{{WRAPPER}} .ht-img-accordion',
            ]
        );

        $this->add_control(
            'ht_accordion_img_overlay_color',
            [
                'label' => esc_html__('Overlay Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, .3)',
                'selectors' => [
                    '{{WRAPPER}} .ht-img-accordion a:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ht_accordion_img_hover_color',
            [
                'label' => esc_html__('Hover Overlay Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, .5)',
                'selectors' => [
                    '{{WRAPPER}} .ht-img-accordion a:hover::after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ht-img-accordion a.overlay-active:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Image accordion Content Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ht_section_img_accordion_typography_settings',
            [
                'label' => esc_html__('Color &amp; Typography', 'hubtag-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ht_accordion_title_text',
            [
                'label' => esc_html__('Title', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ht_accordion_title_color',
            [
                'label' => esc_html__('Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ht-img-accordion .overlay h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ht_accordion_title_typography',
                'selector' => '{{WRAPPER}} .ht-img-accordion .overlay h2',
            ]
        );

        $this->add_control(
            'ht_accordion_content_text',
            [
                'label' => esc_html__('Content', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ht_accordion_content_color',
            [
                'label' => esc_html__('Color', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ht-img-accordion .overlay p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ht_accordion_content_typography',
                'selector' => '{{WRAPPER}} .ht-img-accordion .overlay p',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('ht-image-accordion', 'class', 'ht-img-accordion');
        $this->add_render_attribute('ht-image-accordion', 'data-img-accordion-id', esc_attr($this->get_id()));
        $this->add_render_attribute('ht-image-accordion', 'data-img-accordion-type', $settings['ht_img_accordion_type']);

        if (!empty($settings['ht_img_accordions'])) {
            echo '<div ' . $this->get_render_attribute_string('ht-image-accordion') . ' id="ht-img-accordion-' . $this->get_id() . '">';
            foreach ($settings['ht_img_accordions'] as $img_accordion) {
                $ht_accordion_link = $img_accordion['ht_accordion_title_link']['url'];
                $target = $img_accordion['ht_accordion_title_link']['is_external'] ? 'target="_blank"' : '';
                $nofollow = $img_accordion['ht_accordion_title_link']['nofollow'] ? 'rel="nofollow"' : '';

                echo '<a href="' . esc_url($ht_accordion_link) . '" ' . $target . ' ' . $nofollow . ' style="background-image: url(' . esc_url($img_accordion['ht_accordion_bg']['url']) . ');">
		            <div class="overlay">
		              <div class="overlay-inner">
		                <h2>' . $img_accordion['ht_accordion_tittle'] . '</h2>
		                <p>' . $img_accordion['ht_accordion_content'] . '</p>
		              </div>
		            </div>
		          </a>';
            }
            echo '</div>';

            if ('on-hover' === $settings['ht_img_accordion_type']) {
                echo '<style>
                  #ht-img-accordion-' . $this->get_id() . ' a:hover {
                    flex: 3;
                  }
                  #ht-img-accordion-' . $this->get_id() . ' a:hover .overlay-inner * {
                    opacity: 1;
                    visibility: visible;
                    transform: none;
                    transition: all .3s .3s;
                  }
                </style>';
            }
        }
    }
}
