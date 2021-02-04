<div class="form-group row align-items-center" :class="{'has-danger': errors.has('conversation_id'), 'has-success': fields.conversation_id && fields.conversation_id.valid }">
    <label for="conversation_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.conversation-interview.columns.conversation_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
{{--        <input type="text" v-model="form.conversation_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('conversation_id'), 'form-control-success': fields.conversation_id && fields.conversation_id.valid}" id="conversation_id" name="conversation_id" placeholder="{{ trans('admin.conversation-interview.columns.conversation_id') }}">--}}
        <select type="text" v-model="form.conversation_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('conversation_id'), 'form-control-success': fields.conversation_id && fields.conversation_id.valid}" id="conversation_id" name="conversation_id" placeholder="{{ trans('admin.conversation-interview.columns.conversation_id') }}" >
            <option value="" disabled selected>Choose Talk Artists</option>
            @foreach(\App\Models\Conversation::all() as $artist)
                <option value="{{ $artist->id }}">{{ $artist->artist_name }}</option>
            @endforeach
        </select>
            <div v-if="errors.has('conversation_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('conversation_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('question'), 'has-success': fields.question && fields.question.valid }">
    <label for="question" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.conversation-interview.columns.question') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea class="form-control" v-model="form.question" v-validate="'required'" id="question" name="question"></textarea>
        </div>
        <div v-if="errors.has('question')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('question') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('answer'), 'has-success': fields.answer && fields.answer.valid }">
    <label for="answer" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.conversation-interview.columns.answer') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea class="form-control" v-model="form.answer" v-validate="'required'" id="answer" name="answer"></textarea>
        </div>
        <div v-if="errors.has('answer')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('answer') }}</div>
    </div>
</div>


