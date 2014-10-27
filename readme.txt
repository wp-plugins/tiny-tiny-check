=== Tiny Tiny Check ===
Contributors: mitakas
Tags: tt-rss, tiny tiny rss
Requires at Least: 2.8
Tested Up To: 4.0
Stable tag: 0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Show number of unread items in your Tiny Tiny RSS installation.

== Description ==

Currently only a widget that shows the number of unread items in your [Tiny Tiny RSS](http://tt-rss.org/redmine/projects/tt-rss/wiki) installation.

== Installation ==

1. Upload the contents of the zip file to wp-contents/plugins/
1. Activate the widget in the Plugins page
1. Add the widget, then enter the link to your Tiny Tiny RSS installation and your username.

== Frequently Asked Questions ==

= How does this work? Do I need to login? =

Tiny Tiny RSS allows you to make some API calls without the need to login: [getUnread](http://tt-rss.org/redmine/projects/tt-rss/wiki/FrequentlyAskedQuestions#I-need-to-get-the-number-of-unread-articles-in-the-most-simple-way) is one of them.

= How do I input the URL? =

For now you have to type in the protocol, e.g. "http://example.com/tt-rss/" or "https://example.com/tt-rss/".

== Upgrade Notice ==

== Changelog ==

= 0.2 =

* Add German translation
* Automatically add trailing slash in the URL
* Clarify documentation

= 0.1 =

* Initial version
