@extends('layouts.main')

@section('content')
    <div class="grid--horizontal">
        <main class="content content--center">
            <section class="box">
                <header class="box__header">
                    Categories
                </header>
                <main class="box__content">
                    @foreach ($categories as $category)
                        <div class="box__item">
                            <a href="{{ route('category:view', $category->slug) }}" class="item--link item--options">
                                <div class="item__title">
                                    {{ $category->name }}
                                </div>
                                <div class="item__description">
                                    {!! $category->parsedDescription !!}
                                </div>
                            </a>
                            <div class="item__controls">
                                <a href="#" class="button item__control">
                                    <i class="button__icon fas fa-lightbulb fa-fw"></i>
                                    {{ $category->stats->ideaCount }} Ideas
                                </a>
                                <a href="#" class="button item__control">
                                    <i class="button__icon fas fa-users fa-fw"></i>
                                    {{ $category->stats->userCount }} Users
                                </a>
                                <a href="#" class="button item__control">
                                    <i class="button__icon fas fa-comments fa-fw"></i>
                                    {{ $category->stats->feedbackCount }} Feedback
                                </a>
                            </div>
                        </div>
                    @endforeach
                </main>
            </section>

            {{ $categories->links('components.pagination') }}
        </main>
    </div>
@endsection