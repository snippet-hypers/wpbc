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

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
  <h1 class="wp-heading-inline">Colors</h1>
  <a href="<?php echo admin_url('admin.php?page=wpbc-customize-colors&action=add'); ?>" class="page-title-action">Add New</a>
  <hr class="wp-header-end">

  <?php
  if(isset($_GET['data-success'])) {
    echo '<div class="notice notice-success is-dismissible"><p>Data Saved</p></div>';
  }
  if(isset($_GET['data-error'])) {
    echo '<div class="notice notice-error is-dismissible"><p>Something went wrong</p></div>';
  }
  if(isset($_GET['data-deleted'])) {
    echo '<div class="notice notice-error is-dismissible"><p>Data deleted</p></div>';
  }
  $table_name = $wpdb->prefix . "bc_colors";
  $query = "select * from $table_name";
  $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
  $total = $wpdb->get_var( $total_query );
  $items_per_page = 20;
  $page = $_GET['cpage']??1;
  $offset = ( $page * $items_per_page ) - $items_per_page;
  $colors = $wpdb->get_results( $query . " ORDER BY color_name LIMIT ${offset}, ${items_per_page}" );
   ?>

  <table class="wp-list-table widefat fixed striped table-view-list posts">
  	<thead>
    	<tr>
    		<th class="row-title"><?php esc_attr_e( 'Color Name' ); ?></th>
    		<th><?php esc_attr_e( 'Color Code' ); ?></th>
    		<th><?php esc_attr_e( 'Status' ); ?></th>
    		<th><?php esc_attr_e( 'Actions' ); ?></th>
    	</tr>
  	</thead>
  	<tbody>
      <?php if(!empty($colors)):
        foreach($colors as $color): ?>
        	<tr>
        		<td class="row-title"><label for="tablecell"><?php esc_attr_e($color->color_name??NULL); ?></label></td>
        		<td>
              <div class="wpbc_color_box" style="width:75px; height:20px;border:1px solid #000; border-radius:3px;background-color:<?php echo $color->color_code; ?>">

              </div>
              <?php esc_attr_e($color->color_code??NULL); ?>
            </td>
        		<td><?php if($color->status) { esc_attr_e('Active'); } else { esc_attr_e('Inactive'); } ?></td>
        		<td>
              <a href="<?php echo admin_url("admin.php?page=wpbc-customize-colors&action=edit&color_id={$color->id}"); ?>"><span class="dashicons dashicons-edit"></span></a>
              <a href="<?php echo admin_url("admin.php?page=wpbc-customize-colors&action=delete&color_id={$color->id}"); ?>" onclick="return confirm('Are you sure to proceed?')"><span class="dashicons dashicons-trash"></span></a>
            </td>
        	</tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td class="row-title" colspan="4"><label for="tablecell"><?php _e('No data found...'); ?></label></td>
        </tr>
      <?php endif; ?>
  	</tbody>
  	<tfoot>
  	<tr>
      <th class="row-title"><?php esc_attr_e( 'Color Name' ); ?></th>
      <th><?php esc_attr_e( 'Color Code' ); ?></th>
      <th><?php esc_attr_e( 'Status' ); ?></th>
      <th><?php esc_attr_e( 'Action' ); ?></th>
  	</tr>
  	</tfoot>
  </table>
  <div class="tablenav bottom">
  	<div class="tablenav-pages">
      <span class="displaying-num"><?php echo $total; ?> items</span>
  		<span class="pagination-links">
        <?php  echo paginate_links( array(
          'base' => add_query_arg( 'cpage', '%#%' ),
          'format' => '',
          'prev_text' => __('&laquo;'),
          'next_text' => __('&raquo;'),
          'total' => ceil($total / $items_per_page),
          'current' => $page
        )); ?>
  		</span>
  	</div>
  	<br class="clear">
  </div>

</div>
