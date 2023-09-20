<html>

<head>
    <title>display data</title>
</head>
<style>
    table {
        border-collapse: collapse;
        border: 2px solid black;
    }

    th,
    td {
        border: 1px solid black;
    }
</style>

<body>
    <table>
        <tr>
            <th>id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>phoneno</th>
            <th>password</th>
            <th>File Name</th>
            <th>edit</th>
            <th>delete</th>
        </tr>



        <?php

        include('dbconnect.php');
        $query = "select * from customer";
        $data = mysqli_query($conn, $query);
        $total = mysqli_num_rows($data);

        if ($total != 0) {
            while ($result = mysqli_fetch_assoc($data)) {
                echo "
                <tr>
                    <td>" . $result['id'] . "</td>
                    <td>" . $result['firstname'] . "</td>
                    <td>" . $result['lastname'] . "</td>
                    <td>" . $result['email'] . "</td>
                    <td>" . $result['phoneno'] . "</td>
                    <td>" . $result['password'] . "</td>
                    <td>" . $result['filename'] . "</td>
                    <td> 
                    <a href='index.php?id=" . $result['id'] . "'>update</a>
                    <td><a href='delete.php?id=" . $result['id'] . "'>delete</a> 
                    </td>
                </tr>
            ";
            }
            // echo "Record found: ".$total;
        } else {
            echo "Record not found";
        }
        ?>
</body>

</html>