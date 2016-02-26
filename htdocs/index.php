<?php

include_once( '../configure/general.config.php' );

include_once( PATH_ENGINE . 'configure.class.php' );
include_once( PATH_ENGINE . 'view.class.php' );
include_once( PATH_ENGINE . 'controller.class.php' );
include_once( PATH_ENGINE . 'database.class.php' );
include_once( PATH_ENGINE . 'model.class.php' );
include_once( PATH_ENGINE . 'url.class.php' );
include_once( PATH_ENGINE . 'filter.class.php' );
include_once( PATH_ENGINE . 'images.class.php' );
include_once( PATH_ENGINE . 'session.class.php' );
include_once( PATH_ENGINE . 'uploader.class.php' );

include_once( PATH_ENGINE . 'dispatcher.class.php' );

$dispatcher = new Dispatcher();