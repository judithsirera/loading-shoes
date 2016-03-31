<?php

if( DEV_MODE )
{
	$config['default']['db_driver']		= 'mysql';
	$config['default']['db_host']		= 'localhost';
	$config['default']['db_user']		= 'root';
	$config['default']['db_password']	= '';
	$config['default']['db_name']		= '';
}
else
{
	$config['default']['db_driver']		= 'mysql';
	$config['default']['db_host']		= '';
	$config['default']['db_user']		= '';
	$config['default']['db_password']	= '';
	$config['default']['db_name']		= '';
}