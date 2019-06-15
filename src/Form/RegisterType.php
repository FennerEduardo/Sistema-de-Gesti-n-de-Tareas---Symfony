<?php 
//Se carga el namespace donde se guardaran todo los types para formularios
namespace App\Form;
// se carga la clase para los formularios
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
// Se cargan los tipos de campos a usar
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

//se crea la clase heredada de AbstractType para crear el formulario
class RegisterType extends AbstractType{

    //Se crea método para el constructor de formulario
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Creación de fomulario
        $builder->add('name', TextType::class, array(
            'label' => 'Nombre'
            ))
            ->add('surname', TextType::class, array(
            'label' => 'Apellidos'
            ))
            ->add('email', EmailType::class, array(
            'label' => 'Correo Electrónico'
            ))
            ->add('password', PasswordType::class, array(
            'label' => 'Contraseña'
            ))
            ->add('submit', SubmitType::class, array(
            'label' => 'Registrarse'
            ));
    }
}