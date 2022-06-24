@if ($errors->any())
    <div class="card-title alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="list-style: none;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('message'))
    <div class="card-title alert alert-danger">
        {{session()->get('message')}}
        {{session()->put('message', null)}}
    </div>
@endif

@if (session()->has('success'))
    <div class="card-title alert alert-success">
        {{session()->get('success')}}
        {{session()->put('success', null)}}
    </div>
@endif

@if (session()->has('error'))
    <div class="card-title alert alert-danger">
        {{session()->get('error')}}
        {{session()->put('error', null)}}
    </div>
@endif

