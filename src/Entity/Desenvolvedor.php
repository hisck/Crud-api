<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DesenvolvedorRepository::class)
 */
class Desenvolvedor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexo;

    /**
     * @ORM\Column(type="integer")
     */
    private $idade;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hobby;

    /**
     * @ORM\Column(type="date")
     */
    private $datanascimento;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getIdade(): ?int
    {
        return $this->idade;
    }

    public function setIdade(int $idade): self
    {
        $this->idade = $idade;

        return $this;
    }

    public function getHobby(): ?string
    {
        return $this->hobby;
    }

    public function setHobby(string $hobby): self
    {
        $this->hobby = $hobby;

        return $this;
    }

    public function getDatanascimento(): ?\DateTimeInterface
    {
        return $this->datanascimento;
    }

    public function setDatanascimento(\DateTimeInterface $datanascimento): self
    {
        $this->datanascimento = $datanascimento;

        return $this;
    }

    public function toArray()
    {
        return [
            'id'            => $this->getId(),
            'nome'          => $this->getNome(),
            'sexo'          => $this->getSexo(),
            'Idade'         => $this->getIdade(),
            'hobby'         => $this->getHobby(),
            'datanascimento'=> $this->getDatanascimento()
        ];
    }
}
