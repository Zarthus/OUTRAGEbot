<?php
/**
 *	OUTRAGEbot - PHP 5.3 based IRC bot
 *
 *	Author:		David Weston <westie@typefish.co.uk>
 *
 *	Version:        2.0.0-Alpha
 *	Git commit:     0ff759c76277e70602a53631b1c787f238d39a59
 *	Committed at:   Mon Jul  4 21:07:53 BST 2011
 *
 *	Licence:	http://www.typefish.co.uk/licences/
 */


/**
 *	Setting the error reporting.
 */
error_reporting(E_ALL | E_STRICT);


/**
 *	Set the tick rate. Reduce this to improve performance.
 */
define("BOT_TICKRATE", 2600);


/**
 *	Some bot-brag-relating things.
 */
define("BOT_VERSION", "2.0.0-Alpha-0ff759c");
define("BOT_RELDATE", "04/07/2011");


/**
 *	The ways of the bots of sending messages.
 */
define("SEND_DEF", 0x0);
define("SEND_MAST", 0x1);
define("SEND_CURR", 0x2);
define("SEND_DIST", 0x4);
define("SEND_ALL", 0x8);


/**
 *	Message modifier definitions
 */
define("FORMAT", 0x20);


/**
 *	Channel/user modes.
 */
define("MODE_USER_VOICE", 1);
define("MODE_USER_HOPER", 2);
define("MODE_USER_OPER", 4);
define("MODE_USER_ADMIN", 8);
define("MODE_USER_OWNER", 16);


/**
 *	A little trick to do with event handlers.
 */
define("END_EVENT_EXEC", 0x80000000);


/**
 *	Internal: Event types
 */
define("EVENT_INPUT", 1);
define("EVENT_CUSTOM", 2);
define("EVENT_HANDLER", 3);
define("EVENT_COMMAND", 4);
