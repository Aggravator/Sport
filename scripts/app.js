var app=angular.module('App',[]).run(function($rootScope) {
	$rootScope.user=usr;
});
app.controller("sportmanReg",["$scope","$http",function($scope,$http){
	$scope.sportmans=[];
	$scope.editSportman=function(index){
		MD.editSportman.show({index:index,sportman:$scope.sportmans[index],callback:function(obj){
			$scope.$apply(function(){
				$scope.sportmans[obj.index].weight=obj.weight;
				$scope.sportmans[obj.index].gender=obj.gender;
				$scope.sportmans[obj.index].rank=obj.rank;
			});
		}});
	}
	$scope.addSportman=function(){
		MD.addSportman.show({callback:function(obj){
			$scope.$apply(function(){
				$scope.sportmans.push(obj);
			});
		}});
	}
	$scope.removeSportman=function(index){
		$scope.sportmans.splice(index,1);
	}
	$scope.register=function(){
		$http.post("/Sport/data/couchTournamentReg.php?qtype=ajax",{tournament:$scope.newT[$scope.activeTournament].id,athlets:$scope.sportmans}).success(function(data, status, headers, config) {
			if(data.result=='success'){
				$scope.moveCurNewToActive();
			}
		});
	}
}]);
app.controller("sportmanActive",["$scope","$http",function($scope,$http){
	$scope.hasChanged=false;
	$scope.sportmans=[];
	$scope.refresh=function(){
		$http.get('/Sport/data/couchTournamentActive.php?qtype=ajax&tournament='+$scope.activeT[$scope.activeTournament].id).success(function(data, status, headers, config) {
			for(i=0;i<data.length;++i){
				if(data.ismale)data[i].gender={key:'Мужской',value:"true"};
				else data[i].gender={key:'Женский',value:"false"};
				switch(data[i].rank){
					case "1":
						data[i].rank={key:'1-й юношеский разряд',value:1};
						break;
					case "2":
						data[i].rank={key:'2-й юношеский разряд',value:2};
						break;
					case "3":
						data[i].rank={key:'3-й юношеский разряд',value:3};
						break;
					case "4":
						data[i].rank={key:'1-й спортивный разряд',value:4};
						break;
					case "5":
						data[i].rank={key:'2-й спортивный разряд',value:5};
						break;
					case "6":
						data[i].rank={key:'3-й спортивный разряд',value:6};
						break;
					case "7":
						data[i].rank={key:'КМС',value:7};
						break;
					case "8":
						data[i].rank={key:'МС',value:8};
						break;
					case "9":
						data[i].rank={key:'МСМК',value:9};
						break;
					case "10":
						data[i].rank={key:'ЗМС',value:10};
						break;
				}
				switch(data[i].status){
					case "1":
						data[i].status={key:'Одобрено',value:1};
						break;
					case "0":
						data[i].status={key:'Отклонено',value:2};
						break;
					default:
						data[i].status={key:'Не рассмотрено',value:0};
						break;
				}
			}
			$scope.sportmans=data;
		}).
		error(function(data, status, headers, config) {
			
		});
	}
	$scope.refresh();
	$scope.editSportman=function(index){
		MD.editSportman.show({index:index,sportman:$scope.sportmans[index],callback:function(obj){
			$scope.$apply(function(){
				$scope.sportmans[obj.index].weight=obj.weight;
				$scope.sportmans[obj.index].gender=obj.gender;
				$scope.sportmans[obj.index].rank=obj.rank;
				$scope.hasChanged=true;
			});
		}});
	}
	$scope.addSportman=function(){
		MD.addSportman.show({callback:function(obj){
			$scope.$apply(function(){
				obj.status={key:'Не рассмотрено',value:0};
				$scope.sportmans.push(obj);
				$scope.hasChanged=true;
			});
		}});
	}
	$scope.removeSportman=function(index){
		$scope.sportmans.splice(index,1);
		$scope.hasChanged=true;
	}
	$scope.save=function(){
		$http.post("/Sport/data/couchTournamentActiveCh.php?qtype=ajax",{tournament:$scope.activeT[$scope.activeTournament].id,athlets:$scope.sportmans}).success(function(data, status, headers, config) {
			if(data.result=='success'){
				$scope.hasChanged=false;
				if($scope.sportmans.length==0){
					$scope.moveCurActiveToNew();
				}
			}
		});
	}
}]);
app.controller("sportmanOld",["$scope","$http",function($scope,$http){
	$scope.sportmans=[];
	$scope.refresh=function(){
		$http.get('/Sport/data/couchTournamentActive.php?qtype=ajax&tournament='+$scope.oldT[$scope.activeTournament].id).success(function(data, status, headers, config) {
			for(i=0;i<data.length;++i){
				if(data.ismale)data[i].gender={key:'Мужской',value:"true"};
				else data[i].gender={key:'Женский',value:"false"};
				switch(data[i].rank){
					case "1":
						data[i].rank={key:'1-й юношеский разряд',value:1};
						break;
					case "2":
						data[i].rank={key:'2-й юношеский разряд',value:2};
						break;
					case "3":
						data[i].rank={key:'3-й юношеский разряд',value:3};
						break;
					case "4":
						data[i].rank={key:'1-й спортивный разряд',value:4};
						break;
					case "5":
						data[i].rank={key:'2-й спортивный разряд',value:5};
						break;
					case "6":
						data[i].rank={key:'3-й спортивный разряд',value:6};
						break;
					case "7":
						data[i].rank={key:'КМС',value:7};
						break;
					case "8":
						data[i].rank={key:'МС',value:8};
						break;
					case "9":
						data[i].rank={key:'МСМК',value:9};
						break;
					case "10":
						data[i].rank={key:'ЗМС',value:10};
						break;
				}
				switch(data[i].status){
					case "1":
						data[i].status={key:'Одобрено',value:1};
						break;
					case "0":
						data[i].status={key:'Отклонено',value:2};
						break;
					default:
						data[i].status={key:'Не рассмотрено',value:0};
						break;
				}
			}
			$scope.sportmans=data;
		}).
		error(function(data, status, headers, config) {
			
		});
	}
	$scope.refresh();
}]);
app.controller("rootCouch",["$scope","$http",function($scope,$http,$rootScope){
	$scope.refresh=function(){
		$http.get('/Sport/data/baseCouch.php?qtype=ajax').success(function(data, status, headers, config) {
			$scope.newT=data['newT'];
			$scope.activeT=data['activeT'];
			$scope.oldT=data['oldT'];
		}).
		error(function(data, status, headers, config) {
			
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
	$scope.moveCurNewToActive=function(){
		$scope.chooseActiveS(1,$scope.activeT.length);
		$scope.activeT.push($scope.newT.splice($scope.activeTournament,1)[0]);
		
	}
	$scope.moveCurActiveToNew=function(){
		$scope.chooseActiveS(0,$scope.newT.length);
		$scope.newT.push($scope.activeT.splice($scope.activeTournament,1)[0]);
	}
}]);
