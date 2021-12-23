<?php
include 'db.php';

$id = $_GET['id'];
$amount = $_GET['amount'];

$sql = $pdo->prepare("SELECT * FROM pays WHERE id = ?");

$sql->execute(array($id));

while ($datas = $sql->fetch()){
    $oldAmount = $datas['total'];
}

$newQuantity = $oldAmount + $amount;

$update = $pdo->prepare("UPDATE pays SET total = ? WHERE id = ?" );

$update ->execute(array($newQuantity, $id));

$insert = $pdo->prepare("INSERT INTO payments SET date_of_insertion = NOW(), 
amount = ?, country_id = ?");

$insert->execute(array($amount, $id));

header("Location: index.php");
