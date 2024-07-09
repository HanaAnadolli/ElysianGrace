@props(['id', 'name', 'value' => ''])

<textarea id="{{ $id }}" name="{{ $name }}" {!! $attributes->merge(['class' => 'form-control']) !!}>
    {{ $value }}
</textarea>

@push('scripts')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    function initializeCKEditor() {
        CKEDITOR.replace('{{ $id }}', {
            on: {
                instanceReady: function(event) {
                    // Apply dark mode styles to editor content
                    event.editor.document.$.body.style.backgroundColor = '#1F2937';
                    event.editor.document.$.body.style.color = '#fff';

                    // Apply dark mode styles to toolbar buttons
                    var toolbar = document.querySelector('.cke_top');
                    if (toolbar) {
                        toolbar.style.backgroundColor = '#1F2937';
                        toolbar.style.color = '#fff';

                        // Change toolbar buttons to white
                        var buttons = toolbar.querySelectorAll('.cke_button');
                        buttons.forEach(function(button) {
                            button.style.backgroundColor = '#ffffff';
                            // If you want to change the text or icon color:
                            button.style.color = '#000'; // or any color you want
                        });
                    }

                    // Apply dark mode styles to footer
                    var footer = document.querySelector('.cke_bottom');
                    if (footer) {
                        footer.style.backgroundColor = '#1F2937';
                        footer.style.color = '#fff';
                    }
                }
            }
        });
    }

    if (document.readyState === 'complete') {
        initializeCKEditor();
    } else {
        window.addEventListener('load', initializeCKEditor);
    }
</script>
@endpush


