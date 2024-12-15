<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    // Untuk Response Api
    protected function serverErrorResponse($message, $data = [])
    {
        $response = [
            'status' => 'server_error',
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, 500);
    }

    protected function notFoundResponse($message, $data = [])
    {
        $response = [
            'status' => 'not_found',
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, 404);
    }

    protected function unAuthorizationResponse($message, $data = [])
    {
        $response = [
            'status' => 'unauthorized',
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, 401);
    }

    protected function badRequestResponse($message, $data = [])
    {
        $response = [
            'status' => 'bad_request',
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, 400);
    }

    protected function successResponse($message, $data = [])
    {
        $response = [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, 200);
    }

    protected function upload_image($request, $path)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $file_name = str_replace(' ', '-', $request->name . '_' . time() . '.' . $file->getClientOriginalExtension());

            $destination = 'storage/' . $path;
            $file->move($destination, $file_name);
            $file = $destination . '/' . $file_name;
        } else {
            $file = '';
        }

        return $file;
    }

    protected function upload_image_base_64($request, $path)
    {
        if ($request->file) {
            $file = $request->file;

            preg_match('/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).*,/', $file, $matches);
            $mime = $matches[1];

            $file = preg_replace('/data:[a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+;base64,/', '', $file);
            $file_name = str_replace(' ', '-', $request->name . '_' . time() . '.' . explode('/', $mime)[1]);

            $destination = 'storage/' . $path;
            $fileBinaryData = base64_decode($file);
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $save_data = file_put_contents($destination . '/' . $file_name, $fileBinaryData);
            if ($save_data === false) {
                // Handle error if file_put_contents fails
                $file = '';
            } else {
                // File successfully saved
                $file = $destination . '/' . $file_name;
            }
        } else {
            $file = '';
        }

        return $file;
    }
}
