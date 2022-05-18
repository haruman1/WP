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
* Site Common Settings
* @since 1.0 
*/

class Common_Settings extends Tab_Base {

	public function get_id() {
		return 'shop-ready-common';
	}

	public function get_title() {
		return esc_html__( 'ShopReady Common', 'shopready-elementor-addon' );
	}

	public function get_group() {
		return 'settings';
	}

	public function get_icon() {
		return 'eicon-woo-settings';
	}

	public function get_help_url() {
		return 'quomodosoft.com';
	}

	protected function register_tab_controls() {
       
       $this->theme_fixing();
	   $this->global_wc_notice();
       $this->common_button();
       $this->empty_cart();

       do_action('shop_ready_common/settings/style', $this , $this->get_id());


	}

    public function theme_fixing(){
        $this->start_controls_section(
			'shop_ready_theme_template_override_section',
			[
				'label' => esc_html__( 'Theme Template Override', 'shopready-elementor-addon' ),
				'tab' => $this->get_id(),
			]
		);  

            $this->add_control(
                'shop_ready_theme_template_override_enable',
                [
                    'label'        => esc_html__( 'Enable?', 'shopready-elementor-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
                    'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

        $this->end_controls_section();
    }

    
     /**
      * WooCommerce global Notice 
      * Cart , Checkout where missing notice widgets by Shop ready
      * @see https://docs.woocommerce.com/document/woocommerce-shortcodes/#section-21
      */
      public function global_wc_notice(){

        $this->start_controls_section(
			'woo_ready_wc_global_gen_notice',
			[
				'label' => esc_html__( 'WooCommerce Notice', 'shopready-elementor-addon' ),
				'tab' => $this->get_id(),
			]
		); 
        // .woocommerce-notices-wrapper
        // .woocommerce-error
        // .woocommerce-message
      
        $this->start_controls_tabs(
			'woo_ready_notice_glb_style_tab'
		);

		$this->start_controls_tab(
			'woo_ready_notice_success_message_tab',
			[
				'label' => esc_html__( 'Success', 'shopready-elementor-addon' ),
			]
		);

            $this->add_control(
                'woo_ready_glolal_wc_icon_color_mtd_color',
                [
                    'label' => esc_html__( 'Icon Color', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        'body .woocommerce-message::before' => 'color: {{VALUE}}',
                    ],
                ]
            );


            $this->add_control(
                'woo_ready_glolal_wc_mtd_color',
                [
                    'label' => esc_html__( 'Color', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        'body .woocommerce-message' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'woo_ready_glolal_wc_mtd__link_color',
                [
                    'label' => esc_html__( 'link Color', 'shopready-elementor-addon' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        'body .woocommerce-message a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'woo_ready_global_wc_mtd_content_typography',
                    'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                    'selector' => '.woocommerce-message',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name'     => 'woo_ready_global_wc_mtd_border',
                    'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                    'selector' => '.woocommerce-message',
                ]
            );

            $this->add_control(
                'woo_ready_global_wc_mtd__border__radius',
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
                        '.woocommerce-message' => 'border-radius : {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'woo_ready_global_wc_mtd__margin',
                [
                    'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '.woocommerce-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'woo_ready_global_wc_mtd__padding',
                [
                    'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '.woocommerce-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
  
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'woo_ready_global_wc_mtd_bgcolor',
                    'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '.woocommerce-message',
                ]
            );
  

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'woo_ready_global_wc_succ_content_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'shopready-elementor-addon' ),
                    'selector' => '.woocommerce-message',
                ]
            );

		$this->end_controls_tab();

        $this->start_controls_tab(
			'woo_ready_notice_success_button_message_tab',
			[
				'label' => esc_html__( 'Button', 'shopready-elementor-addon' ),
			]
		);

        $this->add_control(
            'woo_ready_glolal_wc_mtd_button_link_color',
            [
                'label' => esc_html__( 'Color', 'shopready-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link' => 'color: {{VALUE}}',
                ],
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'woo_ready_global_wc_mtd_content_button_typography',
                'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                'selector' => 'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'woo_ready_global_wc_mtd_button_border',
                'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                'selector' => 'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link',
            ]
        );

        $this->add_control(
            'woo_ready_global_wc_mtd__border_button_radius',
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
                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link' => 'border-radius : {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'woo_ready_global_wc_mtd_button_margin',
            [
                'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'woo_ready_global_wc_mtd_button_padding',
            [
                'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'woo_ready_global_wc_mtd_button_bgcolor',
                'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => 'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link',
            ]
        );

		$this->end_controls_tab();

        $this->start_controls_tab(
			'woo_ready_notice_success_button_message_hover_tab',
			[
				'label' => esc_html__( 'Button Hover', 'shopready-elementor-addon' ),
			]
		);

        $this->add_control(
            'woo_ready_glolal_wc_mtd_button_hover_link_color',
            [
                'label' => esc_html__( 'Color', 'shopready-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover' => 'color: {{VALUE}}',
                ],
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'woo_ready_global_wc_mtd_content_button_hover_typography',
                'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                'selector' => 'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'woo_ready_global_wc_mtd_button_hover_border',
                'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                'selector' => 'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover',
            ]
        );

        $this->add_control(
            'woo_ready_global_wc_mtd__border_button_hover_radius',
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
                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover' => 'border-radius : {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'woo_ready_global_wc_mtd_button_hover_margin',
            [
                'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'woo_ready_global_wc_mtd_button_hover_padding',
            [
                'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'woo_ready_global_wc_mtd_hover_button_bgcolor',
                'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => 'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover',
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'woo_ready_notice_eror_list_tab',
			[
				'label' => esc_html__( 'Error msg', 'shopready-elementor-addon' ),
			]
		);

        $this->add_control(
            'woo_ready_glolal_wc_err_color',
            [
                'label' => esc_html__( 'Color', 'shopready-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '.woocommerce-error' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'woo_ready_global_wc_err_content_typography',
                'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                'selector' => '.woocommerce-error',
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'woo_ready_global_wc_err_content_box_shadow',
				'label' => __( 'Box Shadow', 'shopready-elementor-addon' ),
				'selector' => '.woocommerce-error',
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'woo_ready_global_wc_err_border',
                'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                'selector' => '.woocommerce-error',
            ]
        );

        $this->add_control(
            'woo_ready_global_wc_err__border__radius',
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
                    '.woocommerce-error' => 'border-radius : {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'woo_ready_global_wc_err__margin',
            [
                'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '.woocommerce-error' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'woo_ready_global_wc_mtd_err_padding',
            [
                'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '.woocommerce-error' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'woo_ready_global_wc_mtderr_bgcolor',
                'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '.woocommerce-error',
            ]
        );

		$this->end_controls_tab();
        
		$this->start_controls_tab(
			'woo_ready_notice_wrappers___tab',
			[
				'label' => esc_html__( 'Wrapper', 'shopready-elementor-addon' ),
			]
		);

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name'     => 'woo_ready_global_wc_wrapper_border',
                    'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                    'selector' => '.woocommerce-notices-wrapper:not(:empty)',
                ]
            );

            $this->add_control(
                'woo_ready_global_wc_wrapper__border__radius',
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
                        '.woocommerce-notices-wrapper:not(:empty)' => 'border-radius : {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'woo_ready_global_wc_wrapper__margin',
                [
                    'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '.woocommerce-notices-wrapper:not(:empty)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'woo_ready_global_wc_mtd_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '.woocommerce-notices-wrapper:not(:empty)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );


            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'woo_ready_global_wc_mtd_wrapper_bgcolor',
                    'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '.woocommerce-notices-wrapper:not(:empty)',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'woo_ready_global_wc_wrapper_content_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'shopready-elementor-addon' ),
                    'selector' => '.woocommerce-notices-wrapper:not(:empty)',
                ]
            );

		$this->end_controls_tab();

		$this->end_controls_tabs();

        
        $this->end_controls_section();
    }
    public function common_button(){

        $this->start_controls_section(
			'shop_ready_wc_comon_style',
			[
				'label' => esc_html__( 'Buttons', 'shopready-elementor-addon' ),
				'tab' => $this->get_id(),
			]
		); 

   
            $this->start_controls_tabs(
                'shop_ready_common_settings___style_tab'
            );

                    $this->start_controls_tab(
                        'shop_ready_common_button_n_style_tab',
                        [
                            'label' => esc_html__( 'Normal', 'shopready-elementor-addon' ),
                        ]
                    );


                        $this->add_control(
                            'shop_ready_common_wc_button_color',
                            [
                                'label' => esc_html__( 'Color', 'shopready-elementor-addon' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link , .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button' => 'color: {{VALUE}}',
                                ],
                            ]
                        );
   
                        $this->add_group_control(
                            \Elementor\Group_Control_Typography::get_type(),
                            [
                                'name' => 'shop_ready_common_button_mtd_content_typography',
                                'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                                'selector' => 'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link,.woocommerce input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button',
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Border::get_type(),
                            [
                                'name'     => 'shop_ready_common_button_wc_mtd_border',
                                'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                                'selector' => 'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link,.woocommerce input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button',
                            ]
                        );

                        $this->add_control(
                            'shop_ready_common_button__border__radius',
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
                                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link,.woocommerce input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button' => 'border-radius : {{SIZE}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_control(
                            'shop_ready_common_button_mtd__margin',
                            [
                                'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link,.woocommerce input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_control(
                            'shop_ready_common_button_wc_mtd__padding',
                            [
                                'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link,.woocommerce input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );
  
                        $this->add_group_control(
                            \Elementor\Group_Control_Background::get_type(),
                            [
                                'name' => 'shop_ready_common_button_wc_mtd_bgcolor',
                                'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                                'types' => [ 'classic', 'gradient', 'video' ],
                                'selector' => 'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link,.woocommerce input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button',
                            ]
                        );
  

                        $this->add_group_control(
                            \Elementor\Group_Control_Box_Shadow::get_type(),
                            [
                                'name' => 'shop_ready_common_button_wc_succ_content_box_shadow',
                                'label' => esc_html__( 'Box Shadow', 'shopready-elementor-addon' ),
                                'selector' => 'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link,.woocommerce input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button',
                            ]
                        );

		            $this->end_controls_tab();

                    $this->start_controls_tab(
                        'shop_ready_common_button_button_hover_tab',
                        [
                            'label' => esc_html__( 'Hover', 'shopready-elementor-addon' ),
                        ]
                    );

                        $this->add_control(
                            'shop_ready_common_wc_mtd_button_link_color',
                            [
                                'label' => esc_html__( 'Color', 'shopready-elementor-addon' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '.woocommerce input.button:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover' => 'color: {{VALUE}}',
                                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover' => 'color: {{VALUE}}',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Typography::get_type(),
                            [
                                'name' => 'shop_ready_common_wc_mtd_content_button_typography',
                                'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                                'selector' => 'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover',
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Border::get_type(),
                            [
                                'name'     => 'shop_ready_common_wc_wc_mtd_button_border',
                                'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                                'selector' => 'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover',
                            ]
                        );

                        $this->add_control(
                            'shop_ready_common_wcwc_mtd__border_button_radius',
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
                                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover' => 'border-radius : {{SIZE}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_control(
                            'shop_ready_common_wc_mtd_button_margin',
                            [
                                'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_control(
                            'shop_ready_common_wc_mtd_button_padding',
                            [
                                'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Background::get_type(),
                            [
                                'name' => 'shop_ready_common_wc_mtd_button_bgcolor',
                                'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                                'types' => [ 'classic', 'gradient', 'video' ],
                                'selector' => 'body .woocommerce-product-page-notice-wrapper .woocommerce-message .shop-rady-cart-view-link:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover',
                            ]
                        );

                     $this->end_controls_tab();
      
		     $this->end_controls_tabs();

        
        $this->end_controls_section();
    }
    public function empty_cart(){

        $this->start_controls_section(
			'shop_ready_wc_comon_empty_cart_style',
			[
				'label' => esc_html__( 'Empty Cart', 'shopready-elementor-addon' ),
				'tab' => $this->get_id(),
			]
		); 

   
            $this->start_controls_tabs(
                'shop_ready_common_settings_empty_cart__style_tab'
            );

                    $this->start_controls_tab(
                        'shop_ready_common_empty_cart_icon_n_style_tab',
                        [
                            'label' => esc_html__( 'Icon & Text', 'shopready-elementor-addon' ),
                        ]
                    );


                        $this->add_control(
                            'shop_ready_common_empty_cart_icon_color',
                            [
                                'label' => esc_html__( 'Icon Color', 'shopready-elementor-addon' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    'body .woocommerce .cart-empty.woocommerce-info::before' => 'color: {{VALUE}}',
                                ],
                            ]
                        );

                        $this->add_control(
                            'shop_ready_common_empty_cart_text_color',
                            [
                                'label' => esc_html__( 'Text Color', 'shopready-elementor-addon' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    'body .woocommerce .cart-empty.woocommerce-info' => 'color: {{VALUE}}',
                                ],
                            ]
                        );
   
   
                        $this->add_group_control(
                            \Elementor\Group_Control_Typography::get_type(),
                            [
                                'name' => 'shop_ready_common_cart_empty_text_mtd_content_typography',
                                'label' => esc_html__( 'Typography', 'shopready-elementor-addon' ),
                                'selector' => 'body .woocommerce .cart-empty.woocommerce-info',
                            ]
                        );

                        $this->add_responsive_control(
                            'shop_ready_common_cart_empty_text_mtd_content__text_element',
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
                                    'body .woocommerce .cart-empty.woocommerce-info' => 'text-align: {{VALUE}};',
                                   
                                ],
                            ]
                
                        );

                        $this->add_responsive_control(
                            'shop_ready_common_cart_empty_text_mtd_content_left_icon_position',
                            [
                                'label' => esc_html__( 'Icon Position Left', 'shopready-elementor-addon' ),
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
                                    'body .woocommerce .cart-empty.woocommerce-info::before' => 'left: {{SIZE}}{{UNIT}};',
                                   
                                ],
                            ]
                        );

                        $this->add_responsive_control(
                            'shop_ready_common_cart_empty_text_mtd_content_right_icon_position',
                            [
                                'label' => esc_html__( 'Icon Position Right', 'shopready-elementor-addon' ),
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
                                    'body .woocommerce .cart-empty.woocommerce-info::before' => 'right: {{SIZE}}{{UNIT}};',
                                   
                                ],
                            ]
                        );

                        $this->add_responsive_control(
                            'shop_ready_common_cart_empty_text_mtd_content_top_icon_position',
                            [
                                'label' => esc_html__( 'Icon Position Top', 'shopready-elementor-addon' ),
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
                                    'body .woocommerce .cart-empty.woocommerce-info::before' => 'top: {{SIZE}}{{UNIT}};',
                                   
                                ],
                            ]
                        );



		            $this->end_controls_tab();

                    $this->start_controls_tab(
                        'shop_ready_common_empty_cart_container_n_style_tab',
                        [
                            'label' => esc_html__( 'Container', 'shopready-elementor-addon' ),
                        ]
                    );



                        $this->add_group_control(
                            \Elementor\Group_Control_Background::get_type(),
                            [
                                'name' => 'shop_ready_common_empty_cart_container_bgcolor',
                                'label' => esc_html__( 'Background', 'shopready-elementor-addon' ),
                                'types' => [ 'classic', 'gradient', 'video' ],
                                'selector' => 'body .woocommerce .cart-empty.woocommerce-info',
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Box_Shadow::get_type(),
                            [
                                'name' => 'shop_ready_common_empty_cart_containerbos_shadowr',
                                'label' => esc_html__( 'Box Shadow', 'shopready-elementor-addon' ),
                                'selector' => 'body .woocommerce .cart-empty.woocommerce-info',
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Border::get_type(),
                            [
                                'name'     => 'shop_ready_common_empty_cart_etxt_border',
                                'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
                                'selector' => 'body .woocommerce .cart-empty.woocommerce-info',
                            ]
                        );

                        $this->add_control(
                            'shop_ready_common_empty_cart_text_border__radius',
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
                                    'body .woocommerce .cart-empty.woocommerce-info' => 'border-radius : {{SIZE}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_control(
                            'shop_ready_common_empty_cart_etxt_mtd__margin',
                            [
                                'label' => esc_html__( 'Margin', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    'body .woocommerce .cart-empty.woocommerce-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_control(
                            'shop_ready_common_empty_cart_text_wc_mtd__padding',
                            [
                                'label' => esc_html__( 'Padding', 'shopready-elementor-addon' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    'body .woocommerce .cart-empty.woocommerce-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

	}

    public function get_additional_tab_content(){}
 

}
