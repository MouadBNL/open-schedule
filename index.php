<?php
    require_once 'functions.php';
    $tasks = [];
    if (isset($_COOKIE['user_tasks']) and !empty($_COOKIE['user_tasks'])) {
        $tasks = unserialize($_COOKIE['user_tasks']);
    }
    if (!empty(post_task())) {
        $tasks[] = post_task();
        setcookie('user_tasks', serialize($tasks), time() + 30*24*60*60, '/');
    }
    if (isset($_POST['name']) and !empty($_POST['name'])) {
        setcookie('user_name', htmlentities($_POST['name']), time() + 24*60*60, '/');
        $_COOKIE['user_name'] = htmlentities($_POST['name']);   
    }
    $isset_user = (isset($_COOKIE['user_name']) and !empty($_COOKIE['user_name'])) ? true : false;
    $intro = $isset_user ? $_COOKIE['user_name'] : 'please introduce yourself :';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Open schedule</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <header class="mb-5">
        <nav class="navbar navbar-dark bg-dark">
            <a href="/" class="navbar-brand mb-0 h1">Open-schedule</a>
        </nav>
    </header>
    <div class="container">
        <h1>Welcome, <?= $intro ?></h1>
        <?php if (!$isset_user) : ?>
        <form action="" method="POST" class="mt-3 mb-3">
            <div class="from-group">
            <label for="exampleInputEmail1">Enter your name :</label>
            <input name="name" type="text" class="form-control" id="name" aria-describedby="name">
            <small id="name" class="form-text text-muted">this name will be added to a cookie.</small>
            </div>
            <input type="submit" class="btn btn-success">
        </form>
        <?php endif; ?> 
        <section class="mt-5 mb-5">
            <h2>TODO list</h2>
            <form action="" method="POST">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Task name</th>
                            <th scope="col">Task desc</th>
                            <th scope="col">Start</th>
                            <th scope="col">End</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $id => $task) {
                            echo '<tr>';
                            echo "<th scope=\"col\">" . $id . "</th>";
                            echo "<td>" . $task['name'] . "</td>";
                            echo "<td>" . $task['desc'] . "</td>";
                            echo "<td>" . $task['start'] . "</td>";
                            echo "<td>" . $task['end'] . "</td>";
                            echo '</tr>';
                        } ?>
                        <tr>
                            <th scope="col"><label for="id">#</label></th>
                            <th scope="col"><input class="form-control" name="task_name" type="text" placeholder="task name"></th>
                            <th scope="col"><input class="form-control" name="task_desc" type="text" placeholder="task desk"></th>
                            <th scope="col"><input class="form-control" name="task_start" type="text" placeholder="start time"></th>
                            <th scope="col"><input class="form-control" name="task_end" type="text" placeholder="end time"></th>
                        </tr>
                    </tbody>
                </table>
                <input type="submit" class="btn btn-success">
            </form>
        </section>
    </div>
    <footer>
        <p>You have seen this page <?= $_COOKIE['simple_cookie'] ?> times.</p>
    </footer>
    <!-- Bootstrap scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
