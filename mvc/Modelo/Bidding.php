<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Bidding extends Modelo
{
    private $id;
    private $title;
    private $institutionId;
    private $description;
    private $value;

    public function __construct($title, $description, $value = [], $institutionId = null){
        $this->title = $title;
        $this->institutionId = $institutionId;
        $this->description = $description;
        $this->value = $value;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getInstitutionId(){
        return $this->institutionId;
    }
}