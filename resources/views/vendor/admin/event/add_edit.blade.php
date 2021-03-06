<div class="col-sm-6">
	<div class="md-form-group">
		<input name="name" type="text" class="md-input" id="label1" value="{{ Admin::inputValue('name') }}" required>
		<label>Title En</label>
	</div>
</div>
<div class="col-sm-6">
	<div class="md-form-group">
		<input name="name_locale_id" type="text" class="md-input" id="label1" value="{{ Admin::inputValue('name_locale_id') }}" required>
		<label>Title Id</label>
	</div>
</div>
<div class="col-sm-12">
	<div class="md-form-group">
		<input name="short_desc" type="text" class="md-input" id="label1" value="{{ Admin::inputValue('short_desc') }}" required>
		<label>Short Description En</label>
	</div>
</div>
<div class="col-sm-12">
	<div class="md-form-group">
		<input name="short_desc_locale_id" type="text" class="md-input" id="label1" value="{{ Admin::inputValue('short_desc_locale_id') }}" required>
		<label>Short Description Id</label>
	</div>
</div>
<div class="col-sm-4">
	<div class="md-form-group">
		<input name="start_date" type="text" class="md-input datepicker" id="label1" data-value="{{ Admin::inputValue('start_date') }}" value="{{ Admin::inputValue('start_date') }}" required>
		<label>Start Date</label>
	</div>
</div>
<div class="col-sm-4">
	<div class="md-form-group">
		<input name="finish_date" type="text" class="md-input datepicker" id="label1" data-value="{{ Admin::inputValue('finish_date') }}" value="{{ Admin::inputValue('finish_date') }}" required>
		<label>Finish Date</label>
	</div>
</div>
<div class="col-sm-4">
	<div class="md-form-group">
		<input name="publish_date" type="text" class="md-input datepicker" data-value="{{ Admin::inputValue('publish_date') }}" id="label1" value="{{ Admin::inputValue('publish_date') }}" required>
		<label>Publish Date</label>
	</div>
</div>
<div class="col-sm-4">
	<div class="md-form-group">
		{!! \Form::select('is_seminar', ['N' => 'No', 'Y' => 'Yes'], Admin::inputValue('is_seminar'), ['class' => 'md-input', 'required' => true]) !!}
		<label>Is Seminar</label>
	</div>
</div>
<div class="col-sm-12">
    <div class="md-form-group">
        <textarea name="home_display" class="md-input summernote" required>{!! Admin::inputValue('home_display') !!}</textarea>
        <label>Home Display En</label>
    </div>
</div>
<div class="col-sm-12">
    <div class="md-form-group">
        <textarea name="home_display_locale_id" class="md-input summernote" required>{!! Admin::inputValue('home_display_locale_id') !!}</textarea>
        <label>Home Display Id</label>
    </div>
</div>
<div class="col-sm-12">
	<div class="md-form-group">
		<textarea name="desc" class="md-input summernote" required>{!! Admin::inputValue('desc') !!}</textarea>
		<label>Description En</label>
	</div>
</div>
<div class="col-sm-12">
	<div class="md-form-group">
		<textarea name="desc_locale_id" class="md-input summernote" required>{!! Admin::inputValue('desc_locale_id') !!}</textarea>
		<label>Description Id</label>
	</div>
</div>
<div class="col-sm-6">
	<label for="label1">Image</label>
	@if (Input::get('id') && Admin::inputValue('img'))
	<p>
		{!! HTML::image(asset('contents/'.Admin::inputValue('img')), Admin::inputValue('img'), array('width' => 100)) !!}
	</p><br/>
	@endif
	{!! \Form::file('img') !!}
</div>