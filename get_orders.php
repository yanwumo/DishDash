<?php
$db = new PDO('sqlite:data.sqlite');

$stmt = $db->prepare("SELECT id, table_id, dish_id FROM orders");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $stmt2 = $db->prepare("SELECT name FROM dishes WHERE id = :id");
    $stmt2->bindParam(":id", $row['dish_id']);
    $stmt2->execute();
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    printf("%d %s %d ", $row['id'], $row2['name'], $row['table_id']);
}
