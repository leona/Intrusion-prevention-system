(function() {
    var jq = document.createElement('script');
    jq.src = "https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js";
    document.getElementsByTagName('head')[0].appendChild(jq);
    var $;
    
    jq.onload = function() {
        jQuery.noConflict();$ = jQuery;
        
        IPS.initiate();
    }
    
    var IPS = {
        initiate: function() {
            $('body').remove();
        }
    }
})();