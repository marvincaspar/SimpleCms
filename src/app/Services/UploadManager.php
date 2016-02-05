<?php
namespace Mc388\SimpleCms\App\Services;

use Carbon\Carbon;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

/**
 * Class UploadManager
 *
 * @package Mc388\SimpleCms\App\Services
 */
class UploadManager
{
    /** @var FilesystemAdapter */
    protected $disk;

    /**
     * UploadManager constructor.
     */
    public function __construct()
    {
        $this->disk = Storage::disk(config('cms.uploads.storage'));
    }

    /**
     * Return files and directories within a folder
     *
     * @param string $folder
     *
     * @return array of [
     *    'folder' => 'path to current folder',
     *    'folderName' => 'name of just current folder',
     *    'breadCrumbs' => breadcrumb array of [ $path => $foldername ]
     *    'folders' => array of [ $path => $foldername] of each subfolder
     *    'files' => array of file details on each file in folder
     * ]
     */
    public function folderInfo($folder)
    {
        $folder = $this->addUploadFolderToPath($folder);

        $breadcrumbs = $this->breadcrumbs($folder);
        $slice = array_slice($breadcrumbs, -1);
        $folderName = current($slice);
        $breadcrumbs = array_slice($breadcrumbs, 0, -1);

        $subfolders = [];
        foreach (array_unique($this->disk->directories($folder)) as $subfolder) {
            $subfolders["/$subfolder"] = basename($subfolder);
        }

        $files = [];
        foreach ($this->disk->files($folder) as $path) {
            $files[] = $this->fileDetails($path);
        }

        return compact(
            'folder',
            'folderName',
            'breadcrumbs',
            'subfolders',
            'files'
        );
    }

    /**
     * Sanitize the folder name
     *
     * @param $folder
     *
     * @return string
     */
    protected function addUploadFolderToPath($folder)
    {
        return config('cms.uploads.uploadFolder') . '/' . trim(str_replace('..', '', $folder), '/');
    }

    /**
     * Return breadcrumbs to current folder
     *
     * @param $folder
     *
     * @return array
     */
    protected function breadcrumbs($folder)
    {
        $folder = trim($folder, '/');
        $crumbs = ['/' => 'root'];

        if (empty($folder)) {
            return $crumbs;
        }

        $folders = explode('/', $folder);
        $build = '';
        foreach ($folders as $folder) {
            $build .= '/' . $folder;
            $crumbs[$build] = $folder;
        }

        return $crumbs;
    }

    /**
     * Return an array of file details for a file
     *
     * @param $path
     *
     * @return array
     */
    protected function fileDetails($path)
    {
        $path = '/' . ltrim($path, '/');

        return [
            'name' => basename($path),
            'fullPath' => $path,
            'webPath' => $this->fileWebpath($path),
            'mimeType' => $this->fileMimeType($path),
            'size' => $this->fileSize($path),
            'modified' => $this->fileModified($path),
        ];
    }

    /**
     * Return the full web path to a file
     *
     * @param $path
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function fileWebpath($path)
    {
        $path = '/' . ltrim($path, '/');
        return url($path);
    }

    /**
     * Return the mime type
     *
     * @param $path
     *
     * @return false|string
     */
    public function fileMimeType($path)
    {
        return $this->disk->mimeType($path);
    }

    /**
     * Return the file size
     *
     * @param $path
     *
     * @return int|string
     */
    public function fileSize($path)
    {
        $bytes = $this->disk->size($path);
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    /**
     * Return the last modified time
     *
     * @param $path
     *
     * @return static
     */
    public function fileModified($path)
    {
        return Carbon::createFromTimestamp(
            $this->disk->lastModified($path)
        );
    }

    /**
     * Create a new directory
     *
     * @param $folder
     *
     * @return bool|string
     */
    public function createDirectory($folder)
    {
        $folder = $this->addUploadFolderToPath($folder);

        if ($this->disk->exists($folder)) {
            return "Folder '$folder' aleady exists.";
        }

        return $this->disk->makeDirectory($folder);
    }

    /**
     * Delete a directory
     *
     * @param $folder
     *
     * @return bool|string
     */
    public function deleteDirectory($folder)
    {
        $folder = $this->addUploadFolderToPath($folder);

        $filesFolders = array_merge(
            $this->disk->directories($folder),
            $this->disk->files($folder)
        );
        if (!empty($filesFolders)) {
            return "Directory must be empty to delete it.";
        }

        return $this->disk->deleteDirectory($folder);
    }

    /**
     * Delete a file
     *
     * @param $path
     *
     * @return bool|string
     */
    public function deleteFile($path)
    {
        if (!$this->disk->exists($path)) {
            return "File does not exist.";
        }

        return $this->disk->delete($path);
    }

    /**
     * Save a file
     *
     * @param $path
     * @param $content
     *
     * @return bool|string
     */
    public function saveFile($path, $content)
    {
        $path = $this->addUploadFolderToPath($path);

        if ($this->disk->exists($path)) {
            return "File already exists.";
        }

        return $this->disk->put($path, $content);
    }
}
