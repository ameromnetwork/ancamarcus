<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 8/3/2018
 * Time: 3:03 AM.
 */

namespace App\Controller;

use App\Repository\WorkoutProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WorkoutProgramsController extends AbstractController
{
    /**
     * @Route("/workout-programs", name="workout_programs_index")
     */
    public function index(WorkoutProgramRepository $workoutProgramRepository)
    {
        $workouts = $workoutProgramRepository->findBy([
            'parent' => null,
        ]);

        return $this->render('WorkoutPrograms/index.html.twig', \compact('workouts'));
    }
}
