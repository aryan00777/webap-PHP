<?php
require_once __DIR__ . '/../core\Controller.php';
require_once __DIR__ . '/../models/ProgrammeModel.php';

class HomeController extends Controller
{
    public function home(): void
    {
        $funFacts = [
            'Our campus library stores over 120,000 printed and digital resources.',
            'Students from 34 countries currently study with us across all faculties.',
            'The Innovation Lab runs weekly hands-on sessions in AI, media, and robotics.',
        ];

        $this->view('pages/home', [
            'page_title' => 'Tech Hub - Home',
            'funFacts' => $funFacts,
        ]);
    }

    public function index(): void
    {
        $level = $_GET['level'] ?? '';
        $q = trim($_GET['q'] ?? '');

        $programmes = ProgrammeModel::search($level, $q);

        $this->view('student/home', [
            'page_title' => 'Tech Hub - Programmes',
            'level' => $level,
            'q' => $q,
            'programmes' => $programmes,
        ]);
    }

    public function about(): void
    {
        $this->view('pages/about', [
            'page_title' => 'Tech Hub - About',
        ]);
    }

    public function contact(): void
    {
        $this->view('pages/contact', [
            'page_title' => 'Tech Hub - Contact',
        ]);
    }
}

