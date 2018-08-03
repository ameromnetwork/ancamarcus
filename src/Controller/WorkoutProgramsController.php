<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 8/3/2018
 * Time: 3:03 AM.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WorkoutProgramsController extends AbstractController
{
    /**
     * @Route("/workout-programs", name="workout_programs_index")
     */
    public function index()
    {
        return $this->render('WorkoutPrograms/index.html.twig');
    }
}
