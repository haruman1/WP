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
 * WooCommerce Product UpSell
 * @see https://docs.woocommerce.com/document/related-products-up-sells-and-cross-sells/
 * @author quomodosoft.com
 */
class UpSell extends \Shop_Ready\extension\elewidgets\Widget_Base {
  	
    /**
	* Html Wrapper Class of html 
	*/
	public $wrapper_class = true;

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
				'layouts_upsell_content_section',
				[
					'label' => esc_html__( 'Layout', 'shopready-elementor-addon' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
	
				$this->add_control(
					'style',
					[
						'label'   => esc_html__( 'Layout', 'shopready-elementor-addon' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'default',
						'options' => [
							'default'     => esc_html__('Default','shopready-elementor-addon'),
							'style1'   => esc_html__('Style 1','shopready-elementor-addon'),
					
						]
					]
				);
	
	
		$this->end_controls_section();

        $this->start_controls_section(
			'section_upsell_products_content',
			[
				'label' => __( 'UpSell Products', 'shopready-elementor-addon' ),
			]
		);

			$this->add_responsive_control(
				'columns',
				[
					'label' => __( 'Columns', 'shopready-elementor-addon' ),
					'type' => Controls_Manager::NUMBER,
					'prefix_class' => 'woo-ready-products-columns%s-',
					'default' => 4,
					'min' => 1,
					'max' => 12,
					'condition' => [
						'style' => ['default','style1']
					]
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' => __( 'Order By', 'shopready-elementor-addon' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'date',
					'options' => [
						'date' => __( 'Date', 'shopready-elementor-addon' ),
						'title' => __( 'Title', 'shopready-elementor-addon' ),
						'price' => __( 'Price', 'shopready-elementor-addon' ),
						'popularity' => __( 'Popularity', 'shopready-elementor-addon' ),
						'rating' => __( 'Rating', 'shopready-elementor-addon' ),
						'rand' => __( 'Random', 'shopready-elementor-addon' ),
						'menu_order' => __( 'Menu Order', 'shopready-elementor-addon' ),
					],
					'condition' => [
						'style' => ['default','style1']
					]
				]
			);

			$this->add_control(
				'order',
				[
					'label' => __( 'Order', 'shopready-elementor-addon' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'desc',
					'options' => [
						'asc' => __( 'ASC', 'shopready-elementor-addon' ),
						'desc' => __( 'DESC', 'shopready-elementor-addon' ),
					],
					'condition' => [
						'style' => ['default','style1']
					]
				]
			);

		$this->end_controls_section();
	
	
		/**
		 * Layouts Total Table
		 */
		$this->box_layout(
			[
				'title'          => esc_html__('Container Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc__product_meta',
				'element_name'   => '__wrapper',
				'selector'       => '{{WRAPPER}} .woo-ready-products',
				
			]
		);
	
	
		/* Layouts End */

	
		$this->text_minimum_css(
			[
				'title'          => esc_html__('Heading','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_heading',
				'element_name'   => 'wrating_product_heading',
				'selector'       => '{{WRAPPER}} .up-sells h2',
				'hover_selector' => false,
			]
		);
		
		$this->box_minimum_css(
			[
				'title'          => esc_html__('Item Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_wrapper',
				'element_name'   => 'wr_product_',
				'selector'       => '{{WRAPPER}} .woo-ready-products',
				'hover_selector' => false
				
			]
		);
		
		$this->box_css(
			[
				'title'          => esc_html__('Single Item','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_single',
				'element_name'   => '_product_single',
				'selector'       => '{{WRAPPER}} .woo-ready-products .product',
				'hover_selector' => false
				
			]
		);
		
		$this->box_minimum_css(
			[
				'title'          => esc_html__('Thumb Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_thymb',
				'element_name'   => '_product_singthuymb',
				'selector'       => '{{WRAPPER}} .woo-ready-products .product .wooready_product_thumb',
				'hover_selector' => false
				
			]
		);
		
		
		$this->position_css(
			[
				'title'          => esc_html__('Overlay Position','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_overlay',
				'element_name'   => '_product_overlayb',
				'selector'       => '{{WRAPPER}} .woo-ready-products .product .wooready_product_thumb .wooready_product_thumb_overlay',
				'hover_selector' => false
				
			]
		);
		
		$this->text_css(
			[
				'title'          => esc_html__('Sale bedge','shopready-elementor-addon'),
				'slug'           => 'product_bedge',
				'element_name'   => '_product_bedge',
				'selector'       => '{{WRAPPER}} .woo-ready-products .product .wooready_product_thumb .wooready_sell_discount',
				'hover_selector' => '{{WRAPPER}} .woo-ready-products .product .wooready_product_thumb .wooready_sell_discount:hover'
				
			]
		);

		$this->box_css(
			[
				'title'          => esc_html__('Title Wrapper','shopready-elementor-addon'),
				'slug'           => 'product_title_wrapper',
				'element_name'   => '_product_title_wr',
				'selector'       => '{{WRAPPER}} .woo-ready-products .product .wooready_title',
				'hover_selector' => false
				
			]
		);
		
		$this->text_minimum_css(
			[
				'title'          => esc_html__('Title','shopready-elementor-addon'),
				'slug'           => 'product_title',
				'element_name'   => '_product_title',
				'selector'       => '{{WRAPPER}} .woo-ready-products .product .wooready_title a',
				'hover_selector' => '{{WRAPPER}} .woo-ready-products .product .wooready_title:hover a'
				
			]
		);

		$this->box_css(
			[
				'title'          => esc_html__('Review Wrapper','shopready-elementor-addon'),
				'slug'           => 'product_review_wrapper',
				'element_name'   => '_product_review_wr',
				'selector'       => '{{WRAPPER}} .woo-ready-products .product .wooready_review',
				'hover_selector' => false
				
			]
		);

		$this->text_minimum_css(
			[
				'title'          => esc_html__('Review inactive','shopready-elementor-addon'),
				'slug'           => 'product_review_inactive',
				'element_name'   => '_product_review_ainvr',
				'selector'       => '{{WRAPPER}} .woo-ready-products .product .wooready_review ul li .wrinactive',
				'hover_selector' => false
				
			]
		);
		$this->text_minimum_css(
			[
				'title'          => esc_html__('Review active','shopready-elementor-addon'),
				'slug'           => 'product_review_active',
				'element_name'   => '_product_review_actr',
				'selector'       => '{{WRAPPER}} .woo-ready-products .product .wooready_review ul li i',
				'hover_selector' => false
				
			]
		);

		$this->text_minimum_css(
			[
				'title'          => esc_html__('Count Text','shopready-elementor-addon'),
				'slug'           => 'wready_wc_rating_icount',
				'element_name'   => 'wreatag_product_star_count',
				'selector'       => '{{WRAPPER}} .woo-ready-products .product .wooready_review ul span',
				'hover_selector' => false,
				
			]
		);
		
		$this->box_css(
			[
				'title'          => esc_html__('Price Wrapper','shopready-elementor-addon'),
				'slug'           => 'product_price_wrapper',
				'element_name'   => '_product_price',
				'selector'       => '{{WRAPPER}} .woo-ready-products .product .wooready_price_box',
				'hover_selector' => false
				
			]
		);

		$this->text_minimum_css(
			[
				'title'          => esc_html__('Price','shopready-elementor-addon'),
				'slug'           => 'product_price_active',
				'element_name'   => '_product_price_actr',
				'selector'       => '{{WRAPPER}} .woo-ready-products .product .wooready_price_box bdi',
				'hover_selector' => false
				
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

	    wp_enqueue_style('woocommerce-general');

	    $this->add_render_attribute(
			'wrapper_style',
			[
				'class' => [ 'woo-ready-upsell-product-layout', $settings['style'] ],
			]
		);

        echo sprintf("<div %s>",$this->get_render_attribute_string( 'wrapper_style' ));

			if(file_exists(dirname(__FILE__). '/template-parts/upsell/'.$settings['style'].'.php')){

				shop_ready_widget_template_part(
					'product/template-parts/upsell/'.$settings['style'].'.php',
					array(
						'settings'              => $settings,
					)
				);

			}else{

                shop_ready_widget_template_part(
					'product/template-parts/upsell/default.php',
					array(
						'settings'              => $settings,
					)
				);

			}
			
		echo '</div>';
	}

}