<?php

namespace App\Traits;

trait JsonResponse {

     public function responseRetrievedList($result)
     {
          return [
               'success' => 1,
               'code' => 200,
               'meta' => [
                    'method' => request()->server('REQUEST_METHOD'),
                    'endpoint' => request()->server('PATH_INFO'),
                    'limit' => 30,
                    'offset' => 0,
                    'total' => $result->total(),
               ],
               'data' => $result->items(),
               'errors' => [],
               'duration' => [],
          ];
     }

     public function responseRetrieved($coupon)
     {
          return [
               'success' => 1,
               'code' => 201,
               'meta' => [
                    'method' => request()->server('REQUEST_METHOD'),
                    'endpoint' => request()->server('PATH_INFO')
               ],
               'data' => $coupon,
               'errors' => [],
               'duration' => []
          ];
     }

     public function responseCreated($result)
     {
          return [
               'success' => 1,
               'code' => 201,
               'meta' => [
                    'method' => request()->server('REQUEST_METHOD'),
                    'endpoint' => request()->server('PATH_INFO')
               ],
               'data' => [
                    'id' => $result->id
               ],
               'errors' => [],
               'duration' => []
          ];
     }

     public function responseUpdated($result)
     {
          return [
               'success' => 1,
               'code' => 201,
               'meta' => [
                    'method' => request()->server('REQUEST_METHOD'),
                    'endpoint' => request()->server('PATH_INFO')
               ],
               'data' => [
                    'updated' => $result->id
               ],
               'errors' => [],
               'duration' => []
          ];
     }

     public function responseDeleted($coupon)
     {
          return [
               'success' => 1,
               'code' => 200,
               'meta' => [
                    'method' => request()->server('REQUEST_METHOD'),
                    'endpoint' => request()->server('PATH_INFO')
               ],
               'data' => [
                    'deleted' => $coupon
               ],
               'errors' => [],
               'duration' => []
          ];
     }

     public function responseNotFound()
     {
          return [
               "success" => 1,
               "code" => 404,
               "meta" => [
                    'method' => request()->server('REQUEST_METHOD'),
                    'endpoint' => request()->server('PATH_INFO')
               ],
               "data" => [],
               "errors" => [
                    "message" => "The resource that matches the request ID does not found.",
                    "code" => 404
               ],
               "duration" => []
          ];
     }

     public function responseNotFoundForUpdate()
     {
          return [
               "success" => 1,
               "code" => 404,
               "meta" => [
                    'method' => request()->server('REQUEST_METHOD'),
                    'endpoint' => request()->server('PATH_INFO')
               ],
               "data" => [],
               "errors" => [
                    "message" => "The updating resource that corresponds to the ID wasn't found.",
                    "code" => 404
               ],
               "duration" => []
          ];
     }

     public function responseNotFoundForDelete()
     {
          return [
               "success" => 1,
               "code" => 404,
               "meta" => [
                    'method' => request()->server('REQUEST_METHOD'),
                    'endpoint' => request()->server('PATH_INFO')
               ],
               "data" => [],
               "errors" => [
                    "message" => "The deleting resource that corresponds to the ID wasn't found.",
                    "code" => 404
               ],
               "duration" => []
          ];
     }

     public function responseIncorrectParams($errors)
     {
          $validationErrors = [];

          foreach ($errors as $key => $value) {
                    $validationErrors[] = [
                    'attributes' => $key,
                    'errors' => [
                         'key' => $key,
                         'message' => $value
                    ]
               ];
          }

          return [
               "success" => 1,
               "code" => 400,
               "meta" => [
                    'method' => request()->server('REQUEST_METHOD'),
                    'endpoint' => request()->server('PATH_INFO')
               ],
               "data" => [],
               "errors" => [
                    "message" => "The request parameters are incorrect, please make sure to follow the documentation about request parameters of the resource.",
                    "code" => 400
               ],
               "validation" => $validationErrors,
               "duration" => []
          ];
     }
}