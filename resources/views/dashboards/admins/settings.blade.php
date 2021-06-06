@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Settings')
    
@section('content')
<div class="content-wrapper px-4 py-2 ml-1">
	<div class="content-header">
		<h1 class="text-dark">Cards Component</h1>
    </div>

    <div class="content px-2">
		<p>The card component is the most widely used component through out this template. You can use it for anything from displaying charts to just blocks of text. It comes in many different styles that we will explore below.</p>

 <h5 class="text-bold text-dark mt-5">Default Card Markup</h5>

  <div class="card">
  <div class="card-header">
    <h3 class="card-title">Default Card Example</h3>
    <div class="card-tools">
      <span class="badge badge-primary">Label</span>
    </div>
  </div>
  <div class="card-body">
    The body of the card
  </div>
  <div class="card-footer">
    The footer of the card
  </div>
  </div>
</div>
  
@endsection