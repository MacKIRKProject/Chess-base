<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Form\ProfileFormType;
use Symfony\Component\HttpFoundation\File\File;


class ProfileController extends Controller
{
    /**
     * @Route("/show/{id}", name="profileShow")
     */
    // La route ne peut pas être /profile/{id} car elle entrerait en conflit avec l'edit, la route /profile est toujours disponible pour accéder à son propre profil.

    public function ShowProfile($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:User')->find($id);

        // $userManager = $this->get('fos_user.user_manager');
        // $user = $userManager->findUserBy(array('id' => $id));
    //     if (!$entity)
    // {
    //     throw $this->createNotFoundException('Unable to find User entity.');
    // }

        return $this->render('bundles/FOSUserBundle/Profile/show.html.twig', array(
            'user' => $user,
        ));
    }



    /**
     * Edit the user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(Request $request, $user)
    {
        
        $user = $this->getUser();
        $currentImage = $user->getProfilePicture();
        if(!empty($currentImage)){
            $imagePath = $this->getParameter('profile_directory') . DIRECTORY_SEPARATOR . $currentImage;
            
            /*
            je remplace la valeur initiale qui contenait uniquement le nom du fichier par un objet du type file
            Attention :  quand je recupere un nom de fichier de la base c'est un objet du type File qui est attendu
            En revanche , quand je créé / upload un nouveau fichier , c'est un objet du type FileUpload qui sera attendu
            */
            $user->setProfilePicture(new File($imagePath) );
            //var_dump(new File($imagePath));die;
        }
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $event = new GetResponseUserEvent($user, $request);
        $this->eventDispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion Avatar
            $picture = $user->getProfilePicture();

            if(!is_null($picture)){
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                $file = $user->getProfilePicture();
                
                //ici ge genere un nom de fichier unique grace a la methode custom generateUniqueFileName+ l'entension que dois avori mon fichier
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('picture_directory'),
                    $fileName
                );
                //derniere etape, je dois stocker non l'objet file mais son nom 
                $user->setProfilePicture($fileName); 
            } else { 
                //si mon picture est null , c'est que je ne souhaite pas changer d'image
                // je recupere donc mon ancienNom de fichier stocké en BDD et non la nouvelle valeur vide envoyé par le formulaire
                $user->setProfilePicture($currentImage); 
            }
            //  Fin Gestion Avatar.
            $event = new FormEvent($form, $request);
            $this->eventDispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $this->userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $this->eventDispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('@FOSUser/Profile/edit.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}