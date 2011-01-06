<?php
// $Id: template.php,v 1.17.2.1 2009/02/13 06:47:44 johnalbin Exp $

/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to whitehouse_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: whitehouse_breadcrumb()
 *
 *   where whitehouse is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/*
 * Add any conditional stylesheets you will need for this sub-theme.
 *
 * To add stylesheets that ALWAYS need to be included, you should add them to
 * your .info file instead. Only use this section if you are including
 * stylesheets based on certain conditions.
 */
/* -- Delete this line if you want to use and modify this code
// Example: optionally add a fixed width CSS file.
if (theme_get_setting('whitehouse_fixed')) {
  drupal_add_css(path_to_theme() . '/layout-fixed.css', 'theme', 'all');
}
// */


/**
 * Implementation of HOOK_theme().
 */
/*
function whitehouse_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  // $hooks['hook_name_here'] = array( // Details go here );
  $hooks['image_size'] = array(
    'arguments' => array( 
      'pics' => NULL, 
      'preset_namespace' => NULL,
      'align' => NULL,
    ),
  );
  $hooks['video'] = array(
    'arguments' => array(
      'video_url' => NULL, 
      'size' => NULL,
      'align' => NULL,
      'autoplay' => NULL, 
    ),
  );

  return $hooks;
}
//
// Not in use, but here's an example theme function: 
//
function whitehouse_video($video_url, $size, $align, $autoplay) {
  $output = '';
  $output = ($align) ? "<div class='video-$align'>" : '<div>';
  // Currently there is one video per node. But this
  // would support more if we want (like pictures). 
  $url = check_url($video_url);
  $text = "[video: $url $size autoplay:$autoplay]";
  $output .= video_filter_filter('process', 0, -1, $text);
  $output .= '</div>';

  return $output;
}
// */

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */

