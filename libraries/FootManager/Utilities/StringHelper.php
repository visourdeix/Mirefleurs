<?php
/**
 * @package      FootManager
 * @subpackage   Utilities
 * @author       St�phane ANDRE
 * @copyright    Copyright (C) 2015 St�phane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Utilities;

defined('JPATH_PLATFORM') or die;

/**
 * This is a class that provides functionality for managing strings.
 *
 * @package      FootManager\Utilities
 * @subpackage   Strings
 */
abstract class StringHelper
{
    /**
     * Rules for pluralizing and singularizing of nouns.
     *
     * @var array
     */
	protected static $_rules = array
	(
		'pluralization'   => array(
			'/move$/i'                      => 'moves',
			'/sex$/i'                       => 'sexes',
			'/child$/i'                     => 'children',
			'/children$/i'                  => 'children',
			'/man$/i'                       => 'men',
			'/men$/i'                       => 'men',
			'/foot$/i'                      => 'feet',
			'/feet$/i'                      => 'feet',
			'/person$/i'                    => 'people',
			'/people$/i'                    => 'people',
			'/taxon$/i'                     => 'taxa',
			'/taxa$/i'                      => 'taxa',
			'/(quiz)$/i'                    => '$1zes',
			'/^(ox)$/i'                     => '$1en',
			'/oxen$/i'                      => 'oxen',
			'/(m|l)ouse$/i'                 => '$1ice',
			'/(m|l)ice$/i'                  => '$1ice',
			'/(matr|vert|ind|suff)ix|ex$/i' => '$1ices',
			'/(x|ch|ss|sh)$/i'              => '$1es',
			'/([^aeiouy]|qu)y$/i'           => '$1ies',
			'/(?:([^f])fe|([lr])f)$/i'      => '$1$2ves',
			'/sis$/i'                       => 'ses',
			'/([ti]|addend)um$/i'           => '$1a',
			'/([ti]|addend)a$/i'            => '$1a',
			'/(alumn|formul)a$/i'           => '$1ae',
			'/(alumn|formul)ae$/i'          => '$1ae',
			'/(buffal|tomat|her)o$/i'       => '$1oes',
			'/(bu)s$/i'                     => '$1ses',
			'/(alias|status)$/i'            => '$1es',
			'/(octop|vir)us$/i'             => '$1i',
			'/(octop|vir)i$/i'              => '$1i',
			'/(gen)us$/i'                   => '$1era',
			'/(gen)era$/i'                  => '$1era',
			'/(ax|test)is$/i'               => '$1es',
			'/s$/i'                         => 's',
			'/$/'                           => 's',
		),
		'singularization' => array(
			'/cookies$/i'                                                      => 'cookie',
			'/moves$/i'                                                        => 'move',
			'/sexes$/i'                                                        => 'sex',
			'/children$/i'                                                     => 'child',
			'/men$/i'                                                          => 'man',
			'/feet$/i'                                                         => 'foot',
			'/people$/i'                                                       => 'person',
			'/taxa$/i'                                                         => 'taxon',
			'/databases$/i'                                                    => 'database',
      '/menus$/i'                                                        => 'menu',
			'/(quiz)zes$/i'                                                    => '\1',
			'/(matr|suff)ices$/i'                                              => '\1ix',
			'/(vert|ind|cod)ices$/i'                                           => '\1ex',
			'/^(ox)en/i'                                                       => '\1',
			'/(alias|status)es$/i'                                             => '\1',
			'/(tomato|hero|buffalo)es$/i'                                      => '\1',
			'/([octop|vir])i$/i'                                               => '\1us',
			'/(gen)era$/i'                                                     => '\1us',
			'/(cris|^ax|test)es$/i'                                            => '\1is',
			'/is$/i'                                                           => 'is',
			'/us$/i'                                                           => 'us',
			'/ias$/i'                                                          => 'ias',
			'/(shoe)s$/i'                                                      => '\1',
			'/(o)es$/i'                                                        => '\1e',
			'/(bus)es$/i'                                                      => '\1',
			'/([m|l])ice$/i'                                                   => '\1ouse',
			'/(x|ch|ss|sh)es$/i'                                               => '\1',
			'/(m)ovies$/i'                                                     => '\1ovie',
			'/(s)eries$/i'                                                     => '\1eries',
			'/(v)ies$/i'                                                       => '\1ie',
			'/([^aeiouy]|qu)ies$/i'                                            => '\1y',
			'/([lr])ves$/i'                                                    => '\1f',
			'/(tive)s$/i'                                                      => '\1',
			'/(hive)s$/i'                                                      => '\1',
			'/([^f])ves$/i'                                                    => '\1fe',
			'/(^analy)ses$/i'                                                  => '\1sis',
			'/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\1\2sis',
			'/([ti]|addend)a$/i'                                               => '\1um',
			'/(alumn|formul)ae$/i'                                             => '$1a',
			'/(n)ews$/i'                                                       => '\1ews',
			'/(.*)ss$/i'                                                       => '\1ss',
			'/(.*)s$/i'                                                        => '\1',
		),
		'countable'       => array(
			'aircraft',
			'cannon',
			'deer',
			'equipment',
			'fish',
			'information',
			'money',
			'moose',
			'rice',
			'series',
			'sheep',
			'species',
			'swine',
		)
	);

