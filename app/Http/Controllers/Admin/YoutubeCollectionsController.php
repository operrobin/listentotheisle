<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\YoutubeCollection\BulkDestroyYoutubeCollection;
use App\Http\Requests\Admin\YoutubeCollection\DestroyYoutubeCollection;
use App\Http\Requests\Admin\YoutubeCollection\IndexYoutubeCollection;
use App\Http\Requests\Admin\YoutubeCollection\StoreYoutubeCollection;
use App\Http\Requests\Admin\YoutubeCollection\UpdateYoutubeCollection;
use App\Models\YoutubeCollection;
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

class YoutubeCollectionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexYoutubeCollection $request
     * @return array|Factory|View
     */
    public function index(IndexYoutubeCollection $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(YoutubeCollection::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['artist_id', 'id', 'title', 'youtube_url'],

            // set columns to searchIn
            ['id', 'short_description', 'title', 'youtube_url'],
            function($query) {
                $query->with('Artist');
            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.youtube-collection.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.youtube-collection.create');

        return view('admin.youtube-collection.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreYoutubeCollection $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreYoutubeCollection $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the YoutubeCollection
        $youtubeCollection = YoutubeCollection::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/youtube-collections'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/youtube-collections');
    }

    /**
     * Display the specified resource.
     *
     * @param YoutubeCollection $youtubeCollection
     * @throws AuthorizationException
     * @return void
     */
    public function show(YoutubeCollection $youtubeCollection)
    {
        $this->authorize('admin.youtube-collection.show', $youtubeCollection);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param YoutubeCollection $youtubeCollection
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(YoutubeCollection $youtubeCollection)
    {
        $this->authorize('admin.youtube-collection.edit', $youtubeCollection);


        return view('admin.youtube-collection.edit', [
            'youtubeCollection' => $youtubeCollection,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateYoutubeCollection $request
     * @param YoutubeCollection $youtubeCollection
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateYoutubeCollection $request, YoutubeCollection $youtubeCollection)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values YoutubeCollection
        $youtubeCollection->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/youtube-collections'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/youtube-collections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyYoutubeCollection $request
     * @param YoutubeCollection $youtubeCollection
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyYoutubeCollection $request, YoutubeCollection $youtubeCollection)
    {
        $youtubeCollection->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyYoutubeCollection $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyYoutubeCollection $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    YoutubeCollection::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
