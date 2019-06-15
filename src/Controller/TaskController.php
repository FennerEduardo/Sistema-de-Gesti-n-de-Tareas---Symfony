<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//Importar la entidad de tareas
use App\Entity\Task;
//Importar la entidad de usuarios
use App\Entity\User;

class TaskController extends AbstractController
{

    public function index()
    {
        //Prueba de entidades y relaciones
        $em = $this->getDoctrine()->getManager();
        $task_repo = $this->getDoctrine()->getRepository(Task::class);

        /*
        //Obtener todas las tareas
        $tasks = $task_repo->findAll();
        //búcle para obtener cada tarea
        foreach ($tasks as $task) {
            echo $task->getUser()->getEmail().': '.$task->getTitle().'<br>';
        }
        */

        /*
        //Obtener todos los usuarios y las tareas asignadas
        $user_repo = $this->getDoctrine()->getRepository(User::class);
        $users = $user_repo->findAll();

        //Búcle para recorrer todos los usuarios
        foreach ($users as $user) {
            echo "<h1>{$user->getName()} {$user->getSurname()}</h1>";
            //búcle para obtener cada tarea
            foreach ($user->getTasks() as $task) {
                echo $task->getTitle().'<br>';
            }
        }
        */

        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }
}
