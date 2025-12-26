<?php


require_once "../classes/sceance.php";
require_once "../classes/reservation.php";

if($_SERVER['REQUEST_METHOD']=='POST'){

    $date=$_POST['date'];
    $heure=$_POST['heure'];
    $duree=$_POST["duree"];
    $statut="disponible";
    $id_coach=$_POST['id_coach'];

    Sceance::insert_sceance($date,$heure,$duree,$statut,$id_coach);


}

$arr_reser_coach=Reservation::affichage_res_coach($_SESSION['id_coach']);




?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Coach - CoachSport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">

    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="#" class="flex items-center">
                        <i class="fas fa-dumbbell text-indigo-600 text-2xl mr-2"></i>
                        <span class="text-2xl font-bold text-indigo-600">CoachSport</span>
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="#" class="text-indigo-600 px-3 py-2 rounded-md font-medium">Dashboard</a>
                    <!-- <a href="profile_coach.html" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">
                        <i class="fas fa-user mr-1"></i> Profil
                    </a> -->

                    <a href="sceances_cree.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Sceances creé</a>
                    <a href="sceances_cree.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">
                        
                    </a>

                    <a href="../classes/logout.php" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition font-medium">
                        <i class="fas fa-sign-out-alt mr-1"></i> Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                Dashboard Coach - <span class="text-indigo-600"><?php echo $_SESSION['user_prenom']?></span>
            </h1>
            <p class="text-gray-600">
                Gérez vos réservations, disponibilités et profil professionnel
            </p>
        </div>

        <!-- Stats -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 text-white">
                <p class="text-orange-100 text-sm">En attente</p>
                <p class="text-3xl font-bold">5</p>
            </div>
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                <p class="text-blue-100 text-sm">Aujourd'hui</p>
                <p class="text-3xl font-bold">2</p>
            </div>
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                <p class="text-green-100 text-sm">Demain</p>
                <p class="text-3xl font-bold">3</p>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                <p class="text-purple-100 text-sm">Total validées</p>
                <p class="text-3xl font-bold">47</p>
            </div>
        </div>

        <!-- Client Card Example -->

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($arr_reser_coach as $reservation): ?>
                <?php if($reservation['statut']=='Reserver'):?>
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="relative h-48 bg-gradient-to-br from-green-50 to-emerald-100 flex items-center justify-center">
                    <i class="fas fa-user-circle text-gray-400 text-7xl"></i>
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900">
                        <?=$reservation['nom']?> <span class="text-emerald-600"><?=$reservation['prenom']?></span>
                    </h3>

                    <div class="space-y-3 mt-4">
                        <p><strong>Email:</strong> <?=$reservation['email']?></p>
                        <p><strong>Téléphone:</strong> <?=$reservation['telephone']?></p>
                        <p><strong>Date:</strong> <?=$reservation['date']?></p>
                        <p><strong>Statut:</strong> <?=$reservation['statut']?></p>
                    </div>

                   
                </div>
            </div>
                    <?php endif;?>
                    <?php endforeach;?>
        </div>

        <!-- Disponibilités -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-10">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">
        Créer une séance
    </h2>

    <form action="" method="POST" class="space-y-4">

        <!-- Coach -->
        <input type="hidden" name="id_coach" value="<?php echo $_SESSION['id_coach'] ?>">

        <!-- Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Date
            </label>
            <input type="date" name="date" class="w-full border rounded-lg p-2">
        </div>

        <!-- Heure -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Heure
            </label>
            <input type="time" name="heure" class="w-full border rounded-lg p-2">
        </div>

        <!-- Durée -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Durée (en minutes)
            </label>
            <input type="number" name="duree" min="30" class="w-full border rounded-lg p-2">
        </div>

        <!-- Statut -->
        

        <!-- Bouton -->
        <button type="submit"
            class="w-full bg-green-600 text-white font-semibold py-2 rounded-lg hover:bg-green-700 transition">
            Enregistrer la séance
        </button>

    </form>
</div>


</body>
</html>
