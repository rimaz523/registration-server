<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrangeOrganizationEmployee
 *
 * @ORM\Table(name="orange_organization_employee", indexes={@ORM\Index(name="instance_identifier", columns={"instance_identifier"})})
 * @ORM\Entity(repositoryClass="App\Repository\OrangeOrganizationEmployeeRepository")
 */
class OrangeOrganizationEmployee
{
    const INCREMENT_COUNT_TYPE = 1;
    const DECREMENT_COUNT_TYPE = 2;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="count_type", type="integer", nullable=true)
     */
    private $countType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="count", type="integer", nullable=true)
     */
    private $count;

    /**
     * @var \string|null
     *
     * @ORM\Column(name="date", type="string", nullable=true)
     */
    private $date;

    /**
     * @var \RegUsers
     *
     * @ORM\ManyToOne(targetEntity="RegUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="instance_identifier", referencedColumnName="instance_identifier")
     * })
     */
    private $instanceIdentifier;
    
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getCountType()
    {
        return $this->countType;
    }
    
    public function setCountType($countType)
    {
        $this->countType = $countType;
    }
    
    public function getCount()
    {
        return $this->count;
    }
    
    public function setCount($count)
    {
        $this->count = $count;
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getInstanceIdentifier()
    {
        return $this->instanceIdentifier;
    }
    
    public function setInstanceIdentifier($instanceIdentifier)
    {
        $this->instanceIdentifier = $instanceIdentifier;
    }
}
