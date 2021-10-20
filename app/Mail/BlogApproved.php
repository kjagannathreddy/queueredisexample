<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Blog;

class BlogApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $blog;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.blogs.approved');
    }
}
