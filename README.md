## UptimeRobot Wordpress Dashboard Widget

### A Wordpress Administrator Dashboard Widget for displaying UptimeRobot Monitors

### Synopsis

*NOTE: (April 2014) This Project has note been worked on in a good year plus. The coding and API styling should still be valid. I will go through and update this project when I have the time permitted. My thoughts were to add a Custom Admin Settings panel that would allow you to enter your API key then choose from Domains available or just the domain that matches the WP Admin you are in. Also would like to spruce up the actual Widget it's self. Another thought is to add an uptime counter to the Static Top Bar. Thoughts are always appreciated!*

Wordpress ([wordpress.org/](http://codex.wordpress.org/)) has been such a valuable tool when it comes to developing and designing beautiful client websites. While designing a custom _Wordpress Dashboard_ for a client I realized that I would like to show-off to this particular client their Up and Downtime Statistics. What better way to accomplish that then to add it to the Dashboard. I foresee this Widget being much more powerful. The very first release will contain just basic code that you will add to your functions.php file. I based the original code around the example given by **UptimeRobot** ([uptimerobot.com/](http://www.uptimerobot.com/)) on their API page ([uptimerobot.com/api](http://uptimerobot.com/api.asp)) and added some Wordpress Functionality and Events. As it is right now, I can say that there is a lot that needs to be done. There is a lot that I dislike about the code at this point; I don't like inline styles, I don't like the simplicity of the code for security purposes. I encourage all to help build this widget up so that not only can we display these statistics to our clients but for multiple uses on your Wordpress Blogs and Websites. All constructive collaboration and criticism is welcome.

#### Changelog & Roadmap
=======


_version 0.2_-

* First commit to GitHub
* Basic code creation
* Functionality includes showing _Website being monitored_, _Is your specified Website online?_ and _All Time Uptime Percent_

_Upcoming Features_ -

* Implementation of UptimeRobot API's usage of ` [log] ` to show user the last 5 times that the Website was marked as down
* Full implementation of API to include Add/Modify/Create Monitors in your Wordpress Settings page
* And all suggestions are welcome.

***

### _License_

The MIT License (MIT)

Copyright © 2012 Joshua Canfield, http://icodeclarity.com <support@icodeclarity.com>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
=======
Uptime Robot WP Plugin © 2011 by @creativeboulder.com is licensed under CC BY 4.0 