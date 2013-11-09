/*****************************************************************************

[ SIGNAL MEDIA LTD ]

Main JavaScript File (general.js)
Version: 2.0;
Author: Samir Moussa;
Email: samir.moussa@signal.uk.com, smoussa@hotmail.co.uk;

	- Description
	
	- Contents


*****************************************************************************/

// Load Typekit fonts
try {Typekit.load();} catch(e) {}

// Global objects
var PAGE = {};
var MENU = {};
var BANNER = {};
var MODULES = {};
var PANEL = {};

// On document load
$(document).ready(function() {


	/*=========================================================
		Add jQuery Extensions
	=========================================================*/

	/*
		Add easing function for menu opening.
	*/
	$.extend($.easing, {
		easeOutQuint: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) {
				return c/2*t*t*t*t*t + b;
			}
			return c/2*((t-=2)*t*t*t*t + 2) + b;
		}
	});



	/*=========================================================
		Initialise Objects
	=========================================================*/


	/*
		Page object to hold a page's elements as objects
	*/
	var page = {

		$window: $(window),
		$html: $('html'),
		$body: $('body'),
		$htmlAndBody: $('html, body'),
		$back: $("main-back"),
		$content: $('#content'),
		$feed: $('.feed'),

		//isSafari: (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1),
		isIPad: (navigator.userAgent.match(/IPad/i) != null),

		/*
			Scroll to the top of the page
		*/
		scrollToTop: function() {

			if (menu.menuOpen) {
				menu.closeMenu();
			}
	    	page.$htmlAndBody.animate({ scrollTop: "0" }, 1200);

		},

		/*
			Enable page scrolling
		*/
		enableScrolling: function() {

			if (page.isIPad) {
				page.$(document).unbind('touchmove', false);
			} else if (page.isTabletSize()) {
				page.$content.css('overflow', 'visible');
			} else {
				page.$htmlAndBody.not(menu.$menu).css('overflow', 'visible');
			}

		},

		/*
			Disable page scrolling
		*/
		disableScrolling: function() {

			if (page.isIPad) {
				$(document).bind('touchmove', false);
			} else if (page.isTabletSize()) {
				page.$content.css('overflow', 'hidden');
			} else {
				page.$htmlAndBody.not(menu.$menu).css('overflow', 'hidden');
			}

		},

		isTabletSize: function() {
			return ((page.$body.width() <= 768) || (page.$body.height() <= 560));
		},

		isMobileSize: function() {
			return ((page.$body.width() <= 480) || (page.$body.height() <= 500));
		},

		isTabletLandscape: function() {
			return (this.$body.width() <= 1020);
		}

	}


	var menu = {

		$menuBtn: $('.menu_btn, .close'),
		$menu: $('#menu'),
		$menuItem: $('#menu a'),
		$subMenuItem: $('.submenu a'),

		menuOpen: false,
		duration: 400,

		/*
			Open the Main menu
		*/
		openMenu: function() {

			if (!page.isTabletSize()) { // desktop

				page.$content.addClass('pushed').delay(menu.duration + 120).queue(function(next) {
					menu.$menu.css("z-index", "5");
					next();
				});

			} else { // tablet size or smaller

				menu.$menu.show(0, function() {
					page.$content.addClass('pushed').delay(menu.duration + 120).queue(function(next) {
						menu.$menu.css("z-index", "5");
						next();
					});
				});
				

			}

			page.disableScrolling();
			menu.menuOpen = true;

		},

		/*
			Close the Main menu
		*/
		closeMenu: function() {

			if (!page.isTabletSize()) { // desktop

				menu.$menu.css("z-index", "0").queue(function(next) {
					page.$content.delay(menu.duration + 20).removeClass('pushed');
					next();
				});

			} else { // tablet size or smaller

				menu.$menu.css("z-index", "0").queue(function(next) {
					page.$content.delay(menu.duration + 20).removeClass('pushed').queue(function(next) {
						menu.$menu.hide();
						next();
					});
					next();
				});

			}

			page.enableScrolling();
			menu.menuOpen = false;

		}

	}


	var banner = {

		$banner: $('#banner'),
		$fixedBanner: $('#banner-fixed'),
		$fixedBannerLogo: $('#banner-fixed .logo'),
		$fixedNav: $('#nav-fixed'),
		$bannerInfo: $('#banner .info'),

		showingFixedBanner: false,
		triggerHeight: 0,
		duration: 400,

		/*
			Calculate the height at which the fix banner should appear.
		*/
		calculateTriggerHeight: function() {
			return banner.$banner.offset().top + banner.$banner.outerHeight() - banner.$fixedBanner.outerHeight() + 1;
		},

		/*
			Test the position of the current page being scrolled
		*/
		testTriggerHeight: function() {

			if (!page.isTabletSize()) {
				var scrollTop = page.$window.scrollTop();
				if (scrollTop >= banner.triggerHeight) {
					banner.showFixedBanner();
				} else if (scrollTop < banner.triggerHeight) {
					banner.hideFixedBanner();
				}
			}

		},

		/*
			Show the fixed banner when scrolling below the main banner
		*/
		showFixedBanner: function() {

			page.$content.addClass('collapsed').queue(function(next) {
				banner.$fixedNav.addClass('fadeIn'); // timing set in CSS
				banner.$bannerInfo.stop(true, true).fadeOut();
				banner.showingFixedBanner = true;
				next();
			});

		},

		/*
			Hide the fixed banner when scrolling back up to the main banner
		*/
		hideFixedBanner: function() {

			page.$content.removeClass('collapsed').queue(function(next) {
				banner.$bannerInfo.fadeIn(banner.duration + 50);
				banner.$fixedNav.removeClass('fadeIn'); // timing set in CSS
				banner.showingFixedBanner = false;
				next();
			});

		}

	}


	/*
		Article object
	*/
	var articles = {

		/*
			Toggle the article read more section and show/hide its items when the module heading is clicked
		*/
		toggleArticle: function(self) {

			if (self.hasClass('opened')) {
				articles.closeArticle(self);
			} else {
				articles.openArticle(self);
			}

		},

		openArticle: function(self) {

			var arrow = self.children('.outer');
			var relatedSection = self.siblings('.related');

			relatedSection.show(100).delay(200).queue(function(next) {
				relatedSection.addClass('show');
				next();
			});
			self.addClass('opened');
			arrow.addClass('rotate');

			// change text
			self.children('.text').text('Less');

			// show more content
			self.siblings('.story').children('.more').fadeIn();

		},

		closeArticle: function(self) {

			var arrow = self.children('.outer');
			var relatedSection = self.siblings('.related');

			relatedSection.removeClass('show').delay(450).queue(function(next) {
				relatedSection.hide(100);
				next();
			});
			self.removeClass('opened');
			arrow.removeClass('rotate');

			// change text
			self.children('.text').text('More');

			// hide more content
			self.siblings('.story').children('.more').fadeOut();

		}

	}


	/*
		News Feed
	*/
	var feedLoader = {

		$loadMoreButton: $('.load-more'),
		articleFetchURL: "./ajax/more_articles.html",
		loadCount: 5,

        /*
			Inifinite scrolling
		*/
		loadMoreArticlesAutomatically: function() {

			var currentPos = $(window).scrollTop();
			var endOfPagePos = $(document).height() - $(window).height();
			var threshold = 300;

			if ((currentPos + threshold) >= endOfPagePos && !PAGE.isTabletSize()) {
				feedLoader.loadArticles();
		    }

		},

		/*
			Load more articles when the load more button is clicked (Mobile).
		*/
		loadMoreArticlesOnClick: function() {
			feedLoader.loadArticles();
		},

		/*
			Load more articles
		*/
		loadArticles: function() {

			$.post(feedLoader.articleFetchURL, function(data) {

	        	var $data = $(data);
	        	var articles = $data.find('article');
	        	var articleCount = articles.length;

		        if (articleCount > 0) { // If there are more articles

		          	PAGE.$feed.append(articles.slice(0, feedLoader.loadCount)); // append articles
		          	if (PAGE.isTabletSize()) {
		          		feedLoader.$loadMoreButton.appendTo(PAGE.$feed); // move button down
		          	}
		          	

		        } else { // If there are no more articles

					if (PAGE.isTabletSize()) {
		          		feedLoader.$loadMoreButton.remove();
		          	}

		          	// More logic

		        }

	        });

		}

	}


	/*
		Module set object
	*/
	var modules = {

		$expandableGroupHeaders: $('.module.expandable .group-heading'),
		$groupHeadings: $('.group-heading'),

		/*
			Toggle the module and show/hide its items when the module heading is clicked
		*/
		toggleModule: function(self) {

			if (self.hasClass('opened')) {
				modules.closeModule(self);
			} else {
				modules.openModule(self);
			}

		},

		openModule: function(self) {

			var arrow = self.children('.outer');
			var group = self.next('.group-items');

			group.show(200).queue(function(next) {
				group.addClass('show');
				next();
			});
			self.addClass('opened');
			arrow.addClass('rotate');

		},

		closeModule: function(self) {

			var arrow = self.children('.outer');
			var group = self.next('.group-items');

			group.removeClass('show').delay(420).queue(function(next) {
				group.hide(200);
				next();
			});
			self.removeClass('opened');
			arrow.removeClass('rotate');

		},

		closeAllModules: function() {

			modules.$groupHeadings.each(function() {

				var self = $(this);
				var arrow = self.children('.outer');
				var group = self.next('.group-items');

				group.removeClass('show').delay(250).queue(function(next) {
					group.hide(200);
					next();
				});
				self.removeClass('opened');
				arrow.removeClass('rotate');

			});

		}

	}

	/*
		Panel set object
	*/
	var panels = {
		
		$panels: $('.panel'),
		$darkBack: $('.dark-back'),
		$closeBtn: $('.panel .close-btn'),

		closeAllPanels: function() {

			PAGE.$body.removeClass('panel-pushed');
		   	panels.$panels.removeClass('pushed');
		   	panels.$darkBack.removeClass('show');
		   	PAGE.enableScrolling();

		}

	}


	/*=========================================================
		Class Definitions
	=========================================================*/

	/*
		Side panel class
	*/
	function Panel($id) {
		this.panel = $id;
	}

	Panel.prototype.openPanel = function() {

	   	PAGE.$body.addClass('panel-pushed');
	   	panels.$darkBack.addClass('show');
	   	this.panel.addClass('pushed');

	   	PAGE.scrollToTop();
		PAGE.disableScrolling();

	}

	Panel.prototype.closePanel = function() {
	   	this.panel.removeClass('pushed');
	}



	/*=========================================================
		Set Global Variables
	=========================================================*/

	PAGE = page;
	MENU = menu;
	BANNER = banner;
	MODULES = modules;
	PANEL = Panel;

	 // calculate the height at which the fixed banner appears
	BANNER.triggerHeight = BANNER.calculateTriggerHeight();



	/*=========================================================
		Window Scroll & Resize Listeners
	=========================================================*/

	/*
		While window is scrolling
	*/
	PAGE.$window.scroll(function () {
	    banner.testTriggerHeight();
	    feedLoader.loadMoreArticlesAutomatically();
    });

	/*
		While window is resizing
	*/
    PAGE.$window.resize(function() {

    	// close the menu when the user resizes the window
    	if (MENU.menuOpen && !PAGE.isMobileSize()) {
			MENU.closeMenu();
		}

    	if (!PAGE.isTabletSize()) {
    		// show the menu in the background
    		MENU.$menu.show();
    		// calculate new fixed banner visibility height.
	    	BANNER.triggerHeight = BANNER.calculateTriggerHeight();
	    }

	    feedLoader.$loadMoreButton.appendTo(PAGE.$feed);

    });



    /*=========================================================
		General Event Listeners
	=========================================================*/

    /*
		Scroll to top when the banner logo is clicked
	*/
    BANNER.$fixedBannerLogo.on('click', function() {
    	PAGE.scrollToTop();
	});

	/*
		Toggle the main menu when the Menu button is clicked
	*/
	MENU.$menuBtn.on('click', function() {
		if (MENU.menuOpen) {
			MENU.closeMenu();
		} else {
			MENU.openMenu();
		}
	});

	/*
		If a menu item in the main side menu is clicked, close the menu
	*/
	MENU.$menuItem.on('click', function() {
		MENU.closeMenu();
	});



	/*=========================================================
		News Feed Event Listeners
	=========================================================*/

	/*
		Load more articles when the laod more button is clicked
	*/
	feedLoader.$loadMoreButton.on("click", function() {
		feedLoader.loadMoreArticlesOnClick();
	});

	PAGE.$feed.on("click", '.meta.more', function() {
		articles.toggleArticle($(this));
	});

	PAGE.$feed.on("click", '.story', function() {
		articles.toggleArticle($(this).siblings('.meta.more'));
	});



	/*=========================================================
		Module Event Listeners
	=========================================================*/

	/*
		Expand the module when the module header is clicked
	*/
	modules.$expandableGroupHeaders.on("click", function() {
		modules.toggleModule($(this));
	});




	/*=========================================================
		Side Panels Event Listeners
	=========================================================*/

	/*
		Close all side panels when the close button is pressed
	*/
	panels.$closeBtn.on("click", function() {
		panels.closeAllPanels();
	});

	/*
		Close the side panels if the dark background is clicked
	*/
	panels.$darkBack.on("click", function() {
		panels.closeAllPanels();
	});

	/*
		Close the side panels if the user swipes right on mobile/tablet
	*/
	PAGE.$body.swiperight(function() {
		panels.closeAllPanels();
	});








	
	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");


});