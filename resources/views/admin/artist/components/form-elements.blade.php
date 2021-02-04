<div class="form-group row align-items-center" :class="{'has-danger': errors.has('artist_name'), 'has-success': fields.artist_name && fields.artist_name.valid }">
    <label for="artist_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.artist.columns.artist_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.artist_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('artist_name'), 'form-control-success': fields.artist_name && fields.artist_name.valid}" id="artist_name" name="artist_name" placeholder="{{ trans('admin.artist.columns.artist_name') }}">
        <div v-if="errors.has('artist_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('artist_name') }}</div>
    </div>
</div>


<div class="form-group row align-items-center" :class="{'has-danger': errors.has('artist_name'), 'has-success': fields.record && fields.record.valid }">
    <label for="artist_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.artist.columns.record') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.record" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('record'), 'form-control-success': fields.record && fields.record.valid}" id="record" name="record" placeholder="{{ trans('admin.artist.columns.record') }}">
        <div v-if="errors.has('record')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('record') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('artist_description'), 'has-success': fields.artist_description && fields.artist_description.valid }">
    <label for="artist_description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.artist.columns.artist_description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.artist_description" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('artist_description'), 'form-control-success': fields.artist_description && fields.artist_description.valid}" id="artist_description" name="artist_description" placeholder="{{ trans('admin.artist.columns.artist_description') }}">
        <div v-if="errors.has('artist_description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('artist_description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('artist_type'), 'has-success': fields.artist_type && fields.artist_type.valid }">
    <label for="artist_type" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.artist.columns.artist_type') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <select v-model="form.artist_type" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('artist_type'), 'form-control-success': fields.artist_type && fields.artist_type.valid}" id="artist_type" name="artist_type">
                <option value="" disabled selected>Choose Type</option>
                <option value="mixtape">Mix Tape</option>
                <option value="list_head">List Inside My Head</option>
            </select>

            <div v-if="errors.has('artist_type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('artist_type') }}</div>
    </div>
</div>

@include('brackets/admin-ui::admin.includes.media-uploader', [
    'mediaCollection' => app(App\Models\Artist::class)->getMediaCollection('gallery'),
    'media' => !empty($artist) ? $artist->getThumbs200ForCollection('gallery'): null,
    'label' => 'Image Banner'
])


