<?php
require_once __DIR__ . '/../db.php';

class AdminModel
{
    public static function teachers(): array
    {
        $conn = get_db();
        $sql = 'SELECT StaffID, Name FROM Staff ORDER BY Name';
        $res = $conn->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function createTeacher(string $name): bool
    {
        $name = trim($name);
        if ($name === '') {
            return false;
        }

        $conn = get_db();
        $stmt = $conn->prepare('INSERT INTO Staff (Name) VALUES (?)');
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('s', $name);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function deleteTeacher(int $staffId): bool
    {
        if ($staffId <= 0) {
            return false;
        }

        $conn = get_db();
        $conn->begin_transaction();
        try {
            // Detach teacher from any modules/programme leadership.
            $stmt1 = $conn->prepare('UPDATE Modules SET ModuleLeaderID = NULL WHERE ModuleLeaderID = ?');
            $stmt1->bind_param('i', $staffId);
            $stmt1->execute();
            $stmt1->close();

            $stmt2 = $conn->prepare('UPDATE Programmes SET ProgrammeLeaderID = NULL WHERE ProgrammeLeaderID = ?');
            $stmt2->bind_param('i', $staffId);
            $stmt2->execute();
            $stmt2->close();

            $stmt3 = $conn->prepare('DELETE FROM Staff WHERE StaffID = ?');
            $stmt3->bind_param('i', $staffId);
            $stmt3->execute();
            $stmt3->close();

            $conn->commit();
            return true;
        } catch (Throwable $e) {
            $conn->rollback();
            return false;
        }
    }

    public static function updateTeacher(int $staffId, string $name): bool
    {
        $name = trim($name);
        if ($staffId <= 0 || $name === '') {
            return false;
        }

        $conn = get_db();
        $stmt = $conn->prepare('UPDATE Staff SET Name = ? WHERE StaffID = ?');
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('si', $name, $staffId);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function modulesForAdmin(): array
    {
        $conn = get_db();
        $sql = 'SELECT m.ModuleID, m.ModuleName, m.Description, m.ModuleLeaderID, s.Name AS ModuleLeader
                FROM Modules m
                LEFT JOIN Staff s ON m.ModuleLeaderID = s.StaffID
                ORDER BY m.ModuleName';
        $res = $conn->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function assignModuleLeader(int $moduleId, ?int $staffId): bool
    {
        if ($moduleId <= 0) {
            return false;
        }

        $conn = get_db();

        if ($staffId === null) {
            $stmt = $conn->prepare('UPDATE Modules SET ModuleLeaderID = NULL WHERE ModuleID = ?');
            $stmt->bind_param('i', $moduleId);
            $ok = $stmt->execute();
            $stmt->close();
            return $ok;
        }

        if ($staffId <= 0) {
            return false;
        }

        $stmt = $conn->prepare('UPDATE Modules SET ModuleLeaderID = ? WHERE ModuleID = ?');
        $stmt->bind_param('ii', $staffId, $moduleId);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function counts(): array
    {
        $conn = get_db();
        $out = ['programmes' => 0, 'modules' => 0, 'interests' => 0];
        foreach (['Programmes' => 'programmes', 'Modules' => 'modules', 'InterestedStudents' => 'interests'] as $table => $key) {
            $res = $conn->query('SELECT COUNT(*) AS c FROM ' . $table);
            if ($res) {
                $row = $res->fetch_assoc();
                $out[$key] = (int)$row['c'];
            }
        }
        return $out;
    }

    public static function levels(): array
    {
        $conn = get_db();
        $levels = [];
        $res = $conn->query('SELECT LevelID, LevelName FROM Levels ORDER BY LevelID');
        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $levels[$row['LevelID']] = $row['LevelName'];
            }
        }
        return $levels;
    }

    public static function programmes(): array
    {
        $conn = get_db();
        $sql = 'SELECT p.ProgrammeID, p.ProgrammeName, p.LevelID, p.Description, l.LevelName
                FROM Programmes p
                LEFT JOIN Levels l ON p.LevelID = l.LevelID
                ORDER BY p.LevelID, p.ProgrammeName';
        $res = $conn->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function createProgramme(string $name, int $levelId, string $description): bool
    {
        $conn = get_db();
        $stmt = $conn->prepare(
            'INSERT INTO Programmes (ProgrammeName, LevelID, Description) VALUES (?, ?, ?)'
        );
        $stmt->bind_param('sis', $name, $levelId, $description);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function updateProgramme(int $id, string $name, int $levelId, string $description): bool
    {
        $name = trim($name);
        if ($id <= 0 || $name === '' || $levelId <= 0) {
            return false;
        }

        $conn = get_db();
        $stmt = $conn->prepare(
            'UPDATE Programmes
             SET ProgrammeName = ?, LevelID = ?, Description = ?
             WHERE ProgrammeID = ?'
        );
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('sisi', $name, $levelId, $description, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function deleteProgramme(int $id): bool
    {
        $conn = get_db();
        $stmt = $conn->prepare('DELETE FROM Programmes WHERE ProgrammeID = ?');
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function interestedStudents(): array
    {
        $conn = get_db();
        $sql = 'SELECT p.ProgrammeName, i.StudentName, i.Email, i.RegisteredAt
                FROM InterestedStudents i
                JOIN Programmes p ON i.ProgrammeID = p.ProgrammeID
                ORDER BY i.RegisteredAt DESC';
        $res = $conn->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }
}

