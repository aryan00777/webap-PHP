<?php
require_once __DIR__ . '/../db.php';

class InterestModel
{
    public static function add(int $programmeId, string $name, string $email): bool
    {
        $conn = get_db();
        $stmt = $conn->prepare(
            'INSERT INTO InterestedStudents (ProgrammeID, StudentName, Email) VALUES (?, ?, ?)'
        );
        $stmt->bind_param('iss', $programmeId, $name, $email);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function byEmail(string $email): array
    {
        $conn = get_db();
        $stmt = $conn->prepare(
            'SELECT i.InterestID, i.RegisteredAt, p.ProgrammeName
             FROM InterestedStudents i
             JOIN Programmes p ON i.ProgrammeID = p.ProgrammeID
             WHERE i.Email = ?
             ORDER BY i.RegisteredAt DESC'
        );
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $res = $stmt->get_result();
        $rows = $res->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $rows;
    }

    public static function delete(int $interestId, string $email): bool
    {
        $conn = get_db();
        $stmt = $conn->prepare(
            'DELETE FROM InterestedStudents WHERE InterestID = ? AND Email = ?'
        );
        $stmt->bind_param('is', $interestId, $email);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

