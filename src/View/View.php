<?php

namespace Acme\View;

class View
{
    public static function make($view)
    {
        $baseContent = self::getBaseContent();

        $viewContent = self::getViewContent($view);

        echo(str_replace('{{content}}', $viewContent, $baseContent));
    }

    protected static function getBaseContent()
    {
        ob_start();
        include base_path() . 'views/layouts/main.php';
        return ob_get_clean();
    }

    protected static function getViewContent($view)
    {
        $path = view_path();

        if (str_contains($view, '.')) {
            $views = explode('.', $view);
            foreach ($views as $view) {
                if (is_dir($path . $view)) {
                    $path = $path . $view . '/';
                }
            }
            $view = $path . end($views) . '.php';
        } else {
            $view = $path . $view . '.php';
        }

        ob_start();
        include $view;
        return ob_get_clean();
    }
}
