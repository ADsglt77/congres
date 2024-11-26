<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page test</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            overflow: hidden;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('image/nature.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            filter: blur(8px);
            z-index: 0;
        }

        .content {
            position: relative;
            text-align: center;
            color: white;
            z-index: 1;
            font-family: 'Lobster', cursive;
            text-shadow: 2px 2px 4px black;
        }

        .content h1 {
            font-size: 4em;
            margin-top: 80px;
            animation: fondue 3s linear 1;
        }

        .content2-container {
            position: fixed;
            bottom: 60px;
            width: 100%;
            text-align: center;
            z-index: 1;
        }

        .content2 {
            color: white;
            font-family: 'Lobster', cursive;
            text-shadow: 4px 4px 8px black;
        }

        .content2 h1 {
            font-size: 4em;
            margin: 40px 0;
        }

        .content2 h2 {
            font-size: 4em;
            
            display: inline; /* Affiche sur la même ligne */
            animation: multi 3s linear infinite;
        }

        @keyframes multi {
            0% {
                color: white;
                transform: rotate(0deg);
            }
            12.5% {
                color: blue;
                transform: rotate(45deg);
            }
            25% {
                color: red;
                transform: rotate(90deg);
            }
            37.5% {
                color: green;
                transform: rotate(135deg);
            }
            50% {
                color: violet;
                transform: rotate(180deg);
            }
            62.5% {
                color: orange;
                transform: rotate(225deg);
            }
            75% {
                color: yellow;
                transform: rotate(270deg);
            }
            87.5% {
                color: pink;
                transform: rotate(315deg);
            }
            100% {
                color: white;
                transform: rotate(360deg);
            }
        }

        @keyframes fondue {
            0% {
                opacity: 0.4;
                margin-top: -200px;
            }
            75% {
                opacity: 0.7;
                margin-top: 87px;
            }
            100% {
                opacity: 1;
                margin-top: 80px;
            }
        }

        .image-dance {
            position: absolute;
            top: 30%;
            left: 3%;
            z-index: 1;
            border-left: 5px solid white;
            transition: transform 0.3s ease-in-out;
            text-shadow: 10px 10px 5px black;
        }

        .image-dance img {
            width: 500px; /* Taille de l'image */
            height: auto;
            border: 5px solid white;
            display: block;
        }

        .image-dance:hover {
            transform: scale(1.2); /* Agrandit l'image de 20% */
            cursor: pointer;
        }

        .image-acro {
            position: absolute;
            top: 30%;
            left: 72%;
            z-index: 1;
            border-left: 5px solid white;
            transition: transform 0.3s ease-in-out;
            text-shadow: 10px 10px 5px black;
        }

        .image-acro img {
            width: 500px; /* Taille de l'image */
            height: auto;
            border: 5px solid white;
            display: block;
        }

        .image-acro:hover {
            transform: scale(1.2); /* Agrandit l'image de 20% */
            cursor: pointer;
        }

        .image-vélo {
            position: absolute;
            top: 30%;
            left: 37%;
            z-index: 1;
            border-left: 5px solid white;
            transition: transform 0.3s ease-in-out;
            text-shadow: 10px 10px 5px black;
        }

        .image-vélo img {
            width: 500px; /* Taille de l'image */
            height: auto;
            border: 5px solid white;
            display: block;
        }

        .image-vélo:hover {
            transform: scale(1.2); /* Agrandit l'image de 20% */
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Image de fond -->
    <div class="background-image"></div>

    <!-- Titre principal -->
    <div class="content">
        <h1>Bienvenue à l'inscription aux activités</h1>
    </div>

    <!-- Images avec hover -->
    <div class="image-container">
        <div class="image-dance">
            <a href="https://www.google.com">
                <img src="image/dance.jpg" alt="Image de danse">
            </a>
        </div>
        <div class="image-vélo">
            <a href="https://www.google.com">
                <img src="image/vélo.jpg" alt="Image de vélo">
            </a>
        </div>
        <div class="image-acro">
            <a href="https://www.google.com">
                <img src="image/acrobranche.jpg" alt="Image d'acrobranche">
            </a>
        </div>
    </div>

    <!-- Texte dynamique -->
    <div class="content2-container">
        <div class="content2">
            <h1>C'est gratuit et <h2>FUN!!!</h2></h1>
        </div>
    </div>
</body>

</html>