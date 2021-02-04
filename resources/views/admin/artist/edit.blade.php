@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.artist.actions.edit', ['name' => $artist->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <artist-form
                :action="'{{ $artist->resource_url }}'"
                :data="{{ $artist->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.artist.actions.edit', ['name' => $artist->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.artist.components.form-elements', [
                            'artist' => $artist
                        ])
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </artist-form>

        </div>

</div>

@endsection
