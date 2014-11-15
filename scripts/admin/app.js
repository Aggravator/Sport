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
	$scope.refresh=function(){
		$http.get('/Sport/data/baseAdmin.php?qtype=ajax').success(function(data, status, headers, config) {
			$scope.newRequestCount=data.newRequestCount;
		});
	};
	$scope.refresh();
	$scope.tournamentsClick=function(){
		$scope.location.path("/tournaments");
	};
}]);
app.controller("tournamentsAdmin",["$scope","$http",function($scope,$http,$rootScope){
	$scope.refresh=function(){
		$http.get('/Sport/data/tournamentsAdmin.php?qtype=ajax').success(function(data, status, headers, config) {
			$scope.actualT=data.actualT;
			$scope.oldT=data.oldT; 
		});
	}
	$scope.refresh();
	$scope.activeCategory=1;
	$scope.clickCategory=function(catId){
		if($scope.activeCategory==catId)$scope.activeCategory=-1;else $scope.activeCategory=catId;
	}
	$scope.subviews=[{url:'templates/couch-sportm-reg.html'},{url:'templates/couch-sportm-active.html'},{url:'templates/couch-sportm-old.html'}];
	$scope.activeSubview={url:""};
	$scope.activeTournament=null;
	$scope.chooseActiveS=function(subview,index){
		$scope.activeSubview=$scope.subviews[subview];
		$scope.activeTournament=index;
	};
}]);