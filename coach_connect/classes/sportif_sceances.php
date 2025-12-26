<?php
require_once "../classes/sceance.php";
 require_once "../classes/reservation.php";

$seances=Sceance::affichage_client();

if($_SERVER['REQUEST_METHOD']=="POST"){
    $statut=$_POST['statut'];
    $id_client=$_POST['id_client'];
    $id_coach=$_POST['id_coach'];
    $id_sceance=$_POST['id_seance'];

    $reservation= new Reservation($statut,$id_client,$id_coach,$id_sceance);
    $reservation->cree_reservation();
    header("Location: ".$_SERVER["PHP_SELF"]);
}










?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Coachs - CoachSport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">

<!-- NAVBAR -->
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
                    <a href="#" class="text-indigo-600 px-3 py-2 rounded-md font-medium">
                        Coachs
                    </a>
                    <a href="sportif.php" class=" text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">
                        Mon Espace
                    </a>
                    <a href="logout.php" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition font-medium">
                        <i class="fas fa-sign-out-alt mr-1"></i> Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

<!-- HEADER -->
<div class="max-w-7xl mx-auto px-4 py-12 text-center">
    <h1 class="text-5xl font-bold text-gray-900 mb-4">Nos Coachs Professionnels</h1>
    <p class="text-xl text-gray-600">Trouvez le coach parfait pour atteindre vos objectifs</p>
</div>



<!-- COACHS -->
<div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 lg:grid-cols-3 gap-8">

<?php foreach($seances as $seance): ?>
     <?php if($seance['statut']=='disponible'):?>

        <form action="" method="POST">


        <input type="hidden" name="id_seance" value="<?= $seance['id_seance'] ?>">
    <input type="hidden" name="id_coach" value="<?= $seance['id_coach'] ?>">
    <input type="hidden" name="statut" value="<?= "Reserver"?>">
    <input type="hidden" name="id_client" value="<?= $_SESSION['id_client'] ?>">



<div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">

    <div class="relative h-48 bg-indigo-100 flex items-center justify-center">
        <i class="fas fa-user-circle text-gray-400 text-7xl"></i>
        <span class="absolute top-4 right-4 bg-indigo-600 text-white px-3 py-1 rounded-full text-sm">
            <?= $seance['experience'] ?> ans
        </span>
    </div>

    <div class="p-6">
        <h3 class="text-xl font-bold text-gray-900">
            <?= $seance['nom'] ?> <span class="text-indigo-600"><?= $seance['prenom'] ?></span>
        </h3>

        <span class="inline-block mt-2 bg-indigo-50 text-indigo-700 px-3 py-1 rounded-lg text-sm">
            Musculation
        </span>

        <div class="mt-4 space-y-2 text-sm text-gray-700">
            <p><i class="fas fa-envelope mr-2"></i> <?= $seance['email'] ?></p>
            <p><i class="fas fa-phone mr-2"></i> <?= $seance['telephone'] ?></p>
            <p><i class="fas fa-calendar mr-2"></i> <?= $seance['date'] ?></p>
            <p><i class="fas fa-calendar-check mr-2"></i> <?= $seance['statut'] ?></p>
        </div>

        <p class="mt-4 text-gray-600 text-sm italic">
            <?= $seance['biographie'] ?>
        </p>

        <button type="submit"
        class="mt-6 w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700">
            <i class="fas fa-calendar-check mr-2"></i> <?= "RESERVER"?>
        </button>
    </div>

    <div class="px-6 py-4 bg-gray-50 flex justify-between items-center">
        <span class="text-yellow-400">★★★★☆</span>
        <span class="font-bold text-indigo-600">45€</span>
    </div>
</div>
</form>
<?php endif; ?>
<?php endforeach; ?>

</div>



<!-- FOOTER -->
<footer class="bg-white mt-20 py-8 text-center shadow-lg">
    <p class="text-gray-600">© 2025 CoachSport. Tous droits réservés.</p>
</footer>

</body>
</html>
