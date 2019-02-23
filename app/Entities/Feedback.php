<?php

namespace Larahack\Entities;

use Larahack\Entities\Ideas\Feedback\FeedbackRepository;
use Larahack\Entities\Ideas\Idea;

class Feedback
{
    /**
     * @var \Larahack\Entities\Ideas\Feedback\FeedbackRepository
     */
    private $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function findForIdea(Idea $idea)
    {
        return $this->feedbackRepository->findForIdea($idea);
    }
}