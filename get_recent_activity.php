<?php
include 'connection.php';

header('Content-Type: application/json');

// Query to get the four most recent activity logs
$sql = "SELECT summary, date FROM logs ORDER BY date DESC LIMIT 4";
$result = mysqli_query($mysqli, $sql);

$logs = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $logs[] = [
            'summary' => $row['summary'],
            'date' => $row['date']
        ];
    }
} else {
    $logs[] = [
        'summary' => 'No recent activity.',
        'date' => ''
    ];
}

echo json_encode($logs);

mysqli_close($mysqli);
?>
