<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Conversation\BulkDestroyConversation;
use App\Http\Requests\Admin\Conversation\DestroyConversation;
use App\Http\Requests\Admin\Conversation\IndexConversation;
use App\Http\Requests\Admin\Conversation\StoreConversation;
use App\Http\Requests\Admin\Conversation\UpdateConversation;
use App\Models\Conversation;
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

class ConversationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexConversation $request
     * @return array|Factory|View
     */
    public function index(IndexConversation $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Conversation::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'artist_name', 'interview_by', 'photography_by', 'published_at'],

            // set columns to searchIn
            ['id', 'artist_name', 'short_description', 'long_description', 'interview_by', 'photography_by']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.conversation.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.conversation.create');

        return view('admin.conversation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreConversation $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreConversation $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Conversation
        $conversation = Conversation::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/conversations'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/conversations');
    }

    /**
     * Display the specified resource.
     *
     * @param Conversation $conversation
     * @throws AuthorizationException
     * @return void
     */
    public function show(Conversation $conversation)
    {
        $this->authorize('admin.conversation.show', $conversation);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Conversation $conversation
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Conversation $conversation)
    {
        $this->authorize('admin.conversation.edit', $conversation);


        return view('admin.conversation.edit', [
            'conversation' => $conversation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateConversation $request
     * @param Conversation $conversation
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateConversation $request, Conversation $conversation)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Conversation
        $conversation->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/conversations'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
                'object' => $conversation
            ];
        }

        return redirect('admin/conversations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyConversation $request
     * @param Conversation $conversation
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyConversation $request, Conversation $conversation)
    {
        $conversation->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyConversation $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyConversation $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Conversation::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
