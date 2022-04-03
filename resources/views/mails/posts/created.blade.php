@component('mail::message')

# Post created by {{ $post->user->name }}

## Title: {{ $post->title }}

<p><strong>Content:</strong> {{ $post->content }} </p>

### Category: {{ $post->category->name }}

@if (count($post->tags))
### Tags:
<ul>
@foreach ($post->tags as $tag)
<li>{{ $tag->name }}</li>
@endforeach
</ul>
@endif

@component('mail::button', ['url' => '#'])
Check the post
@endcomponent

Thanks,<br>
{{ config('app.name') }}

@endcomponent
