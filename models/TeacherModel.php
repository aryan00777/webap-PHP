<?php
require_once __DIR__ . '/../db.php';

class TeacherModel
{
    public static function staffById(int $staffId): ?array
    {
        $conn = get_db();
        $stmt = $conn->prepare('SELECT StaffID, Name FROM Staff WHERE StaffID = ?');
        $stmt->bind_param('i', $staffId);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public static function modulesForStaff(int $staffId): array
    {
        $conn = get_db();
        $stmt = $conn->prepare(
            'SELECT m.ModuleName, m.Description
             FROM Modules m
             WHERE m.ModuleLeaderID = ?
             ORDER BY m.ModuleName'
        );
        $stmt->bind_param('i', $staffId);
        $stmt->execute();
        $res = $stmt->get_result();
        $rows = $res->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $rows;
    }

    public static function programmesForStaffModules(int $staffId): array
    {
        $conn = get_db();
        $stmt = $conn->prepare(
            'SELECT DISTINCT p.ProgrammeName, l.LevelName
             FROM ProgrammeModules pm
             JOIN Modules m ON pm.ModuleID = m.ModuleID
             JOIN Programmes p ON pm.ProgrammeID = p.ProgrammeID
             LEFT JOIN Levels l ON p.LevelID = l.LevelID
             WHERE m.ModuleLeaderID = ?
             ORDER BY p.LevelID, p.ProgrammeName'
        );
        $stmt->bind_param('i', $staffId);
        $stmt->execute();
        $res = $stmt->get_result();
        $rows = $res->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $rows;
    }
}

