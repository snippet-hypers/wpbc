<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       author@wpbc.com
 * @since      1.0.0
 *
 * @package    Wpbc
 * @subpackage Wpbc/admin/partials
 */

  global $wpdb;

  wp_enqueue_media();

  $cat_table_name = $wpdb->prefix . "bc_cat";
  $cats = $wpdb->get_results("select * from $cat_table_name where status=1");

  $src = '';
  $style = 'display:none;';

  if($_REQUEST['action']=='edit' && $_REQUEST['clip_id']??NULL) {
    $table_name = $wpdb->prefix . "bc_clips";
    $clipart = $wpdb->get_row("select * from $table_name where id={$_REQUEST['clip_id']}");
  }
 ?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
  <h1 class="wp-heading-inline">Customizer</h1>
  <hr class="wp-header-end">
  <h2 class="">Cliparts</h2>
  <?php if(!empty($cats)): ?>
    <form class="" action="<?php echo admin_url('admin.php?page=wpbc-customize-cliparts'); ?>" method="post">
      <?php if($clipart??NULL) {
        wp_nonce_field( 'update-clipart');
        $action ="update";
        $src = wp_get_attachment_url( $clipart->clipart_id );
        if($src!='') {
          $style = '';
        }
         ?>
        <input type="hidden" name="clip_id" value="<?php esc_attr_e($clipart->id); ?>">
      <?php } else {
        wp_nonce_field( 'add-clipart');
        $action ="store";
      }
      ?>
      <input type="hidden" name="action" value="<?php esc_attr_e($action); ?>">
      <table class="form-table" role="presentation">
        <tbody>
          <tr>
            <th scope="row">Clipart Name</th>
            <td><input class="regular-text" required type="text" name="clipart_name" id="clipart_name" value="<?php esc_attr_e($clipart->clipart_name??NULL); ?>"></td>
          </tr>
          <tr>
            <th scope="row">Category</th>
            <td>
              <select name="cat_id" required id="cat_id">
                <option value="">Select Category</option>
                <?php foreach($cats as $cat): ?>
                  <option value="<?php esc_attr_e($cat->id); ?>" <?php selected( $clipart->cat_id??NULL, $cat->id, TRUE ); ?> ><?php esc_attr_e($cat->cat_name); ?></option>
                <?php endforeach; ?>
              </select>
            </td>
          </tr>
          <tr>
            <th scope="row">Status</th>
            <td>
              <select name="status" required id="status">
                <option value="1" <?php selected( $clipart->status??NULL, 1, $echo = TRUE ); ?> >Active</option>
                <option value="0" <?php selected( $clipart->status??NULL, 0, $echo = TRUE ); ?>>Inactive</option>
              </select>
            </td>
          </tr>
          <tr>
            <th scope="row">Image</th>
            <td>
              <div>
                <input class="wpdb_img_id" type="hidden" required name="clipart_id" id="clipart_id" value="<?php echo $clipart->clipart_id??NULL; ?>" class="regular-text">
                <div class="chosen_img_wrap" style="<?php esc_attr_e($style); ?>">
                  <img id="chosen_img" src="<?php esc_attr_e($src); ?>" style="max-width:150px;" draggable="false" alt=""><br />
                </div>
                <input class="wpdb_img_url" type="text" readonly required name="clipart_url" id="clipart_url" value="<?php echo $src??NULL; ?>" class="regular-text">
                <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Choose Image">

            </div>
            </td>
          </tr>
        </tbody>
      </table>
      <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
    </form>
  <?php else: ?>
    <p>Please add categories in order to add cliparts.</p>
  <?php endif; ?>
</div>
