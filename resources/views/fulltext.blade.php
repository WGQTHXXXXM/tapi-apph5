@extends('layouts.fulltext')

@section('content')
<div class="quill-editor">
    <div class="ql-container ql-bubble">
        <div class="ql-editor" id="content">
            {!! $fulltext !!}
        </div>
    </div>
</div>
@endsection

