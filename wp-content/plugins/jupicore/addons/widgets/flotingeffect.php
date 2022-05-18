<?php
namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Element_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class jupiter_Floting_Effect {
    
    private static $instance = null;

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function init() {
        // Add Plugin actions
        add_action( 'elementor/element/common/section_effects/after_section_start', [ $this, 'add_floating_effect_controls' ] );
        add_action( 'elementor/frontend/after_enqueue_scripts', array ( $this, 'floating_effect_script' ), 10 );
    }
    
    public function floating_effect_script(){
        wp_enqueue_script( 'animate-js' );
        wp_enqueue_script( 'el-widget-active' );
    }
    
    public function add_floating_effect_controls( Element_Base $element ) {
        $element->add_control(
            'jc_floating_fx',
            [
                'label' => __( 'Movement Effects', 'jupitercore' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'jc_floating_fx_translate_toggle',
            [
                'label' => __( 'Translate', 'jupitercore' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'frontend_available' => true,
                'condition' => [
                    'jc_floating_fx' => 'yes',
                ]
            ]
        );

        $element->start_popover();

        $element->add_control(
            'jc_floating_fx_translate_x',
            [
                'label' => __( 'Translate X', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'jc_floating_fx_translate_toggle' => 'yes',
                    'jc_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'jc_floating_fx_translate_y',
            [
                'label' => __( 'Translate Y', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'jc_floating_fx_translate_duration',
            [
                'label' => __( 'Duration', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 100
                    ]
                ],
                'default' => [
                    'size' => 1000,
                ],
                'condition' => [
                    'jc_floating_fx_translate_toggle' => 'yes',
                    'jc_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'jc_floating_fx_translate_delay',
            [
                'label' => __( 'Delay', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                        'step' => 100
                    ]
                ],
                'condition' => [
                    'jc_floating_fx_translate_toggle' => 'yes',
                    'jc_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->end_popover();

        $element->add_control(
            'jc_floating_fx_rotate_toggle',
            [
                'label' => __( 'Rotate', 'jupitercore' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'frontend_available' => true,
                'condition' => [
                    'jc_floating_fx' => 'yes',
                ]
            ]
        );

        $element->start_popover();

        $element->add_control(
            'jc_floating_fx_rotate_x',
            [
                'label' => __( 'Rotate X', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                    ]
                ],
                'condition' => [
                    'jc_floating_fx_rotate_toggle' => 'yes',
                    'jc_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'jc_floating_fx_rotate_y',
            [
                'label' => __( 'Rotate Y', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                    ]
                ],
                'condition' => [
                    'jc_floating_fx_rotate_toggle' => 'yes',
                    'jc_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'jc_floating_fx_rotate_z',
            [
                'label' => __( 'Rotate Z', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                    ]
                ],
                'condition' => [
                    'jc_floating_fx_rotate_toggle' => 'yes',
                    'jc_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'jc_floating_fx_rotate_duration',
            [
                'label' => __( 'Duration', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 100
                    ]
                ],
                'default' => [
                    'size' => 1000,
                ],
                'condition' => [
                    'jc_floating_fx_rotate_toggle' => 'yes',
                    'jc_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'jc_floating_fx_rotate_delay',
            [
                'label' => __( 'Delay', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                        'step' => 100
                    ]
                ],
                'condition' => [
                    'jc_floating_fx_rotate_toggle' => 'yes',
                    'jc_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->end_popover();

        $element->add_control(
            'jc_floating_fx_scale_toggle',
            [
                'label' => __( 'Scale', 'jupitercore' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'frontend_available' => true,
                'condition' => [
                    'jc_floating_fx' => 'yes',
                ]
            ]
        );

        $element->start_popover();

        $element->add_control(
            'jc_floating_fx_scale_x',
            [
                'label' => __( 'Scale X', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => .1
                    ]
                ],
                'condition' => [
                    'jc_floating_fx_scale_toggle' => 'yes',
                    'jc_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'jc_floating_fx_scale_y',
            [
                'label' => __( 'Scale Y', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => .1
                    ]
                ],
                'condition' => [
                    'jc_floating_fx_scale_toggle' => 'yes',
                    'jc_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'jc_floating_fx_scale_duration',
            [
                'label' => __( 'Duration', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 100
                    ]
                ],
                'default' => [
                    'size' => 1000,
                ],
                'condition' => [
                    'jc_floating_fx_scale_toggle' => 'yes',
                    'jc_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'jc_floating_fx_scale_delay',
            [
                'label' => __( 'Delay', 'jupitercore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                        'step' => 100
                    ]
                ],
                'condition' => [
                    'jc_floating_fx_scale_toggle' => 'yes',
                    'jc_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->end_popover();

        $element->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );
    }
    
}

jupiter_Floting_Effect::instance()->init();