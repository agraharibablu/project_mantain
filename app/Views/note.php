<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>

<div class="container">


    <div class="row mt-3">
        <div class="col-md-2">
            <a href="javascript:void(0)" id="addNewBtn"><i class="fas fa-plus-circle fa-2x"></i><span class="h4">Add New</span></a>
        </div>
        <div class="col-md-8">
        <input type="text" class="search form-control from-control-sm">
        </div>
    </div>

    <div class="row" id='addNew' style="display: none;">
        <div class="col-lg-12 col-md-12 col-12">
            <h2>Write Here</h2>

            <div class="card p-3">
                <form action="save/note" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <lable>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Write Title">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name='content' class="form-control" rows='10' placeholder="Write Content Here"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="w-25 btn btn-success btn-sm">
                    </div>
                </form>
            </div>
            <div class="float-right">
                <span><a href="javascript:void(0)" id="closeBtn">Close</a></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12" id="gridData">
            <h2>List Here</h2>
            <?php foreach ($result as $val) { ?>
                <div class="card m-2 p-2">
                    <div class="font-weight-bold"><?= $val->title ?></div>
                    <div class=""><?= $val->content ?></div>
                    <div class="row mt-4">
                    <div class="col-md-6">
                    <span class="font-weight-bold"><?=date_format(date_create("$val->created_at"),"d M Y");?></span>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="#" class="text-info edit" data='<?= $val->id ?>' data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="text-danger remove" data='<?= $val->id ?>' data-toggle="tooltip" title="Remove"><i class="far fa-trash-alt"></i></a>
                    </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="row">
    <div class="col-md-4 ml-auto mr-auto">
    <div><?php echo $pager->links();?></div>
    </div>
    </div>

</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id='updteData' method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Here</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" id='contentId' name='id'>
                <div class="p-4">
                    <div class="form-group">
                        <lable>Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Write Title">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name='content' class="form-control" id="content" rows='5' placeholder="Write Content Here"></textarea>
                    </div>
                </div>

                <div class="modal-footer text-center">
                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php if (!empty($message)) { ?>
    <script>
        let status = '<?= $message['status'] ?>';
        let text = '<?= $message['text'] ?>';
        swal(`${status}`, `${text}`, `${status}`);
    </script>
<?php } ?>


<script>
$(document).ready(function() {

$('.search').keyup(function() {
    let value = $(this).val();

    let url = "<?= base_url('search') ?>";
    $.ajax({
        url: url,
        type: 'get',
        data: {
            'value': value
        },
        dataType: 'JSON',
        success: function(data) {
            $('#gridData').html(data);
           
        }
    });
});
});
</script>

<script>
    $(document).ready(function() {

        $('.edit').click(function() {
            let id = $(this).attr('data');

            let url = "<?= base_url('edit/note') ?>";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'id': id
                },
                dataType: 'JSON',
                success: function(data) {

                    $('#contentId').val(data.id);
                    $('#title').val(data.title);
                    $('#content').val(data.content);
                    $('#exampleModalCenter').modal('show');
                }
            });
        });

        $("form#updteData").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            let url = "<?= base_url('update/note') ?>";
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    swal(data.status, data.text, data.status);
                    if (data.status == 'success') {
                        setTimeout(function() {
                            location.reload();
                        }, 1000)
                    }
                }
            });
        });


        $('.remove').click(function() {
            let id = $(this).attr('data');

            let url = "<?= base_url('remove/note') ?>";
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            'id': id
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            if (willDelete) {
                                swal(`${data.status}! ${data.text}`, {
                                    icon: data.status,
                                });
                                if(data.status=='success'){
                                  location:reload();
                                }
                            } else {
                                swal("Your imaginary file is safe!");
                            }

                        }

                    })

                });

        });

        $('#addNewBtn').click(function() {
            $('#addNew').show();
        })

        $('#closeBtn').click(function() {
            $('#addNew').hide();
        })

    });
</script>
<?= $this->endSection() ?>