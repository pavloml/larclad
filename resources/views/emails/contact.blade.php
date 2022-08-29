@component('mail::message')
# New message from the contact form

## Contact email
{{ $formData['email'] }}

## Subject
{{ $formData['subject'] }}

## Message
{{ $formData['message'] }}


@endcomponent
