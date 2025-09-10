<?php

namespace App\Controllers\Secret;

use \HexMakina\BlackBox\Database\DatabaseInterface;

class Export extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    private array $presets = [
        'movies_complete' => [
            'name' => 'Movies with Relations',
            'query' => '
                SELECT 
                    m.*,
                    GROUP_CONCAT(DISTINCT CONCAT(p.firstname, " ", p.lastname, " (", pt.label, ")") SEPARATOR "; ") as professionals,
                    GROUP_CONCAT(DISTINCT CONCAT(o.label, " (", ot.label, ")") SEPARATOR "; ") as organisations,
                    GROUP_CONCAT(DISTINCT a.label SEPARATOR "; ") as articles
                FROM movie m
                LEFT JOIN movie_professional mp ON m.id = mp.movie_id
                LEFT JOIN professional p ON mp.professional_id = p.id
                LEFT JOIN tag pt ON mp.praxis_id = pt.id
                LEFT JOIN movie_organisation mo ON m.id = mo.movie_id
                LEFT JOIN organisation o ON mo.organisation_id = o.id
                LEFT JOIN tag ot ON mo.praxis_id = ot.id
                LEFT JOIN article_movie am ON m.id = am.movie_id
                LEFT JOIN article a ON am.article_id = a.id
                GROUP BY m.id
            '
        ],
        'professionals_complete' => [
            'name' => 'Professionals with Relations',
            'query' => '
                SELECT 
                    p.*,
                    GROUP_CONCAT(DISTINCT CONCAT(m.label, " (", pt.label, ")") SEPARATOR "; ") as movies,
                    GROUP_CONCAT(DISTINCT o.label SEPARATOR "; ") as organisations,
                    GROUP_CONCAT(DISTINCT a.label SEPARATOR "; ") as articles
                FROM professional p
                LEFT JOIN movie_professional mp ON p.id = mp.professional_id
                LEFT JOIN movie m ON mp.movie_id = m.id
                LEFT JOIN tag pt ON mp.praxis_id = pt.id
                LEFT JOIN organisation_professional op ON p.id = op.professional_id
                LEFT JOIN organisation o ON op.organisation_id = o.id
                LEFT JOIN article_professional ap ON p.id = ap.professional_id
                LEFT JOIN article a ON ap.article_id = a.id
                GROUP BY p.id
            '
        ],
        'articles_complete' => [
            'name' => 'Articles with Relations',
            'query' => '
                SELECT 
                    a.*,
                    GROUP_CONCAT(DISTINCT m.label SEPARATOR "; ") as movies,
                    GROUP_CONCAT(DISTINCT CONCAT(p.firstname, " ", p.lastname) SEPARATOR "; ") as professionals,
                    GROUP_CONCAT(DISTINCT o.label SEPARATOR "; ") as organisations
                FROM article a
                LEFT JOIN article_movie am ON a.id = am.article_id
                LEFT JOIN movie m ON am.movie_id = m.id
                LEFT JOIN article_professional ap ON a.id = ap.article_id
                LEFT JOIN professional p ON ap.professional_id = p.id
                LEFT JOIN article_organisation ao ON a.id = ao.article_id
                LEFT JOIN organisation o ON ao.organisation_id = o.id
                GROUP BY a.id
            '
        ]
    ];

    public function home(): void
    {
        $database = $this->get(DatabaseInterface::class);
        $tables = $database->connection()->query("SHOW TABLES")->fetchAll(\PDO::FETCH_COLUMN);

        $this->viewport('tables', $tables);
        $this->viewport('presets', $this->presets);
    }

    public function csv(): void
    {
        $table = $this->router()->submitted('table');
        $preset = $this->router()->submitted('preset');

        if ($preset && isset($this->presets[$preset])) {
            $this->exportPreset($preset);
        } elseif ($table) {
            $this->exportTable($table);
        } else {
            $this->router()->hopBack();
        }
    }

    private function exportPreset(string $preset): void
    {
        $config = $this->presets[$preset];
        $database = $this->get(DatabaseInterface::class);

        $filename = $preset . '_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: no-cache, must-revalidate');

        $output = fopen('php://output', 'w');

        $stmt = $database->connection()->prepare($config['query']);
        $stmt->execute();

        // Write headers from first row
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