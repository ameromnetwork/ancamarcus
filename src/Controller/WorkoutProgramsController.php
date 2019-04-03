<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WorkoutProgramsController.
 */
class WorkoutProgramsController extends AbstractController
{
    /**
     * @Route("/workout-programs", name="workout_programs_index")
     */
    public function index() {
        return $this->render('WorkoutPrograms/index.html.twig');
    }
	
	/**
	 * @Route("/programs/6-weeks-bikini-body-workout-program", name="bikini_body_workout")
	 */
    public function BikiniBodyWorkout() {
        return $this->redirect('https://school.ancamarcusfit.com/courses/6-weeks-bikini-body-workout-program', 301);
    }
	
    /**
	 * @Route("/programs/fit-pregnancy-workout-program", name="fit_pregnancy_workout")
	 */
	public function FitPregnancyWorkout() {
		return $this->redirect('https://school.ancamarcusfit.com/courses/fit-pregnancy-workout-program', 301);
	}
	
	/**
	 * @Route("/programs/the-fit-diet", name="fit_diet")
	 */
	public function FitDiet() {
		return $this->redirect('https://school.ancamarcusfit.com/courses/the-fit-diet', 301);
	}
}
