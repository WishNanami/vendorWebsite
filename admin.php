<?php
session_start();
include "database.php";

// Protect admin page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Get all tables
$tables = [];
$tablesResult = mysqli_query($conn, "SHOW TABLES");
while ($row = mysqli_fetch_array($tablesResult)) {
    $tables[] = $row[0];
}

// Get search inputs
$selectedTables = $_GET['tables'] ?? [];
$keyword = $_GET['keyword'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        .top-right {
    position: absolute;
    top: 20px;
    right: 20px;
}

        .add-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .add-btn:hover {
            background-color: #0056b3;
        }
        table {
            border-collapse: collapse;
            margin-bottom: 40px;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        .search-box {
            background: #f5f5f5;
            padding: 15px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<h1>Admin Panel</h1>
<div class="top-right">
    <a href="create_vendor_account.php" class="add-btn">+ Add Account</a>
</div>
<p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
<a href="logout.php">Logout</a>

<hr>

<!-- 🔍 SEARCH AREA -->
<div class="search-box">
    <form method="get">
        <label><b>Select Tables (Topics):</b></label><br>
        <select name="tables[]" multiple size="5">
            <?php foreach ($tables as $table): ?>
                <option value="<?php echo $table; ?>"
                    <?php echo in_array($table, $selectedTables) ? 'selected' : ''; ?>>
                    <?php echo $table; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <br><br>

        <label><b>Keyword Search:</b></label><br>
        <input type="text" name="keyword"
               value="<?php echo htmlspecialchars($keyword); ?>"
               placeholder="Type keyword (e.g. bu)">

        <br><br>
        <button type="submit">Search</button>
        <a href="admin.php">Reset</a>
    </form>
</div>

<?php
// Decide which tables to search
$tablesToShow = empty($selectedTables) ? $tables : $selectedTables;

$foundAny = false;

// Loop through tables
foreach ($tablesToShow as $tableName) {

    // Get columns
    $columnsResult = mysqli_query($conn, "SHOW COLUMNS FROM `$tableName`");
    if (!$columnsResult) continue;

    $columns = [];
    while ($col = mysqli_fetch_assoc($columnsResult)) {
        $columns[] = $col['Field'];
    }

    // Build WHERE clause for partial search
    if ($keyword !== '') {
        $conditions = [];
        foreach ($columns as $col) {
            $conditions[] = "`$col` LIKE '%" . mysqli_real_escape_string($conn, $keyword) . "%'";
        }
        $where = "WHERE " . implode(" OR ", $conditions);
    } else {
        $where = "";
    }

    // Query table
    $query = "SELECT * FROM `$tableName` $where";
    $dataResult = mysqli_query($conn, $query);

    if (!$dataResult) continue;

    // 🚫 Skip tables with NO matching rows
    if ($keyword !== '' && mysqli_num_rows($dataResult) == 0) {
        continue;
    }

    // At least one result exists
    $foundAny = true;

    echo "<h2>Table: $tableName</h2>";
    echo "<table><tr>";

    foreach ($columns as $col) {
        echo "<th>$col</th>";
    }
    echo "</tr>";

    while ($row = mysqli_fetch_assoc($dataResult)) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}

// Show message if nothing found
if ($keyword !== '' && !$foundAny) {
    echo "<p><b>No results found for \"$keyword\".</b></p>";
}
?>

</body>
</html>
