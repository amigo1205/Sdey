@extends('auth.sitehelpmaster')
@section('title')
login
@endsection
@section('helptitle')
About Us
@endsection
@section('content')
  <?php echo html_entity_decode($helpdata->about_us); ?>
@endsection
