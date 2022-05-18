<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class jupiter_Testimonial_Widget extends Widget_Base {

    public function get_name() {
        return 'jupiter-testimonial-addons';
    }
    
    public function get_title() {
        return __( 'Testimonial', 'jupitercore' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'jupiter-addons' ];
    }

    public function get_script_depends() {
        return [
            'slick',
            'el-widget-active',
        ];
    }
    public function get_style_depends() {
        return [
            'font-awesome-5'
        ];
    }
    
    protected function _register_controls() {

        $this->start_controls_section(
            'jupiter_testimonial_content_section',
            [
                'label' => __( 'Testimonial', 'jupitercore' ),
            ]
        );

            $repeater = new Repeater(); 
            $repeater->add_control(
                'feed_rating',
                [
                    'label' => __( 'Rating Star', 'jupitercore' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 5,
                    'step' => 1,
                    'default' => 4,
                ]
            );
            $repeater->add_control(
                'feed_subject',
                [
                    'label'   => __( 'Rating Subject', 'jupitercore' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __('Design Quolity','jupitercore'),
                ]
            );
            $repeater->add_control(
                'client_say',
                [
                    'label'   => __( 'Client Say', 'jupitercore' ),
                    'type'    => Controls_Manager::TEXTAREA,
                    'default' => __('Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','jupitercore'),
                ]
            );
        
            $repeater->add_control(
                'client_name',
                [
                    'label'   => __( 'Name', 'jupitercore' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __('Carolina Monntoya','jupitercore'),
                ]
            );


            $repeater->add_control(
                'client_designation',
                [
                    'label'   => __( 'Designation', 'jupitercore' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __('Managing Director','jupitercore'),
                ]
            );
            $repeater->add_control(
                'client_designation_color',
                [
                    'label' => __( 'Designation Color', 'jupitercore' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '#00b0fa',
                ]
            );
        
            $repeater->add_control(
                'client_image',
                [
                    'label' => __( 'Image', 'jupitercore' ),
                    'type' => Controls_Manager::MEDIA,
                ]
            );

            $repeater->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'client_imagesize',
                    'default' => 'large',
                    'separator' => 'none',
                ]
            );

            $this->add_control(
                'jupiter_testimonial_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [

                        [
                            'feed_rating'           => 5,
                            'feed_subject'           => __('Design Quolity','jupitercore'),
                            'client_name'           => __('Carolina Monntoya','jupitercore'),
                            'client_designation'    => __( 'founder, uithemes','jupitercore' ),
                            'client_designation_color'    => '#00b0fa',
                            'client_say'            => __( 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'jupitercore' ),
                        ],

                        [
                            'feed_rating'           => 4,
                            'client_name'           => __('Peter Rose','jupitercore'),
                            'client_designation'    => __( 'Manager','jupitercore' ),
                            'client_designation_color'    => '#ff7c0d',
                            'client_say'            => __( 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'jupitercore' ),
                        ],

                        [
                            'feed_rating'           => 3,
                            'client_name'           => __('Gerald Gilbert','jupitercore'),
                            'client_designation'    => __( 'Developer','jupitercore' ),
                            'client_designation_color'    => '#ff388c',
                            'client_say'            => __( 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'jupitercore' ),
                        ],
                    ],
                    'title_field' => '{{{ client_name }}}',
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
            $this->add_control(
                'quote_on',
                [
                    'label' => esc_html__( 'Show Quote?', 'jupitercore' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator'=>'before',
                ]
            );
            $this->add_control(
                'quote_icon_type',
                [
                    'label' => __('Quote Type','jupitercore'),
                    'type' =>Controls_Manager::CHOOSE,
                    'options' =>[
                        'img' =>[
                            'title' =>__('Image','jupitercore'),
                            'icon' =>'fa fa-picture-o',
                        ],
                        'icon' =>[
                            'title' =>__('Icon','jupitercore'),
                            'icon' =>'fa fa-info',
                        ]
                    ],
                    'condition' => [
                        'quote_on' => 'yes',
                    ],
                    'default' => 'icon',
                ]
            );
            $this->add_control(
                'quote_image',
                [
                    'label' => __('Image','jupitercore'),
                    'type'=>Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'quote_icon_type' => 'img',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'quote_imagesize',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition' => [
                        'quote_icon_type' => 'img',
                    ]
                ]
            );

            $this->add_control(
                'quote_icon',
                [
                    'label' =>esc_html__('Icon','jupitercore'),
                    'type'=>Controls_Manager::ICON,
                    'default' => 'fal fa-quote-left',
                    'condition' => [
                        'quote_icon_type' => 'icon',
                    ]
                ]
            );
        
            $this->add_control(
                'rating_on',
                [
                    'label' => esc_html__( 'Show Rating Star?', 'jupitercore' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator'=>'before',
                ]
            );

        
        $this->end_controls_section();

        // Slider setting
        $this->start_controls_section(
            'testimonial-slider-option',
            [
                'label' => esc_html__( 'Slider Option', 'jupitercore' ),
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
                    'max' => 10,
                    'step' => 1,
                    'default' => 1,
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
                'slfademode',
                [
                    'label' => esc_html__( 'Fade Effect', 'jupitercore' ),
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

        // Style Testimonial area tab section
        $this->start_controls_section(
            'jupiter_testimonial_style_area',
            [
                'label' => __( 'Area Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'jupiter_testimonial_section_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'jupiter_testimonial_section_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );
        
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'jupiter_testimonial_section_bg',
                    'label' => __( 'Background', 'jupitercore' ),
                    'default' => '#ffffff',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .jupiter-testimonial-area',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'jupiter_testimonial_section_border',
                    'label' => __( 'Border', 'jupitercore' ),
                    'selector' => '{{WRAPPER}} .jupiter-testimonial-area',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'jupiter_testimonial_section_shadow',
                    'label' => __( 'Box Shadow', 'jupitercore' ),
                    'selector' => '{{WRAPPER}} .jupiter-testimonial-area',
                ]
            );
            $this->add_control(
                'jupiter_testimonial_section_width',
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
                        '{{WRAPPER}} .jupiter-testimonial-area' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'jupiter_testimonial_section_height',
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
                        '{{WRAPPER}} .jupiter-testimonial-area' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_responsive_control(
                'jupiter_testimonial_section_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial-area' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();
        
        
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
                    '{{WRAPPER}} .jupiter-testimonial-area.testimonial-grid .testimonial-column' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .jupiter-testimonial-area.testimonial-grid .testimonial-column' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .jupiter-testimonial-area.testimonial-grid .testimonial-column' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        
        
        
        
        // Style Testimonial area tab section
        $this->start_controls_section(
            'jupiter_testimonial_box_area',
            [
                'label' => __( 'Box Style', 'jupitercore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'jupiter_testimonial_box_alignment',
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
                        '{{WRAPPER}} .jupiter-testimonial' => 'text-align: {{VALUE}};'
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                ]
            );
            $this->add_responsive_control(
                'jupiter_testimonial_box_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'default' => [
                        'top' => '0',
                        'right' => '15',
                        'bottom' => '30',
                        'left' => '15',
                        'isLinked' => false
                    ],
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );  
            $this->add_responsive_control(
                'jupiter_testimonial_box_padding',
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
                        '{{WRAPPER}} .jupiter-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );  
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'jupiter_testimonial_box_bg',
                    'label' => __( 'Background', 'jupitercore' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .jupiter-testimonial',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'jupiter_testimonial_box_border',
                    'label' => __( 'Border', 'jupitercore' ),
                    'selector' => '{{WRAPPER}} .jupiter-testimonial',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'jupiter_testimonial_box_shadow',
                    'label' => __( 'Box Shadow', 'jupitercore' ),
                    'selector' => '{{WRAPPER}} .jupiter-testimonial',
                ]
            );
            $this->add_responsive_control(
                'jupiter_testimonial_box_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();
        
        
        
        $this->start_controls_section(
            'jupiter_testimonial_quote_style',
            [
                'label'     => __( 'Quote', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'quote_on' => 'yes'
                ],
            ]
        );
           $this->add_responsive_control(
                'jupiter_testimonial_quote_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .quote-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'default' => [
                        'top' => '0',
                        'right' => '0',
                        'bottom' => '30',
                        'left' => '0',
                        'isLinked' => false
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'jupiter_testimonial_quote_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .quote-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );
            $this->add_control(
            'jupiter_testimonial_quote_size',
            [
                'label' => __( 'Icon Size', 'jupitercore' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'default' => [
                    'size' => 14,
                ],
                'selectors' => [
                    '{{WRAPPER}} .jupiter-testimonial .quote-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'jupiter_testimonial_quote_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .jupiter-testimonial .quote-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'jupiter_testimonial_quote_bg',
                    'label' => __( 'Background', 'jupitercore' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .jupiter-testimonial .quote-icon',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'jupiter_testimonial_quote_shadow',
                    'label' => __( 'Box Shadow', 'jupitercore' ),
                    'selector' => '{{WRAPPER}} .jupiter-testimonial .quote-icon',
                ]
            );
            $this->add_control(
                'jupiter_testimonial_quote_width',
                [
                    'label' => __( 'Width', 'jupitercore' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 56,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .quote-icon' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'jupiter_testimonial_quote_height',
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
                    'default' => [
                        'unit' => 'px',
                        'size' => 56,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .quote-icon' => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .jupiter-testimonial .quote-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                    [
                        'name' => 'jupiter_testimonial_quote_border',
                        'label' => __( 'Border', 'jupitercore' ),
                        'selector' => '{{WRAPPER}} .jupiter-testimonial .quote-icon',
                    ]
            );

            $this->add_responsive_control(
                'jupiter_testimonial_quote_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'default' => [
                        'top' => '3',
                        'right' => '3',
                        'bottom' => '3',
                        'left' => '3',
                        'isLinked' => false
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .quote-icon' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],                
                ]
            );        
        $this->end_controls_section(); // Style Testimonial image style end

        
         // Style Testimonial designation style start
        $this->start_controls_section(
            'jupiter_testimonial_clientsay_style',
            [
                'label'     => __( 'Client say', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'jupiter_testimonial_clientsay_color',
                [
                    'label' => __( 'Color', 'jupitercore' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '#001a40',
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .content' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'jupiter_testimonial_clientsay_typography',
                    'selector' => '{{WRAPPER}} .jupiter-testimonial .content',
                ]
            );

            $this->add_responsive_control(
                'jupiter_testimonial_clientsay_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'default' => [
                        'top' => '0',
                        'right' => '0',
                        'bottom' => '30',
                        'left' => '0',
                        'isLinked' => false
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'jupiter_testimonial_clientsay_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Style Testimonial designation style end// Style Testimonial designation style start
        $this->start_controls_section(
            'jupiter_testimonial_subject_style',
            [
                'label'     => __( 'Subject', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'jupiter_testimonial_subject_color',
            [
                'label' => __( 'Color', 'jupitercore' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#001a40',
                'selectors' => [
                    '{{WRAPPER}} .jupiter-testimonial .top-info .feed_subject' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'jupiter_testimonial_subject_typography',
                'selector' => '{{WRAPPER}} .jupiter-testimonial .top-info .feed_subject',
            ]
        );

        $this->end_controls_section(); // Style Testimonial designation style end
        // Style Testimonial name style start
        $this->start_controls_section(
            'jupiter_testimonial_name_style',
            [
                'label'     => __( 'Name', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'jupiter_testimonial_name_color',
                [
                    'label' => __( 'Color', 'jupitercore' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '#001a40',
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .footer .name' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'jupiter_testimonial_name_typography',
                    'selector' => '{{WRAPPER}} .jupiter-testimonial .footer .name',
                ]
            );

            $this->add_responsive_control(
                'jupiter_testimonial_name_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '0',
                        'right' => '0',
                        'bottom' => '5',
                        'left' => '0',
                        'isLinked' => false
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .footer .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'jupiter_testimonial_name_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .footer .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Style Testimonial name style end
        // Style Testimonial name style start
        $this->start_controls_section(
            'jupiter_testimonial_designation_style',
            [
                'label'     => __( 'Designation', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'jupiter_testimonial_designation_color',
                [
                    'label' => __( 'Color', 'jupitercore' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '#00b0fa',
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .footer .designation' => 'color: {{VALUE}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'jupiter_testimonial_designation_typography',
                    'selector' => '{{WRAPPER}} .jupiter-testimonial .footer .designation',
                ]
            );

            $this->add_responsive_control(
                'jupiter_testimonial_designation_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .footer .designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'jupiter_testimonial_designation_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .footer .designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Style Testimonial name style end        
        // Style Testimonial image style start
        $this->start_controls_section(
            'jupiter_testimonial_image_style',
            [
                'label'     => __( 'Image', 'jupitercore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
             $this->add_responsive_control(
                'image_floting',
                [
                    'label' => __( 'Image Float', 'jupitercore' ),
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
                        '{{WRAPPER}} .jupiter-testimonial .footer .photo' => 'float: {{VALUE}}; display: inline-block;',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                ]
            );
           $this->add_responsive_control(
                'jupiter_testimonial_image_margin',
                [
                    'label' => __( 'Margin', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '0',
                        'right' => '15',
                        'bottom' => '0',
                        'left' => '0',
                        'isLinked' => false
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .footer .photo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'jupiter_testimonial_image_padding',
                [
                    'label' => __( 'Padding', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .footer .photo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );
        
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'jupiter_testimonial_image_bg',
                    'label' => __( 'Background', 'jupitercore' ),
                    'default' => '#ffffff',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .jupiter-testimonial .footer .photo',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'jupiter_testimonial_image_shadow',
                    'label' => __( 'Box Shadow', 'jupitercore' ),
                    'selector' => '{{WRAPPER}} .jupiter-testimonial .footer .photo',
                ]
            );
            $this->add_control(
                'jupiter_testimonial_image_width',
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
                    'default' => [
                        'unit' => 'px',
                        'size' => 48,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .footer .photo' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'jupiter_testimonial_image_height',
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
                    'default' => [
                        'unit' => 'px',
                        'size' => 48,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .footer .photo' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                    [
                        'name' => 'jupiter_testimonial_image_border',
                        'label' => __( 'Border', 'jupitercore' ),
                        'selector' => '{{WRAPPER}} .jupiter-testimonial .footer .photo',
                    ]
            );

            $this->add_responsive_control(
                'jupiter_testimonial_image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'jupitercore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .jupiter-testimonial .footer .photo' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                     'default' => [
                        'top' => '100',
                        'right' => '100',
                        'bottom' => '100',
                        'left' => '100',
                        'isLinked' => false,
                        'unit' => '%',
                    ],
                ]
            );        
        $this->end_controls_section(); // Style Testimonial image style end
 
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
    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        
        
        if( $settings['quote_on'] == 'yes'){            
            $quote_image = Group_Control_Image_Size::get_attachment_image_html( $settings, 'quote_imagesize', 'quote_image' );
            if( $settings['quote_icon_type'] == 'img' and !empty($quote_image) ){
                $quote  = '<div class="quote-icon">'.$quote_image.'</div>';
            }elseif( $settings['quote_icon_type'] == 'icon' and !empty($settings['quote_icon']) ){
                $quote = '<div class="quote-icon"><i class="'.esc_attr($settings['quote_icon']).'"></i></div>';
            }         
        }
       
        $this->add_render_attribute( 'testimonial_area_attr', 'class', 'jupiter-testimonial-area' );

        if( $settings['slider_on'] == 'yes'){
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
                'fade_effect' => ( 'yes' === $settings['slfademode']),
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
            $this->add_render_attribute( 'testimonial_area_attr', 'class', 'jupitercore-carousel-activation' );   
            $this->add_render_attribute( 'testimonial_area_attr', 'data-settings', wp_json_encode( $slider_settings ) );   
        }else {            
            $this->add_render_attribute( 'testimonial_area_attr', 'class', 'testimonial-grid' );
        }
        
        if( $settings['jupiter_testimonial_list'] ):
        
        ?>
        <div <?php echo $this->get_render_attribute_string( 'testimonial_area_attr' ); ?> >
           <?php foreach( $settings['jupiter_testimonial_list'] as $items ):            
            $client_image = Group_Control_Image_Size::get_attachment_image_html( $items, 'client_imagesize', 'client_image' );
            ?>
            <div class="testimonial-column">
                <div class="jupiter-testimonial">
                   <div class="top-info">
                   <?php if($settings['rating_on'] == 'yes' ): ?>
                   <div class="feed_rating star<?php echo $items['feed_rating']; ?>">
                       <span><i class="fas fa-star"></i></span>
                       <span><i class="fas fa-star"></i></span>
                       <span><i class="fas fa-star"></i></span>
                       <span><i class="fas fa-star"></i></span>
                       <span><i class="fas fa-star"></i></span>
                   </div>
                   <?php endif; ?>
                    <?php if( !empty($items['feed_subject']) ): ?>
                    <div class="feed_subject"><?php echo esc_html($items['feed_subject']); ?></div>
                    <?php endif; ?>
                   </div>
                    <?php if( !empty($items['client_say']) ): ?>
                    <div class="content">
                        <?php echo wpautop(esc_html($items['client_say'])); ?>
                    </div>
                    <?php endif; ?>
                    <div class="footer">                   
                        <?php if( !empty($client_image) ): ?>
                        <div class="photo">
                            <?php echo $client_image; ?>
                        </div>
                        <?php endif; ?>
                        <div class="ft-content">                                            
                            <?php if( !empty($items['client_name']) ): ?>
                            <h4 class="name"><?php echo esc_html($items['client_name']); ?></h4>
                            <?php endif; ?>
                            <?php if( !empty($items['client_designation']) ): ?>
                            <div class="designation" style="color:<?php echo ( isset($items['client_designation_color']) ? esc_attr($items['client_designation_color']) : '#00b0fa' ); ?>" ><?php echo esc_html($items['client_designation']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php 
                        if( $settings['quote_on'] == 'yes' and !empty($quote) ):
                            echo $quote;
                        endif; 
                    ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php        
        endif;        
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new jupiter_Testimonial_Widget );