<?php

	namespace AFS;

	class Config {
	    static $DB_DRIVER = 'Json';

	    //static $USER_IMAGE_PREFIX = "user_img_";
	    //static $USER_IMAGE_PATH = dirname(__FILE__) . "/data/avatars/";
	}

	define('USER_IMAGE_PATH', dirname(__FILE__) . "/data/avatars/");
	define('ALLOWED_IMAGE_TYPES', ['jpg', 'png', 'jpeg', 'gif', 'svg']);