<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class jupiter_Tab_Menu extends Widget_Base{

	public function get_name(){
		return "jupiter-tab-menu";
	}    
    
	public function get_title(){
		return __( 'Tab Menu','jupitercore' );
	}
    
	public function get_icon() {
		return "eicon-tabs";
	}
    
	public function get_categories() {
		return [ 'jupiter-addons' ];
	}
    
        
    public function get_script_depends() {
        return [
            'el-widget-active',
        ];
    }
    
    
    protected function  _register_controls(){
        
    $this->start_controls_section(
        'jupiter_tab_menu_section',
        [
            'label' => __( 'Tab Items', 'jupitercore' ),
        ]
    );
        
        $repeater = new Repeater(); 
        
        		
		$repeater->add_control(
			'element_type',
			[
				'label'       => __( 'Element Type', 'jupitercore' ),
				 'type' => Controls_Manager::SELECT,
				 'default' => 'text',
				 'options' => [
					'text'  => __( 'Text', 'jupitercore' ),
					'icon' => __( 'Icon', 'jupitercore' ),
					'image' => __( 'Image', 'jupitercore' ),
				 ],
			]
		);
        $repeater->add_control(
			'icon',
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
        $repeater->add_control(
			'text',
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
        $repeater->add_control(
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
        $repeater->add_group_control(
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
        
        $repeater->add_control(
            'target_id',
            [
                'label' => __( 'Targeted ID', 'jupitercore' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'tab-1',
                'description' => 'Enter your targeted element ID.',
                'placeholder' => __( 'tab_item_1', 'jupitercore' ),
            ]
        );
        
        $repeater->add_control(
			'active_menu',
			[
				'label' => __( 'Active Item?', 'jupitercore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'jupitercore' ),
				'label_off' => __( 'Off', 'jupitercore' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        
        $this->add_control(
            'jupiter_tab_menu_list',
            [
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'title_field' => '{{{ target_id }}}',
            ]
        );

    $this->end_controls_section();
        
        
        
        // Style tab area tab section
        $this->start_controls_section(
            'jupiter_tab_style_area',
            [
                'label' => __( 'Area Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'jupiter_tab_section_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-tab-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'default' => [
                        'top' => '0',
                        'right' => '0',
                        'bottom' => '0',
                        'left' => '0',
                        'isLinked' => false
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'jupiter_tab_section_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '10',
                        'right' => '10',
                        'bottom' => '10',
                        'left' => '10',
                        'isLinked' => false
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-tab-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );
        
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'jupiter_tab_section_bg',
                    'label' => __( 'Background', 'jupitercore' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .jupiter-tab-menu',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'jupiter_tab_section_border',
                    'label' => __( 'Border', 'jupitercore' ),
                    'selector' => '{{WRAPPER}} .jupiter-tab-menu',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'jupiter_tab_section_shadow',
                    'label' => __( 'Box Shadow', 'jupitercore' ),
                    'selector' => '{{WRAPPER}} .jupiter-tab-menu',
                ]
            );
            $this->add_control(
                'jupiter_tab_section_width',
                [
                    'label' => __( 'Width', 'jupitercore' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'vw' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 9999,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-tab-menu' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'jupiter_tab_section_height',
                [
                    'label' => __( 'Height', 'jupitercore' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 9999,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-tab-menu' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_responsive_control(
                'jupiter_tab_section_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-tab-menu' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
             $this->add_responsive_control(
                'area_floting',
                [
                    'label' => __( 'Menu Floating', 'jupitercore' ),
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
                        '{{WRAPPER}} .jupiter-tab-menu' => 'float: {{VALUE}};',
                    ],
                    'default' => 'none',
                    'separator' =>'before',
                ]
            );
            $this->add_responsive_control(
                'custom_area_css',
                [
                    'label' => __( 'Custom CSS', 'jupitercore' ),
                    'type' => Controls_Manager::CODE,
    				'rows' => 20,
                    'language' => 'css',
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-tab-menu' => '{{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();
        
        
		$this->start_controls_section(
			'tab_button_style_section',
			[
				'label' => __( 'Button', 'jupitercore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_button_typography',
				'selector' => '{{WRAPPER}} .jupiter-tab-menu .tab-button',
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'jupitercore' ),
			]
		);

		$this->add_control(
			'tab_button__color',
			[
				'label' => __( 'Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#001a40',
				'selectors' => [
					'{{WRAPPER}} .jupiter-tab-menu .tab-button' => 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_button_background_color',
				'label' => __( 'Background', 'jupitercore' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .jupiter-tab-menu .tab-button',
			]
		);
        
        $this->add_responsive_control(
            'tab_button_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
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
                    '{{WRAPPER}} .jupiter-tab-menu .tab-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'tab_button_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '15',
                    'right' => '40',
                    'bottom' => '15',
                    'left' => '40',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .jupiter-tab-menu .tab-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );   
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_button_border',
				'selector' => '{{WRAPPER}} .jupiter-tab-menu .tab-button',
			]
		);

        $this->add_control(
			'tab_button_radius',
			[
				'label' => __( 'Border Radius', 'jupitercore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],                
                'default' => [
                    'top' => '100',
                    'right' => '100',
                    'bottom' => '100',
                    'left' => '100',
                    'isLinked' => false
                ],
				'selectors' => [
					'{{WRAPPER}} .jupiter-tab-menu .tab-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_button_box_shadow',
				'selector' => '{{WRAPPER}} .jupiter-tab-menu .tab-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'jupitercore' ),
			]
		);

		$this->add_control(
			'tab_button_hover_color',
			[
				'label' => __( 'Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .jupiter-tab-menu .tab-button:hover, {{WRAPPER}} .jupiter-tab-menu .tab-button.active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_button_hover_background',
			[
				'label' => __( 'Background Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
                'default' => 'rgba(255,255,255,0.3)',
				'selectors' => [
					'{{WRAPPER}} .jupiter-tab-menu .tab-button:hover, {{WRAPPER}} .jupiter-tab-menu .tab-button.active' => 'background-color: {{VALUE}};',
				],
			]
		);
        
		$this->add_control(
			'tab_button_hover_border_color',
			[
				'label' => __( 'Border Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jupiter-tab-menu .tab-button:hover, {{WRAPPER}} .jupiter-tab-menu .tab-button.active' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .jupiter-tab-menu .tab-button:hover, {{WRAPPER}} .jupiter-tab-menu .tab-button.active',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		
        $this->add_responsive_control(
            'custom_item_css',
            [
                'label' => __( 'Custom CSS', 'jupitercore' ),
                'type' => Controls_Manager::CODE,
				'rows' => 20,
                'language' => 'css',
                'selectors' => [
                    '{{WRAPPER}} .jupiter-tab-menu .tab-button' => '{{VALUE}};',
                ],
                'separator' =>'before',
            ]
        );

		$this->end_controls_section();
        
    }
    protected function render() {
        
        $settings   = $this->get_settings_for_display();
        if( !empty($settings['jupiter_tab_menu_list']) ):
        echo '<div class="clearfix">';
        echo '<div class="jupiter-tab-menu">';
        foreach( $settings['jupiter_tab_menu_list'] as $items ){            
            $element_type = !empty( $items['element_type'] ) ? $items['element_type'] : '';
            switch ($element_type) :
                case 'text':
                    $text = !empty( $items['text'] ) ? $items['text'] : '';
                    $content = wp_kses_post($text);
                    break;
                case 'icon':
                    $icon = !empty( $items['icon'] ) ? $items['icon'] : '';
                    $content = '<div class="jupiter-el-icon"><i class="'.esc_attr($icon).'" ></i></div>';
                    break;
                case 'image':
                    $media_image = Group_Control_Image_Size::get_attachment_image_html( $items, 'media_imagesize', 'media_image' );   
                    $content = '<div class="jupiter-el-image">'.$media_image.'</div>';
                    break;
            endswitch;            
            echo '<button type="button" class="tab-button '.( ($items['active_menu'] == 'yes' ) ? 'active' : '' ).'" data-tab="'.esc_attr($items['target_id']).'" >'.wp_kses_post($content).'</button>';            
        }        
        echo '</div>';  
        echo '</div>';  
        
        endif;
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new jupiter_Tab_Menu );