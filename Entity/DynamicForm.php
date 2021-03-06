<?php

namespace DynamicFormBundle\Entity;

use DynamicFormBundle\Entity\DynamicForm\FormElement;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Model\DynamicForm as BaseModel;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table
 * @ORM\Entity
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 *
 * @package DynamicFormBundle\Entity
 */
class DynamicForm extends BaseModel
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name;

    /**
     * @var Collection|DynamicResult[]
     *
     * @ORM\OneToMany(targetEntity="DynamicFormBundle\Entity\DynamicResult", mappedBy="form")
     */
    protected $results;

    /**
     * @var Collection|FormField[]
     *
     * @ORM\ManyToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm\FormField", mappedBy="forms", cascade={"persist", "remove"})
     */
    protected $fields;

    /**
     * @var Collection|FormField[]
     *
     * @ORM\ManyToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm\FormElement", mappedBy="forms", cascade={"persist", "remove"})
     */
    protected $elements;

    /**
     */
    public function __construct()
    {
        $this->fields = new ArrayCollection();
        $this->elements = new ArrayCollection();
        $this->results = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param FormField $field
     *
     * @return DynamicForm
     */
    public function addField(FormField $field)
    {
        if (false === $this->fields->contains($field) && false === $this->hasField($field->getKey())) {
            $field->addForm($this);
            $this->fields[] = $field;
        }

        return $this;
    }

    /**
     * @param FormField $field
     */
    public function removeField(FormField $field)
    {
        $field->removeForm($this);
        $this->fields->removeElement($field);
    }

    /**
     * @return Collection|FormField[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Add element
     *
     * @param FormElement $element
     *
     * @return DynamicForm
     */
    public function addElement(FormElement $element)
    {
        if (false === $this->elements->contains($element)) {
            $element->addForm($this);
            $this->elements[] = $element;
        }

        return $this;
    }

    /**
     * Remove element
     *
     * @param FormElement $element
     */
    public function removeElement(FormElement $element)
    {
        $this->elements->removeElement($element);
    }

    /**
     * Get elements
     *
     * @return Collection|FormElement[]
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @return Collection
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param DynamicResult $result
     *
     * @return DynamicForm
     */
    public function addResult(DynamicResult $result)
    {
        if (false === $this->results->contains($result)) {
            $this->results[] = $result;
        }

        return $this;
    }

    /**
     * @param DynamicResult $result
     */
    public function removeResult(DynamicResult $result)
    {
        $this->results->removeElement($result);
    }
}
