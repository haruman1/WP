<?php
namespace Element_Ready\Modules\Newslatter\base;

use Element_Ready\Base\Elementor_Helper;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
/**
 *  Template Library.
 *
 * @since 1.0
 */
class FrontEnd {
	
	public function register() {
		
		add_action( 'elements_ready_newslatter_popup' , [ $this , 'er_ready_newslatter_popup' ], 14 , 2 );
        add_action( 'wp_body_open', [ $this, 'popup_html_add' ] );
 		add_action( 'wp_enqueue_scripts', [ $this, 'push_data'],10 );

	}
 


    public function push_data(){
	   
	   wp_register_script( 'er-newslatter-popup', ELEMENT_READY_NEWSLATTER_MODULE_URL . 'assets/newslatter-popup.js', array('jquery','nifty'), ELEMENT_READY_VERSION, true );
	  
	   $page_ids     = Elementor_Helper::get_global_setting('element_ready_newslatter_page_ids');
	   $specific_page = Elementor_Helper::get_global_setting('element_ready_lite_newslatter_specific_page','no');
	   $page_array   = explode( ',' , $page_ids );

	   if($specific_page =='yes'){

			if( !empty( $page_array ) ){

				$page_id    = get_the_id();
				$front_id   = (int) get_option( 'page_on_front' );
				
				if( !in_array( $page_id , $page_array ) ){
					return;       
				}
				
			}

	   }
		
     
	   $auto_close     = Elementor_Helper::get_global_setting('element_ready_newslatter_templat_auto_close');
	   $autoclose_time = Elementor_Helper::get_global_setting('element_ready_newslatter_templat_autoclose_time');
	   $load_after_time = Elementor_Helper::get_global_setting('element_ready_newslatter_templat_load_after_time');

	   wp_enqueue_script( 'er-newslatter-popup' ); 
	   wp_enqueue_style( 'nifty' ); 
	
	   wp_localize_script( 'er-newslatter-popup', 'newslatter_service',
		 array( 
			 'active'          => true,
			 'auto_close'      => $auto_close,
			 'autoclose_time'  => $autoclose_time,
			 'load_after_time' => $load_after_time,
		 )
	   );

	  
	  
   }

