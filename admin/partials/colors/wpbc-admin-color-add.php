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

  if($_REQUEST['action']=='edit' && $_REQUEST['color_id']??NULL) {
    $table_name = $wpdb->prefix . "bc_colors";
    $color = $wpdb->get_row("select * from $table_name where id={$_REQUEST['color_id']}");
  }
 ?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
  <h1 class="wp-heading-inline">Customizer</h1>
  <hr class="wp-header-end">
  <h2 class="">Colors</h2>
  <form class="" action="<?php echo admin_url('admin.php?page=wpbc-customize-colors'); ?>" method="post">
    <?php if($color??NULL) {
      wp_nonce_field( 'update-color');
      $action ="update"; ?>
      <input type="hidden" name="color_id" value="<?php esc_attr_e($color->id); ?>">
    <?php } else {
      wp_nonce_field( 'add-color');
      $action ="store";
    }
    ?>
    <input type="hidden" name="action" value="<?php esc_attr_e($action); ?>">
    <table class="form-table" role="presentation">
      <tbody>
        <tr>
          <th scope="row">Color Name</th>
          <td><input class="regular-text" required type="text" name="color_name" id="color_name" value="<?php esc_attr_e($color->color_name??NULL); ?>"></td>
        </tr>
        <tr>
          <th scope="row">Color Code</th>
          <td><input class="regular-text wpbc-color-field" required type="text" name="color_code" id="color_code" value="<?php esc_attr_e($color->color_code??NULL); ?>"></td>
        </tr>
        <tr>
          <th scope="row">Status</th>
          <td>
            <select name="status" required id="status">
              <option value="1" <?php selected( $color->status??NULL, 1, $echo = TRUE ); ?> >Active</option>
              <option value="0" <?php selected( $color->status??NULL, 0, $echo = TRUE ); ?>>Inactive</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
  </form>
</div>
<script type="text/javascript">
  // jQuery(document).ready(function($){
  //   $('.wpbc-color-field').wpColorPicker();
  // });
</script>
