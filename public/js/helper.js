/**
 +------------------------------------------------------------------------+
 | dev-storm.com                                                          |
 +------------------------------------------------------------------------+
 | Copyright (c) 2014 dev-storm.com Team                                  |
 +------------------------------------------------------------------------+
 | @author flaver <flaver@dev-storm.com>                                  |
 | @copyright flaver, dev-storm.com                                       |
 | @package devstorm.js                                                   |
 | @desc helper                                                           |
 +------------------------------------------------------------------------+
 */
var devstorm_Helper = {

	/**
	 * Show login function
	 * 
	 * @return {void}
	 */
	loginBox: function () {
		$("#dialog-confirm").append("Bitte gebe deinen Usernamen und dein Passwort ein<br /><form id=\"sidbarlogin\" action=\"login\" method='post'><lable>Username:</lable><input type='text' name='username' /><br /><lable>Passwort:</lable><input type='password' name='password' /><br /></form><br /><a href=\"register\">Registrieren</a>");
	    // Define the Dialog and its properties.
	    $("#dialog-confirm").dialog({
	        resizable: false,
	        modal: true,
	        title: "Modal",
	        height: 300,
	        width: 400,
	        buttons: {
	            "Login": function () {
	            	$("#sidbarlogin").submit();
	                $(this).dialog('close');
	            },
                "Abbrechen": function () {
	                $(this).dialog('close');
	            }
	        }
	    });
	}
};