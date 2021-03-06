<?php
/**
*
* @package phpBB Extension - Digests
* @copyright (c) 2016 Mark D. Hamill (mark@phpbbservices.com)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

global $config;

// Needed for some timezone offset magic
$tz_board = new \DateTimeZone($config['board_timezone']);
$datetime_tz_board = new \DateTime('now', $tz_board);
$timeOffset = $tz_board->getOffset($datetime_tz_board) / 3600;

$server_settings_url = append_sid('index.php?i=acp_board&amp;mode=server');

$lang = array_merge($lang, array(
	'ACP_DIGESTS_NEVER'										=> 'never',
	)
);

$last_run = ($config['phpbbservices_digests_cron_task_last_gc'] == 0) ? $lang['ACP_DIGESTS_NEVER'] : date($config['default_dateformat'], $config['phpbbservices_digests_cron_task_last_gc']) . ' board time';

$lang = array_merge($lang, array(
	'ACP_CAT_DIGESTS'										=> 'Digests',

	'ACP_DIGESTS_SETTINGS'									=> 'Digest settings',
	'ACP_DIGESTS_GENERAL_SETTINGS'							=> 'General settings',
	'ACP_DIGESTS_GENERAL_SETTINGS_EXPLAIN'					=> 'These are the general digests settings. Please note that if timely delivery of digests must be guaranteed then you must <a href="https://wiki.phpbb.com/Modular_cron#Use_system_cron">set up</a> and <a href="'. $server_settings_url . '">enable</a> phpBB&apos;s <strong>system cron</strong> feature. Otherwise the next time there is board traffic, digests for the current and previous hours will be mailed. For more information, see the FAQ for the Digests extension on the forums at phpbb.com.',
	'ACP_DIGESTS_USER_DEFAULT_SETTINGS'						=> 'User default settings',
	'ACP_DIGESTS_USER_DEFAULT_SETTINGS_EXPLAIN'				=> 'This settings allow administrators to set the defaults users see when they subscribe to a digest.',
	'ACP_DIGESTS_EDIT_SUBSCRIBERS'							=> 'Edit subscribers',
	'ACP_DIGESTS_EDIT_SUBSCRIBERS_EXPLAIN'					=> 'This page allows you to see who is or is not receiving digests. You can selectively add digest subscriptions, selectively unsubscribe members, and edit all digest details of individual subscribers. By marking rows with the checkbox in the first column, you can subscribe these members with defaults or unsubscribe them. Do this by selecting the appropriate controls near the bottom of the page then pressing Submit. Also note you can use these controls to sort and filter the list in conjunction with the Refresh button.',
	'ACP_DIGESTS_BALANCE_LOAD'								=> 'Balance load',
	'ACP_DIGESTS_BALANCE_LOAD_EXPLAIN'						=> 'If too many digests going out at certain hours are causing performance issues, this will rebalance digest subscriptions so that roughly the same number of digests are sent for each hour. The table below shows the current number of digest subscribers for each hour, with the hour based on the digest hour set in Digest general settings. This function updates digest send hours minimally. Changes occur only on those hours where the number of subscribers exceeds the average load, and only for subscribers that exceed the hourly average for that hour. <em>Caution</em>: subscribers may be upset that their subscription times were changed.',
	'ACP_DIGESTS_MASS_SUBSCRIBE_UNSUBSCRIBE'				=> 'Mass subscribe/unsubscribe',
	'ACP_DIGESTS_MASS_SUBSCRIBE_UNSUBSCRIBE_EXPLAIN'		=> 'This feature allows administrators to conveniently subscribe or unsubscribe all members of your forum at once. Digest default settings are used to subscribe members. If a member already has a digest subscription, a mass subscription will retain their digest settings. You cannot specify the forums that will be subscribed. Users will be subscribed to all forums to which they have read access. <strong>Caution</strong>: subscribers may be upset if they are subscribed or unsubscribed without their permission.',
	'ACP_DIGESTS_RESET_CRON_RUN_TIME'						=> 'Reset mailer',
	'ACP_DIGESTS_RESET_CRON_RUN_TIME_EXPLAIN'				=> '',
	'ACP_DIGESTS_TEST'										=> 'Manually run the mailer',
	'ACP_DIGESTS_TEST_EXPLAIN'								=> 'This feature allows you to manually run digests for initial testing or troubleshooting. You can also use it to recreate digests for a particular date and hour. The board timezone (currently ' . $timeOffset . ' UTC) is used when calculating the date and hour. Please note that when digests are sent depends on board traffic, so digests may arrive late for some users. This can be changed if you set up <a href="https://wiki.phpbb.com/Modular_cron#Use_system_cron">a system cron</a> and <a href="'. $server_settings_url . '">enable</a> phpBB&apos;s <strong>system cron</strong> feature. For more information, see the FAQ for the Digests extension on the forums at phpbb.com.',

	'DIGESTS_ALL'											=> 'All',
	'DIGESTS_ALL_ALLOWED_FORUMS'							=> 'All allowed forums',
	'DIGESTS_ALL_SUBSCRIBED'								=> 'A total of %d members were mass subscribed to receive digests',
	'DIGESTS_ALL_UNSUBSCRIBED'								=> 'A total of %d members were mass unsubscribed to receive digests',
	'DIGESTS_BALANCE_LOAD'									=> 'Balance load',
	'DIGESTS_BASED_ON'										=> '(Based on %s UTC)',
	'DIGESTS_CURRENT_VERSION_INFO'							=> 'You are running version <strong>%s</strong>.',
	'DIGESTS_CUSTOM_STYLESHEET_PATH'						=> 'Custom stylesheet path',
	'DIGESTS_CUSTOM_STYLESHEET_PATH_EXPLAIN'				=> 'This setting only applies if the Enable custom stylesheet box is enabled. If it is enabled, this stylesheet will be applied to all HTML digests. The path should be a relative path from your phpBB styles directory and should normally be in the theme subdirectory. Note: you are responsible for creating this stylesheet and placing it in a file with the name entered here on the appropriate location on your server. Example: prosilver/theme/digest_stylesheet.css. For information on creating stylesheets, click <a href="http://www.w3schools.com/css/">here</a>.',
	'DIGESTS_COLLAPSE'										=> 'Collapse',
	'DIGESTS_DEFAULT'										=> 'Subscribe using default settings',
	'DIGESTS_ENABLE_AUTO_SUBSCRIPTIONS'						=> 'Enable automatic subscriptions',
	'DIGESTS_ENABLE_AUTO_SUBSCRIPTIONS_EXPLAIN'				=> 'If you want new users to automatically get digests, select Yes. The Board&apos;s default settings for digests will be automatically used. (These are set in the digests&apos; User default settings). Enabling this option will <em>not</em> create subscriptions for currently unsubscribed users, inactive members or for new members who chose not to receive a digest during registration. You can set these individually using the Edit Subscribers function, or globally with the Mass subscribe/unsubscribe option.',
	'DIGESTS_ENABLE_CUSTOM_STYLESHEET'						=> 'Enable custom stylesheet',
	'DIGESTS_ENABLE_CUSTOM_STYLESHEET_EXPLAIN'				=> 'If not enabled, the default stylesheet for the style selected in the user&apos;s profile is applied to HTML versions of their digests.',
	'DIGESTS_ENABLE_LOG'									=> 'Write all digest actions to the admin log',
	'DIGESTS_ENABLE_LOG_EXPLAIN'							=> 'If this is enabled, all digest actions will be written to the admin log (found on the Maintenance tab). This is helpful for solving digest problems since it indicates what the digests mailer did and when. However, it will quickly result in a very long Admin log since at least two entries will be written every hour to the log. Note: exceptions and warnings are always written to the log.',
	'DIGESTS_ENABLE_SUBSCRIBE_UNSUBSCRIBE'					=> 'Enable mass subscribe or unsubscribe',
	'DIGESTS_ENABLE_SUBSCRIBE_UNSUBSCRIBE_EXPLAIN'			=> 'If you say yes, when you press Submit the mass subscribe or unsubscribe action will occur. Enable with care!',
	'DIGESTS_EXCLUDE_FORUMS'								=> 'Always exclude these forums',
	'DIGESTS_EXCLUDE_FORUMS_EXPLAIN'						=> 'Enter the forum_ids for forums that must never appear in a digest. Separate the forum_ids with commas. If set to 0, no forums have to be excluded. To determine the forum_ids, when browsing a forum observe the "f" parameter on the URL field. This is the forum_id. Example: http://www.example.com/phpBB3/viewforum.php?f=1. Do not use forum_ids that correspond to categories. <i>This setting is ignored if bookmarked topics only are requested by a subscriber.</i>',
	'DIGESTS_EXPAND'										=> 'Expand',
	'DIGESTS_FROM_EMAIL_ADDRESS'							=> 'From E-mail Address',
	'DIGESTS_FROM_EMAIL_ADDRESS_EXPLAIN'					=> 'When users receive a digest, this e-mail address will appear in the FROM field. If left blank it will default to your board&apos;s e-mail contract address. Use caution if using an e-mail address with a domain other than the one the digest is hosted on, as your mail server or the user&apos;s e-mail server may interpret the e-mail as spam.',
	'DIGESTS_FROM_EMAIL_NAME'								=> 'From E-mail Name',
	'DIGESTS_FROM_EMAIL_NAME_EXPLAIN'						=> 'This is the plain text FROM name that will appear in the e-mail client. If left blank it will identify itself as a robot for your board.',
	'DIGESTS_HAS_UNSUBSCRIBED'								=> 'Has unsubscribed',
	'DIGESTS_HOUR_SENT'										=> 'Hour sent<br />(based on %s UTC)',
	'DIGESTS_IGNORE'										=> 'Ignore global actions',
	'DIGESTS_ILLOGICAL_DATE'								=> 'Your simulation date is illogical, such as February 31. Please fix and resubmit.',
	'DIGESTS_INCLUDE_ADMINS'								=> 'Include administrators',
	'DIGESTS_INCLUDE_ADMINS_EXPLAIN'						=> 'This will subscribe or unsubscribe administrators in addition to normal users.',
	'DIGESTS_INCLUDE_FORUMS'								=> 'Always include these forums',
	'DIGESTS_INCLUDE_FORUMS_EXPLAIN'						=> 'Enter the forum_ids for forums that must appear in a digest. Separate the forum_ids with commas. If set to 0, no forums have to be included. To determine the forum_ids, when browsing a forum observe the "f" parameter on the URL field. This is the forum_id. Example: http://www.example.com/phpBB3/viewforum.php?f=1. Do not use forum_ids that correspond to categories. <i>This setting is ignored if bookmarked topics only are requested by a subscriber.</i>',
	'DIGESTS_LAST_SENT'										=> 'Digest last sent',
	'DIGESTS_LIST_USERS'    								=> array(
																	1	=>	'1 User',
																	2	=>	'%d Users',
																),
	'DIGESTS_MAILER_NOT_RUN'								=> 'Mailer was not run because it was not enabled.',
	'DIGESTS_MAILER_RAN_SUCCESSFULLY'						=> 'Mailer was run successfully.',
	'DIGESTS_MAILER_SPOOLED'								=> 'Any digests created for the date and hour were saved in the store/ext/phpbbservices/digests directory.',
	'DIGESTS_MAX_CRON_HOURS'								=> 'Maximum hours for mailer to process per call',
	'DIGESTS_MAX_CRON_HOURS_EXPLAIN'						=> 'If you have dedicated or virtual hosting, you can usually leave this at 0 (zero) to process all hours. If you have <strong>shared hosting</strong> then running the mailer may trigger errors, particularly if you have many subscribers and many hours are processed. <em>Setting up a <a href="https://wiki.phpbb.com/PhpBB3.1/RFC/Modular_cron#Use_system_cron">system cron</a> is the easiest way to avoid this issue</em> and will ensure the timely arrival of digests. These errors can be triggered when the mailer exceeds a cap on shared resources. If this happens and you don&apos;t want to use a system cron, set this to 1 then increase only when experience shows processing additional hours will complete correctly. <em>Note:</em> this may delay the arrival of digests for some subscribers as the mailer needs board traffic to work.',
	'DIGESTS_MAX_ITEMS'										=> 'Maximum posts allowed in any digest',
	'DIGESTS_MAX_ITEMS_EXPLAIN'								=> 'For performance reasons, you may need to set an absolute limit to the number of posts in any one digest. If you set this to 0 (zero) this allows a digest to be of an unlimited size. You may use any whole number in this field. Please note that a digest is constrained by the number of posts in the type of digest requested (daily, weekly or monthly) as well as other criteria the user may set.',
	'DIGESTS_MIGRATE_UNSUPPORTED_VERSION'					=> 'Upgrades of the digests modification (for phpBB 3.0) are supported from version 2.2.6 forward. You have version %s. The extension cannot be migrated or installed. Please seek help on the support forum on phpbb.com.',
	'DIGESTS_NEVER_VISITED'									=> 'Never visited',
	'DIGESTS_NO_DIGESTS_SENT'								=> 'No digests sent',
	'DIGESTS_NO_MASS_ACTION'								=> 'No action was taken, because you did not enable the feature',
	'DIGESTS_NOTIFY_ON_ADMIN_CHANGES'						=> 'Notify member via email of administrator digest changes',
	'DIGESTS_NOTIFY_ON_ADMIN_CHANGES_EXPLAIN'				=> 'Edit subscribers, balance load and mass subscribe/unsubscribe allow the administrator to change a user&apos;s digest settings. If yes, emails will be sent to subscribers when any aspect of their subscription is changed by an administrator.',
	'DIGESTS_RANDOM_HOUR'									=> 'Random hour',
	'DIGESTS_REBALANCED'									=> 'During this rebalancing, a total of %d digests subscribers had their digest send hour changed.',
	'DIGESTS_REFRESH'										=> 'Refresh',
	'DIGESTS_REGISTRATION_FIELD'							=> 'Allow users to subscribe to digests upon registration',
	'DIGESTS_REGISTRATION_FIELD_EXPLAIN'					=> 'If enabled, upon registration users have the option to get digests using the board&apos;s defaults. This option does not appear if automatic subscriptions are enabled.',
	'DIGESTS_REPLY_TO_EMAIL_ADDRESS'						=> 'Reply to e-mail Address',
	'DIGESTS_REPLY_TO_EMAIL_ADDRESS_EXPLAIN'				=> 'When users receive a digest, this e-mail address will appear in the REPLY TO field. If left blank it will default to your board&apos;s e-mail contact address. Use caution if using an e-mail address with a domain other than the one the digest is hosted on, as your mail server or the user&apos;s mail server may interpret the e-mail as spam.',
	'DIGESTS_RESET_CRON_RUN_TIME'							=> 'Reset digests last run time',
	'DIGESTS_RESET_CRON_RUN_TIME_EXPLAIN'					=> "If too many days have elapsed since digests were mailed, you can reset the digest mailing time. When digests next are mailed they will be mailed to subscribers for the current hour only. The mailer was last run: $last_run. Note: manually running the mailer does not affect this setting.", 
	'DIGESTS_RUN_TEST'										=> 'Run the mailer',
	'DIGESTS_RUN_TEST_CLEAR_SPOOL'							=> 'Clear the store/ext/phpbbservices/digests directory',
	'DIGESTS_RUN_TEST_CLEAR_SPOOL_ERROR'					=> 'Could not remove all the files in the store/ext/phpbbservices/digests directory. This may be due to a permissions issue. The file permissions on the directory should be set to publicly writeable (777 on Unix-based systems).',
	'DIGESTS_RUN_TEST_CLEAR_SPOOL_EXPLAIN'					=> 'If Yes, any files in the store/ext/phpbbservices/digests directory will be erased. This is a good thing to do to ensure previous digest files are not accessible. This action is done before any new digests are written to this directory.',
	'DIGESTS_RUN_TEST_DAY'									=> 'Simulation day in the month',
	'DIGESTS_RUN_TEST_DAY_EXPLAIN'							=> 'Enter a whole number from 1 to 31. If the year, month and day are in the future of course no digests will be created. Don&apos;t use a day that does not logically belong in the month, like February 31.',
	'DIGESTS_RUN_TEST_EMAIL_ADDRESS'						=> 'Test email address',
	'DIGESTS_RUN_TEST_EMAIL_ADDRESS_EXPLAIN'				=> 'If an email address is specified in this field, all digests for the requested hour will be sent to this email address instead of the board contact email address.',
	'DIGESTS_RUN_TEST_HOUR'									=> 'Simulation hour',
	'DIGESTS_RUN_TEST_HOUR_EXPLAIN'							=> 'Digests will be sent as of the hour specified. The hour is based on your board timezone (' . $timeOffset . ' UTC). If it is in the future there will be no digests created. Enter a whole number from 0 to 23.',
	'DIGESTS_RUN_TEST_MONTH'								=> 'Simulation month',
	'DIGESTS_RUN_TEST_MONTH_EXPLAIN'						=> 'Enter a whole number from 1 to 12. Normally this should be set to the current month. If the year and month are in the future of course no digests will be created.',
	'DIGESTS_RUN_TEST_OPTIONS'								=> 'Run date and time options',
	'DIGESTS_RUN_TEST_SEND_TO_ADMIN'						=> 'Send all digests to the email address specified',
	'DIGESTS_RUN_TEST_SEND_TO_ADMIN_EXPLAIN'				=> 'If you want to email the digests in the test, all digests will be emailed to the address specified in the field below. If Yes, but no email address is specified, the board contact email address (' . $config['board_email']. ') will be used. <em>Caution</em>: certain email servers may interpret a large volume of emails in a short period of time from the same address as spam or inappropriate use. Enable with care. If you say No then digests will actually be mailed to subscribers, which may confuse them.',
	'DIGESTS_RUN_TEST_SPOOL'								=> 'Send results to files instead of emailing',
	'DIGESTS_RUN_TEST_SPOOL_EXPLAIN'						=> 'Prevents digests from being mailed. Instead each digest is written to a file in the store/ext/phpbbservices/digests directory with file names in the following format: username-yyyy-mm-dd-hh.html or username-yyyy-mm-dd-hh.txt. (Files with a .txt suffix are text-only digests.) yyyy indicates the year, mm the month, dd the day in month and hh the hour. Dates and hours in the file name are based on Coordinated Universal Time (UTC). If you simulate a different day or hour for mailing the digest using the fields below, file names will use those dates and hours. These digests can then be viewed if you specify the correct URL.',
	'DIGESTS_RUN_TEST_TIME_USE'								=> 'Simulate month and hour, or day of week and hour for sending digest',
	'DIGESTS_RUN_TEST_TIME_USE_EXPLAIN'						=> 'If set to Yes, the controls below will be used to send a digest as if it were the month and hour or the day of the week and hour specified. If No, the current date and hour will be used.',
	'DIGESTS_RUN_TEST_YEAR'									=> 'Simulation year',
	'DIGESTS_RUN_TEST_YEAR_EXPLAIN'							=> 'Years from 2000 through 2030 are allowed. Normally this should be set to the current year. If the year is in the future of course no digests will created.',
	'DIGESTS_SEARCH_FOR_MEMBER'								=> 'Search for member',
	'DIGESTS_SEARCH_FOR_MEMBER_EXPLAIN'						=> 'Enter the full or partial member name to look for then press Refresh. Leave blank to see all members. Searches are not case sensitive.',
	'DIGESTS_SELECT_FORUMS_ADMIN_EXPLAIN'					=> 'The list of forums includes only those forums this user is allowed to read. If you wish to give this user access to additional forums not shown here, expand their forum user or group permissions. Note although you can fine tune the forums that appear in their digest, if their digest type is "None" no digest will actually be sent.',
	'DIGESTS_SHOW'											=> 'Show',
	'DIGESTS_SHOW_EMAIL'									=> 'Show email address in log',
	'DIGESTS_SHOW_EMAIL_EXPLAIN'							=> 'If this is enabled, the subscriber&apos;s email address is shown in entries in the admin log when logging is enabled. This can be useful in troubleshooting digest issues such as "Where was my digest sent to on this date and hour?"',
	'DIGESTS_SORT_ORDER'									=> 'Sort order',
	'DIGESTS_STOPPED_SUBSCRIBING'							=> 'Stopped subscribing',
	'DIGESTS_SUBSCRIBE_EDITED'								=> 'Your digest subscription settings have been edited',
	'DIGESTS_SUBSCRIBE_SUBJECT'								=> 'You have been subscribed to receive email digests',
	'DIGESTS_SUBSCRIBE_ALL'									=> 'Subscribe all',
	'DIGESTS_SUBSCRIBE_ALL_EXPLAIN'							=> 'If you say no, everyone will be unsubscribed.',
	'DIGESTS_SUBSCRIBE_LITERAL'								=> 'Subscribe',
	'DIGESTS_SUBSCRIBED'									=> 'Subscribed',
	'DIGESTS_SUBSCRIBERS'                           		=> 'Subscribers',	
	'DIGESTS_TIME_ZONE'										=> 'Time zone',
	'DIGESTS_TIME_ZONE_EXPLAIN'								=> 'The edit subscribers and balance load digest functions show the hour when digests are emailed. If you set a particular time zone here, the hour emailed will be translated into the time zone you set here. Initially this is set to the board timezone. Values must be integers from -12 to 12, with 0 being UTC.',
	'DIGESTS_UNSUBSCRIBE'									=> 'Unsubscribe',
	'DIGESTS_UNSUBSCRIBE_SUBJECT'							=> 'You have been unsubscribed from receiving email digests',
	'DIGESTS_UNSUBSCRIBED'									=> 'Has never subscribed',
	'DIGESTS_USER_DIGESTS_ATTACHMENTS'						=> 'Default for show attachments',
	'DIGESTS_USER_DIGESTS_BLOCK_IMAGES'						=> 'Default for block images',
	'DIGESTS_USER_DIGESTS_CHECK_ALL_FORUMS'					=> 'Do you want all forums to be selected by default',
	'DIGESTS_USER_DIGESTS_FILTER_TYPE'						=> 'Default types of posts in digests',
	'DIGESTS_USER_DIGESTS_MAX_DISPLAY_WORDS'				=> 'Default maximum words to display in a post',
	'DIGESTS_USER_DIGESTS_MAX_DISPLAY_WORDS_EXPLAIN'		=> 'Set to -1 to show the full post text by default. Setting at zero (0) means by default  the user will see no post text at all.',
	'DIGESTS_USER_DIGESTS_MAX_POSTS'						=> 'Default maximum number of posts in a digest',
	'DIGESTS_USER_DIGESTS_MAX_POSTS_EXPLAIN'				=> 'If set at zero, will allow any number of posts. Please note that the no digest will ever contain more than your setting for maximum posts allowed in any digest (see General Settings).',
	'DIGESTS_USER_DIGESTS_MIN_POSTS'						=> 'Default minimum number of words for a post to appear in a digest',
	'DIGESTS_USER_DIGESTS_MIN_POSTS_EXPLAIN'				=> 'If set at zero, will allow posts with any number of words per post. ',
	'DIGESTS_USER_DIGESTS_NEW_POSTS_ONLY'					=> 'Default for show new posts only',
	'DIGESTS_USER_DIGESTS_PM_MARK_READ'						=> 'Default for mark private messages as read when they appear in the digest',
	'DIGESTS_USER_DIGESTS_REGISTRATION'						=> 'Default for whether a user has the option to subscribe to digests upon registering',
	'DIGESTS_USER_DIGESTS_RESET_LASTVISIT'					=> 'Default for reset last visit date when sent a digest',
	'DIGESTS_USER_DIGESTS_SEND_HOUR_GMT'					=> 'Default hour sent (UTC)',
	'DIGESTS_USER_DIGESTS_SEND_ON_NO_POSTS'					=> 'Default for send a digest if there are no new posts',
	'DIGESTS_USER_DIGESTS_SHOW_FOES'						=> 'Default for remove posts from user&apos;s foes',
	'DIGESTS_USER_DIGESTS_SHOW_MINE'						=> 'Default for remove user&apos;s posts',
	'DIGESTS_USER_DIGESTS_SHOW_PMS'							=> 'Default for add user&apos;s unread private messages',
	'DIGESTS_USER_DIGESTS_SORT_ORDER'						=> 'Default post sort order',
	'DIGESTS_USER_DIGESTS_STYLE'							=> 'Default digest style',
	'DIGESTS_USER_DIGESTS_TYPE'								=> 'Default user digest type',
	'DIGESTS_USER_DIGESTS_TOC'								=> 'Default for table of contents',
	'DIGESTS_USERS_PER_PAGE'								=> 'Subscribers per page',
	'DIGESTS_USERS_PER_PAGE_EXPLAIN'						=> 'This controls how many rows of digest subscribers an administrator sees per page when they select the edit subscribers option.',
	'DIGESTS_WEEKLY_DIGESTS_DAY'							=> 'Select the day of the week for sending out weekly digests',
	'DIGESTS_WITH_SELECTED'									=> 'With selected',

	'LOG_CONFIG_DIGESTS_BAD_DIGEST_TYPE'					=> '<strong>Warning: subscriber %s has a bad digest type of %s. Assumed a daily digest is wanted.</strong>',
	'LOG_CONFIG_DIGESTS_BAD_SEND_HOUR'						=> '<strong>User %s digest send hour is invalid. It is %d. The number should be >= 0 and < 24.</strong>',
	'LOG_CONFIG_DIGESTS_BALANCE_LOAD'						=> '<strong>Digests balance load run successfully</strong>',
	'LOG_CONFIG_DIGESTS_BOARD_DISABLED'						=> '<strong>Digest mailer run was attempted, but stopped because the board is disabled.</strong>',
	'LOG_CONFIG_DIGESTS_CACHE_CLEARED'						=> '<strong>The store/ext/phpbbservices/digests directory was emptied',
	'LOG_CONFIG_DIGESTS_CLEAR_SPOOL_ERROR'					=> '<strong>Unable to clear files in the store/ext/phpbbservices/digests directory. This may be due to a permissions issue or an incorrect path. The file permissions on the directory should be set to publicly writeable (777 on Unix-based systems).</strong>',
	'LOG_CONFIG_DIGESTS_DIRECTORY_CREATE_ERROR'				=> '<strong>Unable to create a store/ext/phpbbservices/digests directory. This may be due to a permissions issue with your forum&apos;s store folder.</strong>',
	'LOG_CONFIG_DIGESTS_EDIT_SUBSCRIBERS'					=> '<strong>Edited Digest subscribers</strong>',
	'LOG_CONFIG_DIGESTS_FILE_CLOSE_ERROR'					=> '<strong>Unable to close file %s</strong>',
	'LOG_CONFIG_DIGESTS_FILE_OPEN_ERROR'					=> '<strong>Unable to open a file handler to the directory %s. This may be due to insufficient permissions. The file permissions on the directory should be set to publicly writeable (777 on Unix-based systems).</strong>',
	'LOG_CONFIG_DIGESTS_FILE_WRITE_ERROR'					=> '<strong>Unable to write file %s. This may be due to insufficient permissions. The file permissions on the directory should be set to publicly writeable (777 on Unix-based systems).</strong>',
	'LOG_CONFIG_DIGESTS_FILTER_ERROR'						=> '<strong>Digests mailer was called with an invalid user_digest_filter_type = %s for %s</strong>',
	'LOG_CONFIG_DIGESTS_FORMAT_ERROR'						=> '<strong>Digests mailer was called with an invalid user_digest_format of %s for %s</strong>',
	'LOG_CONFIG_DIGESTS_GENERAL'							=> '<strong>Altered Digest general settings</strong>',
	'LOG_CONFIG_DIGESTS_HOUR_RUN'							=> '<strong>Running digests for %s UTC</strong>',
	'LOG_CONFIG_DIGESTS_LOG_ENTRY_BAD'						=> '<strong>Unable to send a digest to %s (%s)</strong>',
	'LOG_CONFIG_DIGESTS_LOG_ENTRY_BAD_NO_EMAIL'				=> '<strong>Unable to send a digest to %s</strong>',
	'LOG_CONFIG_DIGESTS_LOG_ENTRY_GOOD'						=> '<strong>A digest was %s %s (%s) for date %s and hour %d UTC containing %d posts and %d private messages</strong>',
	'LOG_CONFIG_DIGESTS_LOG_ENTRY_GOOD_DISK'				=> '<strong>A digest was written to the store/ext/phpbbservices/digests directory with a file name of %s. The digest was NOT emailed, but was placed here for analysis.</strong>',
	'LOG_CONFIG_DIGESTS_LOG_ENTRY_GOOD_NO_EMAIL'			=> '<strong>A digest was %s %s for date %s and hour %d UTC containing %d posts and %d private messages</strong>',
	'LOG_CONFIG_DIGESTS_LOG_ENTRY_NONE'						=> '<strong>A digest was NOT sent to %s (%s) because user filters and preferences meant there was nothing to send</strong>',
	'LOG_CONFIG_DIGESTS_LOG_ENTRY_NONE_NO_EMAIL'			=> '<strong>A digest was NOT sent to %s because user filters and preferences meant there was nothing to send</strong>',
	'LOG_CONFIG_DIGESTS_LOG_START'							=> '<strong>Starting digest mailer</strong>',
	'LOG_CONFIG_DIGESTS_LOG_END'							=> '<strong>Ending digest mailer</strong>',
	'LOG_CONFIG_DIGESTS_MAILER_RAN_WITH_ERROR'				=> '<strong>An error occurred while the mailer was running. One or more digests may have been successfully generated.</strong>',
	'LOG_CONFIG_DIGESTS_MANUAL_RUN'							=> '<strong>Manual run of the mailer invoked</strong>',
	'LOG_CONFIG_DIGESTS_MESSAGE'							=> '<strong>%s</strong>',	// Used for general debugging, otherwise hard to do in cron mode.
	'LOG_CONFIG_DIGESTS_MASS_SUBSCRIBE_UNSUBSCRIBE'			=> '<strong>Executed a digests mass subscribe or unsubscribe action</strong>',
	'LOG_CONFIG_DIGESTS_NO_ALLOWED_FORUMS'					=> '<strong>Warning: subscriber %s does not have any forum permissions, so unless there are required forums, digests will never contain any content.</strong>',
	'LOG_CONFIG_DIGESTS_NO_BOOKMARKS'						=> '<strong>Warning: subscriber %s wants bookmarked topics in their digest but does not have any bookmarked topics.</strong>',
	'LOG_CONFIG_DIGESTS_NOTIFICATION_ERROR'					=> '<strong>Unable to send an administrator generated digests email notification to %s</strong>',
	'LOG_CONFIG_DIGESTS_NOTIFICATION_SENT'					=> '<strong>An email was sent to %s (%s) indicating that their digest settings were changed</strong>',	
	'LOG_CONFIG_DIGESTS_REGULAR_CRON_RUN'					=> '<strong>Regular (phpBB) cron run of the mailer invoked</strong>',
	'LOG_CONFIG_DIGESTS_RESET_CRON_RUN_TIME'				=> '<strong>Digests mailing time was reset</strong>',
	'LOG_CONFIG_DIGESTS_RUN_TOO_SOON'						=> '<strong>Less than an hour has elapsed since digests were last run. Run aborted.</strong>',
	'LOG_CONFIG_DIGESTS_SIMULATION_DATE_TIME'				=> '<strong>Administrator chose to create digests for %s at %d:00 board time.</strong>',
	'LOG_CONFIG_DIGESTS_SORT_BY_ERROR'						=> "<strong>Digests mailer was called with an invalid user_digest_sortby = %s for %s</strong>",
	'LOG_CONFIG_DIGESTS_SYSTEM_CRON_RUN'					=> '<strong>System cron run of the mailer invoked</strong>',
	'LOG_CONFIG_DIGESTS_TIMEZONE_ERROR'						=> '<strong>The user_timezone "%s" for username "%s" is invalid. Assumed a timezone of "%s". Please ask user to set a proper timezone in the User Control Panel. See http://php.net/manual/en/timezones.php for a list of valid timezones.</strong>',
	'LOG_CONFIG_DIGESTS_USER_DEFAULTS'						=> '<strong>Altered Digest user default settings</strong>',

));
