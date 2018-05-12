<div class="container">
<div class="container" id="article_list">

    <h3 align="center">Article List</h3>
    <button class="btn btn-primary" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Person</button>
    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button><br><br>

    <table class="table" id="table" style="width:100%">
        <thead class="thead-dark" align="center">
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Status</th>
                <th>Date Created</th>
                <th>Last Update</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="thead-light" style="width:100%">
        </tbody>
    </table>
</div>
</div>

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){
    var save_method; //for save method string
    var table;

    table = $('.table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "bPaginate": false,
        "bLengthChange": false,
        "bInfo": false,
        "bFilter": false,        
        "bAutoWidth": true,        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Admin/ajax_list')?>",
            "type": "POST",
            "dataType": "JSON"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });
});

function reload_table()
{
    localtion.reload(true);
}

function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Article'); // Set Title to Bootstrap modal title
}

function delete_article(id_article)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('Admin/ajax_delete')?>/"+id_article,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                location.reload(true);
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR.responseText);
            }
        });

    }
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('Admin/ajax_add')?>";
    } else {
        url = "<?php echo site_url('Admin/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                location.reload(true);
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert(jqXHR.responseText);
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function edit_article(id_article)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('Admin/ajax_edit')?>/"+id_article,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data[0].id_article);
            $('[name="title"]').val(data[0].title);
            $('[name="slug"]').val(data[0].slug);
            $('[name="status"]').val(data[0].status);
            $('[name="content"]').val(data[0].content);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Article'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            // alert('Error get data from ajax');
            alert(jqXHR.responseText);
            // document.write(jqXHR.responseText);
        }
    });
}

</script>
<!-- Bootstrap modal -->
<div class="container">
<div class="modal fade" id="modal_form" role="dialog">
<br><br><br><br><br><br>
    <div class="modal-dialog modal-lg" style="padding: 25px">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title">Person Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form">
                <div class="form-group">
                        <input type="hidden" name="id" id='id' placeholder='Type title for article' class='form-control'>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id='title' placeholder='Type title for article' class='form-control'>
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id='slug' placeholder='Type slug for article' class='form-control'>
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="Publish">Publish</option>
                            <option value="Draft">Draft</option>
                            <option value="Unpublish">Unpublish</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Content</label>
                        <div class="form-group">
                            <textarea name="content" id="content" class="form-control" rows="10">Type Your Content Here!</textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

</div>