   public function er_ready_newslatter_popup($element,$tab_id){

	 $element->start_controls_section(
	   'element_ready_newslatter_popup_settings',
	   [
		 
		 'label' => esc_html__( 'Newslatter', 'element-ready' ),
		 'tab' => $tab_id,
	   ]
	 ); 

	 $element->add_control(
		'element_ready_lite_newslatter_specific_page',
		[
			'label'        => __( 'Specific Page', 'element-ready' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'element-ready' ),
			'label_off'    => __( 'No', 'element-ready' ),
			'return_value' => 'yes',
			'default'      => '',
		  
		]
	  );

		 $element->add_control(
		   'element_ready_newslatter_page_ids',
		   [
			 'label'       => esc_html__( 'Allowed Page ids', 'element-ready' ),
			 'type'        => \Elementor\Controls_Manager::TEXT,
			 'default'     => '',
			 'placeholder' => esc_html__('1,2,3','element-ready'),
			 'desc' => esc_html__('Comma seperated','element-ready'),
		     'condition' => [
				'element_ready_lite_newslatter_specific_page' => ['yes'],
			  ]
		   ]
		 );
	   

		 $element->add_control(
		   'element_ready_newslatte_template_id',
		   [
			   'label' => __( 'PopUp Template Id', 'element-ready' ),
			   'type' => \Elementor\Controls_Manager::SELECT2,
			   'multiple' => false,
			   'options' => element_ready_get_elementor_templates_arr(),
			   'default' => [  ],
			   
		   ]
	   );

	   
   

	   $element->add_control(
		 'element_ready_newslatter_templat_load_after_time',
		 [
		   'label'       => __( 'Open In time (ms)', 'element-ready' ),
		   'type'        => \Elementor\Controls_Manager::TEXT,
		   'default'     => '8000',
		   'placeholder' => '8000',
		  
		 ]
	   );
	 

	   $element->add_control(
		 'element_ready_newslatter_template_close_button',
		 [
			 'label'        => __( 'Close?', 'element-ready' ),
			 'type'         => \Elementor\Controls_Manager::SWITCHER,
			 'label_on'     => __( 'Yes', 'element-ready' ),
			 'label_off'    => __( 'No', 'element-ready' ),
			 'return_value' => 'yes',
			 'default'      => 'yes',
		   
		 ]
	   );

	   $element->add_control(
		 'element_ready_newslatter_templat_auto_close',
		 [
			 'label'        => __( 'Auto Close?', 'element-ready' ),
			 'type'         => \Elementor\Controls_Manager::SWITCHER,
			 'label_on'     => __( 'Yes', 'element-ready' ),
			 'label_off'    => __( 'Hide', 'element-ready' ),
			 'return_value' => 'yes',
			 'default'      => 'yes',
		   
		 ]
	   );
	   



	   $element->add_control(
		 'element_ready_newslatter_templat_autoclose_time',
		 [
		   'label'       => __( 'Auto Close Time', 'element-ready' ),
		   'type'        => \Elementor\Controls_Manager::TEXT,
		   'default'     => '8000',
		   'placeholder' => '8000',
		   'condition' => [
			 'element_ready_newslatter_templat_auto_close' => ['yes'],
		   ]
		 ]
	   );

	   $element->add_control(
		 'element_ready_newslatter_template_close_icon',
		 [
			 'label'     => __( 'Close Icon', 'element-ready' ),
			 'type'      => \Elementor\Controls_Manager::ICONS,
			 'default' => [
				 'value' => 'fa fa-times',
				 'library' => 'solid',
			 ],
			
		 ]
	  ); 

	

	   $element->add_control(
		 'element_ready_newslatter_modal_animation',
		 [
			 'label' => __( 'Animation', 'element-ready' ),
			 'type' => \Elementor\Controls_Manager::SELECT,
			 'default' => 'slide-in-bottom',
			 'options' => [
				 'slide-in-bottom'             => __( 'Slide In Bottom', 'element-ready' ),
				 'fade-in-scale'               => __( 'Fade Scale', 'element-ready' ),
				 'slide-in-right'              => __( 'Slide Right', 'element-ready' ),
				 'newspaper'                   => __( 'Newspaper', 'element-ready' ),
				 'fall'                        => __( 'Fall', 'element-ready' ),
				 'slide-fall-in'               => __( 'SLide Fall In', 'element-ready' ),
				 'slide-in-top-stick'          => __( 'Slide In Top', 'element-ready' ),
				 'super-scaled'                => __( 'Super Scale', 'element-ready' ),
				 'just-me'                     => __( 'Just Me', 'element-ready' ),
				 'blur'                        => __( 'Blur', 'element-ready' ),
				 'slide-in-bottom-perspective' => __( 'Slide Bottom Perspective', 'element-ready' ),
				 'slide-in-right-prespective'  => __( 'Slide Right Perspective', 'element-ready' ),
				 'slip-in-top-perspective'     => __( 'Slip Perspective', 'element-ready' ),
				 'threed-flip-horizontal'      => __( '3D Flip Horizontal', 'element-ready' ),
				 'threed-flip-vertical'        => __( '3D Flip Vertical', 'element-ready' ),
				 'threed-sign'                 => __( '3d Sign', 'element-ready' ),
				 'threed-slit'                 => __( '3D Slit', 'element-ready' ),
				 'threed-rotate-bottom'        => __( '3D Rotate Bottom', 'element-ready' ),
				 'threed-rotate-in-left'       => __( '3D Rotate Left', 'element-ready' ),
			 ],
			
		 ]
	 );

	 $element->add_responsive_control(
		 'element_ready_newslatter_modal_width',
		 [
			 'label' => __( 'Width', 'element-ready' ),
			 'type' => Controls_Manager::SLIDER,
			 'size_units' => [ 'px', '%' ],
			 'range' => [
				 'px' => [
					 'min' => 0,
					 'max' => 2000,
					 'step' => 5,
				 ],
				 '%' => [
					 'min' => 0,
					 'max' => 100,
				 ],
			 ],
			 'default' => [
				 'unit' => '%',
				 'size' => 80,
			 ],
			 'selectors' => [
				 'body .element-ready-pro-newslatter-popup-modal' => 'width: {{SIZE}}{{UNIT}};',
			 ],
			
		 ]
	 );

	 $element->add_responsive_control(
		 'element_ready_newslatter_min_width',
		 [
			 'label' => __( 'Minimum Width', 'element-ready' ),
			 'type' => Controls_Manager::SLIDER,
			 'size_units' => [ 'px', '%' ],
			 'range' => [
				 'px' => [
					 'min' => 0,
					 'max' => 1000,
					 'step' => 5,
				 ],
				 '%' => [
					 'min' => 0,
					 'max' => 100,
				 ],
			 ],
			 'default' => [
				 'unit' => 'px',
				 'size' => 320,
			 ],
			 'selectors' => [
				 'body .element-ready-pro-newslatter-popup-modal' => 'min-width: {{SIZE}}{{UNIT}};',
			 ],
			
		 ]
	 );

	 $element->add_responsive_control(
		 'element_ready_newslatter_max_width',
		 [
			 'label' => __( 'Max Width', 'element-ready' ),
			 'type' => Controls_Manager::SLIDER,
			 'size_units' => [ 'px', '%' ],
			 'range' => [
				 'px' => [
					 'min' => 0,
					 'max' => 2000,
					 'step' => 5,
				 ],
				 '%' => [
					 'min' => 0,
					 'max' => 100,
				 ],
			 ],
			 'default' => [
				 'unit' => '%',
				 'size' => 80,
			 ],
			 'selectors' => [
				 'body .element-ready-pro-newslatter-popup-modal' => 'max-width: {{SIZE}}{{UNIT}};',
			 ],
		   
		 ]
	 );

	 $element->add_responsive_control(
		 'element_ready_newslatter_height',
		 [
			 'label' => __( 'Height', 'element-ready' ),
			 'type' => Controls_Manager::SLIDER,
			 'size_units' => [ 'px', '%' ],
			 'range' => [
				 'px' => [
					 'min' => 0,
					 'max' => 2000,
					 'step' => 5,
				 ],
				 '%' => [
					 'min' => 0,
					 'max' => 100,
				 ],
			 ],

			 'default' => [
				 'unit' => '%',
				 'size' => 80,
			 ],
			
			 'selectors' => [
				 'body .element-ready-pro-newslatter-popup-modal' => 'height: {{SIZE}}{{UNIT}};',
				
			 ],
			
		 ]
	 );

	 $element->add_responsive_control(
		 'element_ready_newslatter_min_height',
		 [
			 'label' => __( 'Minimum Height', 'element-ready' ),
			 'type' => Controls_Manager::SLIDER,
			 'size_units' => [ 'px', '%' ],
			 'range' => [
				 'px' => [
					 'min' => 0,
					 'max' => 2000,
					 'step' => 5,
				 ],
				 '%' => [
					 'min' => 0,
					 'max' => 100,
				 ],
			 ],
			 'default' => [
				 'unit' => '%',
				 'size' => 80,
			 ],
			 'selectors' => [
				 '{{WRAPPER}} .element-ready-pro-newslatter-popup-modal' => 'min-height: {{SIZE}}{{UNIT}};',
			 ],
		   
		 ]
	 );

	 $element->add_control(
		 'element_ready_newslatter_overflow_y',
		 [
			 'label' => __( 'Overflow Vertical', 'element-ready' ),
			 'type' => \Elementor\Controls_Manager::SELECT,
			 'default' => 'hidden',
			 'options' => [
				 'hidden'  => __( 'None', 'element-ready' ),
				 'scroll'  => __( 'Scroll', 'element-ready' ),
			 ],
			 'selectors' => [
				 'body .element-ready-pro-newslatter-popup-modal' => 'overflow-y: {{VALUE}};',
			 ],
			
		 ]
	 );

	

	$element->add_responsive_control(
		'element_ready_newslatter_z_index',
		[
			'label' => __( 'Z-index', 'element-ready' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => -500,
					'max' => 5000,
					'step' => 5,
				],
			
			],
			
			'selectors' => [
				'body .element-ready-pro-newslatter-popup-modal.nifty-modal' => 'z-index: {{SIZE}};',
			],
		   
		]
	);

