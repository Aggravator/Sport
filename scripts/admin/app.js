var app=angular.module('App',['ngRoute']).run(function($rootScope,$location) {
	$rootScope.user=usr;
	$rootScope.location=$location;
	$rootScope.navigationPath=[{name:"САМБО-70",url:"/"}]
});
app.config(function($routeProvider,$locationProvider){
	$routeProvider.when('/', {
    	templateUrl: 'templates/admin-start.html'
   }).when('/tournaments',{
   		templateUrl: 'templates/admin-tournaments.html'
   }).when('/requests',{
   		templateUrl: 'templates/admin-requests.html'
   }).otherwise({
   		redirectTo:'/'
   });
});
app.controller("navigationController",["$scope",function($scope,$rootScope){
	$scope.linkClick=function(index){
		$scope.location.path($scope.navigationPath[index].url);
		$scope.navigationPath.splice(index+1,$scope.navigationPath.length-index-1);
	};
	$scope.goBack=function(){
		$scope.navigationPath.pop();
		$scope.location.path($scope.navigationPath[$scope.navigationPath.length-1].url);
	};
}]);
app.controller("rootAdmin",["$scope","$http",function($scope,$http,$rootScope){
	$scope.newRequestCount=1;
	$scope.refresh=function(){
		$http.get('/Sport/data/baseAdmin.php?qtype=ajax').success(function(data, status, headers, config) {
			$scope.newRequestCount=data.newRequestCount;
		});
	};
	$scope.refresh();
	$scope.tournamentsClick=function(){
		$scope.navigationPath.push({name:"Турниры",url:"/tournaments"});
		$scope.location.path("/tournaments");
	};
	$scope.requestsClick=function(){
		$scope.navigationPath.push({name:"Заявки",url:"/requests"});
		$scope.location.path("/requests");
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
	$scope.subviews=[{url:'templates/create-tournament-admin.html'},{url:'templates/watch-tournament-admin.html'},{url:'templates/old-tournament-admin.html'}];
	$scope.activeSubview={url:""};
	$scope.activeTournament=null;
	$scope.chooseActiveS=function(subview,sport){
		if(subview==0){
			$scope.activeSubview={url:""};
			return;
		}
		$scope.activeSubview=$scope.subviews[subview];
		$scope.activeTournament=sport.id;
	};
	$scope.createTournament=function(){
		$scope.activeSubview=$scope.subviews[0];
	};
}]);
app.controller("adminCreateTournament",["$scope","$http",function($scope,$http,$rootScope){
	$scope.tournament={};
	$scope.refresh=function(){
		$http.get('/Sport/data/getSports.php?qtype=ajax').success(function(data, status, headers, config) {
			$scope.sports=data.sports;
		});
	}
	$scope.refresh();
	var picker2=new Pikaday({
    	field:document.getElementsByName("rdateend")[0],
    	format: 'DD.MM.YYYY'
    });
    var picker=new Pikaday({
    	field:document.getElementsByName("start-date")[0],
    	format: 'DD.MM.YYYY'
    });
    $scope.submit=function(){
    	if(!$scope.createtournament.$invalid){
    		$http.post("/Sport/data/createTournament.php?qtype=ajax",$scope.tournament).success(function(data, status, headers, config) {
				if(data.result=='success'){
					$scope.chooseActiveS(0,1);
					$scope.$parent.refresh();
				}
			});
    	}
    }
}]);
app.controller("adminWatchTournament",["$scope","$http",function($scope,$http,$rootScope){
	$scope.tournament={};
	$scope.refresh=function(){
		if($scope.sports==undefined){
			$http.get('/Sport/data/getSports.php?qtype=ajax').success(function(data, status, headers, config) {
				$scope.sports=data.sports;
				$http.get('/Sport/data/getTournamentInf.php?qtype=ajax&tid='+$scope.activeTournament).success(function(data, status, headers, config) {
					data.birthdayStart=parseInt(data.birthdayStart);
					data.birthdayEnd=parseInt(data.birthdayEnd);
					$scope.tournament=data;
				});
			});
		}else{
			$http.get('/Sport/data/getTournamentInf.php?qtype=ajax&tid='+$scope.activeTournament).success(function(data, status, headers, config) {
				data.birthdayStart=parseInt(data.birthdayStart);
				data.birthdayEnd=parseInt(data.birthdayEnd);
				$scope.tournament=data;
			});
		}

	}
	$scope.status={text:'Редактировать',id:1};
	$scope.refresh();
	$scope.$watch('activeTournament', function(newValue, oldValue) {
		$scope.refresh();
	});
	var picker2=new Pikaday({
    	field:document.getElementsByName("rdateend")[0],
    	format: 'DD.MM.YYYY'
    });
    var picker=new Pikaday({
    	field:document.getElementsByName("start-date")[0],
    	format: 'DD.MM.YYYY'
    });
    $scope.submit=function(){
    	if($scope.status.id==1){
    		$scope.status={id:2,text:'Сохранить'};
    	}else if($scope.status.id==2){
    		if(!$scope.createtournament.$invalid){
    			$http.post("/Sport/data/updateTournament.php?qtype=ajax&tid="+$scope.activeTournament,$scope.tournament).success(function(data, status, headers, config) {
					if(data.result=='success'){
						
						$scope.$parent.refresh();
						$scope.status={text:'Редактировать',id:1};
					}
				});
    		}
    	}
    }
}]);
app.controller("adminWatchOldTournament",["$scope","$http",function($scope,$http,$rootScope){
	$scope.tournament={};
	$scope.refresh=function(){
		if($scope.sports==undefined){
			$http.get('/Sport/data/getSports.php?qtype=ajax').success(function(data, status, headers, config) {
				$scope.sports=data.sports;
				$http.get('/Sport/data/getTournamentInf.php?qtype=ajax&tid='+$scope.activeTournament).success(function(data, status, headers, config) {
					data.birthdayStart=parseInt(data.birthdayStart);
					data.birthdayEnd=parseInt(data.birthdayEnd);
					$scope.tournament=data;
				});
			});
		}else{
			$http.get('/Sport/data/getTournamentInf.php?qtype=ajax&tid='+$scope.activeTournament).success(function(data, status, headers, config) {
				data.birthdayStart=parseInt(data.birthdayStart);
				data.birthdayEnd=parseInt(data.birthdayEnd);
				$scope.tournament=data;
			});
		}

	}
	$scope.status={text:'Редактировать',id:1};
	$scope.refresh();
	$scope.$watch('activeTournament', function(newValue, oldValue) {
		$scope.status={text:'Редактировать',id:1};
		$scope.refresh();
	});
}]);
app.controller("requestsAdmin",["$scope","$http",function($scope,$http,$rootScope){
	$scope.refresh=function(){
		$http.get('/Sport/data/requestsAdmin.php?qtype=ajax').success(function(data, status, headers, config) {
			$scope.newR=data.newR;
			$scope.oldR=data.oldR; 
		});
	}
	$scope.refresh();
	$scope.activeCategory=1;
	$scope.clickCategory=function(catId){
		if($scope.activeCategory==catId)$scope.activeCategory=-1;else $scope.activeCategory=catId;
	}
	$scope.subviews=[{url:'templates/sportmans-approved.html'},{url:'templates/sportmans-approved.html'}];
	$scope.activeSubview={url:""};
	$scope.activeRequest=null;
	$scope.chooseActiveS=function(subview,request){
		if(subview==0){
			$scope.activeSubview={url:""};
			return;
		}
		$scope.activeSubview=$scope.subviews[subview-1];
		$scope.activeRequest=request;
	};
}]);
app.controller("sportmanApprove",["$scope","$http",function($scope,$http){
	$scope.hasChanged=false;
	$scope.sportmans=[];
	$scope.refresh=function(){
		$http.get('/Sport/data/getRequestInf.php?qtype=ajax&tournament='+$scope.activeRequest.tid+'&cid='+$scope.activeRequest.creator).success(function(data, status, headers, config) {
			for(i=0;i<data.sportmans.length;++i){
				if(data.sportmans[i].ismale)data.sportmans[i].gender={key:'Мужской',value:"true"};
				else data.sportmans[i].gender={key:'Женский',value:"false"};
				switch(data.sportmans[i].rank){
					case "1":
						data.sportmans[i].rank={key:'1-й юношеский разряд',value:1};
						break;
					case "2":
						data.sportmans[i].rank={key:'2-й юношеский разряд',value:2};
						break;
					case "3":
						data.sportmans[i].rank={key:'3-й юношеский разряд',value:3};
						break;
					case "4":
						data.sportmans[i].rank={key:'1-й спортивный разряд',value:4};
						break;
					case "5":
						data.sportmans[i].rank={key:'2-й спортивный разряд',value:5};
						break;
					case "6":
						data.sportmans[i].rank={key:'3-й спортивный разряд',value:6};
						break;
					case "7":
						data.sportmans[i].rank={key:'КМС',value:7};
						break;
					case "8":
						data.sportmans[i].rank={key:'МС',value:8};
						break;
					case "9":
						data.sportmans[i].rank={key:'МСМК',value:9};
						break;
					case "10":
						data.sportmans[i].rank={key:'ЗМС',value:10};
						break;
				}
			}
			$scope.sportmans=data.sportmans;
			$scope.creator=data.creator;
			$scope.club=data.club;
		}).
		error(function(data, status, headers, config) {
			
		});
	}
	$scope.refresh();
	$scope.makeChange=function(){
		$scope.hasChanged=true;
	};
	$scope.save=function(){
		$http.post('/Sport/data/requestUpdate.php?qtype=ajax&tournament='+$scope.activeRequest.tid+'&cid='+$scope.activeRequest.creator,{athlets:$scope.sportmans}).success(function(data, status, headers, config) {
			if(data.result=='success'){
				$scope.hasChanged=false;
				$scope.chooseActiveS(0,0);
				$scope.$parent.refresh();
			}
		});
	}
}]);