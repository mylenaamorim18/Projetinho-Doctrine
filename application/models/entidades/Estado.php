<?php

namespace models\entidades; //adicionando o caminho

/**
 * @Entity()
 */
class Estado extends Entidade {

	/**
     * @var string $uf
     * @Column(type="string")
     */
    protected $uf;

	/**
     * @var string $nome
     * @Column(type="string")
     */
    protected $nome;


    // /**
    //  * One product has many features. This is the inverse side.
    //  * @OneToMany(targetEntity="Endereco", mappedBy="estado")
    //  */
    // protected $enderecos; //?????????


	public function getUf()
    {
        return $this->uf;
    }

    public function setUf($uf)
    {
        $this->uf = $uf;
    }

	public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

}
