<?php
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'wp_shortlink_wp_head');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_head','rest_output_link_wp_head');
  remove_action('wp_head','wp_oembed_add_discovery_links');
  remove_action('wp_head','wp_oembed_add_host_js');
  remove_action('wp_print_styles', 'print_emoji_styles');

  if(!is_admin()) {
    add_action('init', 'add_script');
    add_action('template_redirect', 'redirect_404');
  }

  function add_script() {
    wp_deregister_script('imagesloaded');
    wp_deregister_script('jquery');
    wp_deregister_script('masonry');
    wp_deregister_script('pjax');
    wp_deregister_script('velocity');

    wp_enqueue_style('style', get_template_directory_uri().'/style.css', array(), '', false);
    if(wp_is_mobile()) {
      wp_enqueue_style('mobile', get_template_directory_uri().'/mobile.css', array('style'), '', false);
    }

    wp_enqueue_script('jquery', get_template_directory_uri().'/js/jquery-3.2.1.min.js', array(), '', true);
    wp_enqueue_script('easing', get_template_directory_uri().'/js/jquery.easing.min.js', array('jquery'), '', true);
    wp_enqueue_script('bottom', get_template_directory_uri().'/js/jquery.bottom.min.js', array('jquery'), '', true);
    wp_enqueue_script('pjax', get_template_directory_uri().'/js/jquery.pjax.min.js', array('jquery'), '', true);

    wp_enqueue_script('imagesloaded', get_template_directory_uri().'/js/imagesloaded.min.js', array('jquery'), '', true);
    wp_enqueue_script('velocity', get_template_directory_uri().'/js/velocity.min.js', array('jquery'), '', true);

    wp_enqueue_script('masonry', get_template_directory_uri().'/js/jquery.masonry.min.js', array('velocity'), '', true);
    wp_enqueue_script('function', get_template_directory_uri().'/js/function.min.js', array('masonry'), '', true);
  }

  function is_mobile() {
    $useragents = array(
      'iPhone',          // iPhone
      'iPod',            // iPod touch
      'Android',         // 1.5+ Android
      'dream',           // Pre 1.5 Android
      'CUPCAKE',         // 1.5+ Android
      'blackberry9500',  // Storm
      'blackberry9530',  // Storm
      'blackberry9520',  // Storm v2
      'blackberry9550',  // Storm v2
      'blackberry9800',  // Torch
      'webOS',           // Palm Pre Experimental
      'incognito',       // Other iPhone browser
      'webmate'          // Other iPhone browser
    );
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
  }

  function get_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img[^>]+?src=[\'"]([^\'"]+?)[\'"][^>]*?>/i', $post->post_content, $matches);

    return $matches;
  }

  function get_page_num() {
    $page = get_query_var('paged');
    if($page == 0) {
      $page = 1;
    }

    return $page;
  }

  function get_max_page_num() {
    global $wp_query;

    $max_page = $wp_query -> max_num_pages;
    return $max_page;
  }

  function redirect_404() {
    if(is_home() || is_single() || is_month() || is_page()) return;
    include(TEMPLATEPATH . '/404.php');
    exit;
  }
?>