// CONTINUE HERE. 
// WHEN REGISTRY IS NOT REBUILT, THIS GETS CALLED INSTEAD OF TEMPLATE_PREPROCESS_SWS/HOOK
// TODO handle terms
function whitehouse_preprocess(&$vars, $hook) {
  // $vars['sample_variable'] = t('Lorem ipsum.');
  unset($vars['terms']); // TODO Revisit. This may be too drastic. But hide terms from all templates for now.
}

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
//function whitehouse_preprocess_page(&$vars, $hook) {
function whitehouse_preprocess_page(&$vars, $hook) {
  // $vars['sample_variable'] = t('Lorem ipsum.');

  // Fix $base_path, it was falling back to '/'
  global $base_url;
  $vars['base_path'] = $base_url; 

  // set column <div> IDs
  // front page (three-column layout, right always stays at 272)
  if ($vars['is_front']) {
    // left-sm (small)
    $vars['left_id'] = 'left-sm';
    // center-sm 
    $vars['center_id'] = 'center-sm';
    // content-front (note, content is not in center column on front)
    $vars['content_id'] = 'content-front';

    // other front-page tweaks
    unset($vars['title']);

  } else { 
  // inside page (two- or three-column layout, left disappears, center widens)
    if ($vars['left']) { // check for content in left sidebar
      // left_col (150px)
      $vars['left_id'] = 'left_col';  
      // center_col (430px)
      $vars['center_id'] = 'center_col'; 
      // content (430px)
      $vars['content_id'] = 'content';
    } else {
      // center-col-wide (585px)
      $vars['center_id'] = 'center-col-wide';
      // content-wide (585px)
      $vars['content_id'] = 'content-wide';
    }
  }

  // node
  if (!empty($vars['node'])) {
    $node = $vars['node'];
    $type = $node->type;
    switch ($type) {

    case 'bio': // Bio (Biography) content type (Staff pages)
      // $title
      $field_bio_title = $node->field_bio_title[0]['safe']; 
      $title = check_plain($node->title);
      if (!empty($title) && !empty($field_bio_title)) {
        $vars['title'] = $title .', '. $field_bio_title;
      }
      break;

    case 'news_clip':
      unset($vars['title']);
      break;

    case 'press_release':
        unset($vars['title']);  
      break;
    }
  }
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* --Delete this line to use this function 
function whitehouse_preprocess_node(&$vars, $hook) {
  // $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function whitehouse_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function whitehouse_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override fieldgroup.module's theme_fieldgroup_fieldset().
 * 
 * Format a fieldgroup using a 'fieldset'.
 *
 * Derived from core's theme_fieldset, with no output if the content is empty.
 *
 * Some groups are grouped in CCK to make the
 * node/add and node/edit form more usable. These should not
 * be displayed in fieldsets.
 * TODO This should be moved into a the field_admin module when we develop it.
 */
function whitehouse_fieldgroup_fieldset($element) {
  if (empty($element['#children']) && empty($element['#value'])) {
    return '';
  } 
  // Ignore these groups, identified by their group title. 
  $ignore = array(
    'Date',
    'Pictures',
    'Teaser',
    'Video', 
    // Note: This step is redundant for groups listed above
    // because the sws module unsets those fields anyway.
    'Attachments',
  );
  // output inside fieldset
  $output = (isset($element['#description']) && $element['#description'] ? '<div class="description">'. $element['#description'] .'</div>' : '') . (!empty($element['#children']) ? $element['#children'] : '') . (isset($element['#value']) ? $element['#value'] : '') ;

  // if element isn't in ignore category, do default cck stuff
  if (!in_array($element['#title'], $ignore)) {
  
    if ($element['#collapsible']) {
      drupal_add_js('misc/collapse.js');

      if (!isset($element['#attributes']['class'])) {
        $element['#attributes']['class'] = '';
      }

      $element['#attributes']['class'] .= ' collapsible';
      if ($element['#collapsed']) {
        $element['#attributes']['class'] .= ' collapsed';
      }
    }
    // title in front of $output
    $output = ($element['#title'] ? '<legend>'. $element['#title'] .'</legend>' : '') . $output;
    $output = '<fieldset'. drupal_attributes($element['#attributes']) .'>'. $output ."</fieldset>\n";
  } 

  return $output;
}

/**
 * Override theme_links() from /includes/theme.inc
 * 
 * For lists of links, this function calls whitehouse_id()
 * to create an id (based on the title) for each link. This makes it 
 * easier to set widths for the primary menu. 
 * 
 * Return a themed set of links.
 *
 * @param $links
 *   A keyed array of links to be themed.
 * @param $attributes
 *   A keyed array of attributes
 * @return
 *   A string containing an unordered list of links.
 */
function whitehouse_links($links, $attributes = array('class' => 'links')) {
  global $language;
  $output = '';

  if (count($links) > 0) {
    $output = '<ul'. drupal_attributes($attributes) .'>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = $key;

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class .= ' first';
      }
      if ($i == $num_links) {
        $class .= ' last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language->language)) {
        $class .= ' active';
      }

      // Whitehouse Theme: Add an id attribute to each <li> element
      $id = whitehouse_id($link['title']);
      $output .= '<li'. drupal_attributes(array('id' => $id, 'class' => $class)) .'>';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $output .= l($link['title'], $link['href'], $link);
      }
      else if (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span'. $span_attributes .'>'. $link['title'] .'</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}

/**
 * @param
 *   title of the link, for which we are creating an id attribute
 * @return
 *   E.g. A link titled "Press Release" gets the id "press-release"
 */
// NOTE: This function is copied in theme-settings.php.
// Any changes here should be copied there too. 
function whitehouse_id($id) {
  $id = str_replace('&', '-', $id);
  $id = str_replace("'", '-', $id);
  $id = check_plain($id);
  $id = trim($id);
  $id = strtolower($id);
  $id = str_replace(' ', '-', $id);
  $id = str_replace('---', '-', $id);

  return $id;
}

/** 
 * 
 */
/**
 * Add Custom Generated CSS File
 * This file is generated each time the theme settings page is loaded.
 * @todo Test subthemes.
 */
$custom_css = file_directory_path() .'/subtheme/custom.css';
if (file_exists($custom_css)) {
  drupal_add_css($custom_css, 'theme', 'all', TRUE);
}
