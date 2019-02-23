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
                    </div>

                    <div class="box__footer">
                        <a href="#" class="button button--large box__footer-link">
                            <i class="button__icon fas fa-thumbs-up fa-fw"></i>
                            I'm interested
                        </a>
                        <a href="#" class="button button--large box__footer-link">
                            <i class="button__icon fas fa-comments fa-fw"></i>
                            Feedback
                        </a>
                    </div>
                </main>
            </section>

            @foreach ($feedback as $feedback)
                <section class="comment">
                    <div class="comment__author">
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
                        <a href="#" class="item--link item--no-options">
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