<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <style>
        .completed {
            text-decoration: line-through; /* Adds center line */
            color: gray; /* Optional: Makes it look faded */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Todo List</h1>
    <?php if(isset($_SESSION['message'])): ?>
        <p><?php echo $_SESSION['message']; ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    
    <form method="POST">
        <input type="text" name="task" placeholder="Enter a new task">
        <button type="submit" name="add_task">Add Task</button>
    </form>

    <?php while($task = $tasks->fetch_assoc()): ?>
        <div>
            <p class="<?php echo $task['is_completed'] ? 'completed' : ''; ?>">
                <?php echo $task['task']; ?>
            </p>

            <?php if(!$task['is_completed']): ?>
                <form method="POST" style="display:inline">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <button type="submit" name="complete_task">Complete</button>
                </form>
            <?php else: ?>
                <form method="POST" style="display:inline">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <button type="submit" name="undo_complete_task">Undo</button>
                </form>
            <?php endif; ?>
            <form method="POST" style="display:inline">
    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
    <button type="submit" name="delete_task">Delete</button>
</form>

        </div>
    <?php endwhile; ?>
</body>
</html>
