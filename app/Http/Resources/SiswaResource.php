<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Override;

class SiswaResource extends JsonResource
{
  public $status;
  public $message;
  #[Override]
  public function __construct($status, $message, $resource)
  {
    parent::__construct($resource);
    $this->status = $status;
    $this->message = $message;
  }
  #[Override]
  public function toArray(Request $request)
  {
    return [
      'succes' => $this->status,
      'message' => $this->message,
      'data' => $this->resource
    ];
  }
}
