@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.conversation.actions.index'))

@section('body')
    <div class="container">
        <div class="block block-content">
            <div class="row mb-3 d-flex justify-content-start">
                <h1 class="display-4">Configuration</h1>
            </div>

            @if(Session::has('error'))
            
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            
            @endif

            <form 
                method="POST" 
                id="config-form" 
                action="/admin/configuration/setup">
                @csrf
                <input id="env-mode-conf-val" type="hidden" name="state-name" value="{{ $environment_mode_value->state_name }}" />

                <div id="conf-save-btn" class="row d-none justify-content-between justify-content-sm-end mt-3">
                    <button type="submit" class="btn btn-primary mx-0 mx-sm-3">
                        <i class="fa fa-check-circle"></i> Save Changes
                    </button>
                </div>
            </form>



            <div class="row mt-3">

                <!-- Setting Category Name -->
                <div class="col-12 mb-3">
                    <h3 class="display-5">
                        Environment
                    </h3>
                    <hr />
                </div>

                <!-- Setting Name -->
                <div class="col-6">
                    <h3 class="display-5">
                        Toogle Environment Mode
                    </h3>
                </div>

                <!-- Setting Value -->
                <div class="col-6">
                    <select id="env-config" class="custom-select btn btn-primary text-white">
                        @foreach($environment_mode as $mode)
                            <option @if($mode->status == 1) selected @endif) value="{{ $mode->state_name }}"> 
                                {{ $mode->state_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        /**
         * Pardon me as a programmer can't solve this Javascript 
         * flow weirdness.
        */
        
        function removeDnone(){
            var classes = document.getElementById('conf-save-btn').classList;
            classes.remove('d-none');
            classes.add('d-flex');
        }
        

        /**
         * Document Ready
        */
        document.addEventListener("DOMContentLoaded", (e) => {

            /**
             * Environment Mode
            */

            document.getElementById('env-config').addEventListener(
                "change",
                (e) => {
                    removeDnone();
                    document.getElementById('env-mode-conf-val').value = e.srcElement.value;
                }   
            );   
        });


    </script>
@endsection
