<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WordStaticPage\BulkDestroyWordStaticPage;
use App\Http\Requests\Admin\WordStaticPage\DestroyWordStaticPage;
use App\Http\Requests\Admin\WordStaticPage\IndexWordStaticPage;
use App\Http\Requests\Admin\WordStaticPage\StoreWordStaticPage;
use App\Http\Requests\Admin\WordStaticPage\UpdateWordStaticPage;
use App\Models\WordStaticPage;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WordStaticPagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexWordStaticPage $request
     * @return array|Factory|View
     */
    public function index(IndexWordStaticPage $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(WordStaticPage::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['content', 'id'],

            // set columns to searchIn
            ['content', 'id', 'slug']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.word-static-page.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.word-static-page.create');

        return view('admin.word-static-page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWordStaticPage $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreWordStaticPage $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the WordStaticPage
        $wordStaticPage = WordStaticPage::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/word-static-pages'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/word-static-pages');
    }

    /**
     * Display the specified resource.
     *
     * @param WordStaticPage $wordStaticPage
     * @throws AuthorizationException
     * @return void
     */
    public function show(WordStaticPage $wordStaticPage)
    {
        $this->authorize('admin.word-static-page.show', $wordStaticPage);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param WordStaticPage $wordStaticPage
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(WordStaticPage $wordStaticPage)
    {
        $this->authorize('admin.word-static-page.edit', $wordStaticPage);


        return view('admin.word-static-page.edit', [
            'wordStaticPage' => $wordStaticPage,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWordStaticPage $request
     * @param WordStaticPage $wordStaticPage
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateWordStaticPage $request, WordStaticPage $wordStaticPage)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values WordStaticPage
        $wordStaticPage->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/word-static-pages'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/word-static-pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyWordStaticPage $request
     * @param WordStaticPage $wordStaticPage
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyWordStaticPage $request, WordStaticPage $wordStaticPage)
    {
        $wordStaticPage->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyWordStaticPage $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyWordStaticPage $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    WordStaticPage::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
