<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    exit();
}
$ids = $_GET['id'];
$db = new PDO('sqlite:data.sqlite');

if (!is_array($ids)) {
    $ids = array($ids);
}

foreach ($ids as $id) {
    $stmt = $db->prepare("SELECT table_id FROM orders WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (isset($table) && $table != $row['table_id']) {
        echo "error";
        exit();
    }
    $table = $row['table_id'];
}

$stmt = $db->prepare("SELECT distance FROM tables WHERE id = :id");
$stmt->bindParam(":id", $table);
$stmt->execute();
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "success " . $row['distance'];
} else {
    echo "error";
    exit();
}

foreach ($ids as $id) {
    $stmt = $db->prepare("DELETE FROM orders WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
}