	 $element->end_controls_section();

	 $element->start_controls_section(
		'element_ready_newslatter_popup_styels',
		[
		  
		  'label' => esc_html__( 'Newslatter Style', 'element-ready' ),
		  'tab' => $tab_id,
		]
	  ); 

		$element->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'element_ready_newslatter_ov_ybackground',
				'label' => __( 'Background', 'element-ready' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => 'body .element-ready-pro-newslatter-popup-modal .wready-md-content',
			]
		);

		$element->add_responsive_control(
			'element_ready_newslatter_overlay_int',
			[
				'label' => __( 'Overlay', 'element-ready' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				
				],
				
				'selectors' => [
					'body .wready-md-show~.wready-md-overlay' => 'opacity: {{SIZE}};',
				],
			
			]
		);

		$element->add_responsive_control(
			'element_ready_newslatter_modal_close__icon_left',
			[
				'label' => __( 'Close Left Position', 'element-ready' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 80,
				],
				'selectors' => [
					'body .element-ready-pro-newslatter-popup-modal .wready-md-close' => 'left: {{SIZE}}{{UNIT}};',
				],
			
			]
		);

		$element->add_responsive_control(
			'element_ready_newslatter_modal_close__icon_top_pos',
			[
				'label' => __( 'Close Top Position', 'element-ready' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 80,
				],
				'selectors' => [
					'body .element-ready-pro-newslatter-popup-modal .wready-md-close' => 'top: {{SIZE}}{{UNIT}};',
				],
			
			]
		);

			  
			   
		$element->add_control(
			'element_ready_newslatter_template_content_center',
			[
				'label'        => __( 'Content Center?', 'element-ready' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'element-ready' ),
				'label_off'    => __( 'No', 'element-ready' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				
			]
			);

	 $element->end_controls_section();
   }

   public function popup_html_add(){

	   $page_ids      = Elementor_Helper::get_global_setting('element_ready_newslatter_page_ids');
	   $specific_page = Elementor_Helper::get_global_setting('element_ready_lite_newslatter_specific_page','no');
	   $page_array    = explode(',',$page_ids);
	   
	   if( $specific_page == 'yes' ){

			if( !empty( $page_array ) ){

				$page_id = get_the_id();
				$front_id = (int) get_option( 'page_on_front' );
				
				if( !in_array( $page_id , $page_array ) ){
					return;       
				}
			
			}

	   }
	   

	   $animation_cls = Elementor_Helper::get_global_setting('element_ready_newslatter_modal_animation');
	   $close_icon    = Elementor_Helper::get_global_setting('element_ready_newslatter_template_close_icon');
	   $close_button  = Elementor_Helper::get_global_setting('element_ready_newslatter_template_close_button');
	   $template_id  = Elementor_Helper::get_global_setting('element_ready_newslatte_template_id');
	   $center  = Elementor_Helper::get_global_setting('element_ready_newslatter_template_content_center','yes');
	  
	  ?>

		 <div class="element-ready-pro-newslatter-popup-modal margin:20 nifty-modal <?php echo $center == 'yes' ? 'nifty-content-center-active': ''; ?> <?php echo esc_attr($animation_cls); ?>" id="element-ready-pro-sr-newslatter-popup-modal">
			   <div class="element-ready-pro-newslatter-popup-modal-content wready-md-content">
				   
				   <div class='wready-md-body'>
					 <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($template_id); ?>
				   </div>
				   <?php if($close_button == 'yes'): ?>
					   <div class="wready-md-close"> 

						 <?php echo element_ready_render_icons( $close_icon , 'element-ready-icons' ); ?>
					   
					   </div>
				   <?php endif; ?>
			   </div>
		 </div>
		 <div class="wready-md-overlay"></div>
	  
	  <?php
		
   }


}




