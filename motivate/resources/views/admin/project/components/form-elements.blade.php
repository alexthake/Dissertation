<div class="form-group row align-items-center" :class="{'has-danger': errors.has('project_name'), 'has-success': fields.project_name && fields.project_name.valid }">
    <label for="project_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.project.columns.project_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.project_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('project_name'), 'form-control-success': fields.project_name && fields.project_name.valid}" id="project_name" name="project_name" placeholder="{{ trans('admin.project.columns.project_name') }}">
        <div v-if="errors.has('project_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('project_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('project_due'), 'has-success': fields.project_due && fields.project_due.valid }">
    <label for="project_due" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.project.columns.project_due') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.project_due" :config="datetimePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('project_due'), 'form-control-success': fields.project_due && fields.project_due.valid}" id="project_due" name="project_due" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('project_due')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('project_due') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('user_id'), 'has-success': fields.user_id && fields.user_id.valid }">
    <label for="user_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.project.columns.user_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.user_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('user_id'), 'form-control-success': fields.user_id && fields.user_id.valid}" id="user_id" name="user_id" placeholder="{{ trans('admin.project.columns.user_id') }}">
        <div v-if="errors.has('user_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('user_id') }}</div>
    </div>
</div>


