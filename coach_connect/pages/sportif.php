<?php
session_start();
require_once "../classes/reservation.php";
$reservation_arr=Reservation::affichage_reservation($_SESSION['id_client']);






?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace - CoachSport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">

    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="index.html" class="flex items-center">
                        <i class="fas fa-dumbbell text-indigo-600 text-2xl mr-2"></i>
                        <span class="text-2xl font-bold text-indigo-600">CoachSport</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="sportif_sceances.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">
                        Coachs
                    </a>
                    <a href="#" class="text-indigo-600 px-3 py-2 rounded-md font-medium">
                        Mon Espace
                    </a>
                    <a href="../classes/logout.php" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition font-medium">
                        <i class="fas fa-sign-out-alt mr-1"></i> Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Welcome -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                Bienvenue, <span class="text-indigo-600"><?php echo $_SESSION['user_prenom']?></span> !
            </h1>
            <p class="text-gray-600">
                Gérez vos réservations et suivez votre progression sportive
            </p>
        </div>

        <!-- Stats -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                <p class="text-blue-100 text-sm">Séances à venir</p>
                <p class="text-3xl font-bold">3</p>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                <p class="text-green-100 text-sm">Séances validées</p>
                <p class="text-3xl font-bold">12</p>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                <p class="text-purple-100 text-sm">Total séances</p>
                <p class="text-3xl font-bold">15</p>
            </div>
        </div>

        <!-- Reservations -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                Mes Réservations
            </h2>

            <div class="space-y-4">

                <!-- Reservation card -->
                 <?php foreach($reservation_arr as $reservation):?>
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <?=$reservation['nom']." ".$reservation['prenom']?>
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">
                        <i class="fas fa-calendar text-indigo-600 mr-2"></i>
                         <?=$reservation['date']?>
                    </p>
                    <p class="text-sm text-gray-600 mt-1">
                        <i class="fas fa-clock text-indigo-600 mr-2"></i>
                         <?=$reservation['heure']?>
                    </p>
                    <span class="inline-block mt-3 px-3 py-1 bg-orange-200 text-orange-900 text-xs font-medium rounded-full">
                         <?=$reservation['statut']?>
                    </span>
                </div>
                <?php endforeach;?>

              
                

            </div>
        </div>
    </div>

</body>
</html>
