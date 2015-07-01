<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Nemo Front-End</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
</head>
<body>
<div class="nemo-common-pageWrapper">

	<header class="nemo-common-pageHeader">
		<div class="nemo-common-pageHeader__inner">

			<div class="new-ui-headerMenuControls nemo-common-pageHeader__inner__headerMenuControls">
					<span class="new-ui-button new-ui-button_transparent nemo-common-pageHeader__headerMenuControlls__menuButton js-menuButton">
						<i class="new-ui-mMenuIcon"></i>
					</span>
			</div>

			<a href="/" class="nemo-common-pageHeader__logo">
				<img class="nemo-common-pageHeader__logo__image" src="../img/logo.png" alt="">
			</a>

			<div class="nemo-common-pageHeader__inner__headerLinks">

				<button class="new-ui-button new-ui-button_common new-ui-button_medium nemo-common-pageHeader__inner__headerLinks__item">
					Войти
				</button>

				<a href="#" class="new-ui-pseudoLink new-ui-pseudoLink_blue nemo-common-pageHeader__inner__headerLinks__item">
					Регистрация
				</a>

				<a href="#" class="new-ui-pseudoLink new-ui-link_blue nemo-common-pageHeader__inner__headerLinks__item">
					Состояние заказа
				</a>

			</div>

			<div class="nemo-common-pageHeader__inner__headerRight">

				<div class="new-ui-dropMenu">

					<div class="new-ui-dropMenu__main">
						<button class="new-ui-button new-ui-button_common new-ui-button_languageAndCurrency">
							<img class="nemo-common-pageHeader__langSelectImage" src="../img/flag.svg" alt="">
						</button>
					</div>

					<div class="new-ui-dropMenu__drop">

					</div>

				</div>

				<div class="new-ui-dropMenu">

					<div class="new-ui-dropMenu__main">
						<button class="new-ui-button new-ui-button_common new-ui-button_languageAndCurrency">
							$
						</button>
					</div>

					<div class="new-ui-dropMenu__drop">

					</div>

				</div>

				<div class="new-layout-overlayMenu">

					<div class="new-layout-overlayMenu__main js-overlay-menu">
						<i class="new-ui-overlayMenu"></i>
					</div>

					<div class="new-layout-overlayMenu__drop js-overlay-menu">
						<div class="new-ui-mobileDropMenu">
							<div class="new-ui-mobileDropMenu__item">
								<div class="new-ui-dropMobile js-dropMobile" data-menu="lang">
									<div class="new-ui-dropMobile__main">
										<p>
											Русский
											<span>изменить</span>
										</p>
									</div>
								</div>
							</div>
							<div class="new-ui-mobileDropMenu__item">
								<div class="new-ui-dropMobile js-dropMobile" data-menu="cur">
									<div class="new-ui-dropMobile__main">
										<p>
											Российский рубль
											<span>изменить</span>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="new-ui-dropMobile-drop" data-menu-drop="lang">
							<div class="new-ui-dropMobile-drop__main">
								<div class="new-ui-mobileDropMenu">
									<div class="new-ui-mobileDropMenu__item">
										<a href="#" class="new-ui-link new-ui-link_grey">
											Русский
										</a>
									</div>
									<div class="new-ui-mobileDropMenu__item">
										<a href="#" class="new-ui-link new-ui-link_grey">
											Английский
										</a>
									</div>
									<div class="new-ui-mobileDropMenu__item">
										<a href="#" class="new-ui-link new-ui-link_grey">
											Испанский
										</a>
									</div>
									<div class="new-ui-mobileDropMenu__item">
										<a href="#" class="new-ui-link new-ui-link_grey">
											Украинский
										</a>
									</div>
								</div>
							</div>
							<div class="new-ui-dropMobile-drop__btns">
								<button class="new-ui-button new-ui-button_second js-closeDropMobile">Отмена</button>
							</div>
						</div>
						<div class="new-ui-dropMobile-drop" data-menu-drop="cur">
							<div class="new-ui-dropMobile-drop__main">
								<div class="new-ui-mobileDropMenu">
									<div class="new-ui-mobileDropMenu__item">
										<a href="#" class="new-ui-link new-ui-link_grey">
											Русский рубль
										</a>
									</div>
									<div class="new-ui-mobileDropMenu__item">
										<a href="#" class="new-ui-link new-ui-link_grey">
											Английский фунт
										</a>
									</div>
									<div class="new-ui-mobileDropMenu__item">
										<a href="#" class="new-ui-link new-ui-link_grey">
											Испанский евро
										</a>
									</div>
									<div class="new-ui-mobileDropMenu__item">
										<a href="#" class="new-ui-link new-ui-link_grey">
											Украинская гривна
										</a>
									</div>
								</div>
							</div>
							<div class="new-ui-dropMobile-drop__btns">
								<button class="new-ui-button new-ui-button_second js-closeDropMobile">Отмена</button>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

	</header>

	<!-- Template override example -->
	<!--<script id="nemo-koTemplate-FlightsResults-Group" type="text/html">-->
		<!--<div>Overridden Flights Results Group template</div>-->
	<!--</script>-->

	<div class="nemo-root nemo-widget nemo-widget_flights js-nemoApp" data-bind="moneyInit: $data">
		<!-- ko if: component() -->
		<div style="display: none;" data-bind="attr:{style: ''}">
			<div class="" data-bind="component: {
					name: component,
					params: {
						route: componentRoute(),
						additional: componentAdditionalParams()
					}
				}">Loading component...</div>
		</div>
		<!-- /ko -->
		<!-- ko if: !component() && !globalError() -->
		<div>
			LOADING APP
		</div>
		<!-- /ko -->
		<!-- ko if: globalError() -->
		<div data-bind="text: globalError"></div>
		<!-- /ko -->
	</div>

	<!-- TODO incorporate in our css -->
	<!--<link rel="stylesheet" href="/js/lib/jqueryUI/v.1.11.4/jquery-ui.min.css">-->
	<!--<link rel="stylesheet" href="/js/lib/jqueryUI/v.1.11.4/jquery-ui.css">-->
	<?php $host = 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'.$_SERVER['HTTP_HOST']; ?>

	<link rel="stylesheet" href="<?php echo $host; ?>/css/style.css">

	<script src="<?php echo $host; ?>/js/lib/requirejs/v.2.1.15/require.js"></script>
	<script>
		var nemoSourceHost = '<?php echo $host; ?>';
		require.config({
			// This should be deleted
			urlArgs: "bust=" + (new Date()).getTime(),

			// Common libraries
			paths: {
				domReady:      nemoSourceHost+'/js/lib/requirejs/domReady',
				text:          nemoSourceHost+'/js/lib/requirejs/text',
				knockout:      nemoSourceHost+'/js/lib/knockout/v.3.2.0/knockout-3.2.0',
				AppController: nemoSourceHost+'/js/NemoFrontEndController',
				jquery:        nemoSourceHost+'/js/lib/jquery/v.2.1.3/jquery-2.1.3.min',
				jqueryUI:      nemoSourceHost+'/js/lib/jqueryUI/v.1.11.4/jquery-ui.min',
				jsCookie:      nemoSourceHost+'/js/lib/js.cookie/v.2.0.0/js.cookie',
				tooltipster:   nemoSourceHost+'/js/lib/tooltipster/jquery.tooltipster.min',
				numeralJS:     nemoSourceHost+'/js/lib/numeral.js/v.1.5.3/numeral.min',
				mousewheel:    nemoSourceHost+'/js/lib/jquery.mousewheel/jquery.mousewheel.min'
			},

			baseUrl: nemoSourceHost,
			enforceDefine: true,
			waitSeconds: 300,

			// Overriding requirejs.text so templates will ALWAYS be fetched via XHR request
			// RTFM: https://github.com/requirejs/text#xhr-restrictions
			config: {
				text: {
					useXhr: function (url, protocol, hostname, port) {
						// Override function for determining if XHR should be used.
						// Return true means "use xhr", return false means "fetch the .js version of this resource".
						return true;
					}
				}
			}
		});

		require (
				['AppController'],
				function (AppController) {
					var controller = new AppController(
							document.getElementsByClassName('js-form')[0],
							{
								sourceURL: nemoSourceHost,
								dataURL: 'http://demo.mlsd.ru/api',
								staticInfoURL: 'http://demo.mlsd.ru',
								root: '/',
//						verbose: true,
								i18nLanguage: 'ru',
								postParameters: {},

								// Passing additional parametes to components
								componentsAdditionalInfo: {
									'Flights/SearchForm/Controller': {
										delayed: true/*,
										 init: {
										 direct: true,
										 serviceClass: 'Business',
										 vicinityDates: true,
										 passengers: {
										 ADT: 2,
										 INF: 1,
										 CLD: 2
										 },
										 segments: [
										 [
										 'KBP',
										 'LON',
										 '2015-05-31',
										 false,
										 true
										 ],
										 [
										 'LON',
										 'IEV',
										 '2015-06-01',
										 true,
										 true
										 ],
										 ]
										 }*/
									}
								}
							}
					);
				}
		);

		// Extensions example
		/*require (
			['AppController', 'knockout'],
			function (AppController, ko) {
				// Models extension
				AppController.prototype.extend('FlightsSearchForm/FlightsSearchFormController', function () {
					var self = this;

					// Example of adding/changing parameters
					this.extended = 'some value';
					this.extendedObservable = ko.observable(0);
					setInterval(function(){self.extendedObservable(self.extendedObservable() + 1)}, 1000);

					// Example of overriding of prototype function
					this.getUsedModels = function () {
						var tmp = this.$$usedModels;

						tmp.push(this.extended);

						return tmp;
					}
				});

				// i18n extension
				AppController.prototype.i18nExtend(
					{
						'FlightsSearchForm':{'test_i18n_variable':'Extended i18n', 'new':'New i18n var'},
						'newSegment':{'test_i18n_variable':'Var from new segment'}
					}
				);
			}
		);*/
	</script>
</div>
<footer class="nemo-common-footer">
	<div class="nemo-common-footer__footerInner">
		<div class="nemo-common-footer__left">
			<div class="nemo-common-footer__footerMenu">
				<a href="#" class="nemo-common-footer__footerMenu__item">
					Помощь
				</a>
				<a href="#" class="nemo-common-footer__footerMenu__item">
					Обратная связь
				</a>
			</div>
			<div class="nemo-common-footer__copyRight">
				© nemo.travel
			</div>
		</div>
		<div class="nemo-common-footer__right">
			<div class="nemo-common-footer__companyLogo">
				<img src="../img/nemo-logo.svg" alt="">
			</div>
			<div class="nemo-common-footer__companyLogo">
				<img src="../img/mute-lab-logo.svg" alt="">
			</div>
		</div>
	</div>
</footer>
</body>
</html>