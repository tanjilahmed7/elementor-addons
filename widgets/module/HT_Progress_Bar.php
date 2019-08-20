<?php
namespace HubTagAddonsElementor\Widgets;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use \HubTagAddonsElementor\Plugin;

class HT_Progress_Bar extends Widget_Base
{

    public function get_name()
    {
        return 'ht-progress-bar';
    }

    public function get_title()
    {
        return esc_html__('HT Progress Bar', 'hubtag-elementor-addons');
    }

    public function get_icon()
    {
        return 'fa fa-tasks';
    }

    public function get_categories()
    {
        return ['hubtag-elementor-addons'];
    }

    protected function _register_controls()
    {

        /*-----------------------------------------------------------------------------------*/
        /*  CONTENT TAB
        /*-----------------------------------------------------------------------------------*/

        /**
         * Content Tab: Layout
         */
  
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );
        
        $this->add_control(
            'progress_bar_layout',
            [
                'label' => __('Layout', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'single-line' => __('Single Line', 'hubtag-elementor-addons'),
                    'multi-line' => __('Mutiple Line', 'hubtag-elementor-addons'),
                    'sm-line' => __('Small Line', 'hubtag-elementor-addons'),
                    'pie' => __('Pie Line', 'hubtag-elementor-addons'),
                    
                ],
                'default' => 'single-line',
            ]
        );
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'prefix_title', [
				'label' => __( 'Prefix', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'plugin-domain' ),
				'label_block' => true,
			]
		);

		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'Color',
				'label' => __( 'Color', 'hubtag-pro' ),
				'types' => [ 'gradient' ],
				'default' => 'gradient',	
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		); 

        $repeater->add_control(
            'progress_bar_value',
            [
                'label' => __('Counter Value', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'separator' => 'before',
            ]
        );
             
        $repeater->add_control(
			'horizontal_position',
			[
				'label' => __( 'Horizontal Position', 'hubtag' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'transform-top' => [
						'title' => __( 'Top', 'elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'transform-middle' => [
						'title' => __( 'Middle', 'hubtag' ),
						'icon' => 'eicon-h-align-center',
					],
					'transform-bottom' => [
						'title' => __( 'Bottom', 'elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				] 
			]
		);

        $repeater->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .progress {{CURRENT_ITEM}}  span' => 'color: {{VALUE}}',
				],
			]
        );
        
        $repeater->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .progress {{CURRENT_ITEM}}  span' => 'color: {{VALUE}}',
				],
			]
		);


        $repeater->add_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'plugin-domain' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'plugin-domain' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'plugin-domain' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
        );
        

		$this->add_control(
			'progress-items',
			[
				'label' => __( 'Add Progress Bar', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'prefix_title' => __( 'Progress Bar #1', 'plugin-domain' ),
						'background_color' => '#833ca3',
					],
					[
						'prefix_title' => __( 'Progress Bar #2', 'plugin-domain' ),
						'background_color' => '#4054b2',
					],
                ],
                'condition' => [
                    'progress_bar_layout' => ['multi-line'],
                ],
				'title_field' => '{{{ prefix_title }}}',
			]
		);

        $this->add_control(
			'single_prefix_title', [
				'label' => __( 'Prefix', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Prefix' , 'plugin-domain' ),
                'label_block' => true,
                'condition' => [
                    'progress_bar_layout!' => ['multi-line'],
                ], 
            ]
            
        );
        

        $this->add_control(
            'single_progress_bar_value',
            [
                'label' => __('Counter Value', 'hubtag-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'separator' => 'before',
                'condition' => [
                    'progress_bar_layout!' => ['multi-line'],
                ],                
            ]
        );
        
        $this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .progress-bar' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'progress_bar_layout!' => ['multi-line'],
                ],                 
			]
        );
        
        $this->add_control(
			'single_title_color',
			[
				'label' => __( 'Title Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .progress-title  p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'progress_bar_layout!' => ['multi-line'],
                ],                 
			]
		);

        $this->add_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'plugin-domain' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'plugin-domain' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'plugin-domain' ),
						'icon' => 'fa fa-align-right',
					],
				],
                'default' => 'center',
                'selectors' => [
					'{{WRAPPER}} .progress span' => 'text-align: {{VALUE}}',
                ],
                'condition' => [
                    'progress_bar_layout!' => ['multi-line'],
                ],   
				'toggle' => true,
			]
        );
		$this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if($settings['progress_bar_layout'] == 'multi-line' ){
            if(!empty($settings['progress-items'])){
                echo '<div class="progress">';
                $count = 1;
                    foreach($settings['progress-items'] as $data){  

                        $Color_gradient_type        = $data['Color_gradient_type'];
                        $Color_gradient_position    = $data['Color_gradient_position'];
                        $bg_color                   = $data['bg_color'];
                        $bg1                        = $data['Color_color'];
                        $bg1_Size                   = $data['Color_color_stop']['size'];
                        $bg1_Unit                   = $data['Color_color_stop']['unit'];
                        $Color_gradient_angle       = $data['Color_gradient_angle']['size'].$data['Color_gradient_angle']['unit'];
                        $location1                  = $bg1_Size.$bg1_Unit;
                        $bg2                        = $data['Color_color_b'];
                        $bg2_Size                   = $data['Color_color_b_stop']['size'];
                        $bg2_Unit                   = $data['Color_color_b_stop']['unit'];
                        $location2                  = $bg2_Size.$bg2_Unit;

                        // echo "<pre>";
                        // print_r($data);
                        // echo "</pre>";

                        if($data['horizontal_position'] == 'transform-top'){
                            $postion = 'transform: translateY(-40px);';
                        }
                        elseif($data['horizontal_position'] == 'transform-middle'){
                            $postion = 'transform: translateY(0px);';
                        }
                        elseif($data['horizontal_position'] == 'transform-bottom'){
                            $postion = 'transform: translateY(40px);';
                        }
                        else{
                            $postion = 'transform: translateY(-40px);';
                        }
                        // die();    
                        if($Color_gradient_type == 'radial'){
                            $progressCss = 'background-image: radial-gradient(circle at '.$Color_gradient_position.', '.$bg1.' '.$location1.', '.$bg2.' '.$location2.');';
                        }
                        elseif($Color_gradient_type == 'linear'){
                             $progressCss = 'background-image: linear-gradient('.$Color_gradient_angle.', '.$bg1.' '.$location1.', '.$bg2.' '.$location2.');';
                        }else{
                            $progressCss = 'background-color:'.$bg_color; 
                        }     
                        echo '
                            <div class="progress-bar elementor-repeater-item-'.$data['_id'].'" id="progress-' . $count .'" role="progressbar" style="width: '.  $data['progress_bar_value']['size'] . $data['progress_bar_value']['unit'] . ";" . 'text-align:' . $data['text_align'] . ';' . $progressCss .'; " aria-valuenow="'. $data['progress_bar_value']['size'] .'" aria-valuemin="0" aria-valuemax="100">
                                <span style="'. $postion .'; font-weight: 900">'.  $data['progress_bar_value']['size'] . '</span>
                            </div>';
                        $count++;         

                    }
                echo '</div>';
            }
        }elseif($settings['progress_bar_layout'] == 'single-line'){
        
            echo '
                <div class="progress-title">
                    <p>' . $settings['single_prefix_title']. '</p>
                </div>
            
                <div class="single progress">
                    <div class="progress-bar " role="progressbar" style="width: '.$settings['single_progress_bar_value']['size'].$settings['single_progress_bar_value']['unit'].';" aria-valuenow="'. $settings['single_progress_bar_value']['size'] .'" aria-valuemin="0" aria-valuemax="100">'. '<span style="">' . $settings['single_progress_bar_value']['size'].$settings['single_progress_bar_value']['unit'] .'</span></div>
                </div>';
        }elseif($settings['progress_bar_layout'] == 'sm-line'){
            echo '
                <div class="progress-title">
                    <p>' . $settings['single_prefix_title']. '</p>
                </div>
            
                <div class="single progress" style="height: 10px;">
                    <div class="progress-bar" role="progressbar" style="width: '.$settings['single_progress_bar_value']['size'].$settings['single_progress_bar_value']['unit'].';" aria-valuenow="'. $settings['single_progress_bar_value']['size'] .'" aria-valuemin="0" aria-valuemax="100">
                        <span>'. $settings['single_progress_bar_value']['size']  .'</span>
                    </div>
                </div>';
        }elseif($settings['progress_bar_layout'] == 'pie'){
            echo '';
        }


        
    }
}
