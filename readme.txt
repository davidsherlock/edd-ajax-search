=== Easy Digital Downloads - Ajax Search ===
Contributors: sellcomet
Tags: sellcomet, easy, digital, downloads, easy digital downloads, edd, ajax, search, ajax search, edd ajax search, edd ajax, edd search, form, search form, ajax form, search result, blog ajax search, blog
Requires at least: 4.0
Tested up to: 4.9.5
Stable tag: 1.0.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Live product search for Easy Digital Downloads.

== Description ==

Ajax Search for Easy Digital Downloads creates a simple search form that shows instant search results by suggesting products from your store that match the search criteria. The search works just like Google suggestions but this tool will function directly on your own site, using your own database.

Just start typing into the search input and a list of useful, targeted product suggestions will be shown to your customers; the more they write, the more accurate search results will be. At that point customers can simply choose what they want from the list.

= Features of Easy Digital Downloads - Ajax Search =

* Short-code to easily show the search form anywhere on your site (includes a short-code generator)
* Widget to show the search form in any sidebar
* Categories dropdown to help filter search results more precisely (with option to include all)
* Automatically caches results to speed up all searches
* Options to customise the search form:
    * Set minimum number of characters required to execute search.
    * Set maximum number of results returned.
    * Search input text placeholder.
    * Show/Hide categories dropdown.
    * Show/Hide submit button.
    * Submit button label.
* Option to restrict search results to download post types only on the search archive page.

If you want to boost EDD Ajax Search, you can also visit our website and explore the [official page](https://sellcomet.com/downloads/edd-ajax-search-pro/) of the pro version, which includes all the following premium features to truly give your customers the best search experience.

= Premium Features included in Easy Digital Downloads - Ajax Search Pro =

* All features included in the free version of Ajax Search
* Enhances the default WordPress search to search by title, content, excerpt, categories, tags, post types, authors (vendors), and custom meta keys, if defined.
* An optional taxonomy navigation menu that can be displayed below the search form, allowing customers the ability to quickly browse specific download categories or tags. Taxonomies are fully customised so only specific categories or tags are displayed, with ability to set specific parameters such as “Order By”, “Order”, “Hide Children”, “Hide Empty” and “Show Counts”.
* Customisable frontend categories, tags, and post type drop-downs to help filter search results more precisely (with option to include all)
* Returned search results are fully customisable, allowing you to reorder how the per-result elements are rendered, such as title, price, categories, tags, author, purchase button, etc. Specific elements can be easily disabled if desired.
* Easily reorder and disable specific search form elements, including the search field, submit button, categories, tags, and post type drop-downs.
* Show a customisable “View More” link at the bottom of the search results, with the ability to modify the “No Results Found” text.
* Automatically caches results to speed up all searches
* Reports of the most popular
* Enhanced WordPress search can be easily disabled if you wish to use your own search engine (SearchWP for example).
* Ability to define custom meta keys to search with conditional operators to make searches more precise.
* Control the order that results are returned by including “Best Match” (results which contain the greatest number of matches first), date, and post type preferences.
* Choose to use a modern SVG search icon within the search input field, for a more familiar user experience.
* Fully template-based architecture, making it easy to override all design elements and style to your liking.
* Clean HTML markup and bloat-free CSS styling, making it easy to style the specific elements to fit your site/theme design.
* CSS resources (stylesheets) can be easily disabled from the options.
* Built with developers and third-party integration in mind. Loaded with action hooks and filters, making customisation easy.

For a more detailed list of options and features of Easy Digital Downloads Ajax Search and Ajax Search Pro, please read the [official documentation](https://sellcomet.com/docs/edd-ajax-search/ "EDD Ajax Search Official Documentation").

== Installation ==

= From WordPress backend =

1. Navigate to Plugins -> Add new.
2. Click the button "Upload Plugin" next to "Add plugins" title.
3. Upload the downloaded zip file and activate it.

= Direct upload =

1. Upload the downloaded zip file into your `wp-content/plugins/` folder.
2. Unzip the uploaded zip file.
3. Navigate to Plugins menu on your WordPress admin area.
4. Activate this plugin.

== Screenshots ==

1. Frontend: EDD Ajax Search output example
2. Admin - Tsunoa -> EDD Ajax Search

== Frequently Asked Questions ==

* Does EDD Ajax Search uses any caching method?
Yes, of course. EDD Ajax Search automatically caches results to improve speed for already executed searches.

* What is the purpose of the submit button?
EDD Ajax Search triggers automatically the search when the user types the minimum number of characters required to execute the search. The submit button will send the entered search query to the default WordPress search engine.

*  What parameters does the [edd-ajax_search] short-code support?
In your WordPress admin area, navigate to EDD Ajax Search settings page where you can find a short-code generator that will help you to generate the needed short-code to place on your site.

== Suggestions ==

If you have suggestions about how to improve EDD Ajax Search, you can [write to us](mailto:support@sellcomet.com "Sell Comet") so we can bundle them into EDD Ajax Search.

== Translators ==

= Available Languages =

* English

If you have created your own language pack, or have an update for an existing one, you can send [gettext PO and MO file](http://codex.wordpress.org/Translating_WordPress "Translating WordPress")
[use](https://sellcomet.com/contact/ "Sell Comet") so we can bundle it into EDD Ajax Search languages.

== Changelog ==

= 1.0.6 =

* Full code-base refactor/re-write and migration to Sell Comet branding
* Added search query sanitisation
* Added filters for theme developers to control the search result elements rendered
* Fixed search results browser resizing issue
* Added local browser cache for better overall search experience
* Improved CSS and overall design aesthetic
* Improved PHP 7.2 compatibility with internal libraries
* Updated all internal libraries to latest versions
* Code formatting and internal phpDocumentor improvements
* Added ability to restrict search results to downloads only

= 1.0.5 =

* Plugin activation improvements.

= 1.0.4 =

* Internal libraries update.
* Improve PHP compatibility.

= 1.0.3 =

* Improve PHP compatibility.

= 1.0.2 =

* Search engine improvements
* Reset settings utility
* Updater improvement

= 1.0.1 =

* Common changes:
    * Added results loader while loading
    * Functions to keep suggestions visible while user navigates through the form
* Premium version:
   * Option to use HTML5 inputs in search form

= 1.0.0 =

* Initial release
