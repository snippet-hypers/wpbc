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

  if($_REQUEST['action']=='edit' && $_REQUEST['font_id']??NULL) {
    $font_table_name = $wpdb->prefix . "bc_fonts";
    $font = $wpdb->get_row("select * from $font_table_name where id={$_REQUEST['font_id']}");
  }
 ?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
  <h1 class="wp-heading-inline">Customizer</h1>
  <hr class="wp-header-end">
  <h2 class="">Fonts</h2>
  <form class="" action="<?php echo admin_url('admin.php?page=wpbc-customize-fonts'); ?>" method="post">
    <?php if($font??NULL) {
      wp_nonce_field( 'update-font');
      $action ="update"; ?>
      <input type="hidden" name="font_id" value="<?php esc_attr_e($font->id); ?>">
    <?php } else {
      wp_nonce_field( 'add-font');
      $action ="store";
    }
    ?>
    <input type="hidden" name="action" value="<?php esc_attr_e($action); ?>">
    <table class="form-table" role="presentation">
      <tbody>
        <tr>
          <th scope="row">Font Name</th>
          <td><input class="regular-text" required type="text" name="font_name" id="font_name" value="<?php esc_attr_e($font->font_name??NULL); ?>"></td>
        </tr>
        <tr>
          <th scope="row">Font Url</th>
          <td><input class="regular-text" required type="text" name="font_url" id="font_url" value="<?php esc_attr_e($font->font_url??NULL); ?>"></td>
        </tr>
        <tr>
          <th scope="row">Status</th>
          <td>
            <select name="status" required id="status">
              <option value="1" <?php selected( $font->status??NULL, 1, $echo = TRUE ); ?> >Active</option>
              <option value="0" <?php selected( $font->status??NULL, 0, $echo = TRUE ); ?>>Inactive</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
  </form>
</div>
