<?php
use App\Helpers\Diff;
use Illuminate\Support\HtmlString;

if ($getState()) {
    $renderer = Diff::getRenderer();
    $result = $renderer->renderArray(json_decode($getState(), true));
    $result = str_replace('&gt;', '>', $result);
    $result = str_replace('&lt;', '<', $result);
} else {
    $result = $getState();
}
?>

<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div x-data="{
            init() {
                const insTags = $el.querySelectorAll('ins');

                insTags.forEach((tag) => {
                    tag.style.textDecoration = 'none';
                    tag.style.backgroundColor = 'rgba(159, 252, 122, 0.48)';
                })
            }
        }">
        {!! $result !!}
    </div>
</x-dynamic-component>
