<?php echo form_open(is_client_logged_in() ? flexforum_client_url('replies') : flexforum_admin_url('replies'), ['id' => $form_id, 'class' => 'hidden flexforum-reply-form', 'data-id' => isset($reply['id']) ? $reply['id'] : '']); ?>
<div class="row">
    <div class="col-md-12">
        <div id="additional">
        </div>
    </div>
    <div class="col-md-12">
        <?php echo render_textarea('reply', flexforum_lang('reply', '', false), '', ['placeholder' => flexforum_lang('reply_placeholder')], [], '', is_admin() ? 'flexforum-reply-admin' : 'flexforum-reply-client'); ?>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">
            <?php echo flexforum_lang('submit'); ?>
            <div class="loader hidden"></div>
        </button>
    </div>
</div>
<?php echo form_close(); ?>