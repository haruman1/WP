<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class jupiter_Text_Box extends Widget_Base{

	public function get_name(){
		return "jupiter-text-box";
	}    
    
	public function get_title(){
		return __( 'Text Box','jupitercore' );
	}
    
	public function get_icon() {
		return "eicon-text-area";
	}
    
	public function get_categories() {
		return [ 'jupiter-addons' ];
	}
    
    protected function  _register_controls(){
        
        $this->start_controls_section(
            'text_box_content',
            [
                'label' => __( 'Text Box', 'jupitercore' ),
            ]
        );        
        $this->add_control(
            'box_top_title_text',
            [
                'label' => __( 'Top Title', 'jupitercore' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your top title', 'jupitercore' ),
                'title' => __( 'Enter your top title', 'jupitercore' ),
            ]
        );
        $this->add_control(
            'box_title_text',
            [
                'label' => __( 'Title', 'jupitercore' ),
				'type' => Controls_Manager::WYSIWYG,
                'placeholder' => __( 'Enter your title', 'jupitercore' ),
                'default' => 'This is a main title.',
                'title' => __( 'Enter your title', 'jupitercore' ),
            ]
        );
        
        $this->add_control(
			'box_description',
			[
				'label' => __( 'Description', 'jupitercore' ),
				'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'The world calls for, and expects from us, simplicity of life, the spirit of prayer, charity towards all, especially towards the lowly and the poor.','jupitercore' ),
				'placeholder' => __( 'Type your description here', 'jupitercore' ),
			]
		);
        
         $this->add_responsive_control(
            'box_text_align',
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
                    '{{WRAPPER}} .jupiter-text-box' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'separator' =>'before',
            ]
        );
        $this->end_controls_section();
    
        // Text Box Style tab section
        $this->start_controls_section(
            'top_title_section',
            [
                'label' => __( 'Top Title Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'top_title_typography',
                'selector' => '{{WRAPPER}} .jupiter-text-box .top-title',
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
                    '{{WRAPPER}} .jupiter-text-box .top-title' => 'color: {{VALUE}};',
                ],
            ]
        );  
                
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'top_title_background',
                'label' => __( 'Background', 'jupitercore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .jupiter-text-box .top-title',
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
                    '{{WRAPPER}} .jupiter-text-box .top-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .jupiter-text-box .top-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );   
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'top_title_border',
				'label' => __( 'Border', 'jupitercore' ),
				'selector' => '{{WRAPPER}} .jupiter-text-box .top-title',
			]
		);
        $this->add_control(
			'top_title_radius',
			[
				'label' => __( 'Border Radius', 'jupitercore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],                
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => false
                ],
				'selectors' => [
					'{{WRAPPER}} .jupiter-text-box .top-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
        
        
            
        // Text Box Style tab section
        $this->start_controls_section(
            'main_title_section',
            [
                'label' => __( 'Main Title Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'main_title_typography',
                'selector' => '{{WRAPPER}} .jupiter-text-box .title',
            ]
        );
        $this->add_control(
            'main_title_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#151D41',
                'selectors' => [
                    '{{WRAPPER}} .jupiter-text-box .title' => 'color: {{VALUE}};',
                ],
            ]
        );                
        $this->add_responsive_control(
            'main_title_margin',
            [
                'label' => __( 'Margin', 'jupitercore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '30',
                    'left' => '0',
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .jupiter-text-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'main_title_padding',
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
                    '{{WRAPPER}} .jupiter-text-box .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );   
        
        $this->end_controls_section();        
        // Text Box Style tab section
        $this->start_controls_section(
            'desc_section',
            [
                'label' => __( 'Desc Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .jupiter-text-box .desc',
            ]
        );
        $this->add_control(
            'desc_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => 'rgba(21, 29, 65, 0.6)',
                'selectors' => [
                    '{{WRAPPER}} .jupiter-text-box .desc' => 'color: {{VALUE}};',
                ],
            ]
        );                
        $this->add_responsive_control(
            'desc_margin',
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
                    '{{WRAPPER}} .jupiter-text-box .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'desc_padding',
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
                    '{{WRAPPER}} .jupiter-text-box .desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );   
        
        $this->end_controls_section();
        
    }
    protected function render() {        
        $settings   = $this->get_settings_for_display();
        $this->add_render_attribute( 'box_area_attr', 'class', 'jupiter-text-box' );
        $allowed_atts = wp_kses_allowed_html('post');
        unset($allowed_atts["p"]);
        $output = '';        
        $output .= '<div '.$this->get_render_attribute_string('box_area_attr').'>';
        if( !empty($settings['box_top_title_text']) ){
            $output .= '<div class="top-title">'.esc_html($settings['box_top_title_text']).'</div>';
        }
        if( !empty($settings['box_title_text']) ){
            $output .= '<h2 class="title">'.wp_kses( $settings['box_title_text'], $allowed_atts ).'</h2>';
        }
        if( !empty($settings['box_description']) ){
            $output .= '<div class="desc">'.do_shortcode(wp_kses_post( $settings['box_description'])).'</div>';
        }
        $output .= '</div>';        
        echo $output;
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new jupiter_Text_Box );