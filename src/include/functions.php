<?php

declare(strict_types=1);

/**
 * Website: http://sourceforge.net/projects/simplehtmldom/
 * Acknowledge: Jose Solorzano (https://sourceforge.net/projects/php-html/)
 *
 * Licensed under The MIT License
 * See the LICENSE file in the project root for more information.
 *
 * Authors:
 *   S.C. Chen
 *   John Schlick
 *   Rus Carroll
 *   logmanoriginal
 *
 * Contributors:
 *   Yousuke Kumakura
 *   Vadim Voituk
 *   Antcs
 *
 * Version $Rev$
 */

use PHPCore\SimpleHtmlDom\HtmlDocument;
use PHPCore\SimpleHtmlDom\HtmlNode;

if (defined('DEFAULT_TARGET_CHARSET')) {
	define('PHPCore\SimpleHtmlDom\DEFAULT_TARGET_CHARSET', DEFAULT_TARGET_CHARSET);
}

if (defined('DEFAULT_BR_TEXT')) {
	define('PHPCore\SimpleHtmlDom\DEFAULT_BR_TEXT', DEFAULT_BR_TEXT);
}

if (defined('DEFAULT_SPAN_TEXT')) {
	define('PHPCore\SimpleHtmlDom\DEFAULT_SPAN_TEXT', DEFAULT_SPAN_TEXT);
}

if (defined('MAX_FILE_SIZE')) {
	define('PHPCore\SimpleHtmlDom\MAX_FILE_SIZE', MAX_FILE_SIZE);
}

if (!defined('DEFAULT_TARGET_CHARSET')) {
	define('DEFAULT_TARGET_CHARSET', \PHPCore\SimpleHtmlDom\DEFAULT_TARGET_CHARSET);
}

if (!defined('DEFAULT_BR_TEXT')) {
	define('DEFAULT_BR_TEXT', \PHPCore\SimpleHtmlDom\DEFAULT_BR_TEXT);
}

if (!defined('DEFAULT_SPAN_TEXT')) {
	define('DEFAULT_SPAN_TEXT', \PHPCore\SimpleHtmlDom\DEFAULT_SPAN_TEXT);
}

if (!defined('MAX_FILE_SIZE')) {
	define('MAX_FILE_SIZE', \PHPCore\SimpleHtmlDom\MAX_FILE_SIZE);
}

const HDOM_TYPE_ELEMENT = HtmlNode::HDOM_TYPE_ELEMENT;
const HDOM_TYPE_COMMENT = HtmlNode::HDOM_TYPE_COMMENT;
const HDOM_TYPE_TEXT = HtmlNode::HDOM_TYPE_TEXT;
const HDOM_TYPE_ROOT = HtmlNode::HDOM_TYPE_ROOT;
const HDOM_TYPE_UNKNOWN = HtmlNode::HDOM_TYPE_UNKNOWN;
const HDOM_QUOTE_DOUBLE = HtmlNode::HDOM_QUOTE_DOUBLE;
const HDOM_QUOTE_SINGLE = HtmlNode::HDOM_QUOTE_SINGLE;
const HDOM_QUOTE_NO = HtmlNode::HDOM_QUOTE_NO;
const HDOM_INFO_BEGIN = HtmlNode::HDOM_INFO_BEGIN;
const HDOM_INFO_END = HtmlNode::HDOM_INFO_END;
const HDOM_INFO_QUOTE = HtmlNode::HDOM_INFO_QUOTE;
const HDOM_INFO_SPACE = HtmlNode::HDOM_INFO_SPACE;
const HDOM_INFO_TEXT = HtmlNode::HDOM_INFO_TEXT;
const HDOM_INFO_INNER = HtmlNode::HDOM_INFO_INNER;
const HDOM_INFO_OUTER = HtmlNode::HDOM_INFO_OUTER;
const HDOM_INFO_ENDSPACE = HtmlNode::HDOM_INFO_ENDSPACE;

const HDOM_SMARTY_AS_TEXT = \PHPCore\SimpleHtmlDom\HDOM_SMARTY_AS_TEXT;

function fileGetHtmlDom(
	$url,
	$use_include_path = false,
	$context = null,
	$offset = 0,
	$maxLen = -1,
	$lowercase = true,
	$forceTagsClosed = true,
	$target_charset = DEFAULT_TARGET_CHARSET,
	$stripRN = true,
	$defaultBRText = DEFAULT_BR_TEXT,
	$defaultSpanText = DEFAULT_SPAN_TEXT
): bool|HtmlDocument
{
	if($maxLen <= 0) { $maxLen = MAX_FILE_SIZE; }

	$dom = new HtmlDocument(
		null,
		$lowercase,
		$forceTagsClosed,
		$target_charset,
		$stripRN,
		$defaultBRText,
		$defaultSpanText
	);

	$contents = file_get_contents(
		$url,
		$use_include_path,
		$context,
		$offset,
		$maxLen + 1 // Load extra byte for limit check
	);

	if (empty($contents) || strlen($contents) > $maxLen) {
		$dom->clear();
		return false;
	}

	return $dom->load($contents, $lowercase, $stripRN);
}

function strGetHtmlDom(
	$str,
	$lowercase = true,
	$forceTagsClosed = true,
	$target_charset = DEFAULT_TARGET_CHARSET,
	$stripRN = true,
	$defaultBRText = DEFAULT_BR_TEXT,
	$defaultSpanText = DEFAULT_SPAN_TEXT
): bool|HtmlDocument
{
	$dom = new HtmlDocument(
		null,
		$lowercase,
		$forceTagsClosed,
		$target_charset,
		$stripRN,
		$defaultBRText,
		$defaultSpanText
	);

	if (empty($str) || strlen($str) > MAX_FILE_SIZE) {
		$dom->clear();
		return false;
	}

	return $dom->load($str, $lowercase, $stripRN);
}

/** @codeCoverageIgnore */
function dumpHtmlDomTree($node, $show_attr = true, $deep = 0): void
{
	$node->dump($node);
}
