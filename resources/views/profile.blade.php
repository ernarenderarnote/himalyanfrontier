@extends('layouts.frontend')
@section('content')
<div class="container">
	<div class="row">
	<div class="col-md-12 profile-form">
			<h2>Update Profile Details</h2>
			
			<form action="/action_page.php">
			
				<div class="row">
				
				  <div class="col">
					<label for="firstname">Firstname*</label>
					<input type="text" class="form-control" id="first-name" placeholder="Enter First Name" name="first_name">
				  </div>
				  
				  <div class="col">
					<label for="lastname">Last Name*</label>
					<input type="text" class="form-control" placeholder="Enter last name" name="last_name">
				  </div>
				</div>  
				<div class="row">
					<div class="col">
						<label for="email">Email*</label>
						<input type="text" class="form-control" id="first-name" placeholder="Enter email" name="email">
					</div>
					  
					<div class="col">
						<label for="mobile">Mobile*</label>
						<input type="text" value="{{Auth::user()->phone}}" class="form-control" placeholder="Enter mobile number" name="mobile_number">
					  </div>
				</div> 
				<div class="row">
					<div class="col">
						<label for="age">Age*</label>
						<input type="text" class="form-control" id="age" placeholder="Enter age" name="age">
					</div>
					  
					<div class="col">
						<label for="gender">Gender*</label>
						<select class="browser-default custom-select" name="gender">
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					  </div>
				</div>
				<div class="row">
					<div class="col">
						<label for="height">Height(in cms)*</label>
						<input type="text" class="form-control" id="height" placeholder="Enter height" name="height">
					</div>
					  
					<div class="col">
						<label for="weight">weight*</label>
						<input type="text" class="form-control" placeholder="Enter Weight" name="weight">
					  </div>
				</div> 
				<div class="row">
					<div class="col">
						<label for="height">Address</label>
						<textarea class="form-control" name="address" cols='3' rows="3"></textarea>
					</div>
					  
				</div> 			
				<button type="submit" class="btn btn-primary mt-3">Register</button>
				
			</form>
		
		</div>
</div>	
</div> 
@endsection