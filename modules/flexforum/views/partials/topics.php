<div class="row <?php echo is_client_logged_in() ? 'tw-mt-10' : '' ?>">
    <div class="col-md-10">
        <div class="panel_s flexforum-categories">
            <div class="panel-heading" style="display: flex; flex-direction: row; justify-content: space-between;">
                <span class="tw-font-semibold tw-text-lg">
                    <?php echo flexforum_lang('topics') ?>
                </span>

                <div>
                    <button onclick="new_flexforum_topic(); return false;" class="btn btn-primary">
                        <i class="fa-solid fa-plus tw-mr-1"></i>
                        <?php echo flexforum_lang('new_topic'); ?>
                    </button>
                </div>
            </div>
            <div class="panel-body">
                <div class="panel-table-full">
                    <table class="table dt-table">
                        <thead>
                            <th>
                                <?php echo flexforum_lang('topic'); ?>
                            </th>
                            <th>
                                <?php echo flexforum_lang('category'); ?>
                            </th>
                            <th>
                                <?php echo flexforum_lang('replies'); ?>
                            </th>
                            <th>
                                <?php echo flexforum_lang('likes'); ?>
                            </th>
                            <th>
                                <?php echo flexforum_lang('followers'); ?>
                            </th>
                            <th>
                                <?php echo flexforum_lang('options'); ?>
                            </th>
                        </thead>
                        <tbody>
                            <?php foreach ($topics as $topic) { ?>
                                <tr>
                                    <td>
                                        <span>
                                            <a href="<?php echo flexforum_get_topic_url($topic['slug']) ?>">
                                                <?php echo $topic['title']; ?>
                                            </a>

                                        </span>
                                    </td>
                                    <td>
                                        <a class="btn btn-link"
                                            href="<?php echo flexforum_get_category_filter_url($topic['category']) ?>">
                                            <?php echo flexforum_get_category_name($topic['category']) ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo $topic['replies'] ? number_format($topic['replies']) : 0 ?>
                                    </td>
                                    <td>
                                        <?php echo $topic['likes'] ? number_format($topic['likes']) : 0 ?>
                                    </td>
                                    <td>
                                        <?php echo $topic['followers'] ? number_format($topic['followers']) : 0 ?>
                                    </td>
                                    <td>
                                        <div class="tw-flex tw-items-center tw-space-x-3">
                                            <?php if (flexforum_user_can_edit_topic($topic['id'])) { ?>
                                                <button class='btn btn-default'
                                                    onclick="edit_flexforum_topic(<?php echo $topic['id'] ?>); return false;"
                                                    data-id="<?php echo $topic['id']; ?>"
                                                    class="tw-text-neutral-500 hover:tw-text-neutral-700 focus:tw-text-neutral-700">
                                                    <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                </button>
                                                <a class='btn btn-default'
                                                    href="<?php echo flexforum_get_url('delete_topic/' . $topic['id']); ?>"
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
    <div class="col-md-2">
        <div class="row">
            <div class="col-md-12">
                <h5>
                    <?php echo flexforum_lang('filter_by_category') ?>
                </h5>
            </div>
            <?php if (count($categories) > 0) { ?>
                <?php foreach ($categories as $category) { ?>
                    <div class="col-md-12">
                        <a href="<?php echo flexforum_get_category_filter_url($category['id']) ?>" class="btn btn-link">
                            <?php echo $category['name'] ?>

                            <span class="badge mleft5">
                                <?php echo flexforum_count_topic_for_category($category['id']) ?>
                            </span>
                        </a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="flexforum-no-categories text-center">
                    <?php echo flexforum_lang('no_categories_found') ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php $this->load->view('partials/topic-modal'); ?>
<script>
    window.addEventListener('load', function () {

        // On hidden modal reset the values
        $('#flexforum_topic_modal').on("hidden.bs.modal", function (event) {
            $('#additional').html('');
            $('#flexforum_topic_modal input').not('[type="hidden"]').val('');
            $('.add-title').removeClass('hide');
            $('.edit-title').removeClass('hide');
        });

        // On hidden modal re-render select input
        $('#flexforum_topic_modal').on("shown.bs.modal", function (event) {
            $('#category').selectpicker('render');
        });

        flexforum_topic_description_tinymce();
    });

    function flexforum_topic_description_tinymce() {
        init_editor(".flexforum-topic-description-client", flexforum_editor_config());
        init_editor(".flexforum-topic-description-admin");
    }

    function new_flexforum_topic() {
        $('#flexforum_topic_modal').modal('show');
        $('.edit-title').addClass('hide');
    }
    
    function flexforum_settings() {
        $('#flexforum_settings_modal').modal('show');
    }

    function edit_flexforum_topic(id) {
        $('#additional').append(hidden_input('id', id));
        let url = getBaseURL() + 'topic/' + id

        $.getJSON(url,
            function (data, textStatus, jqXHR) {
                if (data.success) {
                    $('#flexforum_topic_modal input[name="title"]').val(data.data.title);
                    $('#flexforum_topic_modal select[name="category"]').val(data.data.category)

                    if (data.data.closed == 1) {
                        $('#flexforum_topic_modal input[name="closed"]').prop('checked', true)
                    }
                    $('#category').selectpicker('render');
                    // $('#flexforum_topic_modal textarea[name="description"]').val(data.data.description);
                    // console.log(tinymce)
                    tinymce.editors.description.setContent(data.data.description);
                    $('#flexforum_topic_modal').modal('show');
                    $('.add-title').addClass('hide');
                } else {
                    alert_float('danger', data.message)
                }
            }
        );
    }

    function getBaseURL() {
        return "<?php echo flexforum_get_url() ?>";
    }
</script>