<?php

namespace App\Inspections;

use Exception;

class InvalidKeywords
{
  /**
   * All spam keywords
   *
   * @var array
   */
  protected $keywords = [
    'Free',
    'Discount',
    'Limited time offer',
    'Exclusive deal',
    'Click here',
    'Buy now',
    'Make money fast',
    'Earn money online',
    'Guaranteed',
    'Instant results',
    'Multi-level marketing',
    'MLM',
    'Viagra',
    'Pharmacy',
    'Luxury',
    'Rolex',
    'Work from home',
    'Weight loss',
    'Diet pill',
    'Charity',
    'Donate',
    'Cryptocurrency investment',
    'Forex trading',
    'Casino',
    'Online gambling',
    'Adult content',
    'loreum ipsum',
    'lorem ipsum',
    'asd',
    'Congratulations',
    'Urgent',
    'Income'
  ];

  /**
   * Detect spam
   *
   * @param  string $body
   * @throws \Exception
   */
  public function detect($body)
  {
    foreach ($this->keywords as $keyword) {
      if (stripos($body, $keyword) !== false) {
        throw new Exception("Your comment contains spam.");
      }
    }
  }
}
