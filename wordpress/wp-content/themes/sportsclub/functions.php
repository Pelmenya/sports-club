<?php

  add_filter('show_admin_bar','__return_false');
  add_action('after_setup_theme', 'sc_setup');

  function sc_setup() {
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
  }




  function _sc_assets_path($path) {
    return get_template_directory() . '/assets/' . $path;
  }

?>