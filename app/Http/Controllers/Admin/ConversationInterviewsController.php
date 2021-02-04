<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ConversationInterview\BulkDestroyConversationInterview;
use App\Http\Requests\Admin\ConversationInterview\DestroyConversationInterview;
use App\Http\Requests\Admin\ConversationInterview\IndexConversationInterview;
use App\Http\Requests\Admin\ConversationInterview\StoreConversationInterview;
use App\Http\Requests\Admin\ConversationInterview\UpdateConversationInterview;
use App\Models\ConversationInterview;
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

class ConversationInterviewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexConversationInterview $request
     * @return array|Factory|View
     */
    public function index(IndexConversationInterview $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ConversationInterview::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'conversation_id', 'question', 'answer'],

            // set columns to searchIn
            ['id', 'question', 'answer'],
            function($query) {
                $query->with('talk');
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

        return view('admin.conversation-interview.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.conversation-interview.create');

        return view('admin.conversation-interview.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreConversationInterview $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreConversationInterview $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the ConversationInterview
        $conversationInterview = ConversationInterview::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/conversation-interviews'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/conversation-interviews');
    }

    /**
     * Display the specified resource.
     *
     * @param ConversationInterview $conversationInterview
     * @throws AuthorizationException
     * @return void
     */
    public function show(ConversationInterview $conversationInterview)
    {
        $this->authorize('admin.conversation-interview.show', $conversationInterview);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ConversationInterview $conversationInterview
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(ConversationInterview $conversationInterview)
    {
        $this->authorize('admin.conversation-interview.edit', $conversationInterview);


        return view('admin.conversation-interview.edit', [
            'conversationInterview' => $conversationInterview,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateConversationInterview $request
     * @param ConversationInterview $conversationInterview
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateConversationInterview $request, ConversationInterview $conversationInterview)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values ConversationInterview
        $conversationInterview->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/conversation-interviews'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/conversation-interviews');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyConversationInterview $request
     * @param ConversationInterview $conversationInterview
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyConversationInterview $request, ConversationInterview $conversationInterview)
    {
        $conversationInterview->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyConversationInterview $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyConversationInterview $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ConversationInterview::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
