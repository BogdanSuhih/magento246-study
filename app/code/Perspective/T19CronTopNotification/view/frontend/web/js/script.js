define([
    'jquery'
], function($) {
    'use strict';

    return function() {
        
        $('#tbn-close-btn').on('click', function() {
            $.ajax({
                url: '/topbarnotification/action/close',
                method: 'POST',
                data: { action: 'close_block' },
                success: function(response) {
                    if (response.success) {                        
                        $('.top-bar-notification').slideUp(500);
                        
                    }
                }
            });
        });
    }
});