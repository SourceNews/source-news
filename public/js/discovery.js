/*****************************************************************************

[ SIGNAL MEDIA LTD ]

Discrovery Pages JavaScript File (discovery.js)
Version: 2.0;
Author: Samir Moussa;
Email: samir.moussa@signal.uk.com, smoussa@hotmail.co.uk;

	- Description
	
	- Contents

*****************************************************************************/

$(document).ready(function() {

	/*=========================================================
		Initialise Objects
	=========================================================*/

	/*
		Navigation object
	*/
	var navigation = {

		$categories: $('.category'),
		$categoryHeaders: $('.category h2'),
		$lists: $('.list'),

		listOpen: false,
		openedIndex: null,
		openedHeader: null,

		// The amount by which the content moves down. (Used for trigger height).
		moveAmount: 150,

		openClickedCategory: function(self) {
			
			var category = self.parent();
			var list = navigation.$lists.eq(category.index());

			navigation.hideOtherCategories();
			navigation.$categoryHeaders.addClass('grey');
			category.removeClass('grey');
			category.addClass('black');
			list.addClass('show');

			navigation.listOpen = true;

		},

		closeClickedCategory: function() {

			navigation.$lists.removeClass('show');
			navigation.$categories.removeClass('black');

			navigation.listOpen = false;
		},

		hideOtherCategories: function() {
			navigation.$categories.addClass('grey');
		},

		openNavigation: function() {
			PAGE.$content.addClass('opened');
			BANNER.triggerHeight += navigation.moveAmount;
			navigation.listOpen = true;
		},

		closeNavigation: function() {
			navigation.$categories.removeClass('grey');
			navigation.$categories.removeClass('black');
			navigation.$lists.removeClass('show');
			PAGE.$content.removeClass('opened');
			BANNER.triggerHeight -= navigation.moveAmount;
			navigation.listOpen = false;
		}

	}

	/*
		Panel set object
	*/
	var panels = {
		
		$panels: $('.panel'),
		$categoryPanel: $('.category.panel'),
		$subcategoryPanel: $('.subcategory.panel'),
		$mobileNavBtns: $('.mobile-nav-btn.opens-panel'),

		$darkBack: $('.dark-back'),
		$backBtn: $('.subcategory.panel .title .outer'),
		$closeBtn: $('.panel .close-btn'),

		closeAllPanels: function() {

			PAGE.$body.removeClass('panel-pushed');
		   	panels.$panels.removeClass('pushed');
		   	panels.$darkBack.removeClass('show');

		   	// Reset styling of headers
		   	if (PAGE.isTabletLandscape() && navigation) {
		   		navigation.closeNavigation();
		   	}

		   	PAGE.enableScrolling();

		}

	}


	/*=========================================================
		Initialise Global Variables
	=========================================================*/

	BANNER.triggerHeight = BANNER.calculateTriggerHeight();


	/*=========================================================
		Window Scroll & Resize Listeners
	=========================================================*/

	/*
		Window Resize
	*/
	$(window).resize(function() {
    	if (PAGE.isTabletLandscape()) { // if tablet landscape
    		navigation.closeNavigation();
    	}
    	BANNER.triggerHeight = BANNER.calculateTriggerHeight();
    });


    /*=========================================================
		General Event Listeners
	=========================================================*/

	/*
		When navigation category header is clicked
	*/
	navigation.$categoryHeaders.on("click", function() {

		if (PAGE.isTabletLandscape()) {
			sectorPanel.openPanel();
		} else {

			var category = $(this).parent();
			var index = category.index();

			if (navigation.listOpen) {

				navigation.closeClickedCategory();

				// same category is clicked
				if (navigation.openedIndex == index) {
					navigation.closeNavigation();
				} else { // different category clicked
					navigation.openClickedCategory($(this));
				}

			} else { // else if navigation list is not open

				navigation.openNavigation();
				navigation.openClickedCategory($(this));

			}

			navigation.openedHeader = self;
			navigation.openedIndex = index;

		}

	});


	/*
		Close navigation when a list item is clicked
	*/
	navigation.$lists.find('a').on("click", function() {
		navigation.closeNavigation();
	});

	// Toggle between following and not following when the follow button is clicked.
	$('.follow').on("click", function() {

		var self = $(this);
		var label = self.children('.text');
		var text = label.text();

		self.toggleClass('following');
		if (text == "Follow Topic") {
			label.text("Following");
		} else {
			label.text("Follow Topic");
		}

	});

	

	// Create the top level and sub level panel objects
	var sectorPanel = new PANEL(panels.$categoryPanel);
	var subSectorPanel = new PANEL(panels.$subcategoryPanel);

	// Open first side panel
	panels.$mobileNavBtns.on("click", function() {
		sectorPanel.openPanel();
	});	

	// Open the second panel of toggle 'All' if the first item is clicked
	panels.$categoryPanel.find('a').on("click", function() {
		
		var self = $(this);
		if (self.hasClass('all')) {
			self.children('span').toggleClass('filled'); // select this one
		} else {
			subSectorPanel.openPanel();
		}

	});

	// Go back button
	panels.$backBtn.on("click", function() {
		subSectorPanel.closePanel();
	});

	// Set of items on the second panel.
	panels.$subcategoryPanel.find('a').on("click", function() {

		var self = $(this).children('span');
		var isChecked = self.hasClass('filled');

		panels.$subcategoryPanel.find('a span').removeClass('filled');
		if (!isChecked) {
			self.addClass('filled');
		}
		panels.closeAllPanels();

	});














    /******* DEMO TOGGLE CONTEXTUAL MODULES *********/

    /*$('article').on("click", function() {

    	var self = $(this);

    	if (self.hasClass('chosen')) {
    		$('.module').removeClass('show');
    	}
    	self.siblings().addClass('hide');

    	$(this).siblings().addClass('hide');
    	$(this).removeClass('hide');
    	$(this).removeClass('chosen');

    	if ($(this).hasClass('chosen')) {
    		$('.module').removeClass('show');
    		$(this).siblings().removeClass('hide');
    	} else {
    		$('.module').addClass('show');
    	}

    	return false;
    });*/

   	/*
   		When an article is clicked,
   		scroll to the article and show its contextual info
   	*/
    /*articles.on('click', function(e) {

    	// Get the offset of the article relative to the document
    	var articleOffset = $(this).offset().top;
    	var sidbarOffset = $('.side').offset().top;

    	console.log("article:" + articleOffset);

    	// Scroll to the top of that article
    	$('html, body').stop().animate({ 
			scrollTop: articleOffset
		}, 300);
    	e.preventDefault();

		// Show contextual module

		// Get the article's contextual module group id
    	var moduleGroup = $(this).attr("href");

    	// Attach the module to the side of the article
    	$(moduleGroup).css({
    		position: "absolute",
    		top: (articleOffset - sidbarOffset) + "px"
    	});

    	console.log(articleOffset - sidbarOffset);

    });*/


	/******* DEMO CHANGE FEED *********/

	/*var currentFeed = $('.feed').first();
	$('.list ul a, .subcategory.panel a').on("click", function() {

		PAGE.$content.removeClass('opened');
		navigation.$lists.removeClass('show');
		//navigation.$categoryHeaders.children('.outer').removeClass('rotate');
		navigation.$categories.removeClass('black');
		navigation.$categories.removeClass('grey');

		navigation.listOpen = false;


		// DEMO: Change content
		var self = $(this);
		if (self.parent().hasClass('title')) {
			navigation.openedHeader.children('span').first().text(self.text());
		}
		
		$('.feed').toggleClass('show');

	});*/


});