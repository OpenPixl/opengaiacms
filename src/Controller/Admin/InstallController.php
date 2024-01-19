<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Application;
use App\Entity\Admin\Config;
use App\Entity\Admin\Member;
use App\Entity\Admin\UnderConstruction;
use App\Form\Admin\InstallFormType;
use App\Form\Admin\underConstructionType;
use App\Repository\Admin\ApplicationRepository;
use App\Repository\Admin\ConfigRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

// Configuration du site lors de son premier lancement
class InstallController extends AbstractController
{
    #[Route('/installStep1', name: 'og_admin_install_step1')]
    public function step1(
        Request $request,
        ConfigRepository $configRepository,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher,
        SluggerInterface $slugger,
    ): Response
    {
        $config = new Config();
        $application = new Application();
        $form = $this->createForm(InstallFormType::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // intégration d'une image pour le logo de la structure
            $logoFile = $form->get('logoFile')->getData();
            if ($logoFile) {
                $originallogoFileName = pathinfo($logoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safelogoFileName = $slugger->slug($originallogoFileName);
                $newlogoFileName = $safelogoFileName . '-' . uniqid() . '.' . $logoFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $logoFile->move(
                        $this->getParameter('application_directory'),
                        $newlogoFileName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $application->setLogoFilename($newlogoFileName);
                //$application->setLogoFilesize($logoFile->getSize());
                $application->setLogoFileext($logoFile->guessExtension());
            }
            $em->persist($application);


            // Récupération des éléments du formulaire
            $adminFirstName = $form->get('webmasterFirstname')->getData();
            $adminLastName = $form->get('webmasterLastname')->getData();
            $email = $form->get('webmasterMail')->getData();
            $password = $form->get('webmasterPassword')->getData();

            $config->setIsInstalled(1);
            $config->setIsOffLine(1);
            $config->setStep(1);
            $em->persist($config);

            // ENREGISTREMENT DE L'ADMIN
            $admin = new Member();
            // HASHAGE DU MOT DE PASSE
            $hashedPassword = $passwordHasher->hashPassword(
                $admin,
                $password
            );
            $admin->setEmail($email);
            $admin->setRoles(["ROLE_SUPER_ADMIN"]);
            $admin->setFirstName($adminFirstName);
            $admin->setLastName($adminLastName);
            $admin->setIsVerified(1);
            $admin->setPassword($hashedPassword);


            $em->persist($application);

            $em->persist($admin);
            $em->flush();
            return $this->redirectToRoute('og_admin_install_step2', [], Response::HTTP_SEE_OTHER);
        }
        // Insertion des élements de la table de Config
        return $this->render('admin/install/step1.html.twig', [
            'config' => $config,
            'form' => $form,
        ]);
    }

    #[Route('//installStep2', name: 'og_admin_install_step2')]
    public function installStep2(
        Request $request,
        ConfigRepository $configRepository,
        EntityManagerInterface $em,
    )
    {
        $under = new UnderConstruction();
        $form = $this->createForm(underConstructionType::class, $under);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($under);
            $config = $configRepository->findFirstReccurence();
            $config->setStep(2);
            $em->persist($config);

            $em->flush();

            return $this->redirectToRoute('og_webapp_public_index', [], Response::HTTP_SEE_OTHER);
        }

        // Insertion des élements de la table de Config
        return $this->render('admin/install/step2.html.twig',[
            'form' => $form,
            'under'=> $under
        ]);
    }
}
