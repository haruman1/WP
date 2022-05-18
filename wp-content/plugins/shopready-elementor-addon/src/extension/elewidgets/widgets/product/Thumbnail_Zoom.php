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

use Elementor\Utils;
/**
 * WooCommerce Product Zoom Image
 * @see https://docs.woocommerce.com/document/managing-products/
 * @author quomodosoft.com
 */
class Thumbnail_Zoom extends \Shop_Ready\extension\elewidgets\Widget_Base {
    
	
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
				'layouts_product_data_tabs_section',
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
						'default' => 'product-image',
						'options' => [
							'product-image'     => esc_html__('Default','shopready-elementor-addon'),
							'flex-slider'   => esc_html__('Flex Slider','shopready-elementor-addon'),
							'flex-vslider'   => esc_html__('Vertical Slider','shopready-elementor-addon'),
							'flex-vslider-right'   => esc_html__('Right Vertical Slider','shopready-elementor-addon'),
					
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
			'show_gallery',
			[
				'label'        => __( 'Gallery?', 'shopready-elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'shopready-elementor-addon' ),
				'label_off'    => __( 'Hide', 'shopready-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				
			]
		);
		
		
		$this->end_controls_section();

	
		/**
		 * Layouts
		 */
		$this->box_layout(
			[
				'title'          => esc_html__('Container Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc__product_meta',
				'element_name'   => '__wrapper',
				'selector'       => '{{WRAPPER}} .product_meta',
				
			]
		);
		$this->box_layout(
			[
				'title'          => esc_html__('Sku Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc_default_product_meta_sku',
				'element_name'   => 'star_wrapper',
				'selector'       => '{{WRAPPER}} .sku_wrapper',
				
			]
		);

		/* Layouts End */

		$this->text_minimum_css(
			[
				'title'          => esc_html__('Sku Label','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_sku_label',
				'element_name'   => 'wrating_product_slu',
				'selector'       => '{{WRAPPER}} .sku_wrapper ,{{WRAPPER}} .sku_wrapper :not(span)',
				'hover_selector' => false,
				
			]
		);

		$this->box_css(
			[
				'title'          => esc_html__('Thumbnail Box','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_thumbnail_box',
				'element_name'   => 'wrating_product_thumbnail_boxx',
				'selector'       => '{{WRAPPER}} .woo-ready-product-zimage-layout .wooready_product_details_thumb',
				'hover_selector' => false,
				
			]
		);

		$this->box_css(
			[
				'title'          => esc_html__('Thumbnail Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_thumbnail_wrapper',
				'element_name'   => 'wrating_product_thumbnail_wrapperr',
				'selector'       => '{{WRAPPER}} .woo-ready-product-zimage-layout .wooready_product_details_thumb .wooready_product_details_thumb_wrapper',
				'hover_selector' => false,
				
			]
		);
		$this->element_size(
			[
				'title'          => esc_html__('Thumbnail Size','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_thumbnail_sizer',
				'element_name'   => 'wrating_product_thumbnail_size',
				'selector'       => '{{WRAPPER}} .shop-ready-product-thumb',
				'hover_selector' => false,
				
			]
		);

		$this->element_size(
			[
				'title'          => esc_html__('Slider Thumb Size','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_thumbnail_slider_sizer',
				'element_name'   => 'wrating_product_thumbnail_slider_size',
				'selector'       => '{{WRAPPER}} .shop-ready-product-thumb-gly',
				'hover_selector' => false,
				
			]
		);

	}

	public function get_tab_option(){
   		return get_option('wready_product_tab_data_keys');
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
				'class' => [ 'woo-ready-product-zimage-layout', $settings[ 'style' ] ],
			]
		);

        echo sprintf( "<div %s>", $this->get_render_attribute_string( 'wrapper_style' ) );

			if( file_exists(dirname(__FILE__). '/template-parts/image/'.$settings['style'].'.php' ) ){
				
				shop_ready_widget_template_part(
					'product/template-parts/image/'.$settings['style'].'.php',
					array(
						'settings'              => $settings,
					)
				);

			}else{

                shop_ready_widget_template_part(
					'product/template-parts/image/product-image.php',
					array(
						'settings'              => $settings,
					)
				);

			}
			
		echo '</div>';
	}

}