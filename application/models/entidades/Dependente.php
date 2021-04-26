<?php

namespace models\entidades;

/**
 * @Entity()
 */
class Dependente extends Pessoa {

    /**
     * @ManyToMany(targetEntity="Funcionario", inversedBy="dependentes", cascade = {"persist"})
     */
    protected $funcionarios;

	/**
     * @var string $idade
     * @Column(type="integer")
     */
    protected $idade;
    
    public function __construct(){
        $this->funcionarios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getFuncionarios() {
        return $this->funcionarios;
    }

    public function setFuncionarios(Funcionario $funcionario) {
        $funcionario->setDependentes($this);
        $this->funcionarios[] = $funcionario;
    }

	public function getIdade() {
        return $this->idade;
    }

    public function setIdade($idade) {
        $this->idade = $idade;
    }

    public function removeFuncionario(Funcionario $funcionario) {
        if (!$this->funcionarios->contains($funcionario)) {
            return;
        }    
        $this->funcionarios->removeElement($funcionario);
        $funcionario->removeDependente($this);
    }

}
