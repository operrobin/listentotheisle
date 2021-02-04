
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('artist_id'), 'has-success': fields.artist_id && fields.artist_id.valid }">
    <label for="artist_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.song-collection.columns.artist_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select type="text" v-model="form.artist_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('artist_id'), 'form-control-success': fields.artist_id && fields.artist_id.valid}" id="artist_id" name="artist_id" >
            <option value="" disabled selected>Choose Artist</option>
            @foreach(\App\Models\Artist::where('artist_type', 'list_head')->get() as $artist)
                <option value="{{ $artist->id }}">{{ $artist->artist_name }}</option>
            @endforeach
        </select>
            <div v-if="errors.has('artist_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('artist_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('short_description'), 'has-success': fields.short_description && fields.short_description.valid }">
    <label for="short_description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.youtube-collection.columns.short_description') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea class="form-control" v-model="form.short_description" v-validate="'required'" id="short_description" name="short_description"></textarea>
        </div>
        <div v-if="errors.has('short_description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('short_description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('title'), 'has-success': fields.title && fields.title.valid }">
    <label for="title" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.youtube-collection.columns.title') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.title" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': fields.title && fields.title.valid}" id="title" name="title" placeholder="{{ trans('admin.youtube-collection.columns.title') }}">
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('youtube_url'), 'has-success': fields.youtube_url && fields.youtube_url.valid }">
    <label for="youtube_url" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.youtube-collection.columns.youtube_url') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.youtube_url" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('youtube_url'), 'form-control-success': fields.youtube_url && fields.youtube_url.valid}" id="youtube_url" name="youtube_url" placeholder="{{ trans('admin.youtube-collection.columns.youtube_url') }}">
        <div v-if="errors.has('youtube_url')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('youtube_url') }}</div>
    </div>
</div>


