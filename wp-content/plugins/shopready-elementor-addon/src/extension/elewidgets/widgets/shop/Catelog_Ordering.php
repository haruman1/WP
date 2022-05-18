<?php

namespace Shop_Ready\extension\elewidgets\widgets\shop;

class Catelog_Ordering extends \Shop_Ready\extension\elewidgets\Widget_Base {

    protected function register_controls() {

        $this->box_css(
            [
                'title'        => esc_html__( 'Container', 'shopready-elementor-addon' ),
                'slug'         => 'wooready_products_grid_product_title_style',
                'element_name' => 's__wooready_products_grid_product_title_style',
                'selector'     => '{{WRAPPER}} .shop-ready--grid-ordering',
                'hover_selector'     => false
            ]
        );

        $this->text_css(
            [
                'title'        => esc_html__( 'Select', 'shopready-elementor-addon' ),
                'slug'         => 'wooready_products_grid_product_selcte_style',
                'element_name' => 's__wooready_products_grid_product_select_style',
                'selector'     => '{{WRAPPER}} .shop-ready--grid-ordering select',
                'hover_selector'     => '{{WRAPPER}} .shop-ready--grid-ordering select:hover'
            ]
        );
        $this->text_css(
            [
                'title'        => esc_html__( 'Select', 'shopready-elementor-addon' ),
                'slug'         => 'wooready_products_grid_product_selcte_option_style',
                'element_name' => 's__wooready_products_grid_product_select_option_style',
                'selector'     => '{{WRAPPER}} .shop-ready--grid-ordering select option',
                'hover_selector'     => false
            ]
        );

    }

    protected function html() {

        $settings = $this->get_settings_for_display();
        echo woocommerce_catalog_ordering();
      
    }

}