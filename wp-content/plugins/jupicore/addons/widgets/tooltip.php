<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Jupiter_Elementor_Widget_Tooltip extends Widget_Base {

    public function get_name() {
        return 'jupiter-tooltip-addons';
    }
    
    public function get_title() {
        return __( 'Tooltip', 'jupitercore' );
    }

    public function get_icon() {
        return 'jupiter-icon eicon-alert';
    }

    public function get_categories() {
        return [ 'jupitercore' ];
    }

    public function get_script_depends() {
        return [
            'jupiter-widgets-scripts',
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'tooltip_button_content',
            [
                'label' => __( 'Tooltip', 'jupitercore' ),
            ]
        );
            $this->add_responsive_control(
                'tooltip_type',
                [
                    'label' => esc_html__( 'Button Type', 'jupitercore' ),
                    'type' => Controls_Manager::CHOOSE,
                    'label_block' => true,
                    'options' => [
                        'icon' => [
                            'title' => esc_html__( 'Icon', 'jupitercore' ),
                            'icon' => 'fa fa-info',
                        ],
                        'text' => [
                            'title' => esc_html__( 'Text', 'jupitercore' ),
                            'icon' => 'fa fa-text-width',
                        ],
                        'image' => [
                            'title' => esc_html__( 'Image', 'jupitercore' ),
                            'icon' => 'fa fa-image',
                        ],
                        'wave' => [
                            'title' => esc_html__( 'Wave', 'jupitercore' ),
                            'icon' => 'fal fa-scrubber',
                        ],
                    ],
                    'default' => 'wave',
                ]
            );

            $this->add_control(
                'tooltip_button_txt',
                [
                    'label' => esc_html__( 'Text', 'jupitercore' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__( 'Tooltip', 'jupitercore' ),
                    'condition' => [
                        'tooltip_type' => [ 'text' ]
                    ],
                    'dynamic' => [ 'active' => true ]
                ]
            );

            $this->add_control(
                'tooltip_button_icon',
                [
                    'label' => esc_html__( 'Icon', 'jupitercore' ),
                    'type' => Controls_Manager::ICON,
                    'default' => 'fa fa-home',
                    'condition' => [
                        'tooltip_type' => [ 'icon' ]
                    ]
                ]
            );

            $this->add_control(
                'tooltip_button_img',
                [
                    'label' => __('Image','jupitercore'),
                    'type'=>Controls_Manager::MEDIA,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'tooltip_type' => [ 'image' ]
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'tooltip_button_imgsize',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition' => [
                        'tooltip_type' => [ 'image' ]
                    ]
                ]
            );

            $this->add_control(
                'show_link',
                [
                    'label' => __( 'Show Link', 'jupitercore' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'jupitercore' ),
                    'label_off' => __( 'Hide', 'jupitercore' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'button_link',
                [
                    'label' => __( 'Link', 'jupitercore' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'jupitercore' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'condition'=>[
                        'show_link'=>'yes',
                    ]
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'tooltip_options',
            [
                'label' => __( 'Tooltip Options', 'jupitercore' ),
            ]
        );
            $this->add_control(
                'tooltip_text',
                [
                    'label' => esc_html__( 'Tooltip Text', 'jupitercore' ),
                    'type' => Controls_Manager::WYSIWYG,
                    'label_block' => true,
                    'default' => esc_html__( 'Tooltip content', 'jupitercore' ),
                    'dynamic' => [ 'active' => true ]
                ]
            );

            $this->add_control(
              'tooltip_dir',
                [
                    'label'         => esc_html__( 'Direction', 'jupitercore' ),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'right',
                    'label_block'   => false,
                    'options'       => [
                        'left'      => esc_html__( 'Left', 'jupitercore' ),
                        'right'     => esc_html__( 'Right', 'jupitercore' ),
                        'top'       => esc_html__( 'Top', 'jupitercore' ),
                        'bottom'    => esc_html__( 'Bottom', 'jupitercore' ),
                    ],
                ]
            );

            $this->add_control(
                'tooltip_space',
                [
                    'label' => __( 'Space With Button', 'jupitercore' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tooltip.top' => 'top: -{{SIZE}}{{UNIT}} !important;',
                        '{{WRAPPER}} .tooltip.bottom' => 'top: {{SIZE}}{{UNIT}} !important;',
                        '{{WRAPPER}} .tooltip.right' => 'left: {{SIZE}}{{UNIT}} !important;',
                        '{{WRAPPER}} .tooltip.left' => 'left: -{{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'tooltip_style_section',
            [
                'label' => __( 'Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
	
        $this->add_responsive_control(
            'tooltip_style_section_align',
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
                    '{{WRAPPER}} .jupiter-tooltip' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
                'separator' =>'before',
            ]
        );

		$this->add_responsive_control(
			'element_width',
			[
				'label' => __( 'Element Width', 'jupitercore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'vw' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'size_units' => [ 'px', '%', 'vw' ],
				'selectors' => [
					'{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'element_height',
			[
				'label' => __( 'Element Height', 'jupitercore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'size_units' => [ 'px', '%', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .xunbur-ex-element' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};'
				],
			]
		);		
		$this->add_responsive_control(
			'element_hr_offset',
			[
				'label' => __( 'Horizontal Offset', 'jupitercore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [  'px', '%', 'vw' ],
				'range' => [
					'px' => [
						'min' => -2000,
						'max' => 2000,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'vw' => [
						'min' => -100,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}}' => 'position:absolute;left: {{SIZE}}{{UNIT}};',
				],
			]
		);        
		$this->add_responsive_control(
			'element_vr_offset',
			[
				'label' => __( 'Vertical Offset', 'jupitercore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [  'px', '%', 'vh' ],
				'range' => [
					'px' => [
						'min' => -2000,
						'max' => 2000,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'vh' => [
						'min' => -100,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}}' => 'position:absolute;top: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'element_z_index',
            [
                'label' => __( 'Z Index', 'jupitercore' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -100,
                'max' => 100,
                'step' => 1,
                'default' => 2,
                'selectors' => [
                    '{{WRAPPER}}' => 'z-index: {{SIZE}};',
                ],
            ]
        );
		$this->add_responsive_control(
			'rotation_along',
			[
				'label' => __( 'Rotation Along', 'jupitercore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'z-axis',
				'options' => [
					'x-axis'  => __( 'X - axis', 'jupitercore' ),
					'y-axis'  => __( 'Y - axis', 'jupitercore' ),
					'z-axis'  => __( 'Z - axis', 'jupitercore' ),
				],
			]
		);		
		
		$this->add_responsive_control(
			'element_rotation_x',
			[
				'label' => __( 'Rotation X - axis', 'jupitercore' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'rotation_along' => 'x-axis',
				],
				'frontend_available' => true,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'max' => 360,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '-webkit-transform:rotateX({{SIZE}}deg);
					-moz-transform:rotateX({{SIZE}}deg);
					-ms-transform:rotateX({{SIZE}}deg);
					-o-transform:rotateX({{SIZE}}deg);
					transform:rotateX({{SIZE}}deg);',
					
				],
			]
		);
		$this->add_responsive_control(
			'element_rotation_y',
			[
				'label' => __( 'Rotation Y - axis', 'jupitercore' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'rotation_along' => 'y-axis',
				],
				'frontend_available' => true,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'max' => 360,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '-webkit-transform:rotateY({{SIZE}}deg);
					-moz-transform:rotateY({{SIZE}}deg);
					-ms-transform:rotateY({{SIZE}}deg);
					-o-transform:rotateY({{SIZE}}deg);
					transform:rotateY({{SIZE}}deg);',
					
				],
			]
		);
		$this->add_responsive_control(
			'element_rotation_z',
			[
				'label' => __( 'Rotation Z - axis', 'jupitercore' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'rotation_along' => 'z-axis',
				],
				'frontend_available' => true,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'max' => 360,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '-webkit-transform:rotateZ({{SIZE}}deg);
					-moz-transform:rotateZ({{SIZE}}deg);
					-ms-transform:rotateZ({{SIZE}}deg);
					-o-transform:rotateZ({{SIZE}}deg);
					transform:rotateZ({{SIZE}}deg);',
					
				],
			]
		);
		
		$this->add_responsive_control(
			'element_opacity',
			[
				'label' => __( 'Opacity (%)', 'jupitercore' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'opacity: {{SIZE}}',
					
				],
			]
		);

            $this->add_responsive_control(
                'tooltip_style_section_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'tooltip_style_section_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-tooltip' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );
            
        $this->end_controls_section();

        // Button Style tab section
        $this->start_controls_section(
            'tooltip_button_section',
            [
                'label' => __( 'Button', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->start_controls_tabs('button_style_tabs');

                $this->start_controls_tab(
                    'button_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'jupitercore' ),
                    ]
                );
                    $this->add_control(
                        'button_color',
                        [
                            'label' => __( 'Color', 'jupitercore' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .jupiter-tooltip span' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .jupiter-tooltip span a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .jupiter-tooltip span',
                            'condition'=>[
                                'tooltip_type'=>'text',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_icon_fontsize',
                        [
                            'label' => __( 'Icon Size', 'jupitercore' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 20,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .jupiter-tooltip span i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                            'condition'=>[
                                'tooltip_type'=>'icon',
                                'tooltip_button_icon!'=>'',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => __( 'Background', 'jupitercore' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .jupiter-tooltip .tooltip-button',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_width',
                        [
                            'label' => __( 'Width', 'jupitercore' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .jupiter-tooltip .tooltip-button' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );        

                    $this->add_responsive_control(
                        'button_height',
                        [
                            'label' => __( 'Height', 'jupitercore' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .jupiter-tooltip .tooltip-button' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'button_line_height',
                        [
                            'label' => __( 'Line Height', 'jupitercore' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .jupiter-tooltip .tooltip-button' => 'line-height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => __( 'Border', 'jupitercore' ),
                            'selector' => '{{WRAPPER}} .jupiter-tooltip .tooltip-button',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .jupiter-tooltip .tooltip-button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'button_margin',
                        [
                            'label' => __( 'Margin', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .jupiter-tooltip .tooltip-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => __( 'Padding', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .jupiter-tooltip .tooltip-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                $this->end_controls_tab(); // Normal tab end

                // Hover Tab start
                $this->start_controls_tab(
                    'button_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'jupitercore' ),
                    ]
                );
                    $this->add_control(
                        'button_hover_color',
                        [
                            'label' => __( 'Color', 'jupitercore' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .jupiter-tooltip .tooltip-button:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_hover_background',
                            'label' => __( 'Background', 'jupitercore' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .jupiter-tooltip .tooltip-button:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => __( 'Border', 'jupitercore' ),
                            'selector' => '{{WRAPPER}} .jupiter-tooltip .tooltip-button:hover',
                        ]
                    );

                $this->end_controls_tab();// Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        
        
        // Button Style tab section
        $this->start_controls_section(
            'wave_tooltip_style_section',
            [
                'label' => __( 'Wave', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tooltip_type' => 'wave'
                ]
            ]
        );        

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'wave_background',
                    'label' => __( 'Background', 'jupitercore' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .jupiter-tooltip .tooltip-button .waves-block .waves',
                ]
            );

            $this->add_responsive_control(
                'wave_width',
                [
                    'label' => __( 'Width', 'jupitercore' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-tooltip .tooltip-button .waves-block' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );        

            $this->add_responsive_control(
                'wave_height',
                [
                    'label' => __( 'Height', 'jupitercore' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-tooltip .tooltip-button .waves-block' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'wave_border',
                    'label' => __( 'Border', 'jupitercore' ),
                    'selector' => '{{WRAPPER}} .jupiter-tooltip .tooltip-button .waves-block .waves',
                ]
            );

            $this->add_responsive_control(
                'wave_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-tooltip .tooltip-button .waves-block .waves' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
        
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'wave_box_shadow',
                    'selector' => '{{WRAPPER}} .jupiter-tooltip .tooltip-button .waves-block .waves',
                ]
            );
        $this->end_controls_section();
        
        // Button Style tab section
        $this->start_controls_section(
            'hover_tooltip_style_section',
            [
                'label' => __( 'Tooltip', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('hover_popover_style_tabs');

                $this->start_controls_tab(
                    'hover_tooltip_content_tab',
                    [
                        'label' => __( 'Content', 'jupitercore' ),
                    ]
                );
                    $this->add_control(
                        'hover_tooltip_content_color',
                        [
                            'label' => __( 'Color', 'jupitercore' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .tooltip-inner' => 'color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'hover_tooltip_content_typography',
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .tooltip-inner',
                        ]
                    );

                    $this->add_responsive_control(
                        'hover_tooltip_content_padding',
                        [
                            'label' => __( 'Padding', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .tooltip-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'hover_tooltip_content_background',
                            'label' => __( 'Background', 'jupitercore' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .tooltip-inner',
                        ]
                    );

                    $this->add_responsive_control(
                        'hover_tooltip_content_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .tooltip-inner' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px !important;',
                            ],
                        ]
                    );
        
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'hover_tooltip_content_box_shadow',
                            'selector' => '{{WRAPPER}} .tooltip-inner',
                        ]
                    );
                    $this->add_responsive_control(
                        'hover_tooltip_content_align',
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
                                '{{WRAPPER}} .tooltip-inner' => 'text-align: {{VALUE}};',
                            ],
                            'default' => 'left',
                            'separator' =>'before',
                        ]
                    );
                $this->end_controls_tab(); // Arrow Tab End

                // Arrow Tab Start
                $this->start_controls_tab(
                    'hover_tooltip_arrow_tab',
                    [
                        'label' => __( 'Arrow', 'jupitercore' ),
                    ]
                );
                    $this->add_control(
                        'hover_tooltip_arrow_color',
                        [
                            'label' => __( 'Arrow Color', 'jupitercore' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#404040',
                            'selectors' => [
                                '{{WRAPPER}} .tooltip.top .tooltip-arrow' => 'border-top-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .tooltip.bottom .tooltip-arrow' => 'border-bottom-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .tooltip.left .tooltip-arrow' => 'border-left-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .tooltip.right .tooltip-arrow' => 'border-right-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $id = $this->get_id();
        $this->add_render_attribute( 'jupiter_tooltip_attr', 'class', 'jupiter-tooltip jupiter-tooltip-container-'.$id );
       
        ?>
            <div <?php echo $this->get_render_attribute_string( 'jupiter_tooltip_attr' ); ?>>
                <?php

                    $button_txt = '';
        
                    if( isset( $settings['tooltip_button_txt'] ) and $settings['tooltip_type'] == 'text' ){
                        $button_txt = $settings['tooltip_button_txt'];
                    }elseif( isset( $settings['tooltip_button_icon'] ) and $settings['tooltip_type'] == 'icon' ){
                        $button_txt = '<i class=" '.$settings['tooltip_button_icon'].' "></i>';
                    }elseif( isset( $settings['tooltip_button_img']['url'] ) and $settings['tooltip_type'] == 'image' ){
                        $button_txt = Group_Control_Image_Size::get_attachment_image_html( $settings, 'tooltip_button_imgsize', 'tooltip_button_img' );
                    }else{
                        $button_txt =  '<span class="waves-block"><span class="waves wave-1"></span><span class="waves wave-2"></span><span class="waves wave-3"></span></span>';
                    }

                    // Button Generate
                    if ( isset(  $settings['button_link']['url'] ) && ! empty( $settings['button_link']['url'] ) ) {
                        $this->add_render_attribute( 'url', 'href', $settings['button_link']['url'] );
                        if ( $settings['button_link']['is_external'] ) {
                            $this->add_render_attribute( 'url', 'target', '_blank' );
                        }
                        if ( ! empty( $settings['button_link']['nofollow'] ) ) {
                            $this->add_render_attribute( 'url', 'rel', 'nofollow' );
                        }
                        $button_txt = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $button_txt );
                    }

                    echo sprintf('<span class="tooltip-button" data-toggle="tooltip" data-container=".jupiter-tooltip-container-%4$s" data-placement="%1$s" title="%2$s">%3$s</span>', $settings['tooltip_dir'], $settings['tooltip_text'], $button_txt, $id );
                ?>
            </div>

        <?php

    }

}


Plugin::instance()->widgets_manager->register_widget_type( new Jupiter_Elementor_Widget_Tooltip );

