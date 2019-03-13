<?php

class Warning
{
    private $title;
    private $message;
    private $type;
    private $allowed_types = ["danger", "success"];

    public function __construct($title, $message, $type = "") {
        $this->title = $title;
        $this->message = $message;
        $this->setType($type);
    }

    public static function danger($title, $message) {
        return new Warning($title, $message, "danger");
    }

    public static function success($title, $message) {
        return new Warning($title, $message, "success");
    }

    public function setType($type) {
        if (in_array($type, $this->allowed_types)) {
            $this->type = $type;
        } else {
            throw new InvalidArgumentException("Det er angitt feil type!");
        }
    }

    public function display()
    {
        $warning = "
        <div class='alert alert-{$this->type}' role='alert'>
            <h4 class='alert-heading'>{$this->title}</h4>
            <p>{$this->message}</p>
        </div>
        ";
        return $warning;
    }

}