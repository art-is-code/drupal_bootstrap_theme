<?php

/**
 * Add body classes if certain regions have content.
 
function bootstrap_drupal_preprocess_html(&$variables) {

}
*/

/**
 * Override or insert variables into the page template.
 
function bootstrap_drupal_preprocess_page(&$variables) {
  
  // $menu_block_pied = module_invoke('menu_block', 'block_view', 1);
  // $variables['menu_pied'] = render($menu_block_pied['content']);  

  if(arg(0) == 'node' && is_numeric(arg(1))) { 

    $nid = arg(1);

    if($variables['page']['content']['system_main']['nodes'][$nid]['#bundle'] == 'article'):

      $variables['is_article'] = TRUE;      

    endif; 
}
*/

/**
 * Implements hook_preprocess_maintenance_page().
 */
// function bootstrap_drupal_preprocess_maintenance_page(&$variables) {
//   // By default, site_name is set to Drupal if no db connection is available
//   // or during site installation. Setting site_name to an empty string makes
//   // the site and update pages look cleaner.
//   // @see template_preprocess_maintenance_page
//   if (!$variables['db_is_active']) {
//     $variables['site_name'] = '';
//   }
//   drupal_add_css(drupal_get_path('theme', 'bartik') . '/css/maintenance-page.css');
// }


/**
 * Override or insert variables into the node template.
 */
function bootstrap_drupal_preprocess_node(&$vars) {
  
  // if ($vars['view_mode'] == 'full' && node_is_page($vars['node'])) {
  //   $vars['classes_array'][] = 'node-full';
  // }

  $vars['view_mode'] = $vars['elements']['#view_mode'];
  $node = $vars['node'];

  // Add view-mode & type template suggestions and classes
  $vars['theme_hook_suggestions'][] = 'node__' . $vars['view_mode'];
  $vars['theme_hook_suggestions'][] = 'node__' . $node->type . '__' . $vars['view_mode'];  

  // drupal_add_js(drupal_get_path('theme', 'adn') . '/assets/scripts/jquery.flexslider-min.js');
  // drupal_add_css(drupal_get_path('theme', 'adn') . '/assets/styles/css/flexslider.css');

  //switch($vars['type']) {
    // case 'home':

    // drupal_add_css(libraries_get_path('flexslider') . '/flexslider.css');
    // drupal_add_js(libraries_get_path('flexslider') . '/jquery.flexslider.js');
    // drupal_add_js("jQuery(document).ready(function() { 
    //       jQuery('.flexslider').flexslider({animation:'slide', animationLoop: false, itemWidth:550, itemMargin:40}); 
    // });", array('type' => 'inline', 'scope' => 'header'));
      
    // break;
  //}
}


/**
 * Override or insert variables into the block template.
 */
// function bootstrap_drupal_preprocess_block(&$variables) {
  
// }

/**
 * Implements theme_field__field_type().
 */
// function bootstrap_drupal_field__taxonomy_term_reference($variables) {
//   $output = '';

//   // Render the label, if it's not hidden.
//   if (!$variables['label_hidden']) {
//     $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
//   }

//   // Render the items.
//   $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
//   foreach ($variables['items'] as $delta => $item) {
//     $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
//   }
//   $output .= '</ul>';

//   // Render the top-level DIV.
//   $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '"' . $variables['attributes'] .'>' . $output . '</div>';

//   return $output;
// }


/**
 * Returns HTML for primary and secondary local tasks.
 *
 * @param $variables
 *   An associative array containing:
 *     - primary: (optional) An array of local tasks (tabs).
 *     - secondary: (optional) An array of local tasks (tabs).
 *
 * @ingroup themeable
 * @see menu_local_tasks()
 */

// function bootstrap_drupal_menu_local_tasks(&$variables) {
//     $output = '';

//     if (!empty($variables['primary'])) {
//         $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
//         $variables['primary']['#prefix'] .= '<ul class="nav nav-tabs">';
//         $variables['primary']['#suffix'] = '</ul>';
//         $output .= drupal_render($variables['primary']);
//     }
//     if (!empty($variables['secondary'])) {
//         $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
//         $variables['secondary']['#prefix'] .= '<ul class="tabs nav-tabs">';
//         $variables['secondary']['#suffix'] = '</ul>';
//         $output .= drupal_render($variables['secondary']);
//     }    

//     return $output;
// }

/* Modifier le sélecteur de langue */
// function bootstrap_drupal_links__locale_block($variables) {
//   $links = $variables['links'];
//   $attributes = $variables['attributes'];
//   $attributes['class'][] = 'list-inline';
//   //dsm($variables['attributes']);
//   $heading = $variables['heading'];
//   global $language_url;
//   $output = '';

//   if (count($links) > 0) {
//     $output = '';

//     // Treat the heading first if it is present to prepend it to the
//     // list of links.
//     if (!empty($heading)) {
//       if (is_string($heading)) {
//         // Prepare the array that will be used when the passed heading
//         // is a string.
//         $heading = array(
//           'text' => $heading,
//           // Set the default level of the heading. 
//           'level' => 'h2',
//         );
//       }
//       $output .= '<' . $heading['level'];
//       if (!empty($heading['class'])) {
//         $output .= drupal_attributes(array('class' => $heading['class']));
//       }
//       $output .= '>' . check_plain($heading['text']) . '</' . $heading['level'] . '>';
//     }

//     $output .= '<ul' . drupal_attributes($attributes) . '>';

//     $num_links = count($links);
//     $i = 1;

//     foreach ($links as $key => $link) {
//       $class = array($key);

//       // Add first, last and active classes to the list of links to help out themers.
//       if ($i == 1) {
//         $class[] = 'first';
//       }

//       if ($i == $num_links) {
//         $class[] = 'last';
//       }

//       if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
//            && (empty($link['language']) || $link['language']->language == $language_url->language)) {
//         $class[] = 'active';
//       }

//       $output .= '<li' . drupal_attributes(array('class' => $class)) . '>';

//       if($link['language']->language == 'zh-hans'):
//         $link_title = $link['language']->native;
//       elseif($link['language']->language == 'ru'):
//         $link_title = $link['language']->native;
//       else:
//         $link_title = $link['language']->language;
//       endif;

//       if (isset($link['href'])) {
//         // Pass in $link as $options, they share the same keys.
//         $output .= l($link_title, $link['href'], $link);
//       }
//       elseif (!empty($link['title'])) {
//         // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
//         if (empty($link['html'])) {
//           $link['title'] = check_plain($link['title']);
//         }
//         $span_attributes = '';
//         if (isset($link['attributes'])) {
//           $span_attributes = drupal_attributes($link['attributes']);
//         }
//         $output .= '<span' . $span_attributes . '>' . $link_title . '</span>';
//       }

//       $i++;
//       $output .= "</li>\n";
//     }

//     $output .= '</ul>';
//   }

//   return $output;
// }