<?php

namespace App\Models\Abilities;

use PHPUnit\Framework\TestCase;

class SlugTest extends TestCase
{
    public function testSimpleStringConversion()
    {
        $input = "Hello World";
        $expected = "hello-world";
        $result = Slug::slugify($input);
        $this->assertEquals($expected, $result);
    }
    public function testSlugifyRemovesSpecialCharacters()
    {
        $input = 'This is a test! With @special# characters & symbols?';
        $expected = 'this-is-a-test-with-special-characters-symbols';
        
        $result = Slug::slugify($input);
        
        $this->assertEquals($expected, $result);
    }
    public function testReplacesAccentedCharacters()
    {
        $input = 'éàçñöü';
        $expected = 'eacnou';
        $result = Slug::slugify($input);
        $this->assertEquals($expected, $result);
    }
    public function testSlugifyTransliteratesNonAsciiCharacters()
    {
        $input = 'Æther Røuge Ñandú';
        $expected = 'aether-rouge-nandu';
        
        $result = Slug::slugify($input);
        
        $this->assertEquals($expected, $result);
    }
    public function testSlugifyTrimsHyphensFromStartAndEnd()
    {
        $input = '---test-slug---';
        $expected = 'test-slug';
        $result = Slug::slugify($input);
        $this->assertEquals($expected, $result);
    }
    public function testSlugifyReplacesMultipleHyphensWithSingleHyphen()
    {
        $input = 'multiple---consecutive----hyphens';
        $expected = 'multiple-consecutive-hyphens';
        $result = Slug::slugify($input);
        $this->assertEquals($expected, $result, 'Multiple consecutive hyphens should be replaced with a single hyphen');
    }
    public function testThrowsExceptionWhenSlugIsEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Slug::__construct:EMPTY_SLUG');
    
        new Slug('   ');
    }
    public function testSlugifyHandlesHtmlEntities()
    {
        $input = 'Test &amp; Example &lt;strong&gt;HTML&lt;/strong&gt;';
        $expected = 'test-example-html';
        $result = Slug::slugify($input);
        $this->assertEquals($expected, $result);
    }
    public function testSlugifyWithAccentedCharacters()
    {
        $inputs = [
            'áéíóú',
            'àèìòù',
            'âêîôû',
            'ãõñ',
            'äëïöü',
            'åø',
            'ç',
            'ý',
            'ÿ'
        ];
    
        $expectedSlug = 'aeiou-aeiou-aeiou-aon-aeiou-ao-c-y-y';
    
        foreach ($inputs as $input) {
            $this->assertEquals($expectedSlug, Slug::slugify($input));
        }
    }
    public function testHandleLongInputString()
    {
        $longInput = str_repeat("This is a very long string with special characters: !@#$%^&*() ", 10);
        $expectedSlug = str_repeat("this-is-a-very-long-string-with-special-characters-", 10);
        $expectedSlug = rtrim($expectedSlug, '-');
    
        $slug = new Slug($longInput);
    
        $this->assertEquals($expectedSlug, (string)$slug);
        $this->assertLessThanOrEqual(255, strlen((string)$slug)); // Ensure the slug is not excessively long
    }

    public function testTransliterationOfNonAsciiCharacters()
    {
        $input = '��ther Røuge ��andú';
        $expected = 'Aether Rouge Nandu';
        $result = Slug::slugify($input);
        $this->assertEquals($expected, $result);
    }

    public function testTransliterationOfNonAsciiCharactersWithAccents()
    {
        $input = 'éçñöü';
        $expected = 'ecnou';
        $result = Slug::slugify($input);
        $this->assertEquals($expected, $result);
    }

    public function testTransliterationOfNonAsciiCharactersWithSpecialCharacters()
    {
        $input = '��ther Røuge ��andú';
        $expected = 'Aether Rouge Nandu';
        $result = Slug::slugify($input);
        $this->assertEquals($expected, $result);
    }
}
