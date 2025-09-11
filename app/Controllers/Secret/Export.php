<?php

namespace App\Controllers\Secret;

use \HexMakina\BlackBox\Database\DatabaseInterface;
use App\Models\Export as Model;

class Export extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    /**
     * Presets are defined in a static method because they depend on runtime calls (Model::...).
     */
    public static function presets(): array
    {
        return [
            'movies_complete' => [
                'name' => 'Films avec catégories',
                'query' => Model::movies(),
            ],
            'professionals_complete' => [
                'name' => 'Professionnels avec catégories',
                'query' => Model::professionals(),
            ],
            'organisations_complete' => [
                'name' => 'Organisations avec catégories',
                'query' => Model::organisations(),
            ],
        ];
    }

    public function home(): void
    {
        $database = $this->get(DatabaseInterface::class);
        $tables = $database->connection()->query("SHOW TABLES")->fetchAll(\PDO::FETCH_COLUMN);

        $this->viewport('tables', $tables);
        $this->viewport('presets', self::presets());
    }

    public function csv(): void
    {
        $table = $this->router()->submitted('table');
        $preset = $this->router()->submitted('preset');

        if ($preset && isset(self::presets()[$preset])) {
            $this->exportPreset($preset);
        } elseif ($table) {
            $this->exportTable($table);
        } else {
            $this->router()->hopBack();
        }
    }

    private function exportPreset(string $preset): void
    {
        $config = self::presets()[$preset];
        $database = $this->get(DatabaseInterface::class);

        $filename = $preset . '_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: no-cache, must-revalidate');

        $output = fopen('php://output', 'w');

        $stmt = $database->connection()->prepare($config['query']);
        $stmt->execute();

        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            fputcsv($output, array_keys($row));
            fputcsv($output, $row);

            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                fputcsv($output, $row);
            }
        }

        fclose($output);
        exit;
    }

    private function exportTable(string $table): void
    {
        $database = $this->get(DatabaseInterface::class);

        $tables = $database->connection()->query("SHOW TABLES")->fetchAll(\PDO::FETCH_COLUMN);
        if (!in_array($table, $tables)) {
            $this->router()->hopBack();
        }

        $filename = $table . '_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: no-cache, must-revalidate');

        $output = fopen('php://output', 'w');

        $columns = $database->connection()->query("SHOW COLUMNS FROM `$table`")->fetchAll(\PDO::FETCH_COLUMN);
        fputcsv($output, $columns);

        $stmt = $database->connection()->prepare("SELECT * FROM `$table`");
        $stmt->execute();

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit;
    }
}
