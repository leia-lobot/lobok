@section('componentcss')
    @parent
    <style>
        .overlay{
            visibility: hidden;
            background-color: rgba(0, 0, 0, 0.7);
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay .cancel {
                position: absolute;
                width: 100%;
                height: 100%;
        }
        .overlay:target {
            visibility: visible;
        }
        .modal {
            position: relative;
            /* width: 1000px; */
            max-width: 80%;
            border-radius: 8px;
            padding: 1em 2em;
        }

        .modal .close {
            position: absolute;
            top: 25px;
            right: 15px;
            color: gray;
            text-decoration: none;
        }
    </style>    
@endsection

<div id="{{ $name }}" class="overlay">
    <a href="#" class="cancel"></a>
<div class="modal {{ $style }}" >
        {{ $slot }}
        <a href="#" class="close">&times;</a>
    </div>
</div>

