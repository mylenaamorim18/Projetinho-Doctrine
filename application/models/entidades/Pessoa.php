<?php

namespace models\entidades;

/**
 * @Entity 
 * @Table(name="pessoa")
 * @InheritanceType("SINGLE_TABLE")
 * */

abstract class Pessoa extends Entidade {

	/**
     * @OneToOne(targetEntity="Endereco")
     * @JoinColumn(name="endereco", referencedColumnName="id")
     */
    protected $endereco;

	/**
	 * @var string $nome
	 * @Column(type="string")
	 */
	protected $nome;

	/**
     * @var string $cpf
     * @Column(type="string")
     */
    protected $cpf;

	public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

	public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

	public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

}


