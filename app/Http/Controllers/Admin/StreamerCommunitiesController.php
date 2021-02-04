<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StreamerCommunity\BulkDestroyStreamerCommunity;
use App\Http\Requests\Admin\StreamerCommunity\DestroyStreamerCommunity;
use App\Http\Requests\Admin\StreamerCommunity\IndexStreamerCommunity;
use App\Http\Requests\Admin\StreamerCommunity\StoreStreamerCommunity;
use App\Http\Requests\Admin\StreamerCommunity\UpdateStreamerCommunity;
use App\Models\StreamerCommunity;
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

class StreamerCommunitiesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexStreamerCommunity $request
     * @return array|Factory|View
     */
    public function index(IndexStreamerCommunity $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(StreamerCommunity::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'streamer_name', 'twitch_url', 'soundcloud_url', 'mixcloud_url', 'website_url', 'published_at'],

            // set columns to searchIn
            ['id', 'name', 'streamer_name', 'description', 'twitch_url', 'soundcloud_url', 'mixcloud_url', 'website_url']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.streamer-community.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.streamer-community.create');

        return view('admin.streamer-community.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStreamerCommunity $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreStreamerCommunity $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the StreamerCommunity
        $streamerCommunity = StreamerCommunity::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/streamer-communities'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/streamer-communities');
    }

    /**
     * Display the specified resource.
     *
     * @param StreamerCommunity $streamerCommunity
     * @throws AuthorizationException
     * @return void
     */
    public function show(StreamerCommunity $streamerCommunity)
    {
        $this->authorize('admin.streamer-community.show', $streamerCommunity);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param StreamerCommunity $streamerCommunity
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(StreamerCommunity $streamerCommunity)
    {
        $this->authorize('admin.streamer-community.edit', $streamerCommunity);


        return view('admin.streamer-community.edit', [
            'streamerCommunity' => $streamerCommunity,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStreamerCommunity $request
     * @param StreamerCommunity $streamerCommunity
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateStreamerCommunity $request, StreamerCommunity $streamerCommunity)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values StreamerCommunity
        $streamerCommunity->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/streamer-communities'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
                'object' => $streamerCommunity
            ];
        }

        return redirect('admin/streamer-communities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyStreamerCommunity $request
     * @param StreamerCommunity $streamerCommunity
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyStreamerCommunity $request, StreamerCommunity $streamerCommunity)
    {
        $streamerCommunity->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyStreamerCommunity $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyStreamerCommunity $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    StreamerCommunity::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
