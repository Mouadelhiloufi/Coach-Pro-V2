<?php
session_start();
require_once "../config/database.php";

    class User{
        protected $email;
        protected $pwd;
        protected $nom;
        protected $prenom;
        protected $phone;
        protected $role;
        protected $conn;

        public function __construct($email,$pwd,$nom,$prenom,$phone,$role){
            
            $db=new DataBase();
            $this->conn=$db->connexion();
            $this->email=$email;
            $this->pwd=$pwd;
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->phone=$phone;
            $this->role=$role;
        }
        


        function setEmail($email){
            $this->email=$email;
        }
        function setPwd($pwd){
            $this->pwd=$pwd;
        }
        function setNom($nom){
            $this->nom=$nom;
        }
        function setPrenom($prenom){
            $this->prenom=$prenom;
        }
        function setPhone($phone){
            $this->phone=$phone;
        }
        function setRole($role){
            $this->role=$role;
        }
        function getEmail(){
            return $this->email;
        }
        function getPwd(){
            return $this->pwd;
        }
        function getNom(){
            return $this->nom;
        }
        function getPrenom(){
            return $this->prenom;
        }
        function getPhone(){
            return $this->phone;
        }
        function getRole(){
            return $this->role;
        }


        

    }

    class Coach extends User{
        private $id_user;
        private $image_coach;
        private $bio;
        private $experience;
        

        public function __construct($email,$pwd,$nom,$prenom,$phone,$role,$image_coach,$bio,$experience){
            parent::__construct($email,$pwd,$nom,$prenom,$phone,$role);
                
                $this->image_coach=$image_coach;
                $this->bio=$bio;
                $this->experience=$experience;
                $this->id_user=null;

            

        }
        function setImg($image_coach){
            $this->image_coach=$image_coach;
        }
        function setBio($bio){
            $this->bio=$bio;
        }
        function setExp($exp){
            $this->experience=$exp;
        }
        function getImg(){
           return $this->image_coach;
        }
        function getBio(){
            return $this->bio;
        }
        function getExp(){
            return $this->experience;
        }

        public function registerCoach(){
            
            
            $sql="INSERT into users(nom,prenom,email,telephone,password,role)VALUES(:nom,:prenom,:email,:telephone,:password,:role)";
            $prepare_User=$this->conn->prepare($sql);
            $prepare_User->bindParam(':nom',$this->nom);
            $prepare_User->bindParam(':prenom',$this->prenom);
            $prepare_User->bindParam(':email',$this->email);
            $prepare_User->bindParam(':telephone',$this->phone);
            $prepare_User->bindParam(':password',$this->pwd);
            $prepare_User->bindParam(':role',$this->role);

            $prepare_User->execute();
            $this->id_user=$this->conn->lastInsertId();

            
                $sql_coach="INSERT into coach(image_coach,biographie,experience,user_id)VALUES(:img,:bio,:exp,:id_user)";
                $prepare_coach=$this->conn->prepare($sql_coach);
                $prepare_coach->bindParam(':img',$this->image_coach);
                $prepare_coach->bindParam(':bio',$this->bio);
                $prepare_coach->bindParam(':exp',$this->experience);
                $prepare_coach->bindParam(':id_user',$this->id_user);

             

             return $prepare_coach->execute();

             
            

            
        }
    }

    class Client extends User{
        private $id_user;
        private $niveau;

        function __construct($email,$pwd,$nom,$prenom,$phone,$role,$niveau){
            parent::__construct($email,$pwd,$nom,$prenom,$phone,$role);
                $this->id_user=null;
                $this->niveau=$niveau;
            
        }

        
        function setNiveau($niveau){
            $this->niveau=$niveau;
        }
        
        function getNiveau(){
            return $this->niveau;
        }
        
        public function registerClient(){

        $sql="INSERT into users(nom,prenom,email,telephone,password,role)VALUES(:nom,:prenom,:email,:telephone,:password,:role)";
            $prepare_User=$this->conn->prepare($sql);
            $prepare_User->bindParam(':nom',$this->nom);
            $prepare_User->bindParam(':prenom',$this->prenom);
            $prepare_User->bindParam(':email',$this->email);
            $prepare_User->bindParam(':telephone',$this->phone);
            $prepare_User->bindParam(':password',$this->pwd);
            $prepare_User->bindParam(':role',$this->role);

            $prepare_User->execute();
            $this->id_user=$this->conn->lastInsertId();
            
            $sql_client="INSERT into client(niveau,user_id)VALUES(:niveau,:id_user)";
            $prepare_client=$this->conn->prepare($sql_client);
            $prepare_client->bindParam(':niveau',$this->niveau);
            $prepare_client->bindParam(':id_user',$this->id_user);

            
            return $prepare_client->execute();
        }

    }


    class Login{
        

       public static function login($email,$pwd){
        $db=new DataBase();
        $conn=$db->connexion();


        $sql_prepare="SELECT * from users where email = :email LIMIT 1";
        $sql=$conn->prepare($sql_prepare);
        $sql->execute([
            ':email'=>$email
        ]);

        if($sql->rowCount()==1){
            $user=$sql->fetch(PDO::FETCH_ASSOC);
            if(password_verify($pwd,$user['password'])){


                $_SESSION['user_id']=$user['id'];
                $_SESSION['user_role']=$user['role'];
                $_SESSION['user_prenom']=$user['prenom'];

                


                






                if($user['role']=='client'){



                    $sql_pre="SELECT * from client where user_id = ?";
                $sql_C=$conn->prepare($sql_pre);
                $sql_C->execute([
                    $_SESSION['user_id']
                ]);

                
                $client=$sql_C->fetch(PDO::FETCH_ASSOC);

                $_SESSION['id_client']=$client['id'];



                    header("location: ../pages/sportif.php");
                    exit();



                }else if($user['role']=='coach'){



                    $sql_pre="SELECT * from coach where user_id = ?";
                $sql_C=$conn->prepare($sql_pre);
                $sql_C->execute([
                    $_SESSION['user_id']
                ]);

                
                $coach=$sql_C->fetch(PDO::FETCH_ASSOC);
            
                $_SESSION['id_coach']=$coach['id'];


                    header("location: ../pages/coach.php");
                    exit();
                }
            }
        }



        }
    }


?>