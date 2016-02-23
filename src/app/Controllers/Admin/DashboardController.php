<?php

namespace Mc388\SimpleCms\App\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mc388\SimpleCms\App\Models\Content;
use Mc388\SimpleCms\App\Services\UploadManager;

/**
 * Class DashboardController
 *
 * @package Mc388\SimpleCms\App\Controllers\Admin
 */
class DashboardController extends Controller
{
    /** @var UploadManager $manager */
    protected $manager;

    /**
     * DashboardController constructor.
     *
     * @param UploadManager $manager
     */
    public function __construct(UploadManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $folder = $request->get('folder');
        $mediaCount = count($this->manager->folderInfo($folder)['files']);

        $contentsCount = Content::count();

        return view('simple-cms::admin.dashboard.index', [
            'contentsCount' => $contentsCount,
            'mediaCount' => $mediaCount
        ]);
    }
}
