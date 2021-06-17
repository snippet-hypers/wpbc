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

  $src = '';
  $style = 'display:none;';

  if($_REQUEST['action']=='edit' && $_REQUEST['clipcat_id']??NULL) {
    $table_name = $wpdb->prefix . "bc_cat";
    $clipcat = $wpdb->get_row("select * from $table_name where id={$_REQUEST['clipcat_id']}");

  }
 ?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
  <h1 class="wp-heading-inline">Customizer</h1>
  <hr class="wp-header-end">
  <h2 class="">Clip Art Categories</h2>
  <form class="" action="<?php echo admin_url('admin.php?page=wpbc-customize-clipcats'); ?>" method="post">
    <?php if($clipcat??NULL) {
      wp_nonce_field( 'update-clipcat');
      $action ="update";
      if($clipcat->cat_image??NULL) {
        $src = wp_get_attachment_url( $clipcat->cat_image );
      }
      if($src!='') {
        $style = '';
      }
       ?>
      <input type="hidden" name="clipcat_id" value="<?php esc_attr_e($clipcat->id); ?>">
    <?php } else {
      wp_nonce_field( 'add-clipcat');
      $action ="store";
    }
    ?>
    <input type="hidden" name="action" value="<?php esc_attr_e($action); ?>">
    <table class="form-table" role="presentation">
      <tbody>
        <tr>
          <th scope="row">Category Name</th>
          <td><input class="regular-text" required type="text" name="cat_name" id="cat_name" value="<?php esc_attr_e($clipcat->cat_name??NULL); ?>"></td>
        </tr>

        <tr>
          <th scope="row">Status</th>
          <td>
            <select name="status" required id="status">
              <option value="1" <?php selected( $clipcat->status??NULL, 1, $echo = TRUE ); ?> >Active</option>
              <option value="0" <?php selected( $clipcat->status??NULL, 0, $echo = TRUE ); ?>>Inactive</option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row">Image</th>
          <td>
            <div>
              <input class="wpdb_img_id" type="hidden" required name="cat_image" id="cat_image" value="<?php echo $clipcat->cat_image??NULL; ?>" class="regular-text">
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
</div>
