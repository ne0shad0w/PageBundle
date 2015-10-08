<?php
namespace ne0shad0w\PageBundle\PageBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType ;
use Symfony\Component\Form\Extension\Core\Type\NumberType ;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType ;
use Symfony\Component\Form\Extension\Core\Type\SubmitType ;


class PgBloccolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder->add('translations', 'a2lix_translations', array(
			'locales' => array('fr', 'en' , 'ru' , 'es' , 'pt' ),   // [1]
			'required_locales' => array(),      // [2]
			'fields' => array(                      // [3]
				'htmlBloccol' => array(                   // [3.a]
					'field_type' => 'textarea',                 // [4]
					'label' => 'HTML'
				)
			)
		));

		$builder->add('Enregistrer',new SubmitType(),array('label'=>'form.enregistrer'));
    }

    public function getName()
    {
        return 'PageBloccolType';
    }

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'ne0shad0w\PageBundle\PageBundle\Entity\PgBloccol',
			'label' => 'Modification du contenu',
			'attr' => array( 'id'=>'modifier_html' , 'name'=>'modifier_html' )
		));
		$resolver->setDefined('label');
	}
}