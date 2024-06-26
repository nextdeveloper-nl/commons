<?php

namespace NextDeveloper\Commons\Helpers;

use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;

/**
 * Class SlugHelper
 *
 * A helper class for generating slugs.
 */

class SlugHelper
{

    /**
     * This function generates a slug from a string.
     * <code>
     *     SlugHelper::generate('My Slug', '\NextDeveloper\Blogs\Database\Models\Posts');
     * </code>
     * @param string $slug The string to generate the slug from.
     * @param string|null $class The class name of the object.
     * @return string The generated slug.
     */
    public static function generate(string $slug, string $class = null): string
    {
        $slug = self::replaceSpecialCharacters($slug);
        $slug = strtolower($slug);
        $slug = preg_replace('/[^a-z0-9]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');

        // If the class is not provided or does not exist, return the slug as is
        if (!$class || !class_exists($class)) {
            return $slug;
        }

        // Ensure that the slug is unique
        $count = $class::withoutGlobalScopes()
            ->where('slug', 'like', $slug . '%')
            ->count();

        if ($count > 0) {
            $slug .= '-' . ($count);
        }

        return $slug;
    }

    /**
     * Replace special characters with their ASCII equivalents.
     * Ensures the iconv extension is enabled and added to composer.json.
     * <code>
     *     "ext-iconv": "*"
     * </code>
     *
     *
     * @param string $text The text to be transformed.
     * @return string The transformed text.
     */
    private static function replaceSpecialCharacters(string $text): string
    {
        $search = ['ä', 'æ', 'ǽ', 'ö', 'œ', 'ü', 'Ä', 'Ü', 'Ö', 'ß', 'ç', 'Ç', 'ğ', 'Ğ', 'ı', 'İ', 'ş', 'Ş', 'ö', 'Ö', 'ü', 'Ü'];
        $replace = ['a', 'ae', 'ae', 'o', 'oe', 'u', 'Ae', 'Ue', 'Oe', 'ss', 'c', 'C', 'g', 'G', 'i', 'I', 's', 'S', 'o', 'O', 'u', 'U'];

        $text = str_replace($search, $replace, $text);
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);

        return $text;
    }
}
