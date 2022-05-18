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
use Shop_Ready\base\elementor\style_controls\common\Widget_Form;
/**
 * WooCommerce Product Add To cart
 * @see https://docs.woocommerce.com/document/managing-products/
 * @author quomodosoft.com
 */
class Add_To_Cart extends \Shop_Ready\extension\elewidgets\Widget_Base {
    use Widget_Form;
	
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
				'layouts_product_add_to_cart_section',
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
			'content_product_add_to_cart_section',
			[
				'label' => esc_html__( 'Simple Product Type', 'shopready-elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
			]
		);

            $this->add_control(
                'show_stock',
                [
                    'label'        => __( 'Stock?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'shopready-elementor-addon' ),
                    'label_off'    => __( 'Hide', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    
                ]
            );

            $this->add_control(
                'add_to_cart_input',
                [
                    'label' => __( 'Product Cart Count', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        'block'  => __( 'Show', 'shopready-elementor-addon' ),
                        'none' => __( 'Hide', 'shopready-elementor-addon' ),
                    ],
                   
                    'selectors' => [
                        '{{WRAPPER}} .product-quantity' => 'display: {{VALUE}}',
                        '{{WRAPPER}} .wooready_product_quantity' => 'display: {{VALUE}}',
                    ],
                ]
            );

			$this->add_control(
				'simple_qty_label',
				[
					'label' => __( 'Show Qty Label', 'shopready-elementor-addon' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'shopready-elementor-addon' ),
					'label_off' => __( 'Hide', 'shopready-elementor-addon' ),
					'return_value' => 'yes',
					'default' => '',
				]
			);
	
			$this->add_control(
				'simple_qty_label_text',
				[
					'label' => __( 'Quantity', 'shopready-elementor-addon' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Quantity', 'shopready-elementor-addon' ),
					'placeholder' => __( 'Type your Quantity label', 'shopready-elementor-addon' ),
				]
			);

		
    
	
		$this->end_controls_section();
        $this->start_controls_section(
			'content_product_variabe_pro_section',
			[
				'label' => esc_html__( 'Variable Product Type', 'shopready-elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
			]
		);

        $this->add_control(
            'variable_stock_input',
            [
                'label' => __( 'Stock', 'shopready-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    'block'  => __( 'Show', 'shopready-elementor-addon' ),
                    'none'   => __( 'Hide', 'shopready-elementor-addon' ),
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-variation-availability' => 'display: {{VALUE}}',
                ],
            ]
        );
		
	
		$this->add_control(
			'variable_qty_label',
			[
				'label' => __( 'Show Qty Label', 'shopready-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'shopready-elementor-addon' ),
				'label_off' => __( 'Hide', 'shopready-elementor-addon' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'variable_qty_label_text',
			[
				'label' => __( 'Quantity', 'shopready-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Quantity', 'shopready-elementor-addon' ),
				'placeholder' => __( 'Type your Quantity label', 'shopready-elementor-addon' ),
			]
		);
        
        $this->add_control(
            'variable_desc_input',
            [
                'label' => __( 'Description', 'shopready-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    'block'  => __( 'Show', 'shopready-elementor-addon' ),
                    'none' => __( 'Hide', 'shopready-elementor-addon' ),
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-variation-description' => 'display: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
			'add_to_cart_attr_select_fld',
			[
				'label' => __( 'Variable Product Select Field', 'shopready-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'block'  => __( 'Show', 'shopready-elementor-addon' ),
					'none' => __( 'Hide', 'shopready-elementor-addon' ),
				],
			   
				'selectors' => [
					'{{WRAPPER}} .woo-ready-product-var-table .value select' => 'display: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'add_to_cart_var_attr_select_fld',
			[
				'label' => __( 'Variable Product Label', 'shopready-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'block'  => __( 'Show', 'shopready-elementor-addon' ),
					'none' => __( 'Hide', 'shopready-elementor-addon' ),
				],
			   
				'selectors' => [
					'{{WRAPPER}} .woo-ready-product-var-table .wready-row > label' => 'display: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'w_ready_table_layout',
			[
				'label' => __( 'Table Layout', 'shopready-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'table',
				'options' => [
					'table'  => __( 'Table', 'shopready-elementor-addon' ),
					'list' => __( 'List', 'shopready-elementor-addon' ),
				],
			 
			]
		);

		$this->end_controls_section();

	
		/**
		 * Layouts
		 */
		$this->box_layout(
			[
				'title'          => esc_html__('Container Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc__product_form',
				'element_name'   => '_form_wrapper',
				'selector'       => '{{WRAPPER}} .woo-ready-product-add-to-cart-layout form',
				
			]
		);


        $this->box_layout(
			[
				'title'          => esc_html__('Simple Stock','shopready-elementor-addon'),
				'slug'           => 'wready_wc__product_form_stock',
				'element_name'   => '__wrapper_stok',
				'selector'       => '{{WRAPPER}} .woo-ready-product-add-to-cart-layout form p.stock',
				
			]
		);

        $this->box_layout(
			[
				'title'          => esc_html__('Simple QTY Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc__product_form_qty',
				'element_name'   => 'wr__wrapper_qty',
				'selector'       => '{{WRAPPER}} .woo-ready-product-add-to-cart-layout .shop-ready-quantity-warapper',
				
			]
		);

        $this->box_layout(
			[
				'title'          => esc_html__('Simple Button','shopready-elementor-addon'),
				'slug'           => 'wread_wc__product_form_button',
				'element_name'   => 'wrea__wrapper_btn',
				'selector'       => '{{WRAPPER}} .woo-ready-product-add-to-cart-layout form button',
				
			]
		);


        
	    $this->box_layout(
			[
				'title'          => esc_html__('Group/Variation Product Table','shopready-elementor-addon'),
				'slug'           => 'wready_wc__product_grp_table',
				'element_name'   => 'grp_form_wrapper_vrti',
				'selector'       => '{{WRAPPER}} .woo-ready-product-add-to-cart-layout .woocommerce-grouped-product-list,{{WRAPPER}} .woo-ready-product-add-to-cart-layout .variations',
				
			]
		);
        
        $this->box_layout(
			[
				'title'          => esc_html__('Variation Product Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc__product_variation_pro_wrapper',
				'element_name'   => 'variation_f_wrapper_rti',
				'selector'       => '{{WRAPPER}} .woo-ready-product-add-to-cart-layout .single_variation_wrap',
				
			]
		);

        $this->box_layout(
			[
				'title'          => esc_html__('Variable Product Variation Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc_variable_product_sigle_variation',
				'element_name'   => 'cart_vriable_productsingle_variation',
				'selector'       => '{{WRAPPER}} .single_variation_wrap .single_variation',
				'hover_selector' => false
		]);

        $this->box_layout(
			[
				'title'          => esc_html__('Variable Product add to cart Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc_variable_product_si_variation_addcart',
				'element_name'   => 'cart_vriable_product_variationaddcart',
				'selector'       => '{{WRAPPER}} .single_variation_wrap .woocommerce-variation-add-to-cart',
				'hover_selector' => false
		]);
        
        
		/* Layouts End */

		$this->text_minimum_css(
			[
				'title'          => esc_html__('Stock','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_stock',
				'element_name'   => 'wrating_prt_stock',
				'selector'       => '{{WRAPPER}} p.stock,{{WRAPPER}} .sku_wrapper :not(span)',
				'hover_selector' => false,
				
			]
		);

		$this->text_minimum_css(
			[
				'title'          => esc_html__('QTY Label','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_qty_label',
				'element_name'   => 'wrating_prt_qty_label',
				'selector'       => '{{WRAPPER}} .shop-ready-product-qty-label',
				'hover_selector' => false
				
			]
		);
		
	

		$this->start_controls_section(
			'shop_ready_part_style_QTY_section',
			[
				'label'     => esc_html__( 'QTY field', 'shopready-elementor-addon' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				
			]
		);

				$this->add_control(
					'shop_ready_qty_coheight',
					[
						'label' => __( 'Height', 'shopready-elementor-addon' ),
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

						'selectors' => [
							'{{WRAPPER}} .wooready_product_quantity .product-quantity input, .wooready_product_quantity .product-quantity button' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'shop_ready_qty_cowidth',
					[
						'label' => __( 'Width', 'shopready-elementor-addon' ),
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

						'selectors' => [
							'{{WRAPPER}} .wooready_product_quantity .product-quantity input, .wooready_product_quantity .product-quantity button' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);

			$this->add_control(
				'shop_ready_qty_color',
				[
					'label'  => esc_html__( 'Color', 'shopready-elementor-addon' ),
					'type'   => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wooready_product_quantity .product-quantity input' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'shop_ready_qty_sub_color',
				[
					'label'  => esc_html__( 'Counter Color', 'shopready-elementor-addon' ),
					'type'   => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wooready_product_quantity .product-quantity .woo-ready-qty-sub' => 'color: {{VALUE}}',
						'{{WRAPPER}} .wooready_product_quantity .product-quantity .woo-ready-qty-add' => 'color: {{VALUE}}',
					],
				]
			);



			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'shop_ready_quantity_input_typography',
					'selector' => '{{WRAPPER}} .wooready_product_quantity .product-quantity input',
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'shop_ready_quantity_input_background',
					'label'    => esc_html__( 'Background', 'shopready-elementor-addon' ),
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .wooready_product_quantity .product-quantity button,
					{{WRAPPER}} .product-quantity button,
					{{WRAPPER}} .wooready_product_quantity .product-quantity input,
					{{WRAPPER}} .woo-ready-product-add-to-cart-layout.default .wooready_product_quantity .product-quantity',
				]
			);


	        $this->add_group_control(
	            Group_Control_Border:: get_type(),
	            [
	                'name'     => 'shop_ready_qty_fld_border',
	                'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
	                'selector' => '{{WRAPPER}} .wooready_product_quantity .product-quantity input',
	            ]
	        );

	        $this->add_responsive_control(
	            'shop_ready_qty_border_radius',
	            [
	                'label'      => esc_html__( 'Border Radius', 'shopready-elementor-addon' ),
	                'type'       => Controls_Manager::DIMENSIONS,
	                'size_units' => [ 'px', '%', 'em' ],
	                'selectors'  => [
	                    '{{WRAPPER}} .wooready_product_quantity .product-quantity' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .wr-checkout-cart-product-qty .product-quantity' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );
			
			$this->add_responsive_control(
				'shop_ready_qty_margin',
				[
					'label'      => esc_html__( 'Margin', 'shopready-elementor-addon' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .wooready_product_quantity .product-quantity' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'shop_ready_qty_padding',
				[
					'label'      => esc_html__( 'Padding', 'shopready-elementor-addon' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .wooready_product_quantity .product-quantity' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

        $this->input_field(
			[
				'title'          => esc_html__('Variation Select Field','shopready-elementor-addon'),
				'slug'           => 'wready_wc_product_variation_select',
				'element_name'   => 'wr_product_select_input',
				'selector'       => '{{WRAPPER}} .woo-ready-product-add-to-cart-layout form select',
				'hover_selector' => false,
                'tab' => Controls_Manager::TAB_CONTENT
				
			]
		);

        $this->text_minimum_css(
			[
				'title'          => esc_html__('Variation Label','shopready-elementor-addon'),
				'slug'           => 'wready_groupc_product_label_ty',
				'element_name'   => 'wready_prt_varia_label_',
				'selector'       => '{{WRAPPER}} .woo-ready-product-var-table .wready-row label',
				'hover_selector' => false,
                'tab' => Controls_Manager::TAB_CONTENT
			]
		); 
		
		$this->text_minimum_css(
			[
				'title'          => esc_html__('Variation Reset Button','shopready-elementor-addon'),
				'slug'           => 'wready_groupc_product_reset_btn',
				'element_name'   => 'wready_prt_varia_reset_btn',
				'selector'       => '{{WRAPPER}} .woo-ready-product-add-to-cart-layout form .reset_variations',
				'hover_selector' => '{{WRAPPER}} .woo-ready-product-add-to-cart-layout form .reset_variations:hover',
                'tab' => Controls_Manager::TAB_CONTENT
			]
		);

        $this->text_css(
			[
				'title'          => esc_html__('Simple Button','shopready-elementor-addon'),
				'slug'           => 'wr_product_s_button',
				'element_name'   => 'wr_style_button',
				'selector'       => '{{WRAPPER}} .woo-ready-product-add-to-cart-layout form > button',
				'hover_selector' => '{{WRAPPER}} .woo-ready-product-add-to-cart-layout form > button:hover',
				
			]
		);
		
		$this->text_css(
			[
				'title'          => esc_html__('Variable Button','shopready-elementor-addon'),
				'slug'           => 'wr_product_variable_button',
				'element_name'   => 'wr_style_variable_button',
				'selector'       => '{{WRAPPER}} .wready-product-variation-wrapper .single_add_to_cart_button',
				'hover_selector' => '{{WRAPPER}} .wready-product-variation-wrapper .single_add_to_cart_button:hover',
				
			]
		);

      

        $this->text_minimum_css(
			[
				'title'          => esc_html__('Group Product Title','shopready-elementor-addon'),
				'slug'           => 'wready_groupc_product_title',
				'element_name'   => 'wready_prt_title',
				'selector'       => '{{WRAPPER}} .woocommerce-grouped-product-list-item__label a',
				'hover_selector' => '{{WRAPPER}} .woocommerce-grouped-product-list-item__label a:hover',
				
			]
		);
        
        $this->text_minimum_css(
			[
				'title'          => esc_html__('Group Product Price','shopready-elementor-addon'),
				'slug'           => 'wready_groupc_product_price',
				'element_name'   => 'wready_prt_price',
				'selector'       => '{{WRAPPER}} .woocommerce-grouped-product-list-item__price .woocommerce-Price-amount',
				'hover_selector' => false
				
			]
		);

        $this->text_minimum_css(
			[
				'title'          => esc_html__('Group Product Sale Price','shopready-elementor-addon'),
				'slug'           => 'wready_groupc_product_sale_price',
				'element_name'   => 'wready_prt_sale_price',
				'selector'       => '{{WRAPPER}} .woocommerce-grouped-product-list-item__price ins .woocommerce-Price-amount',
				'hover_selector' => false
				
			]
		);

        $this->text_minimum_css(
			[
				'title'          => esc_html__('Group Product Regular Price','shopready-elementor-addon'),
				'slug'           => 'wready_groupc_product_del_price',
				'element_name'   => 'wready_prt_del_price',
				'selector'       => '{{WRAPPER}} .woocommerce-grouped-product-list-item__price del .woocommerce-Price-amount',
				'hover_selector' => false
				
			]
		);

        $this->text_minimum_css(
			[
				'title'          => esc_html__('Variation Price Style','shopready-elementor-addon'),
				'slug'           => 'wready_groupc_productvariation_price',
				'element_name'   => 'wready_prt_variation_price',
				'selector'       => '{{WRAPPER}} .woocommerce-variation-price span',
				'hover_selector' => false,
                'tab' => Controls_Manager::TAB_CONTENT
				
			]
		);

        $this->text_minimum_css(
			[
				'title'          => esc_html__('Variation Sale Price Style','shopready-elementor-addon'),
				'slug'           => 'wready_groupc_productvariation_sale_price',
				'element_name'   => 'wready_prt_variation_sale_price',
				'selector'       => '{{WRAPPER}} .woocommerce-variation-price span del .amount, {{WRAPPER}} .woocommerce-variation-price span del .amount .woocommerce-Price-currencySymbol, {{WRAPPER}} .wready-product-price del .amount .woocommerce-Price-currencySymbol',
				'hover_selector' => false,
                'tab' => Controls_Manager::TAB_CONTENT
				
			]
		);

        $this->text_minimum_css(
			[
				'title'          => esc_html__('Variation Desc style','shopready-elementor-addon'),
				'slug'           => 'wready_groupc_productvariation_desc',
				'element_name'   => 'wready_prt_variation_desc',
				'selector'       => '{{WRAPPER}} .woocommerce-variation-description',
				'hover_selector' => false,
                'tab' => Controls_Manager::TAB_CONTENT
				
			]
		);

        $this->text_minimum_css(
			[
				'title'          => esc_html__('Variation Stock Style','shopready-elementor-addon'),
				'slug'           => 'wready_groupc_productvariation_avai',
				'element_name'   => 'wready_prt_variation_aca',
				'selector'       => '{{WRAPPER}} .woocommerce-variation-availability p',
				'hover_selector' => false,
                'tab' => Controls_Manager::TAB_CONTENT

				
			]
		);

        $this->text_wrapper_css(
			[
				'title'          => esc_html__('Table Odd Row','shopready-elementor-addon'),
				'slug'           => 'wready_wc_default_cart_table_bodyrow',
				'element_name'   => 'cart_shortcode_table_body_wrow',
				'selector'       => '{{WRAPPER}} table tbody>tr:nth-child(odd)>td, table tbody>tr:nth-child(odd)>th',
				'hover_selector' => '{{WRAPPER}} table tbody>tr:nth-child(odd)>td:hover'
			]
	    );

		$this->text_wrapper_css(
			[
				'title'          => esc_html__('Table Even Row','shopready-elementor-addon'),
				'slug'           => 'wready_wc_default_cart_table_body_even_row',
				'element_name'   => 'cart_shortcode_table_body_weventrow',
				'selector'       => '{{WRAPPER}} table tbody>tr:nth-child(even)>td, table tbody>tr:nth-child(even)>th',
				'hover_selector' => '{{WRAPPER}} table tbody>tr:nth-child(even)>td:hover'
		]);
		

		$this->text_wrapper_css(
			[
				'title'          => esc_html__('Table Column','shopready-elementor-addon'),
				'slug'           => 'wready_wc_default_cart_table_colm',
				'element_name'   => 'cart_shortcode_table_body',
				'selector'       => '{{WRAPPER}} .woo-ready-product-add-to-cart-layout table td',
				'hover_selector' => '{{WRAPPER}} .woo-ready-product-add-to-cart-layout table tr:hover td'
		]);


	
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
				'class' => [ 'woo-ready-product-add-to-cart-layout', $settings['style'] ],
			]
		);
        
        echo sprintf("<div %s>",$this->get_render_attribute_string( 'wrapper_style' ));

			if(file_exists(dirname(__FILE__). '/template-parts/add_to_cart/'.$settings['style'].'.php')){
				shop_ready_widget_template_part(
					'product/template-parts/add_to_cart/'.$settings['style'].'.php',
					array(

						'settings'  => $settings,
					
					)
				);

			}else{
                shop_ready_widget_template_part(
					'product/template-parts/add_to_cart/default.php',
					array(
						'settings'=> $settings,
					)
				);
			}
			
		echo '</div>';
	}

}