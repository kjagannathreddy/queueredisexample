<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;
use App\Mail\BlogApproved;
use App\Models\Blog;
use App\Models\User;
use Log;

class SendBlogNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $blog;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = Redis::get('users');
        $users = json_decode($users, FALSE);
        if(!isset($users) || empty($users)){
            $users = User::where('is_subscribed', 1)->get();
        }
        Redis::throttle('any_key')->allow(1)->every(1)->then(function () {

            if(!empty($users)){
                foreach($users as $user){
                    $recipient = $user->email;
                    Mail::to($recipient)->send(new BlogApproved($this->blog));
                }
            }

        }, function () {
            return $this->release(2);
        });
    }
}
