<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Simple Data Table</title>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<style>
    body {
        color: #566787;
        background: #f5f5f5;
		font-family: 'Roboto', sans-serif;
	}
    .table-responsive {
        margin: 30px 0;
    }
	.table-wrapper {
		min-width: 1000px;
        background: #fff;
        padding: 20px;        
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 8px 0 0;
        font-size: 22px;
    }
    .search-box {
        position: relative;        
        float: right;
    }
    .search-box input {
        height: 34px;
        border-radius: 20px;
        padding-left: 35px;
        border-color: #ddd;
        box-shadow: none;
    }
	.search-box input:focus {
		border-color: #3FBAE4;
	}
    .search-box i {
        color: #a0a5b1;
        position: absolute;
        font-size: 19px;
        top: 8px;
        left: 10px;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table td:last-child {
        width: 130px;
    }
    table.table td a {
        color: #a0a5b1;
        display: inline-block;
        margin: 0 5px;
    }
	table.table td a.view {
        color: #03A9F4;
    }
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }    
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 95%;
        width: 30px;
        height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 30px !important;
        text-align: center;
        padding: 0;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 6px;
        font-size: 95%;
    }    
</style>
</head>
<body>
    <!--Add Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="taskForm" method="POST">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" name="name" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Deadline:</label>
            <input type="date" class="form-control" name="deadline" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Task Details:</label>
            <textarea class="form-control" rows="10" name="details" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveTaskBtn">Save</button>
      </div>
    </div>
  </div>
</div>
    <!--Modal Ending-->

    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View Task Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Title</h5>
                <p id="view-title"></p>
                <hr>
                <h5>Description</h5>
                <p id="view-description"></p>
                <hr>
                <h5>Deadline</h5>
                <p id="view-deadline"></p>
                <hr>
            </div>
        </div>
    </div>
</div>
    <!--Modal ending-->

    <!--Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm" method="POST">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" name="name" id="editName">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Deadline:</label>
            <input type="text" class="form-control" name="deadline" id="editDeadline">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Task Details:</label>
            <textarea class="form-control" rows="10" name="details" id="editDescription"></textarea>
          </div>
          <input type="hidden" name="id" id="id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editTaskBtn">Save</button>
      </div>
    </div>
  </div>
    </div>
    <!--Modal Ending-->

    <!--Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this task?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

    <!--Modal Ending-->

    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2><b>Tasks</b></h2></div>
                        <div class="col-sm-4">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add</button>
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" class="form-control" placeholder="Search&hellip;">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name <i class="fa fa-sort"></i></th>
            <th>Deadline</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task): ?>
    <tr>
        <td><?= $task['id'] ?></td>
        <td><?= $task['title'] ?></td>
        <td><?= $task['deadline'] ?></td>
        <td>
            <a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
            <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
            <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
        </td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>

            </div>
        </div>        
    </div>     
</body>

<script>
$(document).ready(function() {
    var base_url = "<?php echo base_url(); ?>";

    $('#saveTaskBtn').click(function(e) {
        e.preventDefault();
        var formData = $('#taskForm').serialize();
        $.ajax({
            type: 'POST',
            url: base_url + 'addTask',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error: Failed to insert data.');
            }
        });
    });


    $('.view').click(function(e) {
    e.preventDefault();

    var taskId = $(this).closest('tr').find('td:first').text(); 
    $.ajax({
        type: 'POST',
        url: 'getTaskDetails',
        data: {taskId: taskId},
        dataType: 'json',
        success: function(response) {
            $('#viewModal #view-title').text(response.title);
            $('#viewModal #view-description').text(response.description);
            $('#viewModal #view-deadline').text(response.deadline);

            $("#viewModal").modal("show");
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error: Failed to fetch task details.');
        }
    });
});

$('.edit').click(function(e) {
    e.preventDefault();

    var taskId = $(this).closest('tr').find('td:first').text(); 
    $.ajax({
        type: 'POST',
        url: 'editTaskDetails',
        data: {taskId: taskId},
        dataType: 'json',
        success: function(response) {
            $('#editModal #editName').val(response.title);
            $('#editModal #editDescription').val(response.description);
            $('#editModal #editDeadline').val(response.deadline);
            $('#editModal #id').val(response.id);

            $("#editModal").modal("show");
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error: Failed to fetch task details.');
        }
    });
});

$('#editTaskBtn').click(function(e) {
        e.preventDefault();
        var formData = $('#editForm').serialize();
        $.ajax({
            type: 'POST',
            url: base_url + 'editTask',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error: Failed for edit data.');
            }
        });
    });

$('.delete').click(function(e) {
    e.preventDefault();
    var taskId = $(this).closest('tr').find('td:first').text(); 
    $('#deleteModal').modal('show');

    $('#deleteModal .btn-danger').click(function() {
        $.ajax({
            type: 'POST',
            url: base_url + 'deleteTask',
            data: {taskId: taskId},
            dataType: 'json',
            success: function(response) {
                alert('Task deleted successfully');
                $('#deleteModal').modal('hide');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error: Failed to delete task.');
            }
        });
    });
});
});

</script>


</html>