	/**
     * Cache of pluralized and singularized nouns.
     *
     * @var array
     */
	protected static $_cache = array(
		'singularized' => array(),
		'pluralized'   => array()
	);

	/**
     * Constructor
     *
     * Prevent creating instances of this class by making the constructor private
     */
	private function __construct()
	{
	}

	public static function deleteCache()
	{
		static::$_cache['pluralized'] = array();
		static::$_cache['singularized'] = array();
	}

	/**
     * Add a word to the cache, useful to make exceptions or to add words in other languages.
     *
     * @param   string  $singular  word.
     * @param   string  $plural    word.
     *
     * @return  void
     */
	public static function addWord($singular, $plural)
	{
		static::$_cache['pluralized'][$singular] = $plural;
		static::$_cache['singularized'][$plural] = $singular;
	}

	/**
     * Singular English word to plural.
     *
     * @param   string  $word  word to pluralize.
     *
     * @return  string Plural noun.
     */
	public static function pluralize($word)
	{
		// Get the cached noun of it exists
		if (isset(static::$_cache['pluralized'][$word]))
		{
			return static::$_cache['pluralized'][$word];
		}

		// Create the plural noun
		if (in_array($word, self::$_rules['countable']))
		{
			static::$_cache['pluralized'][$word] = $word;

			return $word;
		}

		foreach (self::$_rules['pluralization'] as $regexp => $replacement)
		{
			$matches = 0;
			$plural  = preg_replace($regexp, $replacement, $word, -1, $matches);

			if ($matches > 0)
			{
				static::$_cache['pluralized'][$word] = $plural;

				return $plural;
			}
		}

		static::$_cache['pluralized'][$word] = $word;

		return static::$_cache['pluralized'][$word];
	}

	/**
     * Plural English word to singular.
     *
     * @param   string  $word  Word to singularize.
     *
     * @return  string Singular noun.
     */
	public static function singularize($word)
	{
		// Get the cached noun of it exists
		if (isset(static::$_cache['singularized'][$word]))
		{
			return static::$_cache['singularized'][$word];
		}

		// Create the singular noun
		if (in_array($word, self::$_rules['countable']))
		{
			static::$_cache['singularized'][$word] = $word;

			return $word;
		}

		foreach (self::$_rules['singularization'] as $regexp => $replacement)
		{
			$matches  = 0;
			$singular = preg_replace($regexp, $replacement, $word, -1, $matches);

			if ($matches > 0)
			{
				static::$_cache['singularized'][$word] = $singular;

				return $singular;
			}
		}

		static::$_cache['singularized'][$word] = $word;

		return static::$_cache['singularized'][$word];
	}

	/**
     * Returns given word as CamelCased.
     *
     * Converts a word like "foo_bar" or "foo bar" to "FooBar". It
     * will remove non alphanumeric characters from the word, so
     * "who's online" will be converted to "WhoSOnline"
     *
     * @param   string  $word  Word to convert to camel case.
     *
     * @return  string  UpperCamelCasedWord
     */
	public static function camelize($word)
	{
		$word = preg_replace('/[^a-zA-Z0-9\s]/', ' ', $word);
		$word = str_replace(' ', '', ucwords(strtolower(str_replace('_', ' ', $word))));

		return $word;
	}

	/**
     * Converts a word "into_it_s_underscored_version"
     *
     * Convert any "CamelCased" or "ordinary Word" into an "underscored_word".
     *
     * @param   string  $word  Word to underscore
     *
     * @return string Underscored word
     */
	public static function underscore($word)
	{
		$word = preg_replace('/(\s)+/', '_', $word);
		$word = strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $word));

		return $word;
	}

	/**
     * Check to see if an English word is singular
     *
     * @param   string  $string  The word to check
     *
     * @return boolean
     */
	public static function isSingular($string)
	{
		// Check cache assuming the string is plural.
		$singular = isset(static::$_cache['singularized'][$string]) ? static::$_cache['singularized'][$string] : null;
		$plural   = $singular && isset(static::$_cache['pluralized'][$singular]) ? static::$_cache['pluralized'][$singular] : null;

		if ($singular && $plural)
		{
			return $plural != $string;
		}

		// If string is not in the cache, try to pluralize and singularize it.
		return self::singularize(self::pluralize($string)) == $string;
	}

	/**
     * Check to see if an Enlish word is plural.
     *
     * @param   string  $string  String to be checked.
     *
     * @return boolean
     */
	public static function isPlural($string)
	{
		// Check cache assuming the string is singular.
		$plural   = isset(static::$_cache['pluralized'][$string]) ? static::$_cache['pluralized'][$string] : null;
		$singular = $plural && isset(static::$_cache['singularized'][$plural]) ? static::$_cache['singularized'][$plural] : null;

		if ($plural && $singular)
		{
			return $singular != $string;
		}

		// If string is not in the cache, try to singularize and pluralize it.
		return self::pluralize(self::singularize($string)) == $string;
	}
}