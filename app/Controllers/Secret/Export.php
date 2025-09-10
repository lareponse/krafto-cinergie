<?php

namespace App\Controllers\Secret;

use \HexMakina\BlackBox\Database\DatabaseInterface;

class Export extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    public function home(): void
    {
        $database = $this->get(DatabaseInterface::class);
        $tables = $database->connection()->query("SHOW TABLES")->fetchAll(\PDO::FETCH_COLUMN);

        $this->viewport('tables', $tables);
    }

    public function csv(): void
    {
        $table = $this->router()->submitted('table');
        if (!$table) {
            $this->router()->hopBack();
        }

        $database = $this->get(DatabaseInterface::class);

        // Validate table exists
        $tables = $database->connection()->query("SHOW TABLES")->fetchAll(\PDO::FETCH_COLUMN);
        if (!in_array($table, $tables)) {
            $this->router()->hopBack();
        }

        $filename = $table . '_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: no-cache, must-revalidate');

        $output = fopen('php://output', 'w');

        // Get columns
        $columns = $database->connection()->query("SHOW COLUMNS FROM `$table`")->fetchAll(\PDO::FETCH_COLUMN);
        fputcsv($output, $columns);

        // Stream data
        $stmt = $database->connection()->prepare("SELECT * FROM `$table`");
        $stmt->execute();

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit;
    }

}
