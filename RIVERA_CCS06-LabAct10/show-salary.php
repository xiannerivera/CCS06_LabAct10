<?php
require "config.php";

use App\Employee;

if (isset($_GET['emp_no'])) {
    $emp_no = $_GET['emp_no'];
    $employees = Employee::getByEmpNo($emp_no);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salary History</title>
    <style>
        body {
            margin: 20px auto;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
        }

        .header {
            color: #0066cc;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #0066cc;
            color: white;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #c9daf8;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0066cc;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <button onclick="history.back()" class="btn btn-default">Return</button>
    <div class="container">
        <div class="row header">
            <h1>SALARY HISTORY</h1>
        </div>
        <?php if (isset($employees) && count($employees) > 0) { ?>
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>FROM DATE</th>
                        <th>TO DATE</th>
                        <th>SALARY</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee) { ?>
                        <tr>
                            <td><?php echo $employee->getHireDate(); ?></td>
                            <td><?php echo $employee->getEndDate(); ?></td>
                            <td><?php echo $employee->getSalary(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No employees found for department <?php echo $emp_no; ?></p>
        <?php } ?>
    </div>
</body>
</html>
