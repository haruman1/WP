<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class jupiter_grid_bar extends Widget_Base{

	public function get_name(){
		return "jupiter-grid-bar";
	}    
    
	public function get_title(){
		return __( 'Grid Bar','jupitercore' );
	}
    
	public function get_icon() {
		return "eicon-menu-bar";
	}
    
	public function get_categories() {
		return [ 'jupiter-addons' ];
	}
    
    protected function  _register_controls(){
        
    $this->start_controls_section(
        'jupiter_grid_bar_section',
        [
            'label' => __( 'Grid Bar', 'jupitercore' ),
        ]
    );

    $this->add_control(
        'grid_bar_limit',
        [
            'label' => __( 'Bar Limit', 'jupitercore' ),
            'type' => Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 100,
            'step' => 1,
            'default' => 5,
        ]
    );
        
        
        
    $this->end_controls_section();
        $this->start_controls_section(
			'section_element_option',
			[
				'label' => __( 'Options', 'jupitercore' ),
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
						'max' => 9999,
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
				'default' => [
					'unit' => '%',
					'size' => 100,
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
						'max' => 999999,
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
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'size_units' => [ 'px', '%', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-widget-container .jupiter-grid-bar ' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-widget-container .jupiter-grid-bar li' => 'height: {{SIZE}}{{UNIT}};',
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
				'default' => [
					'unit' => 'px',
					'size' => 0,
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
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}}' => 'position:absolute; top: {{SIZE}}{{UNIT}};',
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
                'default' => -1,
                'selectors' => [
                    '{{WRAPPER}}' => 'z-index: {{SIZE}};',
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
        
        
    $this->end_controls_section();
        
        
        
    $this->start_controls_section(
        'item_section_style_start',
        [
            'label' => __( 'Bar Style', 'jupitercore' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );
                
    $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => 'item_background_color',
            'label' => __( 'Background', 'jupitercore' ),
            'types' => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .jupiter-grid-bar li',
        ]
    );
        
        
    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'item_border',
            'selector' => '{{WRAPPER}} .jupiter-grid-bar li',
        ]
    );

    $this->add_control(
        'item_radius',
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
                '{{WRAPPER}} .jupiter-grid-bar li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'item_box_shadow',
            'selector' => '{{WRAPPER}} .jupiter-grid-bar li',
        ]
    );
        
    $this->add_control(
        'item_width',
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
                'size' => 1,
            ],
            'selectors' => [
                '{{WRAPPER}} .jupiter-grid-bar li' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );   
    $this->end_controls_section();
        
    }
    
    
    protected function render() {
        $settings   = $this->get_settings_for_display();
        if( !empty($settings['grid_bar_limit']) ):
        echo '<ul class="jupiter-grid-bar">';
        for( $items = 1; $items <= $settings['grid_bar_limit']; $items++ ){            
            echo '<li class="item-'.$items.'" ></li>';
        }       
        echo '</ul>';
        endif;
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new jupiter_grid_bar );