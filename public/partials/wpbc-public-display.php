<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       author@wpbc.com
 * @since      1.0.0
 *
 * @package    Wpbc
 * @subpackage Wpbc/public/partials
 */

  global $wpdb;

  $font_table_name = $wpdb->prefix . "bc_fonts";
  $font_query = "select * from $font_table_name where status=1";
  $fonts = $wpdb->get_results( $font_query . " ORDER BY font_name" );

  $color_table_name = $wpdb->prefix . "bc_colors";
  $color_query = "select * from $color_table_name where status=1";
  $colors = $wpdb->get_results( $color_query . " ORDER BY color_name" );

  $cat_table_name = $wpdb->prefix . "bc_cat";
  $cat_query = "select * from $cat_table_name where status=1";
  $cats = $wpdb->get_results( $cat_query . " ORDER BY cat_name" );

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wpbc_container">
  <div class="wpbc_canvas_area">
    <div class="wpbc_canvas_div">
      <canvas id="canvas"></canvas>
      <div style="visibility:hidden;position:absolute;top:-100%">
        <?php
          $st0 = $st1 = $st2 = '#0d33cb';
          // $st1 = '#76777B';
          // $st2 = '#76777B';
          // $st2 = '#5D5E62;';
         ?>
        <svg version="1.1" id="Layer_1" xmlns:x="&ns_extend;" xmlns:i="&ns_ai;" xmlns:graph="&ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 921.89 173.28" style="enable-background:new 0 0 921.89 173.28;" xml:space="preserve">
          <switch>
            <g i:extraneous="self">
              <path class="st0" style="fill: <?php echo $st0; ?>;" d="M60.28,112.43c0,0,16.05,15,180.52,15s165.48-15,165.48-15v-45h-346v46"/>
              <ellipse class="st1" style="fill: <?php echo $st1; ?>;opacity:0.3;" cx="234.57" cy="147.93" rx="155.5" ry="7.5"/>
                <text transform="matrix(1 0 0 1 325.2451 144.7144)" class="st0 st1" id="id-of-the-text">hey</text>
                 <text class="testText" id="testText" x="10" y="20" style="fill:red;">Several lines: goes here
                  <tspan x="10" y="45">First line.</tspan>
                  <tspan x="10" y="70">Second line.</tspan>
                </text>
              <path class="st2" style="fill: <?php echo $st2; ?>; opacity: .5" d="M60.13,68.43h346c0,0,20-16-175-17C45.11,50.48,60.13,68.43,60.13,68.43z"/>
              <path class="st0" style="fill: <?php echo $st0; ?>;" d="M534.61,112.43c0,0,16.05,15,180.52,15s165.48-15,165.48-15v-45h-346v46"/>
              <ellipse class="st1"  style="fill: <?php echo $st1; ?>;opacity:0.3;" cx="708.57" cy="147.93" rx="155.5" ry="7.5"/>
              <path class="st2" style="fill: <?php echo $st2; ?>; opacity: .5;" d="M534.47,68.43h346c0,0,20-16-175-17C519.45,50.48,534.47,68.43,534.47,68.43z"/>
              <text transform="matrix(1 0 0 1 215.7119 28.9006)" class="st3 st4">Front</text>
              <text transform="matrix(1 0 0 1 692.4087 28.9006)" class="st3 st4">Back</text>
            </g>
          </switch>
        </svg>
      </div>
      <div id="front_preview">

      </div>
    </div>
  </div>
  <div class="wpbc_options_area">
    <div class="wpbc_front_options">
      <div class="wpbc_front_box">
        <div class="wpbc_root_box wpbc_left_box_1">
          <div class="wpbc_heading">
            <h2><?php _e('Front Message'); ?></h2>
          </div>
          <div class="wpbc_body">
            <ul class="wpbc_root_list">
              <li class="wpbc_message_box">
                <textarea id="front_name" name="front_name" placeholder="Add Message"></textarea>
              </li>
              <li class="font_box">
                <label class="">Change Font
                  <span class="selected"></span>
                </label>
                <div class="wpbc_box wpbc_left_box_2">
                  <div class="wpbc_heading">
                    <div class="wpbc_back"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path></svg></div>
                    <h3><?php _e('Update Font'); ?></h3>
                  </div>
                  <div class="wpbc_body">
                    <ul>
                      <?php foreach($fonts as $font): ?>
                        <li class="wpbc_select_option wpbc_font_option">
                          <link rel="stylesheet" href="<?php echo $font->font_url; ?>">
                          <label style="font-family:'<?php echo $font->font_name; ?>';">
                            <input type="radio" name="front_font" value="<?php echo $font->font_name; ?>">
                            <div class="wpbc_font_details">
                              <span class="wpbc_seleted_message"></span>
                              <span class="wpbc_font"><?php echo $font->font_name; ?></span>
                            </div>
                          </label>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="font_color">
                <label class="">Change Color
                  <span class="selected"></span>
                </label>
                <div class="wpbc_box wpbc_left_box_3">
                  <div class="wpbc_heading">
                    <div class="wpbc_back"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path></svg></div>
                    <h3><?php _e('Update Color'); ?></h3>
                  </div>
                  <div class="wpbc_body">
                    <ul>
                      <?php foreach($colors as $color): ?>
                        <li class="wpbc_select_option wpbc_color_option">
                          <label  data-input="<?php echo $color->color_name; ?>">
                            <input type="radio" name="color" value="<?php echo $color->color_code; ?>">
                            <span style="background-color:<?php echo $color->color_code; ?>; "></span>
                          </label>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="clip_art_left">
                <label class="" data-fancybox data-src="#clip_art_left">Clip Art (Left of Message)
                  <span class="selected"></span>
                </label>
                <div id="clip_art_left" class="wpbc_box wpbc_left_box_4">
                  <div class="wpbc_heading">
                    <div class="wpbc_back"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path></svg></div>
                    <h3><?php _e('Update Clipart'); ?></h3>
                  </div>
                  <div class="wpbc_body">
                    <ul>
                      <?php foreach($cats as $cat):
                        $src = '';
                        if($cat->cat_image??NULL) {
                          $src = wp_get_attachment_url( $cat->cat_image );
                        } ?>
                        <li class="wpbc_select_option wpbc_cat_left_option">
                          <label  data-input="<?php echo $cat->cat_name; ?>">
                            <input type="radio" name="cat_left" value="<?php echo $cat->cat_name; ?>">
                            <span><?php echo $cat->cat_name; if($src!=''){?>
                              <img style="width:40px" src="<?php echo $src; ?>" alt="">
                            <?php } ?>
                            </span>
                          </label>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="clip_art_right">
                <label class="" data-fancybox data-src="#clip_art_right">Clip Art (Right of Message)
                  <span class="selected"></span>
                </label>
                <div id="clip_art_right" class="wpbc_box wpbc_left_box_4">
                  <div class="wpbc_heading">
                    <div class="wpbc_back"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path></svg></div>
                    <h3><?php _e('Update Clipart'); ?></h3>
                  </div>
                  <div class="wpbc_body">
                    <ul>
                      <?php foreach($cats as $cat):
                        $src = '';
                        if($cat->cat_image??NULL) {
                          $src = wp_get_attachment_url( $cat->cat_image );
                        } ?>
                        <li class="wpbc_select_option wpbc_cat_left_option">
                          <label  data-input="<?php echo $cat->cat_name; ?>">
                            <input type="radio" name="cat_right" value="<?php echo $cat->cat_name; ?>">
                            <span><?php echo $cat->cat_name; if($src!=''){?>
                              <img style="width:40px" src="<?php echo $src; ?>" alt="">
                            <?php } ?>
                            </span>
                          </label>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="clip_art_right">
                <label class="">Decoration Type</label>
                <span class="selected"></span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="wpbc_back_options">

    </div>
  </div>
  <div class="wpbc_additional_options_area">

  </div>
</div>
<style media="screen">

</style>
<script type="text/javascript">
  jQuery(document).ready(function($) {

  });

</script>
