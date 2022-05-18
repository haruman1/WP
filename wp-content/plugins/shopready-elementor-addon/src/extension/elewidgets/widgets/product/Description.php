<?php

namespace Shop_Ready\extension\elewidgets\widgets\product;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;
/**
 * WooCommerce Product Short Description | Name
 * @see https://docs.woocommerce.com/document/managing-products/
 * @author quomodosoft.com
 */
class Description extends \Shop_Ready\extension\elewidgets\Widget_Base {
    
	
    /**
	 * Html Wrapper Class of html 
	 */
	public $wrapper_class = false;

	protected function register_controls() {

			  // Notice 
			$this->start_controls_section(
			'notice_content_section',
				[
					'label' => esc_html__( 'Notice', 'shopready-elementor-addon' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
	
				$this->add_control(
					'woo_ready_usage_direction_notice',
					[
						'label'           => esc_html__( 'Important Note', 'shopready-elementor-addon' ),
						'type'            => \Elementor\Controls_Manager::RAW_HTML,
						'raw'             => esc_html__( 'Use This Widget in WooCommerce Product Details page  Template.', 'shopready-elementor-addon' ),
						'content_classes' => 'woo-ready-product-page-notice',
					]
				);
	
			$this->end_controls_section(); 
			
			$this->start_controls_section(
				'editor_content_section',
				[
					'label' => esc_html__( 'Editor Refresh', 'shopready-elementor-addon' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'show_product_content',
					[
						'label'        => esc_html__( 'Content Refresh?', 'shopready-elementor-addon' ),
						'type'         => \Elementor\Controls_Manager::SWITCHER,
						'label_on'     => esc_html__( 'Yes', 'shopready-elementor-addon' ),
						'label_off'    => esc_html__( 'No', 'shopready-elementor-addon' ),
						'return_value' => 'yes',
						'default'      => '',
					]
				);

				$this->add_control(
					'wready_product_id',
					[
						'label'   => esc_html__( 'Demo Product', 'shopready-elementor-addon' ),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'multiple' => false,
						'default' => shop_ready_get_single_product_key(),
						'options' =>  shop_ready_get_latest_products_id(10)
					]
				);
 
			$this->end_controls_section();

			$this->start_controls_section(
				'layouts_cart_content_section',
				[
					'label' => esc_html__( 'Layout', 'shopready-elementor-addon' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
	
				$this->add_control(
					'style',
					[
						'label'   => esc_html__( 'Layout', 'shopready-elementor-addon' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'wready-desc-one',
						'options' => [
							'wready-desc-one'     => esc_html__('Style 1','shopready-elementor-addon'),
						
					
						]
					]
				);
	
	
			$this->end_controls_section();

		
		$this->start_controls_section(
			'content_cart_total_section',
			[
				'label' => esc_html__( 'Settings', 'shopready-elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Tag', 'elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => shop_ready_html_tags_options(),
				'default'   => 'div',
				'separator'   => 'before',
			]
		);
	

		$this->add_control(
			'description_limit',
			[
				'label'       => esc_html__( 'Description Limit', 'shopready-elementor-addon' ),
				'type'        => Controls_Manager::NUMBER,
				'default' => 50,
				'placeholder' => esc_html__( 'Subtitle', 'shopready-elementor-addon' ),
				'separator'   => 'before',
			]
		);


		$this->add_control(
			'show_icon',
			[
				'label'        => esc_html__( 'Show Icon ?', 'shopready-elementor-addon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'shopready-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'shopready-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Icon Type', 'shopready-elementor-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'font_icon',
				'options' => [
					'font_icon'  => esc_html__( 'SVG / Font Icon', 'shopready-elementor-addon' ),
					'image_icon' => esc_html__( 'Image Icon', 'shopready-elementor-addon' ),
				],
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);
		$this->add_control(
			'font_icon',
			[
				'label'     => esc_html__( 'SVG / Font Icons', 'shopready-elementor-addon' ),
				'type'      => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'label_block' => true,
				'condition' => [
					'icon_type' => 'font_icon',
					'show_icon' => 'yes',
				],
			]
		);
		$this->add_control(
			'image_icon',
			[
				'label'   => esc_html__( 'Image Icon', 'shopready-elementor-addon' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image_icon',
					'show_icon' => 'yes',
				],
			]
		);
		$this->add_control(
			'show_bg_icon',
			[
				'label'        => esc_html__( 'Background Icon ?', 'shopready-elementor-addon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'shopready-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'shopready-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'   => 'before',
			]
		);
		$this->add_control(
			'bg_icon_type',
			[
				'label'   => esc_html__( 'Background Icon Type', 'shopready-elementor-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'font_icon',
				'options' => [
					'font_icon'  => esc_html__( 'SVG / Font Icon', 'shopready-elementor-addon' ),
					'image_icon' => esc_html__( 'Image Icon', 'shopready-elementor-addon' ),
				],
				'condition' => [
					'show_bg_icon' => 'yes',
				],
			]
		);
		$this->add_control(
			'bg_font_or_svg',
			[
				'label'     => esc_html__( 'SVG / Font Icon', 'shopready-elementor-addon' ),
				'type'      => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'label_block' => true,
				'condition' => [
					'show_bg_icon' => 'yes',
					'bg_icon_type' => 'font_icon',
				],
			]
		);
		$this->add_control(
			'bg_image_icon',
			[
				'label'   => esc_html__( 'Upload Image OR SVG Icon', 'shopready-elementor-addon' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'show_bg_icon' => 'yes',
					'bg_icon_type' => 'image_icon',
				],
			]
		);
		$this->add_control(
			'show_bg_text',
			[
				'label'        => esc_html__( 'Background Text ?', 'shopready-elementor-addon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'shopready-elementor-addon' ),
				'label_off'    => esc_html__( 'Hide', 'shopready-elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'title_bg_text',
			[
				'label'       => esc_html__( 'Background Text', 'shopready-elementor-addon' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Background Text', 'shopready-elementor-addon' ),
				'condition'   => [
					'show_bg_text' => 'yes',
				],
			]
		);

		

	
	
		$this->end_controls_section();

	
		/**
		 * Layouts Total Table
		 */
		$this->box_layout(
			[
				'title'          => esc_html__('Container Wrapper','shopready-elementor-addon'),
				'slug'           => 'wready_wc_default_product_title_wrapper',
				'element_name'   => 'cart_product_title_wrapper',
				'selector'       => '{{WRAPPER}} .woo-ready-product-desc-layout .area__content',
				
			]
		);

		$this->box_layout(
			[
				'title'          => esc_html__('Content','shopready-elementor-addon'),
				'slug'           => 'wready_wc_default_product_title_',
				'element_name'   => 'cart_product_title',
				'selector'       => '{{WRAPPER}} .woo-ready-product-desc-layout .area__desc',
				
			]
		);

		$this->box_layout(
			[
				'title'          => esc_html__('Icon','shopready-elementor-addon'),
				'slug'           => 'wready_wc_default_product_title_icon',
				'element_name'   => 'cart_product_icon',
				'selector'       => '{{WRAPPER}} .woo-ready-product-desc-layout .area__icon',
				
			]
		);


		/* Layouts End */

	
			/*----------------------------
			ICON STYLE
		-----------------------------*/
		$this->start_controls_section(
			'icon_style_section',
			[
				'label'     => esc_html__( 'Icon', 'shopready-elementor-addon' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);
			$this->start_controls_tabs( 'icon_tab_style' );
				$this->start_controls_tab(
					'icon_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'shopready-elementor-addon' ),
					]
				);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'      => 'icon_typography',
							'selector'  => '{{WRAPPER}} .area__icon',
							'condition' => [
								'icon_type' => ['font_icon']
							],
						]
					);
					$this->add_responsive_control(
						'icon_image_size',
						[
							'label'      => esc_html__( 'SVG / Image Size', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__icon img' => 'width: {{SIZE}}{{UNIT}};',
								'{{WRAPPER}} .area__icon svg' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'      => 'icon_image_filters',
							'selector'  => '{{WRAPPER}} .area__icon img',
							'condition' => [
								'icon_type' => ['image_icon']
							],
						]
					);
					$this->add_control(
						'icon_color',
						[
							'label'     => esc_html__( 'Color', 'shopready-elementor-addon' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .area__icon' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'icon_background',
							'label'    => esc_html__( 'Background', 'shopready-elementor-addon' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .area__icon',
						]
					);
					$this->add_control(
						'icon_hr2',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'icon_border',
							'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
							'selector' => '{{WRAPPER}} .area__icon',
						]
					);
					$this->add_control(
						'icon_radius',
						[
							'label'      => esc_html__( 'Border Radius', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .area__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'icon_shadow',
							'selector' => '{{WRAPPER}} .area__icon',
						]
					);
					$this->add_control(
						'icon_hr3',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);


					$this->add_responsive_control(
						'icon_width',
						[
							'label'      => esc_html__( 'Width', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
								'size' => 80,
							],
							'selectors' => [
								'{{WRAPPER}} .area__icon' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'icon_height',
						[
							'label'      => esc_html__( 'Height', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
								'size' => 80,
							],
							'selectors' => [
								'{{WRAPPER}} .area__icon' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'icon_hr5',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_responsive_control(
						'icon_display',
						[
							'label'   => esc_html__( 'Display', 'shopready-elementor-addon' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'inline-block',
							
							'options' => [
								'initial'      => esc_html__( 'Initial', 'shopready-elementor-addon' ),
								'block'        => esc_html__( 'Block', 'shopready-elementor-addon' ),
								'inline-block' => esc_html__( 'Inline Block', 'shopready-elementor-addon' ),
								'flex'         => esc_html__( 'Flex', 'shopready-elementor-addon' ),
								'inline-flex'  => esc_html__( 'Inline Flex', 'shopready-elementor-addon' ),
								'none'         => esc_html__( 'none', 'shopready-elementor-addon' ),
							],
							'selectors' => [
								'{{WRAPPER}} .area__icon' => 'display: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'icon_align',
						[
							'label'   => esc_html__( 'Alignment', 'shopready-elementor-addon' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'left' => [
									'title' => esc_html__( 'Left', 'shopready-elementor-addon' ),
									'icon'  => 'fa fa-align-left',
								],
								'center' => [
									'title' => esc_html__( 'Center', 'shopready-elementor-addon' ),
									'icon'  => 'fa fa-align-center',
								],
								'right' => [
									'title' => esc_html__( 'Right', 'shopready-elementor-addon' ),
									'icon'  => 'fa fa-align-right',
								],
								'justify' => [
									'title' => esc_html__( 'Justify', 'shopready-elementor-addon' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .area__icon' => 'text-align: {{VALUE}};',
							],
							'default' => 'center',
						]
					);
					$this->add_control(
						'icon_hr6',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_responsive_control(
						'icon_position',
						[
							'label'   => esc_html__( 'Position', 'shopready-elementor-addon' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'initial',
							
							'options' => [
								'initial'  => esc_html__( 'Initial', 'shopready-elementor-addon' ),
								'absolute' => esc_html__( 'Absulute', 'shopready-elementor-addon' ),
								'relative' => esc_html__( 'Relative', 'shopready-elementor-addon' ),
								'static'   => esc_html__( 'Static', 'shopready-elementor-addon' ),
							],
							'selectors' => [
								'{{WRAPPER}} .area__icon' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'icon_position_from_left',
						[
							'label'      => esc_html__( 'From Left', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__icon' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'icon_position_from_right',
						[
							'label'      => esc_html__( 'From Right', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__icon' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'icon_position_from_top',
						[
							'label'      => esc_html__( 'From Top', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__icon' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'icon_position_from_bottom',
						[
							'label'      => esc_html__( 'From Bottom', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__icon' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position!' => ['initial','static']
							],
						]
					);
					$this->add_control(
						'icon_transition',
						[
							'label'      => esc_html__( 'Transition', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
							'range'      => [
								'px' => [
									'min'  => 0.1,
									'max'  => 3,
									'step' => 0.1,
								],
							],
							'default' => [
								'unit' => 'px',
								'size' => 0.3,
							],
							'selectors' => [
								'{{WRAPPER}} .area__icon,{{WRAPPER}} .area__icon img' => 'transition: {{SIZE}}s;',
							],
						]
					);
					$this->add_control(
						'icon_hr7',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_responsive_control(
						'icon_margin',
						[
							'label'      => esc_html__( 'Margin', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .area__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'icon_hr8',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_responsive_control(
						'icon_padding',
						[
							'label'      => esc_html__( 'Padding', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .area__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'icon_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'shopready-elementor-addon' ),
					]
				);
					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'      => 'hover_icon_image_filters',
							'selector'  => '{{WRAPPER}} :hover .area__icon img',
							'condition' => [
								'icon_type' => ['image_icon']
							],
						]
					);
					$this->add_control(
						'hover_icon_color',
						[
							'label'     => esc_html__( 'Color', 'shopready-elementor-addon' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} :hover .area__icon, {{WRAPPER}} :focus .area__icon' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_icon_background',
							'label'    => esc_html__( 'Background', 'shopready-elementor-addon' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} :hover .area__icon,{{WRAPPER}} :focus .area__icon',
						]
					);
					$this->add_control(
						'icon_hr4',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'hover_icon_border',
							'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
							'selector' => '{{WRAPPER}} :hover .area__icon,{{WRAPPER}} :hover .area__icon',
						]
					);
					$this->add_control(
						'hover_icon_radius',
						[
							'label'      => esc_html__( 'Border Radius', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} :hover .area__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'hover_icon_shadow',
							'selector' => '{{WRAPPER}} .area__icon:hover',
						]
					);
					$this->add_control(
						'icon_hover_animation',
						[
							'label'    => esc_html__( 'Hover Animation', 'shopready-elementor-addon' ),
							'type'     => Controls_Manager::HOVER_ANIMATION,
							'selector' => '{{WRAPPER}} :hover .area__icon',
						]
					);
					$this->add_control(
						'icon_hr9',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			ICON STYLE END
		-----------------------------*/

		/*----------------------------
			BACKGROUND ICON
		-----------------------------*/
		$this->start_controls_section(
			'bgicon_style_section',
			[
				'label'     => esc_html__( 'Background Icon', 'shopready-elementor-addon' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_bg_icon' => 'yes',
				],
			]
		);
			$this->add_group_control(
				Group_Control_Typography:: get_type(),
				[
					'name'     => 'bgicon_typography',
					'selector' => '{{WRAPPER}} .area__content .desc__bg__icon',
				]
			);
			$this->add_control(
				'bgicon_text_color',
				[
					'label'     => esc_html__( 'Color', 'shopready-elementor-addon' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .area__content .desc__bg__icon' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'bgicon_text_width',
				[
					'label'      => esc_html__( 'Width', 'shopready-elementor-addon' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => '100'
					],
					'selectors' => [
						'{{WRAPPER}} .area__content .desc__bg__icon' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'bgicon_margin',
				[
					'label'      => esc_html__( 'Margin', 'shopready-elementor-addon' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .area__content .desc__bg__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'bgicon_padding',
				[
					'label'      => esc_html__( 'Padding', 'shopready-elementor-addon' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .area__content .desc__bg__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'bgicon_opacity',
				[
					'label' => esc_html__( 'Opacity', 'shopready-elementor-addon' ),
					'type'  => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max'  => 1,
							'min'  => 0.10,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .area__content .desc__bg__icon' => 'opacity: {{SIZE}};',
					],
				]
			);
		$this->end_controls_section();
		/*----------------------------
			BACKGROUND ICON END
		-----------------------------*/

		/*----------------------------
			BACKGROUND TEXT
		-----------------------------*/
		$this->start_controls_section(
			'bgtext_style_section',
			[
				'label'     => esc_html__( 'Background Text', 'shopready-elementor-addon' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_bg_text' => 'yes',
				],
			]
		);
			$this->add_group_control(
				Group_Control_Typography:: get_type(),
				[
					'name'     => 'bgtext_typography',
					'selector' => '{{WRAPPER}} .area__content .desc__bg__text',
				]
			);
			$this->add_control(
				'bgtext_text_color',
				[
					'label'     => esc_html__( 'Color', 'shopready-elementor-addon' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .area__content .desc__bg__text' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'title_bg_text_shadow',
					'label' => esc_html__( 'Text Shadow', 'shopready-elementor-addon' ),
					'selector' => '{{WRAPPER}} .area__content .desc__bg__text',
					'condition' => [
						'title_bg_text!' => ''
					]
				]
			);
	
			$this->add_responsive_control(
                'title_bg_text_custom_tab_area_css',
                [
                    'label'     => esc_html__( 'Custom CSS', 'shopready-elementor-addon' ),
                    'type'      => Controls_Manager::CODE,
                    'rows'      => 20,
                    'language'  => 'css',
                    'selectors' => [
                        '{{WRAPPER}} .area__content .desc__bg__text' => '{{VALUE}};',
                    ],
					'separator' => 'before',
					'condition' => [
						'title_bg_text!' => ''
					]
                ]
            );
			$this->add_responsive_control(
				'bgtext_margin',
				[
					'label'      => esc_html__( 'Margin', 'shopready-elementor-addon' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .area__content .desc__bg__text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'bgtext_padding',
				[
					'label'      => esc_html__( 'Padding', 'shopready-elementor-addon' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .area__content .desc__bg__text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'bgtext_opacity',
				[
					'label' => esc_html__( 'Opacity', 'shopready-elementor-addon' ),
					'type'  => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max'  => 1,
							'min'  => 0.10,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .area__content .desc__bg__text' => 'opacity: {{SIZE}};',
					],
				]
			);
		$this->end_controls_section();
		/*----------------------------
			BACKGROUND TEXT END
		-----------------------------*/

		/*----------------------------
			Description STYLE
		-----------------------------*/
		$this->start_controls_section(
			'title_style_section',
			[
				'label'     => esc_html__( 'Content', 'shopready-elementor-addon' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				
			]
		);
			$this->start_controls_tabs( 'title_tab_style' );
				$this->start_controls_tab(
					'title_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'shopready-elementor-addon' ),
					]
				);
					$this->add_control(
						'title_text_color',
						[
							'label'     => esc_html__( 'Color', 'shopready-elementor-addon' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .area__desc, {{WRAPPER}} .area__desc a' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Typography::get_type(),
						[
							'name'     => 'title_typography',
							'selector' => '{{WRAPPER}} .area__desc',
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'     => 'title_background',
							'label'    => esc_html__( 'Background', 'shopready-elementor-addon' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .area__desc',
						]
					);
					$this->add_responsive_control(
						'title_display',
						[
							'label'   => esc_html__( 'Display', 'shopready-elementor-addon' ),
							'type'    => Controls_Manager::SELECT,							
							'options' => [
								'initial'      => esc_html__( 'Initial', 'shopready-elementor-addon' ),
								'block'        => esc_html__( 'Block', 'shopready-elementor-addon' ),
								'inline-block' => esc_html__( 'Inline Block', 'shopready-elementor-addon' ),
								'flex'         => esc_html__( 'Flex', 'shopready-elementor-addon' ),
								'inline-flex'  => esc_html__( 'Inline Flex', 'shopready-elementor-addon' ),
								'none'         => esc_html__( 'none', 'shopready-elementor-addon' ),
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc' => 'display: {{VALUE}};',
							],
						]
					);
			        $this->add_group_control(
			            Group_Control_Border::get_type(),
			            [
			                'name'     => 'title_border',
			                'label'    => esc_html__( 'Border', 'shopready-elementor-addon' ),
			                'selector' => '{{WRAPPER}} .area__desc',
			            ]
			        );
			        $this->add_responsive_control(
			            'title_border_radius',
			            [
			                'label'      => esc_html__( 'Border Radius', 'shopready-elementor-addon' ),
			                'type'       => Controls_Manager::DIMENSIONS,
			                'size_units' => [ 'px', '%', 'em' ],
			                'selectors'  => [
			                    '{{WRAPPER}} .area__desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );
					$this->add_responsive_control(
						'title_margin',
						[
							'label'      => esc_html__( 'Margin', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .area__desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'title_padding',
						[
							'label'      => esc_html__( 'Padding', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .area__desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'title_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'shopready-elementor-addon' ),
					]
				);
					$this->add_control(
						'hover_title_color',
						[
							'label'     => esc_html__( 'Link Color', 'shopready-elementor-addon' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .area__desc a:hover, {{WRAPPER}} .area__desc a:focus' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'box_hover_title_color',
						[
							'label'     => esc_html__( 'Box Hover Color', 'shopready-elementor-addon' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} :hover .area__desc a, {{WRAPPER}} :focus .area__desc a, {{WRAPPER}} :hover .area__desc' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			Description STYLE END
		-----------------------------*/

		/*----------------------------
			Description BEFORE / AFTER
		-----------------------------*/
		$this->start_controls_section(
			'title_before_after_style_section',
			[
				'label'     => esc_html__( 'Before / After', 'shopready-elementor-addon' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
			$this->start_controls_tabs( 'title_before_after_tab_style' );
				$this->start_controls_tab(
					'title_before_tab',
					[
						'label' => esc_html__( 'BEFORE', 'shopready-elementor-addon' ),
					]
				);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'title_before_background',
							'label'    => esc_html__( 'Background', 'shopready-elementor-addon' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .area__desc:before',
						]
					);
					$this->add_responsive_control(
						'title_before_display',
						[
							'label'   => esc_html__( 'Display', 'shopready-elementor-addon' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',
							'options' => [
								'initial'      => esc_html__( 'Initial', 'shopready-elementor-addon' ),
								'block'        => esc_html__( 'Block', 'shopready-elementor-addon' ),
								'inline-block' => esc_html__( 'Inline Block', 'shopready-elementor-addon' ),
								'flex'         => esc_html__( 'Flex', 'shopready-elementor-addon' ),
								'inline-flex'  => esc_html__( 'Inline Flex', 'shopready-elementor-addon' ),
								'none'         => esc_html__( 'none', 'shopready-elementor-addon' ),
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:before' => 'display: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'title_before_position',
						[
							'label'   => esc_html__( 'Position', 'shopready-elementor-addon' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'relative',
							
							'options' => [
								'initial'  => esc_html__( 'Initial', 'shopready-elementor-addon' ),
								'absolute' => esc_html__( 'Absulute', 'shopready-elementor-addon' ),
								'relative' => esc_html__( 'Relative', 'shopready-elementor-addon' ),
								'static'   => esc_html__( 'Static', 'shopready-elementor-addon' ),
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:before' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'title_before_position_from_left',
						[
							'label'      => esc_html__( 'From Left', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => -1000,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => -100,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:before' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'title_before_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'title_before_position_from_right',
						[
							'label'      => esc_html__( 'From Right', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => -1000,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => -100,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:before' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'title_before_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'title_before_position_from_top',
						[
							'label'      => esc_html__( 'From Top', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => -1000,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => -100,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:before' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'title_before_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'title_before_position_from_bottom',
						[
							'label'      => esc_html__( 'From Bottom', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => -1000,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => -100,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:before' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'title_before_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'title_before_align',
						[
							'label'   => esc_html__( 'Alignment', 'shopready-elementor-addon' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'text-align:left' => [
									'title' => esc_html__( 'Left', 'shopready-elementor-addon' ),
									'icon'  => 'fa fa-align-left',
								],
								'margin: 0 auto' => [
									'title' => esc_html__( 'Center', 'shopready-elementor-addon' ),
									'icon'  => 'fa fa-align-center',
								],
								'float:right' => [
									'title' => esc_html__( 'Right', 'shopready-elementor-addon' ),
									'icon'  => 'fa fa-align-right',
								],
								'text-align:justify' => [
									'title' => esc_html__( 'Justify', 'shopready-elementor-addon' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:before' => '{{VALUE}};',
							],
							'default' => 'text-align:left',
						]
					);
					$this->add_responsive_control(
						'title_before_width',
						[
							'label'      => esc_html__( 'Width', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:before' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'title_before_height',
						[
							'label'      => esc_html__( 'Height', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:before' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'title_before_opacity',
						[
							'label' => esc_html__( 'Opacity', 'shopready-elementor-addon' ),
							'type'  => Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'max'  => 1,
									'min'  => 0.10,
									'step' => 0.01,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:before' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'title_before_zindex',
						[
							'label'     => esc_html__( 'Z-Index', 'shopready-elementor-addon' ),
							'type'      => Controls_Manager::NUMBER,
							'min'       => -99,
							'max'       => 99,
							'step'      => 1,
							'selectors' => [
								'{{WRAPPER}} .area__desc:before' => 'z-index: {{SIZE}};',
							],
						]
					);
					$this->add_responsive_control(
						'title_before_margin',
						[
							'label'      => esc_html__( 'Margin', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .area__desc:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'title_after_tab',
					[
						'label' => esc_html__( 'AFTER', 'shopready-elementor-addon' ),
					]
				);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'title_after_background',
							'label'    => esc_html__( 'Background', 'shopready-elementor-addon' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .area__desc:after',
						]
					);
					$this->add_responsive_control(
						'title_after_display',
						[
							'label'   => esc_html__( 'Display', 'shopready-elementor-addon' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',
							'options' => [
								'initial'      => esc_html__( 'Initial', 'shopready-elementor-addon' ),
								'block'        => esc_html__( 'Block', 'shopready-elementor-addon' ),
								'inline-block' => esc_html__( 'Inline Block', 'shopready-elementor-addon' ),
								'flex'         => esc_html__( 'Flex', 'shopready-elementor-addon' ),
								'inline-flex'  => esc_html__( 'Inline Flex', 'shopready-elementor-addon' ),
								'none'         => esc_html__( 'none', 'shopready-elementor-addon' ),
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:after' => 'display: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'title_after_position',
						[
							'label'   => esc_html__( 'Position', 'shopready-elementor-addon' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'relative',
							
							'options' => [
								'initial'  => esc_html__( 'Initial', 'shopready-elementor-addon' ),
								'absolute' => esc_html__( 'Absulute', 'shopready-elementor-addon' ),
								'relative' => esc_html__( 'Relative', 'shopready-elementor-addon' ),
								'static'   => esc_html__( 'Static', 'shopready-elementor-addon' ),
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:after' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'title_after_position_from_left',
						[
							'label'      => esc_html__( 'From Left', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => -1000,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => -100,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:after' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'title_after_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'title_after_position_from_right',
						[
							'label'      => esc_html__( 'From Right', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => -1000,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => -100,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:after' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'title_after_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'title_after_position_from_top',
						[
							'label'      => esc_html__( 'From Top', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => -1000,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => -100,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:after' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'title_after_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'title_after_position_from_bottom',
						[
							'label'      => esc_html__( 'From Bottom', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => -1000,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => -100,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:after' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'title_after_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'title_after_align',
						[
							'label'   => esc_html__( 'Alignment', 'shopready-elementor-addon' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'text-align:left' => [
									'title' => esc_html__( 'Left', 'shopready-elementor-addon' ),
									'icon'  => 'fa fa-align-left',
								],
								'margin: 0 auto' => [
									'title' => esc_html__( 'Center', 'shopready-elementor-addon' ),
									'icon'  => 'fa fa-align-center',
								],
								'float:right' => [
									'title' => esc_html__( 'Right', 'shopready-elementor-addon' ),
									'icon'  => 'fa fa-align-right',
								],
								'text-align:justify' => [
									'title' => esc_html__( 'Justify', 'shopready-elementor-addon' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:after' => '{{VALUE}};',
							],
							'default' => 'text-align:left',
						]
					);
					$this->add_responsive_control(
						'title_after_width',
						[
							'label'      => esc_html__( 'Width', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:after' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'title_after_height',
						[
							'label'      => esc_html__( 'Height', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:after' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'title_after_opacity',
						[
							'label' => esc_html__( 'Opacity', 'shopready-elementor-addon' ),
							'type'  => Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'max'  => 1,
									'min'  => 0.10,
									'step' => 0.01,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .area__desc:after' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'title_after_zindex',
						[
							'label'     => esc_html__( 'Z-Index', 'shopready-elementor-addon' ),
							'type'      => Controls_Manager::NUMBER,
							'min'       => -99,
							'max'       => 99,
							'step'      => 1,
							'selectors' => [
								'{{WRAPPER}} .area__desc:after' => 'z-index: {{SIZE}};',
							],
						]
					);
					$this->add_responsive_control(
						'title_after_margin',
						[
							'label'      => esc_html__( 'Margin', 'shopready-elementor-addon' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .area__desc:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			Description BEFORE / AFTER END
		-----------------------------*/
	
		
	}

    /**
	 * Override By elementor render method
	 * @return void
	 * 
	 */
	protected function html() {

		$settings = $this->get_settings_for_display();
	
	    $this->add_render_attribute(
			'wrapper_style',
			[
				'class' => [ 'woo-ready-product-desc-layout', $settings['style'] ],
			]
		);

        echo sprintf("<div %s>",$this->get_render_attribute_string( 'wrapper_style' ));

			if(file_exists(dirname(__FILE__). '/template-parts/description/'.$settings['style'].'.php')){
				shop_ready_widget_template_part(
					'product/template-parts/description/'.$settings['style'].'.php',
					array(
						'settings'              => $settings,
					)
				);

			}else{
                shop_ready_widget_template_part(
					'product/template-parts/description/wready-desc-one.php',
					array(
						'settings'              => $settings,
					)
				);
			}
			
		echo '</div>';
	}

}