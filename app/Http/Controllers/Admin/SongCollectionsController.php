<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SongCollection\BulkDestroySongCollection;
use App\Http\Requests\Admin\SongCollection\DestroySongCollection;
use App\Http\Requests\Admin\SongCollection\IndexSongCollection;
use App\Http\Requests\Admin\SongCollection\StoreSongCollection;
use App\Http\Requests\Admin\SongCollection\UpdateSongCollection;
use App\Models\SongCollection;
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

class SongCollectionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexSongCollection $request
     * @return array|Factory|View
     */
    public function index(IndexSongCollection $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(SongCollection::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'song_name', 'song_description', 'artist_id', 'soundcloud_url', 'mixcloud_url', 'website_url', 'published_at'],

            // set columns to searchIn
            ['id', 'song_name', 'song_description', 'soundcloud_url', 'mixcloud_url', 'website_url'],

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

        return view('admin.song-collection.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.song-collection.create');

        return view('admin.song-collection.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSongCollection $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreSongCollection $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the SongCollection
        $songCollection = SongCollection::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/song-collections'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/song-collections');
    }

    /**
     * Display the specified resource.
     *
     * @param SongCollection $songCollection
     * @throws AuthorizationException
     * @return void
     */
    public function show(SongCollection $songCollection)
    {
        $this->authorize('admin.song-collection.show', $songCollection);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SongCollection $songCollection
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(SongCollection $songCollection)
    {
        $this->authorize('admin.song-collection.edit', $songCollection);


        return view('admin.song-collection.edit', [
            'songCollection' => $songCollection,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSongCollection $request
     * @param SongCollection $songCollection
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateSongCollection $request, SongCollection $songCollection)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values SongCollection
        $songCollection->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/song-collections'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
                'object' => $songCollection
            ];
        }

        return redirect('admin/song-collections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroySongCollection $request
     * @param SongCollection $songCollection
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroySongCollection $request, SongCollection $songCollection)
    {
        $songCollection->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroySongCollection $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroySongCollection $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    SongCollection::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
