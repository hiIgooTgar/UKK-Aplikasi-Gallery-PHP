<?php

$conn = mysqli_connect("localhost", "root", "", "app_gallery");

if (!$conn) {
    die('Databse tidak ada yang terhubung ' . mysqli_connect_error($conn));
}
