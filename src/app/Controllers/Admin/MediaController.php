<?php

namespace Mc388\SimpleCms\App\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Mc388\SimpleCms\App\Requests\Admin\UploadFileRequest;
use Mc388\SimpleCms\App\Requests\Admin\UploadNewFolderRequest;
use Mc388\SimpleCms\App\Services\UploadManager;

/**
 * Class MediaController
 *
 * @package Mc388\SimpleCms\App\Controllers\Admin
 */
class MediaController extends Controller
{
    protected $manager;

    /**
     * MediaController constructor.
     *
     * @param UploadManager $manager
     */
    public function __construct(UploadManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Show page of files / subfolders
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $folder = $request->get('folder');
        $media = $this->manager->folderInfo($folder);

        return view('simple-cms::admin.media.index', $media);
    }

    /**
     * Upload new file
     *
     * @param UploadFileRequest $request
     *
     * @return $this
     */
    public function uploadFile(UploadFileRequest $request)
    {
        $file = $_FILES['file'];
        $fileInfo = pathinfo($file['name']);
        $fileNameFromRequest = pathinfo($request->get('file_name'));

        // Use filename from form if set, otherwise use original filename
        $filename = $fileNameFromRequest['filename'] ?: $fileInfo['filename'];

        // Remove spaces and special chars
        $filename = str_slug($filename) . '.' . $fileInfo['extension'];

        $content = File::get($file['tmp_name']);
        $result = $this->manager->saveFile($filename, $content);

        if ($result === true) {
            return redirect()
                ->back()
                ->with('message', 'File \'' . $filename . '\' uploaded.');
        }

        $error = $result ?: "An error occurred uploading file.";
        return redirect()
            ->back()
            ->with('error', [$error]);
    }

    /**
     * Delete a file
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteFile(Request $request)
    {
        $delFile = $request->get('del_file');
        $path = $request->get('folder') . $delFile;

        $result = $this->manager->deleteFile($path);

        if ($result === true) {
            return redirect()
                ->back()
                ->with('message', 'File \'' . $delFile . '\' deleted.');
        }

        $error = $result ?: "An error occurred deleting file.";
        return redirect()
            ->back()
            ->with('error', [$error]);
    }

    /**
     * Create a new folder
     *
     * @param UploadNewFolderRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createFolder(UploadNewFolderRequest $request)
    {
        $newFolder = $request->get('new_folder');
        $folder = $request->get('folder') . '/' . $newFolder;

        $result = $this->manager->createDirectory($folder);

        if ($result === true) {
            return redirect()
                ->back()
                ->with('message', 'Folder \'' . $newFolder . '\' created.');
        }

        $error = $result ?: "An error occurred creating directory.";
        return redirect()
            ->back()
            ->with('error', [$error]);
    }

    /**
     * Delete a folder
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteFolder(Request $request)
    {
        $delFolder = $request->get('del_folder');
        $folder = $request->get('folder') . '/' . $delFolder;

        $result = $this->manager->deleteDirectory($folder);

        if ($result === true) {
            return redirect()
                ->back()
                ->with('message', 'Folder \'' . $delFolder . '\' deleted.');
        }

        $error = $result ?: "An error occurred deleting directory.";
        return redirect()
            ->back()
            ->with('error', [$error]);
    }
}
