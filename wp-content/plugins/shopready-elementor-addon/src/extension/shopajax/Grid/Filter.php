<?php

namespace Shop_Ready\extension\shopajax\Grid;
use Shop_Ready\helpers\classes\Elementor_Helper as WReady_Helper;
/** 
* @since 1.0 
* WooCommerce Shop page Ajax grid filter
* Sidebar widget
* use in Shop Archive
* @author quomodosoft.com 
*/
class Filter{
  
 
  public $result = [];    
  public function register(){
    
    //Ajax Action
    add_action( 'wp_ajax_shop_ready_shop_product_refresh_content' , [$this,'product_grid_content'] );
    add_action( 'wp_ajax_nopriv_shop_ready_shop_product_refresh_content' , [$this,'product_grid_content'] );

    add_filter( 'woocommerce_shortcode_products_query_results' , [$this,'woocommerce_shortcode_products_query_results'],20,2 );
    add_filter( 'paginate_links' , [$this,'paginate_links'],20,1 );
  

  }

  public function paginate_links($args){
   
  
    if(isset( $_REQUEST['action'] )  && $_REQUEST['action'] == 'shop_ready_shop_product_refresh_content'){

       $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
       $q_string      = parse_str($args,$shop_page_output);
       $page_number      = 1;
     
       if(isset( $shop_page_output['?product-page'] )){
         $page_number = $shop_page_output['?product-page'];
       }

       if(isset( $shop_page_output['product-page'] )){
          $page_number = $shop_page_output['product-page'];
       }
    
       return '?product-page='.$page_number;
      
    }
   
    return $args;
  }

  public function woocommerce_shortcode_products_query_results($result, $obj){
    $this->result = $result;
    return $result;
  }

  public function woocommerce_shortcode_products_query($data){

    return $data;
  }

  public function product_grid_content(){

    $attr_array = [];
     
    if( isset( $_REQUEST[ 'orderby' ] ) ){

      $attr_array['orderby'] = sanitize_text_field( $_REQUEST[ 'orderby' ] );
    }
  
    $shortcode = "[products " . shop_ready_attr_to_shortcide( $attr_array ) . "]";
  
    ob_start();
    echo do_shortcode( shortcode_unautop( $shortcode ) );
    $this->get_shop_to_header_content();
    $fragments['woo_ready_products'] = ob_get_clean();
    wp_send_json( $fragments );

  }

  public function get_shop_to_header_content(){
    $template_override_enable = WReady_Helper::get_global_setting('shop_ready_theme_template_override_enable','no');
    $show_default_orderby    = 'yes';
    $catalog_orderby_options = apply_filters(
			'woocommerce_catalog_orderby',
			array(
				'menu_order' => __( 'Default sorting', 'shopready-elementor-addon' ),
				'popularity' => __( 'Sort by popularity', 'shopready-elementor-addon' ),
				'rating'     => __( 'Sort by average rating', 'shopready-elementor-addon' ),
				'date'       => __( 'Sort by latest', 'shopready-elementor-addon' ),
				'price'      => __( 'Sort by price: low to high', 'shopready-elementor-addon' ),
				'price-desc' => __( 'Sort by price: high to low', 'shopready-elementor-addon' ),
			)
		);

    $orderby = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : '';

      wc_get_template(
        'loop/orderby.php',
        array(
          'catalog_orderby_options' => $catalog_orderby_options,
          'orderby'                 => $orderby,
          'show_default_orderby'    => $show_default_orderby,
        )
      );

      $per_page = sanitize_text_field(isset($_GET[ 'page_count' ]) ? (int) $_GET[ 'page_count' ] : 9); 

      $args = array(
        'total'    => isset( $this->result->total ) ? $this->result->total : 0,
        'per_page' => isset( $this->result->per_pag ) ? $this->result->per_pag : $per_page,
        'current'  => isset( $this->result->current_page ) ? $this->result->current_page : 1,
      );

      if( wc_get_loop_prop( 'is_paginated' ) ){
          wc_get_template( 'loop/result-count.php', $args );
      }
   
      $_page_args = array(
        'total'   =>  isset( $this->result->total_pages ) ? $this->result->total_pages: 1,
        'current' => isset( $this->result->current_page ) ? $this->result->current_page: 1,
        'base'    => add_query_arg( 'product-page', '%#%', '' )
      
      );
      
      wc_get_template( 'loop/pagination.php', $_page_args );
   

  }

}