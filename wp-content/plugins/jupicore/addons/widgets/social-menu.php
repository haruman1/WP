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
class jupiter_Social_Link extends Widget_Base {
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
        return 'jupiter-social-button';
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
		return __( 'Social Link', 'jupitercore' );
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
		return 'eicon-social-icons';
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
			'social_button_section',
			[
				'label' => __( 'Social Link', 'jupitercore' ),
			]
		);


        $repeater = new Repeater(); 
        $repeater->add_control(
            'social_icon',
            [
                'label' => __( 'Icon', 'jupitercore' ),
                'type' => Controls_Manager::ICON,
                'label_block' => true,
                'default' => 'fa fa-facebook'
            ]
        );
        $repeater->add_control(
            'social_title',
            [
                'label'   => __( 'Title', 'jupitercore' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Facebook','jupitercore'),
            ]
        );
		$repeater->add_control(
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
            'jupiter_social_menu_list',
            [
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'social_icon'           => 'fa fa-facebook',
                        'social_title'           => 'Facebook',
                    ],
                ],
                'title_field' => '{{{ social_title }}}',
            ]
        );

		$this->end_controls_section();
        
        
        
        
        // Style tab area tab section
        $this->start_controls_section(
            'jupiter_social_style_area',
            [
                'label' => __( 'Area Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
              $this->add_responsive_control(
                'social_items_align',
                [
                    'label' => __( 'Alignment', 'jupiter' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'jupiter' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'jupiter' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'jupiter' ),
                            'icon' => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'jupiter' ),
                            'icon' => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-social-menu' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                ]
            );
            $this->add_responsive_control(
                'jupiter_social_section_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-social-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'jupiter_social_section_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
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
                        '{{WRAPPER}} .jupiter-social-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'jupiter_social_section_bg',
                    'label' => __( 'Background', 'jupitercore' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .jupiter-social-menu',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'jupiter_social_section_border',
                    'label' => __( 'Border', 'jupitercore' ),
                    'selector' => '{{WRAPPER}} .jupiter-social-menu',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'jupiter_social_section_shadow',
                    'label' => __( 'Box Shadow', 'jupitercore' ),
                    'selector' => '{{WRAPPER}} .jupiter-social-menu',
                ]
            );
        $this->end_controls_section();
		$this->start_controls_section(
			'social_button_style_section',
			[
				'label' => __( 'Button', 'jupitercore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .jupiter-social-menu a.social-button',
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
				'default' => '#7e8da2',
				'selectors' => [
					'{{WRAPPER}} .jupiter-social-menu a.social-button' => 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_color',
				'label' => __( 'Background', 'jupitercore' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .jupiter-social-menu a.social-button',
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
                    '{{WRAPPER}} .jupiter-social-menu a.social-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .jupiter-social-menu a.social-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .jupiter-social-menu a.social-button',
			]
		);

        $this->add_control(
			'button_radius',
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
					'{{WRAPPER}} .jupiter-social-menu a.social-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .jupiter-social-menu a.social-button',
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
					'{{WRAPPER}} .jupiter-social-menu a.social-button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jupiter-social-menu a.social-button .name' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hover_button_background',
				'label' => __( 'Hover Background', 'jupitercore' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .jupiter-social-menu a.social-button:before',
			]
		);
        
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'jupitercore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jupiter-social-menu a.social-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .jupiter-social-menu a.social-button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
        if( count($settings['jupiter_social_menu_list']) > 0 ){
            echo '<div class="jupiter-social-menu">';
            foreach( $settings['jupiter_social_menu_list'] as $items ){
                if ( !empty( $items['link']['url'] ) ) {
                    $link = array();
                    $link[] = 'href="'.esc_url($items['link']['url']).'"';
                    if ( $items['link']['is_external'] ) {
                        $link[] = 'target="_blank"';
                    }
                    if ( !empty( $items['link']['nofollow'] ) ) {
                        $link[] = 'rel="nofollow"';
                    }
                }
                echo '<a '.implode( ' ', $link ).' class="social-button">';
                echo '<span class="icon"><i class="'.esc_attr($items['social_icon']).'"></i></span>';
                if( !empty($items['social_title']) ){
                    echo '<span class="name">'.esc_html($items['social_title']).'</span>';
                }
                echo '</a>';
                unset($link);
            }
            echo '</div>';
        }
            
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new jupiter_Social_Link );