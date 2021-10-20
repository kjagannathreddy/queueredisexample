@component('mail::message')
We have a new blog, please check

@component('mail::button', ['url' => url("/blogs/{$blog->id}")])
View blog
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
