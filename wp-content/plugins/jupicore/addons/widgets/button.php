<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * jupitercore button widget.
 *
 * jupitercore widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class jupiter_Arrow_Button extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * Retrieve button widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'jupiter_button';
    }

	/**
	 * Get widget title.
	 *
	 * Retrieve button widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Button', 'jupitercore' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve button widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-button';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the button widget belongs to.
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
            'lity-lightbox-js',
        ];
    }
    public function get_style_depends() {
        return [
            'lity-lightbox-css',
        ];
    }
    

	/**
	 * Register button widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Button', 'jupitercore' ),
			]
		);
        
		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'jupitercore' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Button Text', 'jupitercore' ),
				'placeholder' => __( 'Enter Button Text...', 'jupitercore' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'jupitercore' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'jupitercore' ),
				'default' => [
					'url' => '#',
				],
			]
		);
        $this->add_control(
			'show_icon',
			[
				'label' => __( 'Enable Icon', 'jupitercore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'jupitercore' ),
				'label_off' => __( 'Hide', 'jupitercore' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'jupitercore' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'fa fa-arrow-right',
                'condition' => [
					'show_icon' => 'yes',
				],
			]
		);
        
		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'jupitercore' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'button_css_id',
			[
				'label' => __( 'Button ID', 'jupitercore' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
				'title' => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'jupitercore' ),
				'label_block' => false,
				'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'jupitercore' ),
				'separator' => 'before',

			]
		);

        $this->add_control(
			'lightbox_enabel',
			[
				'label' => __( 'Lightbox Enable', 'jupitercore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'jupitercore' ),
				'label_off' => __( 'Hide', 'jupitercore' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Button', 'jupitercore' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .el-button' => 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_color',
				'label' => __( 'Background', 'jupitercore' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .el-button',
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
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'top' => '15',
                    'right' => '40',
                    'bottom' => '15',
                    'left' => '40',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .el-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
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
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}, {{WRAPPER}} .el-button' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}' => 'display: inline-block',
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
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}},{{WRAPPER}} .el-button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .el-button',
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
					'{{WRAPPER}} .el-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .el-button',
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
                'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .el-button:hover' => 'color: {{VALUE}};',
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
				'name' => 'hover_background',
				'label' => __( 'Hover Background', 'jupitercore' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .el-button:before',
			]
		);
        
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .el-button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
       $this->add_responsive_control(
            'button_text_align',
            [
                'label' => __( 'Icon Alignment', 'jupitercore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'inline-flex;align-items:center;text-align: left;' => [
                        'title' => __( 'Left', 'jupitercore' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'inline-flex;flex-direction: column;justify-content: center;text-align: center;align-items: center;text-align: center;' => [
                        'title' => __( 'Center', 'jupitercore' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'inline-flex;flex-direction: row-reverse;text-align: right;align-items: center; text-align: right;' => [
                        'title' => __( 'Right', 'jupitercore' ),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .el-button' => 'display: {{VALUE}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_responsive_control(
            'button_custom_css',
            [
                'label' => __( 'Custom CSS', 'jupitercore' ),
                'type' => Controls_Manager::CODE,
				'rows' => 20,
                'language' => 'css',
                'selectors' => [
                    '{{WRAPPER}}' => '{{VALUE}};',
                ],
                'separator' =>'before',
            ]
        );

		$this->end_controls_section();
        
        
        
        // Text Box Style tab section
        $this->start_controls_section(
            'text_style_section',
            [
                'label' => __( 'Text Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'text!' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_text_typography',
                'selector' => '{{WRAPPER}} .el-button .button-text',
            ]
        );     
        
        $this->add_control(
			'button_title_color',
			[
				'label' => __( 'Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el-button:hover .button-text' => 'color: {{VALUE}};',
				],
			]
		);    
        $this->add_control(
			'button_hover_title_color',
			[
				'label' => __( 'Hover Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el-button:hover .button-text' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_responsive_control(
            'button_text_margin',
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
                    '{{WRAPPER}} .el-button .button-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'button_text_padding',
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
                    '{{WRAPPER}} .el-button .button-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );   
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_text_border',
				'label' => __( 'Border', 'jupitercore' ),
				'selector' => '{{WRAPPER}} .el-button .button-text',
			]
		);
        $this->end_controls_section();
	}

	/**
	 * Render button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();        
		$this->add_render_attribute( 'button_attr', 'class', 'el-button' );
        $this->add_render_attribute( 'button_attr', 'class', $settings['button_ov_position'] ); 
        if( $settings['lightbox_enabel'] == 'yes' ){
		  $this->add_render_attribute( 'button_attr', 'data-lity', 'true' );            
        }
        if( !empty($settings['button_css_id']) ){
            $this->add_render_attribute( 'button_attr', 'id', 'el-button-'.$settings['button_css_id'] );
        }
        // Link Generate
        if ( !empty( $settings['link']['url'] ) ) {
            $this->add_render_attribute( 'button_attr', 'href', esc_url($settings['link']['url']) );            
            if ( $settings['link']['is_external'] ) {
                $this->add_render_attribute( 'button_attr', 'target', '_blank' );
            }
            if ( !empty( $settings['link']['nofollow'] ) ) {
                $this->add_render_attribute( 'button_attr', 'rel', 'nofollow' );
            }
        }
        $output = $output_content = ''; 
        if( !empty($settings['icon'] and  $settings['show_icon'] == 'yes' )){
            $output_content .= '<span class="button-icon">';
            $output_content .= '<i class="'.esc_attr($settings['icon']).'"></i>';
            $output_content .= '</span>';
        }
        if( !empty($settings['text']) ){
            $output_content .= '<span class="button-text">'.esc_html($settings['text']).'</span>';
        }
        if( !empty($output_content) ){
            $output .= '<a '.$this->get_render_attribute_string( 'button_attr' ).'>';        
            $output .= $output_content;        
            $output .= '</a>';
        }
        echo $output;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new jupiter_Arrow_Button );