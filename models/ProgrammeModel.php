<?php
require_once __DIR__ . '/../db.php';

class ProgrammeModel
{
    public static function search(?string $level, string $q): array
    {
        $conn = get_db();

        $params = [];
        $where = [];

        if ($level === 'ug') {
            $where[] = 'p.LevelID = 1';
        } elseif ($level === 'pg') {
            $where[] = 'p.LevelID = 2';
        }

        if ($q !== '') {
            $where[] = 'p.ProgrammeName LIKE ?';
            $params[] = '%' . $q . '%';
        }

        $sql = 'SELECT p.ProgrammeID, p.ProgrammeName, p.Description, l.LevelName, s.Name AS LeaderName
                FROM Programmes p
                LEFT JOIN Levels l ON p.LevelID = l.LevelID
                LEFT JOIN Staff s ON p.ProgrammeLeaderID = s.StaffID';

        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        $sql .= ' ORDER BY p.LevelID, p.ProgrammeName';

        $stmt = $conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function find(int $id): ?array
    {
        $conn = get_db();
        $stmt = $conn->prepare(
            'SELECT p.ProgrammeID, p.ProgrammeName, p.Description, l.LevelName, s.Name AS LeaderName
             FROM Programmes p
             LEFT JOIN Levels l ON p.LevelID = l.LevelID
             LEFT JOIN Staff s ON p.ProgrammeLeaderID = s.StaffID
             WHERE p.ProgrammeID = ?'
        );
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public static function modulesByYear(int $programmeId): array
    {
        $conn = get_db();
        $stmt = $conn->prepare(
            'SELECT pm.Year, m.ModuleName, m.Description, s.Name AS ModuleLeader
             FROM ProgrammeModules pm
             JOIN Modules m ON pm.ModuleID = m.ModuleID
             LEFT JOIN Staff s ON m.ModuleLeaderID = s.StaffID
             WHERE pm.ProgrammeID = ?
             ORDER BY pm.Year, m.ModuleName'
        );
        $stmt->bind_param('i', $programmeId);
        $stmt->execute();
        $res = $stmt->get_result();

        $byYear = [];
        while ($row = $res->fetch_assoc()) {
            $byYear[$row['Year']][] = $row;
        }
        $stmt->close();
        return $byYear;
    }
}

