@props(['field'])

@section('plugins.Editor',true)

@push('js')
    
<script>
    ClassicEditor.create( document.querySelector( '#{{ $field }}' )

    , {
            
        toolbar: {
            items: [
                'heading',
                '|',
                'alignment',
                'bold',
                'italic',
                'underline',
                'fontSize',
                'strikethrough',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'insertTable',
                'horizontalLine',
                'undo',
                'redo',
                'removeFormat'
            ]
        },
        language: 'en',
        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells',
                'tableCellProperties'
            ]
        },
            licenseKey: '',       
        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( error );
        } );
</script>

@endpush
