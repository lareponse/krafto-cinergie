<?php

namespace App\Models\Abilities;

class Slug
{
    private string $slug;

    public function __construct($_)
    {
        $_ = self::slugify($_);

        if (empty($_)) throw new \InvalidArgumentException('SOURCE_MAKES_EMPTY_SLUG');

        $this->slug = $_;
    }

    public function __toString()
    {
        return $this->slug;
    }

    /**
     * Converts a string into a URL-friendly slug.
     *
     * This function performs the following operations:
     * - Decodes HTML entities
     * - Converts to lowercase
     * - Removes special characters
     * - Replaces accented characters with their non-accented equivalents
     * - Transliterates remaining non-ASCII characters
     * - Trims hyphens from start and end
     * - Replaces multiple hyphens with a single hyphen
     *
     * @param string $_ The input string to be converted into a slug
     * @return string The generated slug
     * @throws \InvalidArgumentException If the resulting slug is empty
     */
    public static function slugify(string $_): string
    {
        $_ = html_entity_decode($_, ENT_QUOTES, 'UTF-8');

        $_ = mb_strtolower($_, 'UTF-8');

        // Remove unwanted characters
        $_ = preg_replace('~[^\p{L}\p{N}]+~u', '-', $_);

        $_ = strtr($_, [
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ý' => 'y',
            'ÿ' => 'y'
        ]);

        // Transliterate any remaining non-ASCII characters
        $_ = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $_);

        // Trim
        $_ = trim($_, '-');

        // Remove duplicate -
        $_ = preg_replace('~-+~', '-', $_);

        return $_;
    }
}
