<?php

include 'config.php';
ob_start();

function connectDB()
{
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'mydb';
    $db = new mysqli($host, $username, $password, $dbname);

    if ($db->connect_error)
        die("Connection  Failed: " + $db->connect_error);
    return $db;
}

function close($db)
{
    $db->close();
}

function getShare()
{
    $sql = "SELECT * FROM hisse";
    $db = connectDB();
    $val = $db->query($sql);
    $pay = [];
    while ($row = $val->fetch_assoc()) {
        $pay[] = $row;
    }
    close($db);
    return $pay;
}

function getShareById($id)
{
    $sql = "SELECT * FROM hisse WHERE id=" . $id;
    $db = connectDB();
    $val = $db->query($sql);
    if ($val->fetch_assoc())
        return $val->fetch_assoc();
    close($db);
    return false;
}

function getShareByUpdateSingle()
{
    $sql = "SELECT * FROM hisse WHERE share NOT LIKE '%tarih\":\"" . date("Y-m-d", strtotime('today')) . "%' ";
    $db = connectDB();
    $val = $db->query($sql);
    $pay = [];
    while ($row = $val->fetch_assoc()) {
        $pay[] = $row;
    }
    close($db);
    return $pay[rand(0, count($pay) - 1)];
}

getShareByUpdateSingle();

function update($id, $json)
{
    $json = json_encode($json);
    $db = connectDB();
    $sql = "UPDATE hisse SET share='$json' WHERE id=" . $id;
    if (!$db->query($sql))
        echo "Error: " . $sql . "<br>" . $db->error;
    close($db);
}
function insert($json)
{
    $id = (int) $json->id;
    $hisse = json_encode($json->kod);
    $db = connectDB();

    if (!getShareById($id)) {
        $sql = "INSERT INTO hisse(id, share) VALUES (" . $id . ",'" . $hisse . "')";
        if ($db->query($sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }
    }
    close($db);
}
function query($sql)
{
    $db = connectDB();
    $data = $db->query($sql);
    return $data->fetch_assoc();
}
