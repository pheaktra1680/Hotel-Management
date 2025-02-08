<?php

$hname = 'localhost';
$uname = 'root';
$upass = '';
$db = 'db_hotel';

$con = mysqli_connect($hname, $uname, $upass, $db);

if (!$con) {
    die("Cannot connect to Database" . mysqli_connect_error());
}

function filteration($data)
{
    foreach ($data as $key => $value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        $value = strip_tags($value);
        $data[$key] = $value;
    }
    return $data;
}

function selectAll($table){
    $con = $GLOBALS['con'];
    $res = mysqli_query($con, "SELECT * FROM $table");
    return $res;
}

function select($sql, $values, $datatype)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatype, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt); // Close $stsm properly
            return $res;
        } else {
            mysqli_stmt_close($stmt); // Close $stsm properly
            die("Query cannot be executed - select");
        }
    } else {
        die("Query cannot be prepared - select");
    }
}
function update($sql, $values, $datatype)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatype, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt); // Close $stsm properly
            return $res;
        } else {
            mysqli_stmt_close($stmt); // Close $stsm properly
            die("Query cannot be executed - Update");
        }
    } else {
        die("Query cannot be prepared - Update");
    }
}

function insert($sql, $values, $datatype)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatype, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt); // Close $stsm properly
            return $res;
        } else {
            mysqli_stmt_close($stmt); // Close $stsm properly
            die("Query cannot be executed - Insert");
        }
    } else {
        die("Query cannot be prepared - Insert");
    }
}

function custom_delete($sql, $values, $datatype)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatype, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt); // Close $stsm properly
            return $res;
        } else {
            mysqli_stmt_close($stmt); // Close $stsm properly
            die("Query cannot be executed - Delete");
        }
    } else {
        die("Query cannot be prepared - Delete");
    }
}