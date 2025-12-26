<?php
session_start();
require_once "../config/database.php";

    class Sceance{

            protected $date;
            protected $heure;
            protected $duree;
            protected $statut;
            protected $id_coach;
            protected $conn;

        function __construct($date,$heure,$duree,$statut,$id_coach){

            $db=new DataBase();
            $this->conn=$db->connexion();

            $this->date=$date;
            $this->heure=$heure;
            $this->duree=$duree;
            $this->statut=$statut;
            $this->id_coach=$id_coach;

             }




            static function insert_sceance($date,$heure,$duree,$statut,$id_coach){
              $db=new DataBase();
            $conn=$db->connexion();


            $sql_prepare="INSERT into sceance(date,heure,duree,statut,id_coach)values(?,?,?,?,?)";
            $sql=$conn->prepare($sql_prepare);
            $sql->execute([
            $date,
            $heure,
            $duree,
            $statut,
            $id_coach
            ]);
            }

            static function affichage(){

                
                $db=new DataBase();
                $conn=$db->connexion();
               

                $sql_prepare="SELECT U.nom,U.prenom,U.email,C.image_coach,U.telephone,SC.id,SC.date,SC.heure,SC.duree,SC.statut from users U inner join coach C on U.id=C.user_id inner join sceance SC on SC.id_coach = C.id where U.id=?";
                $sql=$conn->prepare($sql_prepare);

                $sql->execute([
                $_SESSION['user_id']
                ]);
                $sceances=$sql->fetchAll(PDO::FETCH_ASSOC);

                return $sceances;

            }

            


           public function edit($id_sceance){
            $sql_pre="UPDATE sceance set date=?, heure=?, duree=?, statut=? where id = ?";
            $sql=$this->conn->prepare($sql_pre);
            $sql->execute([
                $this->date,
                $this->heure,
                $this->duree,
                $this->statut,
                $id_sceance
            ]);
           }


           static function delete($id_sceance){
            $db=new DataBase();
            $conn=$db->connexion();
            $sql_pre="DELETE from sceance where id=?";
            $sql=$conn->prepare($sql_pre);
            $sql->execute([
                $id_sceance
            ]);
           }


           static function affichage_client(){

            $db=new DataBase();
            $conn=$db->connexion();

            $sql_prepare="SELECT U.nom,U.prenom,U.email,U.telephone,C.id as id_coach,C.image_coach,C.biographie,C.experience,S.id as id_seance,S.date,S.heure,S.duree,S.statut 
            from users U inner join coach C on U.id=C.user_id
            inner join sceance S on S.id_coach = C.id";

            $sql=$conn->prepare($sql_prepare);
            $sql->execute();
            
            $result=$sql->fetchAll(PDO::FETCH_ASSOC);

            return $result;


           }


       





    }

?>