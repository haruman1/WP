<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * jupitercore shortcode-form widget.
 *
 * jupitercore widget that displays a shortcode-form with the ability to control every
 * aspect of the shortcode-form design.
 *
 * @since 1.0.0
 */
class jupiter_Subscribe_Form extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * Retrieve shortcode-form widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'jupiter_Subscribe_Form';
    }

	/**
	 * Get widget title.
	 *
	 * Retrieve shortcode-form widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Form Shortcode', 'jupitercore' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve shortcode-form widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-shortcode';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the shortcode-form widget belongs to.
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

	/**
	 * Register shortcode-form widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		
        
		$this->start_controls_section(
			'subscribe_section_start',
			[
				'label' => __( 'Subscribe Form', 'jupitercore' ),
			]
		);
        
        $this->add_control(
			'shortcode_box',
			[
				'label' => __( 'Shortcode', 'jupitercore' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'description' => __( 'Please enter MailChimp form Shortcode.','jupiter' ),
				'default' => '[mc4wp_form id="665"]',
				'placeholder' => '[mc4wp_form id="665"]',
			]
		);

		$this->end_controls_section();
        
        // Text Box Style tab section
        $this->start_controls_section(
            'top_title_section',
            [
                'label' => __( 'Lavel', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'top_title_typography',
                'selector' => '{{WRAPPER}} label',
            ]
        );
        $this->add_control(
            'top_title_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#98a9c2',
                'selectors' => [
                    '{{WRAPPER}} label' => 'color: {{VALUE}};',
                ],
            ]
        );                
        $this->add_responsive_control(
            'top_title_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '15',
                    'left' => '0',
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'top_title_padding',
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
                    '{{WRAPPER}} label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );   
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'top_title_border',
				'label' => __( 'Border', 'jupitercore' ),
				'selector' => '{{WRAPPER}} label',
			]
		);
        $this->add_responsive_control(
            'custom_top_title_css',
            [
                'label' => __( 'Lavel Custom CSS', 'jupitercore' ),
                'type' => Controls_Manager::CODE,
				'rows' => 20,
                'language' => 'css',
                'selectors' => [
                    '{{WRAPPER}} label' => '{{VALUE}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
			'input_style_section',
			[
				'label' => __( 'Input Field', 'jupitercore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'input_typography',
				'selector' => '{{WRAPPER}} input[type="text"],{{WRAPPER}} input[type="url"],{{WRAPPER}} input[type="email"],{{WRAPPER}} textarea',
			]
		);
		
        $this->add_responsive_control(
            'input_box_height',
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
                    '{{WRAPPER}} input[type="text"],{{WRAPPER}} input[type="url"],{{WRAPPER}} input[type="email"],{{WRAPPER}} textarea' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_box_width',
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
                    '{{WRAPPER}} input[type="text"],{{WRAPPER}} input[type="url"],{{WRAPPER}} input[type="email"],{{WRAPPER}} textarea' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->start_controls_tabs( 'tabs_input_style' );

		$this->start_controls_tab(
			'tab_input_normal',
			[
				'label' => __( 'Normal', 'jupitercore' ),
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label' => __( 'Text Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#79879d',
				'selectors' => [
					'{{WRAPPER}} input[type="text"],{{WRAPPER}} input[type="url"],{{WRAPPER}} input[type="email"],{{WRAPPER}} textarea, {{WRAPPER}} ::placeholder' => 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'input_background_color',
				'label' => __( 'Background', 'jupitercore' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} input[type="text"],{{WRAPPER}} input[type="url"],{{WRAPPER}} input[type="email"],{{WRAPPER}} textarea'
			]
		);
        
        $this->add_responsive_control(
            'input_margin',
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
                    '{{WRAPPER}} input[type="text"],{{WRAPPER}} input[type="url"],{{WRAPPER}} input[type="email"],{{WRAPPER}} textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'input_padding',
            [
                'label' => __( 'Padding', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '22',
                    'right' => '30',
                    'bottom' => '22',
                    'left' => '30',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} input[type="text"],{{WRAPPER}} input[type="url"],{{WRAPPER}} input[type="email"],{{WRAPPER}} textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );   
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'input_border',
				'selector' => '{{WRAPPER}} input[type="text"],{{WRAPPER}} input[type="email"],{{WRAPPER}} input[type="url"],{{WRAPPER}} textarea',
			]
		);

        $this->add_control(
			'input_radius',
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
                    '{{WRAPPER}} input[type="text"],{{WRAPPER}} input[type="url"],{{WRAPPER}} input[type="email"],{{WRAPPER}} textarea' => 'border-radius : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_box_shadow',
				'selector' => '{{WRAPPER}} input[type="text"],{{WRAPPER}} input[type="url"],{{WRAPPER}} input[type="email"],{{WRAPPER}} textarea',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => __( 'Focus', 'jupitercore' ),
			]
		);

		$this->add_control(
			'input_focus_color',
			[
				'label' => __( 'Text Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
                'default' => '#79879d',
				'selectors' => [
					'{{WRAPPER}} input[type="text"]:focus,{{WRAPPER}} input[type="url"]:focus,{{WRAPPER}} input[type="email"]:focus,{{WRAPPER}} textarea:focus' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'input_focus_background',
				'label' => __( 'focus Background', 'jupitercore' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} input[type="text"]:focus,{{WRAPPER}} input[type="url"]:focus,{{WRAPPER}} input[type="email"]:focus,{{WRAPPER}} textarea:focus'
			]
		);
        
		$this->add_control(
			'input_focus_border_color',
			[
				'label' => __( 'Border Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} input[type="text"]:focus,{{WRAPPER}} input[type="url"]:focus,{{WRAPPER}} input[type="email"]:focus,{{WRAPPER}} textarea:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_focus_box_shadow',
				'selector' => '{{WRAPPER}} input[type="text"]:focus,{{WRAPPER}} input[type="url"]:focus,{{WRAPPER}} input[type="email"]:focus,{{WRAPPER}} textarea:focus',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		        $this->add_responsive_control(
            'custom_input_css',
            [
                'label' => __( 'Input Field CSS', 'jupitercore' ),
                'type' => Controls_Manager::CODE,
				'rows' => 20,
                'language' => 'css',
                'selectors' => [
                    '{{WRAPPER}} input[type="text"],{{WRAPPER}} input[type="url"],{{WRAPPER}} input[type="email"],{{WRAPPER}} textarea' => '{{VALUE}};',
                ],
                'separator' =>'before',
            ]
        );

		$this->end_controls_section();
        
        
        $this->start_controls_section(
			'button_section_style',
			[
				'label' => __( 'Button', 'jupitercore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} input[type="submit"], {{WRAPPER}} button',
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
                    '{{WRAPPER}} input[type="submit"], {{WRAPPER}} button' => 'height: {{SIZE}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} input[type="submit"], {{WRAPPER}} button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
         $this->add_responsive_control(
            'button_floting',
            [
                'label' => __( 'Button Floating', 'jupitercore' ),
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
                    '{{WRAPPER}} input[type="submit"], {{WRAPPER}} button' => 'float: {{VALUE}};',
                ],
                'default' => 'none',
                'separator' =>'before',
            ]
        );
        $this->add_control(
            'jupiter_button_height',
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
                    '{{WRAPPER}} button' => 'height: {{SIZE}}{{UNIT}};',
                ],
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
					'{{WRAPPER}} input[type="submit"], {{WRAPPER}} button' => 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_color',
				'label' => __( 'Background', 'jupitercore' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} input[type="submit"], {{WRAPPER}} button',
			]
		);
        
        $this->add_responsive_control(
            'button_margin',
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
                    '{{WRAPPER}} input[type="submit"], {{WRAPPER}} button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'top' => '22',
                    'right' => '40',
                    'bottom' => '22',
                    'left' => '40',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} input[type="submit"], {{WRAPPER}} button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );   
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} input[type="submit"], {{WRAPPER}} button',
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
					'{{WRAPPER}} input[type="submit"], {{WRAPPER}} button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} input[type="submit"], {{WRAPPER}} button',
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
                'default' => '#004dcc',
				'selectors' => [
					'{{WRAPPER}} input[type="submit"]:hover, {{WRAPPER}} button:hover' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_hover_background',
				'label' => __( 'Hover Background', 'jupitercore' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} input[type="submit"]:hover, {{WRAPPER}} button:before',
			]
		);
        
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} input[type="submit"]:hover, {{WRAPPER}} button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} input[type="submit"]:hover, {{WRAPPER}} button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
        
        
	}

	/**
	 * Render shortcode-form widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();        
		
?>
   <div class="shortcode-form">
       <?php echo do_shortcode( shortcode_unautop( $settings['shortcode_box'] ) ); ?>
   </div>
   <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new jupiter_Subscribe_Form );