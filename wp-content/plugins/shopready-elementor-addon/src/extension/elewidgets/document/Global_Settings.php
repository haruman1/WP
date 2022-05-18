<?php

namespace Shop_Ready\extension\elewidgets\document;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;
use Elementor\Core\Base\Document;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/* 
* Site Global Settings
* @since 1.0 
*/

class Global_Settings extends Tab_Base {

	public function get_id() {
		return 'woo-ready-basic';
	}

	public function get_title() {
		return esc_html__( 'ShopReady', 'shopready-elementor-addon' );
	}

	public function get_group() {
		return 'settings';
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_help_url() {
		return 'quomodosoft.com';
	}

	protected function register_tab_controls() {
       
        do_action('woo_ready_header_footer', $this , $this->get_id());
       
        $this->General_cart_widget();
        do_action('shop_ready_cart_gl_settings', $this, $this->get_id());
        $this->Currency_Swicher();
        $this->grid_layout();

        $this->modal_wc_popup();
        $this->product_compare();

        $this->modal_wishlist_popup();
        $this->product_wishlist();
        
        $this->modal_quickview_popup();
        $this->product_quickview();
        
        do_action('shop_ready_newslatter_popup', $this, $this->get_id());

		$this->login_register(); 
		$this->payment(); 
       
		$this->checkout(); 
		$this->order_review(); 
		$this->checkout_address();
         
        do_action('shop_ready_sale_notifications', $this, $this->get_id());
        
			
	}

    public function Currency_Swicher(){

        $this->start_controls_section(
			'woo_ready_currency_swicher_settings',
			[

                'label' => apply_filters( 'shop_ready_product_gl_label', esc_html__( 'Currency Swicher Pro', 'shopready-elementor-addon' ) ) ,
				'tab' => $this->get_id(),
			]
		); 

            $this->add_control(
                'woo_ready_disable_currency_in_checkout',
                [
                    'label'        => esc_html__( 'Disable in Checkout?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                ]
            );

            $this->add_control(
                'woo_ready_disable_currency_in_cart',
                [
                    'label'        => esc_html__( 'Disable in Cart?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                ]
            );

            $this->add_control(
                'woo_ready_select_currencies',
                [
                    'label' => __( 'Select Currencies', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::SELECT2,
                    'multiple' => true,
                    'label_block' => true,
                    'options' => woo_ready_get_product_currency_options(),
                    'default' => [ 'USD', 'EUR', 'SGD'],
                ]
            );
        
        $this->end_controls_section();
    }

    public function General_cart_widget(){

       
        $this->start_controls_section(
			'woo_ready_general_settings',
			[
				
                'label' => apply_filters( 'shop_ready_product_gl_label', esc_html__( 'Cart Count Widget Pro', 'shopready-elementor-addon' ) ) ,
				'tab' => $this->get_id(),
			]
		); 

            $this->add_control(
                'woo_ready_widget_cart_count_icon',
                [
                    'label'     => __( 'Add Cart Icon', 'shopready-elementor-addon' ),
                    'type'      => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fa fa-shopping-cart',
                        'library' => 'solid',
                    ],
                   
                ]
            ); 

            $this->add_control(
                'woo_ready_widget_cart_number_before_text',
                [
                    'label'        => esc_html__( 'Cart Count before text?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                ]
            );

            $this->add_control(
                'woo_ready_widget_cart_label',
                [
                    'label'           => esc_html__( 'Cart Label', 'shopready-elementor-addon' ),
                    'type'            => \Elementor\Controls_Manager::TEXT,
                    'default' => 'Cart'
                ]
            );

            $this->add_control(
                'woo_ready_widget_cart_count_singular',
                [
                    'label'   => esc_html__( 'Count Singular', 'shopready-elementor-addon' ),
                    'type'    => \Elementor\Controls_Manager::TEXT,
                    'default' => 'item'
                ]
            );

            $this->add_control(
                'woo_ready_widget_cart_count_plural',
                [
                    'label'   => esc_html__( 'Count Plural', 'shopready-elementor-addon' ),
                    'type'    => \Elementor\Controls_Manager::TEXT,
                    'default' => 'items'
                ]
            );

           

        $this->end_controls_section();
        $this->start_controls_section(
			'shop_ready_sidebar_mini_cart_layouts',
			[
				'label' => esc_html__( 'Mini Cart', 'shopready-elementor-addon' ),
				'tab' => $this->get_id(),
			]
		); 

        do_action('shop_ready_mini_cart_layout',$this);

        $this->add_control(
            'woo_ready_mini_cart_title_limit_plural',
            [
                'label'   => esc_html__( 'Title limit', 'shopready-elementor-addon' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '3'
            ]
        );
        
        do_action('shop_ready_mini_cart_end',$this);
        $this->end_controls_section();
    }

    public function grid_layout(){

        $this->start_controls_section(
			'woo_ready_products_archive_grid_layouts',
			[
				'label' => esc_html__( 'Shop Archive', 'shopready-elementor-addon' ),
				'tab' => $this->get_id(),
			]
		); 
        
            $this->add_control(
                'wooready_products_archive_shop_grid_style',
                [
                    'label'   => esc_html__( 'Product Grid Style', 'shopready-elementor-addon' ),
                    'type'    => \Elementor\Controls_Manager::SELECT,
                    'default' => 'wc',
                    'options' => apply_filters( 'shop_ready_products_archive_grid_style', [
                       
                        'classic'              => esc_html__( 'Classic', 'shopready-elementor-addon' ),
                        'wc'                   => esc_html__( 'shopready-elementor-addon', 'shopready-elementor-addon' ),
                        'side_flip_center'     => esc_html__( 'Side Flip Center', 'shopready-elementor-addon' ),
                        'side_flip_center_two' => esc_html__( 'Side Flip Center 2 Pro', 'shopready-elementor-addon' ),
                        'side_flip'            => esc_html__( 'Side Flip Pro', 'shopready-elementor-addon' ),
                        'side_flip_left'       => esc_html__( 'Side Flip Left Pro', 'shopready-elementor-addon' ),
                        'eforest'       => esc_html__( 'Eforest Pro', 'shopready-elementor-addon' ),
                       
                  
                    ]),
                ]
            );

            $query['autofocus[panel]'] = 'shopready-elementor-addon';
            $panel_link = add_query_arg( $query, admin_url( 'customize.php' ) );
            $this->add_control(
                'woo_ready_csutomizer_usage_direction_notice',
                [
                    'label'           => esc_html__( 'Important Note', 'shopready-elementor-addon' ),
                    'type'            => \Elementor\Controls_Manager::RAW_HTML,
                    'raw'             => __( '<a target="_blank" href="'.esc_url( $panel_link ).'">Use grid</a> Column from customizer -> WooCommerce -> Categol Settings', 'shopready-elementor-addon' ),
                    'content_classes' => 'woo-ready-shop-page-notice',
                ]
            );

            $this->add_control(
                'woo_ready_product_grid_stock_seperator',
                [
                    'label'           => esc_html__( 'Stock Seperator', 'shopready-elementor-addon' ),
                    'type'            => \Elementor\Controls_Manager::TEXT,
                    'default' => '/'
                ]
            );

            do_action( 'shop_ready_pro_global_archive_settings' , $this );

            $this->start_controls_tabs(
                'shop__ready_pro_global_settings_yuiot_shop_setytingsss_tabs'
            );

            $this->start_controls_tab(
                'shop_ready_pro_global_settings_normal_style_flex_align_tab',
                [
                    'label' => __( 'Alignment', 'shopready-elementor-addon' ),
                ]
            );

            $this->add_responsive_control(
                'wooready_products_archive_shop_grid_ui_alignment_element',
                [
                    'label'     => esc_html__( 'Flex Alignment', 'shopready-elementor-addon' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'default'   => '',
                    'options'   => [
                        'flex-start'    => esc_html__( 'Left', 'shopready-elementor-addon' ),
                        'flex-end'      => esc_html__( 'Right', 'shopready-elementor-addon' ),
                        'center'        => esc_html__( 'Center', 'shopready-elementor-addon' ),
                        'space-around'  => esc_html__( 'Space Around', 'shopready-elementor-addon' ),
                        'space-between' => esc_html__( 'Space Between', 'shopready-elementor-addon' ),
                        'space-evenly'  => esc_html__( 'Space Evenly', 'shopready-elementor-addon' ),
                        ''              => esc_html__( 'inherit', 'shopready-elementor-addon' ),
                    ],
                  
                    'selectors' => [
                        'body .wooready_product_content_box' => 'justify-content: {{VALUE}};',
                        'body .wooready_price_box'           => 'justify-content: {{VALUE}};',
                        
                        'body .wooready_product_color'       => 'justify-content: {{VALUE}};',
                    ],
                ]
    
            );

            $this->add_responsive_control(
                'wooready_products_archive_shop_grid_ui_alignment_text_element',
                [
                    'label'     => esc_html__( 'Text Alignment', 'shopready-elementor-addon' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'default'   => '',
                    'options'   => [

                        'left'   => esc_html__( 'Left', 'shopready-elementor-addon' ),
                        'right'  => esc_html__( 'Right', 'shopready-elementor-addon' ),
                        'center' => esc_html__( 'Center', 'shopready-elementor-addon' ),
                        'inherit' => esc_html__( 'Inherit', 'shopready-elementor-addon' ),
                     
                    ],
                  
                    'selectors' => [
                        'body .wooready_product_content_box' => 'text-align: {{VALUE}};',
                        'body .wooready_price_box'           => 'align-items: {{VALUE}};',
                    ],
                ]
    
            );

            $this->end_controls_tab();
            // grid order
            $this->start_controls_tab(
                'shop_ready_pro_global_settings_normal_sgrid_order_tab',
                [
                    'label' => __( 'Order', 'shopready-elementor-addon' ),
                ]
            );

            $this->add_responsive_control(
                'wooready_products_archive_shop_grid_order_title_element',
                [
                    'label'      => esc_html__( 'Title Order', 'shopready-elementor-addon' ),
                    'type'       => Controls_Manager::SLIDER,
                   
                    'size_units' => ['px'],
                    'range'      => [
                        'px' => [
                            'min'  => -30,
                            'max'  => 100,
                            'step' => 1,
                        ],
    
                    ],
    
                    'selectors'  => [
                        '{{WRAPPER}} .wooready_title' => 'order: {{SIZE}}',
    
                    ],
                    'condition' => [
                       
                        'wooready_products_archive_shop_grid_style' => ['side_flip_center_two','side_flip','side_flip_left','side_flip_center']
                    ]
                ]
            );
            
            $this->add_responsive_control(
                'wooready_products_archive_shop_grid_order_priceelement',
                [
                    'label'      => esc_html__( 'Price Order', 'shopready-elementor-addon' ),
                    'type'       => Controls_Manager::SLIDER,
                   
                    'size_units' => ['px'],
                    'range'      => [
                        'px' => [
                            'min'  => -30,
                            'max'  => 100,
                            'step' => 1,
                        ],
    
                    ],
    
                    'selectors'  => [
                        '{{WRAPPER}} .wooready_price_box' => 'order: {{SIZE}}',
    
                    ],
                    'condition' => [
                       
                        'wooready_products_archive_shop_grid_style' => ['side_flip_center_two','side_flip','side_flip_left','side_flip_center']
                    ]
                ]
            );

            $this->add_responsive_control(
                'wooready_products_archive_shop_grid_order_review_element',
                [
                    'label'      => esc_html__( 'Review Order', 'shopready-elementor-addon' ),
                    'type'       => Controls_Manager::SLIDER,
                   
                    'size_units' => ['px'],
                    'range'      => [
                        'px' => [
                            'min'  => -30,
                            'max'  => 100,
                            'step' => 1,
                        ],
    
                    ],
    
                    'selectors'  => [
                        '{{WRAPPER}} .wooready_review' => 'order: {{SIZE}}',
    
                    ],
                    'condition' => [
                       
                        'wooready_products_archive_shop_grid_style' => ['side_flip_center_two','side_flip','side_flip_left','side_flip_center']
                    ]
                ]
            ); 
            
            $this->add_responsive_control(
                'wooready_products_archive_shop_grid_order_color_element',
                [
                    'label'      => esc_html__( 'Color Order', 'shopready-elementor-addon' ),
                    'type'       => Controls_Manager::SLIDER,
                   
                    'size_units' => ['px'],
                    'range'      => [
                        'px' => [
                            'min'  => -30,
                            'max'  => 100,
                            'step' => 1,
                        ],
    
                    ],
    
                    'selectors'  => [
                        '{{WRAPPER}} .wooready_product_color' => 'order: {{SIZE}}',
    
                    ],
                    'condition' => [
                       
                        'wooready_products_archive_shop_grid_style' => ['side_flip_center_two','side_flip','side_flip_left','side_flip_center']
                    ]
                ]
            ); 
            
            $this->add_responsive_control(
                'wooready_products_archive_shop_grid_order_range_element',
                [
                    'label'      => esc_html__( 'Sold Ranger Order', 'shopready-elementor-addon' ),
                    'type'       => Controls_Manager::SLIDER,
                   
                    'size_units' => ['px'],
                    'range'      => [
                        'px' => [
                            'min'  => -30,
                            'max'  => 100,
                            'step' => 1,
                        ],
    
                    ],
    
                    'selectors'  => [
                        '{{WRAPPER}} .wooready_product_sold_range' => 'order: {{SIZE}}',
    
                    ],
                    'condition' => [
                       
                        'wooready_products_archive_shop_grid_style' => ['side_flip_center_two','side_flip','side_flip_left','side_flip_center']
                    ]
                ]
            ); 
            
            
            $this->add_responsive_control(
                'wooready_products_archive_shop_grid_order_image_element',
                [
                    'label'      => esc_html__( 'Image Order', 'shopready-elementor-addon' ),
                    'type'       => Controls_Manager::SLIDER,
                   
                    'size_units' => ['px'],
                    'range'      => [
                        'px' => [
                            'min'  => -30,
                            'max'  => 100,
                            'step' => 1,
                        ],
    
                    ],
    
                    'selectors'  => [
                        '{{WRAPPER}} .wooready_product_thumb ' => 'order: {{SIZE}}',
    
                    ],
                    'condition' => [
                       
                        'wooready_products_archive_shop_grid_style' => ['side_flip_center_two','side_flip','side_flip_left','side_flip_center']
                    ]
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'shop_ready_pro_global_settings_normal_cart_tab',
                [
                    'label' => __( 'Cart', 'shopready-elementor-addon' ),
                ]
            );

            $this->add_control(
                'wooready_products_archive_shop_grid_cart_icon_enable',
                [
                    'label'        => esc_html__( 'Cart Add Icon?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'wooready_products_archive_shop_grid_cart_icon',
                [
                    'label'     => __( 'Add Cart Icon', 'shopready-elementor-addon' ),
                    'type'      => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fa fa-shopping-cart',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'wooready_products_archive_shop_grid_cart_icon_enable' => [
                            'yes',
                        ],
                        'wooready_products_archive_shop_grid_style' => ['wready_style','side_flip','side_flip_left','side_flip_center']
                    ]
                ]
            ); 

            $this->add_control(
                'wooready_products_archive_shop_grid_cart_text',
                [
                    'label'                                     => esc_html__( 'Cart Text', 'shopready-elementor-addon' ),
                    'type'                                      => \Elementor\Controls_Manager::TEXT,
                    'placeholder'                               => esc_html__( 'Add To Cart' , 'shopready-elementor-addon' ),
                    'default'                                   => esc_html__( 'Add To Cart' , 'shopready-elementor-addon' ),
                    'wooready_products_archive_shop_grid_style' => ['wready_style','side_flip','side_flip_left','side_flip_center'],
                    'label_block'                               => true
                ]
            );

          $this->end_controls_tab();
         $this->end_controls_tabs();

        $this->end_controls_section();
    
    }

    public function checkout_address(){

        $this->start_controls_section(
			'woo_ready_wc_b_module',
			[
				
                'label' => apply_filters( 'shop_ready_product_gl_label', esc_html__( 'Checkout Address Pro', 'shopready-elementor-addon' ) ) ,
				'tab' => $this->get_id(),
			]
		);

		$this->add_control(
            'wr_checkout_address_modify',
            [
                'label'        => esc_html__( 'Address modify?', 'shopready-elementor-addon' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'list_field',
			[
				'label'   => esc_html__( 'Billing Fields', 'shopready-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => shop_ready_get_default_billing_address()
			]
		);

        $repeater->add_control(
            'list_disable',
            [
                'label'        => esc_html__( 'Disable?', 'shopready-elementor-addon' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                'return_value' => 'yes',
                'default'      => '',
                 'condition' => [
                    'list_field!' => ''
                 ],
                'description'      => esc_html__( 'It Will remove field from billing address', 'shopready-elementor-addon' ),
            ]
        );

        $repeater->add_control(
            'list_label_change',
            [
                'label'        => esc_html__( 'Label Change?', 'shopready-elementor-addon' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                'return_value' => 'yes',
                'default'      => '',
                'condition' => [
                    'list_disable' => ''
                ]
            ]
        );
 
        $repeater->add_control(
            'list_title',
            [
                'label'       => esc_html__( 'Label', 'shopready-elementor-addon' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Field Label' , 'shopready-elementor-addon' ),
                'condition' => [
                     'list_label_change' => ['yes'],
                     'list_disable' => ''
                ],
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'list_required',
            [
                'label'        => esc_html__( 'Required?', 'shopready-elementor-addon' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                'return_value' => 'yes',
                'default'      => '',
                'condition' => [
                    'list_disable' => ''
                ]
            ]
        );
   
      
        $repeater->add_control(
            'list_priority',
            [
                'label'       => esc_html__( 'Priority', 'shopready-elementor-addon' ),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'placeholder' => esc_html__( 'Field Priority' , 'shopready-elementor-addon' ),
                'default'      => 1,
                'label_block' => true,
                'condition' => [
                    'list_disable' => ''
                ]
            ]
        );

        $repeater->add_control(
			'list_col_wdith',
			[
				'label'   => esc_html__( 'Wide', 'shopready-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
                'label_block' => true,
				'options' => [
                    'flex-basis:col-12' => esc_html__('Full','shopready-elementor-addon'),
                    'flex-basis:col-6'  => esc_html__('Two Column','shopready-elementor-addon'),
                    'flex-basis:col-4'  => esc_html__('Three Column','shopready-elementor-addon'),
                    'flex-basis:col-3'  => esc_html__('Four Column','shopready-elementor-addon'),
                    'flex-basis:col-2'  => esc_html__('Six Column','shopready-elementor-addon'),
                    'flex-basis:col-10' => esc_html__('Ten Column','shopready-elementor-addon'),
                    'flex-basis:col-8'  => esc_html__('Eight Column','shopready-elementor-addon'),
                ],
                'condition' => [
                    'list_disable' => ''
                ]
			]
		);
      

	
		$this->add_control(
			'wr_checkout_billing_address_list',
			[
				'label' => esc_html__( 'Billing Address Fields', 'shopready-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					
				],
				'title_field' => '{{{ list_title  }}} {{ list_disable == "yes"? " is Disable":"" }}',
                'condition' => [
                    'wr_checkout_address_modify' => ['yes']
                ]
			]
		);

        // Shipping Address

        $ship_repeater = new \Elementor\Repeater();

        $ship_repeater->add_control(
			'list_field',
			[
				'label'   => esc_html__( 'Fields', 'shopready-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => shop_ready_get_default_shipping_address()
			]
		);

        $ship_repeater->add_control(
            'list_disable',
            [
                'label'        => esc_html__( 'Disable?', 'shopready-elementor-addon' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                'return_value' => 'yes',
                'default'      => '',
                 'condition' => [
                    'list_field!' => ''
                 ],
                'description'      => esc_html__( 'It Will remove field from billing address', 'shopready-elementor-addon' ),
            ]
        );

        $ship_repeater->add_control(
            'list_label_change',
            [
                'label'        => esc_html__( 'Label Change?', 'shopready-elementor-addon' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                'return_value' => 'yes',
                'default'      => '',
                'condition' => [
                    'list_disable' => ''
                ]
            ]
        );
        
      

        $ship_repeater->add_control(
            'list_title',
            [
                'label'       => esc_html__( 'Label', 'shopready-elementor-addon' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Field Label' , 'shopready-elementor-addon' ),
               
            ]
        );

        $ship_repeater->add_control(
            'list_required',
            [
                'label'        => esc_html__( 'Required?', 'shopready-elementor-addon' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                'return_value' => 'yes',
                'default'      => '',
                'condition' => [
                    'list_disable' => ''
                ]
            ]
        );
        
      
        $ship_repeater->add_control(
            'list_priority',
            [
                'label'       => esc_html__( 'Priority', 'shopready-elementor-addon' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Field Priority' , 'shopready-elementor-addon' ),
                'default'      => 1,
                'condition' => [
                    'list_disable' => ''
                ]
            ]
        );

        $ship_repeater->add_control(
			'list_col_wdith',
			[
				'label'   => esc_html__( 'Wide', 'shopready-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
                    'flex-basis:col-12' => esc_html__('Full','shopready-elementor-addon'),
                    'flex-basis:col-6'  => esc_html__('Two Column','shopready-elementor-addon'),
                    'flex-basis:col-4'  => esc_html__('Three Column','shopready-elementor-addon'),
                    'flex-basis:col-3'  => esc_html__('Four Column','shopready-elementor-addon'),
                    'flex-basis:col-2'  => esc_html__('Six Column','shopready-elementor-addon'),
                    'flex-basis:col-10' => esc_html__('Ten Column','shopready-elementor-addon'),
                    'flex-basis:col-8'  => esc_html__('Eight Column','shopready-elementor-addon'),
                ],
                'condition' => [
                    'list_disable' => ''
                ]
			]
		);
      
        $this->add_control(
            'disable_shipping_address',
            [
                'label'        => esc_html__( 'Disable Shipping Address?', 'shopready-elementor-addon' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                'return_value' => 'yes',
                'default'      => '',
               
            ]
        );
	
		$this->add_control(
			'wr_checkout_shipping_address_list',
			[
				'label' => esc_html__( 'Shipping Address Fields', 'shopready-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $ship_repeater->get_controls(),
				'default' => [
					
				],
				'title_field' => '{{{ list_title }}}',
                'condition' => [
                    'disable_shipping_address' => ''
                ]
			]
		);

        
		$this->end_controls_section();
    }

    public function order_review(){


        $this->start_controls_section(
			'woo_ready_wc_order_review_',
			[
				'label' => esc_html__( 'Thank You', 'shopready-elementor-addon' ),
				'tab' => $this->get_id(),
			]
		);

            $this->add_control(
                'woo_ready_enable_thankyou_order_details',
                [
                    'label'        => esc_html__( 'Order Details?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );  
            
            $this->add_control(
                'woo_ready_enable_thankyou_billing_address',
                [
                    'label'        => esc_html__( 'Billing Address?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
            
            $this->start_controls_tabs(
                'woo_ready_thankyou_billing_style_tabs'
         
            );
    
            $this->start_controls_tab(
                'woo_ready_tnkstyle_billing_tab',
                [
                    'label' => __( 'Addrress', 'shopready-elementor-addon' ),
                ]
            );

                $this->add_control(
                    'woo_ready_enable_thankyou_billing_heading',
                    [
                        'label'        => esc_html__( 'Billing Title?', 'shopready-elementor-addon' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                        'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ]
                );

                $this->add_control(
                    'woo_ready_thankyou_order_details_billing_heading',
                    [
                        'label'       => __( 'Title', 'shopready-elementor-addon' ),
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'default'     => __( 'Billing Address', 'shopready-elementor-addon' ),
                        'placeholder' => __( 'Billing Address', 'shopready-elementor-addon' ),
                        'condition' => [
                            'woo_ready_enable_thankyou_billing_heading' => ['yes'],
                       

                        ]
                    ]
                );

                $this->add_control(
                    'woo_ready_enable_thankyou_shipping_heading',
                    [
                        'label'        => esc_html__( 'Shipping Title?', 'shopready-elementor-addon' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                        'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ]
                );

                $this->add_control(
                    'woo_ready_thankyou_order_details_shipping_heading',
                    [
                        'label'       => __( 'Title', 'shopready-elementor-addon' ),
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'default'     => __( 'Shipping Address', 'shopready-elementor-addon' ),
                        'placeholder' => __( 'Shipping Address', 'shopready-elementor-addon' ),
                        'condition' => [
                            'woo_ready_enable_thankyou_shipping_heading' => ['yes'],
                       

                        ]
                    ]
                );
    
    
            $this->end_controls_tab();

            $this->start_controls_tab(
                'woo_ready_tnkstyle_order_details_tab',
                [
                    'label' => __( 'Order', 'shopready-elementor-addon' ),
                ]
            );

                $this->add_control(
                    'woo_ready_enable_thankyou_order_details_heading',
                    [
                        'label'        => esc_html__( 'Heading Show?', 'shopready-elementor-addon' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                        'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ]
                );

                $this->add_control(
                    'woo_ready_thankyou_order_details_heading',
                    [
                        'label'       => __( 'Heading Content', 'shopready-elementor-addon' ),
                        'type'        => \Elementor\Controls_Manager::TEXTAREA,
                        'default'     => __( 'Order details', 'shopready-elementor-addon' ),
                        'placeholder' => __( 'Order Details', 'shopready-elementor-addon' ),
                        'condition' => [
                            'woo_ready_enable_thankyou_order_details_heading' => ['yes']
                        ]
                    ]
                );

                $this->add_control(
                    'woo_ready_enable_thankyou_order_download',
                    [
                        'label'        => esc_html__( 'Download Show?', 'shopready-elementor-addon' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                        'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ]
                );

                $this->add_control(
                    'woo_ready_enable_thankyou_order_download_title',
                    [
                        'label'        => esc_html__( 'Download Title?', 'shopready-elementor-addon' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                        'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                        'condition' => [
                            'woo_ready_enable_thankyou_order_download' => ['yes']
                        ]
                    ]
                );

                $this->add_control(
                    'woo_ready_thankyou_order_details_download_heading',
                    [
                        'label'       => __( 'Download Title', 'shopready-elementor-addon' ),
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'default'     => __( 'Download', 'shopready-elementor-addon' ),
                        'placeholder' => __( 'Downlaods', 'shopready-elementor-addon' ),
                        'condition' => [
                            'woo_ready_enable_thankyou_order_download_title' => ['yes'],
                            'woo_ready_enable_thankyou_order_download' => ['yes']

                        ]
                    ]
                );

                $this->add_control(
                    'woo_ready_enable_thankyou_order_again_button',
                    [
                        'label'        => esc_html__( 'Order Again?', 'shopready-elementor-addon' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                        'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ]
                );
    
    
            $this->end_controls_tab();

            $this->start_controls_tab(
                'woo_ready_tnkstyle_review_tab',
                [
                    'label' => __( 'Thank You', 'shopready-elementor-addon' ),
                ]
            );

                $this->add_control(
                    'woo_ready_enable_thankyou_msg',
                    [
                        'label'        => esc_html__( 'Message?', 'shopready-elementor-addon' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                        'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ]
                );

              

                $this->add_control(
                    'woo_ready_enable_thankyou_payment_method',
                    [
                        'label'        => esc_html__( 'Payment Method?', 'shopready-elementor-addon' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                        'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ]
                );

                $this->add_control(
                    'woo_ready_enable_thankyou_email',
                    [
                        'label'        => esc_html__( 'Email?', 'shopready-elementor-addon' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                        'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ]
                );

                $this->add_control(
                    'woo_ready_enable_thankyou_date',
                    [
                        'label'        => esc_html__( 'Date?', 'shopready-elementor-addon' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                        'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ]
                );

                $this->add_control(
                    'woo_ready_enable_thankyou_order_number',
                    [
                        'label'        => esc_html__( 'Order Number?', 'shopready-elementor-addon' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                        'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ]
                );

                $this->add_control(
                    'woo_ready_enable_thankyou_order_total',
                    [
                        'label'        => esc_html__( 'Order Total?', 'shopready-elementor-addon' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                        'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ]
                );

                $this->add_control(
                    'woo_ready_thank_you_msg',
                    [
                        'label' => __( 'Message Content', 'shopready-elementor-addon' ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => __( 'Thank you. Your order has been received.', 'shopready-elementor-addon' ),
                        'placeholder' => __( 'Thank you. Your order has been received.', 'shopready-elementor-addon' ),
                        'condition' => [
                            'woo_ready_enable_thankyou_msg' => ['yes']
                        ]
                    ]
                );

                $this->add_control(
                    'woo_ready_thank_you_order_number',
                    [
                        'label' => __( 'Order Number', 'shopready-elementor-addon' ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => __( 'Order Number', 'shopready-elementor-addon' ),
                        'placeholder' => __( 'Order Number', 'shopready-elementor-addon' ),
                    ]
                );
                
                $this->add_control(
                    'woo_ready_thank_you_order_date',
                    [
                        'label' => __( 'Order Date', 'shopready-elementor-addon' ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => __( 'Date', 'shopready-elementor-addon' ),
                        'placeholder' => __( 'Date', 'shopready-elementor-addon' ),
                    ]
                );
                
                $this->add_control(
                    'woo_ready_thank_you_order_email',
                    [
                        'label' => __( 'Order Email', 'shopready-elementor-addon' ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => __( 'Email', 'shopready-elementor-addon' ),
                        'placeholder' => __( 'Email', 'shopready-elementor-addon' ),
                    ]
                );

                $this->add_control(
                    'woo_ready_thank_you_order_total',
                    [
                        'label' => __( 'Order Total', 'shopready-elementor-addon' ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => __( 'Total', 'shopready-elementor-addon' ),
                        'placeholder' => __( 'Total', 'shopready-elementor-addon' ),
                    ]
                );
                
                $this->add_control(
                    'woo_ready_thank_you_order_payment_method',
                    [
                        'label' => __( 'Payment method', 'shopready-elementor-addon' ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => __( 'Payment method', 'shopready-elementor-addon' ),
                        'placeholder' => __( 'Payment method', 'shopready-elementor-addon' ),
                    ]
                );
    
    
            $this->end_controls_tab();
            $this->start_controls_tab(
                'woo_ready_tnkstyle_order_fail',
                [
                    'label' => __( 'Fail', 'shopready-elementor-addon' ),
                ]
            );

                $this->add_control(
                    'woo_ready_thank_you_order_fail_msg',
                    [
                        'label'       => __( 'Content', 'shopready-elementor-addon' ),
                        'type'        => \Elementor\Controls_Manager::TEXTAREA,
                        'default'     => __( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'shopready-elementor-addon' ),
                        'placeholder' => __( 'Please attempt your purchase again.', 'shopready-elementor-addon' ),
                       
                    ]
                );

                $this->add_control(
                    'woo_ready_thank_you_order_pay_text',
                    [
                        'label'       => __( 'Pay', 'shopready-elementor-addon' ),
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'default'     => __( 'Pay', 'shopready-elementor-addon' ),
                        'placeholder' => __( 'Pay Button', 'shopready-elementor-addon' ),
                       
                    ]
                );

                $this->add_control(
                    'woo_ready_enable_thankyou_fail_myaccount',
                    [
                        'label'        => esc_html__( 'My Account Redirect?', 'shopready-elementor-addon' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                        'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ]
                );

                $this->add_control(
                    'woo_ready_thankyou_fail_redirect_url',
                    [
                        'label' => __( 'My account Custom Link', 'shopready-elementor-addon' ),
                        'type' => \Elementor\Controls_Manager::URL,
                        'label_block' => true,
                        'placeholder' => __( 'https://your-link.com', 'shopready-elementor-addon' ),
                        'condition' => [
                            'woo_ready_enable_thankyou_fail_myaccount' => ['yes']
                        ]
                    ]
                );
        

                $this->add_control(
                    'woo_ready_thank_you_order_fail_myaccount_text',
                    [
                        'label'       => __( 'My Account', 'shopready-elementor-addon' ),
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'default'     => __( 'My Account', 'shopready-elementor-addon' ),
                        'placeholder' => __( 'My Account', 'shopready-elementor-addon' ),
                        'condition' => [
                            'woo_ready_enable_thankyou_fail_myaccount' => ['yes']
                        ]
                       
                    ]
                );

            $this->end_controls_tab();
            $this->end_controls_tabs();
		$this->end_controls_section();
    }
    public function product_compare(){

        $this->start_controls_section(
			'woo_ready_wc_product_compares',
			[
				'label' => esc_html__( 'Product Compare', 'shopready-elementor-addon' ),
				'tab' => $this->get_id(),
			]
		);

            $this->add_control(
                'woo_ready_enable_product_compare',
                [
                    'label'        => esc_html__( 'Product Compare?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'woo_ready_enable_product_compare_template_enable',
                [
                    'label'        => esc_html__( 'Product Compare Template?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition' => [
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );

            $this->add_control(
                'woo_ready_enable_product_compare_template_id',
                [
                    'label' => __( 'PopUp Page Id', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::SELECT2,
                    'multiple' => false,
                    'options' => shop_ready_get_page_list(),
                    'default' => [  ],
                    'condition' => [
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );

            $this->add_control(
                'woo_ready_product_compare_button_text',
                [
                    'label' => __( 'PopUp Page Button Label', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'View Compare', 'shopready-elementor-addon' ),
                    'placeholder' => __( 'View Compare', 'shopready-elementor-addon' ),
                    'condition' => [
                      
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );

            $this->add_control(
                'woo_ready_enable_product_compare_return_button',
                [
                    'label' => __( 'Shop Return Button', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition' => [
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );

            $this->add_control(
                'woo_ready_product_compare_button_shop_text',
                [
                    'label' => __( 'Shop Label', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'Return Shop', 'shopready-elementor-addon' ),
                    'placeholder' => __( 'Return Shop', 'shopready-elementor-addon' ),
                    'condition' => [
                      
                        'woo_ready_product_compare_button_shop_text' => ['yes']
                    ]
                ]
            );

            $this->add_control(
                'woo_ready_product_compare_icon',
                [
                    'label' => __( 'Compare Icon', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fa fa-shopping-cart',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'woo_ready_enable_product_compare_close_button' => [
                            'yes',
                        ],
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );  

            $this->add_control(
                'woo_ready_product_compare_text',
                [
                    'label' => __( 'Compare Text', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '',
                    'placeholder' => __( 'Compare', 'shopready-elementor-addon' ),
                    'condition' => [
                      
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );
           
            $this->add_control(
                'woo_ready_enable_product_compare_close_button',
                [
                    'label'        => __( 'Close?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'shopready-elementor-addon' ),
                    'label_off'    => __( 'Hide', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition' => [
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );

            $this->add_control(
                'woo_ready_product_compare_close_text',
                [
                    'label' => __( 'Close Text', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'Close', 'shopready-elementor-addon' ),
                    'placeholder' => __( 'Close', 'shopready-elementor-addon' ),
                    'condition' => [
                        'woo_ready_enable_product_compare_close_button' => [
                            'yes',
                        ],
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );

            $this->add_control(
                'woo_ready_product_compare_close_icon',
                [
                    'label' => __( 'Close Icon', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'condition' => [
                        'woo_ready_enable_product_compare_close_button' => [
                            'yes',
                        ],
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );
            
            $this->add_control(
                'woo_ready_enable_product_compare_show_heading',
                [
                    'label'        => __( 'Show Heading ?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'shopready-elementor-addon' ),
                    'label_off'    => __( 'Hide', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition' => [
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );


            $this->add_control(
                'woo_ready_product_compare_heading',
                [
                    'label' => __( 'Heading', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'Products Compare', 'shopready-elementor-addon' ),
                    'placeholder' => __( 'Products Compare', 'shopready-elementor-addon' ),
                    'condition' => [
                        'woo_ready_enable_product_compare_show_heading' => [
                            'yes',
                        ],
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );

            
            $this->add_control(
                'woo_ready_product_compare_modal_animation',
                [
                    'label' => __( 'Animation', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'slide-in-bottom',
                    'options' => [
                        'slide-in-bottom'             => __( 'Slide In Bottom', 'shopready-elementor-addon' ),
                        'fade-in-scale'               => __( 'Fade Scale', 'shopready-elementor-addon' ),
                        'slide-in-right'              => __( 'Slide Right', 'shopready-elementor-addon' ),
                        'newspaper'                   => __( 'Newspaper', 'shopready-elementor-addon' ),
                        'fall'                        => __( 'Fall', 'shopready-elementor-addon' ),
                        'slide-fall-in'               => __( 'SLide Fall In', 'shopready-elementor-addon' ),
                        'slide-in-top-stick'          => __( 'Slide In Top', 'shopready-elementor-addon' ),
                        'super-scaled'                => __( 'Super Scale', 'shopready-elementor-addon' ),
                        'just-me'                     => __( 'Just Me', 'shopready-elementor-addon' ),
                        'blur'                        => __( 'Blur', 'shopready-elementor-addon' ),
                        'slide-in-bottom-perspective' => __( 'Slide Bottom Perspective', 'shopready-elementor-addon' ),
                        'slide-in-right-prespective'  => __( 'Slide Right Perspective', 'shopready-elementor-addon' ),
                        'slip-in-top-perspective'     => __( 'Slip Perspective', 'shopready-elementor-addon' ),
                        'threed-flip-horizontal'      => __( '3D Flip Horizontal', 'shopready-elementor-addon' ),
                        'threed-flip-vertical'        => __( '3D Flip Vertical', 'shopready-elementor-addon' ),
                        'threed-sign'                 => __( '3d Sign', 'shopready-elementor-addon' ),
                        'threed-slit'                 => __( '3D Slit', 'shopready-elementor-addon' ),
                        'threed-rotate-bottom'        => __( '3D Rotate Bottom', 'shopready-elementor-addon' ),
                        'threed-rotate-in-left'       => __( '3D Rotate Left', 'shopready-elementor-addon' ),
                    ],
                    'condition' => [
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_cmp_modal_width',
                [
                    'label' => __( 'Width', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-compare-modal' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_cmp_modal_min_width',
                [
                    'label' => __( 'Minimum Width', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-compare-modal' => 'min-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_cmp_modal_max_width',
                [
                    'label' => __( 'Max Width', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-compare-modal' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_cmp_modal_height',
                [
                    'label' => __( 'Height', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-compare-modal' => 'height: {{SIZE}}{{UNIT}};',
                       
                    ],
                    'condition' => [
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_cmp_modal_min_height',
                [
                    'label' => __( 'Minimum Height', 'shopready-elementor-addon' ),
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
                        '{{WRAPPER}} .woo-ready-product-compare-modal' => 'min-height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );
    
            $this->add_control(
                'woo_ready_product_compare_modal_overflow_y',
                [
                    'label' => __( 'Overflow Vertical', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'hidden',
                    'options' => [
                        'hidden'             => __( 'None', 'shopready-elementor-addon' ),
                        'scroll'               => __( 'Scroll', 'shopready-elementor-addon' ),
                      
                    ],
                    'selectors' => [
                        'body .woo-ready-product-compare-modal' => 'overflow-y: {{VALUE}};',
                    ],
                    'condition' => [
                        'woo_ready_enable_product_compare' => ['yes']
                    ]
                ]
            );


		$this->end_controls_section();
    }
    public function product_wishlist(){

        $this->start_controls_section(
			'woo_ready_wc_product_wishlist',
			[
				'label' => esc_html__( 'Shop product WishList', 'shopready-elementor-addon' ),
				'tab' => $this->get_id(),
			]
		);

           

            
            $this->add_control(
                'woo_ready_product_wishlist_layout',
                [
                    'label'        => esc_html__( 'Table Layout?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    
                ]
            );

            $this->add_control(
                'woo_ready_enable_product_wishlist_template_enable',
                [
                    'label'        => esc_html__( 'Product wishlist Template?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                   
                ]
            );

            $this->add_control(
                'woo_ready_enable_product_wishlist_template_id',
                [
                    'label'     => __( 'PopUp Page Id', 'shopready-elementor-addon' ),
                    'type'      => \Elementor\Controls_Manager::SELECT2,
                    'multiple'  => false,
                    'options'   => shop_ready_get_page_list(),
                    'default'   => [],
                   
                ]
            );

            $this->add_control(
                'woo_ready_product_wishlist_button_text',
                [
                    'label'       => __( 'PopUp Page Button Label', 'shopready-elementor-addon' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => __( 'WishList', 'shopready-elementor-addon' ),
                    'placeholder' => __( 'WishList', 'shopready-elementor-addon' ),
                  
                ]
            );

            $this->add_control(
                'woo_ready_enable_product_wishlist_return_button',
                [
                    'label'        => __( 'Shop Return Button', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                   
                ]
            );

            $this->add_control(
                'woo_ready_product_wishlist_button_shop_text',
                [
                    'label'       => __( 'Shop Label', 'shopready-elementor-addon' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => __( 'Return Shop', 'shopready-elementor-addon' ),
                    'placeholder' => __( 'Return Shop', 'shopready-elementor-addon' ),
                  
                ]
            );

            $this->add_control(
                'woo_ready_product_wishlist_icon',
                [
                    'label'     => __( 'Wishlist Icon', 'shopready-elementor-addon' ),
                    'type'      => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fa fa-heart',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'woo_ready_enable_product_wishlist_close_button' => [
                            'yes',
                        ],
                        
                    ]
                ]
            );  

            $this->add_control(
                'woo_ready_product_wishlist_add_to_cart_text',
                [
                    'label'       => __( 'Add To Cart', 'shopready-elementor-addon' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => __( 'Add To Cart', 'shopready-elementor-addon' ),
                    'placeholder' => __( 'Add ', 'shopready-elementor-addon' ),
                   
                ]
            );

          

            $this->add_control(
                'woo_ready_product_wishlist_text',
                [
                    'label'       => __( 'Wishlist Text', 'shopready-elementor-addon' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => '',
                    'placeholder' => __( 'wishlist', 'shopready-elementor-addon' ),
                    
                ]
            );
           
            $this->add_control(
                'woo_ready_enable_product_wishlist_close_button',
                [
                    'label'        => __( 'Close?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'shopready-elementor-addon' ),
                    'label_off'    => __( 'Hide', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    
                ]
            );

            $this->add_control(
                'woo_ready_product_wishlist_close_text',
                [
                    'label'       => __( 'Close Text', 'shopready-elementor-addon' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => __( 'Close', 'shopready-elementor-addon' ),
                    'placeholder' => __( 'Close', 'shopready-elementor-addon' ),
                    'condition'   => [
                        'woo_ready_enable_product_wishlist_close_button' => [
                            'yes',
                        ],
                       
                    ]
                ]
            );

            $this->add_control(
                'woo_ready_product_wishlist_close_icon',
                [
                    'label'     => __( 'Close Icon', 'shopready-elementor-addon' ),
                    'type'      => \Elementor\Controls_Manager::ICONS,
                    'condition' => [
                        'woo_ready_enable_product_wishlist_close_button' => [
                            'yes',
                        ],
                       
                    ]
                ]
            );
            
            $this->add_control(
                'woo_ready_enable_product_wishlist_show_heading',
                [
                    'label'        => __( 'Show Heading ?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'shopready-elementor-addon' ),
                    'label_off'    => __( 'Hide', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                   
                ]
            );


            $this->add_control(
                'woo_ready_product_wishlist_heading',
                [
                    'label'       => __( 'Heading', 'shopready-elementor-addon' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => __( 'Products wishlist', 'shopready-elementor-addon' ),
                    'placeholder' => __( 'Products wishlist', 'shopready-elementor-addon' ),
                    'condition'   => [
                        'woo_ready_enable_product_wishlist_show_heading' => [
                            'yes',
                        ],
                      
                    ]
                ]
            );

            
            $this->add_control(
                'woo_ready_product_wishlist_modal_animation',
                [
                    'label' => __( 'Animation', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'slide-in-bottom',
                    'options' => [
                        'slide-in-bottom'             => __( 'Slide In Bottom', 'shopready-elementor-addon' ),
                        'fade-in-scale'               => __( 'Fade Scale', 'shopready-elementor-addon' ),
                        'slide-in-right'              => __( 'Slide Right', 'shopready-elementor-addon' ),
                        'newspaper'                   => __( 'Newspaper', 'shopready-elementor-addon' ),
                        'fall'                        => __( 'Fall', 'shopready-elementor-addon' ),
                        'slide-fall-in'               => __( 'SLide Fall In', 'shopready-elementor-addon' ),
                        'slide-in-top-stick'          => __( 'Slide In Top', 'shopready-elementor-addon' ),
                        'super-scaled'                => __( 'Super Scale', 'shopready-elementor-addon' ),
                        'just-me'                     => __( 'Just Me', 'shopready-elementor-addon' ),
                        'blur'                        => __( 'Blur', 'shopready-elementor-addon' ),
                        'slide-in-bottom-perspective' => __( 'Slide Bottom Perspective', 'shopready-elementor-addon' ),
                        'slide-in-right-prespective'  => __( 'Slide Right Perspective', 'shopready-elementor-addon' ),
                        'slip-in-top-perspective'     => __( 'Slip Perspective', 'shopready-elementor-addon' ),
                        'threed-flip-horizontal'      => __( '3D Flip Horizontal', 'shopready-elementor-addon' ),
                        'threed-flip-vertical'        => __( '3D Flip Vertical', 'shopready-elementor-addon' ),
                        'threed-sign'                 => __( '3d Sign', 'shopready-elementor-addon' ),
                        'threed-slit'                 => __( '3D Slit', 'shopready-elementor-addon' ),
                        'threed-rotate-bottom'        => __( '3D Rotate Bottom', 'shopready-elementor-addon' ),
                        'threed-rotate-in-left'       => __( '3D Rotate Left', 'shopready-elementor-addon' ),
                    ],
                   
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_wishlist_modal_width',
                [
                    'label' => __( 'Width', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-wishlist-modal' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                  
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_wishlist_modal_min_width',
                [
                    'label' => __( 'Minimum Width', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-wishlist-modal' => 'min-width: {{SIZE}}{{UNIT}};',
                    ]
                
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_wishlist_modal_max_width',
                [
                    'label' => __( 'Max Width', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-wishlist-modal' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                   
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_wishlist_modal_height',
                [
                    'label' => __( 'Height', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-wishlist-modal' => 'height: {{SIZE}}{{UNIT}};',
                       
                    ],
                  
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_wishlist_modal_min_height',
                [
                    'label' => __( 'Minimum Height', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-wishlist-modal' => 'min-height: {{SIZE}}{{UNIT}};',
                    ]
                  
                ]
            );
    
            $this->add_control(
                'woo_ready_product_wishlist_modal_overflow_y',
                [
                    'label' => __( 'Overflow Vertical', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'hidden',
                    'options' => [
                        'hidden'             => __( 'None', 'shopready-elementor-addon' ),
                        'scroll'               => __( 'Scroll', 'shopready-elementor-addon' ),
                      
                    ],
                    'selectors' => [
                        'body .woo-ready-product-wishlist-modal' => 'overflow-y: {{VALUE}};',
                    ]
                  
                ]
            );


		$this->end_controls_section();
    }
    public function product_quickview(){

        $this->start_controls_section(
			'woo_ready_wc_product_quickview',
			[
				'label' => apply_filters( 'shop_ready_product_gl_label', esc_html__( 'product QuickView Pro', 'shopready-elementor-addon' ) ) ,
				'tab' => $this->get_id(),
			]
		);

            $this->add_control(
                'woo_ready_enable_product_quickview',
                [
                    'label'        => esc_html__( 'Shop Quickview?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            
            $this->add_control(
                'woo_ready_product_quickview_layout',
                [
                    'label'        => esc_html__( 'Classic Layout?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition'    => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );

            $this->add_control(
                'woo_ready_enable_product_quickview_template_enable',
                [
                    'label'        => esc_html__( 'product quickview Template?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                    'condition'    => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );

            $this->add_control(
                'woo_ready_enable_product_quickview_template_id',
                [
                    'label'     => __( 'PopUp Page Id', 'shopready-elementor-addon' ),
                    'type'      => \Elementor\Controls_Manager::SELECT2,
                    'multiple'  => false,
                    'options'   => shop_ready_get_page_list(),
                    'default'   => [  ],
                    'condition' => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );

            $this->add_control(
                'woo_ready_product_quickview_button_text',
                [
                    'label'       => __( 'PopUp Page Button Label', 'shopready-elementor-addon' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => __( 'quickview', 'shopready-elementor-addon' ),
                    'placeholder' => __( 'quickview', 'shopready-elementor-addon' ),
                    'condition'   => [
                      
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );


            $this->add_control(
                'woo_ready_product_quickview_icon',
                [
                    'label'     => __( 'QuickView Icon', 'shopready-elementor-addon' ),
                    'type'      => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fa fa-eye',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'woo_ready_enable_product_quickview_close_button' => [
                            'yes',
                        ],
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );  

            $this->add_control(
                'woo_ready_product_quickview_add_to_cart_text',
                [
                    'label'       => __( 'Add To Cart', 'shopready-elementor-addon' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => __( 'Add To Cart', 'shopready-elementor-addon' ),
                    'placeholder' => __( 'Add ', 'shopready-elementor-addon' ),
                    'condition'   => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );

          

            $this->add_control(
                'woo_ready_product_quickview_text',
                [
                    'label'       => __( 'quickview Text', 'shopready-elementor-addon' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => '',
                    'placeholder' => __( 'quickview', 'shopready-elementor-addon' ),
                    'condition'   => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );
           
            $this->add_control(
                'woo_ready_enable_product_quickview_close_button',
                [
                    'label'        => __( 'Close?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'shopready-elementor-addon' ),
                    'label_off'    => __( 'Hide', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition'    => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );

            $this->add_control(
                'woo_ready_product_quickview_close_text',
                [
                    'label'       => __( 'Close Text', 'shopready-elementor-addon' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => __( 'Close', 'shopready-elementor-addon' ),
                    'placeholder' => __( 'Close', 'shopready-elementor-addon' ),
                    'condition'   => [
                        'woo_ready_enable_product_quickview_close_button' => [
                            'yes',
                        ],
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );

            $this->add_control(
                'woo_ready_product_quickview_close_icon',
                [
                    'label'     => __( 'Close Icon', 'shopready-elementor-addon' ),
                    'type'      => \Elementor\Controls_Manager::ICONS,
                    'condition' => [
                        'woo_ready_enable_product_quickview_close_button' => [
                            'yes',
                        ],
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );
            
            $this->add_control(
                'woo_ready_enable_product_quickview_show_heading',
                [
                    'label'        => __( 'Show Heading ?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'shopready-elementor-addon' ),
                    'label_off'    => __( 'Hide', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition' => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );


            $this->add_control(
                'woo_ready_product_quickview_heading',
                [
                    'label'       => __( 'Heading', 'shopready-elementor-addon' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => __( 'Products quickview', 'shopready-elementor-addon' ),
                    'placeholder' => __( 'Products quickview', 'shopready-elementor-addon' ),
                    'condition'   => [
                        'woo_ready_enable_product_quickview_show_heading' => [
                            'yes',
                        ],
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );

            
            $this->add_control(
                'woo_ready_product_quickview_modal_animation',
                [
                    'label' => __( 'Animation', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'slide-in-bottom',
                    'options' => [
                        'slide-in-bottom'             => __( 'Slide In Bottom', 'shopready-elementor-addon' ),
                        'fade-in-scale'               => __( 'Fade Scale', 'shopready-elementor-addon' ),
                        'slide-in-right'              => __( 'Slide Right', 'shopready-elementor-addon' ),
                        'newspaper'                   => __( 'Newspaper', 'shopready-elementor-addon' ),
                        'fall'                        => __( 'Fall', 'shopready-elementor-addon' ),
                        'slide-fall-in'               => __( 'SLide Fall In', 'shopready-elementor-addon' ),
                        'slide-in-top-stick'          => __( 'Slide In Top', 'shopready-elementor-addon' ),
                        'super-scaled'                => __( 'Super Scale', 'shopready-elementor-addon' ),
                        'just-me'                     => __( 'Just Me', 'shopready-elementor-addon' ),
                        'blur'                        => __( 'Blur', 'shopready-elementor-addon' ),
                        'slide-in-bottom-perspective' => __( 'Slide Bottom Perspective', 'shopready-elementor-addon' ),
                        'slide-in-right-prespective'  => __( 'Slide Right Perspective', 'shopready-elementor-addon' ),
                        'slip-in-top-perspective'     => __( 'Slip Perspective', 'shopready-elementor-addon' ),
                        'threed-flip-horizontal'      => __( '3D Flip Horizontal', 'shopready-elementor-addon' ),
                        'threed-flip-vertical'        => __( '3D Flip Vertical', 'shopready-elementor-addon' ),
                        'threed-sign'                 => __( '3d Sign', 'shopready-elementor-addon' ),
                        'threed-slit'                 => __( '3D Slit', 'shopready-elementor-addon' ),
                        'threed-rotate-bottom'        => __( '3D Rotate Bottom', 'shopready-elementor-addon' ),
                        'threed-rotate-in-left'       => __( '3D Rotate Left', 'shopready-elementor-addon' ),
                    ],
                    'condition' => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_quickview_modal_width',
                [
                    'label' => __( 'Width', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-quickview-modal' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_quickview_modal_min_width',
                [
                    'label' => __( 'Minimum Width', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-quickview-modal' => 'min-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_quickview_modal_max_width',
                [
                    'label' => __( 'Max Width', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-quickview-modal' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_quickview_modal_height',
                [
                    'label' => __( 'Height', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-quickview-modal' => 'height: {{SIZE}}{{UNIT}};',
                       
                    ],
                    'condition' => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );

            $this->add_responsive_control(
                'woo_ready_product_quickview_modal_min_height',
                [
                    'label' => __( 'Minimum Height', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-quickview-modal' => 'min-height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );
    
            $this->add_control(
                'woo_ready_product_quickview_modal_overflow_y',
                [
                    'label' => __( 'Overflow Vertical', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'hidden',
                    'options' => [
                        'hidden'             => __( 'None', 'shopready-elementor-addon' ),
                        'scroll'               => __( 'Scroll', 'shopready-elementor-addon' ),
                      
                    ],
                    'selectors' => [
                        'body .woo-ready-product-quickview-modal' => 'overflow-y: {{VALUE}};',
                    ],
                    'condition' => [
                        'woo_ready_enable_product_quickview' => ['yes']
                    ]
                ]
            );


		$this->end_controls_section();
    }
    public function checkout(){

        $this->start_controls_section(
			'woo_ready_wc_checkout_gen',
			[

                'label' => apply_filters( 'shop_ready_product_gl_label', esc_html__( 'Checkout General Pro', 'shopready-elementor-addon' ) ) ,
				'tab' => $this->get_id(),
			]
		);

             
            
            $this->add_control(
                'wr_checkout_terms',
                [
                    'label'        => esc_html__( 'Terms?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

           do_action('shop_ready_checkout_pro_feature_option',$this,'gen');
    

		$this->end_controls_section();
   
    }

    public function payment(){

        $this->start_controls_section(
			'woo_ready_wc_payment_module',
			[

                'label' => apply_filters( 'shop_ready_product_gl_label', esc_html__( 'Payment Pro', 'shopready-elementor-addon' ) ) ,
				'tab' => $this->get_id(),
			]
		);

            $this->add_control(
                'wr_disable_payment_gateway',
                [
                    'label'        => esc_html__( 'Disable Payment?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                ]
            );

            $this->add_control(
                'wr_order_button_text',
                [
                    'label'       => esc_html__( 'Order Button Text', 'shopready-elementor-addon' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => esc_html__( 'Place Order' , 'shopready-elementor-addon' ),
                    'placeholder' => esc_html__( 'Place Order' , 'shopready-elementor-addon' ),
                    'label_block' => true
                ]
            );

            $this->add_control(
                'wr_checkout_order_btn_sep_row',
                [
                    'label'        => esc_html__( 'Button New Line?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                ]
            );

		$this->end_controls_section();
    }

    public function login_register(){

        $this->start_controls_section(
			'woo_ready_account_login',
			[
				'label' => esc_html__( 'Login Register', 'shopready-elementor-addon' ),
				'tab' => $this->get_id(),
			]
		);

	
        $this->add_control(
            'wr_login_redirect_enable',
            [
                'label'        => esc_html__( 'Login Redirect?', 'shopready-elementor-addon' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->add_control(
            'wr_login_redirect',
            [
                'label'       => esc_html__( 'Login Redirect', 'shopready-elementor-addon' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'shopready-elementor-addon' ),
                'condition'   => [
                    'wr_login_redirect_enable' => ['yes']
                ]

            ]
        );

		$this->add_control(
            'wr_banner_title',
            [
                'label'       => esc_html__( 'Banner Title', 'shopready-elementor-addon' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => '',
               

            ]
        );

		$this->end_controls_section();
    }
    
    
    public function modal_wc_popup(){

        $this->start_controls_section(
			'woo_ready_wc_global_modal_popup',
			[
				'label' => apply_filters( 'shop_ready_product_gl_label', esc_html__( 'product Compare Style Pro', 'shopready-elementor-addon' ) ),
				'tab' => $this->get_id(),
			]
		); 
     
      
        $this->start_controls_tabs(
			'woo_ready_wc_modal_pop_up_gen_con'
		);

                
                $this->start_controls_tab(
                    'woo_ready_wc_modal_pop_container',
                    [
                        'label' => esc_html__( 'Container', 'shopready-elementor-addon' ),
                    ]
                );

                    $this->add_control(
                        'woo_ready_wc_modal_pop_overlay_color',
                        [
                            'label' => __( 'Overlay Color', 'shopready-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                          
                            'selectors' => [
                                '{{WRAPPER}} .wready-md-overlay' => 'background: {{VALUE}}',
                            ],
                        ]
                    );

                
                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name'     => 'woo_ready_pop_up_container__border',
                            'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                            'selector' => '.woo-ready-product-compare-modal',
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_container__border__radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'shopready-elementor-addon' ),
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
                                '.woo-ready-product-compare-modal' => 'border-radius : {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                  
        

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_container_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'shopready-elementor-addon' ),
                            'selector' => '.woo-ready-product-compare-modal',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_contain_bgcolor',
                            'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                            'types' => [ 'classic', 'gradient', 'video' ],
                            'selector' => '.woo-ready-product-compare-modal',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'woo_ready_wc_popup_modal_heading',
                    [
                        'label' => esc_html__( 'Heading', 'shopready-elementor-addon' ),
                    ]
                );
                        
                    $this->add_control(
                        'woo_ready_pop_up_title_ctext_align',
                        [
                            'label' => esc_html__( 'Alignment', 'shopready-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'shopready-elementor-addon' ),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'shopready-elementor-addon' ),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'shopready-elementor-addon' ),
                                    'icon' => 'fa fa-align-right',
                                ],
                            ],
                            'default' => 'center',
                            'toggle' => true,
                            'selectors' => [
                                '.woo-ready-product-compare-modal .woo-ready-product-compare-content .wready-md-title' => 'text-align: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_title_color',
                        [
                            'label' => esc_html__( 'Text Color', 'shopready-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '.woo-ready-product-compare-modal .woo-ready-product-compare-content .wready-md-title h3' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_title_font',
                            'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                            'selector' => '.woo-ready-product-compare-modal .wready-md-title h3',
                        ]
                    );

    
                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_title_bgcolor',
                            'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                            'types' => [ 'classic', 'gradient', 'video' ],
                            'selector' => '.woo-ready-product-compare-modal .woo-ready-product-compare-content .wready-md-title',
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_title_margin',
                        [
                            'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.woo-ready-product-compare-modal .wready-md-title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_title_padding',
                        [
                            'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.woo-ready-product-compare-modal .woo-ready-product-compare-content .wready-md-title h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

          
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'woo_ready_wc_popup_modal_body',
                    [
                        'label' => esc_html__( 'Body', 'shopready-elementor-addon' ),
                    ]
                );

                    $this->add_control(
                        'woo_ready_pop_up_container__color',
                        [
                            'label' => esc_html__( 'Text Color', 'shopready-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '.woo-ready-product-compare-modal .woo-ready-product-compare-content .wready-md-body' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_body__font',
                            'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                            'selector' => '.woo-ready-product-compare-modal .wready-md-body',
                        ]
                    );

    
                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_container__bgcolor',
                            'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                            'types' => [ 'classic', 'gradient', 'video' ],
                            'selector' => '.woo-ready-product-compare-modal .woo-ready-product-compare-content .wready-md-body',
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_container__margin',
                        [
                            'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.woo-ready-product-compare-modal .woo-ready-product-compare-content .wready-md-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_container__padding',
                        [
                            'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.woo-ready-product-compare-modal .woo-ready-product-compare-content .wready-md-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'woo_ready_product_cmp_modal_S_hlky_min_width',
                        [
                            'label' => __( 'Width', 'shopready-elementor-addon' ),
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
                                'body .woo-ready-product-compare-modal .woo-ready-product-compare-content' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'woo_ready_enable_product_compare' => ['yes']
                            ]
                        ]
                    );

                    $this->add_responsive_control(
                        'woo_ready_product_cmp_modal_S_hlky_min_height',
                        [
                            'label' => __( 'Height', 'shopready-elementor-addon' ),
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
                                'body .woo-ready-product-compare-modal .woo-ready-product-compare-content' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'woo_ready_enable_product_compare' => ['yes']
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'woo_ready_product_compare_modal__body_overflow_y',
                        [
                            'label' => __( 'Overflow Vertical', 'shopready-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'hidden',
                            'options' => [
                                'hidden' => __( 'None', 'shopready-elementor-addon' ),
                                'scroll' => __( 'Scroll', 'shopready-elementor-addon' ),
                            ],
                            'selectors' => [
                                'body .woo-ready-product-compare-modal .woo-ready-product-compare-content' => 'overflow-y: {{VALUE}};',
                            ],
                            'condition' => [
                                'woo_ready_enable_product_compare' => ['yes']
                            ]
                        ]
                    );

              

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'woo_ready_wc_popup_close_btn',
                    [
                        'label' => esc_html__( 'Close Button', 'shopready-elementor-addon' ),
                    ]
                );

                        $this->add_control(
                            'woo_ready_pop_up_close_btn_color',
                            [
                                'label' => esc_html__( 'Color', 'shopready-elementor-addon' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '.woo-ready-product-compare-modal .wready-md-close' => 'color: {{VALUE}}',
                                ],
                            ]
                        );

                        $this->add_control(
                            'woo_ready_pop_up_close_btn_hover_color',
                            [
                                'label' => esc_html__( 'Hover Color', 'shopready-elementor-addon' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '.woo-ready-product-compare-modal .wready-md-close:hover' => 'color: {{VALUE}}',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Typography::get_type(),
                            [
                                'name' => 'woo_ready_pop_up_close_btn_typography',
                                'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                                'selector' => '.woo-ready-product-compare-modal .wready-md-close',
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Box_Shadow::get_type(),
                            [
                                'name' => 'woo_ready_pop_up_close_btn_box_shadow',
                                'label' => __( 'Box Shadow', 'shopready-elementor-addon' ),
                                'selector' => '.woo-ready-product-compare-modal .wready-md-close',
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Border::get_type(),
                            [
                                'name'     => 'woo_ready_pop_up_close_btn_border',
                                'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                                'selector' => '.woo-ready-product-compare-modal .wready-md-close',
                            ]
                        );

                        $this->add_control(
                            'woo_ready_pop_up_close_btnborder__radius',
                            [
                                'label' => esc_html__( 'Border Radius', 'shopready-elementor-addon' ),
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
                                    '.woo-ready-product-compare-modal .wready-md-close' => 'border-radius : {{SIZE}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_control(
                            'woo_ready_pop_up_close_btn_margin',
                            [
                                'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    '.woo-ready-product-compare-modal .wready-md-close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_control(
                            'woo_ready_pop_up_close_btn_padding',
                            [
                                'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    '.woo-ready-product-compare-modal .wready-md-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Background::get_type(),
                            [
                                'name' => 'woo_ready_pop_up_close_btn_bgcolor',
                                'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                                'types' => [ 'classic', 'gradient', 'video' ],
                                'selector' => '.woo-ready-product-compare-modal .wready-md-close',
                            ]
                        );

                        $this->add_responsive_control(
                            'woo_ready_pop_up_close_btn__position_left',
                            [
                                'label' => esc_html__( 'Position Left', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -3000,
                                        'max' => 3000,
                                        'step' => 5,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                               
                                'selectors' => [
                                    '.woo-ready-product-compare-modal .wready-md-close' => 'left: {{SIZE}}{{UNIT}};',
                                   
                                ],
                            ]
                        );
                
                        $this->add_responsive_control(
                            'woo_ready_pop_up_close_btn__r_position_top',
                            [
                                'label' => esc_html__( 'Position Top', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -3000,
                                        'max' => 3000,
                                        'step' => 5,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                               
                                'selectors' => [
                                    '.woo-ready-product-compare-modal .wready-md-close' => 'top: {{SIZE}}{{UNIT}};',
                                  
                                ],
                            ]
                        );
            
                        $this->add_responsive_control(
                            'woo_ready_pop_up_close_btn__r_position_bottom',
                            [
                                'label' => esc_html__( 'Position Bottom', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -2100,
                                        'max' => 3000,
                                        'step' => 5,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                               
                                'selectors' => [
                                    '.woo-ready-product-compare-modal .wready-md-close' => 'bottom: {{SIZE}}{{UNIT}};',
                                   
                                ],
                            ]
                        );

                        $this->add_responsive_control(
                            'woo_ready_pop_up_close_btn__r_position_right',
                            [
                                'label' => esc_html__( 'Position Right', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -1600,
                                        'max' => 3000,
                                        'step' => 5,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                               
                                'selectors' => [
                                    '.woo-ready-product-compare-modal .wready-md-close' => 'right: {{SIZE}}{{UNIT}};',
                                   
                                ],
                            ]
                        );
            
            

                $this->end_controls_tab();
        
	
		$this->end_controls_tabs();

        
        $this->end_controls_section();
    }

    public function modal_wishlist_popup(){

        $this->start_controls_section(
			'woo_ready_wc_global_modal_wishlist_popup',
			[
		
                'label' => esc_html__( 'Product WishList Style', 'shopready-elementor-addon' ),
				'tab' => $this->get_id(),
			]
		); 

        $this->start_controls_tabs(
			'woo_ready_wc_modal_pop_up_gen_wishlist_add_yu'
		);

            $this->start_controls_tab(
                'woo_ready_wc_modal_pop_wishlist_add_to_cart_tabds',
                [
                    'label' => esc_html__( 'Add To Cart', 'shopready-elementor-addon' ),
                ]
            );

                $this->add_control(
                    'woo_ready_wc_modal_pop_wlist_add_to_cart_color',
                    [
                        'label' => __( 'Color', 'shopready-elementor-addon' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                    
                        'selectors' => [
                            'body .woo-ready-product-wishlist-content .wready-wishlist-column .woo-ready-wishlist-cart-btn' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name' => 'woo_ready_wc_modal_pop_wlist_add_to_cart_wishlist__color',
                        'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                        'selector' => 'body .woo-ready-product-wishlist-content .wready-wishlist-column .woo-ready-wishlist-cart-btn',
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Background::get_type(),
                    [
                        'name' => 'woo_ready_wc_modal_pop_wlist_add_to_cart_background',
                        'label' => __( 'Background', 'shopready-elementor-addon' ),
                        'types' => [ 'classic', 'gradient'],
                        'selector' => 'body .woo-ready-product-wishlist-content .wready-wishlist-column .woo-ready-wishlist-cart-btn',
                    ]
                );
            
                $this->add_group_control(
                    \Elementor\Group_Control_Border::get_type(),
                    [
                        'name'     => 'woo_ready_pop_upadd_to_cart_w_border',
                        'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                        'selector' => 'body .woo-ready-product-wishlist-content .wready-wishlist-column .woo-ready-wishlist-cart-btn',
                    ]
                );

                $this->add_control(
                    'woo_ready_pop_up_container_add_to_cart_w_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'shopready-elementor-addon' ),
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
                            'body .woo-ready-product-wishlist-content .wready-wishlist-column .woo-ready-wishlist-cart-btn' => 'border-radius : {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'woo_ready_pop_up_ttntainer_add_to__box_shadow',
                        'label' => esc_html__( 'Box Shadow', 'shopready-elementor-addon' ),
                        'selector' => 'body .woo-ready-product-wishlist-content .wready-wishlist-column .woo-ready-wishlist-cart-btn',
                    ]
                );

                $this->add_control(
                    'woo_ready_pop_up_container_add_to_cart_w_margin',
                    [
                        'label' => __( 'Margin', 'shopready-elementor-addon' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            'body .woo-ready-product-wishlist-content .wready-wishlist-column .woo-ready-wishlist-cart-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'woo_ready_pop_up_container_add_to_cart_w_padding',
                    [
                        'label' => __( 'Padding', 'shopready-elementor-addon' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            'body .woo-ready-product-wishlist-content .wready-wishlist-column .woo-ready-wishlist-cart-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
        

            $this->end_controls_tab();
            $this->start_controls_tab(
                'woo_ready_wc_modal_pop_wishlist_a_shop_return_tabds',
                [
                    'label' => esc_html__( 'Return Button', 'shopready-elementor-addon' ),
                ]
            );

            
            $this->add_control(
                'woo_ready_wc_modal_pop_wlist_add_to_return_button_cart_color',
                [
                    'label' => __( 'Color', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                
                    'selectors' => [
                        'body .woo-ready-product-wishlist-content  .woo-ready-product-buttons .wready-view-wishlist-return-btn' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'woo_ready_wc_modal_pop_wlist_add_to_return_typo_button_cart_color',
                    'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                    'selector' => 'body .woo-ready-product-wishlist-content  .woo-ready-product-buttons .wready-view-wishlist-return-btn',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'woo_ready_wc_modal_pop_wlist_add_to_return_button_cart_background',
                    'label' => __( 'Background', 'shopready-elementor-addon' ),
                    'types' => [ 'classic', 'gradient'],
                    'selector' => 'body .woo-ready-product-wishlist-content  .woo-ready-product-buttons .wready-view-wishlist-return-btn',
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name'     => 'woo_ready_pop_upadd_to_return_button_cart_w_border',
                    'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                    'selector' => 'body .woo-ready-product-wishlist-content  .woo-ready-product-buttons .wready-view-wishlist-return-btn',
                ]
            );

            $this->add_control(
                'woo_ready_pop_up_container_add_to_return_button_cart_w_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'shopready-elementor-addon' ),
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
                        'body .woo-ready-product-wishlist-content  .woo-ready-product-buttons .wready-view-wishlist-return-btn' => 'border-radius : {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'woo_ready_pop_up_ttntainer_add_to_return_button_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'shopready-elementor-addon' ),
                    'selector' => 'body .woo-ready-product-wishlist-content  .woo-ready-product-buttons .wready-view-wishlist-return-btn',
                ]
            );

            $this->add_control(
                'woo_ready_pop_up_container_add_to_return_button_cart_w_margin',
                [
                    'label' => __( 'Margin', 'shopready-elementor-addon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        'body .woo-ready-product-wishlist-content  .woo-ready-product-buttons .wready-view-wishlist-return-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'woo_ready_pop_up_container_add_to_return_button_cart_w_padding',
                [
                    'label' => __( 'Padding', 'shopready-elementor-addon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        'body .woo-ready-product-wishlist-content  .woo-ready-product-buttons .wready-view-wishlist-return-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    

            $this->end_controls_tab();

            $this->start_controls_tab(
                'woo_ready_wc_modal_pop_wishlist_add_to_cart_tabs_hover',
                [
                    'label' => esc_html__( 'Hover', 'shopready-elementor-addon' ),
                ]
            );

                $this->add_control(
                    'woo_ready_wc_modal_pop_wlist_add_to_cart_color_hv',
                    [
                        'label' => __( 'Color', 'shopready-elementor-addon' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                    
                        'selectors' => [
                            'body .woo-ready-product-wishlist-content .wready-wishlist-column .woo-ready-wishlist-cart-btn:hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Background::get_type(),
                    [
                        'name' => 'woo_ready_wc_modal_pop_wlist_add_to_cart_background_hv',
                        'label' => __( 'Background', 'shopready-elementor-addon' ),
                        'types' => [ 'classic', 'gradient'],
                        'selector' => 'body .woo-ready-product-wishlist-content .wready-wishlist-column .woo-ready-wishlist-cart-btn:hover',
                    ]
                );
            
              

            $this->end_controls_tab();

        $this->end_controls_tabs();
      
        $this->start_controls_tabs(
			'woo_ready_wc_modal_pop_up_gen_wishlist_con'
		);

                
                $this->start_controls_tab(
                    'woo_ready_wc_modal_pop_wishlist_container',
                    [
                        'label' => esc_html__( 'Container', 'shopready-elementor-addon' ),
                    ]
                );

                    $this->add_control(
                        'woo_ready_wc_modal_pop_wlist_overlay_color',
                        [
                            'label' => __( 'Overlay Color', 'shopready-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                          
                            'selectors' => [
                                '{{WRAPPER}} .wready-md-overlay' => 'background: {{VALUE}}',
                            ],
                        ]
                    );

                
                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name'     => 'woo_ready_pop_up_container_w_border',
                            'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                            'selector' => '.woo-ready-product-wishlist-modal',
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_container__border_w_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'shopready-elementor-addon' ),
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
                                '.woo-ready-product-wishlist-modal' => 'border-radius : {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                  
        

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_container_box_wshadow',
                            'label' => esc_html__( 'Box Shadow', 'shopready-elementor-addon' ),
                            'selector' => '.woo-ready-product-wishlist-modal',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_containw_bgcolor',
                            'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                            'types' => [ 'classic', 'gradient', 'video' ],
                            'selector' => '.woo-ready-product-wishlist-modal',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'woo_ready_wc_popup_modalw_heading',
                    [
                        'label' => esc_html__( 'Heading', 'shopready-elementor-addon' ),
                    ]
                );
                        
                    $this->add_control(
                        'woo_ready_pop_up_title_wtext_align',
                        [
                            'label' => esc_html__( 'Alignment', 'shopready-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'shopready-elementor-addon' ),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'shopready-elementor-addon' ),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'shopready-elementor-addon' ),
                                    'icon' => 'fa fa-align-right',
                                ],
                            ],
                            'default' => 'center',
                            'toggle' => true,
                            'selectors' => [
                                '.woo-ready-product-wishlist-modal .woo-ready-product-wishlist-content .wready-md-title' => 'text-align: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_upw_title_color',
                        [
                            'label' => esc_html__( 'Text Color', 'shopready-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '.woo-ready-product-wishlist-modal .woo-ready-product-wishlist-content .wready-md-title h3' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_titlew_font',
                            'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                            'selector' => '.woo-ready-product-wishlist-modal .wready-md-title h3',
                        ]
                    );

    
                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_titlew_bgcolor',
                            'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                            'types' => [ 'classic', 'gradient', 'video' ],
                            'selector' => '.woo-ready-product-wishlist-modal .woo-ready-product-wishlist-content .wready-md-title',
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_titlew_margin',
                        [
                            'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.woo-ready-product-wishlist-modal .wready-md-title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_title_wpadding',
                        [
                            'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.woo-ready-product-wishlist-modal .woo-ready-product-wishlist-content .wready-md-title h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

          
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'woo_ready_wc_popup_modal_wbody',
                    [
                        'label' => esc_html__( 'Body', 'shopready-elementor-addon' ),
                    ]
                );

                    $this->add_control(
                        'woo_ready_pop_up_container_wishlist_color',
                        [
                            'label' => esc_html__( 'Text Color', 'shopready-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '.woo-ready-product-wishlist-modal .woo-ready-product-wishlist-content .wready-md-body' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_body_w_font',
                            'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                            'selector' => '.woo-ready-product-wishlist-modal .wready-md-body',
                        ]
                    );

    
                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_container_w_bgcolor',
                            'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                            'types' => [ 'classic', 'gradient', 'video' ],
                            'selector' => '.woo-ready-product-wishlist-modal .woo-ready-product-wishlist-content .wready-md-body',
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_container_w_margin',
                        [
                            'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.woo-ready-product-wishlist-modal .woo-ready-product-wishlist-content .wready-md-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_container_w_padding',
                        [
                            'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.woo-ready-product-wishlist-modal .woo-ready-product-wishlist-content .wready-md-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

              

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'woo_ready_wishlist_popupw_close_btn',
                    [
                        'label' => esc_html__( 'Close Button', 'shopready-elementor-addon' ),
                    ]
                );

                        $this->add_control(
                            'woo_ready_pop_up_close_btn_wishlist_color',
                            [
                                'label' => esc_html__( 'Color', 'shopready-elementor-addon' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '.woo-ready-product-wishlist-modal .wready-md-close' => 'color: {{VALUE}}',
                                ],
                            ]
                        );

                        $this->add_control(
                            'woo_ready_pop_up_close_btnw_hoverw_color',
                            [
                                'label' => esc_html__( 'Hover Color', 'shopready-elementor-addon' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '.woo-ready-product-wishlist-modal .wready-md-close:hover' => 'color: {{VALUE}}',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Typography::get_type(),
                            [
                                'name' => 'woo_ready_pop_up_closew_btnw_typography',
                                'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                                'selector' => '.woo-ready-product-wishlist-modal .wready-md-close',
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Box_Shadow::get_type(),
                            [
                                'name' => 'woo_ready_pop_up_closew_btn_boxs_shadow',
                                'label' => __( 'Box Shadow', 'shopready-elementor-addon' ),
                                'selector' => '.woo-ready-product-wishlist-modal .wready-md-close',
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Border::get_type(),
                            [
                                'name'     => 'woo_ready_pop_up_closew_btn_border',
                                'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                                'selector' => '.woo-ready-product-wishlist-modal .wready-md-close',
                            ]
                        );

                        $this->add_control(
                            'woo_ready_pop_up_closew_btnborder_w_radius',
                            [
                                'label' => esc_html__( 'Border Radius', 'shopready-elementor-addon' ),
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
                                    '.woo-ready-product-wishlist-modal .wready-md-close' => 'border-radius : {{SIZE}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_control(
                            'woo_ready_pop_up_closew_btnw_margin',
                            [
                                'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    '.woo-ready-product-wishlist-modal .wready-md-close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_control(
                            'woo_ready_pop_up_closew_btn_padding',
                            [
                                'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    '.woo-ready-product-wishlist-modal .wready-md-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Background::get_type(),
                            [
                                'name' => 'woo_ready_pop_upw_close_btn_bgcolor',
                                'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                                'types' => [ 'classic', 'gradient', 'video' ],
                                'selector' => '.woo-ready-product-wishlist-modal .wready-md-close',
                            ]
                        );

                        $this->add_responsive_control(
                            'woo_ready_pop_up_closew_btn_w_position_left',
                            [
                                'label' => esc_html__( 'Position Left', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -3000,
                                        'max' => 3000,
                                        'step' => 5,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                               
                                'selectors' => [
                                    '.woo-ready-product-wishlist-modal .wready-md-close' => 'left: {{SIZE}}{{UNIT}};',
                                   
                                ],
                            ]
                        );
                
                        $this->add_responsive_control(
                            'woo_ready_pop_up_closew_btn_wish_r_position_top',
                            [
                                'label' => esc_html__( 'Position Top', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -3000,
                                        'max' => 3000,
                                        'step' => 5,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                               
                                'selectors' => [
                                    '.woo-ready-product-wishlist-modal .wready-md-close' => 'top: {{SIZE}}{{UNIT}};',
                                  
                                ],
                            ]
                        );
            
                        $this->add_responsive_control(
                            'woo_ready_pop_up_closew_btn__wish_position_bottom',
                            [
                                'label' => esc_html__( 'Position Bottom', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -2100,
                                        'max' => 3000,
                                        'step' => 5,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                               
                                'selectors' => [
                                    '.woo-ready-product-wishlist-modal .wready-md-close' => 'bottom: {{SIZE}}{{UNIT}};',
                                   
                                ],
                            ]
                        );

                        $this->add_responsive_control(
                            'woo_ready_pop_up_closew_btn__wishlist_position_right',
                            [
                                'label' => esc_html__( 'Position Right', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -1600,
                                        'max' => 3000,
                                        'step' => 5,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                               
                                'selectors' => [
                                    '.woo-ready-product-wishlist-modal .wready-md-close' => 'right: {{SIZE}}{{UNIT}};',
                                   
                                ],
                            ]
                        );
            
            

                $this->end_controls_tab();
        
	
		$this->end_controls_tabs();

        
        $this->end_controls_section();
    }
    public function modal_quickview_popup(){

        $this->start_controls_section(
			'woo_ready_wc_global_modal_quickview_popup',
			[

                'label' => apply_filters( 'shop_ready_product_gl_label', esc_html__( 'product Quickview Style Pro', 'shopready-elementor-addon' ) ) ,
				'tab' => $this->get_id(),
			]
		); 
     
      
        $this->start_controls_tabs(
			'woo_ready_wc_modal_pop_up_gen_quickview_con'
		);

                
                $this->start_controls_tab(
                    'woo_ready_wc_modal_pop_quickview_container',
                    [
                        'label' => esc_html__( 'Container', 'shopready-elementor-addon' ),
                    ]
                );

                    $this->add_control(
                        'woo_ready_wc_modal_pop_quickview_overlay_color',
                        [
                            'label' => __( 'Overlay Color', 'shopready-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                          
                            'selectors' => [
                                '{{WRAPPER}} .wready-md-overlay.quickview' => 'background: {{VALUE}}',
                            ],
                        ]
                    );

                
                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name'     => 'woo_ready_pop_up_container_quickview_border',
                            'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                            'selector' => '.woo-ready-product-quickview-modal',
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_container__border_quickview_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'shopready-elementor-addon' ),
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
                                '.woo-ready-product-quickview-modal' => 'border-radius : {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                  
        

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_container_box_quickviewshadow',
                            'label' => esc_html__( 'Box Shadow', 'shopready-elementor-addon' ),
                            'selector' => '.woo-ready-product-quickview-modal',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_containwquickview_bgcolor',
                            'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                            'types' => [ 'classic', 'gradient', 'video' ],
                            'selector' => '.woo-ready-product-quickview-modal',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'woo_ready_wc_popup_modalwquickview_heading',
                    [
                        'label' => esc_html__( 'Heading', 'shopready-elementor-addon' ),
                    ]
                );
                        
                    $this->add_control(
                        'woo_ready_pop_up_title_quickviewtext_align',
                        [
                            'label' => esc_html__( 'Alignment', 'shopready-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'shopready-elementor-addon' ),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'shopready-elementor-addon' ),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'shopready-elementor-addon' ),
                                    'icon' => 'fa fa-align-right',
                                ],
                            ],
                            'default' => 'center',
                            'toggle' => true,
                            'selectors' => [
                                '.woo-ready-product-quickview-modal .woo-ready-product-quickview-content .wready-md-title' => 'text-align: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_upquickview_title_color',
                        [
                            'label' => esc_html__( 'Text Color', 'shopready-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '.woo-ready-product-quickview-modal .woo-ready-product-quickview-content .wready-md-title h3' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_titlequickview_font',
                            'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                            'selector' => '.woo-ready-product-quickview-modal .wready-md-title h3',
                        ]
                    );

    
                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_title_quickview_bgcolor',
                            'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                            'types' => [ 'classic', 'gradient', 'video' ],
                            'selector' => '.woo-ready-product-quickview-modal .woo-ready-product-quickview-content .wready-md-title',
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_title_quickview_margin',
                        [
                            'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.woo-ready-product-quickview-modal .wready-md-title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_title_quickviewpadding',
                        [
                            'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.woo-ready-product-quickview-modal .woo-ready-product-quickview-content .wready-md-title h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

          
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'woo_ready_wc_popup_modal_quickviewbody',
                    [
                        'label' => esc_html__( 'Body', 'shopready-elementor-addon' ),
                    ]
                );

                    $this->add_control(
                        'woo_ready_pop_up_container_quickview_color',
                        [
                            'label' => esc_html__( 'Text Color', 'shopready-elementor-addon' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '.woo-ready-product-quickview-modal .woo-ready-product-quickview-content .wready-md-body' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_body_quickview_font',
                            'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                            'selector' => '.woo-ready-product-quickview-modal .wready-md-body',
                        ]
                    );

    
                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'woo_ready_pop_up_container_quickview_bgcolor',
                            'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                            'types' => [ 'classic', 'gradient', 'video' ],
                            'selector' => '.woo-ready-product-quickview-modal .woo-ready-product-quickview-content .wready-md-body',
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_container_quickviewmargin',
                        [
                            'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.woo-ready-product-quickview-modal .woo-ready-product-quickview-content .wready-md-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'woo_ready_pop_up_container_quickviewpadding',
                        [
                            'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.woo-ready-product-quickview-modal .woo-ready-product-quickview-content .wready-md-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

              

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'woo_ready_quickview_popupquickviewclose_btn',
                    [
                        'label' => esc_html__( 'Close Button', 'shopready-elementor-addon' ),
                    ]
                );

                        $this->add_control(
                            'woo_ready_pop_up_close_btn_quickview_color',
                            [
                                'label' => esc_html__( 'Color', 'shopready-elementor-addon' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '.woo-ready-product-quickview-modal .wready-md-close' => 'color: {{VALUE}}',
                                ],
                            ]
                        );

                        $this->add_control(
                            'woo_ready_pop_up_close_btnw_hoverquickview_color',
                            [
                                'label' => esc_html__( 'Hover Color', 'shopready-elementor-addon' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '.woo-ready-product-quickview-modal .wready-md-close:hover' => 'color: {{VALUE}}',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Typography::get_type(),
                            [
                                'name' => 'woo_ready_pop_up_closew_btquickview_typography',
                                'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                                'selector' => '.woo-ready-product-quickview-modal .wready-md-close',
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Box_Shadow::get_type(),
                            [
                                'name' => 'woo_ready_pop_up_closew_btn_boxquickviewhadow',
                                'label' => __( 'Box Shadow', 'shopready-elementor-addon' ),
                                'selector' => '.woo-ready-product-quickview-modal .wready-md-close',
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Border::get_type(),
                            [
                                'name'     => 'woo_ready_pop_up_closequickviewbtn_border',
                                'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                                'selector' => '.woo-ready-product-quickview-modal .wready-md-close',
                            ]
                        );

                        $this->add_control(
                            'woo_ready_pop_up_closew_btnborder_quickview_radius',
                            [
                                'label' => esc_html__( 'Border Radius', 'shopready-elementor-addon' ),
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
                                    '.woo-ready-product-quickview-modal .wready-md-close' => 'border-radius : {{SIZE}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_control(
                            'woo_ready_pop_up_closew_btnquickview_margin',
                            [
                                'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    '.woo-ready-product-quickview-modal .wready-md-close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_control(
                            'woo_ready_pop_up_closequickview_btn_padding',
                            [
                                'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    '.woo-ready-product-quickview-modal .wready-md-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Background::get_type(),
                            [
                                'name' => 'woo_ready_pop_upquickview_close_btn_bgcolor',
                                'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                                'types' => [ 'classic', 'gradient', 'video' ],
                                'selector' => '.woo-ready-product-quickview-modal .wready-md-close',
                            ]
                        );

                        $this->add_responsive_control(
                            'woo_ready_pop_up_closew_btn_quickview_position_left',
                            [
                                'label' => esc_html__( 'Position Left', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -3000,
                                        'max' => 3000,
                                        'step' => 5,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                               
                                'selectors' => [
                                    '.woo-ready-product-quickview-modal .wready-md-close' => 'left: {{SIZE}}{{UNIT}};',
                                   
                                ],
                            ]
                        );
                
                        $this->add_responsive_control(
                            'woo_ready_pop_up_closew_btn_wish_quickview_position_top',
                            [
                                'label' => esc_html__( 'Position Top', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -3000,
                                        'max' => 3000,
                                        'step' => 5,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                               
                                'selectors' => [
                                    '.woo-ready-product-quickview-modal .wready-md-close' => 'top: {{SIZE}}{{UNIT}};',
                                  
                                ],
                            ]
                        );
            
                        $this->add_responsive_control(
                            'woo_ready_pop_up_closew_btn__quickview_position_bottom',
                            [
                                'label' => esc_html__( 'Position Bottom', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -2100,
                                        'max' => 3000,
                                        'step' => 5,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                               
                                'selectors' => [
                                    '.woo-ready-product-quickview-modal .wready-md-close' => 'bottom: {{SIZE}}{{UNIT}};',
                                   
                                ],
                            ]
                        );

                        $this->add_responsive_control(
                            'woo_ready_pop_up_closew_btn__quickview_position_right',
                            [
                                'label' => esc_html__( 'Position Right', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -1600,
                                        'max' => 3000,
                                        'step' => 5,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                               
                                'selectors' => [
                                    '.woo-ready-product-quickview-modal .wready-md-close' => 'right: {{SIZE}}{{UNIT}};',
                                   
                                ],
                            ]
                        );
            
            

                $this->end_controls_tab();
        
	
		$this->end_controls_tabs();

        
        $this->end_controls_section();
    }

	/**
	 * Should check for the current action to avoid infinite loop
	 * when updating options like: "wr_login_redirect" and "wr_login_redirect_enable".
	*/
    public function on_save( $data ) {
       
		if (
			! isset( $data['settings'])
		) {
			return;
		}

        $grid_style = 'wooready_products_archive_shop_grid_style';

        if( isset( $data[ 'settings' ][ $grid_style ] ) ){
          
           update_option( $grid_style , $data[ 'settings' ][ $grid_style ] );
        }
     
	}

    public function get_additional_tab_content(){

        // use this for notice 
        // as a helper link
        // docs 
        return sprintf( '
				<div class="woo-ready-account-module elementor-nerd-box">
                <a class="elementor-button elementor-button-success elementor-nerd-box-link" target="_blank" href="#"> Account Module </a>
				</div>
				'

			);
    }

	    /**
     * Checkout Address Fields
     * @since 1.0
     * @param string type ex: billing | shipping
     * @param string item col ex: label | required | priority | autocomplete | class as array
     * @defs woocommerce
     * @return array
     */
    function shop_ready_get_wc_checkout_address_fields($type = 'billing',$col = 'label'){
        
        $fields_with_label = [];
       
        try{

            $checkout = WC()->checkout;
            if( isset( $checkout->checkout_fields ) ){
               
                if( isset($checkout->checkout_fields[$type]) && is_array($checkout->checkout_fields[$type]) ){
                    foreach($checkout->checkout_fields[$type] as $key => $item ){
                        $fields_with_label[$key] = $item[$col];
                    }
                
                    return $fields_with_label;
                }
    
            }
            
        }catch (\Exception $e) {
            wc_add_notice(esc_html__('Checkout not Init','shopready-elementor-addon'));
        }
      
        return $fields_with_label;
    }
}
