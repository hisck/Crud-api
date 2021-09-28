<?php

namespace App\Controller;

use App\Repository\DesenvolvedorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DesenvolvedorController
{
    private $desenvolvedorRepository;

    public function __construct(DesenvolvedorRepository $desenvolvedorRepository)
    {
        $this->desenvolvedorRepository = $desenvolvedorRepository;
    }

    /**
     * @Route("/developers/", name="add_developer", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $nome           = $data['nome'];
        $sexo           = $data['sexo'];
        $idade          = $data['idade'];
        $hobby          = $data['hobby'];
        $datanascimento = new \DateTime($data['datanascimento']);

        if (empty($nome) || empty($sexo) || empty($idade) || empty($hobby) || empty($datanascimento)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->desenvolvedorRepository->saveDeveloper($nome, $sexo, $idade, $hobby, $datanascimento);

        return new JsonResponse(['status' => 'Developer created!'], Response::HTTP_CREATED);
    }

    /**
    * @Route("/developers/{id}", name="get_one_developer", methods={"GET"})
    */
    public function get($id): JsonResponse
    {
        $developer = $this->desenvolvedorRepository->findOneBy(['id' => $id]);

        if(empty($developer)){
            return new JsonResponse(['status' => 'Developer not found!'], Response::HTTP_NOT_FOUND);
        }

        $data = [
            'id' => $developer->getId(),
            'nome' => $developer->getNome(),
            'sexo' => $developer->getSexo(),
            'idade' => $developer->getIdade(),
            'hobby' => $developer->getHobby(),
            'datanascimento' => $developer->getDatanascimento(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
    * @Route("/developers", name="get_all_developers", methods={"GET"})
    */
    public function getAll(): JsonResponse
    {
        $developers = $this->desenvolvedorRepository->findAll();
        $data = [];

        foreach ($developers as $developer) {
            $data[] = [
                'id' => $developer->getId(),
                'nome' => $developer->getNome(),
                'sexo' => $developer->getSexo(),
                'idade' => $developer->getIdade(),
                'hobby' => $developer->getHobby(),
                'datanascimento' => $developer->getDatanascimento(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
    * @Route("/developers/{id}", name="update_developer", methods={"PUT"})
    */
    public function update($id, Request $request): JsonResponse
    {
        $developer = $this->desenvolvedorRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['nome'])            ? true : $developer->setNome($data['nome']);
        empty($data['sexo'])            ? true : $developer->setSexo($data['sexo']);
        empty($data['idade'])           ? true : $developer->setIdade($data['idade']);
        empty($data['hobby'])           ? true : $developer->setHobby($data['hobby']);
        empty($data['datanascimento'])  ? true : $developer->setDatanascimento(new \DateTime($data['datanascimento']));

        $updatedDeveloper = $this->desenvolvedorRepository->updateDeveloper($developer);

        return new JsonResponse($updatedDeveloper->toArray(), Response::HTTP_OK);
    }

    /**
    * @Route("/developers/{id}", name="delete_developer", methods={"DELETE"})
    */
    public function delete($id): JsonResponse
    {
        $developer = $this->desenvolvedorRepository->findOneBy(['id' => $id]);

        if(empty($developer)){
            return new JsonResponse(['status' => 'Failed to delete developer with invalid id!'], Response::HTTP_BAD_REQUEST);
        }

        $this->desenvolvedorRepository->removeDeveloper($developer);

        return new JsonResponse(['status' => 'Developer deleted'], Response::HTTP_NO_CONTENT);
    }
}