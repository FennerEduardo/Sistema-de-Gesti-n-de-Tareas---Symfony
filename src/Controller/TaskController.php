<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//Usando las clases de Respuesta y requerimiento
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
//Importar la entidad de tareas
use App\Entity\Task;
//Importar la entidad de usuarios
use App\Entity\User;
//Cargar el formulario para crear tareas
use App\Form\TaskType;

class TaskController extends AbstractController
{

    public function index()
    {
        //Prueba de entidades y relaciones
        $em = $this->getDoctrine()->getManager();
        $task_repo = $this->getDoctrine()->getRepository(Task::class);     
        $tasks = $task_repo->findBy([], ['id' => 'desc']);
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
            'tasks' => $tasks
        ]);
    }

    //Método para cargar el detalle de las tareas, se le pasa el objeto de tarea como parametro
    public function detail(Task $task)
    {
        //Sí la tarea no existe redirecciona al inicio
        if (!$task) {
            return $this->redirectToRoute('tasks');
        }

        // renderizar vista del detalle de la tarea
        return $this->render('task/detail.html.twig', [
            'task' => $task
        ]);
    }

    //Método para la creación de tareas
    public function creation(Request $request, \Symfony\Component\Security\Core\User\UserInterface $user )
    {
        // se crea objeto de tareas
        $task = new Task();
        // se Incluye el formulario en una variable para pasarlo a la vista
        $form = $this->createForm(TaskType::class, $task);
        // Unir el formulario con la tarea
        $form->handleRequest($request);
        //Comprobando que el formulario llega con los datos de la tarea
        if ($form->isSubmitted() && $form->isValid()) {
            $task->setCreatedAt(new \Datetime('now'));
            $task->setUser($user);

            //Guardando el objeto en la base de datos
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            //Redirección después de crear la nueva tarea
            return $this->redirect(
                $this->generateUrl('task_detail', ['id' => $task->getId()])
            );
        }
        //retornando la vista
        return $this->render('task/creation.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
