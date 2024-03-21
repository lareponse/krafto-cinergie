<?php

namespace App\Controllers\Open;

use League\Plates\Template\Template;
use HexMakina\LocalFS\FileSystem;

use App\Models\Page;

abstract class Kortex extends \HexMakina\kadro\Controllers\Kadro
{
    protected $template = null;
    protected $pageSlug = null;
    protected $page = null;
    protected $record = null;
    protected $section = null;

    public function requiresOperator(): bool
    {
        return false;
    }

    public function prepare(): void
    {
        parent::prepare();
        if($this->router()->params('slug'))
        {
            $className = 'App\\Models\\'.(new \ReflectionClass(static::class))->getShortName();
            $this->record = $className::exists('slug', $this->router()->params('slug'));
        }
    }

    public function conclude(): void
    {
        $this->viewport('page', $this->page());
        $this->viewport('record', $this->record());
        $this->viewport('CSP_nonce', $this->get('settings.app.CSP_nonce'));
        


        if (is_null($this->template)) {
            $fallback = 'Open::' . $this->nid() . DIRECTORY_SEPARATOR . $this->router()->targetMethod();
            $this->template = $fallback;
        }
        
        echo $this->headers();
        echo $this->display($this->template);

        parent::conclude();
        die;
    }

    public function hasRecord(): bool
    {
        return isset($this->record);
    }

    public function hasPage(): bool
    {
        return isset($this->page);
    }

    public function record()
    {
        if(!isset($this->record) && $this->router()->params('slug')){
            $className = 'App\\Models\\'.(new \ReflectionClass(static::class))->getShortName();
            $this->record = $className::exists('slug', $this->router()->params('slug'));
        }
        return $this->record;
    }

    public function page()
    {
        if(!isset($this->page)){
            if(!isset($this->pageSlug)){
                $this->pageSlug= $this->router()->targetMethod();
            }

            $this->page = Page::exists(['slug' => $this->pageSlug]);
        }
        return $this->page;
    }

    public function activeSection(): string
    {
        return $this->nid();
    }

    public function activeLink(): string
    {
        return $this->nid();
    }

    public function setTemplate($template): void
    {
        $this->template = $template;
    }

    public function meta($prop) : string
    {
        switch($prop){
            case 'type': 
                return $this->hasRecord()? 'article' : 'website';

            case 'url': 
                return $this->router()->url();

            case 'title':
                if($this->hasRecord()) return $this->record()->__toString();
                if($this->hasPage()) return $this->page()->label();
                break;

            case 'description':
                if($this->hasRecord()) return $this->record->__toString();
                if($this->hasPage()) return $this->page->label();
                break;

            case 'image':
                return $this->router()->webHost().$this->get('settings.kortex.meta.image');

        }
        return $this->get('settings.app.name');
    }

    public function relatedPhotos(string $type): array
    {
        $slug = $this->record()->slug();
        $letter = $slug[0];
        $directory = sprintf('%s/_%s/%s', $type, $letter, $slug);
        $path = sprintf('%s/%s', $this->get('settings.folders.images'), $directory);

        $urls = [];

        if(file_exists($path)){
            $fs = new FileSystem($path);
            foreach($fs->filenames() as $filename){
                if($filename === '.' || $filename == '..')
                    continue;
        
                // $names []= sprintf('%s/%s/%s', $this->get('settings.urls.images'), $directory, $filename);
                $urls []= sprintf('%s/%s/%s', $this->get('settings.urls.images'), $directory, $filename);
            }
        }
        return $urls;
    }

    protected function freeSearchFor($term, $fields, $query)
    {
        $bindname = $query->addBinding('labelSearch', '%'.$term.'%');
        $orConditions = [];
        foreach($fields as $searchField){
            $searchField = $query->backTick($searchField);
            $orConditions[]= "$searchField LIKE $bindname";
        }
        $query->whereWithBind(implode(' OR ', $orConditions));
        
        $orderCase = 'CASE ';
        foreach($fields as $order => $field){
            $orderCase .= sprintf(PHP_EOL.'WHEN %s LIKE %s THEN %d ', $query->backTick($field), $bindname, $order+1);
        }
        $orderCase .= PHP_EOL.'END';
        $query->orderBy($orderCase);
        $query->selectAlso($fields);

        if(!empty($query->clause('group'))){
            foreach($fields as $field){
                $query->addClause('group', $field);
            }
        }

        return $query;
    }
    
    public function captureClient(): string
    {
        // Initialize an empty array to hold the captured information
        $clientInfo = array();

        // List of relevant $_SERVER keys
        $relevant_keys = array(
            'REMOTE_ADDR', 
            'HTTP_USER_AGENT', 
            'HTTP_ACCEPT', 
            'HTTP_ACCEPT_LANGUAGE', 
            'HTTP_ACCEPT_ENCODING', 
            'HTTP_CONNECTION', 
            'HTTP_REFERER', 
            'REMOTE_PORT', 
            'REMOTE_HOST', 
            'HTTPS'
        );

        // Loop through the list and capture available data
        foreach($relevant_keys as $key) {
            $clientInfo[$key] = $_SERVER[$key] ?? null;
        }

        // Convert the array to a JSON object
        $jsonData = json_encode($clientInfo, JSON_PRETTY_PRINT);

        return $jsonData;
    }
}
