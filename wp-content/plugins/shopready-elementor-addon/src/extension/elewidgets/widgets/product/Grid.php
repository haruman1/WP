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
 * WooCommerce Product grid | Name
 * @see https://docs.woocommerce.com/document/managing-products/
 * @author quomodosoft.com
 */
class Grid extends \Shop_Ready\extension\elewidgets\Widget_Base {
    
	
    /**
	 * Html Wrapper Class of html 
	 */
	public $wrapper_class = false;

	protected function register_controls() {

			  // Notice 
              $this->start_controls_section(
                'product_shortcode_options',
                [
                    'label' => __( 'Product Options', 'shopready-elementor-addon' ),
                ]
            );
    
            $this->add_control(
              'product_ids',
              [
                'label' => __( "Product ID's", 'shopready-elementor-addon' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
              ]
            );
    
            $this->add_control(
                'product_categories', [
                'label' => esc_html__('Product Categories', 'shopready-elementor-addon'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => shop_ready_get_terms_list('product_cat', 'slug'),
            ]);
    
            $this->add_control(
                'product_tags', [
                'label' => esc_html__('Product Tags', 'shopready-elementor-addon'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => shop_ready_get_terms_list('product_tag', 'slug'),
            ]);
    
            $this->add_control(
                'products_count',
                [
                    'label' => __( 'Products Count', 'shopready-elementor-addon' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 4,
                    'min' => 1,
                    'max' => 1000,
                    'step' => 1,
                ]
            );
     
            $this->add_responsive_control(
                'products_columns',
                [
                    'label' => __( 'Products Columns', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '3',
                    'options' => [

                        '1' => __( '1', 'shopready-elementor-addon' ),
                        '2' => __( '2', 'shopready-elementor-addon' ),
                        '3' => __( '3', 'shopready-elementor-addon' ),
                        '4' => __( '4', 'shopready-elementor-addon' ),
                        '5' => __( '5', 'shopready-elementor-addon' ),
                        '6' => __( '6', 'shopready-elementor-addon' ),
                        '7' => __( '7', 'shopready-elementor-addon' ),
                        '8' => __( '8', 'shopready-elementor-addon' ),
                        '' => __( 'None', 'shopready-elementor-addon' ),
                
                    ],

                    'selectors' => [
                        '{{WRAPPER}} .woo-ready-products' => 'grid-template-columns:repeat({{VALUE}}, 1fr);',
                    ],
                ]
            );
    
            $this->add_control(
                'product_filter',
                [
                    'label' => esc_html__('Filter By', 'shopready-elementor-addon'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'recent-products',
                    'options' => [
                        'recent-products'       => esc_html__('Recent Products', 'shopready-elementor-addon'),
                        'featured-products'     => esc_html__('Featured Products', 'shopready-elementor-addon'),
                        'best-selling-products' => esc_html__('Best Selling Products', 'shopready-elementor-addon'),
                        'sale-products'         => esc_html__('Sale Products', 'shopready-elementor-addon'),
                        'top-products'          => esc_html__('Top Rated Products', 'shopready-elementor-addon'),
                    ],
                ]
            );
    
            $this->add_control(
                'product_orderby',
                [
                    'label' => esc_html__('Order By', 'shopready-elementor-addon'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'date',
                    'options' => [
                        'id'         => __('Product ID', 'shopready-elementor-addon'),
                        'title'      => __('Product Title', 'shopready-elementor-addon'),
                        'date'       => __('Date', 'shopready-elementor-addon'),
                        'menu_order' => __('Menu Order', 'shopready-elementor-addon'),
                        'popularity' => __('Popularity', 'shopready-elementor-addon'),
                        'rand'       => __('Random', 'shopready-elementor-addon'),
                        'rating'     => __('Product Rating', 'shopready-elementor-addon'),
                    ],
                ]
            );
    
            $this->add_control(
                'product_skus',
                [
                    'label' => esc_html__('Product SKUs', 'shopready-elementor-addon'),
                    'type' => Controls_Manager::SELECT2,
                    'multiple' => true,
                    'options' => shop_ready_get_product_sku(),
                ]
            );
    
            $this->add_control(
                'order', 
                [
                    'label' => __('Order', 'shopready-elementor-addon'),
                    'type' => Controls_Manager::SELECT2,
                    'options' => [
                        'ASC' => 'Ascending',
                        'DESC' => 'Descending',
                    ],
                    'default' => 'DESC',
                ]
            );
    
            $this->add_control(
                'product_onsale',
                [
                    'label' => __( 'Onsale', 'shopready-elementor-addon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'shopready-elementor-addon' ),
                    'label_off' => __( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'product_top_rated',
                                'operator' => '!=',
                                'value' => 'yes',
                            ],
                            [
                                'name' => 'product_best_selling',
                                'operator' => '!=',
                                'value' => 'yes'
                            ],
                        ],
                    ],
                ]
            );
    
            $this->add_control(
                'product_best_selling',
                [
                    'label' => __( 'Best Selling', 'shopready-elementor-addon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'shopready-elementor-addon' ),
                    'label_off' => __( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'product_onsale',
                                'operator' => '!=',
                                'value' => 'yes',
                            ],
                            [
                                'name' => 'product_top_rated',
                                'operator' => '!=',
                                'value' => 'yes'
                            ],
                        ],
                    ],
                ]
            );
    
            $this->add_control(
                'product_top_rated',
                [
                    'label' => __( 'Top Rated', 'shopready-elementor-addon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'shopready-elementor-addon' ),
                    'label_off' => __( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'product_onsale',
                                'operator' => '!=',
                                'value' => 'yes',
                            ],
                            [
                                'name' => 'product_best_selling',
                                'operator' => '!=',
                                'value' => 'yes'
                            ],
                        ],
                    ],
                ]
            );
    
            $this->add_control(
                'product_pagination',
                [
                    'label' => __( 'Pagination', 'shopready-elementor-addon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'shopready-elementor-addon' ),
                    'label_off' => __( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
    
            $this->add_control(
                'product_custom_class',
                [
                  'label' => __( "Custom wrapper class", 'shopready-elementor-addon' ),
                  'type' => Controls_Manager::TEXT,
                  'label_block' => true,
                ]
              );

              $this->end_controls_section();

              $this->start_controls_section(
                'woo_ready_product_grid_style_settings',
                [
                    'label' => esc_html__('General', 'shopready-elementor-addon'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
              );

              $this->add_responsive_control(
                'product_result_count_display',
                [
                    'label'   => esc_html__( 'Result Display', 'shopready-elementor-addon' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => esc_html__( 'block', 'shopready-elementor-addon' ),
                    'options' => [
                        'block'        => esc_html__( 'Block', 'shopready-elementor-addon' ),
                        'none'         => esc_html__( 'none', 'shopready-elementor-addon' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce p.woocommerce-result-count' => 'display: {{VALUE}};',
                    ],
                    'condition'       => [
                        'product_pagination' => 'yes',
                    ],
                ]
            );

            $this->add_responsive_control(
                'product_grid_woocommerce_ordering_display',
                [
                    'label'   => esc_html__( 'Ordering Display', 'shopready-elementor-addon' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => esc_html__( 'block', 'shopready-elementor-addon' ),
                    'options' => [
                        'block'        => esc_html__( 'Block', 'shopready-elementor-addon' ),
                        'none'         => esc_html__( 'none', 'shopready-elementor-addon' ),
                    ],
                    'condition'       => [
                        'product_pagination' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce .shop-ready--grid-ordering' => 'display: {{VALUE}};',
                    ],
                ]
            );

         
    
            $this->end_controls_section();

            $this->box_css(
                [
                    'title'          => esc_html__('Thumbnail Contents','shopready-elementor-addon'),
                    'slug'           => 'wready_product_grid_thumb_contents',
                    'element_name'   => '_wready_product_grid_thumb_contents',
                    'selector'       => '{{WRAPPER}} .wooready_product_thumb',
                ]
            );

            $this->element_size(
                [
                    'title'          => esc_html__('Product Image','shopready-elementor-addon'),
                    'slug'           => 'wready_product_grid_image_size',
                    'element_name'   => '_wready_product_grid_image_size',
                    'selector'       => '{{WRAPPER}} .wooready_product_thumb  .attachment-woocommerce_thumbnail',
                ]
            );

            $this->box_css(
                [
                    'title'          => esc_html__('Thumbnail Box Overlay','shopready-elementor-addon'),
                    'slug'           => 'wready_product_grid_thumb_overlay',
                    'element_name'   => '_wready_product_grid_thumb_overlay',
                    'selector'       => '{{WRAPPER}} .wooready_product_thumb .wooready_product_thumb_overlay',
                ]
            );

            $this->box_css(
                [
                    'title'          => esc_html__('Thumbnail List Wrapper','shopready-elementor-addon'),
                    'slug'           => 'wready_product_grid_thumb_list_wrapper',
                    'element_name'   => '_wready_product_grid_thumb_list_wrapper',
                    'selector'       => '{{WRAPPER}} .wooready_product_thumb .wooready_product_thumb_overlay .wooready_list ul',
                ]
            );

            $this->text_css(
                [
                    'title'          => esc_html__('Thumbnail List Icon','shopready-elementor-addon'),
                    'slug'           => 'wready_product_grid_thumb_list_icon',
                    'element_name'   => '_wready_product_grid_thumb_star_list_icon',
                    'selector'       => '{{WRAPPER}} .wooready_product_thumb .wooready_product_thumb_overlay .wooready_list ul li a',
                    'hover_selector' => '{{WRAPPER}} .wooready_product_thumb .wooready_product_thumb_overlay .wooready_list ul li a:hover',
                ]
            );

            $this->text_minimum_css(
                [
                    'title'          => esc_html__('Sale Style','shopready-elementor-addon'),
                    'slug'           => 'wready_product_grid_sale_style',
                    'element_name'   => '_wready_product_grid_sale_style',
                    'selector'       => '{{WRAPPER}} .wooready_product_thumb .wooready_sell_discount',
                    'hover_selector' => '{{WRAPPER}} .wooready_product_thumb .wooready_sell_discount:hover',
                ]
            );

            $this->position_css(
                [
                    'title'          => esc_html__('Sale Position','shopready-elementor-addon'),
                    'slug'           => 'wready_product_grid_sale_position',
                    'element_name'   => '_wready_product_grid_sale_position',
                    'selector'       => '{{WRAPPER}} .wooready_product_thumb .wooready_sell_discount',
                ]
            );

            $this->box_css(
                [
                    'title'          => esc_html__('Thumb Overly','shopready-elementor-addon'),
                    'slug'           => 'wready_product_grid_thumb_overly',
                    'element_name'   => '_wready_product_grid_thumb_overly',
                    'selector'       => '{{WRAPPER}} .wooready_product_thumb_overlay',
                ]
            );

            $this->box_css(
                [
                    'title'          => esc_html__('Product Content','shopready-elementor-addon'),
                    'slug'           => 'wready_product_grid_content',
                    'element_name'   => '_wready_product_grid_content_wrapper',
                    'selector'       => '{{WRAPPER}} .wooready_product_content_box',
                    'hover_selector' => '{{WRAPPER}} .wooready_product_content_box:hover',
                ]
            );

            $this->text_minimum_css(
                [
                    'title'          => esc_html__('Star Rating','shopready-elementor-addon'),
                    'slug'           => 'wready_product_grid_star_rating',
                    'element_name'   => '_wready_product_grid_star_rating_style',
                    'selector'       => '{{WRAPPER}} .wooready_review',
                    'hover_selector' => '{{WRAPPER}} .wooready_review:hover',
                ]
            );

            $this->text_minimum_css(
                [
                    'title'          => esc_html__('Product Title','shopready-elementor-addon'),
                    'slug'           => 'wready_product_grid_title',
                    'element_name'   => '_wready_product_grid_title_style',
                    'selector'       => '{{WRAPPER}} .woocommerce-loop-product__title,{{WRAPPER}} .woo-ready-single-product .wready-loop-product__title a, {{WRAPPER}} .wooready_title .title a',
                    'hover_selector' => '{{WRAPPER}} .woocommerce-loop-product__title:hover,{{WRAPPER}} .woo-ready-single-product .wready-loop-product__title:hover a, {{WRAPPER}} .wooready_title title a:hover',
                ]
            );

            $this->box_css(
                [
                    'title'          => esc_html__('Price Box','shopready-elementor-addon'),
                    'slug'           => 'woooready_product_grid_product_price_box',
                    'element_name'   => '_wooready_product_grid_product_price_box_style',
                    'selector'       => '{{WRAPPER}} .wooready_price_box',
                    'hover_selector' => '{{WRAPPER}} .wooready_price_box:hover',
                ]
            );

            $this->text_minimum_css(
                [
                    'title'          => esc_html__('Price Normal','shopready-elementor-addon'),
                    'slug'           => 'wready_product_grid_product_price_normal',
                    'element_name'   => '_wready_product_grid_product_price_normall',
                    'selector'       => '{{WRAPPER}} .wooready_price_box .wooready_price_normal',
                    'hover_selector' => '{{WRAPPER}} .wooready_price_box:hover .wooready_price_normal',
                ]
            );

            $this->text_minimum_css(
                [
                    'title'          => esc_html__('Price Discount','shopready-elementor-addon'),
                    'slug'           => 'wready_product_grid_product_price_discount',
                    'element_name'   => '_wready_product_grid_product_price_discountt',
                    'selector'       => '{{WRAPPER}} .wooready_price_box .wooready_price_discount',
                    'hover_selector' => '{{WRAPPER}} .wooready_price_box:hover .wooready_price_discount',
                ]
            );

            $this->box_css(
                [
                    'title'          => esc_html__('Product Sold Wrapper','shopready-elementor-addon'),
                    'slug'           => 'wready_product_sold_wrapper',
                    'element_name'   => '_wready_product_sold_wrapperr',
                    'selector'       => '{{WRAPPER}} .wooready_product_layout_3 .wooready_product_content_box .wooready_product_sold_range',
                ]
            );

            $this->text_css(
                [
                    'title'          => esc_html__('Sold Text','shopready-elementor-addon'),
                    'slug'           => 'wready_product_sold_text',
                    'element_name'   => '_wready_product_sold_textt',
                    'selector'       => '{{WRAPPER}} .wooready_product_content_box .wooready_product_sold_range .wooready_product_sold_count',
                    'hover_selector' => false,
                ]
            );

            $this->box_css(
                [
                    'title'          => esc_html__('Sold Range Box','shopready-elementor-addon'),
                    'slug'           => 'wready_product_range_box',
                    'element_name'   => '_wready_product_range_boxx',
                    'selector'       => '{{WRAPPER}} .wooready_product_content_box .wooready_product_sold_range .wooready_range',
                ]
            );

            $this->box_css(
                [
                    'title'          => esc_html__('Pagination Wrapper','shopready-elementor-addon'),
                    'slug'           => 'wready_product_pagenation_wrapper',
                    'element_name'   => '_wready_product_pagenation_wrapperr',
                    'selector'       => '{{WRAPPER}} .woocommerce nav.woocommerce-pagination',
                ]
            );

            $this->text_css(
                [
                    'title'          => esc_html__('Pagination Item','shopready-elementor-addon'),
                    'slug'           => 'wready_product_pagenation_item',
                    'element_name'   => '_wready_product_pagenation_itemm',
                    'selector'       => '{{WRAPPER}} .woocommerce nav.woocommerce-pagination ul li a.page-numbers',
                    'hover_selector' => '{{WRAPPER}} .woocommerce nav.woocommerce-pagination ul li a.page-numbers:hover',
                ]
            );

            $this->text_minimum_css(
                [
                    'title'          => esc_html__('Pagination Item Active','shopready-elementor-addon'),
                    'slug'           => 'wready_product_pagenation_item_active',
                    'element_name'   => '_wready_product_pagenation_itemm_active',
                    'selector'       => '{{WRAPPER}} .woocommerce nav.woocommerce-pagination ul li span.page-numbers',
                    'hover_selector' => false,
                ]
            );

            $this->start_controls_section(
                '_align_shop_ready__content_section',
                [
                    'label' => __( 'Align Content', 'shopready-elementor-addon' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_responsive_control(
                'shop_ready_products_archive_shop_grid_ui_alignment_element',
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
                        ''              => esc_html__( 'None', 'shopready-elementor-addon' ),
                    ],
                  
                    'selectors' => [
                        'body {{WRAPPER}} .wooready_product_content_box' => 'justify-content: {{VALUE}} !important;',
                        'body {{WRAPPER}} .wooready_price_box'           => 'justify-content: {{VALUE}} !important;',
                        
                        'body {{WRAPPER}} .wooready_product_color'       => 'justify-content: {{VALUE}} !important;',
                    ],
                ]
    
            );

            $this->add_responsive_control(
                'shop_ready_products_archive_shop_grid_ui_alignment_text_element',
                [
                    'label'     => esc_html__( 'Text Alignment', 'shopready-elementor-addon' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'default'   => '',
                    'options'   => [

                        'left'   => esc_html__( 'Left', 'shopready-elementor-addon' ),
                        'right'  => esc_html__( 'Right', 'shopready-elementor-addon' ),
                        'center' => esc_html__( 'Center', 'shopready-elementor-addon' ),
                        'inherit' => esc_html__( 'Inherit', 'shopready-elementor-addon' ),
                        '' => esc_html__( 'None', 'shopready-elementor-addon' ),
                     
                    ],
                  
                    'selectors' => [
                        'body {{WRAPPER}} .wooready_product_content_box' => 'text-align: {{VALUE}} !important;',
                        'body {{WRAPPER}} .wooready_price_box'           => 'align-items: {{VALUE}} !important;',
                        'body {{WRAPPER}} .wooready_price_box'           => 'justify-content: {{VALUE}} !important;',
                        
                    ],
                ]
    
            );

            $this->end_controls_section();

            $this->start_controls_section(
                '_align_shop_ready_order_content_section',
                [
                    'label' => __( 'Order Content', 'shopready-elementor-addon' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );

                $this->add_responsive_control(
                    'shop_ready_products_archive_shop_grid_order_title_element',
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
                      
                    ]
                );
                
                $this->add_responsive_control(
                    'shop_ready_products_archive_shop_grid_order_priceelement',
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
                       
                    ]
                );

                $this->add_responsive_control(
                    'shop_ready_products_archive_shop_grid_order_review_element',
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
                      
                    ]
                ); 
                
                $this->add_responsive_control(
                    'shop_ready_products_archive_shop_grid_order_color_element',
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
                      
                    ]
                ); 
                
                $this->add_responsive_control(
                    'shop_ready_products_archive_shop_grid_order_range_element',
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
                      
                    ]
                ); 
                
                
                $this->add_responsive_control(
                    'shop_ready_products_archive_shop_grid_order_image_element',
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
                     
                    ]
                );

            $this->end_controls_section();

		
	}

    /**
	 * Override By elementor render method
	 * @return void
	 * 
	 */
	protected function html() {

		if (!function_exists('WC')) {
            return;
        }

		$settings = $this->get_settings_for_display();
    
        $attr_array = [
            "limit"        => $settings['products_count'] ? $settings['products_count'] : -1,
            "columns"      => 3,
            "ids"          => $settings['product_ids'],
            "category"     => $settings['product_categories'],
            "tag"          => $settings['product_tags'],
            "skus"         => $settings['product_skus'],
            "paginate"     => ( $settings['products_count'] > 0 && $settings['product_pagination'] == "yes" ) ? true : false,
            "on_sale"      => ( $settings['product_onsale'] == "yes" ) ? true : false,
            "best_selling" => ( $settings['product_best_selling'] == "yes" ) ? true : false,
            "top_rated"    => ( $settings['product_top_rated'] == "yes" ) ? true : false,
            "orderby"      => $settings['product_orderby'],
            "order"        => $settings['order'],
            "class"        => $settings['product_custom_class'],
        ];

        $shortcode = "[products " . shop_ready_attr_to_shortcide($attr_array) . "]";
   
        ?>
		<div data-page-count="<?php echo esc_attr($settings['products_count']); ?>" class="elementor-shortcode shop-ready-ajax-product-wrapper"><?php echo do_shortcode( shortcode_unautop( $shortcode ) ); ?></div>
		<?php
	}

}