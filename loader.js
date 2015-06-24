(function() {
    var jq = document.createElement('script');
    jq.src = "https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js";
    document.getElementsByTagName('head')[0].appendChild(jq);
    
    var ajaxUrl = 'ajax.php';
    var $;
    
    
    jq.onload = function() {
        $ = jQuery.noConflict();
        
        IPS.initiate();
        IPS.initiateFormControl();
    }
    
    var IPS = {
        initiate: function() {
            Ajax.initiate();
        },
        initiateFormControl: function() {
            $('form').appendTo(this.formSecurity());
        },
        formSecurity: function() {
            Ajax.request('session_token');
        }
        
    }
    
    var Ajax = {
        initiate: function() {
  
            return this;
        },
        request: function(command) {
            //alert(command);
        }
    }
})();