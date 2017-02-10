<?php
/**
+------------------------------------------------------------------------+
| dev-storm.com                                                          |
+------------------------------------------------------------------------+
| Copyright (c) 2014 dev-storm.com Team                                  |
+------------------------------------------------------------------------+
| @author flaver <flaver@dev-storm.com>                                  |
| @copyright flaver, dev-storm.com                                       |
| @package devstorm.errors                                               |
| @desc error msg                                                        |
+------------------------------------------------------------------------+
 */
namespace devStorm\Library\Error;

 class Notification {
 	// BASIC MSG'S //
 	const ERROR_GITHUB_PROBLEM = "Anscheined git es gerade ein Problem mit github.com, wir versuchen den Fehler zu finden.";
 	const ERROR_USER_ALLREADY_EXISTS = "Der User mit dem Username ###username### existiert schon.";
    const ERROR_EAMIL_ALLREADY_EXISTS = "Der User mit dem Username ###email### existiert schon.";
    const ERROR_OOPS = "I think he is dead gim! Da ging was schief, bitte versuche es doch nochmal";
 }
 
?>