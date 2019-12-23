<?php
/* 
model for Users route 
*/
namespace Model;

class Users
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Return all users
     *
     * @return void
     */
    public function getUsers(){

        $db = $this->db;
        $stmt = $db->prepare("SELECT `UserID`,`name`,`email` FROM `users`");
        $stmt->execute([$order_ref]);

        //array of the products with on-hand quantity from DB
        $users = $stmt->fetchAll();
        $db = null;

        if(empty($users)){ return  false; }

        return $users;

    } 

    /**
     * Insert user into DB
     *
     * @param [type] $name
     * @param [type] $email
     * @param [type] $pass
     * @return void
     */
    public function insertUser($name,$email,$pass){

        $db = $this->db;

        try{
    
            $stmt = $pdo->prepare("INSERT INTO `users` (`name`,`email`,`password`) VALUES (?, ?, ?)");
            $stmt->execute([$name,$email,$pass]);

            $user_id = $pdo->lastInsertId();
            $stmt = null;

        } catch (Exception $e){

            //trow $e; //$e->getMessage()
            return false;
        }

        return $user_id;

    }
}