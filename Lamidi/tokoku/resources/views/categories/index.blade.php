@extends('layouts.app')
@section('content')
<a href="{{route('subcategories.index')}}">Sub Category</a>
@livewire('category')
@endsection