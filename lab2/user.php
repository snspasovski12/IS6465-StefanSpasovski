<?php

// Lab 2C: Constructors, Constants, and Inheritance

echo '<h1>Lab 2C: User and Tutor Classes</h1>';

function cleanText($value)
{
    return trim($value);
}

class User
{
    public const STATUS_ACTIVE = 'active';

    public $name;
    public $email;
    public $status;

    public function __construct($name, $email)
    {
        $this->name = cleanText($name);
        $this->email = strtolower(cleanText($email));
        $this->status = self::STATUS_ACTIVE;
    }
}

class Tutor extends User
{
    public $subject;

    public function __construct($name, $email, $subject)
    {
        parent::__construct($name, $email);
        $this->subject = cleanText($subject);
    }

    public function profileSummary()
{
    return "Name: {$this->name}<br>Email: {$this->email}<br>Subject: {$this->subject}";
}
}

$tutor = new Tutor('Jordan Lee', 'JLEE@GMAIL.COM', 'PHP');
echo $tutor->profileSummary();