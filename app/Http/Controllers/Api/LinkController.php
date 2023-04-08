<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\DB;
use Validator;
use Hashids\Hashids;
class LinkController extends Controller
{
  public function store(Request $request)
  {
    $tableLinks = DB::table('links');
    $hash = '';

    $validator = Validator::make(
      $request->all(),
      [
        'link' => ['required'],
      ]
    );

    if ($validator->fails()) {
      return [
        'status' => 'error',
        'errors' => $validator->messages(),
        'data' => $request,
      ];
    }

    $searchLink = $tableLinks->where('link', $request->input('link'))->first();

    if (!$searchLink) {
      $hash = $this->checkUniqueHash($request->input('link'), $tableLinks);

      if ($hash) {
        $tableLinks->insert([
          'link' => $request->input('link'),
          'hash' => $hash,
        ]);
      }
    } else {
      $hash = $searchLink->hash;
    }

    return [
      'status' => 'success',
      'hash' => $hash,
    ];
  }

  private function generateHash(string $text): string
  {
    $hashids = new Hashids($text);

    return $hashids->encode(1, 2, 3);
  }

  private function checkUniqueHash(string $text, $table) {
    $hash = $this->generateHash($text);
    $hashExist = $table->where('hash', $hash)->first();

    return $hashExist ? $this->checkUniqueHash($text, $table) : $hash;
  }
}
