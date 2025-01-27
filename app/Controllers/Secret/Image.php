<?php

namespace App\Controllers\Secret;

use App\Models\Article;
use App\Controllers\Abilities\ImageScanner;
use App\Controllers\Abilities\Imagine;
// use App\Controllers\Abilities\LargeImageFinder;
use App\Controllers\Abilities\FileUploader;

use \HexMakina\LocalFS\{FileSystem, File};
use \HexMakina\Deadites\Deadites;

// use Spatie\ImageOptimizer\OptimizerChain;
// use Spatie\ImageOptimizer\Optimizers\Jpegoptim;
// use Spatie\Image\Image as Picture;

class Image extends Krafto
{
    private $fileSystem;

    private $externalController = null;
    private $slug = null;

    public function home()
    {

        $res = \App\Models\Image::filter()->limit(1000, 0)->retAss();
        // $res = \App\Models\Image::filter()->retAss();
        $this->viewport('images', $res);
        // $jpegOptimizer = (new OptimizerChain)
        //     ->addOptimizer(new Jpegoptim([
        //         '--strip-all',
        //         '--all-progressive',
        //         '--max = 100'
        //     ]));


        // $optimized_pathes = [];
        // foreach (['film/_a', 'personne', 'organisation'] as $directory) {

        //     $finder = new LargeImageFinder($this->fileSystem()->absolutePathFor($directory));
        //     // $finder->setMaxBytes(5_000_000);
        //     $finder->setMaxWidth(2000);
        //     $finder->setMaxHeight(1200);
        //     $finder->setExtensionsFilter(['jpg', 'jpeg']);
        //     // $finder->setExtensionsFilter(['jpg', 'jpeg', 'png', 'gif', 'webp']);
            
        //     foreach ($finder->pathes() as $original_path => $issues) {
                
        //         $resized_path = $original_path.'-resized.jpg';
        //         $image = Picture::load($original_path);
       
        //         if (isset($issues['maxWidth'])) {
        //             $image->width(1920); // image.png, image.webp, image.avif
        //         }

        //         if (isset($issues['maxHeight'])) {
        //             $image->height(1080); // image.png, image.webp, image.avif
        //         }
        //         $image->save($resized_path);
        //         $jpegOptimizer->optimize($resized_path, $resized_path.'-optimized.jpg');
        //         vd($issues, $original_path);
        //         $optimized_pathes[] = $resized_path;
        //     }
        //     dd($optimized_pathes);
        // }

    }

    public function scan()
    {
        $scanner = new ImageScanner($this->fileSystem());
        $files = $scanner->scan();
        vd(count($files), 'count($files)');
        $max = 0;
        foreach ($files as $item) {
            $path = $item['path'];
            $length = strlen($item['path']);
            if($length > $max){
                $max = $length;
            }
        }

        vd($max, 'path max length');
        
        foreach($files as $file){
            $img = new \App\Models\Image();
            $img->import($file);
            $img->save(0);
        }

        dd('STOP');
    }

    public function imagesRootURL(): string
    {
        return $this->get('settings.urls.images');
    }

    public function imagesRootPath(): string
    {
        return $this->get('settings.folders.images');
    }

    public function fileSystem(): FileSystem
    {
        if (is_null($this->fileSystem))
            $this->fileSystem = new FileSystem($this->imagesRootPath());

        return $this->fileSystem;
    }

    public function details()
    {
        $controller = $this->router()->params('nid');
        $controller = $this->get('App\\Controllers\\Secret\\' . $controller);
        $slug = $this->router()->params('slug');
        $directory = $this->buildRelativeLocator($controller, $slug);
        // $filename = $this->router()->params('filename');
        dd($directory);
        // $this->viewport('filename', $filename);
        // $this->viewport('alternates', $files);

    }

    public function delete()
    {
        $controller = $this->externalController();
        $filename = $this->router()->params('filename');
        $relativePath = $this->buildRelativeLocator($controller, $filename);
        $path = $this->fileSystem()->absolutePathFor($relativePath);
        $file = new File($path);


        if (FileSystem::remove($path) === false) {
            //add error message
            $this->router()->hopBack();
        }

        if (empty($this->fileSystem()->list($this->buildRelativeLocator()))) {
            $dir = $file->getFilePath()->dir();
            vd($dir);
            FileSystem::remove($dir);
        }

        $this->router()->hopBack();
    }

