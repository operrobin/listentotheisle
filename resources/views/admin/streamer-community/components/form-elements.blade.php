<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.streamer-community.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.streamer-community.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('streamer_name'), 'has-success': fields.streamer_name && fields.streamer_name.valid }">
    <label for="streamer_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.streamer-community.columns.streamer_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.streamer_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('streamer_name'), 'form-control-success': fields.streamer_name && fields.streamer_name.valid}" id="streamer_name" name="streamer_name" placeholder="{{ trans('admin.streamer-community.columns.streamer_name') }}">
        <div v-if="errors.has('streamer_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('streamer_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': fields.description && fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.streamer-community.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea v-model="form.description" v-validate="'required'" id="description" name="description" class="form-control"></textarea>
        </div>
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('twitch_url'), 'has-success': fields.twitch_url && fields.twitch_url.valid }">
    <label for="twitch_url" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.streamer-community.columns.twitch_url') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.twitch_url" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('twitch_url'), 'form-control-success': fields.twitch_url && fields.twitch_url.valid}" id="twitch_url" name="twitch_url" placeholder="{{ trans('admin.streamer-community.columns.twitch_url') }}">
        <div v-if="errors.has('twitch_url')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('twitch_url') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('soundcloud_url'), 'has-success': fields.soundcloud_url && fields.soundcloud_url.valid }">
    <label for="soundcloud_url" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.streamer-community.columns.soundcloud_url') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.soundcloud_url" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('soundcloud_url'), 'form-control-success': fields.soundcloud_url && fields.soundcloud_url.valid}" id="soundcloud_url" name="soundcloud_url" placeholder="{{ trans('admin.streamer-community.columns.soundcloud_url') }}">
        <div v-if="errors.has('soundcloud_url')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('soundcloud_url') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('mixcloud_url'), 'has-success': fields.mixcloud_url && fields.mixcloud_url.valid }">
    <label for="mixcloud_url" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.streamer-community.columns.mixcloud_url') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.mixcloud_url" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('mixcloud_url'), 'form-control-success': fields.mixcloud_url && fields.mixcloud_url.valid}" id="mixcloud_url" name="mixcloud_url" placeholder="{{ trans('admin.streamer-community.columns.mixcloud_url') }}">
        <div v-if="errors.has('mixcloud_url')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('mixcloud_url') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('website_url'), 'has-success': fields.website_url && fields.website_url.valid }">
    <label for="website_url" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.streamer-community.columns.website_url') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.website_url" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('website_url'), 'form-control-success': fields.website_url && fields.website_url.valid}" id="website_url" name="website_url" placeholder="{{ trans('admin.streamer-community.columns.website_url') }}">
        <div v-if="errors.has('website_url')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('website_url') }}</div>
    </div>
</div>



@include('brackets/admin-ui::admin.includes.media-uploader', [
    'mediaCollection' => app(App\Models\StreamerCommunity::class)->getMediaCollection('gallery'),
    'media' => !empty($streamerCommunity) ? $streamerCommunity->getThumbs200ForCollection('gallery'): null,
    'label' => 'Image Banner'
])
