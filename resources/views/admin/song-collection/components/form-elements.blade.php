<div class="form-group row align-items-center" :class="{'has-danger': errors.has('song_name'), 'has-success': fields.song_name && fields.song_name.valid }">
    <label for="song_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.song-collection.columns.song_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.song_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('song_name'), 'form-control-success': fields.song_name && fields.song_name.valid}" id="song_name" name="song_name" placeholder="{{ trans('admin.song-collection.columns.song_name') }}">
        <div v-if="errors.has('song_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('song_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('song_description'), 'has-success': fields.song_description && fields.song_description.valid }">
    <label for="song_description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.song-collection.columns.song_description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <textarea maxlength="255" type="text" v-model="form.song_description" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('song_description'), 'form-control-success': fields.song_description && fields.song_description.valid}" id="song_description" name="song_description" placeholder="{{ trans('admin.song-collection.columns.song_description') }}">
        </textarea>
            <div v-if="errors.has('song_description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('song_description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('artist_id'), 'has-success': fields.artist_id && fields.artist_id.valid }">
    <label for="artist_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.song-collection.columns.artist_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select type="text" v-model="form.artist_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('artist_id'), 'form-control-success': fields.artist_id && fields.artist_id.valid}" id="artist_id" name="artist_id" >
            <option value="" disabled selected>Choose Artist</option>
            @foreach(\App\Models\Artist::where('artist_type', 'mixtape')->get() as $artist)
                <option value="{{ $artist->id }}">{{ $artist->artist_name }}</option>
            @endforeach
        </select>
            <div v-if="errors.has('artist_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('artist_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('soundcloud_url'), 'has-success': fields.soundcloud_url && fields.soundcloud_url.valid }">
    <label for="soundcloud_url" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.song-collection.columns.soundcloud_url') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.soundcloud_url" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('soundcloud_url'), 'form-control-success': fields.soundcloud_url && fields.soundcloud_url.valid}" id="soundcloud_url" name="soundcloud_url" placeholder="{{ trans('admin.song-collection.columns.soundcloud_url') }}">
        <div v-if="errors.has('soundcloud_url')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('soundcloud_url') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('mixcloud_url'), 'has-success': fields.mixcloud_url && fields.mixcloud_url.valid }">
    <label for="mixcloud_url" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.song-collection.columns.mixcloud_url') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.mixcloud_url" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('mixcloud_url'), 'form-control-success': fields.mixcloud_url && fields.mixcloud_url.valid}" id="mixcloud_url" name="mixcloud_url" placeholder="{{ trans('admin.song-collection.columns.mixcloud_url') }}">
        <div v-if="errors.has('mixcloud_url')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('mixcloud_url') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('website_url'), 'has-success': fields.website_url && fields.website_url.valid }">
    <label for="website_url" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.song-collection.columns.website_url') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.website_url" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('website_url'), 'form-control-success': fields.website_url && fields.website_url.valid}" id="website_url" name="website_url" placeholder="{{ trans('admin.song-collection.columns.website_url') }}">
        <div v-if="errors.has('website_url')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('website_url') }}</div>
    </div>
</div>

@include('brackets/admin-ui::admin.includes.media-uploader', [
    'mediaCollection' => app(App\Models\SongCollection::class)->getMediaCollection('song_file'),
    'media' => !empty($songCollection) ? $songCollection->getMedia('song_file'): null,
    'label' => 'Mp3 File'
])


