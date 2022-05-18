<?php

namespace Shop_Ready\extension\templates\hooks\product;
use Shop_Ready\base\Template_Redirect as Shop_Ready_Template;

/*
* WooCommerece Single Product 
*   
*/

Class Single extends Shop_Ready_Template{


    public function register(){
       
       
        $this->set_name('single');

        add_filter('body_class', [$this, 'set_body_class'] );
        add_filter('wp_head', [$this, 'push_data'] );
        add_filter('wc_get_template_part', [$this, 'get_template'], 120, 3);
        
        add_action($this->get_action_hook(), [$this, 'dynamic_template'],10);
        add_action('shop_ready_single_product_notification', [$this, 'single_product_notification'],100);
      
    }

     /**
     * | is_renderable_template |
     * @param  [string]  $template
     * @param  [string]  $slug
     * @param  [string]  $name
     * @return boolean | int
     */
    public function is_renderable_template( $template, $slug, $name ){
        
        if( is_product() ) {
            return $name === 'single-product' && $slug === 'content';
        }
         
        return false;
    }

    /**
     * | Default Notification |
     * | Customize style from editor site settings |
     * @since 1.0
     * @return void
     */
    public function single_product_notification(){

        echo '<div class="elementor-section elementor-section-boxed">';  

            echo '<div class="elementor-container elementor-column-gap-default ">';  
                echo '<div class="woocommerce-product-page-notice-wrapper width:100% ">';
                    wc_print_notices();
                echo '</div>';
            echo '</div>';

        echo '</div>';
   
    }

    

    /**
    * | set_body_class |
    * @author     <quomodosoft.com>
    * @since   File available since Release 1.0
    * @param  [string]  $classes
    * @return array | []
    */
    public function set_body_class($classes){

        if( is_product() ) {
           
            return array_merge( $classes, array( 'shopready-elementor-addon','woo-ready-'.$this->name ) );
        }

        return  $classes;
    }

    public function push_data(){

        if( !is_product() ) {
           return;
        }

        ?>

        <script type="text/javascript">
            var wready_ajaxurl      = '<?php echo admin_url('admin-ajax.php'); ?>';
            var wready_product_id   = '<?php echo get_the_id(); ?>';
        </script>

     <?php
    }


}
