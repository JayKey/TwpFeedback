<?php

namespace Twp\Bundle\IdeaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Twp\Entity\Idea;

class IdeaController extends Controller
{
    public function addAction(Idea $idea, $votes)
    {
        $em = $this->getDoctrine()->getManager();
        // TODO: setUser
        $em->persist($idea);
        $em->flush();
        
        $this->voteAction($idea->getId(), $votes);
        
        return $this->redirect($this->generateUrl('idea_show', array('id' => $idea->getId())));
    }
    
    /**
     * @Route("/idea/{id}", name="idea_show", requirements={"id" = "\d+"})
     * @Template()
     */
    public function showAction($id)
    {
        $idea = $this->getDoctrine()->getRepository('Twp:Idea')->findOneWthComments($id);
        
        $commentForm = $this->get('commentController')->formAction();
        
        if($this->getRequest()->isMethod('POST'))
        {
            $commentForm->bind($this->getRequest());
            if ($commentForm->isValid()) 
            {
                $commentForm->getData()->setIdea($idea);
                $this->get('commentController')->addAction($commentForm->getData());
                return $this->redirect($this->generateUrl('idea_show', array('id' => $id)));
            }
        }
        
        return array('idea' => $idea, 'commentForm' => $commentForm->createView());
    }
    
    /**
     * @Route("/idea")
     * @Template()
     */
    public function listAction()
    {
        return array('ideas' => $this->getDoctrine()->getRepository('Twp:Idea')->findAll());
    }
    
    /**
     * @Route("/idea/{id}/vote/{votes}", requirements={"id" = "\d+", "votes" = "[1-3]"}, name="idea_vote")
     */
    public function voteAction($id, $votes)
    {
        if(!$votes)
        {
            throw new \Exception('Trying to add 0 votes');
        }
        
        $idea = $this->getDoctrine()->getRepository('Twp:Idea')->findOneById($id);
        
        if(!$idea)
        {
            throw $this->createNotFoundException('Idea not found');
        }
        
        return $this->redirect($this->generateUrl('idea_show', array('id' => $id)));
    }
}
