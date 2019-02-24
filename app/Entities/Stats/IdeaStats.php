<?php

namespace Larahack\Entities\Stats;

use Sprocketbox\Articulate\Entities\Entity;

/**
 * Class Stats
 *
 * @property-read int                           $ideaId
 * @property-read \Larahack\Entities\Ideas\Idea $idea
 * @property-read int                           $feedbackCount
 * @property-read int                           $interestCount
 * @property-read int                           $wouldPayCount
 * @property-read int                           $wouldNewsletterCount
 *
 * @package Larahack\Entities\Ideas\Stats
 */
class IdeaStats extends Entity
{

}