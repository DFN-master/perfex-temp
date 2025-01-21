<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
init_head();
?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-heading">
                        <span class="tw-font-bold">
                            <?php echo $title ?>
                        </span>

                        <button onclick="new_flexforum_category(); return false;"
                            class="btn btn-primary pull-right display-block">
                            <i class="fa-regular fa-plus tw-mr-1"></i>
                            <?php echo flexforum_lang('new_category'); ?>
                        </button>

                        <a href="<?php echo flexforum_admin_url() ?>" class="btn btn-link">
                            <?php echo flexforum_lang(); ?>
                        </a>
                    </div>
                    <div class="panel-body">
                        <div class="panel-table-full">
                            <table class="table dt-table">
                                <thead>
                                    <th>
                                        <?php echo flexforum_lang('name'); ?>
                                    </th>
                                    <th>
                                        <?php echo flexforum_lang('slug'); ?>
                                    </th>
                                    <th>
                                        <?php echo flexforum_lang('options'); ?>
                                    </th>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $category['name']; ?>

                                                <span class="badge mleft5">
                                                </span>
                                            </td>
                                            <td>
                                                <?php echo $category['slug']; ?>
                                            </td>
                                            <td>
                                                <div class="tw-flex tw-items-center tw-space-x-3">
                                                    <?php if (has_permission(FLEXFORUM_MODULE_NAME, '', 'edit')) { ?>
                                                        <a href="#"
                                                            onclick="edit_flexforum_category(this,<?php echo $category['id']; ?>); return false"
                                                            data-name="<?php echo $category['name']; ?>"
                                                            data-slug="<?php echo $category['slug']; ?>"
                                                            class="tw-text-neutral-500 hover:tw-text-neutral-700 focus:tw-text-neutral-700">
                                                            <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                        </a>
                                                    <?php } ?>
                                                    <?php if (has_permission(FLEXFORUM_MODULE_NAME, '', 'delete')) { ?>
                                                        <a href="<?php echo flexforum_admin_url('delete_category/' . $category['id']); ?>"
                                                            class="tw-mt-px tw-text-neutral-500 hover:tw-text-neutral-700 focus:tw-text-neutral-700 _delete">
                                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('partials/category-modal'); ?>
<script>
    window.addEventListener('load', function () {

        // Validating the knowledge group form
        appValidateForm($('#flexforum_category_form'), {
            name: 'required'
        }, manage_flexforum_categories);

        // On hidden modal reset the values
        $('#flexforum_category_modal').on("hidden.bs.modal", function (event) {
            $('#additional').html('');
            $('#flexforum_category_modal input').not('[type="hidden"]').val('');
            $('.add-title').removeClass('hide');
            $('.edit-title').removeClass('hide');
        });
    });

    function manage_flexforum_categories(form) {
        var data = $(form).serialize();
        var url = form.action;
        $.post(url, data).done(function (response) {
            window.location.reload();
        });
        return false;
    }

    function new_flexforum_category() {
        $('#flexforum_category_modal').modal('show');
        $('.edit-title').addClass('hide');
    }

    function edit_flexforum_category(invoker, id) {
        $('#additional').append(hidden_input('id', id));
        $('#flexforum_category_modal input[name="name"]').val($(invoker).data('name'));
        $('#flexforum_category_modal').modal('show');
        $('.add-title').addClass('hide');
    }
</script>

<?php init_tail(); ?>
</body>

</html>