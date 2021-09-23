<?php

namespace App\Repository;

use App\Entity\Desenvolvedor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Desenvolvedor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Desenvolvedor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Desenvolvedor[]    findAll()
 * @method Desenvolvedor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DesenvolvedorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Desenvolvedor::class);
        $this->manager = $manager;
    }

    public function saveDeveloper($nome, $sexo, $idade, $hobby, $datanascimento)
    {
        $newDeveloper = new Desenvolvedor();

        $newDeveloper
            ->setNome($nome)
            ->setSexo($sexo)
            ->setIdade($idade)
            ->setHobby($hobby)
            ->setDatanascimento($datanascimento);

        $this->manager->persist($newDeveloper);
        $this->manager->flush();
    }

    public function updateDeveloper(Desenvolvedor $developer): Desenvolvedor{
        $this->manager->persist($developer);
        $this->manager->flush();

        return $developer;
    }

    public function removeDeveloper(Desenvolvedor $developer){
        $this->manager->remove($developer);
        $this->manager->flush();
    }

}
