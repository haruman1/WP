<?php

/* 
* Widget templates
* @since 1.0
*/

    $settings_id         = 'shop_ready_templates';
    $option_switch_key   = 'shop_ready_templates_switch';
    $switch_js_target    = $settings_id.'_data_tpl';
    $nonce_field_val     = '_shop_ready_templates';
    $action_key          = 'shop_ready_templates_options';
    $option_key          = 'shop_ready_templates';
    $label_identifier    = 'quomodo-template-';
    $label_identifier2   = 'quomodo-template-switch-';
    $elementor_templates = shop_ready_get_elementor_saved_templates();
    $heading             = esc_html__( 'WooCommerce Templates','shopready-elementor-addon' );
    $template_settings   = shop_templates_config()->all();
   
    
?>
    <!-- Widgets Swicher  -->
    <form id="woo-ready-admin-module-form" class="woo-ready-components-action quomodo-module-data" action="<?php echo admin_url('admin-post.php') ?>" method="post">
        <div class="quomodo-container-wrapper">
            <div class="quomodo-row-wrapper">
                <div class="woo-ready-component-form-wrapper Templates">
                    <div class="woo-ready-components-topbar">
                        <div class="woo-ready-title">
                            <h3 class="title"><i class="dashicons dashicons-arrow-left-alt woo-ready-offcanvas"></i> <?php echo esc_html($heading); ?></h3>
                        </div>
                        <div class="woo-ready-savechanges">
                       
                            <div class="woo-ready-admin-button">
                                <button type="submit" class="woo-ready-component-submit button woo-ready-submit-btn">
                                    <i class="dashicons dashicons-yes"></i>
                                    <?php echo esc_html__('Save Change','shopready-elementor-addon'); ?>
                                </button>
                            </div>
 
                        </div>
                    </div>
                    <div class="woo-ready-template-container"> 
                        <?php if( is_array( $template_settings ) ): ?>
                            <?php foreach( $template_settings as $item_key => $item): ?>
                                    <div class="woo-ready-component-row <?php echo esc_attr(isset( $item[ 'is_pro' ] ) && $item[ 'is_pro' ]? 'shop-ready-pro-order':''); ?> ">
                                        <div class="woo-ready-col quomodo-col-xl-11">
                                            <!--  Template Activation Switch -->
                                            <div class="woo-ready-template-activation">
                                                <div class="quomodo_switch_common woo-ready-common <?php echo esc_attr(isset( $item[ 'is_pro' ] ) && $item[ 'is_pro' ]?'woo-ready-pro woo-ready-dash-modal-open-btn':''); ?>">
                                    
                                                    <div class="quomodo_sm_switch woo-ready-templates-swicher-wrp">
                                                        
                                                        <strong><?php echo esc_html($item['title']); ?>
                                                            <?php if( isset($item['is_pro']) && $item['is_pro']): ?>
                                                                <span> <?php echo esc_html__( 'PRO', 'shopready-elementor-addon' ) ?> </span>
                                                            <?php endif; ?>    
                                                        </strong>
                                                        <?php if(isset($item['demo']) && $item['demo'] !=''): ?>
                                                            <a target="_blank" href="<?php echo esc_url($item['demo']); ?>" class="element-woo-data-tooltip"><?php echo esc_html__('view doc','shopready-elementor-addon'); ?></a>
                                                        <?php endif; ?>
                                                        <input data-target="<?php echo esc_attr($item_key); ?>" <?php echo esc_attr(isset($item['is_pro']) && $item['is_pro']?'readonly disabled':''); ?> <?php echo esc_attr($item['active']==1?'checked':''); ?> name="<?php echo esc_attr( $option_switch_key ); ?>[<?php echo esc_attr($item_key); ?>]" class="quomodo_switch <?php echo esc_attr($item_key); ?>" id="<?php echo esc_attr($label_identifier2); ?><?php echo esc_attr($item_key); ?>" type="checkbox">
                                                        <label for="<?php echo esc_attr($label_identifier2); ?><?php echo esc_attr($item_key); ?>"></label>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>  

                                        <div data-targetee="<?php echo esc_attr($item_key); ?>" class="woo-ready-col woo-ready-template-col quomodo-col-xl-11 ">
                                            <!-- Activation Switch container -->
                                            <div class="woo-ready-data">
                                                <strong><?php // echo esc_html($item['title']); ?></strong>
                                                <select data-title="<?php echo esc_html($item['title']); ?>" id="<?php echo esc_attr($item_key); ?>" class="woo-ready-selectbox" name="<?php echo esc_attr( $option_key ); ?>[<?php echo esc_attr($item_key); ?>]">
                                                
                                                    <option data-separator="true"> <?php echo esc_html__('Select Elementor Template','shopready-elementor-addon'); ?> </option>
                                                    <option value='' > <?php echo esc_html__('None','shopready-elementor-addon'); ?> </option>
                                                    <?php foreach( $elementor_templates as $tpl_item ): ?>
                                                        <option <?php echo esc_attr( $tpl_item->ID == $item[ 'id' ] ? 'selected' : ''); ?> value="<?php echo esc_attr($tpl_item->ID); ?>"> <?php echo esc_html($tpl_item->post_title); ?> </option>
                                                    <?php endforeach; ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <input type="hidden" name="action" value="<?php echo esc_attr($action_key); ?>">
                <?php echo wp_nonce_field($action_key, $nonce_field_val); ?>
            </div>
        </div> <!-- container end -->
    </form>
    <!-- Widget swicher form end -->