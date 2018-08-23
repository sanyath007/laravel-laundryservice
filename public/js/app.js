var app = angular.module('app', ['xeditable','ngTagsInput','toaster','ngAnimate','angularModalService']);

app.constant('CONFIG', {
    'APP_NAME' : 'My Awesome App',
    'APP_VERSION' : '1.0.0',
    'GOOGLE_ANALYTICS_ID' : '',
    'BASE_URL' : 'http://localhost/public/laundryservice/public/',
    'SYSTEM_LANGUAGE' : 'TH'
});

app.run(function(editableOptions) {
    editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
    editableOptions.activate = 'select';
});

app.controller('ModalController', function($scope, close){
	// close('Success!');
});