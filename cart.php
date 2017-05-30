<?php
if (!isset($_GET['table']) || empty($_GET['table'])) {
    exit();
}
$db = new PDO('sqlite:data.sqlite');
?>

<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $stmt = $db->prepare("INSERT INTO orders (table_id, dish_id) VALUES (:table_id, :dish_id)");
    $stmt->bindParam(":table_id", $_GET['table']);
    $stmt->bindParam(":dish_id", $_GET['id']);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dish Dash!</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h1>My cart <a href="menu.php?table=<?php echo $_GET['table']; ?>">Back to menu</a></h1>
<div id="columns">
    <?php
    $stmt = $db->prepare("SELECT dish_id FROM orders WHERE table_id = :table_id");
    $stmt->bindParam(":table_id", $_GET['table']);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $stmt2 = $db->prepare("SELECT name, picture FROM dishes WHERE id = :id");
        $stmt2->bindParam(":id", $row['dish_id']);
        $stmt2->execute();
        $row = $stmt2->fetch(PDO::FETCH_ASSOC);
        ?>
        <figure>
            <img src="<?php echo $row['picture']; ?>">
            <figcaption><?php echo $row['name'];?></figcaption>
        </figure>
        <?php
    }
    ?>
</div>
</body>
</html>
