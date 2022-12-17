<!DOCTYPE html>
<html>
    <head>
        <title>LearnVern</title>
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
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function(){
                loadTable();
            });
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
                        // console.log(dataResult);
                        var resultData = dataResult.Data;
                        // console.log(resultData);
                        // show data now
                        var bodyData = '';
                        var i = 1;
                        if (resultData != null) {
                            // loop for show one by one
                            $.each(resultData, function(index,row){
                                console.log(row);
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
                                </tr>`;
                                // data place in table
                                $("#tbl").append(bodyData);
                            })
                        }else{
                            bodyData = "<tr><td colspan='8' style='text-align:center'>No Data Found</td></tr>";
                            $("#tbl").append(bodyData);
                        }
                    }
                })
            }
        </script>
    </body>
</html>