<?php
/**
 * Plugin Name: Wordpress Titan
 * Description: The Wordpress Titan project is the first of its king to offer a sub OOP framework for wordpress.
 * Version: 2.0
 * Author: Levi Thornton
 * Author URI: www.linkedin.com/in/levithornton
 * License: This plug has the licenses to thrill.
 *
 * @usage
 * <? do_shortcode('[sm_titan'); ?>
 * <? smTitan_func(array(...)); ?>
 * <? smTitan::this(array(..))->..();?>
 */

/* Extend this class if you need it,
 * write your custom models and views
 * in the folders provided.
 */
class smTitan {

	private static $_instance = null;

	/**
	 * Our static object constructor
	 * @param Array $att
	 */
	public static function this($att){

		/* no need to explain, if you dont
		 * understand this part, dont
		 * be messing with it.
		 */
		self::$_instance = new static();

		if ($att !== NULL) {
			self::$_instance->_att = $att;
			self::$_instance->_results = new WP_Query( $att );
		}

		return self::$_instance;
	}
}

/**
 * BOOM Dynamic helper!!
 *
 * What need more? This constructs a short code
 * so our class now can be fired on the fly with
 * and method class call within the $att Array
 * using the "helper" key.
 *
 * @param Array $att
 */
function smTitan_func($att) {
	smTypeHelper::this($att)->{$att['helper']}();
} add_shortcode( 'smTitan', 'smTitan_func' );

/**
 * Auto load a classes when needed
 */
foreach (glob(plugin_dir_path( __FILE__ ) . 'helpers/'."*Helper.php") as $filename)
{
	include $filename;
}
foreach (glob(plugin_dir_path( __FILE__ ) . 'models/'."*Model.php") as $filename)
{
	include $filename;
}
foreach (glob(plugin_dir_path( __FILE__ ) . 'modules/'."*Module.php") as $filename)
{
	include $filename;
}