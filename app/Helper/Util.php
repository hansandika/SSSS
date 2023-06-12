<?php

namespace App\Helper;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Util
{
  public static function getCategoryByPostContent(string $text): string
  {
    try {
      $categories = Category::orderBy('created_at', 'desc')->select('name')->get();
      $listCategoryNames = [];
      foreach ($categories as $category) {
        $listCategoryNames[] = $category->name;
      }
      $stringAllCategories = implode(", ", $listCategoryNames);

      $constraint = "We have a list of categories for forum: " . $stringAllCategories;

      $prompt = "This is a forum classification task. Forum posts could fall into categories like $stringAllCategories. Please analyze the following forum post and assign it to one of the known forum categories. If you can't find a fitting category, assign it as 'other'. The category name should be one of the known forum categories or 'other'. Here is the post content: '$text'. For the response, please return one word JSON object only with the following format: {\"category\": \"category_name\"}.";

      $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . config('global.OPENAI_API_KEY'),
        'Content-Type' => 'application/json',
      ])->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
          [
            'role' => 'system',
            'content' => $constraint,
          ],
          [
            'role' => 'user',
            'content' => $text
          ],
          [
            'role' => 'assistant',
            'content' => $prompt
          ]
        ],
        'temperature' => 0.4,
        'max_tokens' => 60,
      ]);

      $responseContent = $response->json()['choices'][0]['message']['content'];
      if (!Str::contains($responseContent, $listCategoryNames)) {
        return 'other';
      }

      $category = json_decode($responseContent)->category;
      if (!$category) {
        return 'other';
      }

      return $category;
    } catch (Exception $e) {
      return 'other';
    }
  }

  public static function validateSafeContent(string $content)
  {
    $response = Http::withHeaders([
      'Authorization' => 'Bearer ' . config('global.OPENAI_API_KEY'),
      'Content-Type' => 'application/json',
    ])->post('https://api.openai.com/v1/moderations', [
      'input' => $content,
    ]);
    return !$response->json()['results'][0]['flagged'];
  }
}
