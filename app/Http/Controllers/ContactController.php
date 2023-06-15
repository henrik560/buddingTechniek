<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFormRequest;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @return Response
     */
    function index(): Response
    {
        return Inertia::render('ContentPage', [
            'title' => 'Contact'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateFormRequest $request
     * @param  ContactService $contactService
     * @return JsonResponse
     */
    public function store(CreateFormRequest $request, ContactService $contactService): JsonResponse
    {
        $submission = $contactService->createSubmission('contact_us', $request->only('name', 'email', 'phonenumber', 'message'));

        if (!$submission) {
            return response()->json(['message' => __('form.form_submission_error')], 422);
        }

        return response()->json(['message' => __('form.form_submission_success')]);
    }
}
