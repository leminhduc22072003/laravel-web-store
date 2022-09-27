<?php

namespace App\Jobs;

use App\Models\MailTemplate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Engines\PhpEngine;

class SendMail extends Job
{
    var $templateID;
    var $headData;
    var $contentData;
    var $subjectData;
    var $lang;

    /**
     * Send email using background process
     * @param $templateID int : Hardcode ID from database
     * @param $headData array : Header email data
     * @param $subjectData array : The params pass to the subject of the template
     * @param $contentData array : The params pass to the content of the template
     * @return void
     */
    public function __construct($templateID,$headData,$contentData=[])
    {
        /* Example of data
        $templateID = 1; // The template id from database
        $headData =
        [
            'to'=>'member@gmail.com',
        ];

        $contentData =
        [
            'name' => 'Member',
            'email'=> 'member@gmail.com',
            'age'=> 30
        ]; */

        $this->templateID = $templateID;
        $this->headData = $headData;
        $this->contentData = $contentData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $phpEngine = new PhpEngine();

        $mailTemplate = MailTemplate::find($this->templateID);
        if($mailTemplate)
        {
            // Get mail content
            $jsonContent = json_decode($mailTemplate->content,true);
            $bladeTemplate = $mailTemplate->content;

            $phpTemplate = Blade::compileString($bladeTemplate);
            Storage::disk('local')->put('/email/'.$this->templateID.'.php', $phpTemplate);
            $content = $phpEngine->get(storage_path().'/app/email/'.$this->templateID.'.php',$this->contentData);

            // Get mail subject
            $jsonSubject = json_decode($mailTemplate->subject,true);
            $this->subject = $jsonSubject;

            $phpTemplate = Blade::compileString($this->subject);
            Storage::disk('local')->put('/email/'.$this->templateID.'.php', $phpTemplate);
            $subject = $phpEngine->get(storage_path().'/app/email/'.$this->templateID.'.php',$this->contentData);
        }

        if(!empty($content))
        {
            $content = nl2br($content);
            $this->subject = nl2br($subject);
            Mail::send('auth.mail', ['content'=>$content], function ($message)
            {
                $message->to($this->headData['to']);
                $message->subject($this->subject);
            });
        }
    }
}
