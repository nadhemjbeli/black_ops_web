<?php

namespace App\Form\Model;

use App\Validator\UniqueUser;
use Symfony\Component\Validator\Constraints as Assert;

class UserFormModel
{
    /**
     * @Assert\NotBlank(message="Please enter an email")
     * @Assert\Email()
     * @UniqueUser()
     */
    public $mail;

    /**
     * @Assert\NotBlank(message="Entrez votre username")
     */
    public $username;

    /**
     * @Assert\NotBlank(message="Entrez votre mot de passe!")
     * @Assert\Length(min=5, minMessage="Come on, you can think of a password longer than that!")
     */
    public $plainPassword;

    /**
     * @Assert\IsTrue(message="I know, it's silly, but you must agree to our terms.")
     */
    public $agreeTerms;
}
