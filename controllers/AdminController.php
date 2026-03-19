<?php
require_once __DIR__ . '/../core\Controller.php';
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../models/AdminModel.php';

class AdminController extends Controller
{
    public function dashboard(): void
    {
        require_role('admin');

        $counts = AdminModel::counts();

        $this->view('admin/dashboard', [
            'page_title' => 'Admin dashboard',
            'counts' => $counts,
        ]);
    }

    public function programmes(): void
    {
        require_role('admin');

        $message = '';
        $error = '';
        $isPost = $_SERVER['REQUEST_METHOD'] === 'POST';

        if ($isPost && isset($_POST['create'])) {
            $name = trim($_POST['ProgrammeName'] ?? '');
            $level_id = (int)($_POST['LevelID'] ?? 0);
            $description = trim($_POST['Description'] ?? '');
            if ($name === '' || $level_id <= 0) {
                $error = 'Programme name and level are required.';
            } elseif (AdminModel::createProgramme($name, $level_id, $description)) {
                $message = 'Programme created.';
            } else {
                $error = 'Could not create programme.';
            }
        }

        if ($isPost && isset($_POST['update'])) {
            $id = (int)($_POST['ProgrammeID'] ?? 0);
            $name = trim($_POST['ProgrammeName'] ?? '');
            $level_id = (int)($_POST['LevelID'] ?? 0);
            $description = trim($_POST['Description'] ?? '');

            if ($id <= 0) {
                $error = 'Invalid programme.';
            } elseif ($name === '' || $level_id <= 0) {
                $error = 'Programme name and level are required.';
            } elseif (AdminModel::updateProgramme($id, $name, $level_id, $description)) {
                $message = 'Programme updated.';
            } else {
                $error = 'Could not update programme.';
            }
        }

        if ($isPost && isset($_POST['delete'])) {
            $id = (int)($_POST['ProgrammeID'] ?? 0);
            if ($id > 0) {
                if (AdminModel::deleteProgramme($id)) {
                    $message = 'Programme deleted.';
                } else {
                    $error = 'Could not delete programme.';
                }
            }
        }

        $levels = AdminModel::levels();
        $programmes = AdminModel::programmes();
        $editProgramme = null;
        $editId = (int)($_GET['edit'] ?? 0);
        if ($editId > 0) {
            foreach ($programmes as $programme) {
                if ((int)$programme['ProgrammeID'] === $editId) {
                    $editProgramme = $programme;
                    break;
                }
            }
            if ($editProgramme === null) {
                $error = 'Programme not found.';
            }
        }

        $this->view('admin/programmes', [
            'page_title' => 'Manage programmes',
            'message' => $message,
            'error' => $error,
            'levels' => $levels,
            'programmes' => $programmes,
            'editProgramme' => $editProgramme,
        ]);
    }

    public function students(): void
    {
        require_role('admin');

        // CSV export stays in controller for simplicity
        if (isset($_GET['export']) && $_GET['export'] === 'csv') {
            $rows = AdminModel::interestedStudents();

            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="interested_students.csv"');

            $output = fopen('php://output', 'w');
            fputcsv($output, ['Programme', 'Student name', 'Email', 'Registered at']);
            foreach ($rows as $row) {
                fputcsv($output, $row);
            }
            fclose($output);
            exit;
        }

        $rows = AdminModel::interestedStudents();

        $this->view('admin/students', [
            'page_title' => 'Mailing list',
            'rows' => $rows,
        ]);
    }

    public function teachers(): void
    {
        require_role('admin');

        $isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
        $message = '';
        $error = '';

        if ($isPost && isset($_POST['create_teacher'])) {
            $name = trim($_POST['teacher_name'] ?? '');
            if ($name === '') {
                $error = 'Teacher name is required.';
            } elseif (AdminModel::createTeacher($name)) {
                $message = 'Teacher created.';
            } else {
                $error = 'Could not create teacher.';
            }
        }

        if ($isPost && isset($_POST['update_teacher'])) {
            $staffId = (int)($_POST['StaffID'] ?? 0);
            $name = trim($_POST['teacher_name'] ?? '');
            if ($staffId <= 0) {
                $error = 'Invalid teacher.';
            } elseif ($name === '') {
                $error = 'Teacher name is required.';
            } elseif (AdminModel::updateTeacher($staffId, $name)) {
                $message = 'Teacher updated.';
            } else {
                $error = 'Could not update teacher.';
            }
        }

        if ($isPost && isset($_POST['delete_teacher'])) {
            $staffId = (int)($_POST['StaffID'] ?? 0);
            if ($staffId <= 0) {
                $error = 'Invalid teacher.';
            } elseif (AdminModel::deleteTeacher($staffId)) {
                $message = 'Teacher deleted (module leadership detached).';
            } else {
                $error = 'Could not delete teacher. It may be referenced by other records.';
            }
        }

        $teachers = AdminModel::teachers();

        $this->view('admin/teachers', [
            'page_title' => 'Manage teachers',
            'message' => $message,
            'error' => $error,
            'teachers' => $teachers,
        ]);
    }

    public function modules(): void
    {
        require_role('admin');

        $isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
        $message = '';
        $error = '';

        if ($isPost && isset($_POST['update_leader'])) {
            $moduleId = (int)($_POST['ModuleID'] ?? 0);
            $staffId = (int)($_POST['ModuleLeaderID'] ?? 0);
            $leader = $staffId > 0 ? $staffId : null;

            if ($moduleId <= 0) {
                $error = 'Invalid module.';
            } elseif (AdminModel::assignModuleLeader($moduleId, $leader)) {
                $message = 'Module leader updated.';
            } else {
                $error = 'Could not update module leader.';
            }
        }

        $modules = AdminModel::modulesForAdmin();
        $teachers = AdminModel::teachers();

        $this->view('admin/modules', [
            'page_title' => 'Assign module leaders',
            'message' => $message,
            'error' => $error,
            'modules' => $modules,
            'teachers' => $teachers,
        ]);
    }
}

