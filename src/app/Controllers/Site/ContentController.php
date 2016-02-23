<?php

namespace Mc388\SimpleCms\App\Controllers\Site;

require_once dirname(__FILE__) . '../../../../../vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php';

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Routing\Controller;
use Mc388\SimpleCms\App\Models\Content;
use Mc388\SimpleCms\App\Services\SiteMap;

/**
 * Class ContentController
 *
 * @package Mc388\SimpleCms\App\Controllers\Site
 */
class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Response
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $contents = Content::roots()->get();
        if ($contents->count() == 0) {
            throw new \Exception('Contents are missing');
        }

        return view('simple-cms::site.contents.index', [
            'isMobile' => $this->isMobile($request),
            'contents' => $contents
        ]);
    }

    /**
     * Show the specified content.
     *
     * @param string $slug
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function show($slug, Request $request)
    {
        $content = Content::where('slug', $slug)->first();
        $this->checkPage($content, $slug);

        return view('simple-cms::site.contents.show', [
            'isMobile' => $this->isMobile($request),
            'content' => $content
        ]);
    }

    /**
     * Get the SiteMap
     *
     * @param SiteMap $siteMap
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function siteMap(SiteMap $siteMap, Request $request)
    {
        $url = $request->getUriForPath('/');
        $map = $siteMap->getSiteMap($url);

        return response($map)
            ->header('Content-type', 'text/xml');
    }

    /**
     * Check the content model.
     *
     * @param mixed $content
     * @param string $slug
     *
     * @throws \Exception
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Illuminate\Http\Response
     */
    protected function checkPage($content, $slug)
    {
        if (!$content) {
            if ($slug == 'home') {
                throw new \Exception('The Homepage Is Missing');
            }
            abort(404);
        }
    }

    /**
     * Checks if the current request is from a mobile device
     *
     * @param Request $request
     *
     * @return bool
     */
    protected function isMobile(Request $request)
    {
        $detect = new \Mobile_Detect();
        return $detect->isMobile($request->header('user-agent')) || $detect->isTablet($request->header('user-agent'));
    }
}
