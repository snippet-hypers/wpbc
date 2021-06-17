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
  <h1 class="wp-heading-inline">Cliparts</h1>
  <a href="<?php echo admin_url('admin.php?page=wpbc-customize-cliparts&action=add'); ?>" class="page-title-action">Add New</a>
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
  $table_name = $wpdb->prefix . "bc_clips";
  $query = "select * from $table_name";
  $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
  $total = $wpdb->get_var( $total_query );
  $items_per_page = 20;
  $page = $_GET['cpage']??1;
  $offset = ( $page * $items_per_page ) - $items_per_page;
  $cliparts = $wpdb->get_results( $query . " ORDER BY clipart_name LIMIT ${offset}, ${items_per_page}" );
   ?>

  <table class="wp-list-table widefat fixed striped table-view-list posts">
  	<thead>
    	<tr>
    		<th class="row-title"><?php esc_attr_e( 'Clipart Name' ); ?></th>
        <th><?php esc_attr_e( 'Image' ); ?></th>
    		<th><?php esc_attr_e( 'Category' ); ?></th>
    		<th><?php esc_attr_e( 'Status' ); ?></th>
    		<th><?php esc_attr_e( 'Actions' ); ?></th>
    	</tr>
  	</thead>
  	<tbody>
      <?php if(!empty($cliparts)):
        foreach($cliparts as $clipart):
          $src = '';
          if($clipart->clipart_id??NULL) {
            $src = wp_get_attachment_url( $clipart->clipart_id );
          }
          $cat_table_name = $wpdb->prefix . "bc_cat";
          $cat = $wpdb->get_var("select cat_name from $cat_table_name where id={$clipart->cat_id}"); ?>
        	<tr>
        		<td class="row-title"><label for="tablecell"><?php esc_attr_e($clipart->clipart_name??NULL); ?></label></td>
        		<td><?php if($src!=''){?>
              <img style="width:40px" src="<?php echo $src; ?>" alt="">
            <?php } ?></td>
        		<td><?php esc_attr_e($cat??NULL); ?></td>
        		<td><?php if($clipart->status) { esc_attr_e('Active'); } else { esc_attr_e('Inactive'); } ?></td>
        		<td>
              <a href="<?php echo admin_url("admin.php?page=wpbc-customize-cliparts&action=edit&clip_id={$clipart->id}"); ?>"><span class="dashicons dashicons-edit"></span></a>
              <a href="<?php echo admin_url("admin.php?page=wpbc-customize-cliparts&action=delete&clip_id={$clipart->id}"); ?>" onclick="return confirm('Are you sure to proceed?')"><span class="dashicons dashicons-trash"></span></a>
            </td>
        	</tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td class="row-title" colspan="5"><label for="tablecell"><?php esc_attr_e(
                'No data found...',
              ); ?></label></td>
        </tr>
      <?php endif; ?>
  	</tbody>
  	<tfoot>
  	<tr>
      <th class="row-title"><?php esc_attr_e( 'Clipart Name' ); ?></th>
      <th><?php esc_attr_e( 'Image' ); ?></th>
      <th><?php esc_attr_e( 'Category' ); ?></th>
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
