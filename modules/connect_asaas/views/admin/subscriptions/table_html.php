<?php defined('BASEPATH') or exit('No direct script access allowed');

$table_data = [
  [
    'name'     => _l('the_number_sign'),
    'th_attrs' => ['class' => 'toggleable', 'id' => 'th-id'],
  ],
  [
    'name'     => _l('subscription_name'),
    'th_attrs' => ['class' => 'toggleable', 'id' => 'th-subscription-name'],
  ],
  [
    'name'     => _l('client'),
    'th_attrs' => ['class' => 'toggleable' . (isset($client)? ' not_visible' : ''), 'id' => 'th-company'],
  ],
  [
    'name'     => _l('project'),
    'th_attrs' => ['class' => 'toggleable', 'id' => 'th-project'],
  ],
  [
    'name'     => _l('subscription_status'),
    'th_attrs' => ['class' => 'toggleable', 'id' => 'th-status'],
  ],
  [
    'name'     => _l('next_billing_cycle'),
    'th_attrs' => ['class' => 'toggleable', 'id' => 'th-next-billing-cycle'],
  ],
    [
        'name'     => _l('date_subscribed'),
        'th_attrs' => ['class' => 'toggleable', 'id' => 'th-date-subscribed'],
    ],
    [
        'name'     => _l('subscription_last_sent'),
        'th_attrs' => ['class' => 'toggleable', 'id' => 'th-date-last-notified'],
    ],
];
render_datatable(
    $table_data,
    'subscriptions',
    ['number-index-1'],
    [
    'id'                         => 'table-subscriptions',
    'data-url'                   => $url,
    'data-last-order-identifier' => 'subscriptions',
    'data-default-order'         => get_table_last_order('subscriptions'),
  ]
);
$client = isset($client) ?  $client : null;
hooks()->add_action('app_admin_footer', function () use($client) {
  $userid = isset($client) ?  $client->userid : '';
    ?>
<script>
$(function() {
    var SubscriptionsServerParams = {};
    $.each($('._hidden_inputs._filters input'), function() {
        SubscriptionsServerParams[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    const userId = '<?= $userid ?>';
    let params = '';
    if(userId) {
        params = '?client_id=' + userId;
    }
    var url = admin_url + "connect_asaas/subscriptions/table" + params;
    initDataTable('.table-subscriptions', url, undefined, undefined, SubscriptionsServerParams,
        <?php echo hooks()->apply_filters('subscriptions_table_default_order', json_encode([6, 'desc'])); ?>
    );
});
</script>
<?php
});
?>
