<?php

namespace App\Helpers;
use Jfcherng\Diff\DiffHelper;
use Jfcherng\Diff\Factory\RendererFactory;
use Jfcherng\Diff\Renderer\Html\Inline;

class Diff {
    public static function getDiffToJson(string $old, string $new) : string
    {
        return DiffHelper::calculate(
            old: $old,
            new: $new,
            renderer: 'Json',
            differOptions: config('diff.differOptions'),
            rendererOptions: config('diff.rendererOptions')
        );
    }

    /**
     * renderers:
     * for simple text based: (Context, JsonText, Unified)
     * for html based: (Combined, Inline, JsonHtml, SideBySide)
     */
    public static function getRenderer($renderer = 'Combined')
    {
        return RendererFactory::make($renderer, config('diff.rendererOptions'));
    }
}
