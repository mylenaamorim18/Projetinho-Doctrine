<?php

namespace models\entidades;


/**
 *  @MappedSuperclass */

class Entidade {

    /**
     * @var int $id
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }

}