<?php 

namespace Shop_Ready\system\base\assets;

use Automattic\Jetpack\Constants;
/*
* Register Base js and css
* @since 1.0 
*/

Class Register extends Assets {

    public function register(){
       
        // public
        add_action( 'wp_enqueue_scripts', [ $this , 'register_public_js' ] );
        add_action( 'wp_enqueue_scripts', [ $this , 'register_public_css' ] );
        // admin
        add_action( 'admin_enqueue_scripts', [ $this , 'register_css' ] );
        add_action( 'admin_enqueue_scripts', [ $this , 'register_js' ] );
    }
   /*
   * Register css and js
   */ 
   public function register_css(){
   
        if( function_exists( 'shop_ready_assets_config' ) ){

            $data = shop_ready_assets_config();

            if( isset( $data['css'] ) ) {

                foreach( $data['css'] as $css ) {

                    if( file_exists( $css[ 'file' ] ) && !$css['public'] ) {
                        $media = isset($css['media'])?$css['media']:'all';
                      
                        wp_register_style( str_replace( ['_'] , ['-'] , $css[ 'handle_name' ] ) , $css['src'] , $css['deps'] , filemtime( $css['file'] ), $media );
                
                    }

                }

            }

            unset($data);

        }
   }
   /*
   * Register css and js
   * @since 1.0
   */ 
   public function register_public_css(){
   
    if( function_exists( 'shop_ready_assets_config' ) ){

        $data = shop_ready_assets_config();

        if( isset( $data['css'] ) ) {

            foreach( $data['css'] as $css ) {

                if( file_exists( $css[ 'file' ] ) && $css['public'] ) {
                    $media = isset($css['media'])?$css['media']:'all';
                  
                    wp_register_style( str_replace( ['_'] , ['-'] , $css[ 'handle_name' ] ) , $css['src'] , $css['deps'] , filemtime( $css['file'] ), $media );
            
                }

            }

        }

        unset($data);

    }
}

   /*
   * Register css and js
   */ 
   public function register_js(){

       
        if( function_exists( 'shop_ready_assets_config' ) ){

            $data = shop_ready_assets_config();

            if( isset( $data['js'] ) ) {

                foreach( $data['js'] as $js ) {
                  
                    if(file_exists($js['file']) && !$js['public'] ) {

                         wp_register_script( str_replace( ['_'] , ['-'] , $js[ 'handle_name' ] ) , $js['src'] , $js['deps'] , filemtime( $js['file'] ), $js['in_footer'] );
                   
                    }

                }

            }

            unset($data);

        }

   }

   public function register_public_js(){
     
        if( function_exists( 'shop_ready_assets_config' ) ){

            $data = shop_ready_assets_config();

            if( isset( $data['js'] ) ) {

                foreach( $data['js'] as $js ) {
                
                    if(file_exists($js['file']) && $js['public'] ) {

                        wp_register_script( str_replace( ['_'] , ['-'] , $js[ 'handle_name' ] ) , $js['src'] , $js['deps'] , filemtime( $js['file'] ), $js['in_footer'] );
                
                    }

                }

            }
            
            unset($data);

        }
        
        if(class_exists('Constants')){
           
            $suffix = Constants::is_true( 'SCRIPT_DEBUG' ) ? '' : '.min';
            $version = Constants::get_constant( 'WC_VERSION' );
            
            wp_register_script( 'wc-jquery-ui-touchpunch', WC()->plugin_url() . '/assets/js/jquery-ui-touch-punch/jquery-ui-touch-punch' . $suffix . '.js', array( 'jquery-ui-slider' ), $version, true );
            wp_register_script( 'wc-price-slider', WC()->plugin_url() . '/assets/js/frontend/price-slider' . $suffix . '.js', array( 'jquery-ui-slider', 'wc-jquery-ui-touchpunch', 'accounting' ), $version, true );
            wp_localize_script(
                'wc-price-slider',
                'woocommerce_price_slider_params',
                array(
                    'currency_format_num_decimals' => 0,
                    'currency_format_symbol'       => get_woocommerce_currency_symbol(),
                    'currency_format_decimal_sep'  =>  wc_get_price_decimal_separator(),
                    'currency_format_thousand_sep' =>  wc_get_price_thousand_separator(),
                    'currency_format'              =>  str_replace( array( '%1$s', '%2$s' ), array( '%s', '%v' ), get_woocommerce_price_format() ) ,
                )
            );
        }   
      

    }

}