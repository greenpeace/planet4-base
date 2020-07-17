<?php

declare(strict_types=1);

namespace Selector\Admin\GutenbergEditor;

use MyCLabs\Enum\Enum;

/**
 * Blocks available in the block selector
 * 
 * @method static BlockName BUTTONS()
 * @method static BlockName COUNTER()
 * @method static BlockName CUSTOM_HTML()
 * @method static BlockName DAILYMOTION()
 * @method static BlockName EMBED()
 * @method static BlockName FACEBOOK()
 * @method static BlockName FILE()
 * @method static BlockName FLICKR()
 * @method static BlockName GALLERY()
 * @method static BlockName HEADING()
 * @method static BlockName IMAGE()
 * @method static BlockName IMGUR()
 * @method static BlockName INSTAGRAM()
 * @method static BlockName ISSUU()
 * @method static BlockName KICKSTARTER()
 * @method static BlockName LIST()
 * @method static BlockName MEETUP()
 * @method static BlockName MIXCLOUD()
 * @method static BlockName PARAGRAPH()
 * @method static BlockName QUOTE()
 * @method static BlockName REDDIT()
 * @method static BlockName SCRIBD()
 * @method static BlockName SEPARATOR()
 * @method static BlockName SHORTCODE()
 * @method static BlockName SLIDESHARE()
 * @method static BlockName SOUNDCLOUD()
 * @method static BlockName SPACER()
 * @method static BlockName SPOTIFY()
 * @method static BlockName SPREADSHEET()
 * @method static BlockName TABLE()
 * @method static BlockName TAKE_ACTION_BOXOUT()
 * @method static BlockName TED()
 * @method static BlockName TIMELINE()
 * @method static BlockName TWITTER()
 * @method static BlockName VIDEOPRESS()
 * @method static BlockName VIMEO()
 * @method static BlockName WORDPRESS()
 * @method static BlockName YOUTUBE()
 */
class BlockName extends Enum
{
    private const BUTTONS = 'Buttons';
    private const COUNTER = 'Counter';
    private const CUSTOM_HTML = 'Custom HTML';
    private const DAILYMOTION = 'Dailymotion';
    private const EMBED = 'Embed';
    private const FACEBOOK = 'Facebook';
    private const FILE = 'File';
    private const FLICKR = 'Flickr';
    private const GALLERY = 'Gallery';
    private const HEADING = 'Heading';
    private const IMAGE = 'Image';
    private const IMGUR = 'Imgur';
    private const INSTAGRAM = 'Instagram';
    private const ISSUU = 'Issuu';
    private const KICKSTARTER = 'Kickstarter';
    private const LIST = 'List';
    private const MEETUP = 'Meetup.com';
    private const MIXCLOUD = 'Mixcloud';
    private const PARAGRAPH = 'Paragraph';
    private const QUOTE = 'Quote';
    private const REDDIT = 'Reddit';
    private const SCRIBD = 'Scribd';
    private const SEPARATOR = 'Separator';
    private const SHORTCODE = 'Shortcode';
    private const SLIDESHARE = 'Slideshare';
    private const SOUNDCLOUD = 'Soundcloud';
    private const SPACER = 'Spacer';
    private const SPOTIFY = 'Spotify';
    private const SPREADSHEET = 'Spreadsheet';
    private const TABLE = 'Table';
    private const TAKE_ACTION_BOXOUT = 'Take Action Boxout';
    private const TED = 'TED';
    private const TIMELINE = 'Timeline';
    private const TWITTER = 'Twitter';
    private const VIDEOPRESS = 'VideoPress';
    private const VIMEO = 'Vimeo';
    private const WORDPRESS = 'Wordpress';
    private const YOUTUBE = 'YouTube';
}
