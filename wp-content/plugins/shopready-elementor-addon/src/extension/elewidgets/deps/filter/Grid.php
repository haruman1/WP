<?php

namespace Shop_Ready\extension\elewidgets\deps\filter;
use Shop_Ready\base\query\Filter;
/** 
* @since 1.0 
* WooCommerce Shop page grid filter
* Sidebar widget
* use in Shop Archive
* @author quomodosoft.com 
*/
class Grid extends Filter{
     
  public function register(){
    
    add_filter('woocommerce_shortcode_products_query',[ $this,'_price_filter' ] , 111,3);
    add_filter('woocommerce_shortcode_products_query',[ $this,'_search' ] , 112,3);
    add_filter('woocommerce_shortcode_products_query',[ $this,'_category' ] , 116,3);
    add_filter('woocommerce_shortcode_products_query',[ $this,'ajax_category' ] , 116,3);
    add_filter('woocommerce_shortcode_products_query',[ $this,'attribute_filter' ] , 117,3);
    add_filter('woocommerce_shortcode_products_query',[ $this,'page_count' ] , 10,3);
   
  }


  public function page_count($return_args ,$obj ,$type){ 

 
    if( !isset($_GET[ 'page_count' ]) ){
      return $return_args;
    }
    
    $return_args['posts_per_page']  = (int) sanitize_text_field($_GET[ 'page_count' ]);
    
    return $return_args;

  }
  public function attribute_filter($return_args ,$obj ,$type){
   
    if( !isset($_GET[ 'attribute_filter' ]) ){
      return $return_args;
    }

    if( !isset($_GET[ 'sr_attributes' ]) ){
      return $return_args;
    }

    if( !is_array( $_GET[ 'sr_attributes' ] ) ){
      return $return_args;
    }

    //sanitize in senitize_array_fld
    $tax_qry     = (array) $return_args['tax_query'];

    $attr = array_map( 'sanitize_text_field', $_GET[ 'sr_attributes' ] );
  
    foreach ($attr as $tax_type => $value) {
      $tax_qry[] = array(
           'taxonomy' => 'pa_'.$tax_type,
           'field'    => 'slug',
           'terms'    => wp_list_pluck($value,'value')
         );
    }
   
    $return_args['tax_query'] = $tax_qry;
 
    return $return_args;

  }

  public function senitize_array_fld($input){

     if(!is_array($input)){
        return sanitize_text_field($input);  
     }

     $return_data = [];

    foreach ($input as $_type => $value) {
      
      $key  = sanitize_text_field($_type);
      $data = sanitize_text_field($value);
      $return_data[$key]     = $data;
    }

    return $return_data;
  }

  /**
   * Price Filter widget
   * @param min_price max_price Url Args
   */
  function _price_filter( $return_args ,$obj ,$type ) {
  
    if( !isset($_GET[ 'min_price' ]) && !isset( $_GET[ 'max_price' ] ) ){
      return $return_args;
    }
     // sanitize_text_field
    $min_price = (integer) isset($_GET['min_price'])? sanitize_text_field($_GET['min_price']):0;
    $max_price =  (integer) isset($_GET['max_price'])? sanitize_text_field($_GET['max_price']):10000000000;
    
    $args = array(
          'key'       => '_price',
          'value'     => array( $min_price, $max_price ),
          'compare'   => 'BETWEEN',
          'type'      => 'numeric'  
        );

    $meta_qry     = [];

    if(isset($return_args['meta_query'])){
      $meta_qry     = (array) $return_args['meta_query'];
    }
    
    $meta_qry[] = $args;
    $return_args['meta_query'] = $meta_qry;
    $return_args['orderby']    = 'meta_value_num';
    $return_args['meta_key']   = '_price';
   
    return $return_args;

  }

  public function _search( $return_args ,$obj ,$type ){
   
    if(!isset($_GET['post_type'])){
      return $return_args;
    }

    if(!isset($_GET['s'])){
      return $return_args;
    }

    if( $_GET['post_type'] !='product' ){
      return $return_args;
    }

    $return_args['s'] = sanitize_title( $_GET['s'] );
    return $return_args;
  }

  public function _category( $return_args ,$obj ,$type ){

    if( !isset($_GET[ 'wr-category' ])){
      return $return_args;
    }
    // string type input
    $cat_slug =  sanitize_text_field( $_GET['wr-category'] );
    $args = array(
          'taxonomy' => 'product_cat',
          'field'    => 'slug',
          'terms'    => $cat_slug
      );

    $tax_qry                  = (array) $return_args['tax_query'];
    $tax_qry[]                = $args;
    $return_args['tax_query'] = $tax_qry;
    return $return_args;

  }

  public function ajax_category( $return_args ,$obj ,$type ){

    if( !isset($_GET[ 'sr_category' ])){
      return $return_args;
    }
    
    // array type inpuit data
    // We have senitize this in senitize_array_fld
 
    $cat_slug = array_map( 'sanitize_text_field', $_GET['sr_category'] );
    $args = array(
          'taxonomy' => 'product_cat',
          'field'    => 'term_id',
          'terms'    => $cat_slug
        );
 
    $tax_qry = [];  

    if(isset($return_args['tax_query'])){
      $tax_qry = (array) $return_args['tax_query'];
    }
    
    $tax_qry[]                = $args;
    $return_args['tax_query'] = $tax_qry;
    return $return_args;

  }

}