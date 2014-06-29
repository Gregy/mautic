<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic, NP. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\LeadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mautic\CoreBundle\Entity\FormEntity;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Class LeadField
 * @ORM\Table(name="lead_fields")
 * @ORM\Entity(repositoryClass="Mautic\LeadBundle\Entity\LeadFieldRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class LeadField extends FormEntity
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose
     * @Serializer\Groups({"full", "limited"})
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full", "limited"})
     */
    private $label;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full", "limited"})
     */
    private $alias;

    /**
     * @ORM\Column(type="string", length=50)
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full", "limited"})
     */
    private $type;

    /**
     * @ORM\Column(name="default_value", type="string", length=255, nullable=true)
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full", "limited"})
     */
    private $defaultValue;

    /**
     * @ORM\Column(name="is_required", type="boolean")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full", "limited"})
     */
    private $isRequired = false;

    /**
     * @ORM\Column(name="is_fixed", type="boolean")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full", "limited"})
     */
    private $isFixed = false;

    /**
     * @ORM\Column(name="is_visible", type="boolean")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full", "limited"})
     */
    private $isVisible = true;

    /**
     * @ORM\Column(name="is_listable", type="boolean")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full", "limited"})
     */
    private $isListable = true;

    /**
     * @ORM\Column(name="field_order", type="integer", nullable=true)
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full", "limited"})
     */
    private $order = 0;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full", "limited"})
     */
    private $properties;

    private $changes;

    private function isChanged($prop, $val)
    {
        if ($this->$prop != $val) {
            $this->changes[$prop] = array($this->$prop, $val);
        }
    }

    public function getChanges()
    {
        return $this->changes;
    }

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('label', new Assert\NotBlank(
            array('message' => 'mautic.lead.field.label.notblank')
        ));

        $metadata->addConstraint(new UniqueEntity(array(
            'fields'  => array('alias'),
            'message' => 'mautic.lead.field.alias.unique'
        )));
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return LeadField
     */
    public function setLabel($label)
    {
        $this->isChanged('label', $label);
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }


    /**
     * Proxy function to setLabel()
     *
     * @param string $label
     * @return LeadField
     */
    public function setName($label)
    {
        $this->isChanged('label', $label);
        return $this->setLabel($label);
    }

    /**
     * Proxy function for getLabel()
     *
     * @return string
     */
    public function getName()
    {
        return $this->getLabel();
    }

    /**
     * Set type
     *
     * @param string $type
     * @return LeadField
     */
    public function setType($type)
    {
        $this->isChanged('type', $type);
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set defaultValue
     *
     * @param string $defaultValue
     * @return LeadField
     */
    public function setDefaultValue($defaultValue)
    {
        $this->isChanged('defaultValue', $defaultValue);
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * Get defaultValue
     *
     * @return string
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * Set isRequired
     *
     * @param boolean $isRequired
     * @return LeadField
     */
    public function setIsRequired($isRequired)
    {
        $this->isChanged('isRequired', $isRequired);
        $this->isRequired = $isRequired;

        return $this;
    }

    /**
     * Get isRequired
     *
     * @return boolean
     */
    public function getIsRequired()
    {
        return $this->isRequired;
    }

    /**
     * Proxy to getIsRequired()
     *
     * @return bool
     */
    public function isRequired()
    {
        return $this->getIsRequired();
    }

    /**
     * Set isFixed
     *
     * @param boolean $isFixed
     * @return LeadField
     */
    public function setIsFixed($isFixed)
    {
        $this->isFixed = $isFixed;

        return $this;
    }

    /**
     * Get isFixed
     *
     * @return boolean
     */
    public function getIsFixed()
    {
        return $this->isFixed;
    }

    /**
     * Proxy to getIsFixed()
     *
     * @return bool
     */
    public function isFixed()
    {
        return $this->getIsFixed();
    }

    /**
     * Set properties
     *
     * @param string $properties
     * @return LeadField
     */
    public function setProperties($properties)
    {
        $this->isChanged('properties', $properties);
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get properties
     *
     * @return string
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set order
     *
     * @param integer $order
     * @return LeadField
     */
    public function setOrder($order)
    {
        $this->isChanged('order', $order);
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set isVisible
     *
     * @param boolean $isVisible
     * @return LeadField
     */
    public function setIsVisible($isVisible)
    {
        $this->isChanged('isVisible', $isVisible);
        $this->isVisible = $isVisible;

        return $this;
    }

    /**
     * Get isVisible
     *
     * @return boolean
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }

    /**
     * Proxy to getIsVisible()
     *
     * @return bool
     */
    public function isVisible()
    {
        return $this->getIsVisible();
    }

    /**
     * Set alias
     *
     * @param string $alias
     * @return LeadField
     */
    public function setAlias($alias)
    {
        $this->isChanged('alias', $alias);
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set isListable
     *
     * @param boolean $isListable
     * @return LeadField
     */
    public function setIsListable($isListable)
    {
        $this->isChanged('isListable', $isListable);
        $this->isListable = $isListable;

        return $this;
    }

    /**
     * Get isListable
     *
     * @return boolean
     */
    public function getIsListable()
    {
        return $this->isListable;
    }

    /**
     * Proxy to getIsListable()
     *
     * @return bool
     */
    public function isListable()
    {
        return $this->getIsListable();
    }
}
