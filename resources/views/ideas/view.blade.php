@extends('layouts.main')

@section('content')
    <div class="idea">
        <div class="idea__content">
            <a href="{{ route('idea.view', $idea->slug) }}" class="idea__title">{{ $idea->title }}</a>
            <a href="{{ route('category.view', $idea->category->slug) }}"
               class="idea__category">{{ $idea->category->name }}</a>
            <div class="idea__excerpt">
                {{ $idea->content }}
            </div>
        </div>
    </div>
@endsection