<?php

namespace FormationBundle\Controller;

use FormationBundle\Entity\Article;
use FormationBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ArticleController.
 */
class ArticleController extends Controller
{
    /**
     * Create.
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $article = new Article();

        $form = $this->createForm(new ArticleType(), $article);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Votre article a bien été créé.');

            return $this->redirectToRoute('article_show', [
                'id' => $article->getId()
            ]);
        }

        return $this->render('FormationBundle:Article:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Update.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Response
     */
    public function updateAction(Request $request, $id)
    {
        $article = $this
            ->getDoctrine()
            ->getRepository('FormationBundle:Article')
            ->find($id)
        ;

        $form = $this->createForm(new ArticleType(), $article);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Votre article a bien été édité.');

            return $this->redirectToRoute('article_show', [
                'id' => $article->getId()
            ]);
        }

        return $this->render('FormationBundle:Article:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Delete.
     *
     * @param int $id
     *
     * @return Response
     */
    public function deleteAction($id)
    {
        $article = $this
            ->getDoctrine()
            ->getRepository('FormationBundle:Article')
            ->find($id)
        ;

        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        $this->addFlash('success', 'Votre article a bien été supprimé.');

        return $this->redirectToRoute('article_list');
    }

    /**
     * List.
     *
     * @return Response
     */
    public function listAction()
    {
        $articles = $this
            ->getDoctrine()
            ->getRepository('FormationBundle:Article')
            ->findAll()
        ;

        return $this->render('FormationBundle:Article:list.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * Show.
     *
     * @param int $id
     *
     * @return Response
     */
    public function showAction($id)
    {
        $article = $this
            ->getDoctrine()
            ->getRepository('FormationBundle:Article')
            ->find($id)
        ;

        return $this->render('FormationBundle:Article:show.html.twig', [
            'article' => $article
        ]);
    }
}
