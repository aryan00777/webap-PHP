<?php
require_once __DIR__ . '/../core\Controller.php';
require_once __DIR__ . '/../models/ProgrammeModel.php';
require_once __DIR__ . '/../models/InterestModel.php';

class StudentController extends Controller
{
    public function programme(): void
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        $interest_message = '';
        $interest_error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_interest'])) {
            $student_name = trim($_POST['student_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            if ($student_name === '' || $email === '') {
                $interest_error = 'Please provide both your name and email.';
            } else {
                if (InterestModel::add($id, $student_name, $email)) {
                    $interest_message = 'Thank you. Your interest has been registered.';
                } else {
                    $interest_error = 'Sorry, there was a problem. Please try again.';
                }
            }
        }

        $programme = ProgrammeModel::find($id);
        if (!$programme) {
            http_response_code(404);
            echo 'Programme not found';
            return;
        }

        $modules_by_year = ProgrammeModel::modulesByYear($id);

        $this->view('student/programme', [
            'page_title' => $programme['ProgrammeName'],
            'programme' => $programme,
            'modules_by_year' => $modules_by_year,
            'interest_message' => $interest_message,
            'interest_error' => $interest_error,
        ]);
    }

    public function interests(): void
    {
        $email = '';
        $interests = [];
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lookup'])) {
            $email = trim($_POST['email'] ?? '');
            if ($email !== '') {
                $interests = InterestModel::byEmail($email);
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['withdraw'])) {
            $interest_id = (int)($_POST['interest_id'] ?? 0);
            $email = trim($_POST['email'] ?? '');
            if ($interest_id > 0 && $email !== '') {
                if (InterestModel::delete($interest_id, $email)) {
                    $message = 'Your interest has been withdrawn.';
                }
                $interests = InterestModel::byEmail($email);
            }
        }

        $this->view('student/interests', [
            'page_title' => 'My Interests',
            'email' => $email,
            'interests' => $interests,
            'message' => $message,
        ]);
    }
}

