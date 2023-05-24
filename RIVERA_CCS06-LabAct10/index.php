<?php
require "config.php";
use App\Employee;

$employee = Employee::list();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List of Managers</title>
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

        a {
            color: #0066cc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row header">
            <h1>LIST OF MANAGERS</h1>
        </div>

        <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <th>DEPARTMENT NUMBER</th>
                    <th>DEPARTMENT NAME</th>
                    <th>MANAGER NAME</th>
                    <th>HIRE DATE</th>
                    <th>END DATE</th>
                    <th>TOTAL YEARS</th>
                    <th>EMPLOYEES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($employee as $employee): ?>
                    <tr>
                        <td><?php echo $employee->getDeptNo();?></td>
                        <td><?php echo $employee->getDeptName();?></td>
                        <td><?php echo $employee->getFullName();?></td>
                        <td><?php echo $employee->getHireDate();?></td>
                        <td>Current</td>
                        <td><?php echo $employee->getTotalYear();?></td>
                        <td>
                            <a href="show-employee.php?dept_no=<?php echo $employee->getDeptNo();?>">VIEW</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>
</html>
