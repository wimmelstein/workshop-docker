<?php

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Cache-control" content="no-cache"/>

        <title>Users</title>
    </head>

<body style="padding: 100px">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Users</h1>
            <p>Which users do we have?</p>
        </div>
    </div>

<?php

$db = [
    'host' => $_ENV['PHP_DB_HOST'],
    'port' => $_ENV['PHP_DB_PORT'],
    'database' => $_ENV['MYSQL_DATABASE'],
    'user' => $_ENV['MYSQL_USER'],
    'password' => $_ENV['MYSQL_PASSWORD']
];

$dsn = "mysql:host=" . $db['host']
    . ";port=" . $db['port']
    . ";dbname=" . $db['database']
    . ";charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $db['user'], $db['password']);
    $stmt = $pdo->query("select * from users");
    $result = $stmt->fetchAll();


    if (!sizeof($result) == 0) {

        ?>
        <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">id</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">age</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($result as $user) {

            ?>
            <tr>
                <td>
                    <?php echo $user['id']; ?>
                </td>
                <td>
                    <?php echo $user['first_name']; ?>
                </td>
                <td>
                    <?php echo $user['last_name']; ?>
                </td>
                <td>
                    <?php echo $user['age']; ?>
                </td>
            </tr>
            <?php
        }
    }
    ?>

    </tbody>
    </table>
    <?php
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());
}

