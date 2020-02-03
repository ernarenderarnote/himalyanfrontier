@extends('layouts.frontend')
@section('content')
<div class="container">
	<div class="row">
	<div class="col-md-12 profile-form">
			<h4>Profile Details</h4>
			
			<form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
          		@csrf
				<div class="row">
				
				  <div class="col">
						<label for="firstname">Firstname*</label>
						<input type="text" value="{{ old('first_name', isset($user->name) ? $user->name : '') }}" class="form-control" id="first-name" placeholder="Enter First Name" name="first_name">
				  		@if($errors->has('first_name'))
								<em class="invalid-feedback">
									{{ $errors->first('first_name') }}
								</em>
						@endif
					</div>
				  
				  <div class="col">
						<label for="lastname">Last Name*</label>
						<input type="text" value="{{ old('last_name', isset($user->last_name) ? $user->last_name : '') }}" class="form-control" placeholder="Enter last name" name="last_name">
						@if($errors->has('last_name'))
								<em class="invalid-feedback">
									{{ $errors->first('last_name') }}
								</em>
						@endif
					</div>
				</div>  
				<div class="row">
					<div class="col">
						<label for="email">Email*</label>
						<input type="text" value="{{ old('email', isset($user->email) ? $user->email : '') }}" class="form-control" id="" placeholder="Enter email" name="email" >
						@if($errors->has('email'))
								<em class="invalid-feedback">
										{{ $errors->first('email') }}
								</em>
						@endif
					</div>
					  
					<div class="col">
						<label for="mobile">Mobile*</label>
						<input type="text" value="{{ old('phone', isset($user->phone) ? $user->phone : '') }}" class="form-control" placeholder="Enter mobile number" name="phone">
						@if($errors->has('phone'))
								<em class="invalid-feedback">
										{{ $errors->first('phone') }}
								</em>
						@endif
					</div>
				</div> 
				<div class="row">
					<div class="col">
            <label for="age">Age*</label>
						<input type="text" value="{{ old('age', isset($user->profile->age) ? $user->profile->age : '') }}" class="form-control" id="age" placeholder="Enter age" name="age">
						@if($errors->has('age'))
								<em class="invalid-feedback">
										{{ $errors->first('age') }}
								</em>
						@endif
					</div>
					  
					<div class="col">
						<label for="gender">Gender*</label>
						@if( isset($user->profile->gender) && $user->profile->gender != '' )
							@php $gender = $user->profile->gender; @endphp
							
							@else
							@php $gender = ''; @endphp
						@endif
						
						<select class="browser-default custom-select" name="gender" value="">
							<option value="male" {{$gender == 'male' ? 'selected' : '' }} >Male</option>
							<option value="female" {{$gender == 'female' ? 'selected' : '' }}>Female</option>
						</select>
						@if($errors->has('gender'))
								<em class="invalid-feedback">
										{{ $errors->first('gender') }}
								</em>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label for="height">Height(in cms)*</label>
						<input type="text" class="form-control" value="{{ old('gender', isset($user->profile->height) ? $user->profile->height : '') }}" id="height" placeholder="Enter height" name="height">
						@if($errors->has('height'))
								<em class="invalid-feedback">
										{{ $errors->first('height') }}
								</em>
						@endif
					</div>
					  
					<div class="col">
						<label for="weight">weight*</label>
						<input type="text" class="form-control" value="{{ old('weight', isset($user->profile->weight) ? $user->profile->weight : '') }}" placeholder="Enter Weight" name="weight">
						@if($errors->has('weight'))
								<em class="invalid-feedback">
										{{ $errors->first('weight') }}
								</em>
						@endif
					</div>
				</div> 
				<div class="row">
					<div class="col">
						<label for="height">Address</label>
						<textarea class="form-control"  name="address" cols='3' rows="3">{{ old('address', isset($user->profile->address) ? $user->profile->address : '') }}</textarea>
						@if($errors->has('address'))
								<em class="invalid-feedback">
										{{ $errors->first('address') }}
								</em>
						@endif
					</div>
					  
				</div> 			
				<button type="submit" class="btn btn-primary mt-3">Submit</button>
				
			</form>
		
		</div>
</div>	
</div> 
@endsection