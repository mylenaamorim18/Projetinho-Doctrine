<?php

namespace models\entidades;

/**
 * @Entity()
 */
class Endereco extends Entidade {

	/**
     * @var string $rua
     * @Column(type="string")
     */
    protected $rua;

	/**
     * @var string $cidade
     * @Column(type="string")
     */
    protected $cidade;

	/**
     * @var string $bairro
     * @Column(type="string")
     */
    protected $bairro;

    /**
     * @ManyToOne(targetEntity="Estado")
     * @Column(type="integer")
     */
    protected $estado;
	
	/**
	 * @var integer $numero
	 * @Column(type="integer")
     */
	protected $numero;
    

	public function getId()
    {
        return $this->id;
    }

	public function getRua()
    {
        return $this->rua;
    }

    public function setRua($rua)
    {
        $this->rua = $rua;
    }

	public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

	public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

	public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

	public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

}
