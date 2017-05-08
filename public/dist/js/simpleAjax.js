var simpleAjax = {

    url: "/",
    debug: true,

    init: function(url = '/', debug = true) {
        this.debug  = debug;
        this.url    = url;

        if(this.debug) {
            this.log('Version: 0.0.1');
            this.log('Debug:' + this.debug.toString());
            this.log('Url:' + this.url);
            this.log('Start up finished!');
        }
    },

    log: function(text) {
        console.log('[SIMPLE AJAX LIB] ' + text);
    },

    sendRequest: function(url) {
        this.log('Using Url: '+this.url + url);
        data = $.post(this.url + url, function(data) {
            console.log('[SIMPLE AJAX LIB] Success!');
            return data;
        });
        return data;
    },

    sendParamRequest: function(url, param) {
        this.log('Using Url: '+this.url + url);
        data = $.post(this.url + url, param);
        data.done(function(data) {
            console.log('[SIMPLE AJAX LIB] Success!');
        });
        return data;
    },

    showSuccess: function(text) {
        $("#flash-message").append('<div class="alert alert-success" role="alert">'+text+'</div>').fadeToggle(3400, "linear" );
    }

}
