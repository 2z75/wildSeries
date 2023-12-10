<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\EpisodeRepository;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\CommentController;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

    return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }

    #[Route('/program/{id}/', name: 'program_show')]
    public function show(Program $program): Response
    {
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table.'
            );
        }
    return $this->render('program.html.twig', ['program'=>$program]);
    }


    #[Route("/{programId}/season/{seasonId}", name: "show_season")]
public function showSeason(ProgramRepository $programRepository, int $programId, SeasonRepository $seasonRepository, int $seasonId, EpisodeRepository $episodeRepository): Response
{
    $program = $programRepository->findOneById($programId);
    $season = $seasonRepository->findOneById($seasonId);
    $episodeBySeason = $episodeRepository->findBySeason($season);

    return $this->render('program/season_show.html.twig', ["program" => $program, 'season' => $season, 'episodes' => $episodeBySeason]);
}

// public function showEpisode(int $id, ProgramRepository $programId, ProgramRepository $seasonId, ProgramRepository $episodeId): Response
// {
//     $episodeSeason = $episodeId->find($id);
//     $episode = $episodeId->find($id);

//     return $this->render('program/season_show.html.twig', ['programSeason' => $programSeason, 'season' => $season, 'episode' => $episode]);
// }
    #[Route("/{programId}/season/{seasonId}/episode", name: "show_episodes")]
public function showEpisode(EpisodeRepository $episode): Response
{
    return $this->render('program/show_episodes.html.twig', [
        'episode' => $episode,
    ]);
}

#[Route('/program/{program_id}/comment/{comment_id}', name: 'program_show_comment')]
public function showProgramComment(
    #[MapEntity(mapping: ['program_id' => 'id'])] Program $program, 
    #[MapEntity(mapping: ['comment_id' => 'id'])] Comment $comment
    ): Response {
    return $this->render('comment.html.twig', [
    'program' => $program,
    'comment' => $comment,
    ]);
}
}