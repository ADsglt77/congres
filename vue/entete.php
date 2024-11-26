<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/css.css" rel="stylesheet" type="text/css">
        <title></title>
    </head>

<body>
<div class="background-image"></div>
<div class="sidebar">
<a href="./?action=activites">ACTIVITES
<p>Découvrez nos différentes activités et apprenez comment les gérer efficacement et inscrivé vous au différentes activités.</p></a>
<a href="./?action=congressiste">CONGRESSISTE
<p>Informez-vous sur les congressistes et si il sont inscrit au différents évements. Vous pouvez aussi gérer les congressiste depuis cette page.</p></a>
</div>

<style>
    .background-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('../image/18032.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        z-index: 0;
    }
    p {
        color: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        display: block;
        text-decoration: none;
        font-size: 17px; /* Increased text size */
        opacity: 0%;

    }

    a {
        color: white;
        text-decoration: none;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        display: block;
        margin-bottom: 100px; /* Add margin between links */
        font-size: 20px; /* Increased text size */

    }
    a:hover {
        color: #98d4fc;
    }
    .sidebar {
        height: 100%;
        width: 260px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: -180px; /* Initially off-screen */
        background-color: #1f1f1f;
        overflow-x: hidden;
        padding-top: 20px;
        transition: left 0.3s; /* Smooth transition */
    }

    .sidebar:hover {
        left: 0; /* Slide in on hover */
       p opacity: 100%;
    }

    .sidebar:hover p {
        
        opacity: 100%;
    }
</style>
</body>
</html>