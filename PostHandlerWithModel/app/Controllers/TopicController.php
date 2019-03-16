<?php

namespace App\Controllers;

use PDO;
use App\Models\Topic;

class TopicController extends BaseController{

    public function index($request, $response){

        $posts = $this->container->db->query('select * from posts')->fetchAll(PDO::FETCH_CLASS, Topic::class);
        return $this->container->view->render($response, 'index.twig', compact('posts'));
    }

    public function show($request, $response, $args){

        $post = $this->container->db->prepare('select * from posts where id= :id');
        $post->execute([
            'id' => $args['id']
        ]);

        $post = $post->fetch(PDO::FETCH_OBJ);
        return $this->container->view->render($response, 'show.twig', compact('post'));
    }

    // Redirect Example

    public function addTopic($request, $response){
        return $response->withRedirect($this->container->router->pathFor('topic.show',['id' => 2]));
    }

    public function showTopic($request, $response, $args){
        return "Show Topic" .$args['id'];
    }
}