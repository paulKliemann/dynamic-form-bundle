<?php

namespace DynamicFormBundle\Entity\DynamicResult\ResultValue;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_result_string_value")
 *
 * @package DynamicFormBundle\Entity\Value
 */
class StringValue extends BaseValue
{
    /**
     * @var string
     *
     * @ORM\Column(name="string_content", type="string")
     */
    private $stringContent;

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->stringContent;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->stringContent = $content;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->stringContent;
    }
}
