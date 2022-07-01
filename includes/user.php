<?php
include 'db.php';

class User extends DB{
    private $nombre;
    private $username;
    private $rol;
    private $estado;

    public function userExists($user, $pass){
        $md5pass = md5($pass);
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE user_usuario = :user AND user_contrasenia = :pass');
        $query->execute(['user' => $user, 'pass' => $pass]);

        if($query->rowCount()){
           
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE user_usuario = :user');
        $query->execute(['user' => $user]);
      
            foreach ($query as $currentUser) {
                $this->nombre = $currentUser['user_nombre'];
                $this->usename = $currentUser['user_usuario'];
                $this->rol = $currentUser['user_rol_pk'];
                $this->estado = $currentUser['user_status'];
            }
        
        
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getRol(){
        return $this->rol;
    }
    public function getEstado(){
        return $this->estado;
    }
}

?>