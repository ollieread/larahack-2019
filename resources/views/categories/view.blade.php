@extends('layouts.main')

@section('content')
    <div class="grid--horizontal">
        <aside class="sidebar sidebar--left">
            <section class="box">
                <header class="box__header">
                    Categories
                </header>

                <main class="box__content">
                    @foreach ($categories as $category)
                        <div class="box__item">
                            <a href="{{ route('category.view', $category->slug) }}"
                               class="box__item-link">{{ $category->name }}</a>
                        </div>
                    @endforeach
                </main>
            </section>
        </aside>
        <main class="content">
            <section class="box">
                <header class="box__header--primary">
                    {{ $category->name }}
                </header>
                <main class="box__content">
                    <div class="box__item item">
                        <div class="item__description">
                            {{ $category->description }}
                        </div>
                    </div>
                </main>
            </section>

            <section class="box">
                <header class="box__header">
                    Ideas
                </header>
                <main class="box__content">
                    @foreach ($ideas as $idea)
                        <div class="box__item">
                            <a href="{{ route('idea.view', $idea->slug) }}" class="item--link item--options">
                                <div class="item__title">
                                    {{ $idea->title }}
                                </div>
                                <div class="item__description">
                                    {{ $idea->excerpt }}
                                </div>
                            </a>
                            <div class="item__controls">
                                <a href="#" class="button item__control">
                                    <i class="button__icon fas fa-thumbs-up fa-fw"></i>
                                    I'm interested
                                </a>
                                <a href="#" class="button item__control">
                                    <i class="button__icon fas fa-comments fa-fw"></i>
                                    Feedback
                                </a>
                            </div>
                        </div>
                    @endforeach
                </main>
            </section>
        </main>
    </div>
@endsection