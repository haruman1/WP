'use strict';
  
(function($) {
    $(document).on('click','.shop-ready-admin-notice-remote .notice-dismiss', function(){
       $(this).parent().hide();    
   });
})(jQuery);
