<?php 
//Se carga el namespace donde se guardaran todo los types para formularios
namespace App\Form;
// se carga la clase para los formularios
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
// Se cargan los tipos de campos a usar
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

//se crea la clase heredada de AbstractType para crear el formulario para crear nuevas tareas
class TaskType extends AbstractType{

    //Se crea método para el constructor de formulario
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Creación de fomulario
        $builder->add('title', TextType::class, array(
            'label' => 'Título'
            ))
            ->add('content', TextareaType::class, array(
            'label' => 'Contenido'
            ))
            ->add('priority', ChoiceType::class, array(
            'label' => 'Prioridad',
            'choices' => array(
                'Alta' => 'high',
                'Media' => 'medium',
                'Baja' => 'low'
                )
            ))
            ->add('hours', TextType::class, array(
            'label' => 'Horas Presupuestadas'
            ))
            ->add('submit', SubmitType::class, array(
            'label' => 'Crear'
            ));
    }
}