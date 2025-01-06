<?php

namespace App\Controllers\Abilities;

use \HexMakina\LocalFS\FileSystem;
use HexMakina\LocalFS\File;

class FileUploader
{
    private $uploadDirectory;
    private $errors;

    // array of allowed MIME types for file upload, indexed by MIME type
    private $allowedMimeTypes;

    private FileSystem $fileSystem;

    /**
     * Constructs a new FileUploader instance.
     *
     * The constructor performs the following tasks:
     * 1. Validates target upload directory
     * 2. Sets the target upload directory
     * 3. Sets the allowed MIME types for file uploads.
     * 4. Initializes the errors array to store any errors that occur during file uploads.
     *
     * @param string $targetDirectory The directory where uploaded files will be stored.
     * @param array $allowedMimeTypes An optional array specifying the MIME types allowed for upload.
     * @throws \InvalidArgumentException Thrown if the directory could not be validated.
     * 
     */
    public function __construct(FileSystem $fileSystem, string $targetDirectory)
    {
        $this->fileSystem = $fileSystem;
        $this->uploadDirectory = $this->fileSystem->absolutePathFor($targetDirectory);
        $this->fileSystem->ensureWritablePath($this->uploadDirectory);

        $this->errors = [];
    }

    // add setter for allowedMimeTypes
    public function setAllowedMIMETypes(array $allowedMimeTypes): void
    {
        $this->allowedMimeTypes = $allowedMimeTypes;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Handles the upload of multiple files.
     *
     * This method iterates over an array of uploaded files, processes each one,
     * and then returns an array of errors, if any occurred during the upload.
     *
     * @param array $uploadedFiles, the $_FILES array
     * @return array An array of errors encountered during the upload process.
     */

    public function handleUpload(array $uploadedFiles): array
    {
        foreach ($uploadedFiles as $field => $files) {
            $this->processField($field, $files);
        }
        return $this->errors();
    }

    /**
     * Processes a single form field of uploaded files.
     *
     * This method normalizes the file array structure in case of single file upload
     * then performs upload validation, file moving, and error handling for each file
     *
     * @param string $field The name of the form field containing the uploaded files.
     * @param array $files An array containing file data for the given field.
     * @throws \Exception If file moving or validation fails.
     */
    private function processField(string $field, array $files): void
    {
        $files = $this->normalizeSingleFileUpload($files);

        foreach ($files['name'] as $i => $filename) {

            // skip empty input
            if ($this->emptyInput($files, $i)) continue;

            try {

                $this->validateFileUpload($files, $i, $filename);

                $targetPath = $this->safeTargetPath($filename);

                if (!move_uploaded_file($files['tmp_name'][$i], $targetPath)) {
                    throw new \Exception("Error moving '$filename' to destination");
                }
            } catch (\Exception $e) {
                $this->errors[$field] = $e->getMessage();
            }
        }
    }
    /**
     * Validates an uploaded file.
     *
     * This method performs three key checks on an uploaded file:
     * 1. Checks if the file was actually uploaded
     * 2. Checks for upload errors
     * 3. Verifies that the uploaded file is not empty
     * 4. Validates the MIME type of the file against a whitelist of allowed types
     *
     * @param array $files the uploaded file data.
     * @param int $i the index of the file in the file data array.
     * @param string $filename the original name of the uploaded file.
     * @throws \Exception Thrown if any of the checks fail.
     */
    private function validateFileUpload(array $files, int $i, string $filename): void
    {
        if (!is_uploaded_file($files['tmp_name'][$i])) {
            throw new \Exception("Potential security risk with '$filename'");
        }

        if ($errorMessage = $this->hasUploadErrorMessage($files['error'][$i]) !== false) {
            throw new \Exception("Error uploading '$filename': $errorMessage");
        }

        if ($this->emptyFile($files, $i)) {
            throw new \Exception("File '$filename' is empty");
        }

        if (!$this->hasAllowedMIMEType($files['tmp_name'][$i])) {
            throw new \Exception("Forbidden file type for '$filename'");
        }
    }

    private function safeTargetPath(string $originalName): string
    {
        // Sanitize the original name to remove special characters like '..', '/', and '\'
        $originalName = str_replace(['..', '/', '\\'], '', $originalName);

        // Extract the name and extension
        $namePart = pathinfo($originalName, PATHINFO_FILENAME);
        $extensionPart = pathinfo($originalName, PATHINFO_EXTENSION);

        // Sanitize further
        $cleanName = $this->sanitizeFilename($namePart);

        // Generate a unique name based on the sanitized name
        $uniqueName = $this->ensureUniqueFilename($cleanName, $extensionPart);

        // Verify that the file will be saved within the intended directory
        return $this->sanitizeFilepath("{$uniqueName}.{$extensionPart}");
    }


    private function emptyInput(array $files, int $i): bool
    {
        return $files['error'][$i] === UPLOAD_ERR_NO_FILE;
    }

    private function emptyFile($files, $i): bool
    {
        return $files['size'][$i] === 0 && !empty($files['tmp_name'][$i]);
    }

    private function normalizeSingleFileUpload(array $files): array
    {
        if (!is_array($files['name']))
            foreach ($files as $key => $value)
                $files[$key] = [$value];

        return $files;
    }

    private function hasUploadErrorMessage($error)
    {
        switch ($error) {
            case UPLOAD_ERR_OK:
                return false;

            case UPLOAD_ERR_INI_SIZE:
                return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
            case UPLOAD_ERR_FORM_SIZE:
                return 'The uploaded file exceeds the MAX_FILE_SIZE directive specified in the HTML form';
            case UPLOAD_ERR_PARTIAL:
                return 'The uploaded file was only partially uploaded';
            case UPLOAD_ERR_NO_FILE:
                return 'No file was uploaded';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Missing a temporary folder to store the uploaded file';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Failed to write the uploaded file to disk';
            case UPLOAD_ERR_EXTENSION:
                return 'A PHP extension stopped the file upload';

            default:
                return 'Unknown error';
        }
    }



    /**
     * Validates and constructs the final file path for the uploaded file.
     *
     * This method takes the sanitized unique name for the file, appends it to the upload directory,
     * and checks to ensure that there is no directory traversal attempt.
     *
     * @param string $finalUniqueName Sanitized and unique filename.
     * @return string Final, full path where the file will be saved.
     * @throws \InvalidArgumentException When a directory traversal attempt is detected.
     */
    private function sanitizeFilepath(string $finalUniqueName): string
    {
        $finalPath = $this->uploadDirectory . DIRECTORY_SEPARATOR . $finalUniqueName;
        $realPath = dirname($finalPath);
        vd($realPath);
        if (strpos($realPath, $this->uploadDirectory) !== 0) {
            throw new \InvalidArgumentException('POTENTIAL_DIRECTORY_TRAVERSAL_ATTACK');
        }

        return $finalPath;
    }

    /**
     * Sanitizes the filename by transliterating accented characters and replacing non-allowed characters.
     *
     * This method takes the base name of the file and performs transliteration to convert accented 
     * characters into their ASCII equivalents. It also replaces characters not permitted in filenames
     * with hyphens.
     *
     * @param string $baseName The original base name of the file.
     * @return string The sanitized base name.
     */
    private function sanitizeFilename(string $baseName): string
    {
        $res = iconv('UTF-8', 'ASCII//TRANSLIT', $baseName);
        $res = mb_strtolower($res);
        $res = preg_replace("/[^a-zA-Z0-9\-\_]/", "-", $res);

        return $res;
    }

    /**
     * Ensures that a filename is unique within the upload directory.
     *
     * This method takes a sanitized base name and an extension for the file. It checks the upload directory 
     * to ensure that no file with the same name already exists. If a file does exist, a counter is appended 
     * to the base name to make it unique.
     *
     * @param string $baseName The sanitized base name of the file.
     * @param string $extension The file extension.
     * @return string A unique filename within the upload directory.
     */
    private function ensureUniqueFilename(string $baseName, string $extension): string
    {
        $counter = 1;
        $uniqueName = $baseName;

        while (file_exists("{$this->uploadDirectory}/{$uniqueName}.{$extension}")) {
            $uniqueName = "{$baseName}-{$counter}";
            ++$counter;
        }

        return $uniqueName;
    }

    /**
     * Checks if the MIME type of the uploaded file is allowed.
     *
     * This method takes the temporary name of the uploaded file and checks its MIME type against
     * a list of allowed MIME types.
     *
     * @param string $tmpName The temporary name of the uploaded file.
     * @return bool True if the MIME type is allowed, false otherwise.
     */
    private function hasAllowedMIMEType(string $absolutePath): bool
    {
        if (empty($this->allowedMimeTypes)) {
            return true;
        }

        $file = new File($absolutePath);

        return isset($this->allowedMimeTypes[$file->getMIMEType()]);
    }
}
