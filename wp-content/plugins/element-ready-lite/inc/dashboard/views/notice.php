<div class="notice is-dismissible element-ready-admin-notice-remote">
    <div class="notice-content">
        <?php 
            echo wp_kses_post(base64_decode($_data['msg']));
        ?>
       
    </div>

    <button type="button" class="notice-dismiss">
        <span class="screen-reader-text"><?php echo esc_html__('Dismiss this notice.','element-ready'); ?></span>
    </button>
</div>