<?php
if (!isset($_GET['table']) || empty($_GET['table'])) {
    exit();
}
$db = new PDO('sqlite:data.sqlite');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dish Dash!</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h1>Welcome! <a href="cart.php?table=<?php echo $_GET['table']; ?>">View my cart</a></h1>
<div id="columns">
    <?php
    $stmt = $db->query("SELECT id, name, picture, price FROM dishes");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <a href="cart.php?table=<?php echo $_GET['table']; ?>&id=<?php echo $row['id']; ?>">
            <figure>
                <img src="<?php echo $row['picture']; ?>">
                <figcaption><?php echo $row['name'] . " " . $row['price'];?></figcaption>
            </figure>
        </a>
    <?php
    }
    ?>
</div>
</body>
</html>
