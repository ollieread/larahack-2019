<?php

namespace Larahack\Entities;

use Larahack\Entities\Ideas\Feedback\Criteria\OrderByRecentAndParent;
use Larahack\Entities\Ideas\Feedback\Feedback as FeedbackEntity;
use Larahack\Entities\Ideas\Feedback\FeedbackRepository;
use Larahack\Entities\Ideas\Idea;
use Larahack\Validators\Ideas\Feedback as Validators;

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
        return $this->feedbackRepository->pushCriteria(new OrderByRecentAndParent)->findForIdea($idea);
    }

    public function findOneById(int $id)
    {
        return $this->feedbackRepository->findOneById($id);
    }

    public function create(Idea $idea, Users\User $user, array $input): ?FeedbackEntity
    {
        Validators\CreateValidator::validate($input);

        $input['idea'] = $idea;
        $input['user'] = $user;

        if ($input['parent']) {
            $input['parent'] = $this->findOneById($input['parent']);
        }

        $feedback = (new FeedbackEntity)->create($input);

        if ($this->feedbackRepository->persist($feedback)) {
            return $feedback;
        }

        return null;
    }
}