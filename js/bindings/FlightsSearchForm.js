'use strict';
define(
	['knockout', 'jquery', 'jqueryUI', 'js/lib/jquery.pickmeup/jquery.pickmeup'],
	function (ko, $) {
		// FlightsSearchForm Knockout bindings are defined here
		/*
		 ko.bindingHandlers.testBinding = {
			 init: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {},
			 update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {}
		 };

		 // Do not forget to add destroy callbacks
		 ko.utils.domNodeDisposal.addDisposeCallback(element, function() {});
		 */
		ko.bindingHandlers.positionPassengersPopup = {
			init: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
				// Timeout is needed because we don't have needed HTML at the time we call this binding.
				// Thus - we delay actual binding execution for knockout to construct needed HTML
				setTimeout(function () {
					var parent = element.parentNode,
						offset = (parent.clientHeight - Math.min(element.clientHeight, parent.clientHeight)) / 2;

					element.style.marginTop = offset+'px';

//					if (element.clientHeight > parent.clientHeight) {
//						var header = element.children[0],
//							content = element.children[1],
//							footer = element.children[2];
//						content.style.height = (parent.clientHeight - header.clientHeight - footer.clientHeight)+'px';
//					}
				}, 1);
			}
		};

		// Extending jQueryUI.autocomplete for Flights Search Form geo autocomplete
		$.widget( "nemo.FlightsFormGeoAC", $.ui.autocomplete, {
			_renderItem: function( ul, item ) {
				// If item has label - it's something other than geo point that should be in AC
				return $( "<li>" )
							.append( typeof item.label != 'undefined' ? item.label : (item.name + ', ' + item.country.name) )
					.appendTo( ul );
			}
		});

		ko.bindingHandlers.flightsFormGeoAC = {
			init: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
				var $element = $(element),
					noResultsResults = [{value: '', label: viewModel.$$controller.i18n('FlightsSearchForm', 'autocomplete_noResults')}];

				$element.FlightsFormGeoAC({
					source: function (request, callback) {
						$.get(
							viewModel.$$controller.options.dataURL + '/guide/autocomplete/iata/' + encodeURIComponent(request.term),
							function (data) {
								var result = [],
									tmp;

								if (data.system && data.system.error) {
									callback(noResultsResults);
								}

								for (var i in data.guide.countries) {
									if (data.guide.countries.hasOwnProperty(i)) {
										tmp = data.guide.countries[i];
										tmp.IATA = i;

										data.guide.countries[i] = viewModel.$$controller.getModel('BaseStaticModel', tmp);
									}
								}

								// Converting autocomplete data into an array of possibilities
								for (var i = 0; i < data.guide.autocomplete.iata.length; i++) {
									if (data.guide.autocomplete.iata[i].isCity) {
										tmp = data.guide.cities[data.guide.autocomplete.iata[i].cityId];
										tmp.IATA = tmp.codeIATA;
										delete tmp.codeIATA;
									}
									else {
										tmp = data.guide.airports[data.guide.autocomplete.iata[i].IATA];
										tmp.IATA = data.guide.autocomplete.iata[i].IATA;
									}

									tmp.isCity = data.guide.autocomplete.iata[i].isCity;

									// Setting country
									tmp.country = null;
									if (data.guide.countries[tmp.countryCode]) {
										tmp.country = data.guide.countries[tmp.countryCode];
									}

									result.push(viewModel.$$controller.getModel('BaseStaticModel', tmp));
								}

								if (result.length == 0) {
									result = noResultsResults;
								}

								callback(result);
							},
							'json'
						).error(function () {
							callback(noResultsResults);
						});
					},
					open: function (event, ui) {
						var $children = $(this).data('nemo-FlightsFormGeoAC').menu.element.children();
						if ($children.length == 1) {
							$children.eq(0).mouseenter().click();
						}
					},
					select: function( event, ui ) {
						$element.blur();

						// If item has label - it's something other than geo point that should be in AC
						// So we set corresponding stuff only if it's valid
						if (typeof ui.item.label == 'undefined') {
							valueAccessor()(ui.item);

							// Autofocus stuff
							$element.trigger('nemo.fsf.segmentPropChanged');
						}

						return false;
					}
				});

				$element.on('blur', function (e) {
					$element.val('');
				});

				ko.utils.domNodeDisposal.addDisposeCallback(element, function() {
					$element.off('blur');

					try {
						$element.autocomplete('destroy');
					}
					catch (e) {/* Do nothing */}
				});
			},
			update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {}
		};

		ko.bindingHandlers.flightsFormAutoFocus = {
			init: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
				var $element = $(element);

				$element.on('nemo.fsf.segmentPropChanged', function (event, data) {
					var $target = $(event.target),
						$segment = $target.parents('.js-autofocus-segment'),
						segment = ko.dataFor(event.target),//data.segment,
						$focusField = null;

					if ($target.hasClass('js-autofocus-field_departure')) {
						if (!segment.items.arrival.value()) {
							$focusField = $segment.find('.js-autofocus-field_arrival');
						}
						else if (!segment.items.departureDate.value()) {
							$focusField = $segment.find('.js-autofocus-field_date');
						}
					}
					else if ($target.hasClass('js-autofocus-field_arrival')) {
						if (!segment.items.departureDate.value()) {
							$focusField = $segment.find('.js-autofocus-field_date');
						}
					}
					else if (
						$target.hasClass('') &&
						bindingContext.$data.tripType() == 'RT' &&
						segment.index == 0 &&
						!bindingContext.$data.segments()[1].items.departureDate.value()
					) {
						$focusField = $segment.parents('.js-autofocus-form').find('.js-autofocus-field_date').eq(1);
					}

					if ($focusField) {
						$focusField.focus();
					}
				});

				ko.utils.domNodeDisposal.addDisposeCallback(element, function() {
					$element.off('nemo.fsf.segmentPropChanged');
				});
			},
			update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {}
		};

		ko.bindingHandlers.flightsFormDatepicker = {
			init: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
				var $element = $(element);

				$element.on('blur', function () {
					$(this).val('');
				});

				// Do not forget to add destroy callbacks
				ko.utils.domNodeDisposal.addDisposeCallback(element, function() {
					$element.pickmeup('destroy');
					$element.off('blur');
				});
			},
			update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
				var $element = $(element),
					now = new Date(),
					minDate = (new Date()),
					maxDate = (new Date()),
					locale = {
						days:        [], // ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
						daysShort:   [], // ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
						daysMin:     [], // ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
						months:      [], // ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
						monthsShort: []  // ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
					};

				minDate.setDate(now.getDate() + bindingContext.$parent.options.dateOptions.minOffset);
				maxDate.setDate(now.getDate() + bindingContext.$parent.options.dateOptions.maxOffset);

				for (var i = 1; i <= 12; i++) {
					locale.months.push(bindingContext.$root.i18n('dates', 'month_' + i + '_f_n'));
					locale.monthsShort.push(bindingContext.$root.i18n('dates', 'month_' + i + '_s_n'));

					if (i == 1) {
						locale.days.push(bindingContext.$root.i18n('dates', 'dow_7_f'));
						locale.daysShort.push(bindingContext.$root.i18n('dates', 'dow_7_s'));
						locale.daysMin.push(bindingContext.$root.i18n('dates', 'dow_7_s'));
					}

					if (i <= 7) {
						locale.days.push(bindingContext.$root.i18n('dates', 'dow_' + i + '_f'));
						locale.daysShort.push(bindingContext.$root.i18n('dates', 'dow_' + i + '_s'));
						locale.daysMin.push(bindingContext.$root.i18n('dates', 'dow_' + i + '_s'));
					}
				}

				$element.pickmeup({
					locale: locale,
					calendars: 2,
					min: minDate,
					max: maxDate,
					format: 'd.m.Y',
					hideOnSelect: true,
					defaultDate: valueAccessor()() ? valueAccessor()().dateObject() : false,
					onSetDate: function () {
						$element.blur();

						// Autofocus stuff
						$element.trigger('nemo.fsf.segmentPropChanged');

						valueAccessor()(viewModel.$$controller.getModel('FlightsSearchForm/FlightsSearchFormDate', this.current));
					}
				});
			}
		};
	}
);