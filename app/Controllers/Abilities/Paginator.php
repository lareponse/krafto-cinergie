<?php

namespace App\Controllers\Abilities;

use HexMakina\BlackBox\Database\SelectInterface;

class Paginator
{
    private const DEFAULT_CLICKABLE = 7;

    // Properties to store current page, next page, previous page,
    // last page, number of clickable pages, and the range of pages.
    private $current, $next, $previous, $last, $clickable, $range, $perPage, $offset;

    private $class, $records, $total;

    private $query;

    // Constructor to initialize the Paginator object.
    public function __construct(int $current_page, SelectInterface $query, $total = 100)
    {
        $this->current = max(1, $current_page);

        $this->query = $query;
        $this->total = $this->totalRecords();

        // Store the number of clickable pages (default is 7).
        $this->clickable = self::DEFAULT_CLICKABLE;
    }

    public function offset(): int
    {
        if (!isset($this->offset)) {
            $this->offset = ($this->current() - 1) * $this->perPage();
        }

        return $this->offset;
    }

    public function perPage(int $number = null)
    {
        if (!is_null($number)) {
            $this->perPage = max(1, $number);
        }

        return $this->perPage;
    }

    public function clickable($number = null)
    {
        if (!is_null($number)) {
            $this->clickable = max(1, $number);
        }

        return $this->clickable;
    }

    // Get the current page number.
    public function current($number = null): int
    {
        if (!is_null($number)) {
            $this->current = $number;
        }

        return $this->current ?? 1;
    }

    // Get the next page number.
    public function next(): int
    {
        // Calculate the next page, limiting it to the last page.
        if (!isset($this->next)) {
            $this->next = min($this->current() + 1, $this->last);
        }

        return $this->next ?? 2;
    }

    // Get the previous page number.
    public function previous(): int
    {
        // Calculate the previous page, ensuring it is at least 1.
        if (!isset($this->previous)) {
            $this->previous = max($this->current() - 1, 1);
        }

        return $this->previous ?? 1;
    }

    // Get the last page number.
    public function last(): int
    {
        if (!isset($this->last)) {
            $this->last = ceil($this->totalRecords() / $this->perPage());
        }
        return $this->last;
    }

    // Get an array representing the range of clickable pages.
    public function range(): array
    {
        // Calculate the range of clickable pages based on the current page
        // and the number of clickable pages allowed.
        if (!isset($this->range)) {
            $range_start = max(1, $this->current() - floor($this->clickable() / 2));
            $range_stop = min($this->last(), $range_start + $this->clickable() - 1);

            // Generate an array containing the range of clickable pages.
            $this->range = range($range_start, $range_stop);
        }

        return $this->range;
    }

    // Check if there is a spacer before the first page.
    public function hasFirstSpacer(): bool
    {
        // Check if page 1 is not in the range of clickable pages.
        return !in_array(1, $this->range());
    }

    // Check if there is a spacer after the last page.
    public function hasLastSpacer(): bool
    {
        // Check if the last page is not in the range of clickable pages.
        return !in_array($this->last(), $this->range());
    }

    public function setClass(string $name)
    {
        $this->class = $name;
    }

    public function totalRecords(): int
    {
        if (!isset($this->total)) {
            $counter = clone $this->query;

            $counter->setClause('orderBy', null);
            
            $sql = sprintf('SELECT COUNT(*) FROM (%s) as subquery', $counter->statement());
            
            $res = $this->query->connection()->prepare($sql);

            if ($res->execute($counter->getBindings())) {
                $res = $res->fetch(\PDO::FETCH_NUM);
      
                $this->total = (int)$res[0];
            } else {
                $this->total = 0;
            }
        }

        return $this->total;
    }

    public function records(): array
    {
        if (!isset($this->records)) {

            $this->query->limit($this->perPage, $this->offset());
            $this->records = $this->query->retObj($this->class);
        }
        return $this->records;
    }

    public function nowShowing(): array
    {
        if($this->totalRecords() === 0){
            return [0,0,0];
        }
        
        $start = $this->offset() + 1;
        $last = min($this->offset() + $this->perPage(), $this->totalRecords());

        return [$start, $last, $this->totalRecords()];
    }
}
