<?php

namespace App\Controllers\Abilities;

class Paginator
{
    private const DEFAULT_CLICKABLE = 7;

    // Properties to store current page, next page, previous page,
    // last page, number of clickable pages, and the range of pages.
    private $current, $next, $previous, $last, $clickable, $range, $perPage;
    
    private $class, $filters, $options, $records, $total;

    // Constructor to initialize the Paginator object.
    public function __construct($current_page, $filters = [], $options = [])
    {
        if(!is_numeric($current_page)){
            $current_page = 1;
        }
        // Ensure that the current page is at least 1.
        $this->current = max(1, $current_page);

        $this->filters = $filters;
        $this->options = $options;

        // Store the number of clickable pages (default is 7).
        $this->clickable = self::DEFAULT_CLICKABLE;
    }

    public function perPage(int $number = null)
    {
        if(!is_null($number)){
            $this->perPage = max(1,$number);
        }

        return $this->perPage;
    }

    public function clickable($number = null)
    {
        if(!is_null($number)){
            $this->clickable = max(1,$number);
        }

        return $this->clickable;
    }

    // Get the current page number.
    public function current($number=null): int
    {
        if(!is_null($number)){
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
        if(!isset($this->last)){
            $this->last = ceil($this->recordCount()/$this->perPage());
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

    public function recordCount(): int
    {
        if(!isset($this->total)){
            $className = $this->class;
            $this->total = $className::count($this->filters, ['eager' => false]);
        }

        return $this->total;
    }

    public function records()
    {
        if(!isset($this->records)){
            $offset = ($this->current()-1) * $this->perPage();
            $className = $this->class;
            $options = array_merge(['limit' => [$this->perPage, $offset]], $this->options);
            $this->records = $className::filter($this->filters, $options);
        }
        
        return $this->records;
    }
}

