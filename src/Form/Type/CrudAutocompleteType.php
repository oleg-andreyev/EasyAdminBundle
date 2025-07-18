<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Form\Type;

use EasyCorp\Bundle\EasyAdminBundle\Form\EventListener\CrudAutocompleteSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class CrudAutocompleteType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new CrudAutocompleteSubscriber())
            ->setDataMapper($this);
    }

    public function finishView(FormView $view, FormInterface $form, array $options): void
    {
        // Add a custom block prefix to inner field to ease theming:
        array_splice($view['autocomplete']->vars['block_prefixes'], -1, 0, 'ea_autocomplete_inner');

        // allowClear option needs a placeholder value (it can be empty)
        if (($view->vars['attr']['data-allow-clear'] ?? false) && (!isset($view->vars['attr']['data-placeholder']))) {
            $view->vars['attr']['data-placeholder'] = '';
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'multiple' => false,
            // force display errors on this form field
            'error_bubbling' => false,
        ]);

        $resolver->setRequired(['class']);
    }

    public function getBlockPrefix(): string
    {
        return 'ea_autocomplete';
    }

    public function mapDataToForms($data, $forms): void
    {
        $form = current(iterator_to_array($forms, false));
        if (false !== $form) {
            $form->setData($data);
        }
    }

    public function mapFormsToData($forms, &$data): void
    {
        $form = current(iterator_to_array($forms, false));
        if (false !== $form) {
            $data = $form->getData();
        }
    }
}
