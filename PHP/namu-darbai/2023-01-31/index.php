<?php 

    $tableHead = '<thead>
                    <tr>
                        <th class="table-dark"></th>';

    for($i = 1; $i <= 10; $i++) {
        $tableHead .= '<th class="table-dark">' . $i . '</th>';
    }

    $tableHead .= '</tr>
                </thead>';


    $tableBody = '<tbody>
                    <tr>';

    for($i = 1; $i <= 10; $i++) {
        $tableBody .= '<td class="table-dark fw-bold">' . $i . '</td>';
        for($x = 1; $x <= 10; $x++) {
            if($x === $i) {
                $tableBody .= '<td class="table-secondary">' . $x * $i . '</td>';
            } else {
            $tableBody .= '<td>' . $x * $i . '</td>';
            }
        }
        $tableBody .= '</tr>';
    }

    $tableBody .= '</tbody>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
    <style>
        table th, td {
            padding: 0;
            text-align: center;
            border-right: 1px solid black !important;
            border-bottom: 1px solid black !important;
        }

        .container {
            max-width: 600px;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <h1>10 x 10 MULTIPLICATION CHART</h1>
    <div class="container mx-auto">
        <table class="table table-sm">
            <?= $tableHead ?>
            <?= $tableBody ?>
        </table>
    </div>
</body>
</html>