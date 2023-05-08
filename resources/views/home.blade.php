@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    
                    <form data-action="{{ route('call-api') }}" method="POST" enctype="multipart/form-data" id="call-api-form">
                        @csrf
                        <div class="form-group">
                          <label for="apiUserName">API User Name</label>
                          <input type="email" class="form-control" id="apiUserName" name="apiUserName" aria-describedby="apiUserNameHelp" placeholder="Enter email">
                          <small id="apiUserNameHelp" class="form-text text-muted">API User name</small>
                        </div>
                        <div class="form-group">
                            <label for="apiPassword">API Password</label>
                            <input type="password" class="form-control" id="apiPassword" name="apiPassword" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="apiMethod">API Method</label>
                            <select class="form-control" id="apiMethod" name="apiMethod">
                              <option value="GET">GET</option>
                              <option value="POST">POST</option>
                              <option value="DEL">DELETE</option>
                              <option value="PUT">PUT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="apiUrl">API Url</label>
                            <input type="text" class="form-control" id="apiUrl" name="apiUrl" aria-describedby="apiUrlHelp" placeholder="Enter api call url">
                            <small id="apiUrlHelp" class="form-text text-muted">API Url</small>
                        </div>
                        <div class="form-group">
                            <label for="apiResponse">Response</label>
                            <textarea class="form-control" id="apiResponse" rows="10" disabled></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                      <script type="text/javascript">

                                $(document).ready(function(){

                                var form = '#call-api-form';

                                $(form).on('submit', function(event){
                                    event.preventDefault();

                                    var url = $(this).attr('data-action');

                                    $.ajax({
                                        url: url,
                                        method: 'POST',
                                        data: new FormData(this),
                                        dataType: 'JSON',
                                        contentType: false,
                                        cache: false,
                                        processData: false,
                                        success:function(response)
                                        {
                                            $(form).trigger("reset");
                                            //console.log(response);
                                            // var obj = JSON.parse(response);
                                            var pretty = JSON.stringify(response, undefined, 4);
                                            console.log(pretty);
                                            $('#apiResponse').val(pretty);

                                        },
                                        error: function(response) {
                                        }
                                    });
                                });

                                });
                      </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
