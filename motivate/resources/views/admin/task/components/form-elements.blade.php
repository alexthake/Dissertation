<div class="form-group row align-items-center" :class="{'has-danger': errors.has('task_name'), 'has-success': fields.task_name && fields.task_name.valid }">
    <label for="task_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.task.columns.task_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.task_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('task_name'), 'form-control-success': fields.task_name && fields.task_name.valid}" id="task_name" name="task_name" placeholder="{{ trans('admin.task.columns.task_name') }}">
        <div v-if="errors.has('task_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('task_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('task_description'), 'has-success': fields.task_description && fields.task_description.valid }">
    <label for="task_description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.task.columns.task_description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.task_description" v-validate="'required'" id="task_description" name="task_description" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('task_description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('task_description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('task_due'), 'has-success': fields.task_due && fields.task_due.valid }">
    <label for="task_due" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.task.columns.task_due') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.task_due" :config="datetimePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('task_due'), 'form-control-success': fields.task_due && fields.task_due.valid}" id="task_due" name="task_due" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('task_due')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('task_due') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('task_completed'), 'has-success': fields.task_completed && fields.task_completed.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="task_completed" type="checkbox" v-model="form.task_completed" v-validate="''" data-vv-name="task_completed"  name="task_completed_fake_element">
        <label class="form-check-label" for="task_completed">
            {{ trans('admin.task.columns.task_completed') }}
        </label>
        <input type="hidden" name="task_completed" :value="form.task_completed">
        <div v-if="errors.has('task_completed')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('task_completed') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('completion_date'), 'has-success': fields.completion_date && fields.completion_date.valid }">
    <label for="completion_date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.task.columns.completion_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.completion_date" :config="datetimePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('completion_date'), 'form-control-success': fields.completion_date && fields.completion_date.valid}" id="completion_date" name="completion_date" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('completion_date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('completion_date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('task_priority'), 'has-success': fields.task_priority && fields.task_priority.valid }">
    <label for="task_priority" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.task.columns.task_priority') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.task_priority" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('task_priority'), 'form-control-success': fields.task_priority && fields.task_priority.valid}" id="task_priority" name="task_priority" placeholder="{{ trans('admin.task.columns.task_priority') }}">
        <div v-if="errors.has('task_priority')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('task_priority') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('task_progress_weight'), 'has-success': fields.task_progress_weight && fields.task_progress_weight.valid }">
    <label for="task_progress_weight" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.task.columns.task_progress_weight') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.task_progress_weight" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('task_progress_weight'), 'form-control-success': fields.task_progress_weight && fields.task_progress_weight.valid}" id="task_progress_weight" name="task_progress_weight" placeholder="{{ trans('admin.task.columns.task_progress_weight') }}">
        <div v-if="errors.has('task_progress_weight')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('task_progress_weight') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('section_id'), 'has-success': fields.section_id && fields.section_id.valid }">
    <label for="section_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.task.columns.section_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.section_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('section_id'), 'form-control-success': fields.section_id && fields.section_id.valid}" id="section_id" name="section_id" placeholder="{{ trans('admin.task.columns.section_id') }}">
        <div v-if="errors.has('section_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('section_id') }}</div>
    </div>
</div>


