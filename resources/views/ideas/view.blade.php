@extends('layouts.main')

@section('content')
    <div class="grid--horizontal">
        <main class="content">
            <section class="box">
                <header class="box__header--primary">
                    {{ $idea->title }}
                </header>
                <main class="box__content">
                    <div class="box__item item">
                        <div class="item__description">
                            {{ $idea->content }}
                        </div>
                        <div class="item__stats">
                            <div class="item__stat">
                                <i class="item__stat-icon fas fa-comments fa-fw"></i>
                                {{ $idea->stats->feedbackCount }}
                                <span class="item__stat-text">Pieces of feedback</span>
                            </div>
                            <div class="item__stat">
                                <i class="item__stat-icon fas fa-thumbs-up fa-fw"></i>
                                {{ $idea->stats->interestCount }}
                                <span class="item__stat-text">Users Interested</span>
                            </div>
                            <div class="item__stat">
                                <i class="item__stat-icon fas fa-credit-card-blank fa-fw"></i>
                                {{ $idea->stats->wouldPayCount }}
                                <span class="item__stat-text">Users would pay</span>
                            </div>
                            <div class="item__stat">
                                <i class="item__stat-icon fas fa-newspaper fa-fw"></i>
                                {{ $idea->stats->wouldNewsletterCount }}
                                <span class="item__stat-text">Users would subscribe</span>
                            </div>
                        </div>
                    </div>
                </main>
            </section>

            @if ($currentUser)
                <section class="comment">
                    <div class="comment__author user__avatar">
                        <img src="{{ $currentUser->avatar }}" alt="" class="comment__author-avatar">
                    </div>
                    <div class="comment__message">
                        <textarea name="content" rows="5" class="comment__message-input"></textarea>

                        <footer class="comment__options">
                            <a href="#" class="button">
                                <i class="button__icon fas fa-check fa-fw"></i> Post
                            </a>
                        </footer>
                    </div>
                </section>
            @endif

            @foreach ($feedback as $feedback)
                <section class="comment">
                    <div class="comment__author user__avatar">
                        <img src="{{ $feedback->user->avatar }}" alt="" class="comment__author-avatar">
                    </div>
                    <div class="comment__message">
                        {{ $feedback->content }}

                        <footer class="comment__options">
                            <a href="#" class="button">
                                <i class="button__icon fas fa-flag fa-fw"></i> Report
                            </a>
                            <a href="#" class="button">
                                <i class="button__icon fas fa-comment fa-fw"></i> Respond
                            </a>
                        </footer>
                    </div>
                </section>
            @endforeach
        </main>

        <aside class="sidebar sidebar--right">
            <section class="box">
                <header class="box__header">
                    Category
                </header>

                <main class="box__content">
                    <div class="box__item">
                        <a href="{{ route('category:view', $idea->category->slug) }}"
                           class="item--link item--no-options">
                            <div class="item__title">
                                {{ $idea->category->name }}
                            </div>
                            <div class="item__description">
                                {{ $idea->category->description }}
                            </div>
                        </a>
                    </div>
                </main>
            </section>
        </aside>
    </div>
@endsection