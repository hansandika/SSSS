<?php

namespace App\Inspections;

use App\Models\User as ModelsUser;
use Carbon\Carbon;
use Exception;

class CommentsPostedVeryOften
{
  /**
   * Detect spam
   *
   * @param string $body
   * @throws \Exception
   */
  public function detect($body)
  {
    $user = ModelsUser::find(auth()->id());

    $latestComment = $user->latestComment;

    if ($latestComment) {
      $data = $this->prepareCommonData($latestComment);

      if (!$user->canUserPostComment($data)) {
        throw new Exception("You can post only once in " . config('global.USER_COMMENT_DELAY')  . " seconds.");
      }
    }
  }

  /**
   * Prepare common data
   *
   * @param Collection $latestComment
   * @return array
   */
  public function prepareCommonData($latestComment)
  {
    return [
      'latestCommentCreated' => new Carbon($latestComment->created_at),
      'userCommentFrequency' => config('app.spam_detection.user_can_comment_once_in'),
    ];
  }
}
