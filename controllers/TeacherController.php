<?php
require_once __DIR__ . '/../core\Controller.php';
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../models/TeacherModel.php';

class TeacherController extends Controller
{
    public function dashboard(): void
    {
        require_role('teacher');

        $staff_id = isset($_SESSION['staff_id']) ? (int)$_SESSION['staff_id'] : 0;

        $staff = $staff_id > 0 ? TeacherModel::staffById($staff_id) : null;
        $modules = $staff_id > 0 ? TeacherModel::modulesForStaff($staff_id) : [];
        $programmes = $staff_id > 0 ? TeacherModel::programmesForStaffModules($staff_id) : [];

        $this->view('teacher/dashboard', [
            'page_title' => 'Teacher dashboard',
            'staff' => $staff,
            'modules' => $modules,
            'programmes' => $programmes,
        ]);
    }
}

