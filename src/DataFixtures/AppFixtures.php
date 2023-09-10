<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Employe;
use App\Entity\Projet;
use App\Entity\Tache;
use App\Entity\Statut;
use \DateTime;
use \DateInterval;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création des statuts
        $todo = new Statut();
        $todo->setLibelle('To Do');
        $manager->persist($todo);

        $doing = new Statut();
        $doing->setLibelle('Doing');
        $manager->persist($doing);
        
        $done = new Statut();
        $done->setLibelle('Done');
        $manager->persist($done);

        
        // Création des employés
        $employe1 = new Employe();
        $employe1->setNom('Dillon')
            ->setPrenom('Natalie')
            ->setEmail('natalie@driblet.com')
            ->setStatut('CDI')
            ->setDateArrivee(new DateTime('2019-06-14'));
        $manager->persist($employe1);

        $employe2 = new Employe();
        $employe2->setNom('Baker')
            ->setPrenom('Demi')
            ->setEmail('demi@driblet.com')
            ->setStatut('CDD')
            ->setDateArrivee(new DateTime('2022-09-01'));
        $manager->persist($employe2);

        $employe3 = new Employe();
        $employe3->setNom('Dupont')
            ->setPrenom('Marie')
            ->setEmail('marie@driblet.com')
            ->setStatut('Freelance')
            ->setDateArrivee(new DateTime('2021-12-20'));
        $manager->persist($employe3);

        // Création des projets
        $projet1 = new Projet();
        $projet1
            ->setNom('TaskLinker')
            ->setArchive(false)
            ->addEmploye($employe1)
            ->addEmploye($employe2);
        $manager->persist($projet1);

        $projet2 = new Projet();
        $projet2
            ->setNom('Application mobile Grand Nancy')
            ->setArchive(true)
            ->addEmploye($employe2)
            ->addEmploye($employe3);
        $manager->persist($projet2);

        $projet3 = new Projet();
        $projet3
            ->setNom('Site vitrine Les Soeurs Marchand')
            ->setArchive(false)
            ->addEmploye($employe1)
            ->addEmploye($employe3);
        $manager->persist($projet3);

        // Création des tâches
        $tache0 = new Tache();
        $tache0->setTitre('Développement de la structure globale')
            ->setDescription('Intégrer les maquettes')
            ->setStatut($done)
            ->setEmploye($employe2)
            ->setProjet($projet1)
            ->setDeadline((new DateTime())->sub(new DateInterval('P7D')));
        $manager->persist($tache0);

        $tache1 = new Tache();
        $tache1->setTitre('Développement de la page projet')
            ->setDescription('Page projet avec liste des tâches, édition, modification, suppression et création des tâches')
            ->setStatut($done)
            ->setEmploye($employe1)
            ->setProjet($projet1);
        $manager->persist($tache1);

        $tache2 = new Tache();
        $tache2->setTitre('Développement de la page employé')
            ->setDescription('Page employé avec liste des employés, édition, modification, suppression et création des employés')
            ->setStatut($doing)
            ->setEmploye($employe2)
            ->setDeadline((new DateTime())->add(new DateInterval('P4D')))
            ->setProjet($projet1);
        $manager->persist($tache2);

        $tache3 = new Tache();
        $tache3->setTitre('Gestion des droits d\'accès')
            ->setDescription('Un employé ne peut accéder qu\'à ses projets')
            ->setStatut($todo)
            ->setDeadline((new DateTime())->add(new DateInterval('P12D')))
            ->setProjet($projet1);
        $manager->persist($tache3);

        $tache4 = new Tache();
        $tache4->setTitre('Déploiement sur l\'App Store')
            ->setDescription('Vérifier avant que tout fonctionne bien !')
            ->setStatut($todo)
            ->setProjet($projet2);
        $manager->persist($projet2);

        $tache5 = new Tache();
        $tache5->setTitre('Réalisation des maquettes')
            ->setDescription('À faire sur Figma')
            ->setStatut($doing)
            ->setEmploye($employe3)
            ->setDeadline((new DateTime())->sub(new DateInterval('P18D')))
            ->setProjet($projet3);
        $manager->persist($tache5);

        $tache6 = new Tache();
        $tache6->setTitre('Intégration des maquettes')
            ->setDescription('Bien faire attention au responsive')
            ->setStatut($todo)
            ->setEmploye($employe1)
            ->setProjet($projet3);
        $manager->persist($tache6);

        $tache7 = new Tache();
        $tache7->setTitre('Optimisation du référencement')
            ->setStatut($todo)
            ->setDeadline((new DateTime())->sub(new DateInterval('P35D')))
            ->setProjet($projet3);
        $manager->persist($tache7);


        $manager->flush();
    }
}
