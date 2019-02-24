@extends('layouts.main')

@section('content')
    <div class="grid--horizontal">
        <aside class="sidebar sidebar--left">
            <section class="box">
                <header class="box__header">
                    Child Categories
                </header>

                <main class="box__content">
                    @if ($categories && $categories->count())
                        @foreach ($categories as $category)
                            <div class="box__item">
                                <a href="{{ route('category:view', $category->slug) }}"
                                   class="box__item-link">{{ $category->name }}</a>
                            </div>
                        @endforeach
                    @else
                        <div class="box__item item">
                            <div class="item__description">
                                This category has no children, perhaps it's focusing on its career.
                            </div>
                        </div>
                    @endif
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
                            {!! $category->parsedDescription !!}
                        </div>
                        <div class="item__stats">
                            <div class="item__stat">
                                <i class="item__stat-icon fas fa-lightbulb fa-fw"></i>
                                {{ $category->stats->ideaCount }}
                                <span class="item__stat-text">Ideas</span>
                            </div>
                            <div class="item__stat">
                                <i class="item__stat-icon fas fa-users fa-fw"></i>
                                {{ $category->stats->userCount }}
                                <span class="item__stat-text">Users</span>
                            </div>
                            <div class="item__stat">
                                <i class="item__stat-icon fas fa-comments fa-fw"></i>
                                {{ $category->stats->feedbackCount }}
                                <span class="item__stat-text">Pieces of feedback</span>
                            </div>
                            <div class="item__stat">
                                <i class="item__stat-icon fas fa-user-headset fa-fw"></i>
                                {{ $category->stats->feedbackUserCount }}
                                <span class="item__stat-text">Users giving feedback</span>
                            </div>
                        </div>
                    </div>
                </main>
            </section>

            <section class="box">
                <header class="box__header">
                    Ideas
                </header>
                <main class="box__content">
                    @if ($ideas && $ideas->count())
                        @foreach ($ideas as $idea)
                            <div class="box__item">
                                <a href="{{ route('idea:view', $idea->slug) }}" class="item--link item--options item--cta">
                                    <div class="item__title">
                                        {{ $idea->title }}
                                    </div>
                                    <div class="item__description">
                                        {{ $idea->excerpt }}
                                    </div>
                                </a>
                                <div class="item__controls">
                                    <a href="#" class="button item__control">
                                        <i class="button__icon fas fa-comments fa-fw"></i>
                                        {{ $idea->stats->feedbackCount }}
                                    </a>
                                    <a href="{{ route('category:view', $idea->category->slug) }}"
                                       class="item__info item__control">
                                        <i class="item__info-icon far fa-folder fa-fw"></i>
                                        {{ $idea->category->name }}
                                    </a>
                                    <time class="item__info item__control">
                                        <i class="item__info-icon far fa-clock fa-fw"></i>
                                        {{ $idea->createdAt->format('jS F Y \a\t g:ia') }}
                                    </time>
                                </div>
                                <div class="item__cta">
                                    <a href="#" class="item__cta-button">
                                        <i class="item__cta-button-icon fas fa-thumbs-up fa-fw"></i>
                                        {{ $idea->stats->interestCount }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="box__item item">
                            <div class="item__description">
                                I'm afraid there are no ideas in this category. Why not be the one to
                                <a href="{{ route('idea:create') }}?category={{ $category->id }}" class="button">
                                    <i class="button__icon fas fa-plus fa-fw"></i>
                                    add one
                                </a>
                            </div>
                        </div>
                    @endif
                </main>
            </section>
        </main>
    </div>
@endsection