    public function alternates()
    {
        $testPictures = [
            'movie/_s/sur-le-champ/sur-le-champs-affiche.jpg',
            'movie/_x/x-film-autopsie-d-une-enquete/cover.jpg',
            'professional/_j/jacob-marine/marine_jacob.jpg',
            'professional/_j/jacob-marine/13001204_1790519544509377_5333094279074092783_n.jpg'
        ];

        $formats = [
            'thumbnail' => ['width' => 250, 'height' => 250],
            'article-card' => ['width' => 400, 'height' => 250],
            'slick-slide' => ['width' => 250, 'height' => 280, 'fill' => 'FFFFFF'],
            'single-film' => ['width' => 540, 'height' => 360, 'fill' => 'FFFFFF'],
            'single-professional' => ['width' => 400, 'height' => 450, 'fill' => '000000'],
            'single-organisation' => ['width' => 400, 'height' => 400, 'fill' => '000000'],
            'single-article' => ['width' => 1300, 'height' => 600, 'fill' => '000000'],
            'banner' => ['width' => 1920, 'height' => 650, 'fill' => '000000'],
        ];

        foreach ($testPictures as $testPicture) {
            $imageResizer = new Imagine($this->fileSystem(), $testPicture);
            $imageResizer->createAlternateVersions($formats);
        }
        die('STOP');
    }

    public function dropzoneUpload()
    {
        $controller = $this->router()->params('nid');
        $controller = $this->get('App\\Controllers\\Secret\\' . $controller);

        $uploader = new FileUploader($this->fileSystem(), $this->buildRelativeLocator($controller));

        $uploader->setAllowedMIMETypes($this->get('settings.images.allowedMIMETypes'));
        $uploader->handleUpload($_FILES);

        $response = [];

        // dd($uploader->errors());

        header('Content-Type: application/json');

        if (empty($uploader->errors())) {
            http_response_code(200);
            $response = ["status" => "success", "message" => "Tous les fichiers ont été téléversés"];
        } else {
            http_response_code(400);
            foreach ($uploader->errors() as $message) {
                $response[] = ["status" => "error", "message" => $message];
            }
        }

        echo json_encode($response);
        die;
    }

    public function deadlinks()
    {
        $articles = Article::filter();
        $articles->selectAlso(['article.content', 'article.id']);
        $articles->whereLike('content', '%src="%');
        $articles->limit(1, 0);
        $articles->orderBy('id DESC');
        $articles = $articles->retObj(Article::class);

        $errors = [];
        $countErrors = 0;
        $articleWithErrors = [];
        $urlChecker = new Deadites();
        foreach ($articles as $article) {
            $html = $article->get('content');
            if (!empty($html)) {
                $res = $urlChecker->verifyImagesInHTML($html);
                if (!empty($res)) {
                    $articleWithErrors[$article->id()] = $article;
                    $errors[$article->id()] = $res;
                    $countErrors += count($res);
                }
            }
        }
        $this->viewport('articleWithErrors', $articleWithErrors);
        $this->viewport('errorsByArticle', $errors);
        $this->viewport('countErrors', $countErrors);
    }


    /**
     * Builds a relative locator for an image file.
     *
     * @param string|null $filename optional filename to include in the locator.
     * @return string The relative locator for the image file.
     * @throws \Exception If the external controller or slug is not set.
     */
    public function buildRelativeLocator($externalController = null, string $filename = null): string
    {
        if (!is_null($externalController))
            $this->externalController = $externalController;

        if (is_null($this->externalController()))
            throw new \Exception('NO_EXTERNAL_CONTROLLER');

        if (is_null($this->slug()))
            throw new \Exception('NO_SLUG');

        $pathComponents = [];

        // Get the images directory from the external controller, if available
        $pathComponents[] = $this->externalController()->imagesDirectory();

        // Add the slug prefix to the path
        $pathComponents[] = sprintf('_%s', (is_numeric($prefix = substr($this->slug(), 0, 1)) ? 0 : $prefix));

        // Add the slug to the path
        $pathComponents[] = $this->slug();

        // Add the filename to the path, if provided
        if (!is_null($filename)) {
            $pathComponents[] = $filename;
        }

        // Join the path components with the directory separator
        return implode(DIRECTORY_SEPARATOR, $pathComponents);
    }

    private function externalController()
    {
        if (is_null($this->externalController) && $this->router()->params('externalController')) {
            $controller = $this->router()->params('externalController');
            $controller = $this->get('App\\Controllers\\Secret\\' . $controller);
            $this->externalController = $controller;
        }

        return $this->externalController;
    }

    private function slug()
    {
        $this->slug = $this->slug ?? $this->router()->params('slug') ?? $this->externalController()->loadModel()->slug();

        return $this->slug;
    }
}
