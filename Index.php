<?php include("./conn.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Side Processing</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./DataTables/datatables.min.css">
    <!-- Include additional CSS files if any extensions are used -->

    <style>
        .textcenter {
            text-align: center !important;
        }
    </style>
</head>

<body>
    <!-- Content -->
    <div class="container m-5">
        <h1>Server Side Processing</h1>
        <br>
        <hr>
        <br>
        <div class="d-flex justify-content-center text-center">
            <table class="table border-primary table-hover" id="example">
                <thead>
                    <tr>
                        <th class="textcenter">Data Log Id</th>
                        <th class="textcenter">Name</th>
                        <th class="textcenter">Date</th>
                        <th class="textcenter">Number</th>
                        <th class="textcenter">Address</th>
                        <th class="textcenter">Mobile</th>
                        <th class="textcenter">NIC</th>
                        <th class="textcenter">Time</th>
                        <th class="textcenter">Ref Num</th>
                        <th class="textcenter">Age</th>
                        <th class="textcenter">Loc</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>

            </table>
        </div>
    </div>
    <!-- Content -->

    <!-- Include jQuery and then Bootstrap Bundle JS (includes Popper.js) -->
    <script src="./bootstrap/jquery-3.7.1.min.js"></script>
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./DataTables/datatables.min.js"></script>

    <!-- Initialize DataTables -->
      <!-- JavaScript code to initialize DataTables with server-side processing -->
    <script type="text/javascript">
       $('#example').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "./server_processing.php", // URL to the server-side script
        "type": "POST" // Use POST method to send data to the server
    },
    "order": [
        [0, 'desc'] // Assuming data_log_id is the first column (index 0)
    ],
    "pageLength": 10, // Change 10 to the desired number of rows per page
    "columns": [
        { "data": 0, "title": "Data Log Id" },
        { "data": 1, "title": "Name" },
        { "data": 2, "title": "Date" },
        { "data": 3, "title": "Number" },
        { "data": 4, "title": "Address" },
        { "data": 5, "title": "Mobile", "className": "text-right" }, // Align to left
        { "data": 6, "title": "NIC" },
        { "data": 7, "title": "Time" },
        { "data": 8, "title": "Ref Num" },
        { "data": 9, "title": "Age" },
        { "data": 10, "title": "Loc" }
    ],
    "drawCallback": function(settings) {
        // Reinitialize tooltips after DataTable redraw
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});

    </script>
</body>

</html>