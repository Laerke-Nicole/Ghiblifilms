<?php
require_once ("crud/crudOOP.php");
require_once ("includes/dbcon.php");
require_once("includes/session.php"); 
require_once("includes/functions.php");
//confirm_logged_in(); 

$crud = new CRUD($dbCon);

// Fetch the selected table from the URL
$table = $_GET['table'] ?? null;
$action = $_GET['action'] ?? null;

// Handle actions dynamically
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'add') {
        $data = $_POST;
        if ($crud->create($table, $data)) {
            header("Location: test.php?table=$table&status=added");
        } else {
            header("Location: test.php?table=$table&status=error");
        }
    } elseif ($action === 'edit') {
        $id = $_POST['id'];
        unset($_POST['id']); // Remove ID from the data
        if ($crud->update($table, $_POST, ["ID" => $id])) {
            header("Location: test.php?table=$table&status=updated");
        } else {
            header("Location: test.php?table=$table&status=error");
        }
    }
} elseif ($action === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($crud->delete($table, ["ID" => $id])) {
        header("Location: test.php?table=$table&status=deleted");
    } else {
        header("Location: test.php?table=$table&status=error");
    }
}

// Fetch all data for the selected table
$tableData = $table ? $crud->read($table) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>test Panel</title>
</head>
<body>
<h1>test Panel</h1>
<?php if ($table): ?>
    <h2>Manage <?php echo htmlspecialchars($table); ?></h2>
    <table>
        <thead>
            <tr>
                <?php if ($tableData): foreach (array_keys($tableData[0]) as $col): ?>
                    <th><?php echo htmlspecialchars($col); ?></th>
                <?php endforeach; endif; ?>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tableData as $row): ?>
                <tr>
                    <?php foreach ($row as $value): ?>
                        <td><?php echo htmlspecialchars($value); ?></td>
                    <?php endforeach; ?>
                    <td>
                        <a href="test.php?table=<?php echo htmlspecialchars($table); ?>&action=edit&id=<?php echo htmlspecialchars($row['ID']); ?>">Edit</a>
                        <a href="test.php?table=<?php echo htmlspecialchars($table); ?>&action=delete&id=<?php echo htmlspecialchars($row['ID']); ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h3>Add New</h3>
    <form method="POST" action="test.php?table=<?php echo htmlspecialchars($table); ?>&action=add">
        <?php if ($tableData): foreach (array_keys($tableData[0]) as $col): if ($col === 'ID') continue; ?>
            <label><?php echo htmlspecialchars($col); ?></label>
            <input type="text" name="<?php echo htmlspecialchars($col); ?>">
        <?php endforeach; endif; ?>
        <button type="submit">Add</button>
    </form>
<?php else: ?>
    <h2>Select a Module</h2>
    <ul>
        <li><a href="index.php?page=test&table=VoiceActor">Manage Voice Actors</a></li>
        <li><a href="index.php?page=test&table=Movie">Manage Movies</a></li>
        <!-- Add more modules as needed -->
    </ul>
<?php endif; ?>
</body>
</html>