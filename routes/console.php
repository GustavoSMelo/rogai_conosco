<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Mailtrap\Helper\ResponseHelper;
use Mailtrap\MailtrapClient;
use Mailtrap\Mime\MailtrapEmail;
use Symfony\Component\Mime\Address;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('send-mail', function () {
    $email = (new MailtrapEmail())
        ->from(new Address(config('mail.from.address', 'hello@demomailtrap.co'), config('mail.from.name', 'Rogai Conosco')))
        ->to(new Address('gsantos15569.dev@gmail.com'))
        ->subject('Rogai Conosco — Teste de Email')
        ->category('Integration Test')
        ->text('Congrats for sending test email with Mailtrap!');

    $response = MailtrapClient::initSendingEmails(
        apiKey: config('services.mailtrap-sdk.api_key'),
    )->send($email);

    $this->info('Email sent successfully');
    var_dump(ResponseHelper::toArray($response));
})->purpose('Send a test email via Mailtrap');
