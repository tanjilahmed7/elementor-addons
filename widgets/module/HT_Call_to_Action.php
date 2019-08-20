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
use HubTagAddonsElementor\Widgets\Inc\Helper as Helper;

class HT_Call_To_Action extends Widget_Base {
	use Helper;

	public function get_name() {
		return 'ht-call-to-action';
	}

	public function get_title() {
		return esc_html__( 'HT Call to Action', 'hubtag-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-call-to-action';
	}

   public function get_categories() {
        return [ 'hubtag-elementor-addons' ]; // category of the widget
	}


	protected function _register_controls() {

        /**
         * Call to Action Content Settings
         */
        $this->start_controls_section(
            'ht_section_tag_content_settings',
            [
                'label' => esc_html__( 'Content Settings', 'hubtag-elementor-addons' )
            ]
        );

        $this->add_control(
        'ht_tag_type',
            [
             'label'       	=> esc_html__( 'Content Style', 'hubtag-elementor-addons' ),
               'type' 			=> Controls_Manager::SELECT,
               'default' 		=> 'tag-basic',
               'label_block' 	=> false,
               'options' 		=> [
                   'tag-basic'  		=> esc_html__( 'Basic', 'hubtag-elementor-addons' ),
                   'tag-flex' 			=> esc_html__( 'Flex Grid', 'hubtag-elementor-addons' ),
                   'tag-icon-flex' 	=> esc_html__( 'Flex Grid with Icon', 'hubtag-elementor-addons' ),
               ],
            ]
      );

        /**
         * Condition: 'ht_tag_type' => 'tag-basic'
         */
      $this->add_control(
        'ht_tag_content_type',
            [
             'label'       	=> esc_html__( 'Content Type', 'hubtag-elementor-addons' ),
               'type' 			=> Controls_Manager::SELECT,
               'default' 		=> 'tag-default',
               'label_block' 	=> false,
               'options' 		=> [
                   'tag-default'  	=> esc_html__( 'Left', 'hubtag-elementor-addons' ),
                   'tag-center' 		=> esc_html__( 'Center', 'hubtag-elementor-addons' ),
                   'tag-right' 		=> esc_html__( 'Right', 'hubtag-elementor-addons' ),
               ],
               'condition'    => [
                   'ht_tag_type' => 'tag-basic'
               ]
            ]
      );

      $this->add_control(
        'ht_tag_color_type',
            [
             'label'       	=> esc_html__( 'Color Style', 'hubtag-elementor-addons' ),
               'type' 			=> Controls_Manager::SELECT,
               'default' 		=> 'tag-bg-color',
               'label_block' 	=> false,
               'options' 		=> [
                   'tag-bg-color'  		=> esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
                   'tag-bg-img' 			=> esc_html__( 'Background Image', 'hubtag-elementor-addons' ),
                   'tag-bg-img-fixed' 	=> esc_html__( 'Background Fixed Image', 'hubtag-elementor-addons' ),
               ],
            ]
      );

      /**
       * Condition: 'ht_tag_type' => 'tag-icon-flex'
       */
      $this->add_control(
          'ht_tag_flex_grid_icon',
          [
              'label' => esc_html__( 'Icon', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::ICON,
              'default' => 'fa fa-bullhorn',
              'condition' => [
                  'ht_tag_type' => 'tag-icon-flex'
              ]
          ]
      );

      $this->add_control(
          'ht_tag_title',
          [
              'label' => esc_html__( 'Title', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::TEXT,
              'label_block' => true,
              'default' => esc_html__( 'Hubtag Addons For Elementor', 'hubtag-elementor-addons' ),
              'dynamic' => [ 'active' => true ]
          ]
      );
      $this->add_control(
          'ht_tag_title_content_type',
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
                  'ht_tag_title_content_type'      => 'template',
              ],
          ]
      );
      $this->add_control(
          'ht_tag_content',
          [
              'label' => esc_html__( 'Content', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::WYSIWYG,
              'label_block' => true,
              'default' => esc_html__( 'Add a strong one liner supporting the heading above and giving users a reason to click on the button below.', 'hubtag-elementor-addons' ),
              'separator' => 'after',
              'condition' => [
                  'ht_tag_title_content_type' => 'content'
              ]
          ]
      );

      $this->add_control(
          'ht_tag_btn_text',
          [
              'label' => esc_html__( 'Button Text', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::TEXT,
              'label_block' => true,
              'default' => esc_html__( 'Button Text', 'hubtag-elementor-addons' )
          ]
      );

      $this->add_control(
          'ht_tag_btn_link',
          [
              'label' => esc_html__( 'Button Link', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::URL,
              'label_block' => true,
              'default' => [
                  'url' => 'http://',
                  'is_external' => '',
               ],
               'show_external' => true,
               'separator' => 'after'
          ]
      );

      /**
       * Condition: 'ht_tag_color_type' => 'tag-bg-img' && 'ht_tag_color_type' => 'tag-bg-img-fixed',
       */
      $this->add_control(
          'ht_tag_bg_image',
          [
              'label' => esc_html__( 'Background Image', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::MEDIA,
              'default' => [
                  'url' => Utils::get_placeholder_image_src(),
              ],
              'selectors' => [
              '{{WRAPPER}} .ht-call-to-action.bg-img' => 'background-image: url({{URL}});',
              '{{WRAPPER}} .ht-call-to-action.bg-img-fixed' => 'background-image: url({{URL}});',
              ],
              'condition' => [
                  'ht_tag_color_type' => [ 'tag-bg-img', 'tag-bg-img-fixed' ],
              ]
          ]
      );

      $this->end_controls_section();


      /**
       * -------------------------------------------
       * Tab Style (tag Title Style)
       * -------------------------------------------
       */
      $this->start_controls_section(
          'ht_section_tag_style_settings',
          [
              'label' => esc_html__( 'Call to Action Style', 'hubtag-elementor-addons' ),
              'tab' => Controls_Manager::TAB_STYLE
          ]
      );

      $this->add_control(
          'ht_tag_container_width',
          [
              'label' => esc_html__( 'Set max width for the container?', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::SWITCHER,
              'label_on' => __( 'yes', 'hubtag-elementor-addons' ),
              'label_off' => __( 'no', 'hubtag-elementor-addons' ),
              'default' => 'yes',
          ]
      );

      $this->add_responsive_control(
          'ht_tag_container_width_value',
          [
              'label' => __( 'Container Max Width (% or px)', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::SLIDER,
              'default' => [
                  'size' => 1170,
                  'unit' => 'px',
              ],
              'size_units' => [ 'px', '%' ],
              'range' => [
                  'px' => [
                      'min' => 0,
                      'max' => 1500,
                      'step' => 5,
                  ],
                  '%' => [
                      'min' => 1,
                      'max' => 100,
                  ],
              ],
              'selectors' => [
                  '{{WRAPPER}} .ht-call-to-action' => 'max-width: {{SIZE}}{{UNIT}};',
              ],
              'condition' => [
                  'ht_tag_container_width' => 'yes',
              ],
          ]
      );

      $this->add_control(
          'ht_tag_bg_color',
          [
              'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::COLOR,
              'default' => '#f4f4f4',
              'selectors' => [
                  '{{WRAPPER}} .ht-call-to-action' => 'background-color: {{VALUE}};',
              ],
          ]
      );

      $this->add_responsive_control(
          'ht_tag_container_padding',
          [
              'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::DIMENSIONS,
              'size_units' => [ 'px', 'em', '%' ],
              'selectors' => [
                       '{{WRAPPER}} .ht-call-to-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
               ],
          ]
      );

      $this->add_responsive_control(
          'ht_tag_container_margin',
          [
              'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::DIMENSIONS,
              'size_units' => [ 'px', 'em', '%' ],
              'selectors' => [
                       '{{WRAPPER}} .ht-call-to-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
               ],
          ]
      );

      $this->add_group_control(
          Group_Control_Border::get_type(),
          [
              'name' => 'ht_tag_border',
              'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
              'selector' => '{{WRAPPER}} .ht-call-to-action',
          ]
      );

      $this->add_control(
          'ht_tag_border_radius',
          [
              'label' => esc_html__( 'Border Radius', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                  'px' => [
                      'max' => 500,
                  ],
              ],
              'selectors' => [
                  '{{WRAPPER}} .ht-call-to-action' => 'border-radius: {{SIZE}}px;',
              ],
          ]
      );

      $this->add_group_control(
          Group_Control_Box_Shadow::get_type(),
          [
              'name' => 'ht_tag_shadow',
              'selector' => '{{WRAPPER}} .ht-call-to-action',
          ]
      );


      $this->end_controls_section();

      /**
       * -------------------------------------------
       * Tab Style (tag Title Style)
       * -------------------------------------------
       */
      $this->start_controls_section(
          'ht_section_tag_title_style_settings',
          [
              'label' => esc_html__( 'Color &amp; Typography ', 'hubtag-elementor-addons' ),
              'tab' => Controls_Manager::TAB_STYLE
          ]
      );

      $this->add_control(
          'ht_tag_title_heading',
          [
              'label' => esc_html__( 'Title Style', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::HEADING,
          ]
      );

      $this->add_control(
          'ht_tag_title_color',
          [
              'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .ht-call-to-action .title' => 'color: {{VALUE}};',
              ],
          ]
      );

      $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
           'name' => 'ht_tag_title_typography',
              'selector' => '{{WRAPPER}} .ht-call-to-action .title',
          ]
      );

      $this->add_control(
          'ht_tag_content_heading',
          [
              'label' => esc_html__( 'Content Style', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::HEADING,
              'separator' => 'before'
          ]
      );

      $this->add_control(
          'ht_tag_content_color',
          [
              'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .ht-call-to-action p' => 'color: {{VALUE}};',
              ],
          ]
      );

      $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
           'name' => 'ht_tag_content_typography',
              'selector' => '{{WRAPPER}} .ht-call-to-action p',
          ]
      );

      $this->end_controls_section();

      /**
       * -------------------------------------------
       * Tab Style (Button Style)
       * -------------------------------------------
       */
      $this->start_controls_section(
          'ht_section_tag_btn_style_settings',
          [
              'label' => esc_html__( 'Button Style', 'hubtag-elementor-addons' ),
              'tab' => Controls_Manager::TAB_STYLE
          ]
      );

      $this->add_control(
        'ht_tag_btn_effect_type',
            [
             'label'       	=> esc_html__( 'Effect', 'hubtag-elementor-addons' ),
               'type' 			=> Controls_Manager::SELECT,
               'default' 		=> 'default',
               'label_block' 	=> false,
               'options' 		=> [
                   'default'  			=> esc_html__( 'Default', 'hubtag-elementor-addons' ),
                   'top-to-bottom'  	=> esc_html__( 'Top to Bottom', 'hubtag-elementor-addons' ),
                   'left-to-right'  	=> esc_html__( 'Left to Right', 'hubtag-elementor-addons' ),
               ],
            ]
      );

      $this->add_responsive_control(
          'ht_tag_btn_padding',
          [
              'label' => esc_html__( 'Padding', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::DIMENSIONS,
              'size_units' => [ 'px', 'em', '%' ],
              'selectors' => [
                       '{{WRAPPER}} .ht-call-to-action .tag-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
               ],
          ]
      );

      $this->add_responsive_control(
          'ht_tag_btn_margin',
          [
              'label' => esc_html__( 'Margin', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::DIMENSIONS,
              'size_units' => [ 'px', 'em', '%' ],
              'selectors' => [
                       '{{WRAPPER}} .ht-call-to-action .tag-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
               ],
          ]
      );
      $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
           'name' => 'ht_tag_btn_typography',
              'selector' => '{{WRAPPER}} .ht-call-to-action .tag-button',
          ]
      );

      $this->start_controls_tabs( 'ht_tag_button_tabs' );

          // Normal State Tab
          $this->start_controls_tab( 'ht_tag_btn_normal', [ 'label' => esc_html__( 'Normal', 'hubtag-elementor-addons' ) ] );

          $this->add_control(
              'ht_tag_btn_normal_text_color',
              [
                  'label' => esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
                  'type' => Controls_Manager::COLOR,
                  'default' => '#4d4d4d',
                  'selectors' => [
                      '{{WRAPPER}} .ht-call-to-action .tag-button' => 'color: {{VALUE}};',
                  ],
              ]
          );

          $this->add_control(
              'ht_tag_btn_normal_bg_color',
              [
                  'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
                  'type' => Controls_Manager::COLOR,
                  'default' => '#f9f9f9',
                  'selectors' => [
                      '{{WRAPPER}} .ht-call-to-action .tag-button' => 'background: {{VALUE}};',
                  ],
              ]
          );

          $this->add_group_control(
              Group_Control_Border::get_type(),
              [
                  'name' => 'ht_cat_btn_normal_border',
                  'label' => esc_html__( 'Border', 'hubtag-elementor-addons' ),
                  'selector' => '{{WRAPPER}} .ht-call-to-action .tag-button',
              ]
          );

          $this->add_control(
              'ht_tag_btn_border_radius',
              [
                  'label' => esc_html__( 'Border Radius', 'hubtag-elementor-addons' ),
                  'type' => Controls_Manager::SLIDER,
                  'range' => [
                      'px' => [
                          'max' => 100,
                      ],
                  ],
                  'selectors' => [
                      '{{WRAPPER}} .ht-call-to-action .tag-button' => 'border-radius: {{SIZE}}px;',
                  ],
              ]
          );

          $this->end_controls_tab();

          // Hover State Tab
          $this->start_controls_tab( 'ht_tag_btn_hover', [ 'label' => esc_html__( 'Hover', 'hubtag-elementor-addons' ) ] );

          $this->add_control(
              'ht_tag_btn_hover_text_color',
              [
                  'label' => esc_html__( 'Text Color', 'hubtag-elementor-addons' ),
                  'type' => Controls_Manager::COLOR,
                  'default' => '#f9f9f9',
                  'selectors' => [
                      '{{WRAPPER}} .ht-call-to-action .tag-button:hover' => 'color: {{VALUE}};',
                  ],
              ]
          );

          $this->add_control(
              'ht_tag_btn_hover_bg_color',
              [
                  'label' => esc_html__( 'Background Color', 'hubtag-elementor-addons' ),
                  'type' => Controls_Manager::COLOR,
                  'default' => '#3F51B5',
                  'selectors' => [
                      '{{WRAPPER}} .ht-call-to-action .tag-button:after' => 'background: {{VALUE}};',
                      '{{WRAPPER}} .ht-call-to-action .tag-button:hover' => 'background: {{VALUE}};',
                  ],
              ]
          );

          $this->add_control(
              'ht_tag_btn_hover_border_color',
              [
                  'label' => esc_html__( 'Border Color', 'hubtag-elementor-addons' ),
                  'type' => Controls_Manager::COLOR,
                  'default' => '',
                  'selectors' => [
                      '{{WRAPPER}} .ht-call-to-action .tag-button:hover' => 'border-color: {{VALUE}};',
                  ],
              ]

          );

          $this->end_controls_tab();

      $this->end_controls_tabs();

      $this->add_group_control(
          Group_Control_Box_Shadow::get_type(),
          [
              'name' => 'ht_tag_button_shadow',
              'selector' => '{{WRAPPER}} .ht-call-to-action .tag-button',
              'separator' => 'before'
          ]
      );

      $this->end_controls_section();

      /**
       * -------------------------------------------
       * Tab Style (Button Style)
       * -------------------------------------------
       */
      $this->start_controls_section(
          'ht_section_tag_icon_style_settings',
          [
              'label' => esc_html__( 'Icon Style', 'hubtag-elementor-addons' ),
              'tab' => Controls_Manager::TAB_STYLE,
              'condition' => [
                  'ht_tag_type' => 'tag-icon-flex'
              ]
          ]
      );

      $this->add_control(
          'ht_section_tag_icon_size',
          [
              'label' => esc_html__( 'Font Size', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::SLIDER,
              'default' => [
                  'size' => 80
              ],
              'range' => [
                  'px' => [
                      'max' => 160,
                  ],
              ],
              'selectors' => [
                  '{{WRAPPER}} .ht-call-to-action.tag-icon-flex .icon' => 'font-size: {{SIZE}}px;',
              ],
          ]
      );

      $this->add_control(
          'ht_section_tag_icon_color',
          [
              'label' => esc_html__( 'Color', 'hubtag-elementor-addons' ),
              'type' => Controls_Manager::COLOR,
              'default' => '#444',
              'selectors' => [
                  '{{WRAPPER}} .ht-call-to-action.tag-icon-flex .icon' => 'color: {{VALUE}};',
              ],
          ]
      );

      $this->end_controls_section();

  }


  protected function render( ) {

         $settings = $this->get_settings_for_display();
        $target = $settings['ht_tag_btn_link']['is_external'] ? 'target="_blank"' : '';
        $nofollow = $settings['ht_tag_btn_link']['nofollow'] ? 'rel="nofollow"' : '';
        if( 'tag-bg-color' == $settings['ht_tag_color_type'] ) {
            $tag_class = 'bg-lite';
        }else if( 'tag-bg-img' == $settings['ht_tag_color_type'] ) {
            $tag_class = 'bg-img';
        }else if( 'tag-bg-img-fixed' == $settings['ht_tag_color_type'] ) {
            $tag_class = 'bg-img bg-fixed';
        }else {
            $tag_class = '';
        }
        // Is Basic tag Content Center or Not
        if( 'tag-center' === $settings['ht_tag_content_type'] ) {
            $tag_alignment = 'tag-center';
        }elseif( 'tag-right' === $settings['ht_tag_content_type'] ) {
            $tag_alignment = 'tag-right';
        }else {
            $tag_alignment = 'tag-left';
        }
        // Button Effect
        if( 'left-to-right' == $settings['ht_tag_btn_effect_type'] ) {
            $tag_btn_effect = 'effect-2';
        }elseif( 'top-to-bottom' == $settings['ht_tag_btn_effect_type'] ) {
            $tag_btn_effect = 'effect-1';
        }else {
            $tag_btn_effect = '';
        }

  ?>
  <?php if( 'tag-basic' == $settings['ht_tag_type'] ) : ?>
  <div class="ht-call-to-action <?php echo esc_attr( $tag_class ); ?> <?php echo esc_attr( $tag_alignment ); ?>">
      <h2 class="title"><?php echo $settings['ht_tag_title']; ?></h2>
      <?php if( 'content' == $settings['ht_tag_title_content_type'] ) : ?>
      <p><?php echo $settings['ht_tag_content']; ?></p>
      <?php elseif( 'template' == $settings['ht_tag_title_content_type'] ) : ?>
          <?php
              if ( !empty( $settings['ht_primary_templates'] ) ) {
                  $ht_template_id = $settings['ht_primary_templates'];
                  $ht_frontend = new Frontend;
                  echo $ht_frontend->get_builder_content( $ht_template_id, true );
              }
          ?>
      <?php endif; ?>
      <a href="<?php echo esc_url( $settings['ht_tag_btn_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="tag-button <?php echo esc_attr( $tag_btn_effect ); ?>"><?php esc_html_e( $settings['ht_tag_btn_text'], 'hubtag-elementor-addons' ); ?></a>
  </div>
  <?php endif; ?>
  <?php if( 'tag-flex' == $settings['ht_tag_type'] ) : ?>
  <div class="ht-call-to-action tag-flex <?php echo esc_attr( $tag_class ); ?>">
      <div class="content">
          <h2 class="title"><?php echo $settings['ht_tag_title']; ?></h2>
          <?php if( 'content' == $settings['ht_tag_title_content_type'] ) : ?>
          <p><?php echo $settings['ht_tag_content']; ?></p>
          <?php elseif( 'template' == $settings['ht_tag_title_content_type'] ) : ?>
              <?php
                  if ( !empty( $settings['ht_primary_templates'] ) ) {
                      $ht_template_id = $settings['ht_primary_templates'];
                      $ht_frontend = new Frontend;
                      echo $ht_frontend->get_builder_content( $ht_template_id, true );
                  }
              ?>
          <?php endif; ?>
      </div>
      <div class="action">
          <a href="<?php echo esc_url( $settings['ht_tag_btn_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="tag-button <?php echo esc_attr( $tag_btn_effect ); ?>"><?php esc_html_e( $settings['ht_tag_btn_text'], 'hubtag-elementor-addons' ); ?></a>
      </div>
  </div>
  <?php endif; ?>
  <?php if( 'tag-icon-flex' == $settings['ht_tag_type'] ) : ?>
  <div class="ht-call-to-action tag-icon-flex <?php echo esc_attr( $tag_class ); ?>">
      <div class="icon">
          <i class="<?php echo esc_attr( $settings['ht_tag_flex_grid_icon'] ); ?>"></i>
      </div>
      <div class="content">
          <h2 class="title"><?php echo $settings['ht_tag_title']; ?></h2>
          <?php if( 'content' == $settings['ht_tag_title_content_type'] ) : ?>
          <p><?php echo $settings['ht_tag_content']; ?></p>
          <?php elseif( 'template' == $settings['ht_tag_title_content_type'] ) : ?>
              <?php
                  if ( !empty( $settings['ht_primary_templates'] ) ) {
                      $ht_template_id = $settings['ht_primary_templates'];
                      $ht_frontend = new Frontend;
                      echo $ht_frontend->get_builder_content( $ht_template_id, true );
                  }
              ?>
          <?php endif; ?>
      </div>
      <div class="action">
         <a href="<?php echo esc_url( $settings['ht_tag_btn_link']['url'] ); ?>" <?php echo $target; ?> class="tag-button <?php echo esc_attr( $tag_btn_effect ); ?>"><?php esc_html_e( $settings['ht_tag_btn_text'], 'hubtag-elementor-addons' ); ?></a>
      </div>
  </div>
  <?php endif; ?>
  <?php
  }

  protected function content_template() {}

}

