<div style="text-align: left">
    @if(!empty($errors->all()))
        <div class="alert alert-danger" role="alert">
        <ul style="padding-top: 10px;">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        </div>
    @endif
    @if(session()->has('message'))
        <div class="alert alert-success" role="alert">
            {{session()->get('message')}}
        </div>
    @endif
</div>

<div id="saved-success-message-div" class="alert alert-success alert-dismissible mb-10" role="alert" hidden>
    <h4 class="alert-heading">Success
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </h4>
    <div class="p-1">
        <p>Saved Successfully</p>
    </div>
</div>


<div id="error-message-div" class="alert alert-danger alert-dismissible mb-2" role="alert" hidden>
    <h4 class="alert-heading">Error
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </h4>
    <div class="p-1">
    </div>
</div>
