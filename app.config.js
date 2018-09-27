// var origin = document.location.origin;
// var folder = document.location.pathname.split('/')[1];
//
// var path = origin + "/" + folder + "/web/bundles/foobarbundles/partials";

// var fooBarApp = angular.module('fooBarApp', ['ngRoute','footBarApp.controllers',]);
// // pour lier avec Symfony
// fooBarApp.config(function($interpolateProvider) {
//     $interpolateProvider.startSymbol('||');
//     $interpolateProvider.endSymbol('||');
// });
//
// awesome.
//   config([ '$routeProvider',' $interpolateProvider' ,
//     function config( $routeProvider, $interpolateProvider) {
//       // $locationProvider.hashPrefix('!');
//       $interpolateProvider.startSymbol('||');
//       $interpolateProvider.endSymbol('||');
//
//       $routeProvider.
//         when('/amischerche', {
//           // template: '<login-list></login-list>',
//           templateUrl:'templates/amischerche/amischerch.html.twig',
//           controller:'mainController',
//         })
        // when('/users', {
        //   // template: '<login-list></login-list>',
        //   templateUrl:'templates/amischerche/amischerch.html.twig',
        //   controller:'mainController',
        // }).



      //   }
      // ])
  // when('/ticket/:id', {
  //   templateUrl : function(params){ return '/page/ticket/' + params.id; },
  //   controller: 'TicketController'
  // }).
.controller('amischerchController',['$scope' , function($scope, $http, $location){
    // $http.post("data/user.php")
    // .then(function (response)
    // { console.log(reponse);
    //   $scope.names = response.data;});


    // var amis=[];
    //
    // $scope.employees = amis;

    $scope.deleteart=function(artid){
        $http({
          method:"POST",
          url:"data/user.php",

        }).then(function(reponse){
          $scope.amis = reponse.data;

          console.log(reponse.data);
          $location.path('/amischerch');
        });
    }

  }
  .controller('DashboardController', function ($scope) {
  $scope.products = [
    {'name': 'ipad 1',
     'description': 'Super ipad'},
    {'name': 'ipad 2',
     'description': 'Un ipad encore mieux'},
    {'name': 'ipad 3',
     'description': 'Alors celui la il est encore mieux.'}
  ];
});


]);
