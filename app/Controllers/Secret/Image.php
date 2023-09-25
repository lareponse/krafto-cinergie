<?php

namespace App\Controllers\Secret;

use App\Models\Article;

class Image extends Krafto
{
    private $queries = [];

    public function home()
    {

    }

    public function deadlinks()
    {
        $articles = Article::queryListing();
        // $articles->columns(['article.id, article.label, article.content, article.slug, article.legacy_id']);
        $articles->selectAlso(['article.content', 'article.id']);
        $articles->whereLike('content', '%src="%');
        // $articles->limit(100,0);
        $articles->orderBy('id DESC');
        $articles = $articles->retObj(Article::class);

        $errors = [];
        $countErrors = 0;
        $articleWithErrors = [];
        foreach ($articles as $article) {
            $html = $article->get('content');
            if (!empty($html)) {
                $res = $this->verifyImagesInHTML($html, $article);
                if(!empty($res)){
                    $articleWithErrors[$article->getID()] = $article;
                    $errors[$article->getID()] = $res;
                    $countErrors += count($res);
                }
            }
        }
        $this->viewport('articleWithErrors', $articleWithErrors);
        $this->viewport('errorsByArticle', $errors);
        $this->viewport('countErrors', $countErrors);
    }

    // Function to verify image URIs in HTML content
    private function verifyImagesInHTML($html, $article): array
    {
        $articleId = $article->getID();
        $errors = [];
        // Use regular expression to find image URLs in HTML content
        $pattern = '/<img[^>]+src="([^"]+)"/';

        $errors = [];
        if (preg_match_all($pattern, $html, $matches)) {
            $imageUrls = $matches[1];
            foreach ($imageUrls as $imgUrl) {
                if (strpos($imgUrl, 'data:image') === 0) {
                    $errors []= "$articleId has data:image";
                    continue;
                }

                $imgUrl = html_entity_decode($imgUrl);

                $headers = $this->getHeaders($imgUrl);
                $status = $this->checkStatusCode($headers);
                if ($status === 200) {
                    continue;
                }

                if ($status === 301) {
                    $redirectUrl = $headers["Location"];
                    $headers = $this->getHeaders($redirectUrl);
                    $redirectStatus = $this->checkStatusCode($headers);
                
                    if ($redirectStatus !== 200) {
                        $errors[]= "301 > $redirectStatus $redirectUrl";
                    }

                    continue;
                }

                // if (strpos($imgUrl, '/images/personne/') === 0 || strpos($imgUrl, '/images/film/') === 0) {
                //     $this->generateCorrectionQuery($imgUrl);
                // }
                $errors []= "$status $imgUrl";

            }
        }

        return $errors;
    }

    // Function to check the status code of a URL
    private function checkStatusCode($headers)
    {
        return (int) substr($headers[0], 9, 3); // Extract status code (e.g., 200, 301)
    }

    private function getHeaders($path, $host = 'http://dev.cinergie'): array
    {
        // Check if $path starts with 'http://' or 'https://'
        if (strpos($path, 'http') !== 0)
            $path = $host . $path;

        try {
            $headers = get_headers($path, true);
            return $headers;
        } catch (\Throwable $t) {
            dd($t);
        }
    }

    private function generateCorrectionQuery($imgUrl)
    {
        $root = '/var/www/dev.engine/krafto-cinergie/public';
        // echo(PHP_EOL."ISSUE WITH $imgUrl");
        $fix = null;

        $parts = pathinfo($imgUrl);
        $dirs = explode('/', $parts['dirname']);


        if (!isset($dirs[4]) || strpos($dirs[4], '_') === false) {
            return false;
        }

        $dirs[4] =  str_replace('_', '-', $dirs[4]);

        $relativePath = implode('/', $dirs) . '/' . $parts['basename'];
        $absolutePath = $root . $relativePath;

        // echo PHP_EOL."TRYING $absolutePath";
        if (file_exists($absolutePath)) {
            // echo(PHP_EOL.'CORRECTION is ' . $relativePath);
            $fix = $relativePath;
        } else {
            $relativePath = implode('/', $dirs) . '/' . str_replace('_', '-', $parts['basename']);
            $absolutePath = $root . $relativePath;
            // echo PHP_EOL."TRYING $absolutePath";
            if (file_exists($absolutePath)) {
                // echo(PHP_EOL.'CORRECTION is ' . $relativePath);
                $fix = $relativePath;
            }
        }

        if (!is_null($fix))
            $this->queries[] = "UPDATE article SET content = REPLACE(content, '$imgUrl', '$fix') WHERE content LIKE '%$imgUrl%';";
    }
}
