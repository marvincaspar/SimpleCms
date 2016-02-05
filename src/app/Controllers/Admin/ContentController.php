<?php

namespace Mc388\SimpleCms\App\Controllers\Admin;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use Mc388\SimpleCms\App\Models\Content;
use Mc388\SimpleCms\App\Requests\Admin\ContentRequest;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContentController
 *
 * @package Mc388\SimpleCms\App\Controllers\Admin
 */
class ContentController extends Controller
{
    /** @var array */
    protected $fields = [
        'title' => '',
        'parent_id' => '',
        'nav_title' => '',
        'body' => '',
        'banner' => '',
        'type' => '',
        'link_to_content_id' => '',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $contents = Content::roots()->get();

        return view('simple-cms::admin.contents.index', ['contents' => $contents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $contents = Content::getNestedList('nav_title');
        $content = new Content();
        $content->__set('parent_id', Content::roots()->get()->first()->id);
        $content->__set('type', Content::TYPE_SITE);

        return view(
            'simple-cms::admin.contents.create',
            [
                'content' => $content,
                'contents' => $contents
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContentRequest $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(ContentRequest $request)
    {
        $content = new Content();
        foreach (array_keys($this->fields) as $field) {
            $content->$field = $request->get($field);
        }
        $content->user_id = \Auth::user()->id;
        $content->save();

        return redirect('/manage/contents')
            ->with('message', 'The content \'$content->title\' was created.');
    }

    /**
     * Edit the specified content.
     *
     * @param string $slug
     *
     * @return Factory|View
     */
    public function edit($slug)
    {
        $content = Content::where('slug', $slug)->first();
        $this->checkPage($content, $slug);

        $contents = Content::getNestedList('nav_title');

        return view('simple-cms::admin.contents.edit', ['content' => $content, 'contents' => $contents]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContentRequest|Request $request
     * @param  string $slug
     *
     * @return RedirectResponse|Redirector
     * @throws \Exception
     */
    public function update(ContentRequest $request, $slug)
    {
        $content = Content::where('slug', $slug)->first();
        $this->checkPage($content, $slug);

        foreach (array_keys(array_except($this->fields, ['content'])) as $field) {
            $content->$field = $request->get($field);
        }
        $content->save();

        return redirect(URL::route('manage.contents.edit', array('content' => $content->slug)))
            ->with('message', 'Changes saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return ResponseFactory|Response
     */
    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();

        return response()->json(array(
            'success' => true,
        ));
    }


    /**
     * @param Request $request
     *
     * @return ResponseFactory|Response
     */
    public function updateHierarchy(Request $request)
    {
        $list = json_decode($request->input('list'));

        foreach ($list as $item) {
            $content = Content::findOrNew($item->id);

            $content->parent_id = $item->parent_id;
            $content->lft = $item->lft;
            $content->rgt = $item->rgt;
            $content->depth = $item->depth;

            $content->save();
        }


        return response()->json(array(
            'success' => true,
        ));
    }

    /**
     * Check the content model.
     *
     * @param mixed $content
     * @param string $slug
     *
     * @throws \Exception
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
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
}
