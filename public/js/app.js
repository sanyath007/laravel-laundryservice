var app = angular.module('app', ['xeditable','ngTagsInput','toaster','ngAnimate','angularModalService']);

app.run(function(editableOptions) {
    editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
    editableOptions.activate = 'select';
});

app.controller('ModalController', function($scope, close){
	// close('Success!');
});