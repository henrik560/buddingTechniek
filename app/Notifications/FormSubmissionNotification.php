<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FormSubmissionNotification extends Notification
{
    use Queueable;

    private $submission;
    private $submissionId;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $submission, string $submissionId)
    {
        $this->submission = $submission;
        $this->submissionId = $submissionId;
    }

    /**
     * Get the notification"s delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ["mail"];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Nieuw bericht op BuddingTechniek.nl")
            ->greeting("Dag!")
            ->line("U heeft een nieuw bericht ontvangen op: Buddingtechniek.nl")
            ->line("Naam: " . $this->submission["name"])
            ->line("E-Mailadres: " . $this->submission["email"])
            ->line("Telefoonnummer: " . $this->submission["phonenumber"])
            ->line("Bericht: " . $this->submission["message"])
            ->action("Bekijk bericht online", url("/cp/forms/contact_us/submissions/" . $this->submissionId))
            ->salutation("Met vriendelijke groet, \n\n Team BuddingTechniek");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
