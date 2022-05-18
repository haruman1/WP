<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * jupitercore Team widget.
 *
 * jupitercore widget that displays a Team with the ability to control every
 * aspect of the Team design.
 *
 * @since 1.0.0
 */
class jupiter_Team_Box extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Team widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'jupiter-team-addons';
    }

	/**
	 * Get widget title.
	 *
	 * Retrieve Team widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Team', 'jupitercore' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Team widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-lock-user';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Team widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'jupiter-addons' ];
	}
    
    
    public function get_script_depends() {
        return [
            'slick',
            'el-widget-active',
        ];
    }

	/**
	 * Register Team widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_team',
			[
				'label' => __( 'Team Membar', 'jupitercore' ),
			]
		);
        
        
        $repeater = new Repeater();    

		$repeater->add_control(
			'team_image',
			[
				'label' => __( 'Choose Image', 'jupitercore' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
        
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'team_image_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `team_image_size` and `team_image_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);        
		$repeater->add_control(
			'team_posi',
			[
				'label' => __( 'Position', 'jupitercore' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Designer',
			]
		);        
        $repeater->add_control(
			'team_name',
			[
				'label' => __( 'Name', 'jupitercore' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'John Doe',
			]
		);
		$repeater->add_control(
			'fv_link',
			[
				'label' => __( 'Facebook URL', 'jupitercore' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://facebook.com', 'jupitercore' ),
			]
		);
		$repeater->add_control(
			'tw_link',
			[
				'label' => __( 'Twitter URL', 'jupitercore' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://twitter.com', 'jupitercore' ),
			]
		);
		$repeater->add_control(
			'bh_link',
			[
				'label' => __( 'Behance URL', 'jupitercore' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://behance.com', 'jupitercore' ),
			]
		);
		$repeater->add_control(
			'lnk_link',
			[
				'label' => __( 'Linkedin URL', 'jupitercore' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://linkedin.com', 'jupitercore' ),
			]
		);
        
        $this->add_control(
            'jupiter_team_list',
            [
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [

                        [
                            'team_posi'      => __('Founder','jupitercore'),
                            'team_name'      => __('Rosalind D. William','jupitercore'),
                            'fv_link'        => __('#','jupitercore'),
                            'tw_link'        => __('#','jupitercore'),
                            'bh_link'        => __('#','jupitercore'),
                            'lnk_link'       => __('#','jupitercore'),
                        ],
                        [
                            'team_posi'      => __('Founder','jupitercore'),
                            'team_name'      => __('Rosalind D. William','jupitercore'),
                            'fv_link'        => __('#','jupitercore'),
                            'tw_link'        => __('#','jupitercore'),
                            'bh_link'        => __('#','jupitercore'),
                            'lnk_link'       => __('#','jupitercore'),
                        ],
                        [
                            'team_posi'      => __('Founder','jupitercore'),
                            'team_name'      => __('Rosalind D. William','jupitercore'),
                            'fv_link'        => __('#','jupitercore'),
                            'tw_link'        => __('#','jupitercore'),
                            'bh_link'        => __('#','jupitercore'),
                            'lnk_link'       => __('#','jupitercore'),
                        ],
                        [
                            'team_posi'      => __('Founder','jupitercore'),
                            'team_name'      => __('Rosalind D. William','jupitercore'),
                            'fv_link'        => __('#','jupitercore'),
                            'tw_link'        => __('#','jupitercore'),
                            'bh_link'        => __('#','jupitercore'),
                            'lnk_link'       => __('#','jupitercore'),
                        ],
                ],
                'title_field' => '{{{ team_name }}}',
            ]
        );
        
        $this->add_control(
            'slider_on',
            [
                'label' => esc_html__( 'Slider', 'jupitercore' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'separator'=>'before',
            ]
        );
		$this->end_controls_section();
        
              
        // Carousel setting
        $this->start_controls_section(
            'slider_option',
            [
                'label' => esc_html__( 'Carousel Option', 'jupitercore' ),
                'condition' => [
                    'slider_on' => 'yes',
                ]
            ]
        );

            $this->add_control(
                'slitems',
                [
                    'label' => esc_html__( 'Slider Items', 'jupitercore' ),
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
                    'label' => esc_html__( 'Slider Arrow', 'jupitercore' ),
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
                    'label' => esc_html__( 'Slider dots', 'jupitercore' ),
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
                    'label' => esc_html__( 'Center Mode', 'jupitercore' ),
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
                    'label' => esc_html__( 'Center padding', 'jupitercore' ),
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
                    'label' => esc_html__( 'Slider auto play', 'jupitercore' ),
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
                    'default' => 1,
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
                    'default' => 750,
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
        
        
        
        
        
        
        
        
        
        // team Style tab section
        $this->start_controls_section(
            'jupitercore_team_area_style_section',
            [
                'label' => __( 'Area Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'team_area_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'team_area_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
         
		$this->add_responsive_control(
			'team_area_width',
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
					'{{WRAPPER}} .team-member-area' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);  
        $this->end_controls_section(); // team section style end
        
        
        
        
        // Service Style tab section
        $this->start_controls_section(
            'testimonial_column_style_section',
            [
                'label' => __( 'Column Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on!' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'testimonial_column_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member-area .jupiter-team-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );        
        $this->add_responsive_control(
            'testimonial_column_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member-area .jupiter-team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );        
		$this->add_responsive_control(
			'testimonial_column_width',
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
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .team-member-area .jupiter-team-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
        
        
        
        
        // team Style tab section
        $this->start_controls_section(
            'jupitercore_team_box_style_section',
            [
                'label' => __( 'Box Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'team_text_align',
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
                    '{{WRAPPER}} .jupiter-team-box' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
                'separator' =>'before',
            ]
        );
        $this->add_responsive_control(
            'team_box_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member-area .jupiter-team-content .jupiter-team-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        ); 
        $this->add_responsive_control(
            'team_box_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member-area .jupiter-team-content .jupiter-team-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );   
		$this->add_responsive_control(
			'box_width',
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
					'{{WRAPPER}} .team-member-area .jupiter-team-content .jupiter-team-box' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);        
        $this->end_controls_section(); // team section style end
                
        
        
        
        
        // Feature Style tab section
        $this->start_controls_section(
            'team_image_style_section',
            [
                'label' => __( 'Image Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
		$this->add_control(
			'image_width',
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
					'{{WRAPPER}} .jupiter-team-box .image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);        
        
		$this->add_control(
			'image_height',
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
					'{{WRAPPER}} .jupiter-team-box .image' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jupiter-team-box .image' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image_background',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .jupiter-team-box .image',
            ]
        );
            
        $this->add_responsive_control(
            'image_margin',
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
                    '{{WRAPPER}} .jupiter-team-box .image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'image_padding',
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
                    '{{WRAPPER}} .jupiter-team-box .image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => __( 'Border', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .jupiter-team-box .image',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
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
                    '{{WRAPPER}} .jupiter-team-box .image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_shadow',
                'label' => __( 'Box Shadow', 'jupitercore' ),
                'selector' => '{{WRAPPER}} .jupiter-team-box .image',
            ]
        ); 
        $this->end_controls_section();
        
        
        
        
        
        
        
        
        
        // team Style tab section
        $this->start_controls_section(
            'name_section',
            [
                'label' => __( 'Name Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
               
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'team_title_typography',
                'selector' => '{{WRAPPER}} .jupiter-team-box .details .name',
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#0a0c19',
                'selectors' => [
                    '{{WRAPPER}} .jupiter-team-box .details .name' => 'color: {{VALUE}};',
                ],
            ]
        );
                       
        $this->add_responsive_control(
            'name_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .jupiter-team-box .details .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'name_padding',
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
                    '{{WRAPPER}} .jupiter-team-box .details .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
             
        $this->end_controls_section();
        
        
                
        // team Style tab section
        $this->start_controls_section(
            'position_section',
            [
                'label' => __( 'Position Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
               
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'position_typography',
                'selector' => '{{WRAPPER}} .jupiter-team-box .details .position',
            ]
        );
        $this->add_control(
            'position_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#3b74ff',
                'selectors' => [
                    '{{WRAPPER}} .jupiter-team-box .details .position' => 'color: {{VALUE}};',
                ],
            ]
        );
                       
        $this->add_responsive_control(
            'position_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '5',
                    'left' => '0',
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .jupiter-team-box .details .position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'position_padding',
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
                    '{{WRAPPER}} .jupiter-team-box .details .position' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );             
        $this->end_controls_section();
        // team Style tab section
        $this->start_controls_section(
            'social_section',
            [
                'label' => __( 'Social Menu', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'social_menu_background',
                'label' => __( 'Background', 'jupitercore' ),
                'default' => '#ffffff',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .jupiter-team-box .social-content',
            ]
        );
        $this->add_control(
            'social_icon_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .jupiter-team-box .social-item a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .jupiter-team-box .social-content .social-button' => 'color: {{VALUE}};'
                ],
            ]
        );
         $this->add_responsive_control(
            'social_menu_position',
            [
                'label' => __( 'Alignment', 'jupitercore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'jupitercore' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'jupitercore' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jupiter-team-box .social-content' => '{{VALUE}}: 0;',
                ],
                'default' => 'right',
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


        // Style Pagination Team tab section
        $this->start_controls_section(
            'post_slider_pagination_style_section',
            [
                'label' => __( 'Pagination', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'slider_on' => 'yes',
                    'sldots'=>'yes',
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
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'pagination_background',
                            'label' => __( 'Background', 'jupitercore' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li button',
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
                            'selector' => '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li button',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                            'selector' => '{{WRAPPER}} .jupitercore-carousel-activation .slick-dots li button:hover, {{WRAPPER}} .jupitercore-carousel-activation .slick-dots li.slick-active button',
                        ]
                    );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();
	}

	/**
	 * Render team widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
        $html = $social_html = '';
		$settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'jupiter_team_slider_attr', 'class', 'team-member-area' );
        if( $settings['slider_on'] == 'yes' ){
            $this->add_render_attribute( 'jupiter_team_slider_attr', 'class', 'jupitercore-carousel-activation' );
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
                'center_padding' => absint($settings['slcenterpadding']),
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
            $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );
            $this->add_render_attribute( 'jupiter_team_slider_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }else {            
            $this->add_render_attribute( 'jupiter_team_slider_attr', 'class', 'gird-team-members' );
        }        
        
        $html .= '<div '.$this->get_render_attribute_string( 'jupiter_team_slider_attr' ).' >';
        foreach( $settings['jupiter_team_list'] as $items ):        
        $team_image = Group_Control_Image_Size::get_attachment_image_html( $items, 'team_image_size', 'team_image' );
         if ( !empty($items['fv_link']['url']) ) {
            $social_html .= '<a href="'.esc_url($items['fv_link']['url']).'" '.( ($items['fv_link']['is_external']) ? 'target="_blank"' : '' ).' '.( (!empty( $items['fv_link']['nofollow'])) ? 'rel="nofollow"' : '' ).' ><i class="fa fa-facebook"></i></a>'; 
         }
        
         if ( !empty($items['tw_link']['url']) ) {
            $social_html .= '<a href="'.esc_url($items['tw_link']['url']).'" '.( ($items['tw_link']['is_external']) ? 'target="_blank"' : '' ).' '.( (!empty( $items['tw_link']['nofollow'])) ? 'rel="nofollow"' : '' ).' ><i class="fa fa-twitter"></i></a>'; 
         }
        
         if ( !empty($items['bh_link']['url']) ) {
            $social_html .= '<a href="'.esc_url($items['bh_link']['url']).'" '.( ($items['bh_link']['is_external']) ? 'target="_blank"' : '' ).' '.( (!empty( $items['bh_link']['nofollow'])) ? 'rel="nofollow"' : '' ).' ><i class="fa fa-behance"></i></a>'; 
         }
        
        if ( !empty($items['lnk_link']['url']) ) {
            $social_html .= '<a href="'.esc_url($items['lnk_link']['url']).'" '.( ($items['lnk_link']['is_external']) ? 'target="_blank"' : '' ).' '.( (!empty( $items['lnk_link']['nofollow'])) ? 'rel="nofollow"' : '' ).' ><i class="fa fa-linkedin"></i></a>'; 
         }
        
        $html .= '<div class="jupiter-team-content">';        
        $html .= '<div class="jupiter-team-box">';        
        if( !empty($team_image) ){   
            $html .= '<div class="image">';
            $html .= $team_image;
            $html .= '</div>';
        }    
        if( !empty($social_html) ){
            $html .= '<div class="social-area">';
            $html .= '<div class="social-content">';
            $html .= '<div class="social-item">';
            $html .= $social_html;
            $html .= '</div>';
            $html .= '<button type="button" class="social-button"><i class="fal fa-plus"></i></button>';
            $html .= '</div>';
            $html .= '</div>';
            $social_html = '';
        } 
        $html .= '<div class="details">';       
        if( !empty($items['team_name']) ){
            $html .= '<h4 class="name">'.esc_html($items['team_name']).'</h4>';
        }
        if( !empty($items['team_posi']) ){
            $html .= '<div class="position">'.esc_html($items['team_posi']).'</div>';
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';         
        endforeach;        
        $html .= '</div>';        
        echo $html;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new jupiter_Team_Box );