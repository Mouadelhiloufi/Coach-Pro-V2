<?php

require_once "sceance.php";

$sceances=Sceance::affichage();



if($_SERVER['REQUEST_METHOD']=='POST'){
    
    if(isset($_POST['heure'])){
    $id_sceance=$_POST['id_sceance'];
    $date=$_POST['date'];
    $heure=$_POST['heure'];
    $duree=$_POST['duree'];
    $statut=$_POST['statut'];
    $sceance=new Sceance($date,$heure,$duree,$statut,$_SESSION['id_coach']);

    
    $edit=$sceance->edit($id_sceance);


     header("Location: ".$_SERVER['PHP_SELF']);
    exit;
    }else if(isset($_POST["delete"])){
        $id_sceance=$_POST['id'];
        
        $delete=Sceance::delete($id_sceance);
        header("Location: ".$_SERVER['PHP_SELF']);
    exit;

    }
}








?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Séances réservées</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<h1 class="text-3xl font-bold text-center mb-10">Sceances creé</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    <!-- CARD -->
     <?php foreach($sceances as $sceance): ?>
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <img src="<?=$sceance['image_coach']?>" class="w-full h-48 object-cover">

        <div class="p-6 space-y-2">
            <h2 class="text-xl font-semibold">Coach : <?php echo $sceance['nom']?></h2>
            <p>Date : <?=$sceance['date']?></p>
            <p>Heure : <?=$sceance['heure']?></p>
            <p>Durée : <?=$sceance['duree']?></p>
            <p class="text-green-600 font-semibold"><?=$sceance['statut']?></p>
        </div>

        <div class="flex justify-between px-6 py-4 border-t">
            <button 
    class="text-blue-600 font-medium hover:text-blue-800"
    onclick="openModal(this)"
    data-id="<?= $sceance['id'] ?>"
    data-date="<?= $sceance['date'] ?>"
    data-heure="<?= $sceance['heure'] ?>"
    data-duree="<?= $sceance['duree'] ?>"
    data-statut="<?= $sceance['statut'] ?>"
>
    Modifier
</button>

        <form action="" method="post">
            <input type="hidden" value="<?= $sceance['id'] ?>" name="id">
            <button type="submit" name="delete"
            class="text-red-600 font-medium hover:text-red-800">
                 Supprimer
            </button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Tu peux dupliquer la card autant que tu veux -->

</div>

<!-- MODAL -->
<div id="modal"
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">

    <div class="bg-white w-full max-w-lg rounded-xl p-6">
        <h2 class="text-2xl font-bold mb-4">Modifier la séance</h2>

        <form action="" method="POST" class="space-y-4">

            <!-- PHP utilisera cet ID -->
            <input type="hidden" name="id_sceance" value="">

            <div>
                <label class="font-medium">Date</label>
                <input type="date" name="date"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-medium">Heure</label>
                <input type="time" name="heure"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-medium">Durée (min)</label>
                <input type="number" name="duree"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-medium">Statut</label>
                <select name="statut"
                        class="w-full border rounded-lg px-3 py-2">
                    <option value="">-- choisir --</option>
                    <option value="reservee">Réservée</option>
                    <option value="annulee">Annulée</option>
                    <option value="disponible">disponible</option>
                </select>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <button type="button"
                        onclick="closeModal()"
                        class="px-4 py-2 bg-gray-300 rounded-lg">
                    Annuler
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Continuer
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JS SIMPLE (ouvrir / fermer uniquement) -->
<script>
function openModal(button) {
    // Récupérer les données de la card via data-attributes
    document.querySelector('input[name="id_sceance"]').value = button.dataset.id;
    document.querySelector('input[name="date"]').value = button.dataset.date;
    document.querySelector('input[name="heure"]').value = button.dataset.heure;
    document.querySelector('input[name="duree"]').value = button.dataset.duree;
    document.querySelector('select[name="statut"]').value = button.dataset.statut;

    // Afficher le modal
    document.getElementById('modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>


</body>
</html>
