<?php


namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class jupiter_Price_Table_Widget extends Widget_Base {

    public function get_name() {
        return 'jupiter-pricing-table-addons';
    }
    
    public function get_title() {
        return __( 'Pricing Table', 'jupitercore' );
    }

    public function get_icon() {
        return 'eicon-price-table';
    }
    public function get_categories() {
        return [ 'jupiter-addons' ];
    }

    protected function _register_controls() {

        // Features tab start
        $this->start_controls_section(
            'jupiter_pricing_description',
            [
                'label' => __( 'Price Box', 'jupitercore' ),
            ]
        );
           
            $this->add_control(
                'pricing_top_title',
                [
                    'label' => __( 'Top Title', 'jupitercore' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Top Title', 'jupitercore' ),
                    'default' => __( '1 User', 'jupitercore' ),
                    'title' => __( 'Top Title', 'jupitercore' ),
                ]
            );
           
            $this->add_control(
                'pricing_title',
                [
                    'label' => __( 'Title', 'jupitercore' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Title', 'jupitercore' ),
                    'default' => __( 'Regular Plan', 'jupitercore' ),
                    'title' => __( 'Title', 'jupitercore' ),
                ]
            );
        
            $this->add_control(
                'price_amount',
                [
                    'label'   => esc_html__( 'Price', 'jupitercore' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => '$19.99',
                ]
            );        
        
            $this->add_control(
                'price_content_editor',
                [
                    'label' => __( 'Description','jupitercore' ),
                    'type' => Controls_Manager::WYSIWYG,
                    'default' => __( 'No extra hidden charge. All vat Included.','jupitercore' ),
                ]
            );
        
            $this->add_control(
                'price_button_text',
                [
                    'label'   => esc_html__( 'Button Text', 'jupitercore' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Purchase Now', 'jupitercore' ),
                ]
            );

            $this->add_control(
                'jupiter_button_link',
                [
                    'label'       => __( 'Link', 'jupitercore' ),
                    'type'        => Controls_Manager::URL,
                    'placeholder' => 'http://your-link.com',
                    'default'     => [
                        'url' => '#',
                    ],
                ]
            );

        $this->end_controls_section(); // button Fields tab end



        // Feature Style tab section
        $this->start_controls_section(
            'jupiter_price_style_section',
            [
                'label' => __( 'Box Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('price_box_style_tab');
        $this->start_controls_tab( 'price_box_normal',
            [
                'label' => __( 'Normal', 'jupitercore' ),
            ]
        );
        
        $this->add_responsive_control(
            'price_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'price_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '30',
                    'right' => '30',
                    'bottom' => '30',
                    'left' => '30',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'price_background',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .price-box',
            ]
        );

        $this->add_responsive_control(
            'price_text_align',
            [
                'label' => __( 'Alignment', 'jupitercore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'jupitercore' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'jupitercore' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'jupitercore' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'jupitercore' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'price_border',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .price-box',
            ]
        );
        $this->add_responsive_control(
            'price_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'default' => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                    'isLinked' => false
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'price_box_shadow',
                'label' => __( 'Box Shadow', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .price-box',
            ]
        );

        
        $this->add_control(
            'price_box_transform',
            [
                'label' => __( 'Transform', 'jupitercore' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'translateY(0)',
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'transform: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'price_box_transition',
            [
                'label' => __( 'Transition Duration', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.3,
                ],
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );
        $this->end_controls_tab();

             
        // Hover Style tab Start
        $this->start_controls_tab(
            'price_box_hover',
            [
                'label' => __( 'Hover', 'jupitercore' ),
            ]
        );
                
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'price_hover_background',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .price-box:hover',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'price_border_hover',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .price-box:hover',
            ]
        );
        $this->add_responsive_control(
            'price_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .price-box:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'default' => [
                    'top' => '3',
                    'right' => '3',
                    'bottom' => '3',
                    'left' => '3',
                    'isLinked' => false
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'price_box_hover_shadow',
                'label' => __( 'Box Shadow', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .price-box:hover',
            ]
        );
        $this->add_control(
            'price_box_hover_transform',
            [
                'label' => __( 'Transform', 'jupitercore' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'translateY(0)',
                'selectors' => [
                    '{{WRAPPER}} .price-box:hover' => 'transform: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab(); // Hover Style tab end        
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section(); // Feature Box section style end
        
        

        // Features style tab start
        $this->start_controls_section(
            'jupitercore_top_title_style',
            [
                'label'     => __( 'Top Title', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'pricing_top_title_item_color',
                [
                    'label'     => __( 'Color', 'jupitercore' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#56607D',
                    'selectors' => [
                        '{{WRAPPER}} .price-box .price-top-title' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'pricing_top_title_item_typography',
                    'selector' => '{{WRAPPER}} .price-box .price-top-title',
                ]
            );

            $this->add_responsive_control(
                'pricing_top_title_item_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '0',
                        'right' => '0',
                        'bottom' => '0',
                        'left' => '0',
                        'isLinked' => false
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .price-box .price-top-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'pricing_top_title_item_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '0',
                        'right' => '0',
                        'bottom' => '15',
                        'left' => '0',
                        'isLinked' => false
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .price-box .price-top-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );
           $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'pricing_top_title_background',
                    'label' => __( 'Background', 'jupitercore' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .price-box .price-top-title',
                ]
            );
        
        $this->end_controls_section(); // Features style tab end
        

        // Features style tab start
        $this->start_controls_section(
            'jupitercore_title_style',
            [
                'label'     => __( 'Title', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'pricing_title_item_color',
                [
                    'label'     => __( 'Color', 'jupitercore' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#0F1D46',
                    'selectors' => [
                        '{{WRAPPER}} .price-box .price-title' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'pricing_title_item_typography',
                    'selector' => '{{WRAPPER}} .price-box .price-title',
                ]
            );

            $this->add_responsive_control(
                'pricing_title_item_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '0',
                        'right' => '0',
                        'bottom' => '0',
                        'left' => '0',
                        'isLinked' => false
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .price-box .price-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'pricing_title_item_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '0',
                        'right' => '0',
                        'bottom' => '30',
                        'left' => '0',
                        'isLinked' => false
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .price-box .price-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );
           $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'pricing_title_background',
                    'label' => __( 'Background', 'jupitercore' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .price-box .price-title',
                ]
            );
        
        $this->end_controls_section(); // Features style tab end
        
        
        // Features style tab start
        $this->start_controls_section(
            'jupitercore_description_style',
            [
                'label'     => __( 'Description', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'pricing_description_item_color',
                [
                    'label'     => __( 'Color', 'jupitercore' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#56607D',
                    'selectors' => [
                        '{{WRAPPER}} .price-box .price-desc' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'pricing_description_item_typography',
                    'selector' => '{{WRAPPER}} .price-box .price-desc',
                ]
            );

            $this->add_responsive_control(
                'pricing_description_item_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '0',
                        'right' => '0',
                        'bottom' => '0',
                        'left' => '0',
                        'isLinked' => false
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .price-box .price-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'pricing_description_item_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                   'default' => [
                        'top' => '0',
                        'right' => '0',
                        'bottom' => '50',
                        'left' => '0',
                        'isLinked' => false
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .price-box .price-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );
           $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'pricing_description_background',
                    'label' => __( 'Background', 'jupitercore' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .price-box .price-desc',
                ]
            );
        
        $this->end_controls_section(); // Features style tab end
        
        
        
        // Features style tab start
        $this->start_controls_section(
            'jupitercore_amount_style',
            [
                'label'     => __( 'Amount', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'pricing_amount_item_color',
                [
                    'label'     => __( 'Color', 'jupitercore' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#B181FF',
                    'selectors' => [
                        '{{WRAPPER}} .price-box .price-amount' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'pricing_amount_item_typography',
                    'selector' => '{{WRAPPER}} .price-box .price-amount',
                ]
            );

            $this->add_responsive_control(
                'pricing_amount_item_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '0',
                        'right' => '0',
                        'bottom' => '0',
                        'left' => '0',
                        'isLinked' => false
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .price-box .price-amount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'pricing_amount_item_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '0',
                        'right' => '0',
                        'bottom' => '60',
                        'left' => '0',
                        'isLinked' => false
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .price-box .price-amount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );
           $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'pricing_amount_background',
                    'label' => __( 'Background', 'jupitercore' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .price-box .price-amount',
                ]
            );
        
        $this->end_controls_section(); // Features style tab end
        
        
        // button style tab start
        $this->start_controls_section(
            'jupitercore_pricing_button_style',
            [
                'label'     => __( 'Button', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'pricing_button_style_tabs');

                // Pricing Normal tab start
                $this->start_controls_tab(
                    'style_pricing_normal_tab',
                    [
                        'label' => __( 'Normal', 'jupitercore' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'pricing_button_background',
                            'label' => __( 'Background', 'jupitercore' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .price-box a.el-button',
                        ]
                    );

                    $this->add_control(
                        'pricing_button_color',
                        [
                            'label'     => __( 'Color', 'jupitercore' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .price-box a.el-button' => 'color: {{VALUE}}',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name'     => 'pricing_button_typography',
                            'selector' => '{{WRAPPER}} .price-box a.el-button',
                        ]
                    );

                    $this->add_responsive_control(
                        'pricing_button_padding',
                        [
                            'label' => __( 'Padding', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'default' => [
                                'top' => '18',
                                'right' => '50',
                                'bottom' => '18',
                                'left' => '50',
                                'isLinked' => false
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .price-box a.el-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ]
                    );

                    $this->add_responsive_control(
                        'pricing_button_margin',
                        [
                            'label' => __( 'Margin', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .price-box a.el-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'pricing_button_border',
                            'label' => __( 'Border', 'jupitercore' ),
                            'selector' => '{{WRAPPER}} .price-box a.el-button',
                        ]
                    );

                    $this->add_responsive_control(
                        'pricing_button_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,                            
                            'size_units' => [ 'px', '%', 'em' ],
                            'default' => [
                                'top' => '5',
                                'right' => '5',
                                'bottom' => '5',
                                'left' => '5',
                                'isLinked' => false
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .price-box a.el-button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                   $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'pricing_table_button_shadow',
                            'label' => __( 'Box Shadow', 'jupitercore' ),
                            'selector' => '{{WRAPPER}} .price-box a.el-button',
                        ]
                    );
                $this->end_controls_tab(); // Pricing Normal tab end

                // Pricing Hover tab start
                $this->start_controls_tab(
                    'style_pricing_hover_tab',
                    [
                        'label' => __( 'Hover', 'jupitercore' ),
                    ]
                );
                    $this->add_control(
                        'pricing_button_hover_color',
                        [
                            'label'     => __( 'Color', 'jupitercore' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .price-box a.el-button:hover' => 'color: {{VALUE}}',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_ov_position',
                        [
                            'label' => __( 'Effect Position', 'jupitercore' ),
                            'type' => Controls_Manager::SELECT,
                            'default' => 'fade_ef',
                            'options' => [
                                'fade_ef'  => __( 'Fade', 'jupitercore' ),
                                'top'  => __( 'Top', 'jupitercore' ),
                                'right'  => __( 'Right', 'jupitercore' ),
                                'bottom'  => __( 'Bottom', 'jupitercore' ),
                                'left'  => __( 'left', 'jupitercore' ),
                            ],
                        ]
                    );
        
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'pricing_button_hover_background',
                            'label' => __( 'Background', 'jupitercore' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .price-box a.el-button:before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'pricing_button_hover_border',
                            'label' => __( 'Border', 'jupitercore' ),
                            'selector' => '{{WRAPPER}} .price-box a.el-button:hover',
                        ]
                    );

                   $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'pricing_button_hover_shadow',
                            'label' => __( 'Box Shadow', 'jupitercore' ),
                            'selector' => '{{WRAPPER}} .price-box a.el-button:hover',
                        ]
                    );
                $this->end_controls_tab(); // Pricing Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // button style tab end
    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        if ( ! empty( $settings['jupiter_button_link']['url'] ) ) {                       
            $this->add_render_attribute( 'url', 'class', 'el-button' );
            $this->add_render_attribute( 'url', 'class', $settings['button_ov_position'] );           
            $this->add_render_attribute( 'url', 'href', $settings['jupiter_button_link']['url'] );
            if ( $settings['jupiter_button_link']['is_external'] ) {
                $this->add_render_attribute( 'url', 'target', '_blank' );
            }
            if ( ! empty( $settings['jupiter_button_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url', 'rel', 'nofollow' );
            }
        }

        ?>
    <div class="price-box">
        <?php
            if( !empty($settings['pricing_top_title']) ){
                echo '<div class="price-top-title">'.esc_html( $settings['pricing_top_title'] ).'</div>';
            }
            if( !empty($settings['pricing_title']) ){
                echo '<div class="price-title">'.esc_html( $settings['pricing_title'] ).'</div>';
            }
            if( !empty($settings['price_content_editor']) ){
                echo '<div class="price-desc">'.wp_kses_post($settings['price_content_editor']).'</div>';
            }      
            if( !empty($settings['price_amount']) ){
                echo '<div class="price-amount">'.wp_kses_post($settings['price_amount']).'</div>';
            }        
            if( !empty($settings['price_button_text']) ){
                echo sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $settings['price_button_text'] );
            }
        ?>
    </div>
<?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new jupiter_Price_Table_Widget );