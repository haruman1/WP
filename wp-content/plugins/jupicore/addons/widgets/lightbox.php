<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor play box widget.
 *
 * Elementor widget that displays an escalating play box bar.
 *
 * @since 1.0.0
 */
class jupiter_Play_Box_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve play box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'jupiter_lightbox_addons';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve play box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Play Box', 'jupitercore' );
	}

    
	public function get_categories() {
		return [ 'jupiter-addons' ];
	}
    
	/**
	 * Get widget icon.
	 *
	 * Retrieve play box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-youtube';
	}
    

    public function get_script_depends() {
        return [
            'lity-lightbox-js',
        ];
    }
    public function get_style_depends() {
        return [
            'lity-lightbox-css',
        ];
    }
    
    

	/**
	 * Register play box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_play_box',
			[
				'label' => __( 'Play Box', 'jupitercore' ),
			]
		);
        
        
		$this->add_control(
			'icon_format',
			[
				'label' => __( 'Icon Format', 'jupitercore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon_f',
				'options' => [
					'icon_f' => __( 'Icon Format', 'jupitercore' ),
					'text_f' => __( 'Text Format', 'jupitercore' ),
				],
			]
		);
        
		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'jupitercore' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Play',
				'condition' => [
					'icon_format' => 'text_f',
				]
			]
		);
        $this->add_control(
            'button_icon',
            [
                'label' =>esc_html__('Button Icon','jupitercore'),
                'type'=>Controls_Manager::ICON,
                'default' => 'fa fa-play',
				'condition' => [
					'icon_format' => 'icon_f'
				]
            ]
        );
        $this->add_control(
            'button_link',
            [
                'label' => __( 'Button Link', 'jupitercore' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'jupitercore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );
        
		$this->add_control(
			'use_lightbox',
			[
				'label' => __( 'Enable Lightbox', 'jupitercore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'jupitercore' ),
				'label_off' => __( 'Hide', 'jupitercore' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->end_controls_section();
        // Play Box Style tab section
        $this->start_controls_section(
            'jupiter_play_box_style_section',
            [
                'label' => __( 'Box Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );        
         $this->add_responsive_control(
            'sectopm_text_align',
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
                    '{{WRAPPER}} .jupiter-play-box' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'separator' =>'before',
            ]
        );   
        $this->add_responsive_control(
			'play_box_width',
			[
				'label' => __( 'Width', 'jupitercore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jupiter-play-box' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);        
        
        
        $this->add_responsive_control(
			'play_box_height',
			[
				'label' => __( 'Height', 'jupitercore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jupiter-play-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
                        
        $this->add_responsive_control(
            'play_box_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .jupiter-play-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'play_box_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .jupiter-play-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'play_box_background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .jupiter-play-box',
			]
		);
		$this->add_responsive_control(
            'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true,
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
                    '{{WRAPPER}} .jupiter-play-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );        
        $this->add_responsive_control(
			'play_box_transform',
			[
				'label' => __( 'Transform', 'jupitercore' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'translateY(0)',
				'selectors' => [
					'{{WRAPPER}} .jupiter-play-box' => 'transform: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
        
        
          
        
        // Play Box Style tab section
        $this->start_controls_section(
            'box_button_section',
            [
                'label' => __( 'Button Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('box_button_style_tab');
        
        $this->start_controls_tab( 'box_button_normal',
			[
				'label' => __( 'Normal', 'jupitercore' ),
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
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .play-button' => 'width: {{SIZE}}{{UNIT}};',
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
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .play-button' => 'height: {{SIZE}}{{UNIT}};',
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
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .play-button' => 'line-height: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'icon_format' => 'icon_f',
                ]
			]
		);
        $this->add_responsive_control(
            'button_size',
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
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .play-button' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'icon_format' => 'icon_f',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_text_typo',
                'selector' => '{{WRAPPER}} .play-button',
                'condition' => [
                    'icon_format' => 'text_f',
                ]
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
                'default' => '#8A19FA',
                'selectors' => [
                    '{{WRAPPER}} .play-button' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .play-button',
			]
		);
        
         $this->add_responsive_control(
            'button_text_align',
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
                    '{{WRAPPER}} .play-button' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
                'separator' =>'before',
            ]
        );
                
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .play-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .play-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .play-button',
            ]
        );
        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '100',
                    'right' => '100',
                    'bottom' => '100',
                    'left' => '100',
                    'isLinked' => true,
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
                    '{{WRAPPER}} .play-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'label' => __( 'Box Shadow', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .play-button',
            ]
        );        
        $this->add_control(
			'box_button_transition',
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
					'{{WRAPPER}} .play-button' => 'transition-duration: {{SIZE}}s',
				],
			]
		);            
        $this->end_controls_tab(); // Hover Style tab end
        
        
        $this->start_controls_tab( 'box_button_hover',
			[
				'label' => __( 'Hover', 'jupitercore' ),
			]
		);        
        $this->add_control(
            'hover_button_color',
            [
                'label' => __( 'Hover Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .play-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hover_button_background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .play-button:hover',
			]
		);
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hover_button_border',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .play-button:hover',
            ]
        );
        $this->add_responsive_control(
            'hover_button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '100',
                    'right' => '100',
                    'bottom' => '100',
                    'left' => '100',
                    'isLinked' => true,
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
                    '{{WRAPPER}} .play-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_button_shadow',
                'label' => __( 'Box Shadow', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .play-button:hover',
            ]
        );        
        
        $this->end_controls_tab(); // Hover Style tab end
        
        
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section();
                
        
	}

	/**
	 * Render play box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'play_box_attr', 'class', 'jupiter-play-box' );
   
        // Link Generate
        if ( !empty( $settings['button_link']['url'] ) ) {
            
            $this->add_render_attribute( 'play_button_attr', 'href', esc_url($settings['button_link']['url']) );
            
            if ( $settings['button_link']['is_external'] ) {
                $this->add_render_attribute( 'play_button_attr', 'target', '_blank' );
            }
            
            if ( !empty( $settings['button_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'play_button_attr', 'rel', 'nofollow' );
            }
            
            $this->add_render_attribute( 'play_button_attr', 'class', 'play-button' );
            
            if( $settings['use_lightbox'] == 'yes' ){
                $this->add_render_attribute( 'play_button_attr', 'data-lity', 'true' );
            }
        
        } 
        
        ?>
        <div <?php echo $this->get_render_attribute_string( 'play_box_attr' ); ?> >
            <a <?php echo $this->get_render_attribute_string( 'play_button_attr' ); ?> >
            <?php if( !empty($settings['button_icon']) and $settings['icon_format'] == 'icon_f' ): ?>
                <i class="<?php echo esc_attr($settings['button_icon']); ?>"></i>
            <?php elseif( !empty($settings['button_text']) and $settings['icon_format'] == 'text_f' ): ?>
                <span class="text"><?php echo esc_html($settings['button_text']); ?></span>
            <?php endif; ?>
            </a>
        </div><?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new jupiter_Play_Box_Widget );