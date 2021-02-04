<div class="form-group row align-items-center" :class="{'has-danger': errors.has('artist_name'), 'has-success': fields.artist_name && fields.artist_name.valid }">
    <label for="artist_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.conversation.columns.artist_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.artist_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('artist_name'), 'form-control-success': fields.artist_name && fields.artist_name.valid}" id="artist_name" name="artist_name" placeholder="{{ trans('admin.conversation.columns.artist_name') }}">
        <div v-if="errors.has('artist_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('artist_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('short_description'), 'has-success': fields.short_description && fields.short_description.valid }">
    <label for="short_description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.conversation.columns.short_description') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea class="form-control" v-model="form.short_description" v-validate="'required'" id="short_description" name="short_description"></textarea>
        </div>
        <div v-if="errors.has('short_description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('short_description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('long_description'), 'has-success': fields.long_description && fields.long_description.valid }">
    <label for="long_description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.conversation.columns.long_description') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea class="form-control" v-model="form.long_description" v-validate="'required'" id="long_description" name="long_description"></textarea>
        </div>
        <div v-if="errors.has('long_description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('long_description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('interview_by'), 'has-success': fields.interview_by && fields.interview_by.valid }">
    <label for="interview_by" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.conversation.columns.interview_by') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.interview_by" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('interview_by'), 'form-control-success': fields.interview_by && fields.interview_by.valid}" id="interview_by" name="interview_by" placeholder="{{ trans('admin.conversation.columns.interview_by') }}">
        <div v-if="errors.has('interview_by')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('interview_by') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('photography_by'), 'has-success': fields.photography_by && fields.photography_by.valid }">
    <label for="photography_by" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.conversation.columns.photography_by') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.photography_by" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('photography_by'), 'form-control-success': fields.photography_by && fields.photography_by.valid}" id="photography_by" name="photography_by" placeholder="{{ trans('admin.conversation.columns.photography_by') }}">
        <div v-if="errors.has('photography_by')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('photography_by') }}</div>
    </div>
</div>

@include('brackets/admin-ui::admin.includes.media-uploader', [
    'mediaCollection' => app(App\Models\Conversation::class)->getMediaCollection('thumbnail'),
    'media' => !empty($conversation) ? $conversation->getThumbs200ForCollection('thumbnail'): null,
    'label' => 'Thumbnail'
])

@include('brackets/admin-ui::admin.includes.media-uploader', [
    'mediaCollection' => app(App\Models\Conversation::class)->getMediaCollection('gallery'),
    'media' => !empty($conversation) ? $conversation->getThumbs200ForCollection('gallery'): null,
    'label' => 'Background Images'
])

