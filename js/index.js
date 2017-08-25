var busApp = angular.module('busApp', []);
    busApp.controller('busController', function($scope, $http) {
      $scope.user = {};
        $scope.searchData = function() {
        $http({
          method  : 'POST',
          url     : "db.php",
          data    : $scope.user,
          headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
         })
          
        };
    });