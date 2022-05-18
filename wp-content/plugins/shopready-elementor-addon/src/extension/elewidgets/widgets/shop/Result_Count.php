<?php

namespace Shop_Ready\extension\elewidgets\widgets\shop;

class Result_Count extends \Shop_Ready\extension\elewidgets\Widget_Base {

    protected function register_controls() {

        $this->text_css(
            [
                'title'        => esc_html__( 'Style', 'shopready-elementor-addon' ),
                'slug'         => 'wooready_products_grid_product_title_style',
                'element_name' => 's__wooready_products_grid_product_title_style',
                'selector'     => '{{WRAPPER}} .shop-ready--grid-result-count',
                'hover_selector'     => false
            ]
        );

    }

    protected function html() {

        $settings = $this->get_settings_for_display();
        echo woocommerce_result_count();
    
    }

}