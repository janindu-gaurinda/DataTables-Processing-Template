<?php
require_once('./conn.php');

$columns = array(
    0 => 'data_log_id',
    1 => 'Name',
    2 => 'Date',
    3 => 'Number',
    4 => 'Address',
    5 => 'Mobile',
    6 => 'NIC',
    7 => 'Time',
    8 => 'Ref Num',  // Ensure this matches the column name
    9 => 'Age',
    10 => 'Loc'
);

$totalData = mysqli_num_rows(mysqli_query($conn, "SELECT data_log_id FROM data_log"));

$searchValue = $_POST['search']['value'];
$sql = "SELECT * FROM data_log WHERE 1=1";
if (!empty($searchValue)) {
    $sql .= " AND (data_log_id LIKE '%" . $searchValue . "%' 
            OR Name LIKE '%" . $searchValue . "%' 
            OR Date LIKE '%" . $searchValue . "%' 
            OR Number LIKE '%" . $searchValue . "%' 
            OR Address LIKE '%" . $searchValue . "%' 
            OR Mobile LIKE '%" . $searchValue . "%' 
            OR NIC LIKE '%" . $searchValue . "%' 
            OR Time LIKE '%" . $searchValue . "%' 
            OR `Ref Num` LIKE '%" . $searchValue . "%' 
            OR Age LIKE '%" . $searchValue . "%' 
            OR Loc LIKE '%" . $searchValue . "%')";
}
$totalFiltered = mysqli_num_rows(mysqli_query($conn, $sql));

$columnIndex = $_POST['order'][0]['column'];
$columnName = $columns[$columnIndex];
$columnSortOrder = $_POST['order'][0]['dir'];
$sql .= " ORDER BY " . $columnName . " " . $columnSortOrder;

$start = $_POST['start'];
$length = $_POST['length'];
$sql .= " LIMIT " . $start . ", " . $length;

$result = mysqli_query($conn, $sql);
if (!$result) {
    die('SQL Error: ' . mysqli_error($conn));
}

$data = array();
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            $row['data_log_id'],
            $row['Name'],
            $row['Date'],
            $row['Number'],
            $row['Address'],
            $row['Mobile'],
            $row['NIC'],
            $row['Time'],
            $row['Ref Num'],  // Ensure this matches the column name
            $row['Age'],
            $row['Loc']
        );
    }
}

$response = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $totalData,
    "recordsFiltered" => $totalFiltered,
    "data" => $data
);

header('Content-Type: application/json');
echo json_encode($response);
?>
