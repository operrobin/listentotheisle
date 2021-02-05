@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.conversation.actions.index'))

@section('body')
    <div class="container">
        <div class="block block-content">
            <div style="max-height: 500px" class="row">
                <div class="content">
                    <h3 class="display-4">Maintenance</h3>

                    <!-- Setting Name -->
                    <div class="col-3 d-block">
                        Maintenance Mode
                    </div>

                    <!-- Setting Value -->
                    <div class="col-9 d-block">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                            {{-- <label class="custom-control-label" for="customSwitch1">On</label> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
