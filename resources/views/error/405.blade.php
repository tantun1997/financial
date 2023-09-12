@extends('layouts.error-layout')
@section('title', 'Method Not Allowed')
@section('content')
<div class="flex items-center pt-8 sm:justify-start sm:pt-0">
    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider"> 405 </div>
    <div class="ml-4 text-lg text-gray-300 uppercase tracking-wider"> Method Not Allowed<br><span class="text-sm text-gray-600">{{ session('error') }}</span> </div>
</div>
<div class="flex items-center pt-8 mt-4 sm:justify-start sm:pt-0 border-t">
    <a class="text-lg text-gray-200 uppercase pt-4" href="javascript:history.back()"><i class="fas fa-arrow-left me-1"></i>  Go Back </a>
</div>  
@endsection