<?php

class Pasien extends \Phalcon\Mvc\Model
{
    public $id;
    public $name;
    public $sex;
    public $religion;
    public $phone;
    public $address;
    public $nik;
    public $created_at;
    public $update_at;

    public function initialize()

    {
        $this->setSchema("hospitaldb");
        $this->setSource("pasien");
    }

    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
