<?php
// Uncomment to enable error reporting
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );

# This file was automatically generated by the MediaWiki 1.21.2
# installer. If you make manual changes, please keep track in case you
# need to recreate them later.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# http://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = "Simplicitypvp";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## http://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "/w";
$wgScriptExtension = ".php";

## Following is used for the short urls
$wgArticlePath = "/w/$1";
$wgUsePathInfo = true;

## The protocol and server name to use in fully-qualified URLs
$wgServer = "https://simplicitypvp.net";

## The relative URL path to the skins directory
$wgStylePath = "$wgScriptPath/skins";

## The relative URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo             = "/images/deflowvesper_logo_black_135.png";

## UPO means: this is also a user preference option

$wgEnableEmail = false;
$wgEnableUserEmail = false; # UPO

$wgEmergencyContact = "admin@simplicitypvp.net";
$wgPasswordSender = "admin@simplicitypvp.net";

$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO
$wgEmailAuthentication = false;

## Database settings
$wgDBtype = "mysql";
$wgDBserver = "10.137.0.254";
$wgDBname = "mediawiki";
$wgDBuser = "mediawiki";
$wgDBpassword = file_get_contents("/secrets/wgDBpassword.secret");

# MySQL specific settings
$wgDBprefix = "";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = false;

## Shared memory settings
$wgMainCacheType = CACHE_NONE;
$wgMemCachedServers = array();

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
#$wgUseImageMagick = true;
#$wgImageMagickConvertCommand = "/usr/bin/convert";

$wgFileExtensions = array('png', 'jpg', 'schematic', 'tar', 'gz', 'svg', 'lz');

$wgStrictFileExtensions = true;

# InstantCommons allows wiki to use images from http://commons.wikimedia.org
$wgUseInstantCommons = false;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "en_US.utf8";

## If you want to use image uploads under safe mode,
## create the directories images/archive, images/thumb and
## images/temp, and make them all writable. Then uncomment
## this, if it's not already uncommented:
#$wgHashedUploadDirectory = false;

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/Names.php
$wgLanguageCode = "en";

$wgSecretKey = file_get_contents("/secrets/wgSecretKey.secret");

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
#$wgUpgradeKey = "d765dec10323acdb";

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'standard', 'nostalgia', 'cologneblue', 'monobook', 'vector':
$wgDefaultSkin = "vector";

# Enable all skins
wfLoadSkin( 'MonoBook' );
wfLoadSkin( 'Timeless' );
wfLoadSkin( 'Vector' );

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "";
$wgRightsText = "";
$wgRightsIcon = "";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "";

# Query string length limit for ResourceLoader. You should only set this if
# your web server has a query string length limit (then set it to that limit),
# or if you have suhosin.get.max_value_length set in php.ini (then set it to
# that value)
$wgResourceLoaderMaxQueryLength = -1;

# The following permissions were set based on your choice in the installer
$wgGroupPermissions['*']['edit'] = false;
$wgGroupPermissions['user']['createpage'] = true;


# End of automatically generated settings.
# Add more configuration options below.

# Manual configuration of footer
$wgHooks['SkinTemplateOutputPageBeforeExec'][] = 'lfTOSLink';
function lfTOSLink( $sk, &$tpl ) {
	# Empty the current array so the default links don't show
	$tpl->data['footerlinks']['places'] = array();

	# Set the Contact link
	$tpl->set( 'contact', $sk->footerLink( 'contacttext', 'contactlink' ) );
	$tpl->data['footerlinks']['places'][] = 'contact';

	# Set the Frequently Asked Questions link
	$tpl->set( 'frequentlyaskedquestions', $sk->footerLink( 'faqtext', 'faqlink' ) );
	$tpl->data['footerlinks']['places'][] = 'frequentlyaskedquestions';

	# Add the policies and guidelines
	$tpl->set( 'policiesandguidelines', $sk->footerLink( 'pagtext', 'paglink' ) );
	$tpl->data['footerlinks']['places'][] = 'policiesandguidelines';

	return true;
}

# Miscelleanous settings
wfLoadExtension( 'ParserFunctions' );
wfLoadExtension( 'CheckUser' );

# Signup captcha
wfLoadExtensions([ 'ConfirmEdit', 'ConfirmEdit/QuestyCaptcha' ]);
$wgCaptchaTriggers['edit']          = false;
$wgCaptchaTriggers['create']        = false;
$wgCaptchaTriggers['createtalk']    = false;
$wgCaptchaTriggers['addurl']        = false;
$wgCaptchaTriggers['createaccount'] = true;
$wgCaptchaTriggers['badlogin']      = true;
# This is fine. It's not like bots are gonna be able to read this git repo
# anyway to get the answer.
$wgCaptchaQuestions = [
    "Login to the Minecraft server and type /captcha. Enter the secret word in the form:" => [ 'cactus' ],
];

# Disable the prompt for 'real name' on user signup
$wgHiddenPrefs[] = 'realname';

# Allow sysops to edit Special:Interwiki
wfLoadExtension( 'Interwiki' );
$wgGroupPermissions['sysop']['interwiki'] = true;

# Trust reverse proxy X-Forwarded-For header
$wgUsePrivateIPs = true;
$wgSquidServersNoPurge = array( '10.137.0.0/16' );

# Enable server side image resizing
#$wgUseImageMagick = true;
$wgUseImageResize = true;

# Needed for svg rendering
$wgMaxShellMemory = 2024000;

# Max file size = 100 MB (= default)
#$wgMaxUploadSize = 1024 * 1024 * 150;

# If getting svg errors, besure to install librsvg

# Needed for thumbnail generation. When reinstalling make sure directory exists and is owned by http
#$wgTmpDirectory = "/home/web/SIMPVP_MEDIAWIKI_TMPDIR";

# Enable debug
#$wgShowExceptionDetails = true;
#$wgShowDBErrorBacktrace = true;
#$wgShowSQLErrors = true;
#error_reporting( -1 );
#ini_set( 'display_errors', 1 );