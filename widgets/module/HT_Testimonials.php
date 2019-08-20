<?php

namespace HubTagAddonsElementor\Widgets;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Background as Group_Control_Background;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Scheme_Color as Scheme_Color;
use \Elementor\Scheme_Typography as Scheme_Typography;
use \Elementor\Utils as Utils;
use \Elementor\Widget_Base as Widget_Base;
use \Elementor\Group_Control_Image_Size as Group_Control_Image_Size;
class HT_Testimonials extends Widget_Base
{
	public function get_name() {
		return 'ht-testimonials';
	}

	public function get_title() {
		return esc_html__( 'HT Testimonials', 'hubtag-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-bullet-list';
	}

	public function get_categories() {
		return ['hubtag-elementor-addons'];
	}

	protected function _register_controls() {
		/**
		 * testimonials List Settings
		 */
		$this->start_controls_section(
			'ht_section_testimonials_content_settings',
			[
				'label' => esc_html__( 'Testimonials Settings', 'hubtag-elementor-addons' )
			]
        );
        

		$this->add_control(
			'testimonials_style',
			[
				'label' => __( 'Testimonials Style', 'hubtag-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'hubtag-elementor-addons' ),
					'style-2'  => __( 'Style 2', 'hubtag-elementor-addons' ),
					'style-3'  => __( 'Style 3', 'hubtag-elementor-addons' ),
					'style-4'  => __( 'Style 4', 'hubtag-elementor-addons' ),
					'style-5'  => __( 'Style 5', 'hubtag-elementor-addons' ),
					'style-6'  => __( 'Style 6', 'hubtag-elementor-addons' ),
				],
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'hubtag-elementor-addons' ),
				'types' => [ 'classic' ],
				'default' => 'classic',	
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
        ); 
                
		$repeater->add_control(
			'testimonials_title', [
				'label' => __( 'Name', 'hubtag-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Tanjil Ahmed' , 'hubtag-elementor-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'testimonials_content', [
				'label' => __( 'Content', 'hubtag-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'List Content' , 'hubtag-elementor-addons' ),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'testimonials_destination', [
				'label' => __( 'Destination', 'hubtag-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Destination' , 'hubtag-elementor-addons' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'ht_testimonial_enable_avatar',
			[
				'label' => esc_html__( 'Display Avatar?', 'hubtag-elementor-addons
				' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$repeater->add_control(
			'testimonial_image',
			[
				'label' => __( 'Testimonial Avatar', 'hubtag-elementor-addons
				' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ht_testimonial_enable_avatar' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'ht_testimonial_enable_rating',
			[
				'label' => esc_html__( 'Display Rating?', 'hubtag-elementor-addons
				' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$repeater->add_control(
			'ht_rating',
			[
				'label' => __( 'Rating', 'hubtag-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1' => __( '1', 'hubtag-elementor-addons' ),
					'2' => __( '2', 'hubtag-elementor-addons' ),
					'3' => __( '3', 'hubtag-elementor-addons' ),
					'4' => __( '4', 'hubtag-elementor-addons' ),
					'5' => __( '5', 'hubtag-elementor-addons' ),
				],
				'default' => '1',
				'condition' => [
					'ht_testimonial_enable_rating' => 'yes',
				],							
			]
			
		);

		

		$this->add_control(
			'testimonials_list',
			[
				'label' => __( 'Testimonials List', 'hubtag-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'testimonials_title' => __( 'Title #1', 'hubtag-elementor-addons' ),
						'testimonials_content' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.' ),
						'background_background'	=> 'classic',
						'background_color' => '#23a455',						
					],
					[
						'testimonials_title' => __( 'Title #2', 'hubtag-elementor-addons' ),
						'testimonials_content' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.' ),
						'background_background'	=> 'classic',
						'background_color' => '#833ca3',
					],
					[
						'testimonials_title' => __( 'Title #3', 'hubtag-elementor-addons' ),
						'testimonials_content' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.' ),
						'background_background'	=> 'classic',
						'background_color' => '#d3534a',
					],
				],
				'title_field' => '{{{ testimonials_title }}}',

				'condition' => [
					'testimonials_style!' => [ 'style-5', 'style-6' ],
				],

			]
		);



				// Repeter
				$repeater2 = new \Elementor\Repeater();

				$repeater2->add_control(
					'animate_testimonials_image',
					[
						'label' => __( 'Choose Image', 'hubtag-elementor-addons' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => plugin_dir_url('/') . 'hubtag-addons-elementor/assets/images/Ben-3.png',
						],
					]
				);
		
				$repeater2->add_control(
					'animate_testimonials_title', [
						'label' => __( 'Name', 'hubtag-elementor-addons' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => __( 'Tanjil Ahmed' , 'hubtag-elementor-addons' ),
						'label_block' => true,
					]
				);
		
				$repeater2->add_control(
					'animate_testimonials_content', [
						'label' => __( 'Content', 'hubtag-elementor-addons' ),
						'type' => \Elementor\Controls_Manager::WYSIWYG,
						'default' => __( 'List Content' , 'hubtag-elementor-addons' ),
						'show_label' => false,
					]
				);

				$repeater2->add_control(
					'show_right',
					[
						'label' => __( 'Show Right', 'hubtag-elementor-addons' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_on' => __( 'Show', 'your-plugin' ),
						'label_off' => __( 'Hide', 'your-plugin' ),
						'return_value' => 'yes',
						'default' => 'yes',
					]
				);				

		
				$this->add_control(
					'ht_animate_list',
					[
						'label' => __( 'Testimonials List', 'hubtag-elementor-addons' ),
						'type' => \Elementor\Controls_Manager::REPEATER,
						'fields' => $repeater2->get_controls(),
						'default' => [
							[
								'animate_testimonials_title' => __( 'Title #1', 'hubtag-elementor-addons' ),
								'animate_testimonials_content' => __( 'Item content. Click the edit button to change this text.', 'hubtag-elementor-addons' ),
							],
							[
								'animate_testimonials_title' => __( 'Title #2', 'hubtag-elementor-addons' ),
								'animate_testimonials_content' => __( 'Item content. Click the edit button to change this text.', 'hubtag-elementor-addons' ),
							],
						],
						'title_field' => '{{{ animate_testimonials_title }}}',
						'condition' => [
							'testimonials_style' => 'style-5',
							
						],
		
					]
				);


				// Repeter
				$repeater3 = new \Elementor\Repeater();

				$repeater3->add_control(
					'border_animate_testimonials_image',
					[
						'label' => __( 'Choose Image', 'hubtag-elementor-addons' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => plugin_dir_url('/') . 'hubtag-addons-elementor/assets/images/Ben-3.png',
						],
					]
				);
		
				$repeater3->add_control(
					'border_animate_testimonials_title', [
						'label' => __( 'Name', 'hubtag-elementor-addons' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => __( 'Tanjil Ahmed' , 'hubtag-elementor-addons' ),
						'label_block' => true,
					]
				);
		
				$repeater3->add_control(
					'border_animate_testimonials_content', [
						'label' => __( 'Content', 'hubtag-elementor-addons' ),
						'type' => \Elementor\Controls_Manager::WYSIWYG,
						'default' => __( 'List Content' , 'hubtag-elementor-addons' ),
						'show_label' => false,
					]
				);

		
				$this->add_control(
					'ht_border_animate_list',
					[
						'label' => __( 'Testimonials List', 'hubtag-elementor-addons' ),
						'type' => \Elementor\Controls_Manager::REPEATER,
						'fields' => $repeater3->get_controls(),
						'default' => [
							[
								'border_animate_testimonials_title' => __( 'Title #1', 'hubtag-elementor-addons' ),
								'border_animate_testimonials_content' => __( 'Item content. Click the edit button to change this text.', 'hubtag-elementor-addons' ),
							],
							[
								'border_animate_testimonials_title' => __( 'Title #2', 'hubtag-elementor-addons' ),
								'border_animate_testimonials_content' => __( 'Item content. Click the edit button to change this text.', 'hubtag-elementor-addons' ),
							],
						],
						'title_field' => '{{{ border_animate_testimonials_title }}}',
						'condition' => [
							'testimonials_style' => 'style-6',
							
						],
		
					]
				);

				
				
		$this->end_controls_section();

		$this->start_controls_section(
			'ht_testimonial_title_style_section',
			[
				'label' => __( 'Title', 'hubtag-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ht_testimonial_title_icon_typography',
				'selector' => '{{WRAPPER}} .Testimonials-2 .block cite span, .testimonial-avater, .ht-border-title h3',
			]
		);

		
		$this->add_control(
			'ht_testimonial_title_icon_color',
			[
				'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .testimonial-avater, .Testimonials-2 .block cite span, .ht-border-title h3' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'ht_testimonial_content_style_section',
			[
				'label' => __( 'Content', 'hubtag-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ht_testimonial_content_icon_typography',
				'selector' => '{{WRAPPER}} .testimonials-slide p, .Testimonials-2 .block p, .testimonial-avater,.ht-border-content p',
			]
		);

		
		$this->add_control(
			'ht_testimonial_content_icon_color',
			[
				'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .testimonials-slide p, .Testimonials-2 .block p,.ht-border-content p' => 'color: {{VALUE}};',
				]
			]
		);

		
		$this->end_controls_section();


		$this->start_controls_section(
			'ht_testimonial_caret_style_section',
			[
				'label' => __( 'Caret', 'hubtag-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		
		$this->add_control(
			'ht_testimonial_caret_icon_color',
			[
				'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} figure.testimonial .arrow' => 'border-top-color: {{VALUE}}',
				]
			]
		);

		
		$this->end_controls_section();


		$this->start_controls_section(
			'ht_testimonial_arrows_style_section',
			[
				'label' => __( 'Arrows', 'hubtag-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ht_testimonial_arrows_icon_color',
			[
				'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .ht-testimonials .slick-prev, .slick-next' => 'color: {{VALUE}}!important',
				]
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'ht_testimonial_quote_style_section',
			[
				'label' => __( 'Quote', 'hubtag-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ht_testimonial_quote_icon_color',
			[
				'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .testimonials-slide::before' => 'background: {{VALUE}}',
				]
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'ht_testimonial_title_background_style_section',
			[
				'label' => __( 'Background', 'hubtag-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ht_testimonial_background_color',
			[
				'label' => esc_html__( 'Color', 'hubTag-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .ht-border-title h3' => 'background: {{VALUE}}!important',
				]
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'ht_testimonial_border_style_section',
			[
				'label' => __( 'Border', 'hubtag-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ht_testimonial_border_content',
				'label' => __( 'Border', 'hubtag-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ht-border-content',
			]
		);


		$this->end_controls_section();

	}

	protected function render() {
    $settings = $this->get_settings();
        // echo "<pre>";
        //     var_dump($settings['testimonials_list']);
        //     //die();
		// echo "</pre>";
		$this->add_render_attribute(
			'data-style',
			[
				'data-style' => $settings['testimonials_style'],
				'class' => [ 'ht-testimonials', 'tm-layout-'.$settings['testimonials_style'] ],
			]
		);

		
		$data_style = $this->get_render_attribute_string( 'data-style' );
    ?>
		<?php if($settings['testimonials_style'] == 'style-1'){
		?>
			<div <?php echo $data_style; ?>>
				<?php 
					foreach ($settings['testimonials_list'] as $tesimonials_data){
						$this->add_render_attribute(
							'data-rating',
							[
								'class' => [ 'rating', 'point-'.$tesimonials_data['ht_rating'] ]
							]
						);
						$rating = $this->get_render_attribute_string( 'data-rating' );								
				?>		
						<div class="testimonials-slide <?php echo "elementor-repeater-item-".$tesimonials_data['_id']; ?> ">
							<p><?php echo $tesimonials_data['testimonials_content'] ?></p>
							<?php if($tesimonials_data['ht_testimonial_enable_avatar'] == 'yes'){
							?>
							<img style="width: 10%; border-radius:50%" src="<?php echo $tesimonials_data['testimonial_image']['url'] ?>" alt="">
							<?php	
							} ?>
							<p class="testimonial-avater"><?php echo $tesimonials_data['testimonials_title'] ?></p> 
							<div class="rating-box">
								<?php if($tesimonials_data['ht_testimonial_enable_rating'] == 'yes'){
								?>
									<div class="testimonial-info">			
										<span <?php echo $rating; ?>>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
									</div>								
								<?php
								} 
								?>

							</div>								
						</div>
				<?php			
					}
				?>

			</div>
		<?php	
		}if($settings['testimonials_style'] == 'style-2'){
		?>
			<div <?php echo $data_style; ?>>

				<?php 
					foreach ($settings['testimonials_list'] as $tesimonials_data){
						$this->add_render_attribute(
							'data-rating',
							[
								'class' => [ 'rating', 'point-'.$tesimonials_data['ht_rating'] ]
							]
						);
						$rating = $this->get_render_attribute_string( 'data-rating' );							
				?>		
					<blockquote class="block <?php echo "elementor-repeater-item-".$tesimonials_data['_id']; ?> ">
						<p><?php echo $tesimonials_data['testimonials_content'] ?></p>
						<footer>
						<?php if($tesimonials_data['ht_testimonial_enable_avatar'] == 'yes'){
						?>							
							<img class="avater-img" style="width: 10%; border-radius:50%" src="<?php echo $tesimonials_data['testimonial_image']['url'] ?>" alt="">
						<?php
						}
						?>	
							<cite><span><?php echo $tesimonials_data['testimonials_title'] ?></span></cite>
							<div class="rating-box">
									<div class="testimonial-info">			
										<span <?php echo $rating; ?>>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
									</div>
							</div>							
						</footer>
					</blockquote>
				<?php			
					}
				?>
			</div>
		<?php	
		}if($settings['testimonials_style'] == 'style-3'){
		?>

			<div <?php echo $data_style; ?>>
				<?php 
					foreach ($settings['testimonials_list'] as $tesimonials_data){
						$this->add_render_attribute(
							'data-rating',
							[
								'class' => [ 'rating', 'point-'.$tesimonials_data['ht_rating'] ]
							]
						);
						$rating = $this->get_render_attribute_string( 'data-rating' );						
				?>		
						<div class="testimonials-slide <?php echo "elementor-repeater-item-".$tesimonials_data['_id']; ?> ">
							<p><?php echo $tesimonials_data['testimonials_content'] ?></p>
							<?php if($tesimonials_data['ht_testimonial_enable_avatar'] == 'yes'){
							?>
							<img style="width: 10%; border-radius:50%" src="<?php echo $tesimonials_data['testimonial_image']['url'] ?>" alt="">
							<?php	
							} ?>
							<div class="rating-box">
									<div class="testimonial-info">			
										<h3><?php echo $tesimonials_data['testimonials_title'] ?></h3>
										<span <?php echo $rating; ?>>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
									</div>
							</div>							
						</div>
				<?php			
					}
				?>

			</div>

		<?php	
		}
		if($settings['testimonials_style'] == 'style-4'){
		?>
			<div <?php echo $data_style; ?>>
				<?php 
					foreach ($settings['testimonials_list'] as $tesimonials_data){							
				?>		
					<div>
						<figure class="testimonial">
							<blockquote class="<?php echo "elementor-repeater-item-".$tesimonials_data['_id']; ?>">
							<?php echo $tesimonials_data['testimonials_content'] ?>
							<div class="arrow"></div>
							</blockquote>
							<img  src="<?php echo $tesimonials_data['testimonial_image']['url'] ?>" alt="<?php echo $tesimonials_data['testimonials_title'] ?>">
							<div class="author">
							<h5><?php echo $tesimonials_data['testimonials_title'] ?></h5>
							</div>
						</figure>
					</div>
					
				<?php			
					}
				?>

			</div>
		<?php	
		}if($settings['testimonials_style'] == 'style-5'){

		?>
			<div <?php echo $data_style; ?>>
                <section class="ht-animate-section section">
				<?php
					$countarray = count($settings['ht_animate_list']);
				?>						
		    		<div class="animated-testimonitals" data-id="<?php echo $countarray; ?>">
		    			<div class="container">
		    				<div class="row">
		    					<div class="col-md-3 col-sm-3">
		    						<div class="container-pe-quote">
										<?php 
											$count = 1;
											foreach ($settings['ht_animate_list'] as $tesimonials_data){
											if ($tesimonials_data['show_right'] == null){
												?>
													<div class="pp-quote li-quote-<?php echo $count; ?>" data-id="<?php echo $count; ?>">
														<img  src="<?php echo $tesimonials_data['animate_testimonials_image']['url'] ?>" alt="<?php echo $tesimonials_data['animate_testimonials_title'] ?>">	
													</div>	
												<?php
												}
											$count++;	
											}
										 ?>		    					
		    						</div>

		    					</div>
		    					<div class="col-md-6 col-sm-6">
		    						<div class="sec-eight-text-area">
		    							<div class="container-dp-name">
										<?php 
											$count = 1;
											foreach ($settings['ht_animate_list'] as $tesimonials_data){
											?>
											<div class="box-dpname dp-name-<?php echo $count; ?> hide-dp-top <?php if($count == 1){ echo "look"; } ?>">
		    									<img  src="<?php echo $tesimonials_data['animate_testimonials_image']['url'] ?>" alt="<?php echo $tesimonials_data['animate_testimonials_title'] ?>">	
												<h1><?php echo $tesimonials_data['animate_testimonials_title'] ?></h1>
												<?php echo $tesimonials_data['animate_testimonials_content'] ?>
											</div>	
																					
											<?php
											$count++;	
											}
										  
										 ?>	

		    							</div>

		    						</div>  				
		    					</div>
		    					<div class="col-md-3 col-sm-3">	
		    						<div class="container-pe-quote right">
										<?php 
											$count = 1;
											foreach ($settings['ht_animate_list'] as $tesimonials_data){
												if ($tesimonials_data['show_right'] == 'yes'){
											?>
												<div class="pp-quote li-quote-<?php echo $count; ?>" data-id="<?php echo $count; ?>">
													<img  src="<?php echo $tesimonials_data['animate_testimonials_image']['url'] ?>" alt="<?php echo $tesimonials_data['animate_testimonials_title'] ?>">	
												</div>	
											<?php
												}
											$count++;	
											}
										 ?>	

		    							
		    						</div>

		    					</div>
		    				</div>
		    			</div>		    			
		    		</div>
				</section>		
			</div>	
		<?php	
		}if ($settings['testimonials_style'] == 'style-6'){
		?>
			<div <?php echo $data_style; ?>>

				<?php 
					foreach ($settings['ht_border_animate_list'] as $tesimonials_data){
					 echo '	<div class="ht-border-animate-items">
					 			<div class="ht-border-image">
								 <img src="'. $tesimonials_data['border_animate_testimonials_image']['url'] .'" alt="'. $tesimonials_data['border_animate_testimonials_title'] .'">
					 		</div>
							<div class="ht-border-title">
								<h3>'. $tesimonials_data['border_animate_testimonials_title'].'</h3>
							</div>				
							<div class="ht-border-content">
								<p>'. $tesimonials_data['border_animate_testimonials_content'] .'</p>
							</div>
				 		</div>';
					}
				?>	



			

			</div>	

		<?php
		}

		?>

		
    <?php
	}

	protected function _content_template() {
	}
}
