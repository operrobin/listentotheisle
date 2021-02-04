<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Artist\BulkDestroyArtist;
use App\Http\Requests\Admin\Artist\DestroyArtist;
use App\Http\Requests\Admin\Artist\IndexArtist;
use App\Http\Requests\Admin\Artist\StoreArtist;
use App\Http\Requests\Admin\Artist\UpdateArtist;
use App\Models\Artist;
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

class ArtistsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexArtist $request
     * @return array|Factory|View
     */
    public function index(IndexArtist $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Artist::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'artist_name', 'artist_description', 'artist_type'],

            // set columns to searchIn
            ['id', 'artist_name', 'artist_description', 'artist_type']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.artist.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.artist.create');

        return view('admin.artist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArtist $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreArtist $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Artist
        $artist = Artist::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/artists'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/artists');
    }

    /**
     * Display the specified resource.
     *
     * @param Artist $artist
     * @throws AuthorizationException
     * @return void
     */
    public function show(Artist $artist)
    {
        $this->authorize('admin.artist.show', $artist);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Artist $artist
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Artist $artist)
    {
        $this->authorize('admin.artist.edit', $artist);


        return view('admin.artist.edit', [
            'artist' => $artist,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArtist $request
     * @param Artist $artist
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateArtist $request, Artist $artist)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Artist
        $artist->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/artists'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/artists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyArtist $request
     * @param Artist $artist
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyArtist $request, Artist $artist)
    {
        $artist->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyArtist $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyArtist $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Artist::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
