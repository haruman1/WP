<?php

namespace Shop_Ready\extension\elewidgets\widgets\product;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;

/**
 * WooCommerce Product Rating | Review
 * @see https://docs.woocommerce.com/document/managing-products/
 * @author quomodosoft.com
 */
class Rating extends \Shop_Ready\extension\elewidgets\Widget_Base {
    
	
    /**
	 * Html Wrapper Class of html 
	 */
	public $wrapper_class = false;

	protected function register_controls() {

			  // Notice 
			$this->start_controls_section(
			'notice_content_section',
				[
					'label' => esc_html__( 'Notice', 'shopready-elementor-addon' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
	
				$this->add_control(
					'woo_ready_usage_direction_notice',
					[
						'label'           => esc_html__( 'Important Note', 'shopready-elementor-addon' ),
						'type'            => \Elementor\Controls_Manager::RAW_HTML,
						'raw'             => esc_html__( 'Use This Widget in WooCommerce Product Details page  Template.', 'shopready-elementor-addon' ),
						'content_classes' => 'woo-ready-product-page-notice',
					]
				);
	
			$this->end_controls_section(); 
			
			$this->start_controls_section(
				'editor_content_section',
				[
					'label' => esc_html__( 'Editor Refresh', 'shopready-elementor-addon' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'show_product_content',
					[
						'label'        => esc_html__( 'Content Refresh?', 'shopready-elementor-addon' ),
						'type'         => \Elementor\Controls_Manager::SWITCHER,
						'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
						'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
						'return_value' => 'yes',
						'default'      => '',
					]
				);

				$this->add_control(
					'wready_product_id',
					[
						'label'   => esc_html__( 'Demo Product', 'shopready-elementor-addon' ),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'multiple' => false,
						'default' => shop_ready_get_single_product_key(),
						'options' =>  shop_ready_get_latest_products_id(10)
					]
				);
 
			$this->end_controls_section();

			$this->start_controls_section(
				'layouts_cart_content_section',
				[
					'label' => esc_html__( 'Layout', 'shopready-elementor-addon' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
	
				$this->add_control(
					'style',
					[
						'label'   => esc_html__( 'Style', 'shopready-elementor-addon' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'rating',
						'options' => [
							'rating'     => esc_html__('Default','shopready-elementor-addon'),
							 //'review-rating'   => esc_html__('Review Rating','shopready-elementor-addon'),
					
						]
					]
				);
	
	
			$this->end_controls_section();

		
		$this->start_controls_section(
			'content_rating_section',
			[
				'label' => esc_html__( 'Settings', 'shopready-elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'review_form_section',
			[
				'label'       => esc_html__( 'Review Form Id', 'shopready-elementor-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default' => 'review',
				'placeholder' => esc_html__( 'review', 'shopready-elementor-addon' ),
				
			]
		);


	
		$this->end_controls_section();

	
		/**
		 * Layouts Total Table
		 */
		$this->box_layout(
			[
				'title'          => esc_html__('Container Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc__product_rating_wrapper',
				'element_name'   => '__wrapper',
				'selector'       => '{{WRAPPER}} .woocommerce-product-rating',
				
			]
		);
		$this->box_layout(
			[
				'title'          => esc_html__('Rating Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc_default_product_rating_wrapper',
				'element_name'   => 'star_wrapper',
				'selector'       => '{{WRAPPER}} .woocommerce-product-rating .star-rating',
				
			]
		);

		$this->box_layout(
			[
				'title'          => esc_html__('Review Count ','shopready-elementor-addon'),
				'slug'           => 'wready_wc_default_product_rating_cout',
				'element_name'   => 'count_wrapper',
				'selector'       => '{{WRAPPER}} .woocommerce-product-rating .woocommerce-review-link',
				
			]
		);
	
		/* Layouts End */

		$this->text_minimum_css(
			[
				'title'          => esc_html__('Inactive Rating','shopready-elementor-addon'),
				'slug'           => 'wready_wc_rating_s',
				'element_name'   => 'wrating_product_star',
				'selector'       => '{{WRAPPER}} .woocommerce .star-rating::before',
				'hover_selector' => false,
				
			]
		);

		$this->text_css(
			[
				'title'          => esc_html__('Active Rating','shopready-elementor-addon'),
				'slug'           => 'wready_wc_rating_inactives',
				'element_name'   => 'wrag_product_star',
				'selector'       => '{{WRAPPER}} .woocommerce-product-rating .star-rating',
				'hover_selector' => false,
				
			]
		);
		
		$this->text_minimum_css(
			[
				'title'          => esc_html__('Count Text','shopready-elementor-addon'),
				'slug'           => 'wready_wc_rating_icount',
				'element_name'   => 'wreatag_product_star_count',
				'selector'       => '{{WRAPPER}} .woocommerce-review-link',
				'hover_selector' => false,
				
			]
		);
	}

    /**
	 * Override By elementor render method
	 * @return void
	 * 
	 */
	protected function html() {

		$settings = $this->get_settings_for_display();
	
	    $this->add_render_attribute(
			'wrapper_style',
			[
				'class' => [ 'woo-ready-product-rating-layout', $settings['style'] ],
			]
		);

        echo sprintf("<div %s>",$this->get_render_attribute_string( 'wrapper_style' ));

			if(file_exists(dirname(__FILE__). '/template-parts/rating/'.$settings['style'].'.php')){
				
				shop_ready_widget_template_part(
					'product/template-parts/rating/'.$settings['style'].'.php',
					array(
						'settings' => $settings,
					)
				);

			}else{

                shop_ready_widget_template_part(
					'product/template-parts/rating/rating.php',
					array(
						'settings'              => $settings,
					)
				);

			}
			
		echo '</div>';
	}

}