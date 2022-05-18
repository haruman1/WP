<?php

namespace Shop_Ready\extension\elewidgets\widgets\general;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use \Elementor\Plugin;
use Elementor\Icons_Manager;

/**
 * WooCommerce Breadcrumb
 * @see https://docs.woocommerce.com/document/woocommerce_breadcrumb/
 * @author quomodosoft.com
 */
class Tabs extends \Shop_Ready\extension\elewidgets\Widget_Base {
	
    /**
	 * Html Wrapper Class of html 
	 */
	public $wrapper_class = true;

	protected function register_controls() { 

        $this->start_controls_section(
			'woo_ready_tab_options',
			[
				'label' => __( 'Tab Options', 'shopready-elementor-addon' ),
			]
		);

        $this->add_control(
            'woo_ready_tab_layout',
            [
                'label' => esc_html__('Layout', 'shopready-elementor-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'woo_ready-tabs-vertical',
                'label_block' => false,
                'options' => [
                    'woo_ready-tabs-horizontal' => esc_html__('Horizontal', 'shopready-elementor-addon'),
                    'woo_ready-tabs-vertical' => esc_html__('Vertical', 'shopready-elementor-addon'),
                ],
            ]
        );

        $this->add_control(
            'woo_ready_tabs_show_icon',
            [
                'label' => esc_html__('Show Icon', 'shopready-elementor-addon'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'woo_ready_tabs_icon_position',
            [
                'label' => esc_html__('Icon Position', 'shopready-elementor-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'tab-icon-left',
                'label_block' => false,
                'options' => [
                    'tab-icon-left' => esc_html__('Left', 'shopready-elementor-addon'),
                    'tab-icon-right' => esc_html__('Right', 'shopready-elementor-addon'),
                    'tab-icon-above' => esc_html__('Above', 'shopready-elementor-addon'),
                ],
                'condition' => [
                    'woo_ready_tabs_show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
			'woo_ready_tabs_menu_alignment',
			[
				'label' => __('Menu Alignment', 'shopready-elementor-addon'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __('Flex Start', 'shopready-elementor-addon'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'shopready-elementor-addon'),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => __('Flex End', 'shopready-elementor-addon'),
						'icon' => 'fa fa-align-right',
					],
					'space-between' => [
						'title' => __('Flex End', 'shopready-elementor-addon'),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .woo_ready-tabs-horizontal .woo-ready-tab-menu-wrapper ul' => 'justify-content: {{VALUE}}',
				],
                'condition' => [
                    'woo_ready_tab_layout' => 'woo_ready-tabs-horizontal',
                ],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'woo_ready_tab_content_settings',
            [
                'label' => esc_html__('Tab Content', 'shopready-elementor-addon'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'woo_ready_tabs_show_as_default',
            [
                'label' => __('Set as Default', 'shopready-elementor-addon'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'inactive',
                'return_value' => 'active-default',
            ]
        );

        $repeater->add_control(
            'woo_ready_tabs_icon_type',
            [
                'label' => esc_html__('Icon Type', 'shopready-elementor-addon'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'none' => [
                        'title' => esc_html__('None', 'shopready-elementor-addon'),
                        'icon' => 'fa fa-ban',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'shopready-elementor-addon'),
                        'icon' => 'fa fa-gear',
                    ],
                ],
                'default' => 'icon',
            ]
        );

        $repeater->add_control(
            'woo_ready_tabs_title_icon',
            [
                'label' => esc_html__('Icon', 'shopready-elementor-addon'),
                'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
                'condition' => [
                    'woo_ready_tabs_icon_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'woo_ready_tabs_title',
            [
                'label' => esc_html__('Tab Title', 'shopready-elementor-addon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tab Title', 'shopready-elementor-addon'),
                'dynamic' => ['active' => true],
            ]
        );

        $repeater->add_control(
            'woo_ready_tabs_content_type',
            [
                'label' => __('Content Type', 'shopready-elementor-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'content' => __('Content', 'shopready-elementor-addon'),
                    'template' => __('Saved Templates', 'shopready-elementor-addon'),
                ],
                'default' => 'content',
            ]
        );

        $repeater->add_control(
            'woo_ready_tab_template',
            [
                'label' => __('Choose Template', 'shopready-elementor-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => shop_ready_get_elementor_templates(),
                'condition' => [
                    'woo_ready_tabs_content_type' => 'template',
                ],
            ]
        );

        $repeater->add_control(
            'woo_ready_tab_content',
            [
                'label' => esc_html__('Tab Content', 'shopready-elementor-addon'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'shopready-elementor-addon'),
                'dynamic' => ['active' => true],
                'condition' => [
                    'woo_ready_tabs_content_type' => 'content',
                ],
            ]
        );

        $this->add_control(
            'woo_ready_tabs',
            [
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => [
                    ['tab_title' => esc_html__('Tab Title 1', 'shopready-elementor-addon')],
                    ['tab_title' => esc_html__('Tab Title 2', 'shopready-elementor-addon')],
                    ['tab_title' => esc_html__('Tab Title 3', 'shopready-elementor-addon')],
                ],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{tab_title}}',
            ]
        );
        $this->end_controls_section();

        $this->box_css(
            [
                'title'          => esc_html__('Tab Wapper','shopready-elementor-addon'),
                'slug'           => 'wready_general_tab_wrapper',
                'element_name'   => '_wready_general_tab_wrapper',
                'selector'       => '{{WRAPPER}} .woo-ready-tab-wrapper',
            ]
        );

        $this->box_css(
            [
                'title'          => esc_html__('Tab Menu Wapper','shopready-elementor-addon'),
                'slug'           => 'wready_general_tab_menu_wrapper',
                'element_name'   => '_wready_general_tab_menu_wrapper',
                'selector'       => '{{WRAPPER}} .woo-ready-tab-wrapper .woo-ready-tab-menu-wrapper',
            ]
        );

        $this->box_css(
            [
                'title'          => esc_html__('Tab Content Wapper','shopready-elementor-addon'),
                'slug'           => 'wready_general_tab_content_wrapper',
                'element_name'   => '_wready_general_tab_content_wrapper',
                'selector'       => '{{WRAPPER}} .woo-ready-tab-wrapper .woo-ready-tab-content-wrapper',
            ]
        );

        $this->box_css(
            [
                'title'          => esc_html__('Menu Wapper','shopready-elementor-addon'),
                'slug'           => 'wready_general_tab_menu_items_wrapper',
                'element_name'   => '_wready_general_tab_menu__items_wrapper',
                'selector'       => '{{WRAPPER}} .woo-ready-tab-wrapper .woo-ready-tab-menu-wrapper .menu',
            ]
        );

        $this->box_css(
            [
                'title'          => esc_html__('Menu Item','shopready-elementor-addon'),
                'slug'           => 'wready_general_tab_menu_item_style',
                'element_name'   => '_wready_general_tab_menu_item_style',
                'selector'       => '{{WRAPPER}} .woo-ready-tab-wrapper .woo-ready-tab-menu-wrapper .menu li',
            ]
        );

        $this->text_minimum_css(
            [
                'title'          => esc_html__('Menu Icon','shopready-elementor-addon'),
                'slug'           => 'wready_general_tab_menu_icon_style',
                'element_name'   => '_wready_general_tab_menu_icon_style',
                'selector'       => '{{WRAPPER}} .woo-ready-tab-wrapper .woo-ready-tab-menu-wrapper .menu li .woo-ready-tabs-icon',
            ]
        );

        $this->text_minimum_css(
            [
                'title'          => esc_html__('Menu Title','shopready-elementor-addon'),
                'slug'           => 'wready_general_tab_menu_title_style',
                'element_name'   => '_wready_general_tab_menu_title_style',
                'selector'       => '{{WRAPPER}} .woo-ready-tab-wrapper .woo-ready-tab-menu-wrapper .menu li .woo-ready-tab-title',
            ]
        );

        $this->text_minimum_css(
            [
                'title'          => esc_html__('Active Menu','shopready-elementor-addon'),
                'slug'           => 'wready_general_tab_active_menu_style',
                'element_name'   => '_wready_general_tab_active_menu_style',
                'selector'       => '{{WRAPPER}} .woo-ready-tab-wrapper .woo-ready-tab-menu-wrapper .menu li.active span',
                'hover_selector' => '{{WRAPPER}} .woo-ready-tab-wrapper .woo-ready-tab-menu-wrapper .menu li.active:hover span',
            ]
        );

        $this->box_css(
            [
                'title'          => esc_html__('Tab Content','shopready-elementor-addon'),
                'slug'           => 'wready_general_tab_content',
                'element_name'   => '_wready_general_tab_content',
                'selector'       => '{{WRAPPER}} .woo-ready-tab-wrapper .woo-ready-tab-content-wrapper .woo-ready-tab-content ul',
            ]
        );

        $this->text_minimum_css(
            [
                'title'          => esc_html__('Tab Content Style','shopready-elementor-addon'),
                'slug'           => 'wready_general_tab_content_style',
                'element_name'   => '_wready_general_tab_content_style',
                'selector'       => '{{WRAPPER}} .woo-ready-tab-wrapper .woo-ready-tab-content-wrapper .woo-ready-tab-content li',
            ]
        );

	}

	/**
	 * Override By elementor render method
	 * @return void
	 * 
	 */
	protected function html() {

		$settings = $this->get_settings_for_display();

        $this->add_render_attribute(
            'woo_ready_tab_wrapper',
            [
                'id' => "woo-ready-tabs-{$this->get_id()}",
                'class' => ['woo-ready-tab-wrapper', $settings['woo_ready_tab_layout']],
                'data-tabid' => $this->get_id(),
            ]
        );

        $this->add_render_attribute('woo_ready_tab_icon_position', 'class', [ esc_attr($settings['woo_ready_tabs_icon_position']), 'menu' ]); ?>

        <div <?php echo wp_kses_post($this->get_render_attribute_string('woo_ready_tab_wrapper')); ?>>
            <div class="woo-ready-tab-content">
                <div class="woo-ready-tab-menu-wrapper gc--1-of-3">

                    <ul <?php echo wp_kses_post($this->get_render_attribute_string('woo_ready_tab_icon_position')); ?>>

                        <?php foreach ($settings['woo_ready_tabs'] as $tab) : ?>

                            <li class="<?php echo esc_attr($tab['woo_ready_tabs_show_as_default']); ?>">
                                <?php if ($settings['woo_ready_tabs_show_icon'] === 'yes') : ?>
                                    <span class="woo-ready-tabs-icon">
                                    <?php  if ($tab['woo_ready_tabs_icon_type'] === 'icon') {
                                            Icons_Manager::render_icon( $tab['woo_ready_tabs_title_icon'] );
                                        }
                                endif; ?>
                                    </span>
                                    <span class="woo-ready-tab-title"><?php echo wp_kses_post($tab['woo_ready_tabs_title']); ?></span> 
                            </li>
                            
                        <?php endforeach; ?>

                    </ul>
                </div>
                <div class="woo-ready-tab-content-wrapper gc--2-of-3">
                    <ul class="woo-ready-tab-content">
                        <?php foreach ($settings['woo_ready_tabs'] as $tab) : ?>

                            <li class="<?php echo esc_attr($tab['woo_ready_tabs_show_as_default']); ?>">

                                <?php if ('content' == $tab['woo_ready_tabs_content_type']) : ?>
                                    <?php echo wp_kses_post( do_shortcode($tab['woo_ready_tab_content']) ); ?>
                                <?php elseif ('template' == $tab['woo_ready_tabs_content_type']) : ?>
                                    <?php if (!empty($tab['woo_ready_tab_template'])) {
                                        echo Plugin::$instance->frontend->get_builder_content($tab['woo_ready_tab_template'], true);
                                    } ?>
                                <?php endif; ?>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

	<?php }

}