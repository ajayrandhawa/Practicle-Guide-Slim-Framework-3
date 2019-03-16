<?php

namespace App\Controllers;

use PDO;
use App\Models\User;

class UserController extends BaseController{


    public function index($request, $response){

        $users = $this->container->db->query('select * from users')->fetchAll(PDO::FETCH_CLASS, User::class);
        return $this->container->view->render($response, 'users.twig', compact('users'));
    }
}