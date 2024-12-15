<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/main.css" rel="stylesheet" type="text/css">
        <style>
            .content {
                width: 50%;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 25px 0 0;
            }

            nav {
                display: flex;
                gap: 20px;
            }
        </style>
    </head>
<?php
include_once "model/activites.php";
include_once "model/congressiste.php";
?>
<body>
    <div class="container">
    <div class="content">
    <h1>CONGRESSISTE</h1>
    <nav>
      <li><a href="./?action=activites">Activites</a></li>
      <li><a href="./?action=congressiste">Congressiste</a></li>
    </nav>
  </div>
    </div>
