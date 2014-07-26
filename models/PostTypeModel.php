<?php
/**
 * Use this class for anything relating to Post types in Wordpress.
 * See module PostTypeModule.php for live usage
 * @version    Release: 1.0
 * <code>
 *  <?php
 *  PostTypeModel::$types = array(
 *   'menu_1',
 *   'menu_2'
 *   );
 *
 * PostTypeModel::_init();
 *  ?>
 * </code>
 */
class PostTypeModel extends smTitan {

  public static $types;

  /**
   * Set static init method
   *
   * @return null
   */
  public static function _init()
  {
    // wordpress add action
    add_action('init', array(__CLASS__, 'createPostTypes'));
  }

  /**
   * Create Wordpress post types
   *
   * @return null
   */
  public function createPostTypes()
  {
    // check if passed parameter is an array
    if(!is_array(PostTypeModel::$types))
    {
      // if it's not, create one
      $postTypes = array(PostTypeModel::$types);
    }
    else
    {
      // add already existing array to $postTypes
      $postTypes = PostTypeModel::$types;
    }

    // loop through the $postTypes array
    foreach($postTypes as $type)
    {
      // make string lowercase and remove spaces and hyphens and replace with underscores
      $post_type = HelpersModel::formatStripSpaces($type);

      // run register_post_type for wordpress
      register_post_type( $post_type,
        array(
          'labels' => array(
            'name' => __($type),
            'singular_name' => __(HelpersModel::depluralize($type))
          ),
        'public' => true,
        'has_archive' => true,
        )
      );
    }
  }
}
