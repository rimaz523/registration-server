<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegUsers
 *
 * @ORM\Table(name="reg_users")
 * @ORM\Entity(repositoryClass="App\Repository\RegUsersRepository")
 */
class RegUsers
{
    /**
     * @var string
     *
     * @ORM\Column(name="instance_identifier", type="string", length=255, nullable=false)
     * @ORM\Id
     */
    private $instanceIdentifier = '';

    /**
     * @var \string|null
     *
     * @ORM\Column(name="date", type="string", nullable=true)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="user_name", type="string", length=255, nullable=true)
     */
    private $userName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="user_email", type="string", length=255, nullable=true)
     */
    private $userEmail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comments", type="text", length=65535, nullable=true)
     */
    private $comments;

    /**
     * @var string|null
     *
     * @ORM\Column(name="updates", type="string", length=255, nullable=true)
     */
    private $updates;

    /**
     * @var string|null
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="company", type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="emp_count", type="string", length=255, nullable=true)
     */
    private $empCount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country_code", type="string", length=255, nullable=true)
     */
    private $countryCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="language", type="string", length=255, nullable=true)
     */
    private $language;

    /**
     * @var string|null
     *
     * @ORM\Column(name="timezone", type="string", length=255, nullable=true)
     */
    private $timezone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    private $lastName;

    
    public function getInstanceIdentifier()
    {
        return $this->instanceIdentifier;
    }
    
    public function setInstanceIdentifier($instanceIdentifier)
    {
        $this->instanceIdentifier = $instanceIdentifier;
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
    }
    
    public function getUserName()
    {
        return $this->userName;
    }
    
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    
    public function getUserEmail()
    {
        return $this->userEmail;
    }
    
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }
    
    public function getComments()
    {
        return $this->comments;
    }
    
    public function setComments($comments)
    {
        $this->comments = $comments;
    }


    public function getUpdates()
    {
        return $this->updates;
    }
    
    public function setUpdates($updates)
    {
        $this->updates = $updates;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }
    
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getCompany()
    {
        return $this->company;
    }
    
    public function setCompany($company)
    {
        $this->company = $company;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }
    
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function getEmpCount()
    {
        return $this->empCount;
    }
    
    public function setEmpCount($empCount)
    {
        $this->empCount = $empCount;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }
    
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function getLanguage()
    {
        return $this->language;
    }
    
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getTimezone()
    {
        return $this->timezone;
    }

    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }
    
    public function getLastName()
    {
        return $this->lastName;
    }
    
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
}
