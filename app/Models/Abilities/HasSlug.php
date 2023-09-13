<?php
namespace App\Models\Abilities;

trait HasSlug
{
    public function slugify($text): string
    {
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');

        $text = mb_strtolower($text, 'UTF-8');

        // Remove unwanted characters
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    
        $text = str_replace(
            ['à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ'],
            ['a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y'],
            $text
        );
    
        // Transliterate any remaining non-ASCII characters
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    
    
        // Trim
        $text = trim($text, '-');
    
        // Remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        if (empty($text)) {
            throw new \Exception(__FUNCTION__.'() returns empty slug');
        }
    
        return $text;
    }
    
    

    public function slug():string
    {
        if(empty($this->get('slug')))
            $this->set('slug', $this->slugify($this->get('label')));

        return $this->get('slug');
    }
}