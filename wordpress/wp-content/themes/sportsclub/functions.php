<?php

$widgets = [
  'widget_text',
  'widget_contacts',
  'widget_cocial_links',
  'widget_iframe',
  'widget_info'
];

foreach ($widgets as $widget){
  require_once(__DIR__ . '/inc/' . $widget . '.php' );
}

  add_action( 'widgets_init', 'sc_register' );
  add_action('wp_enqueue_scripts', 'sc_scripts');
  add_action('after_setup_theme', 'sc_setup');
  add_shortcode('sc-paste-link', 'sc_paste_link');

  add_filter('show_admin_bar','__return_false');
  add_filter('sc_widget_text', 'do_shortcode');
  
  function _sc_assets_path($path) {
    return get_template_directory_uri() . '/assets/' . $path;
  }
  
  function sc_scripts() {
    wp_enqueue_script(
      'js-script', 
      _sc_assets_path('js/js.js'), 
      array(), 
      1.0,
      true
    );
    wp_enqueue_style(
     'sc-styles',
     _sc_assets_path('css/styles.css'), 
      array(),
      '1.0',
      'all'
    );
  }

  function sc_register(){
    register_sidebar([
      'name' => 'Контакты в шапке',
      'id' =>  'sc-header',
      'before_widget' => null,
      'after_widget' => null
    ]);
    register_sidebar([
      'name' => 'Контакты футере',
      'id' =>  'sc-footer',
      'before_widget' => null,
      'after_widget' => null
    ]);
    register_sidebar([
      'name' => 'Сайдбар в футере - Колонка-1',
      'id' =>  'sc-footer-column-1',
      'before_widget' => null,
      'after_widget' => null
    ]);
    register_sidebar([
      'name' => 'Сайдбар в футере - Колонка-2',
      'id' =>  'sc-footer-column-2',
      'before_widget' => null,
      'after_widget' => null
    ]);
    register_sidebar([
      'name' => 'Сайдбар в футере - Колонка-3',
      'id' =>  'sc-footer-column-3',
      'before_widget' => null,
      'after_widget' => null
    ]);
    register_sidebar([
      'name' => 'Карта',
      'id' =>  'sc-map',
      'before_widget' => null,
      'after_widget' => null
    ]);
    register_sidebar([
      'name' => 'Сайдбар под картой',
      'id' =>  'sc-after-map',
      'before_widget' => null,
      'after_widget' => null
    ]);
    register_widget('sc_widget_text');
    register_widget('sc_widget_contacts');
    register_widget('sc_widget_cocial_links');
    register_widget('sc_widget_iframe');
    register_widget('sc_widget_info');

  }

  function sc_paste_link($attr ){
    $params = shortcode_atts([
      'type' => '',
      'text' => '',
      'link' => 'link'
    ], $attr);

    $params['text'] = $params['text'] ? $params['text'] : $params['link']; 
    if ($params['link']){
      $protocol = '';
      switch ($params['type']) {
        case 'email':
           $protocol = 'mailto:';
          break;
        case 'phone':
          $tel = preg_replace('/[^+,0-9]/', '', $params['link']);
          $protocol = 'tel:';
          $params['link'] = $tel;
          break;
        default:
          $protocol = '';
          break;
      }

      $link = $protocol . $params['link'];
      $text = $params['text'];

      return "<a href=\"${link}\">${text}</a>";
      
    } else {
      return '';
    }
  }


  function sc_setup() {
    register_nav_menu('menu-header', 'Меню в header сайта');
    register_nav_menu('menu-footer', 'Меню в footer сайта');

    
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    //add_theme_support('menus');
  }






?>