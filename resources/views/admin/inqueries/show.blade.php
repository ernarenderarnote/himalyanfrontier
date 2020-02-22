@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Inquery Details
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="general_details">
                    <h3>{{$inquery->itinerary->title}}</h3><hr/>
                    <p><span><b>Name:</b> </span>{{$inquery->Name}}</p>
                    <p><span><b>Email:</b> </span>{{$inquery->email}}</p>
                    <p><span><b>Phone:</b> </span>{{$inquery->phone}}</p>
                    <p><span><b>Subject:</b> </span>{{$inquery->subject}}</p>
                    <p><span><b>Message:</b> </span>{{$inquery->message}}</p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="general_details">
                        
                        <div class="well well-sm">
                            <form class="form-horizontal" action="{{ route("admin.inqueries.update", [$inquery->id]) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <fieldset>
                                    <h3>Respond to Inquery</h3><hr/>
                                    <!-- Email input-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="email">E-mail</label>
                                        <div class="col-md-9">
                                            <input id="email" name="email" type="text" value="{{$inquery->email}}" placeholder="Your email" class="form-control" readonly>
                                        </div>
                                    </div>
                            
                                    <!-- Message body -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="message">Message</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="message" name="reply_message" placeholder="Please enter your message here..." rows="5"></textarea>
                                        </div>
                                    </div>
                            
                                    <!-- Form actions -->
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-lg">Reply</button>
                                    </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                </div>
            </div>
        </div>
            
    </div>
</div>    

@endsection