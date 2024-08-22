<?php
$servername = "localhost";
$username = "test123";
$password = "test123";
$dbname = "aiotdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from sensors table
$sql = "SELECT temp, humi FROM sensors ORDER BY date ASC";
$result = $conn->query($sql);

$temps = [];
$humis = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $temps[] = (int)$row['temp'];
        $humis[] = (int)$row['humi'];
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Sensor Data Chart</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
<div id="container" style="width: 100%; height: 400px; margin: 0 auto"></div>
<script language="JavaScript">
$(document).ready(function() {
    var title = {
        text: 'Sensor Data Over Time'   
    };
    var subtitle = {
        text: 'Source: aiotdb'
    };
    var xAxis = {
        title: {
            text: 'Index'
        },
        categories: Array.from({length: <?php echo count($temps); ?>}, (_, i) => i + 1)
    };
    var yAxis = {
        title: {
            text: 'Value'
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    };   

    var tooltip = {
        valueSuffix: ''
    }

    var legend = {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle',
        borderWidth: 0
    };

    var series =  [
        {
            name: 'Temperature (°C)',
            data: <?php echo json_encode($temps, JSON_NUMERIC_CHECK); ?>
        }, 
        {
            name: 'Humidity (%)',
            data: <?php echo json_encode($humis, JSON_NUMERIC_CHECK); ?>
        }
    ];

    var json = {};

    json.title = title;
    json.subtitle = subtitle;
    json.xAxis = xAxis;
    json.yAxis = yAxis;
    json.tooltip = tooltip;
    json.legend = legend;
    json.series = series;

    $('#container').highcharts(json);
});
</script>
</body>
</html>
