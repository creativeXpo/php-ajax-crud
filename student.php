<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
    <!-- Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Alertify -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
  </head>
  <body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4 mt-5">
                    <h5 class="card-title">Card title 
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addStudent">
                            Add Student
                        </button>
                    </h5>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Course</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    require 'dbcon.php';
                                    $query = "SELECT * FROM students";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0 ) {

                                        foreach($query_run as $student){
                                            ?>

                                            <tr>
                                                <td><?= $student['id'];?></td>
                                                <td><?= $student['name'];?></td>
                                                <td><?= $student['email'];?></td>
                                                <td><?= $student['phone'];?></td>
                                                <td><?= $student['course'];?></td>
                                                <td>
                                                    <button type="button" value="<?= $student['id']; ?>" class="viewStudentBtn btn btn-info" data-bs-toggle="modal" data-bs-target="#studentViewModal">View</button>
                                                    <button class="editStudentBtn btn btn-success" type="button" value="<?= $student['id']; ?>" data-bs-toggle="modal" data-bs-target="#studentEditModal">Edit</button>
                                                    <button class="deleteStudentBtn btn btn-danger" type="button" value="<?= $student['id']; ?>">Delete</button>
                                                </td>
                                            </tr>
                                            
                                            <?php 
                                        }
                                    }

                                ?>
                            </tbody>
                        </table>
                    </div>                  
                </div>

                <!-- Add Student Modal -->
                <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="saveStudent">
                            <div class="modal-body">

                                <div id="errorMessage" class="alert alert-warning d-none"></div>

                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="email" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="phone">Phone</label>
                                    <input class="form-control" type="text" name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="course">Course</label>
                                    <input class="form-control" type="text" name="course">
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Student</button>
                            </div>
                        </form>

                        </div>

                    </div>
                </div>

                <!-- Edit Student Modal -->
                <div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="updateStudent">
                            <div class="modal-body">

                                <div id="EditErrorMessage" class="alert alert-warning d-none"></div>

                                <input type="hidden" name="stuid" id="stuid">

                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" type="text" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" type="email" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="phone">Phone</label>
                                    <input class="form-control" id="phone" type="text" name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="course">Course</label>
                                    <input class="form-control" id="course" type="text" name="course">
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Student</button>
                            </div>
                        </form>

                        </div>

                    </div>
                </div>

                <!-- View Student Modal -->
                <div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                            <div class="modal-body">

                                <div id="EditErrorMessage" class="alert alert-warning d-none"></div>

                                <input type="hidden" name="stuid" id="stuid">

                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <p class="form-control" id="view_name" name="name"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <p class="form-control" id="view_email"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="phone">Phone</label>
                                    <p class="form-control" id="view_phone"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="course">Course</label>
                                    <p class="form-control" id="view_course"></p>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>


                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>

        $(document).on('submit','#saveStudent', function(e){
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_student", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData, 
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response); // Convert JSON string to JavaScript object

                    if(res.status == 422){

                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    } else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#addStudent').modal('hide');
                        $('#saveStudent')[0].reset();
                        alertify.success(res.message);
                        $('#dataTable').load(location.href + " #dataTable");
                    }
                    
                }
            });

        });

        $(document).on('click', '.viewStudentBtn', function(){
            var studentID = $(this).val();
            //alert(studentID);

            $.ajax({
                type: "GET",
                url: "code.php?studentID=" + studentID,
                success: function (response){

                    var res = jQuery.parseJSON(response);

                    if(res.status == 422){

                    alertify.success(res.message);

                    } else if(res.status == 200){

                    $('#view_name').text(res.data.name);
                    $('#view_email').text(res.data.email);
                    $('#view_phone').text(res.data.phone);
                    $('#view_course').text(res.data.course);

                    $('#studentViewModal').modal('show');

                    }

                }

            });
        });

        $(document).on('click', '.editStudentBtn', function(){
            var studentID = $(this).val();
            // alert(studentID);

            $.ajax({
                type: "GET",
                url: "code.php?studentID=" + studentID, 
                success: function (response){

                    var res = jQuery.parseJSON(response);

                    if(res.status == 422){

                    alertify.success(res.message);

                    } else if(res.status == 200){

                    $('#stuid').val(res.data.id);
                    $('#name').val(res.data.name);
                    $('#email').val(res.data.email);
                    $('#phone').val(res.data.phone);
                    $('#course').val(res.data.course);

                    $('#studentEditModal').modal('show');

                    }

                }

            });
        });

        $(document).on('submit', '#updateStudent', function(e) {
            e.preventDefault(); // Prevent default form submission

            var formData = new FormData(this);
            formData.append("update_student", true);

            console.log("Form data being sent:", formData); // Debugging line

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log("Server response:", response); // Debugging line
                    
                    var res = jQuery.parseJSON(response); // Convert JSON string to JavaScript object

                    if (res.status == 422) {
                        $('#EditErrorMessage').removeClass('d-none');
                        $('#EditErrorMessage').text(res.message);
                    } else if (res.status == 200) {
                        $('#EditErrorMessage').addClass('d-none');
                        $('#studentEditModal').modal('hide');
                        $('#updateStudent')[0].reset(); // Reset form
                        alertify.success(res.message);
                        $('#dataTable').load(location.href + " #dataTable"); // Refresh table
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", status, error); // Handle any AJAX errors
                    $('#EditErrorMessage').removeClass('d-none').text('An error occurred. Please try again.'); // Show a generic error
                }
            });
        });

        $(document).on('click','.deleteStudentBtn', function(e){
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?')){
                
                var studentID = $(this).val();

                $.ajax({
                    type: "POST", 
                    url: "code.php", 
                    data: {
                        'delete_student': true,
                        'studentID': studentID
                    }, 
                    success: function(response){

                        var res = jQuery.parseJSON(response);

                        if(res.status == 500){
                            alertify.success(res.message);
                        } else {
                            alertify.success(res.message);

                            $('#dataTable').load(location.href + " #dataTable"); // Refresh table
                            
                        }
                    }
                });
            }

        });

    </script>
    
  </body>
</html>
