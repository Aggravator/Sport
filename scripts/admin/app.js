var app=angular.module('App',['ngRoute']).run(function($rootScope,$location) {
	$rootScope.user=usr;
	$rootScope.location=$location;
});
app.config(function($routeProvider,$locationProvider){
	$routeProvider.when('/', {
    	templateUrl: 'templates/admin-start.html'
   }).when('/tournaments',{
   		templateUrl: 'templates/admin-tournaments.html'
   }).otherwise({
   		redirectTo:'/'
   });
});
app.controller("rootAdmin",["$scope","$http",function($scope,$http,$rootScope){
	$scope.newRequestCount=1;
	$scope.tournamentsClick=function(){
		$scope.location.path("/tournaments");
	};
}]);