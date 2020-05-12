<div class="form-group row align-items-center" :class="{'has-danger': errors.has('section_name'), 'has-success': fields.section_name && fields.section_name.valid }">
    <label for="section_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.section.columns.section_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.section_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('section_name'), 'form-control-success': fields.section_name && fields.section_name.valid}" id="section_name" name="section_name" placeholder="{{ trans('admin.section.columns.section_name') }}">
        <div v-if="errors.has('section_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('section_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('section_due'), 'has-success': fields.section_due && fields.section_due.valid }">
    <label for="section_due" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.section.columns.section_due') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.section_due" :config="datetimePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('section_due'), 'form-control-success': fields.section_due && fields.section_due.valid}" id="section_due" name="section_due" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('section_due')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('section_due') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('project_id'), 'has-success': fields.project_id && fields.project_id.valid }">
    <label for="project_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.section.columns.project_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.project_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('project_id'), 'form-control-success': fields.project_id && fields.project_id.valid}" id="project_id" name="project_id" placeholder="{{ trans('admin.section.columns.project_id') }}">
        <div v-if="errors.has('project_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('project_id') }}</div>
    </div>
</div>


