<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//Usando las clases de Respuesta y requerimiento
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
//Usar el modelo User
use App\Entity\User;
//Usar el registerType del formulario
use App\Form\RegisterType;
//Usar el encoder de encriptamiento de password
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        //Objeto del modelo user
        $user = new User();
        //Creación del formulario para el objeto user
        $form = $this->createForm(RegisterType::class, $user);

        //Vincular el formulario con el objeto -Rellenar el objeto con los datos del form
        $form->handleRequest($request);
        //Comprobar sí el formulario está enviado
        if ($form->isSubmitted()) {
          //Modificando el objeto para guardarlo
            //Insertando el valor del role
            $user->setRole('ROLE_USER');
            //Insertando el valor de created_at
            $user->setCreatedAt(new \Datetime('now'));
            //Cifrar contraseña usando los encodes de Symfony
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

            //Guardar el Usuario
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            //Redirigir al guardarse
            return $this->redirectToRoute('tasks');
        }
        
        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
