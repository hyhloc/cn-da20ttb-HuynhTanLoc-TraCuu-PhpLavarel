<div class="form-group">
	<label class="control-label col-md-2 col-sm-2 col-xs-12">@if($value['required']==1)<span class="form-asterick">* </span>@endif {!! $value['title'] !!}</label>
	<div class="controls col-md-9 col-sm-10 col-xs-12">
		<textarea id="{!! $value['name'] !!}" name="{!! $value['name'] !!}">{!! $value['value'] !!}</textarea>
		<script>
            document.addEventListener("DOMContentLoaded", function(event) {
                tinymce.init({
                    path_absolute : "/",
                    selector:'textarea[id="{!! $value['name'] !!}"]',
                    branding: false,
                    hidden_input: false,
                    relative_urls: false,
                    convert_urls: false,
                    height : 400,
                    autosave_ask_before_unload:true,
                    autosave_interval:'10s',
                    autosave_restore_when_empty:true,
                    entity_encoding : "raw",
                    fontsize_formats: "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 22pt 24pt 26pt 28pt 30pt 32pt 36pt 40pt 46pt 52pt 60pt",
                    plugins: [
                        "textcolor",
                        "advlist autolink lists link image media imagetools charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table autosave contextmenu paste wordcount"
                    ],
                    wordcount_countregex: /[\w\u2019\x27\-\u00C0-\u1FFF]+/g,
                    autosave_retention:"30m",
                    autosave_prefix: "tinymce-autosave-{path}{query}-{id}-",
                    wordcount_cleanregex: /[0-9.(),;:!?%#$?\x27\x22_+=\\\/\-]*/g,
                    toolbar: "insertfile image  undo redo table sudomedia charmap | styleselect | sizeselect | bold italic | fontselect |  fontsizeselect | forecolor " +
                        "backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent " +
                        "indent | link unlink fullscreen restoredraft filemanager",
                });
            });
		</script>
	</div>
</div>
