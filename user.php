<?php
class User{

    private $id;
    public $login;
    public $password;
    public $email;
    public $firstname;
    public $lastname;

    function __construct(){
        $this ->bdd = mysqli_connect('localhost','root','','classes');
        mysqli_set_charset($this ->bdd, 'utf8');
        return $this -> bdd;
    }

    public function register($login, $password, $email, $firstname, $lastname){
        $requete = mysqli_query($this->bdd, "INSERT INTO `utilisateurs`( `login`, `password`, `email`, `firstname`, `lastname`) VALUES ('$login', '$password', '$email', '$firstname', '$lastname')");
        echo'<table>
        <thead>
            <th>id</th>
            <th>login</th>
            <th>password</th>
            <th>email</th>
            <th>Firstname</th>
            <th>Lastname</th>
        </thead>
        <tbody>
            <td>'.$login.'</td>
            <td>'.$password.'</td>
            <td>'.$email.'</td>
            <td>'.$firstname.'</td>
            <td>'.$lastname.'</td>
        </tbody>
    </table>';
    }
    public function connect($login, $password){
        $requete4 = mysqli_query($this -> bdd,"SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'");
        $utilisateur = mysqli_fetch_all($requete4, MYSQLI_ASSOC);
        if(count($utilisateur) > 0){
            session_start();
            $_SESSION['utilisateur'] = [
                'id' => $utilisateur[0]['id'],
                'login' => $utilisateur[0]['login'],
                'password' => $utilisateur[0]['password'],
                'email' => $utilisateur[0]['email'],
                'firstname' => $utilisateur[0]['firstname'],
                'lastname' => $utilisateur[0]['lastname'],
            ]; var_dump($_SESSION['utilisateur']);
        }
    }
    public function disconnect(){
        session_start();
        session_destroy();
    }
    public function delete(){
        $requete2 = mysqli_query($this->bdd, 'DELETE FROM `utilisateurs` WHERE 20');
        session_destroy();
    }
    public function update($login, $password, $email, $firstname, $lastname){
        $requete3 = mysqli_query($this->bdd, "UPDATE `utilisateurs` SET `login`= '$login',`password`= '$password',`email`= '$email',`firstname`= '$firstname',`lastname`= '$lastname'");
    }
    public function isConnected(){
        if(!empty($_SESSION['utilisateur'])){
            return true;
        }
        else{
            return false;
        }
    }
    public function getAllinfos(){

        echo'<table>
                <thead>
                    <th>id</th>
                    <th>login</th>
                    <th>password</th>
                    <th>email</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                </thead>
                <tbody>
                    <td>'.$_SESSION['utilisateur']['id'].'</td>
                    <td>'.$_SESSION['utilisateur']['login'].'</td>
                    <td>'.$_SESSION['utilisateur']['password'].'</td>
                    <td>'.$_SESSION['utilisateur']['email'].'</td>
                    <td>'.$_SESSION['utilisateur']['firstname'].'</td>
                    <td>'.$_SESSION['utilisateur']['lastname'].'</td>
                </tbody>
            </table>';
    }
    public function getLogin(){
        return $this -> login;
    }
    public function getPassword(){
        return $this -> password;
    }
    public function getEmail(){
        return $this -> email;
    }
    public function getFirstname(){
        return $this -> firstname;
    }
    public function getLastname(){
        return $this -> lastname;
    }

}
 $personne = new User;
$personne -> register('ibrahim-sylla','bb', 'ibra@voyou.fr', 'ibrahim', 'sylla');
$personne -> connect('ibrahim-sylla','bb');
echo $personne -> isConnected();
 echo $personne -> getAllinfos();
?>
