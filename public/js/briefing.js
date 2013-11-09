/*****************************************************************************

[ SIGNAL MEDIA LTD ]

Briefing JavaScript file (briefing.js)
Version: 2.0;
Author: Samir Moussa;
Email: samir.moussa@signal.uk.com, smoussa@hotmail.co.uk;

	- Description

	This file holds the event listeners for components including the main
	image banner and the topic filter menu. This javascript allows the page
	to collapse when the user scrolls.
	
	- Contents

	* Initial Variables
	* Statements
	* Functions
	* Other

*****************************************************************************/

$(document).ready(function() {

	/*=========================================================
		Class Definitions
	=========================================================*/

	/*
		Filter Class
	*/
	function Filter(desktopFilterHeading, mobileFilterHeading, mobileFilterPanel) {

		this.mobileFilterHeading = mobileFilterHeading;
		this.desktopFilterHeading = desktopFilterHeading;

		this.filterPanel = mobileFilterPanel;
		this.mobileFilterPanel = new PANEL(mobileFilterPanel);

		// save heading
		this.headingText = desktopFilterHeading.find('.title').text();
		this.mobileHeadingText = mobileFilterHeading.find('.title').text();

	}

	Filter.prototype.setFilter = function(filterName, index) {

		// set heading as filtered
		this.desktopFilterHeading.addClass('filtered');
		this.mobileFilterHeading.addClass('filtered');

		// set the filter heading text to the filter chosen
		this.mobileFilterHeading.find('.title').text(filterName);
		this.desktopFilterHeading.find('.title').text(filterName);

		// change icon on desktop
		var icon = this.desktopFilterHeading.find('.filter-icon');
		icon.removeClass('outer');
		icon.empty().append('<span class="glyphicon glyphicon-remove"></span>');

		MODULES.closeModule(this.desktopFilterHeading);

		// change icon on mobile
		icon = this.mobileFilterHeading.find('.filter-icon');
		icon.removeClass('arrow-right');
		icon.addClass('glyphicon glyphicon-remove');

	}

	Filter.prototype.removeFilter = function() {

		// set heading as not filtered
		this.desktopFilterHeading.removeClass('filtered');
		this.mobileFilterHeading.removeClass('filtered');

		// set filter text to elements
		this.mobileFilterHeading.find('.title').text(this.mobileHeadingText);
		this.desktopFilterHeading.find('.title').text(this.headingText);

		// change icon on desktop
		var icon = this.desktopFilterHeading.find('.filter-icon');
		icon.addClass('outer');
		icon.empty().append(
			'<span class="arrow-down"></span>'
		);

		// change icon on mobile
		icon = this.mobileFilterHeading.find('.filter-icon');
		icon.addClass('arrow-right');
		icon.removeClass('glyphicon glyphicon-remove');

		// close module
		MODULES.closeModule(this.desktopFilterHeading);

	}

	Filter.prototype.openFilterPanel = function() {
		this.mobileFilterPanel.openPanel();
	}

	Filter.prototype.setChosenPanelFilterOption = function(index) {
		this.clearPanelFilterOptions();
		this.filterPanel.find('li').eq(index).find('.circle').addClass('filled');
	}

	Filter.prototype.clearPanelFilterOptions = function() {
		this.filterPanel.find('a span').removeClass('filled');
	}

	Filter.prototype.togglePanelRadioButton = function(self) {

		// Fill the radio button
		var circle = self.children('span');
		var isChecked = circle.hasClass('filled');

		this.clearPanelFilterOptions();
		if (!isChecked) {
			circle.addClass('filled');
		} else {
			this.removeFilter();
		}

		panels.closeAllPanels();

	}


	/*
		Create the filter objects
	*/
	var topicFilter = new Filter(
		$('#topic-filter-btn'),
		$('#topic-filter-btn-mobile'),
		$('.topic-filter.panel')
	);
	var sectorFilter = new Filter(
		$('#sector-filter-btn'),
		$('#sector-filter-btn-mobile'),
		$('.sector-filter.panel')
	);


	/*
		Filter Panels Object
	*/
	var panels = {

		$panels: $('.panel'),
		$darkBack: $('.dark-back'),

		closeAllPanels: function() {
			PAGE.$body.removeClass('panel-pushed');
		   	panels.$panels.removeClass('pushed');
		   	panels.$darkBack.removeClass('show');
		   	PAGE.enableScrolling();
		}

	}


	/*=========================================================
		Filter Modules Event Listeners
	=========================================================*/


	// Choose a filter when a topic filter is pressed
	$('.module.filter .topic.group-items .module-option').on("click", function() {

		var filterName = $(this).find('.title').text();
		topicFilter.setFilter(filterName);
		topicFilter.setChosenPanelFilterOption($(this).index()); // set this as the filter

	});

	// Remove filter from topic filter when X icon is clicked
	$('.module #topic-filter-btn').on("click", '.glyphicon-remove', function(e) {
		
		e.stopPropagation();
		topicFilter.removeFilter();
		topicFilter.clearPanelFilterOptions(); // clear mobile panel filters

	});

	// Choose a filter when a sector filter is pressed
	$('.module.filter .sector.group-items .module-option').on("click", function() {

		var filterName = $(this).find('.title').text();
		sectorFilter.setFilter(filterName);
		sectorFilter.setChosenPanelFilterOption($(this).index()); // set this as the filter

	});

	// Remove filter from sector filter when X icon is clicked
	$('.module #sector-filter-btn').on("click", '.glyphicon-remove', function(e) {

		e.stopPropagation();
		sectorFilter.removeFilter();
		sectorFilter.clearPanelFilterOptions(); // clear mobile panel filters

	});

	

	/*=========================================================
		Filter Panels Event Listeners
	=========================================================*/

	// Open topic filter panel
	topicFilter.mobileFilterHeading.on("click", function() {
		topicFilter.openFilterPanel();
	});

	// Open sector filter panel
	sectorFilter.mobileFilterHeading.on("click", function() {
		sectorFilter.openFilterPanel();
	});

	// Choose to filter topic when clicked
	topicFilter.filterPanel.find('a').on("click", function() {

		var self = $(this);
		var filterName = self.children('.text').text();
		topicFilter.setFilter(filterName);
		topicFilter.togglePanelRadioButton(self);

	});

	// Remove topic filter when X button on mobile is clicked
	topicFilter.mobileFilterHeading.on("click", '.glyphicon-remove', function(e) {

		e.stopPropagation();
		topicFilter.removeFilter();
		topicFilter.clearPanelFilterOptions();

	});

	// Choose to filter sector when clicked
	sectorFilter.filterPanel.find('a').on("click", function() {

		var self = $(this);
		var filterName = self.children('.text').text();
		sectorFilter.setFilter(filterName);
		sectorFilter.togglePanelRadioButton(self);

	});

	// Remove sector filter when X button on mobile is clicked
	sectorFilter.mobileFilterHeading.on("click", '.glyphicon-remove', function(e) {

		sectorFilter.removeFilter();
		sectorFilter.clearPanelFilterOptions();
		e.stopPropagation();

	});


});