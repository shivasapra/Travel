<?php

namespace App\Mail;

use App\Browser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Sujip\Ipstack\Ipstack;

class AuthorizeDevice extends Mailable
{
    use Queueable, SerializesModels;
    protected $authorize;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($authorize)
    {
        $this->authorize = $authorize;
        $this->browser = new Browser;
    }
    public function setBrowser()
    {
        $this->authorize->browser = $this->browser->getBrowser();

        return $this;
    }
    public function setToken()
    {
        $this->authorize->token = guid();

        return $this;
    }
    public function setLocation()
    {
        $location = with(new Ipstack(
            $this->authorize->ip_address
        ))->formatted();

        $this->authorize->location = $location;

        return $this;
    }
    public function setPlatform()
    {
        $this->authorize->os = $this->browser->getPlatform();

        return $this;
    }
    public function saveAuthorize()
    {
        $this->authorize->save();
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this
            ->setBrowser()
            ->setToken()
            ->setLocation()
            ->setPlatform()
            ->saveAuthorize();

        return $this
            ->view('emails.auth.authorize')
            ->with(['authorize' => $this->authorize]);
    }
}
