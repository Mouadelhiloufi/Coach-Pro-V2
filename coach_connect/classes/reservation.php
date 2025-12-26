<?php
    require_once "../config/database.php";


    Class Reservation{
        

        protected $statut;
        protected $id_client;
        protected $id_coach;
        protected $id_sceance;
        protected $conn;
        


        


       function __construct($statut,$id_client,$id_coach,$id_sceance){
        $db=new DataBase();
        $this->conn=$db->connexion();

        $this->statut=$statut;
        $this->id_client=$id_client;
        $this->id_coach=$id_coach;
        $this->id_sceance=$id_sceance;

       }

       public function cree_reservation(){

        $sql_pre="INSERT into reservation(statut,client_id,coach_id,sceance_id)values(?,?,?,?)";
        $sql=$this->conn->prepare($sql_pre);
        $sql->execute([
            $this->statut,
            $this->id_client,
            $this->id_coach,
            $this->id_sceance
        ]);

        $sql_prepare="UPDATE sceance set statut = ? where id = ?";
        $sql_update=$this->conn->prepare($sql_prepare);
        $sql_update->execute([
            $this->statut,
            $this->id_sceance
        ]);



       }


       static function affichage_reservation($SESSION){

        $db=new DataBase();
        $conn=$db->connexion();



        $sql_pre=" SELECT U.nom,U.prenom,S.date,S.heure,R.statut from reservation R 
        inner join client CL on CL.id=R.client_id
        inner join coach C on C.id = R.coach_id
        inner join users U on U.id = C.user_id
        inner join sceance S on S.id=R.sceance_id  where CL.id=?";
        $sql_aff=$conn->prepare($sql_pre);
        $sql_aff->execute([
            $SESSION
        ]);
        $res=$sql_aff->fetchAll(PDO::FETCH_ASSOC);

        return $res;

       }


       static function affichage_res_coach($SESSION){
        $db=new DataBase();
        $conn=$db->connexion();
        
        $sql_prepare="SELECT U.nom,U.prenom,U.email,U.telephone,S.date,R.statut from reservation R 
        inner join sceance S on R.sceance_id=S.id 
        inner join client CL on CL.id=R.client_id 
        inner join coach C on R.coach_id=C.id 
        inner join users U on U.id = CL.user_id where C.id=?";

        $sql=$conn->prepare($sql_prepare);

        $sql->execute([
            $SESSION
        ]);
        $res=$sql->fetchAll(PDO::FETCH_ASSOC);

        return $res;
       }


    }
?>

