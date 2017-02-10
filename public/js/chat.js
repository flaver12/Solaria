/**
 +------------------------------------------------------------------------+
 | dev-storm.com                                                          |
 +------------------------------------------------------------------------+
 | Copyright (c) 2014 dev-storm.com Team                                  |
 +------------------------------------------------------------------------+
 | @author flaver <flaver@dev-storm.com>                                  |
 | @copyright flaver, dev-storm.com                                       |
 | @package devstorm.js                                                   |
 | @desc chat module                                                      |
 +------------------------------------------------------------------------+
 */

var devstorm_chat = {

    /**
     * Send a msg to us
     *
     * @param username
     * @param msg
     * @return void
     */
    'send': function(username, msg) {
        $.ajax({
            'method'    : 'post',
            'url'       : '/chat',
            data        : { 'username':username, 'message':msg }
        }).done(function( data ) {
                console.log( "Sample of data:", data );
        });
    },
    'update': function() {

    },
    'disconnect': function() {

    },
    load: function() {

    }
};