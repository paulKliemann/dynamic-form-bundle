<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Entity\DynamicResult\ResultValue\TextValue;
use DynamicFormBundle\Services\FormType\ConfigurationInterface;
use DynamicFormBundle\Statics\FormFieldOptions\BaseOptions;
use DynamicFormBundle\Statics\FormTypes;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
class TextAreaTypeConfiguration implements ConfigurationInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return FormTypes::TEXTAREA;
    }

    /**
     * @return string
     */
    public function getFormTypeClass()
    {
        return TextareaType::class;
    }

    /**
     * @return string
     */
    public function getValueClass()
    {
        return TextValue::class;
    }

    /**
     * @return array
     */
    public function getAvailableOptions()
    {
        return BaseOptions::all();
    }
}