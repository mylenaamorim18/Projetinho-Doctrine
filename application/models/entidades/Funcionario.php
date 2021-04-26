<?php

namespace models\entidades;

/**
 * @Entity()
 */
class Funcionario extends Pessoa {

    /**
     * @ManyToMany(targetEntity="Dependente", mappedBy="funcionarios", cascade = {"persist"})
     * 
     */
    protected $dependentes;

	/**
     * @var string $departamento
     * @Column(type="string")
     */
    protected $departamento;


    public function __construct() {
        $this->dependentes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getDependentes() {
        return $this->dependentes;
    }

    public function setDependentes(Dependente $dependente) {
        
        $this->dependentes[] = $dependente;
    }

	public function getDepartamento() {
        return $this->departamento;
    }

    public function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    public function removeDependente(Dependente $dependente) {
        if (!$this->dependentes->contains($dependente)) {
            return;
        }    
        $this->dependentes->removeElement($dependente);
        $dependente->removeFuncionario($this);
    }

}
