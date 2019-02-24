<?php

namespace Larahack\Entities\Stats;

use Sprocketbox\Articulate\Entities\Entity;

/**
 * Class CategoryStats
 *
 * @property-read int                                          $categoryId
 * @property-read \Larahack\Entities\Ideas\Categories\Category $category
 * @property-read int                                          $ideaCount
 * @property-read int                                          $userCount
 * @property-read int                                          $feedbackCount
 * @property-read int                                          $feedbackUserCount
 *
 * @package Larahack\Entities\Stats
 */
class CategoryStats extends Entity
{
}