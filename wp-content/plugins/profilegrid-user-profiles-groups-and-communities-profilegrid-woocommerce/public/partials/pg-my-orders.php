<?php
$customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => get_current_user_id(),
        'post_type'   => wc_get_order_types( 'view-orders' ),
        'post_status' => array_keys( wc_get_order_statuses() )
) );

if ( $customer_orders ) { ?>

<table class="shop_table shop_table_responsive my_account_orders">

        <thead>
                <tr>
                
                        <th class="order-date"><span class="nobr"><?php _e( 'Date', 'profilegrid-woocommerce' ); ?></span></th>
                        <th class="order-status"><span class="nobr"><?php _e( 'Status', 'profilegrid-woocommerce' ); ?></span></th>
                        <th class="order-total"><span class="nobr"><?php _e( 'Total', 'profilegrid-woocommerce' ); ?></span></th>
                        <th class="order-actions">&nbsp;</th>
                
                </tr>
        </thead>

        <tbody><?php
                foreach ( $customer_orders as $customer_order ) {
                        $order      = new WC_Order($customer_order);
                        
                        //$order->populate( $customer_order );
                        $item_count = $order->get_item_count();

                        ?><tr class="order" data-order_id="<?php echo $order->get_order_number(); ?>">
                            <td class="order-date" data-title="<?php _e( 'Date', 'profilegrid-woocommerce' ); ?>">
                                        <time datetime="<?php echo date( 'Y-m-d', strtotime( $order->get_date_created() ) ); ?>" title=""><?php echo date_i18n( 'j M y', strtotime( $order->get_date_created() ) ); ?></time>
                            </td>
                            <td class="order-status" data-title="<?php _e( 'Status', 'profilegrid-woocommerce' ); ?>" style="text-align:left; white-space:nowrap;">
                                    <span class="um-woo-status <?php echo $order->get_status(); ?>"><?php echo wc_get_order_status_name( $order->get_status() ); ?></span>
                            </td>
                            <td class="order-total" data-title="<?php _e( 'Total', 'profilegrid-woocommerce' ); ?>"><?php echo $order->get_formatted_order_total() ?></td>
                            <td class="order-detail">
                                    <?php echo '<a class="pg-woocommerce-view-order" onclick="pg_view_woocommerce_order('.$order->get_order_number().')">'.__('View Order','profilegrid-woocommerce').'<i class="fa fa-eye" aria-hidden="true"></i></a>'; ?>
                            </td>
                        </tr><?php
                }
        ?></tbody>
    </table>
<?php }



else{echo '<div class="pg-alert-warning pg-alert-info"><span>'; _e('You have not placed any orders yet.','profilegrid-woocommerce'); echo '</span></div>';} ?>
   
<div id="pm-show-woocommere-order-dialog" class="pm-bg" style="display: none;">
    <div class="pm-popup-mask"></div> 
    <div class="pm-popup-container pm-radius5">
        <div class="pm-popup-title pm-dbfl pm-bg-lt pm-pad10 pm-border-bt">
          <i class="fa fa-camera-retro" aria-hidden="true"></i>
        <?php _e('Order Details','profilegrid-woocommerce');?>
          <div class="pm-popup-close pm-difr">
              <img src="<?php echo $path;?>partials/images/popup-close.png" height="24px" width="24px">
          </div>
      </div>
      <div id="pg_woocommerce_order_details"></div>
        
    </div>
</div>
