<?php

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    /* ---------- password policy ---------- */
    public static function passwordMeetsPolicy(string $p): bool
    {
        return strlen($p) >= 8
            && preg_match('/[A-Z]/', $p)
            && preg_match('/[a-z]/', $p)
            && preg_match('/\d/',    $p)
            && preg_match('/[^A-Za-z0-9]/', $p);
    }

    /* ---------- registration ---------- */
    public function register(string $u, string $p): void
    {
        $sql = "INSERT INTO users (username, password_hash) VALUES (?, ?)";
        $this->db->prepare($sql)
                 ->execute([strtolower($u), password_hash($p, PASSWORD_DEFAULT)]);
    }

    /* ---------- authentication ---------- */
    public function authenticate(string $u, string $p): bool
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE username = ?"
        );
        $stmt->execute([strtolower($u)]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);       // ← now on stmt object

        $ok = $row && password_verify($p, $row['password_hash']);
        $this->logAttempt($u, $ok ? 'good' : 'bad');
        return $ok;
    }/* ---------- lock-out (3 bad in 60 s) ---------- */
    public function lockedOut(string $u): bool
    {
        $stmt = $this->db->prepare(
            "SELECT outcome, created_at
               FROM log
              WHERE username = ?
           ORDER BY id DESC
              LIMIT 3"
        );
        $stmt->execute([strtolower($u)]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);   // ← stmt object

        if (count($rows) < 3) return false;

        $allBad   = array_reduce($rows,
                     fn($c,$r)=>$c && $r['outcome']==='bad', true);
        $within60 = time() - strtotime($rows[0]['created_at']) < 60;

        return $allBad && $within60;
    }

    /* ---------- private helper ---------- */
    private function logAttempt(string $u,string $out): void
    {
        $this->db
            ->prepare("INSERT INTO log(username,outcome) VALUES(?,?)")
            ->execute([strtolower($u), $out]);
    }
}
