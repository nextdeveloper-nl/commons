<?php

namespace NextDeveloper\Commons\Helpers;

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
        $slug = mb_strtolower($slug, 'UTF-8');
        $slug = preg_replace('/[^\p{Arabic}a-z0-9_\s-]/u', '-', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        $slug = trim($slug, '-');

        // If the class is not provided or does not exist, return the slug as is
        if (!$class || !class_exists($class)) {
            return $slug;
        }

        // Ensure that the slug is unique
        $count = $class::withoutGlobalScopes()
            ->where('slug', 'ilike', $slug . '%')
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
        $search = [
            'ä', 'æ', 'ǽ', 'ö', 'œ', 'ü', 'Ä', 'Ü', 'Ö', 'ß', 'ç', 'Ç', 'ğ', 'Ğ',
            'ı', 'İ', 'ş', 'Ş', 'ñ', 'Ñ', 'á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í',
            'Ó', 'Ú', 'â', 'ê', 'î', 'ô', 'û', 'Â', 'Ê', 'Î', 'Ô', 'Û'
        ];

        $replace = [
            'a', 'ae', 'ae', 'o', 'oe', 'u', 'Ae', 'Ue', 'Oe', 'ss', 'c', 'C', 'g',
            'G', 'i', 'I', 's', 'S', 'n', 'N', 'a', 'e', 'i', 'o', 'u', 'A', 'E',
            'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'
        ];

        $text = str_replace($search, $replace, $text);
        return $text;
    }
}
