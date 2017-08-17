var app =  angular.module('main-App',['ngRoute','ngMessages','angularUtils.directives.dirPagination'],  
 function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});
/*
A directive to enable two way binding of file field
 */


app.value('apiUrl', 'http://admin.lokapala.website');
