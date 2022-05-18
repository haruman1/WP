<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class jupiter_feature_load_Boxes extends Widget_Base {

	public function get_name() {
		return 'jupiter-feature-more-box';
	}

	public function get_title() {
		return __( 'Load Feature', 'jupitercore' );
	}

	public function get_icon() {
		return "eicon-post-list";
	}
    
    
    public function get_script_depends() {
        return [
            'slick',
            'el-widget-active',
        ];
    }
    
	public function get_categories() {
		return [ 'jupiter-addons' ];
	}

	protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Load Feature Content', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
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
                    ],
                    'text' =>[
                        'title' =>__('Text','jupitercore'),
                        'icon' =>'fa fa-text-width',
                    ]
                ],
                'default' => 'icon',
            ]
        );

        $repeater->add_control(
            'feature_load_image',
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

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'feature_load_imagesize',
                'default' => 'large',
                'separator' => 'none',
                'condition' => [
                    'feature_icon_type' => 'img',
                ]
            ]
        );

        $repeater->add_control(
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

        $repeater->add_control(
            'feature_icon_text',
            [
                'label' => __( 'Top Title', 'jupitercore' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter the text', 'jupitercore' ),
                'default' => __( 'Hello World!', 'jupitercore' ),
                'title' => __( 'Top Title', 'jupitercore' ),
                'condition' => [
                    'feature_icon_type' => 'text',
                ]
            ]
        );
        
        
        $repeater->add_control(
            'feature_load_main_title',
            [
                'label' => __( 'Title', 'jupitercore' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter the feature title', 'jupitercore' ),
                'default' => __( 'Podcast & Live Strem Video', 'jupitercore' ),
                'title' => __( 'Feature title', 'jupitercore' ),
            ]
        );
        
        
        $repeater->add_control(
            'feature_load_link',
            [
                'label' => __( 'Title Link', 'jupitercore' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'jupitercore' ),
                'show_external' => true,
            ]
        );

        $repeater->add_control(
            'feature_load_content',
            [
                'label' => __( 'Description', 'jupitercore' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your feature description.', 'jupitercore' ),
                'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.', 'jupitercore' ),
                'title' => __( 'Feature Description', 'jupitercore' ),
            ]
        );
        
        
        $this->add_control(
            'item_list',
            [
                'label' => __( 'Repeater List', 'jupitercore' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'feature_load_link' => ['url' => '#','is_external' => false,'nofollow' => false,],
                        'feature_load_main_title' => __( 'Supply food in rural areas', 'jupitercore' ),
                    ],
                ],
                'title_field' => '{{{ feature_load_main_title }}}',
            ]
        );
        
        $this->add_control(
            'slider_on',
            [
                'label'         => __( 'Slider', 'jupitercore' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'On', 'jupitercore' ),
                'label_off'     => __( 'Off', 'jupitercore' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );
        
        $this->add_control(
            'load_more',
            [
                'label'         => __( 'Load More Button', 'jupitercore' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'On', 'jupitercore' ),
                'label_off'     => __( 'Off', 'jupitercore' ),
                'return_value'  => 'yes',
                'default'       => 'no',
                'condition' => [
                    'slider_on!' => 'yes',
                ]
            ]
        );        
        $this->add_control(
            'loaded_item',
            [
                'label' => __( 'Default Load', 'jupitercore' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 30,
                'step' => 1,
                'default' => 6,
                'condition' => [
                    'load_more' => 'yes',
                    'slider_on!' => 'yes',
                ]
            ]
        );                
        $this->add_control(
            'load_slice',
            [
                'label' => __( 'Slice Item', 'jupitercore' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 30,
                'step' => 1,
                'default' => 3,
                'condition' => [
                    'load_more' => 'yes',
                    'slider_on!' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'load_button_text',
            [
                'label' => __( 'Button Text', 'jupitercore' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Load More +','jupitercore' ),
                'placeholder' => __( 'Enter button text...', 'jupitercore' ),
                'condition' => [
                    'load_more' => 'yes',
                    'slider_on!' => 'yes',
                ]
            ]
        );
        
        $this->end_controls_section();  
           // Slider setting
        $this->start_controls_section(
            'carosul_slider_option',
            [
                'label' => __( 'Slider Option', 'jupitercore' ),
                'condition' => [
                    'slider_on' => 'yes',
                ]
            ]
        );

            $this->add_control(
                'slitems',
                [
                    'label' => __( 'Slider Items', 'jupitercore' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 20,
                    'step' => 1,
                    'default' => 3,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'slarrows',
                [
                    'label' => __( 'Slider Arrow', 'jupitercore' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'slprevicon',
                [
                    'label' => __( 'Previous icon', 'jupitercore' ),
                    'type' => Controls_Manager::ICON,
                    'default' => 'fa fa-angle-left',
                    'condition' => [
                        'slider_on' => 'yes',
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slnexticon',
                [
                    'label' => __( 'Next icon', 'jupitercore' ),
                    'type' => Controls_Manager::ICON,
                    'default' => 'fa fa-angle-right',
                    'condition' => [
                        'slider_on' => 'yes',
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sldots',
                [
                    'label' => __( 'Slider dots', 'jupitercore' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slpause_on_hover',
                [
                    'type' => Controls_Manager::SWITCHER,
                    'label_off' => __('No', 'jupitercore'),
                    'label_on' => __('Yes', 'jupitercore'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'label' => __('Pause on Hover?', 'jupitercore'),
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slcentermode',
                [
                    'label' => __( 'Center Mode', 'jupitercore' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slcenterpadding',
                [
                    'label' => __( 'Center padding', 'jupitercore' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                    'default' => 50,
                    'condition' => [
                        'slider_on' => 'yes',
                        'slcentermode' => 'yes',
                    ]
                ]
            );
        
            $this->add_control(
                'slverticalmode',
                [
                    'label' => __( 'Vertical Mode', 'jupitercore' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautolay',
                [
                    'label' => __( 'Slider auto play', 'jupitercore' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator' => 'before',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautoplay_speed',
                [
                    'label' => __('Autoplay speed', 'jupitercore'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 3000,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );


            $this->add_control(
                'slanimation_speed',
                [
                    'label' => __('Autoplay animation speed', 'jupitercore'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 300,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slscroll_columns',
                [
                    'label' => __('Slider item to scroll', 'jupitercore'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_tablet',
                [
                    'label' => __( 'Tablet', 'jupitercore' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_display_columns',
                [
                    'label' => __('Slider Items', 'jupitercore'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 8,
                    'step' => 1,
                    'default' => 2,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_scroll_columns',
                [
                    'label' => __('Slider item to scroll', 'jupitercore'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 8,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_width',
                [
                    'label' => __('Tablet Resolution', 'jupitercore'),
                    'description' => __('The resolution to tablet.', 'jupitercore'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 778,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_mobile',
                [
                    'label' => __( 'Mobile Phone', 'jupitercore' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_display_columns',
                [
                    'label' => __('Slider Items', 'jupitercore'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_scroll_columns',
                [
                    'label' => __('Slider item to scroll', 'jupitercore'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_width',
                [
                    'label' => __('Mobile Resolution', 'jupitercore'),
                    'description' => __('The resolution to mobile.', 'jupitercore'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 480,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );
        $this->end_controls_section(); // Slider Option end        
                    
        // post Style tab section
        $this->start_controls_section(
            'feature_load_area_style_section',
            [
                'label' => __( 'Area Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'feature_load_area_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-load-box-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'feature_load_area_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-load-box-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
		$this->add_responsive_control(
			'feature_load_area_width',
			[
				'label' => __( 'Width', 'jupitercore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
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
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .feature-load-box-area' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);  
        $this->end_controls_section(); // post section style end
        
        // Service Style tab section
        $this->start_controls_section(
            'feature_load_column_style_section',
            [
                'label' => __( 'Column Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on!' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'feature_load_column_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-load-box-area.feature-load-grid .feature-load-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );        
        $this->add_responsive_control(
            'feature_load_column_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-load-box-area.feature-load-grid .feature-load-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );        
		$this->add_responsive_control(
			'feature_load_column_width',
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
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 33.33,
				],
				'selectors' => [
					'{{WRAPPER}} .feature-load-box-area .feature-load-item' => 'width: {{SIZE}}{{UNIT}};',
				],
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box' => 'text-align: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box',
            ]
        );
        $this->add_responsive_control(
            'feature_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box',
            ]
        );

        
        $this->add_control(
			'feature_box_transform',
			[
				'label' => __( 'Transform', 'jupitercore' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'translateY(0)',
				'selectors' => [
					'{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box' => 'transform: {{VALUE}}',
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
					'{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box' => 'transition-duration: {{SIZE}}s',
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
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box:before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'feature_border_hover',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box:hover',
            ]
        );
        $this->add_responsive_control(
            'feature_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box:hover',
            ]
        );
        $this->add_control(
			'feature_box_hover_transform',
			[
				'label' => __( 'Transform', 'jupitercore' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'translateY(0)',
				'selectors' => [
					'{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box:hover' => 'transform: {{VALUE}}',
				],
			]
		);
        
        $this->end_controls_tab(); // Hover Style tab end        
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section(); // Feature Box section style end
        
        // post Style tab section
        $this->start_controls_section(
            'icon_box_style_section',
            [
                'label' => __( 'Icon Box', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs('box_icon_style_tab');
        
        $this->start_controls_tab( 'box_icon_normal',
			[
				'label' => __( 'Normal', 'jupitercore' ),
			]
		);        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'top_title_font_typograpy',
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon'
            ]
        );
		$this->add_responsive_control(
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
				'selectors' => [
					'{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);        
        
		$this->add_responsive_control(
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
				'selectors' => [
					'{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
                
		$this->add_responsive_control(
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
				'selectors' => [
					'{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Font Size', 'jupitercore' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_background',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon' => 'float: {{VALUE}};',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon',
            ]
        );
        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_shadow',
                'label' => __( 'Box Shadow', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon',
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
					'{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        $this->add_responsive_control(
            'icon_custom_css',
            [
                'label' => __( 'Icon Custom CSS', 'jupitercore' ),
                'type' => Controls_Manager::CODE,
				'rows' => 20,
                'language' => 'css',
                'selectors' => [
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .feature-icon i' => '{{VALUE}};',
                ],
                'separator' =>'before',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box:hover .feature-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_hover_background',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box:hover .feature-icon:before',
            ]
        ); 
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hover_icon_border',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box:hover .feature-icon',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_icon_shadow',
                'label' => __( 'Box Shadow', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box:hover .feature-icon',
            ]
        );        
        $this->add_responsive_control(
            'icon_hover_custom_css',
            [
                'label' => __( 'Custom CSS', 'jupitercore' ),
                'type' => Controls_Manager::CODE,
				'rows' => 20,
                'language' => 'css',
                'selectors' => [
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box:hover .feature-icon i' => '{{VALUE}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section(); // post section style end
        
        
        
        
        
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
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .main-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#151d41',
                'selectors' => [
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .main-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .main-title a' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .main-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .main-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .main-title' => 'transition-duration: {{SIZE}}s',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box:hover .main-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box:hover .main-title a' => 'color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .box-desc',
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#63688e',
                'selectors' => [
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .box-desc' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'content_hover_color',
            [
                'label' => __( 'Hover Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#63688e',
                'selectors' => [
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box:hover .box-desc' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .box-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .feature-load-box-area .feature-load-item .feature-load-box .box-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->end_controls_section();
     
        
        $this->start_controls_section(
            'slider_arrow_style',
            [
                'label'     => __( 'Arrow', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'slider_on' => 'yes',
                    'slarrows'  => 'yes',
                ],
            ]
        );
        
            $this->start_controls_tabs( 'slider_arrow_style_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'slider_arrow_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'jupitercore' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_color',
                        [
                            'label' => __( 'Color', 'jupitercore' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#000c35',
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_fontsize',
                        [
                            'label' => __( 'Font Size', 'jupitercore' ),
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
                                'size' => 16,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'slider_arrow_background',
                            'label' => __( 'Background', 'jupitercore' ),
                            'default' => '#ffffff',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_height',
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
                                'size' => 70,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_width',
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
                                'size' => 70,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_padding',
                        [
                            'label' => __( 'Padding', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );
        
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'slider_arrow_border',
                            'label' => __( 'Border', 'jupitercore' ),
                            'selector' => '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'slider_arrow_box_shadow',
                            'label' => __( 'Box Shadow', 'jupitercore' ),
                            'selector' => '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow',
                        ]
                    );
        

                $this->end_controls_tab(); // Normal tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'slider_arrow_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'jupitercore' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_hover_color',
                        [
                            'label' => __( 'Color', 'jupitercore' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'slider_arrow_hover_background',
                            'label' => __( 'Background', 'jupitercore' ),
                            'types' => [ 'classic', 'gradient' ],
                            'default' => '#8A19FA',
                            'selector' => '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow:before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'slider_arrow_hover_border',
                            'label' => __( 'Border', 'jupitercore' ),
                            'selector' => '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
        
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'slider_arrow_box_shadow_hover',
                            'label' => __( 'Box Shadow', 'jupitercore' ),
                            'selector' => '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow:hover',
                        ]
                    );
        

                $this->end_controls_tab(); // Hover tab end

            $this->end_controls_tabs();
        
             $this->add_control(
                'slider_arrow_position_title',
                [
                    'label'     => __( 'Arrow Position', 'jupitercore' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
        
            $this->start_controls_tabs( 'slider_arrow_position_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'slider_arrow_prev_tab',
                    [
                        'label' => __( 'Prev', 'jupitercore' ),
                    ]
                );
        
                $this->add_responsive_control(
                    'slider_arrow_prev_gap_x',
                    [
                        'label' => __( 'Position X', 'jupitercore' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vw' ],
                        'range' => [
                            'px' => [
                                'min' => -9999,
                                'max' => 9999,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                            'vh' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 30,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow.slick-prev' => 'position: absolute; left: {{SIZE}}{{UNIT}};'
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'slider_arrow_prev_gap_y',
                    [
                        'label' => __( 'Position Y', 'jupitercore' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vh' ],
                        'range' => [
                            'px' => [
                                'min' => -9999,
                                'max' => 9999,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                            'vh' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                            'size' => 45,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow.slick-prev' => 'position: absolute; top: {{SIZE}}{{UNIT}};'
                        ],
                    ]
                );
        
        
                 $this->end_controls_tab(); // Left Arrow tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'slider_arrow_next_tab',
                    [
                        'label' => __( 'Next', 'jupitercore' ),
                    ]
                );
        
                   $this->add_responsive_control(
                    'slider_arrow_next_gap_x',
                    [
                        'label' => __( 'Position X', 'jupitercore' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vw' ],
                        'range' => [
                            'px' => [
                                'min' => -9999,
                                'max' => 9999,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                            'vh' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 30,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow.slick-next' => 'position: absolute; right: {{SIZE}}{{UNIT}};'
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'slider_arrow_next_gap_y',
                    [
                        'label' => __( 'Position Y', 'jupitercore' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vh' ],
                        'range' => [
                            'px' => [
                                'min' => -9999,
                                'max' => 9999,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                            'vh' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                            'size' => 45,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .jupitercore-carousel-activation .slick-arrow.slick-next' => 'position: absolute; top: {{SIZE}}{{UNIT}};'
                        ],
                    ]
                );
        
                $this->end_controls_tab(); // Right Arrow tab end
            $this->end_controls_tabs();
        $this->end_controls_section(); // Style Slider arrow style end

        // Style Pagination button tab section
        $this->start_controls_section(
            'post_slider_pagination_style_section',
            [
                'label' => __( 'Pagination', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'slider_on' => 'yes',
                    'sldots'=>'yes'
                ]
            ]
        );
            
            $this->start_controls_tabs('pagination_style_tabs');

                $this->start_controls_tab(
                    'pagination_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'jupitercore' ),
                    ]
                );

                    $this->add_responsive_control(
                        'slider_pagination_height',
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
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_pagination_width',
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
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'pagination_background',
                            'label' => __( 'Background', 'jupitercore' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_margin',
                        [
                            'label' => __( 'Margin', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'pagination_border',
                            'label' => __( 'Border', 'jupitercore' ),
                            'selector' => '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'pagination_style_active_tab',
                    [
                        'label' => __( 'Active', 'jupitercore' ),
                    ]
                );
                    
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'pagination_hover_background',
                            'label' => __( 'Background', 'jupitercore' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li:hover, {{WRAPPER}} .jupitercore-carousel-activation .slick-dots li.slick-active',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'pagination_hover_border',
                            'label' => __( 'Border', 'jupitercore' ),
                            'selector' => '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li:hover, {{WRAPPER}} .jupitercore-carousel-activation .slick-dots li.slick-active',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li.slick-active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();
        
        
        
		$this->start_controls_section(
			'button_style_section',
			[
				'label' => __( 'Load Button', 'jupitercore' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'load_more' => 'yes',
                    'slider_on!' => 'yes',
                ]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .loaded-items .el-button',
			]
		);
          $this->add_responsive_control(
            'load_more_align',
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
                    '{{WRAPPER}} .load-button' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
                'separator' =>'before',
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
			'button_text_color',
			[
				'label' => __( 'Text Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .loaded-items .el-button' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background_color',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .loaded-items .el-button',
                'separator' =>'before',
            ]
        );



		$this->add_control(
			'load_button_position',
			[
				'label' => __( 'Position', 'jupitercore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'relative',
				'options' => [
					'static'  => __( 'Static', 'jupitercore' ),
					'relative' => __( 'Relative', 'jupitercore' ),
					'absolute' => __( 'Absolute', 'jupitercore' ),
					'fixed' => __( 'Fixed', 'jupitercore' ),
				],
                'selectors' => [
                    '{{WRAPPER}} .loaded-items .el-button' => 'position: {{VALUE}}',
                ],
			]
		);

        $this->add_responsive_control(
            'load_button_position_define',
            [
                'label' => __( 'Position Align', 'jupitercore' ),
                'type' => Controls_Manager::TEXT,
                'selectors' => [
                    '{{WRAPPER}} .loaded-items .el-button' => '{{VALUE}}',
                ],
                'default' => '',
                'condition' => [
                        'load_button_position!' => 'static'
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '15',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .loaded-items .el-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'top' => '18',
                    'right' => '50',
                    'bottom' => '18',
                    'left' => '50',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .loaded-items .el-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );   
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .loaded-items .el-button',
			]
		);

        $this->add_control(
			'button_radius',
			[
				'label' => __( 'Border Radius', 'jupitercore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],                
                'default' => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                    'isLinked' => false
                ],
				'selectors' => [
					'{{WRAPPER}} .loaded-items .el-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .loaded-items .el-button',
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
			'button_hover_color',
			[
				'label' => __( 'Text Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
                'default' => '#8A19FA',
				'selectors' => [
					'{{WRAPPER}} .loaded-items .el-button:hover' => 'color: {{VALUE}};',
				],
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
                'name' => 'button_background_hover_color',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .el-button:before',
                'separator' =>'before',
            ]
        );

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .loaded-items .el-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .loaded-items .el-button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
        
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
        $html = '';
        $allowed_atts = wp_kses_allowed_html('post');
        unset($allowed_atts["p"]);
        $this->add_render_attribute( 'jupiter_feature_load_attr', 'class', 'feature-load-box-area' );
        if( $settings['load_more'] == 'yes' ){
            $load_settings = [
                'loaded_item' => $settings['loaded_item'],
                'load_slice' => $settings['load_slice']
            ];            
            $this->add_render_attribute( 'jupiter_feature_load_attr', 'class', 'loaded-items' );
            $this->add_render_attribute( 'jupiter_feature_load_attr', 'data-load', wp_json_encode( $load_settings ) );
        }
        if( $settings['slider_on'] == 'yes' ){
            $slider_settings = [
                'arrows' => ('yes' === $settings['slarrows']),
                'arrow_prev_txt' => $settings['slprevicon'],
                'arrow_next_txt' => $settings['slnexticon'],
                'dots' => ('yes' === $settings['sldots']),
                'autoplay' => ('yes' === $settings['slautolay']),
                'autoplay_speed' => absint($settings['slautoplay_speed']),
                'animation_speed' => absint($settings['slanimation_speed']),
                'pause_on_hover' => ('yes' === $settings['slpause_on_hover']),
                'center_mode' => ( 'yes' === $settings['slcentermode']),
                'vertical_mode' => ( 'yes' === $settings['slverticalmode']),
                'center_padding' => $settings['slcenterpadding'].'px',
            ];
            $slider_responsive_settings = [
                'display_columns' => $settings['slitems'],
                'scroll_columns' => $settings['slscroll_columns'],
                'tablet_width' => $settings['sltablet_width'],
                'tablet_display_columns' => $settings['sltablet_display_columns'],
                'tablet_scroll_columns' => $settings['sltablet_scroll_columns'],
                'mobile_width' => $settings['slmobile_width'],
                'mobile_display_columns' => $settings['slmobile_display_columns'],
                'mobile_scroll_columns' => $settings['slmobile_scroll_columns'],

            ];
            $this->add_render_attribute( 'jupiter_feature_load_attr', 'class', 'jupitercore-carousel-activation' );
            $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );
            $this->add_render_attribute( 'jupiter_feature_load_attr', 'data-settings', wp_json_encode( $slider_settings ) );
            
        }else{
            $this->add_render_attribute( 'jupiter_feature_load_attr', 'class', 'feature-load-grid' );
        }
		if ( $settings['item_list'] ) {
            $html .= '<div '.$this->get_render_attribute_string( "jupiter_feature_load_attr" ).'>';
			foreach (  $settings['item_list'] as $item ) {
                $feature_load_image = Group_Control_Image_Size::get_attachment_image_html( $item, 'feature_load_imagesize', 'feature_load_image' );
                $html .= '<div class="feature-load-item">';                
                $html .= '<div class="feature-load-box">';                
                if( $item['feature_icon_type'] == 'img' and !empty($feature_load_image) ){
                    $html .= '<div class="feature-icon image-icon">'.$feature_load_image.'</div>';
                }elseif( $item['feature_icon_type'] == 'icon' and !empty($item['feature_icon']) ){
                    $html .= '<div class="feature-icon font-icon"><i class="'.esc_attr($item['feature_icon']).'"></i></div>';
                }elseif( $item['feature_icon_type'] == 'text' and !empty($item['feature_icon_text']) ){ 
                    $html .= '<div class="feature-icon font-text">'.esc_html($item['feature_icon_text']).'</div>';
                }
                $html .= '<div class="box-content">';           
                if( !empty( $item['feature_load_link']['url'] ) and !empty($item['feature_load_main_title']) ) {
                    $url_data = array();                    
                    $url_data[] = 'href="'.esc_url($item['feature_load_link']['url']).'"';
                    if ( $item['feature_load_link']['is_external'] ) {
                        $url_data[] = 'target="'.esc_attr('_blank').'"';
                    }
                    if ( !empty( $item['feature_load_link']['nofollow'] ) ) {
                        $url_data[] = 'rel="'.esc_attr('nofollow').'"';
                    }                                     
                    $html .= '<h3 class="main-title"><a '.implode( ' ',$url_data ).' >'.wp_kses($item['feature_load_main_title'],$allowed_atts).'</a></h3>';    
                    unset($url_data);
                }elseif( !empty($item['feature_load_main_title']) ){
                    $html .= '<h3 class="main-title">'.wp_kses($item['feature_load_main_title'],$allowed_atts).'</h3>';
                }
                if( !empty($item['feature_load_content']) ){
                    $html .= '<div class="box-desc">'.wp_kses_post($item['feature_load_content']).'</div>';
                }
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
		}
        if( empty($settings['load_button_text']) ){
            $settings['load_button_text'] = esc_html__( 'Load More','jupitercore' );
        }
        if( $settings['load_more'] == 'yes' ){            
            $html .= '<div class="load-button" >';
            $html .= '<button type="button" class="el-button '.$settings['button_ov_position'].'" >'.wp_kses_post($settings['load_button_text']).'</button>';
            $html .= '</div>';
        }
        $html .= '</div>';
	}
    echo $html;
}// End Rendar
}// End Class
Plugin::instance()->widgets_manager->register_widget_type( new jupiter_feature_load_Boxes );