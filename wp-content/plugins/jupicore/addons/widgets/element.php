<?php namespace Elementor;
if (!defined('ABSPATH'))
{
    exit;
}
class jupiter_Position_Element extends Widget_Base
{
    public function get_name(){
        return 'jupiter-position_element';
    }
    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Position Element', 'jupitercore');
    }
    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return [ 'jupiter-addons' ];
    }
    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return "eicon-navigator";
    }
    
    public function get_style_depends()
    {
        return [
            'font-awesome'
        ];
    }
    protected function _register_controls()
    {
        $this->start_controls_section('element_option_section', ['label' => __('Element Options', 'jupitercore') , ]); 
        
		$this->add_responsive_control(
			'element_type',
			[
				'label' => __( 'Element Type', 'jupitercore' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'text' => [
						'title' => __( 'Text', 'jupitercore' ),
						'icon' => 'fa fa-paragraph',
					],
					'icon' => [
						'title' => __( 'Icon', 'jupitercore' ),
						'icon' => 'fa fa-info-circle',
					],
					'image' => [
						'title' => __( 'Image', 'jupitercore' ),
						'icon' => 'fa fa-image',
					],
				],
				'separator' => 'before',
				'default' => 'text'
			]
		);
		   
        $this->add_control(
			'element_icon',
			[
				'label' => __( 'Icon', 'jupitercore' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'fa fa-arrow-right',
                'condition' => [
					'element_type' => 'icon',
				],
			]
		);

		$this->add_control(
			'element_text',
			[
				'label' => __( 'Text', 'jupitercore' ),
				'type' => Controls_Manager::TEXTAREA,
				'condition' => [
					'element_type' => 'text',
				],
				'frontend_available' => true,
				'placeholder' => __( 'Enter your Text', 'jupitercore' ),
				'default' => __( 'Add Your Text ', 'jupitercore' ),
			]
		);
        $this->add_control(
            'media_image',
            [
				'label' => __( 'Choose Image', 'jupitercore' ),
                'type'=>Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
				'frontend_available' => true,
				'condition' => [
					'element_type' => 'image',
				]
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'media_imagesize',
                'default' => 'large',
                'separator' => 'none',
				'condition' => [
					'element_type' => 'image',
				]
            ]
        );
        $this->end_controls_section();

        
        $this->start_controls_section(
            'jupiter_element_default_style_section',
            [
                'label'     => __( 'Element Options', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'element_alignment',
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
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ],
                'default' => 'center',
                'separator' =>'before',
            ]
        );
        $this->add_responsive_control(
            'full_element_position_top',
            [
                'label' => __( 'Top', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'position: absolute; top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'full_element_position_right',
            [
                'label' => __( 'Right', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'position: absolute; right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'full_element_position_bottom',
            [
                'label' => __( 'Bottom', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'position: absolute; bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'full_element_position_left',
            [
                'label' => __( 'Left', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'position: absolute; left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'full_element_translate_x',
            [
                'label' => __( 'Translate X', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ]
            ]
        );
        $this->add_responsive_control(
            'full_element_translate_y',
            [
                'label' => __( 'Translate Y', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ]
            ]
        );
        $this->add_responsive_control(
            'full_element_rotate',
            [
                'label' => __( 'Rotate', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [   
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jupiter_element_content' => 'transform: rotate({{SIZE}}deg) translate({{full_element_translate_x.SIZE}}{{full_element_translate_x.UNIT}},{{full_element_translate_y.SIZE}}{{full_element_translate_y.UNIT}});',
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
                'default' => 1,
                'selectors' => [
                    '{{WRAPPER}}' => 'z-index: {{SIZE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'jupiter_element_full_width',
            [
                'label' => __( 'Width', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'jupiter_element_full_height',
            [
                'label' => __( 'Height', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vh' ],
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
                'selectors' => [
                    '{{WRAPPER}}' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // service Style tab section
        $this->start_controls_section(
            'element_icon_stylesection',
            [
                'label' => __( 'Icon Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'element_type' => 'icon'
                ]
            ]
        );
        $this->start_controls_tabs('element_icon_style_tab');
        $this->start_controls_tab( 'element_icon_normal',
            [
                'label' => __( 'Normal', 'jupitercore' ),
            ]
        );        

        $this->add_responsive_control(
            'element_icon_width',
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
                    '{{WRAPPER}} .jupiter_element_content .jupiter-el-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        

        $this->add_responsive_control(
            'element_icon_height',
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
                    '{{WRAPPER}} .jupiter_element_content .jupiter-el-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'element_icon_line_height',
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
                    '{{WRAPPER}} .jupiter_element_content .jupiter-el-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'element_icon_size',
            [
                'label' => __( 'Font Icon Size', 'jupitercore' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jupiter_element_content .jupiter-el-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'element_icon_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jupiter_element_content .jupiter-el-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'element_icon_background',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .jupiter_element_content .jupiter-el-icon',
            ]
        );
        $this->add_responsive_control(
            'element_icon_floting',
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
                    '{{WRAPPER}} .jupiter_element_content .jupiter-el-icon' => 'float: {{VALUE}};',
                ],
                'default' => 'none',
                'separator' =>'before',
            ]
        );
                
        $this->add_responsive_control(
            'element_icon_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .jupiter_element_content .jupiter-el-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'element_icon_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .jupiter_element_content .jupiter-el-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'element_icon_border',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .jupiter_element_content .jupiter-el-icon',
            ]
        );
        $this->add_responsive_control(
            'element_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
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
                    '{{WRAPPER}} .jupiter_element_content .jupiter-el-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'element_icon_shadow',
                'label' => __( 'Box Shadow', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .jupiter_element_content .jupiter-el-icon',
            ]
        ); 
        $this->end_controls_tab(); // Hover Style tab end
        $this->start_controls_tab( 'element_icon_hover',
            [
                'label' => __( 'Hover', 'jupitercore' ),
            ]
        );      
        $this->add_control(
            'element_hover_animation',
            [
                'label' => __( 'Hover Animation', 'elementor' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );  
        $this->add_control(
            'element_hover_icon_color',
            [
                'label' => __( 'Hover Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jupiter_element_content:hover .jupiter-el-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'element_hover_icon_background',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .jupiter_element_content:hover .jupiter-el-icon',
            ]
        );               
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'element_hover_icon_border',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .jupiter_element_content:hover .jupiter-el-icon',
            ]
        );
        $this->add_responsive_control(
            'element_hover_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
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
                    '{{WRAPPER}} .jupiter_element_content:hover .jupiter-el-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'element_hover_icon_shadow',
                'label' => __( 'Box Shadow', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .jupiter_element_content:hover .jupiter-el-icon',
            ]
        );        

        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section();

        $this->start_controls_section(
            'jupiter_element_text_style_section',
            [
                'label'     => __( 'Text Style', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'element_type' => 'text'
                ]
            ]
        );

            $this->add_control(
                'jupiter_element_text_color',
                [
                    'label' => __( 'Color', 'jupitercore' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '#444444',
                    'selectors' => [
                        '{{WRAPPER}} .jupiter_element_content .jupiter-el-text' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'jupiter_element_text_bd',
                    'label' => __( 'Background', 'jupitercore' ),
                    'default' => '#ffffff',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .jupiter_element_content .jupiter-el-text',
                ]
            );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'jupiter_element_text_typography',
                    'selector' => '{{WRAPPER}} .jupiter_element_content .jupiter-el-text',
                ]
            );

            $this->add_responsive_control(
                'jupiter_element_text_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter_element_content .jupiter-el-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'jupiter_element_text_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter_element_content .jupiter-el-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );
            $this->add_control(
                'jupiter_element_text_width',
                [
                    'label' => __( 'Width', 'jupitercore' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter_element_content .jupiter-el-text' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'jupiter_element_text_height',
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
                        '{{WRAPPER}} .jupiter_element_content .jupiter-el-text' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
  
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'jupiter_element_text_shadow',
                    'label' => __( 'Box Shadow', 'jupitercore' ),
                    'selector' => '{{WRAPPER}} .jupiter_element_content .jupiter-el-text',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                    [
                        'name' => 'jupiter_element_text_border',
                        'label' => __( 'Border', 'jupitercore' ),
                        'selector' => '{{WRAPPER}} .jupiter_element_content .jupiter-el-text',
                    ]
            );

            $this->add_responsive_control(
                'jupiter_element_text_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .jupiter_element_content .jupiter-el-text' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                     'default' => [
                        'isLinked' => false,
                        'unit' => '%',
                    ],
                ]
            );     

        $this->end_controls_section(); // Style Testimonial name style end  
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('element_content_attr', 'class', 'jupiter_element_content');        
        $html = '<div ' . $this->get_render_attribute_string('element_content_attr') . ' >';
            if( $settings['element_type'] == 'text' && !empty( $settings['element_text'] ) ){
                $html .= '<div class="jupiter-el-text">'.esc_html($settings['element_text']).'</div>';
            }elseif( $settings['element_type'] == 'icon' && !empty( $settings['element_icon'] ) ){
                $html .= '<div class="jupiter-el-icon"><i class="'.esc_attr($settings['element_icon']).'" ></i></div>';
            }elseif( $settings['element_type'] == 'image' ){
                $media_image = Group_Control_Image_Size::get_attachment_image_html( $settings, 'media_imagesize', 'media_image' );   
                $html .= '<div class="jupiter-el-image">'.$media_image.'</div>';
            }        
        $html .= '</div>';
         echo $html;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new jupiter_Position_Element );