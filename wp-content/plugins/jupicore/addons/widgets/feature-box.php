<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class jupiter_feature_Box extends Widget_Base{

	public function get_name(){
		return "feature-box";
	}    
    
	public function get_title(){
		return __( 'Feature Box','jupitercore' );
	}
    
	public function get_categories() {
		return [ 'jupiter-addons' ];
	}
    
	public function get_icon() {
		return 'eicon-icon-box';
	}

    protected function  _register_controls(){
        $this->start_controls_section(
            'feature_box',
            [
                'label' => __( 'Feature Box', 'jupitercore' ),
            ]
        );
        
        $this->add_control(
            'feature_icon_type',
            [
                'label' => __('Feature Icon Type','jupitercore'),
                'type' =>Controls_Manager::CHOOSE,
                'options' =>[
                    'img' =>[
                        'title' =>__('Image','jupitercore'),
                        'icon' =>'fa fa-picture-o',
                    ],
                    'icon' =>[
                        'title' =>__('Icon','jupitercore'),
                        'icon' =>'fa fa-info',
                    ]
                ],
                'default' => 'icon',
            ]
        );

        $this->add_control(
            'feature_image',
            [
                'label' => __('Image','jupitercore'),
                'type'=>Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'feature_icon_type' => 'img',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'feature_imagesize',
                'default' => 'large',
                'separator' => 'none',
                'condition' => [
                    'feature_icon_type' => 'img',
                ]
            ]
        );

        $this->add_control(
            'feature_icon',
            [
                'label' =>esc_html__('Icon','jupitercore'),
                'type'=>Controls_Manager::ICON,
                'default' => 'fa fa-cogs',
                'condition' => [
                    'feature_icon_type' => 'icon',
                ]
            ]
        );

        $this->add_control(
            'feature_title',
            [
                'label' => __( 'Feature Title', 'jupitercore' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'This is a title','jupitercore' ),
                'placeholder' => __( 'Features Title', 'jupitercore' ),
            ]
        );
        $this->add_control(
            'feature_content',
            [
                'label' => __( 'Feature Content', 'jupitercore' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidi.','jupitercore' ),
                'placeholder' => __( 'Features content', 'jupitercore' ),
            ]
        );
        $this->end_controls_section();
        
        // Feature Style tab section
        $this->start_controls_section(
            'jupiter_feature_style_section',
            [
                'label' => __( 'Box Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('feature_box_style_tab');
        $this->start_controls_tab( 'feature_box_normal',
			[
				'label' => __( 'Normal', 'jupitercore' ),
			]
		);
        
        $this->add_responsive_control(
            'feature_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'feature_padding',
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
                    '{{WRAPPER}} .feature-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'feature_background',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .feature-box',
            ]
        );

        $this->add_responsive_control(
            'feature_text_align',
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
                    '{{WRAPPER}} .feature-box' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'feature_border',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .feature-box',
            ]
        );
        $this->add_responsive_control(
            'feature_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .feature-box' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                'name' => 'feature_box_shadow',
                'label' => __( 'Box Shadow', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .feature-box',
            ]
        );

        
        $this->add_control(
			'feature_box_transform',
			[
				'label' => __( 'Transform', 'jupitercore' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'translateY(0)',
				'selectors' => [
					'{{WRAPPER}} .feature-box' => 'transform: {{VALUE}}',
				],
			]
		);
        
		$this->add_control(
			'feature_box_transition',
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
					'{{WRAPPER}} .feature-box' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
		$this->end_controls_tab();

             
        // Hover Style tab Start
        $this->start_controls_tab(
            'feature_box_hover',
            [
                'label' => __( 'Hover', 'jupitercore' ),
            ]
        );
                
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'feature_hover_background',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .feature-box:hover',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'feature_border_hover',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .feature-box:hover',
            ]
        );
        $this->add_responsive_control(
            'feature_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .feature-box:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                'name' => 'feature_box_hover_shadow',
                'label' => __( 'Box Shadow', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .feature-box:hover',
            ]
        );
        $this->add_control(
			'feature_box_hover_transform',
			[
				'label' => __( 'Transform', 'jupitercore' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'translateY(0)',
				'selectors' => [
					'{{WRAPPER}} .feature-box:hover' => 'transform: {{VALUE}}',
				],
			]
		);
        
        $this->end_controls_tab(); // Hover Style tab end        
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section(); // Feature Box section style end
        
        // Feature Style tab section
        $this->start_controls_section(
            'box_icon_section',
            [
                'label' => __( 'Icon Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('box_icon_style_tab');
        
        $this->start_controls_tab( 'box_icon_normal',
			[
				'label' => __( 'Normal', 'jupitercore' ),
			]
		);        
        
		$this->add_control(
			'icon_width',
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
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box .feature-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);        
        
		$this->add_control(
			'icon_height',
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
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box .feature-icon' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
        
		$this->add_control(
			'icon_line_height',
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
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box .feature-icon' => 'line-height: {{SIZE}}{{UNIT}}'
				],
			]
		);
        
        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Font Icon Size', 'jupitercore' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 52,
                ],
                'selectors' => [
                    '{{WRAPPER}} .feature-box .feature-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
				'default' => '#001a40',
                'selectors' => [
                    '{{WRAPPER}} .feature-box .feature-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_background',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .feature-box .feature-icon',
            ]
        );
        
        $this->add_responsive_control(
            'feature_icon_align',
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
                    '{{WRAPPER}} .feature-box .feature-icon' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'separator' =>'before',
            ]
        );
         $this->add_responsive_control(
            'icon_floting',
            [
                'label' => __( 'Float Icon', 'jupitercore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'jupitercore' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'none' => [
                        'title' => __( 'None', 'jupitercore' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'jupitercore' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .feature-box .feature-icon' => 'float: {{VALUE}};',
                ],
                'default' => 'none',
                'separator' =>'before',
            ]
        );
                
        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '15',
                    'left' => '0',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-box .feature-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-box .feature-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .feature-box .feature-icon',
            ]
        );
        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '100',
                    'right' => '100',
                    'bottom' => '100',
                    'left' => '100',
                    'isLinked' => false,
					'unit' => '%',
                ],
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
                    '{{WRAPPER}} .feature-box .feature-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_shadow',
                'label' => __( 'Box Shadow', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .feature-box .feature-icon',
            ]
        );        
        $this->add_control(
			'box_icon_transition',
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
					'{{WRAPPER}} .feature-box .feature-icon' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        $this->end_controls_tab(); // Hover Style tab end
        $this->start_controls_tab( 'box_icon_hover',
			[
				'label' => __( 'Hover', 'jupitercore' ),
			]
		);        
        $this->add_control(
            'hover_icon_color',
            [
                'label' => __( 'Hover Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#001a40',
                'selectors' => [
                    '{{WRAPPER}} .feature-box:hover .feature-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hover_icon_background',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .feature-box .feature-icon:before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hover_icon_border',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .feature-box:hover .feature-icon',
            ]
        );
        $this->add_responsive_control(
            'hover_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '100',
                    'right' => '100',
                    'bottom' => '100',
                    'left' => '100',
                    'isLinked' => false,
					'unit' => '%',
                ],
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
                    '{{WRAPPER}} .feature-box:hover .feature-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_icon_shadow',
                'label' => __( 'Box Shadow', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .feature-box:hover .feature-icon',
            ]
        );        
        
        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section();
        
        
        
        
        
        
        // Feature Style tab section
        $this->start_controls_section(
            'box_title_section',
            [
                'label' => __( 'Title Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('box_title_style_tab');
        
        $this->start_controls_tab( 'box_title_normal',
			[
				'label' => __( 'Normal', 'jupitercore' ),
			]
		);        
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_title_typography',
                'selector' => '{{WRAPPER}} .feature-box .feature-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#151d41',
                'selectors' => [
                    '{{WRAPPER}} .feature-box .feature-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '20',
                    'left' => '0',
                    'isLinked' => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .feature-box .feature-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-box .feature-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
                
		$this->add_control(
			'feature_title_transition',
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
					'{{WRAPPER}} .feature-box .feature-title' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        
        $this->end_controls_tab(); // Hover Style tab end
         
        $this->start_controls_tab( 'box_title_hover',
			[
				'label' => __( 'Hover', 'jupitercore' ),
			]
		);        
        
        $this->add_control(
            'title_hover_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#151d41',
                'selectors' => [
                    '{{WRAPPER}} .feature-box .feature-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section();
         
        
        // Feature Style tab section
        $this->start_controls_section(
            'box_content_section',
            [
                'label' => __( 'Content Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_content_typography',
                'selector' => '{{WRAPPER}} .feature-box .feature-content',
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#63688e',
                'selectors' => [
                    '{{WRAPPER}} .feature-box .feature-content' => 'color: {{VALUE}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
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
                    '{{WRAPPER}} .feature-box .feature-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-box .feature-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->end_controls_section();
        
    }
    protected function render() {
        $allowed_atts = wp_kses_allowed_html('post');
        unset($allowed_atts["p"]);
		$settings = $this->get_settings_for_display();        
        $this->add_render_attribute( 'jupiter_feature_attr', 'class', 'feature-box' );            
        $feature_image = Group_Control_Image_Size::get_attachment_image_html( $settings, 'feature_imagesize', 'feature_image' );                
        $html_output = '';
        $html_output .= '<div '.$this->get_render_attribute_string( 'jupiter_feature_attr' ).' >';        
        if( $settings['feature_icon_type'] == 'img' and !empty($feature_image) ){
            $html_output .= '<div class="feature-icon">'.$feature_image.'</div>';
        }elseif( $settings['feature_icon_type'] == 'icon' and !empty($settings['feature_icon']) ){
            $html_output .= '<div class="feature-icon"><i class="'.esc_attr($settings['feature_icon']).'"></i></div>';
        }
        $html_output .= '<div class="box-content">';
        if( !empty($settings['feature_title']) ){
            $html_output .= '<h4 class="feature-title">'.wp_kses( $settings['feature_title'], $allowed_atts ).'</h4>';
        }
        if( !empty($settings['feature_content']) ){
            $html_output .= '<div class="feature-content">'.wp_kses_post( $settings['feature_content']).'</div>';
        }
        
        $html_output .= '</div>';        
        $html_output .= '</div>';        
        echo $html_output;        
	}

}
Plugin::instance()->widgets_manager->register_widget_type( new jupiter_feature_Box );