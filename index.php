<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/styles.css">
    <title>TO-DO List</title>
</head>

<body>
    <p id="Titlu">TO-DO</p>
        
    <form method="get" class="add-task" action="add_task.php">
    <label for="name">Task Name</label>
    <input type="text" id="name" name="name" required>
    <br>        
    <label for="deadline">Deadline</label>
    <input type="datetime-local" id="deadline" name="deadline" required>
    <br>
    <input type="submit">

    </form>

    <div id="tasks">

        <?php
            include "db.php";
            $tasks = select_all();
        ?>
        <ul>
            <?php while($row = $tasks->fetch_assoc()) { ?>
                <li>
                    <?php echo $row['Name'] . ", Until " . $row['Deadline'] ?> 
                    <a class="delete" href="delete_task.php?id=<?php echo $row['ID'];?>">[Complete]</a> 
                    <span class="created_at"> Created At: <?php echo $row['CreatedAt']?></span>
                </li>
            <?php } ?> 
        </ul>
        
    </div>
    <script src="Frontend/app.js"></script>
</body>
</html>


