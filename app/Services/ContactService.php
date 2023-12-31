<?php

namespace App\Services;

use App\Notifications\FormSubmissionNotification;
use Illuminate\Support\Facades\Notification;
use Statamic\Facades\Form;

class ContactService
{
    public function createSubmission(string $handle, array $data): bool
    {
        $form = Form::find($handle);

        if (! $form) {
            return false;
        }

        if (isset($data['vehicle'])) {
            $data = array_merge($data, [
                'vehicle' => $data['vehicle']['title'].' ('.$data['vehicle']['permalink'].')',
            ]);
        }

        $submission = $form->makeSubmission();
        $submission->data($data);
        $submission->save();

        $submissionId = $submission->id();

        $notification = Notification::route('mail', env('APP_EMAIL', 'henrikH2004@hotmail.com'))
            ->notify(new FormSubmissionNotification($data, $submissionId));

        return true;
    }
}
