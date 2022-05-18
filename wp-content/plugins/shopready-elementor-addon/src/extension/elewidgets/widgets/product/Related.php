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
 * WooCommerce Product Related
 * @see https://docs.woocommerce.com/document/related-products-up-sells-and-cross-sells/
 * @author quomodosoft.com
 */
class Related extends \Shop_Ready\extension\elewidgets\Widget_Base {
    
	
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
						'label'   => esc_html__( 'Layout', 'shopready-elementor-addon' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'default',
						'options' => [
							'default'     => esc_html__('Default','shopready-elementor-addon'),
							//'wready-rating-two'   => esc_html__('Style 2','shopready-elementor-addon'),
					
						]
					]
				);
	
	
		$this->end_controls_section();

        $this->start_controls_section(
			'section_related_products_content',
			[
				'label' => __( 'Related Products', 'shopready-elementor-addon' ),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Products Per Page', 'shopready-elementor-addon' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 4,
				'range' => [
					'px' => [
						'max' => 20,
					],
				],
			]
		);

		$this->add_responsive_control(
            'product_grid_column_items',
            [
                'label'      => esc_html__( 'Grid Items', 'shopready-elementor-addon' ),
                'type'       => Controls_Manager::SLIDER,
                
                'size_units' => ['px'],
                'range'      => [

                    'px' => [
                        'min'  => 0,
                        'max'  => 130,
                        'step' => 2,
                    ],

                ],
                'default' => [
					'unit' => 'px',
					'size' => 3,
				],

                'selectors'  => [
                    '{{WRAPPER}} .woo-ready-related-product-layout .woo-ready-products' => 'grid-template-columns: repeat( {{SIZE}}, 1fr);;',
                ],
            ]
        );

		$this->add_responsive_control(
            'product_grid_column_items_gap',
            [
                'label'      => esc_html__( 'Column gap', 'shopready-elementor-addon' ),
                'type'       => Controls_Manager::SLIDER,
                
                'size_units' => ['px'],
                'range'      => [

                    'px' => [
                        'min'  => 0,
                        'max'  => 130,
                        'step' => 2,
                    ],

                ],
                'default' => [
					'unit' => 'px',
					'size' => 3,
				],

                'selectors'  => [
                    '{{WRAPPER}} .woo-ready-products' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'product_grid_row_items_gap',
            [
                'label'      => esc_html__( 'Row gap', 'shopready-elementor-addon' ),
                'type'       => Controls_Manager::SLIDER,
               
                'size_units' => ['px'],
                'range'      => [

                    'px' => [
                        'min'  => 0,
                        'max'  => 130,
                        'step' => 2,
                    ],

                ],
                'default' => [
					'unit' => 'px',
					'size' => 20,
				],

                'selectors'  => [
                    '{{WRAPPER}} .woo-ready-products' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'main_section_related_grid_col',
            [
                'label'      => esc_html__( 'Columns', 'shopready-elementor-addon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [

                    'px' => [
                        'min'  => 1,
                        'max'  => 13,
                        'step' => 1,
                    ],

                ],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],

                'selectors'  => [
                    '{{WRAPPER}} .woo-ready-products' => 'grid-template-columns: repeat( {{SIZE}}, 1fr);',

                ],
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
				'selector'       => '{{WRAPPER}} .product_meta',
				
			]
		);
	
	
		/* Layouts End */

	
		$this->box_css(
			[
				'title'          => esc_html__('Box Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_box_wrapper',
				'element_name'   => 'wrating_product_box_wrapper',
				'selector'       => '{{WRAPPER}} .woo-ready-related-product-layout .woo-ready-products',
				'hover_selector' => false,
				
			]
		);
	
		$this->box_css(
			[
				'title'          => esc_html__('Box Item','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_box_item',
				'element_name'   => 'wrating_product_box_item',
				'selector'       => '{{WRAPPER}} .wooready_product_layout_eforest',
				'hover_selector' => false,
				
			]
		);
		$this->text_css(
			[
				'title'          => esc_html__('Box Top Heading','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_top_heading',
				'element_name'   => 'wrating_product_top_heading',
				'selector'       => '{{WRAPPER}} .woo-ready-related-product-layout.default .related>h2',
				'hover_selector' => '{{WRAPPER}} .woo-ready-related-product-layout.default .related>h2:hover',
				
			]
		);


		$this->text_css(
			[
				'title'          => esc_html__('Tags','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_tag',
				'element_name'   => 'wrating_product_tag',
				'selector'       => '{{WRAPPER}} .tagged_as a',
				'hover_selector' => '{{WRAPPER}} .tagged_as a:hover',
				
			]
		);	
		$this->text_css(
			[
				'title'          => esc_html__('Product Title','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_title',
				'element_name'   => 'wrating_product_title',
				'selector'       => '{{WRAPPER}} .wooready_product_layout_eforest .wooready_product_content_box .wooready_title a',
				'hover_selector' => '{{WRAPPER}} .wooready_product_layout_eforest .wooready_product_content_box .wooready_title a:hover',
				
			]
		);
		$this->text_css(
			[
				'title'          => esc_html__('Product Price Box','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_price_box',
				'element_name'   => 'wrating_product_price_box',
				'selector'       => '{{WRAPPER}} .wooready_product_layout_eforest .wooready_product_content_box .wooready_price_box',
				'hover_selector' => false,
				
			]
		);
		$this->text_css(
			[
				'title'          => esc_html__('Normal Price','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_price_normal',
				'element_name'   => 'wrating_product_price_normall',
				'selector'       => '{{WRAPPER}} .wooready_product_content_box .wooready_price_box .wooready_price_normal',
				'hover_selector' => false,
				
			]
		);
		$this->text_css(
			[
				'title'          => esc_html__('Discount Price','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_price_discount',
				'element_name'   => 'wrating_product_price_discountt',
				'selector'       => '{{WRAPPER}} .wooready_product_content_box .wooready_price_box .wooready_price_discount',
				'hover_selector' => false,
				
			]
		);

		$this->box_css(
			[
				'title'          => esc_html__('Product Color','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_color',
				'element_name'   => 'wrating_product_colorr',
				'selector'       => '{{WRAPPER}} .wready-product-loop-color-wrapper.variable label',
				'hover_selector' => false,
				
			]
		);

		$this->text_css(
			[
				'title'          => esc_html__('Product Sold By','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_sold_by',
				'element_name'   => 'wrating_product_sold_byy',
				'selector'       => '{{WRAPPER}} .wooready_product_content_box .sr-ef-sold-by',
				'hover_selector' => '{{WRAPPER}} .wooready_product_content_box .sr-ef-sold-by:hover',
				
			]
		);

		$this->text_css(
			[
				'title'          => esc_html__('Product Cart','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_sold_by_cart',
				'element_name'   => 'wrating_product_sold_byy_cartt',
				'selector'       => '{{WRAPPER}} .wooready_product_layout_eforest .wooready_product_content_box .add_to_cart_button',
				'hover_selector' => '{{WRAPPER}} .wooready_product_layout_eforest .wooready_product_content_box .add_to_cart_button:hover',
				
			]
		);

		$this->box_css(
			[
				'title'          => esc_html__('Product Sold Box','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_sold_box',
				'element_name'   => 'wrating_product_sold_byy_Box',
				'selector'       => '{{WRAPPER}} .wooready_product_layout_eforest .wooready_product_content_box .wooready_product_sold_range',
				'hover_selector' => false,
				
			]
		);

		$this->box_css(
			[
				'title'          => esc_html__('Rating Box','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_rating_box',
				'element_name'   => 'wrating_product_rating_Boxx',
				'selector'       => '{{WRAPPER}} .wooready_product_layout_eforest .wooready_product_content_box .sr-review-rating',
				'hover_selector' => false,
				
			]
		);

		$this->text_css(
			[
				'title'          => esc_html__('Rating Text','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_rating_text',
				'element_name'   => 'wrating_product_rating_textt',
				'selector'       => '{{WRAPPER}} .wooready_product_layout_eforest .wooready_product_content_box .sr-review-rating .sr-review-number-count',
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
				'class' => [ 'woo-ready-related-product-layout', $settings['style'] ],
			]
		);

        echo sprintf("<div %s>",$this->get_render_attribute_string( 'wrapper_style' ));

			if( file_exists( dirname(__FILE__). '/template-parts/related/'.$settings['style'].'.php' ) ){

				shop_ready_widget_template_part(
					'product/template-parts/related/'.$settings['style'].'.php',
					array(
						'settings'              => $settings,
					
					)
				);

			}else{

                shop_ready_widget_template_part(
					'product/template-parts/related/default.php',
					array(
						'settings' => $settings,
					)
				);

			}
			
		echo '</div>';
	}

}