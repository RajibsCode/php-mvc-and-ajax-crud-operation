<!DOCTYPE html>
<html>
    <head>
        <title> ajax crud </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style type="text/css">
            .card {
                margin: 1%;
                float: none;
                margin-bottom: 10px;
                margin-top: 20px;
            }
            p {
                display: inline;
            }
            #tbl{
                margin-top: 1%;
            }
        </style>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">LearnVern</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>

        <div class="card">
            <h5 class="card-header">Employee List</h5>
            <div class="card-body">

                <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#exampleModalCenter" >Add Record</button>
                <div id="myAlert"  role="alert" class="alert alert-dismissible fade"  style="display:none;">
                    <strong>Note!</strong><p>Example of AJAX LearnVern.</p>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
                <table class="table table-bordered table-sm"  id="tbl">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Employee Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Department</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Joining Date</th>
                            <th scope="col">Gender</th>
                            <th scope="col" colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_body">

                    </tbody>
                </table>
            </div>

        </div>
        <!-- Insert Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add New Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" id="insert_data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label><b>Employee Id</b></label>
                                <input type="text" name="emp_id" class="form-control" placeholder="Employee Id">
                            </div>
                            <div class="form-group">
                                <label><b>Name</b></label>
                                <input type="text" name="name" class="form-control" placeholder="Meet Shah">
                            </div>
                            <div class="form-group">
                                <label><b>Email</b></label>
                                <input type="text" name="email" class="form-control" placeholder="learnvern@email.com">
                            </div>
                            <div class="form-group">
                                <label><b>Department</b></label>
                                <select class="custom-select" name="department" id="department">
                                    <option value="" selected>Choose...</option>
                                    <option value="IT">IT</option>
                                    <option value="HR">HR</option>
                                    <option value="R&D">R&D</option>
                                    <option value="Sales">Sales</option>
                                    <option value="Quality">Quality</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Financial">Financial</option>
                                    <option value="Operations">Operations</option>
                                    <option value="Administration">Administration</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><b>Designation</b></label>
                                <input type="text" name="designation" class="form-control" placeholder="Software Engineer">
                            </div>
                            <div class="form-group">
                                <label><b>Joining Date</b></label>
                                <input type="date" name="joining_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="mr-3"><b>Gender :- </b></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="1" checked>
                                    <label class="form-check-label" >Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="0">
                                    <label class="form-check-label" >Female</label>
                                </div>
                            </div>  
                            <div class="form-group">
                                <span class="success-msg" id="success_msg"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="close_click" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Add Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Insert Modal -->
        <!-- Update Modal -->
        <div class="modal fade" id="updateModalCenter" tabindex="-1" role="dialog" aria-labelledby="updateModalCenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalCenterTitle">Update Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" id="update_data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label><b>Employee Id</b></label>
                                <input type="hidden" name="id" id="id" class="form-control">
                                <input type="text" name="emp_id" id="emp_id" class="form-control" placeholder="Employee Id">
                            </div>
                            <div class="form-group">
                                <label><b>Name</b></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Meet Shah">
                            </div>
                            <div class="form-group">
                                <label><b>Email</b></label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="learnvern@email.com">
                            </div>
                            <div class="form-group">
                                <label><b>Department</b></label>
                                <select class="custom-select" name="department" id="department">
                                    <option value="" selected>Choose...</option>
                                    <option value="IT">IT</option>
                                    <option value="HR">HR</option>
                                    <option value="R&D">R&D</option>
                                    <option value="Sales">Sales</option>
                                    <option value="Quality">Quality</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Financial">Financial</option>
                                    <option value="Operations">Operations</option>
                                    <option value="Administration">Administration</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><b>Designation</b></label>
                                <input type="text" name="designation" id="designation" class="form-control" placeholder="Software Engineer">
                            </div>
                            <div class="form-group">
                                <label><b>Joining Date</b></label>
                                <input type="date" name="joining_date" id="joining_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="mr-3"><b>Gender :- </b></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="1" checked>
                                    <label class="form-check-label" >Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="0">
                                    <label class="form-check-label" >Female</label>
                                </div>
                            </div>  
                            <div class="form-group">
                                <span class="success-msg" id="success_msg"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="close_click" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Update Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Update Modal -->
        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModalCenter" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalCenterTitle">Delete Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <p>Are You Sure?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="close_click" data-dismiss="modal">Close</button>
                            <button id="deleterecord" type="button" class="btn btn-danger" >Delete</button>
                        </div>
                </div>
            </div>
        </div>
        <!-- End Delete Modal -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function(){
                // 3 call the function in jquery
                loadTable();
                // 9 for submit form data
                $('#insert_data').on("submit", function(e){
                    // page reload off ofter close modal
                    e.preventDefault();
                    // now write ajax
                    $.ajax({
                        type : 'POST',
                        url : 'insertEmpData',
                        cache : false,
                        dataType : 'json',
                        // data collect from this form input
                        data : $(this).serialize(),
                        // if ajax done .done({})
                    }).done( function(dataResult) {
                        //console.log(dataResult);
                    // 11 display the alert in ternary operator
                        (dataResult.Code == 1)?
                        showAlert('Success! ',dataResult.Message, 'success') :
                        showAlert('Something went Wrong! ',dataResult.Message, 'danger')
                        // if fail .fail({})
                    }).fail( function(dataResult) {
                        //console.log(dataResult);
                    // 12 fail alert and then work in loadTable() function
                        showAlert('Something went Wrong! ','please try again later', 'danger');
                        // default .always({})
                    }).always( function() {
                        loadTable(); // Load table when submited data
                        $('#insert_data').trigger('reset'); // clear form
                        $('#close_click').trigger('click'); // auto click close button

                    })
                })
                // 14 after making update modal and then make API
                // edit start - click and open modal
                $(document).on("click", "button.editdata", function(){

                    var check_id = $(this).data('dataid');//get id from btn
                    //console.log(check_id);
                    
                    // 16 ajax code for update (other system of write ajax)
                    $.getJSON("editEmpData", {check_id: check_id}, function(json){
                        // console.log(json);

                        $("#updateModalCenter").modal('show');//show modal

                        var jsonData = json.Data[0];
                        //console.log(jsonData);
                        // 17 value show in update form inputs
                        if (json.Code == 1) {
                            $('#id').val(jsonData.id);
                            $('#emp_id').val(jsonData.emp_id);
                            $('#name').val(jsonData.name);
                            $('#email').val(jsonData.email);
                            $('#designation').val(jsonData.designation);
                            $('#joining_date').val(jsonData.joining_date);
                            // for select option
                            $('#department option[value="'+ jsonData.department +'"]').prop("selected","selected");
                            if (jsonData.gender == 1) {
                                // apply attribute by id
                                $('#male').prop("checked",true);
                            }else{
                                $('#female').prop("checked",true);
                            }
                        }
                        // 18 if fail then alert
                    }).fail(function(){
                        loadTable();
                        showAlert('Something went Wrong! ','please try again later', 'danger');
                    })
                })
                

                // 19 data update code
                $('#update_data').on("submit", function(e){
                    // page reload off ofter close modal
                    e.preventDefault();
                    // now write ajax
                    $.ajax({
                        type : 'POST',
                        url : 'updateEmpData',
                        cache : false,
                        dataType : 'json',
                        // data collect from this form input
                        data : $(this).serialize(),
                        // if ajax done .done({})
                    }).done( function(dataResult) {
                        //console.log(dataResult);
                    // display the alert in ternary operator
                        (dataResult == true)?
                        showAlert('Success! ','Data updated successfully', 'success') :
                        showAlert('Something went Wrong! ','please try again', 'danger')
                        // if fail .fail({})
                    }).fail( function(dataResult) {
                        //console.log(dataResult);
                    // fail alert and then work in loadTable() function
                        showAlert('Something went Wrong! ','please try again later', 'danger');
                        // default .always({})
                    }).always( function() {
                        // 20 hide modal and then make update API
                        $("#updateModalCenter").modal('hide');

                        loadTable(); // Load table when submited data
                        //$('#insert_data').trigger('reset'); // clear form
                        //$('#close_click').trigger('click'); // auto click close button

                    })
                })

                // 22 Delete code start and then make API
                // if click delete btn
                $(document).on("click","button.deletedata", function(){
                    $("#deleteModalCenter").modal('show');
                    deleteid = $(this).data('dataid');
                    //console.log(deleteid);
                })
                // 24 now delete by delete button
                $('#deleterecord').click(function(){
                    // now write ajax
                    $.ajax({
                        type : 'POST',
                        url : 'deleteEmpData',
                        cache : false,
                        dataType : 'json',
                        // data collect from this form input
                        data : {delete_id: deleteid},
                        // if ajax done .done({})
                    }).done( function(dataResult) {
                        //console.log(dataResult);
                    // display the alert in ternary operator
                        (dataResult == true)?
                        showAlert('Success! ','Employee Data Deleted successfully', 'success') :
                        showAlert('Something went Wrong! ','please try again', 'danger')
                        // if fail .fail({})
                    }).fail( function(dataResult) {
                        //console.log(dataResult);
                    // fail alert and then work in loadTable() function
                        showAlert('Something went Wrong! ','please try again later', 'danger');
                        // default .always({})
                    }).always( function() {
                        // 20 hide modal and then make update API
                        $("#deleteModalCenter").modal('hide');

                        loadTable(); // Load table when submited data
                        //$('#insert_data').trigger('reset'); // clear form
                        //$('#close_click').trigger('click'); // auto click close button

                    })
                })


            });
            // 10 dynamic alert crete
            function showAlert(msg_title, msg_body, msg_type){
                var alert = $('div[role="alert"]'); //select alert wala div
                $(alert).find('strong').html(msg_title); //find tag & set 
                $(alert).find('p').html(msg_body); //find tag & set para
                $(alert).removeAttr('class') //remove class attribute
                $(alert).addClass('alert alert-'+ msg_type) //remove class attribute
                $(alert).show(); //show the alert now
                $(alert).css('display', 'inline-block'); //add some css
                $(alert).css('margin-left', '2%'); //add some css

            }

            // 2 make function - ajax for table data show
            function loadTable() {
                // ajax for access data into table
                $.ajax({
                    url : "getEmpData",
                    type : "GET",
                    data : {

                    },
                    cache : false,
                    dataType : 'json',
                    // if success then get data
                    success : function(dataResult){
                ////// 13 refress table after per data submit in table
                    $('#tbl_body').empty();
                        // console.log(dataResult);
                        var resultData = dataResult.Data;
                        // console.log(resultData);
                        // show data now
                        var bodyData = '';
                        var i = 1;
                        if (resultData != null) {
                            // loop for show one by one
                            $.each(resultData, function(index,row){
                                //console.log(row);
                                // show data - (use `` backquote for es6)
                                var bodyData = `<tr>
                                    <td> ${ i++ } </td>
                                    <td> ${ row.emp_id } </td>
                                    <td> ${ row.name } </td>
                                    <td> ${ row.email } </td>
                                    <td> ${ row.department } </td>
                                    <td> ${ row.designation } </td>
                                    <td> ${ row.joining_date } </td>
                                    <td> ${ (row.gender == 1) ? 'Male' : 'Female' } </td>
                                    <td>
                                        <button type="button" class="btn btn-info editdata" data-dataid="${ row.id }">Update</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger deletedata" data-dataid="${ row.id }">Delete</button>
                                    </td>
                                </tr>`;
                                // data place in table
                                $("#tbl").append(bodyData);
                            })
                        }else{
                            var bodyData = "<tr><td colspan='8' style='text-align:center'>No Data Found</td></tr>";
                            $("#tbl").append(bodyData);
                        }
                    }
                })
            }
        </script>
    </body>
</html>