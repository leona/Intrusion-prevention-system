
var ips_jquery_check;

if (typeof jQuery !=== 'undefined')
    ips_jquery_check = $;

if (typeof $ !=== 'undefined')
    ips_jquery_check = $;

(function($) {
    if (typeof $ === 'undefined') {
        var jq = document.createElement('script');
        jq.src = "https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js";
        document.getElementsByTagName('head')[0].appendChild(jq);
    }
    
    var ajaxUrl = 'ajax.php'
    
    jq.onload = function() {
        if (typeof $ === 'undefined') {
            $ = jQuery.noConflict();
        }
        
        IPS.initiate();
        IPS.initiateFormControl();
        IPS.initiateElementChecks();
    }
    
    var IPS = {
        formElements: [],
        
        initiate: function() {
            Ajax.initiate();
        },
        initiateFormControl: function() {
            $('form').appendTo(this.formSecurity());
        },
        initiateElementChecks: function() {
            this.searchForms('input[type=email');

            if (this.formElements['input[type=email'].length) {
                this.formElements['input[type=email'].each(function(key, value) {
                    alert(1);
                });
            }
        },
        searchForms: function(inputType) {
            this.formElements[inputType] = $('form ' + inputType);
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
})(ips_jquery_check);