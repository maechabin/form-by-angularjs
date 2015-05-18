var angular = angular || {};

angular.module("formApp", [])
 .controller("FormController", ["$scope", function ($scope) {

   "use strict";

   $scope.master = {};

   $scope.send = function (user) {

     this.master = angular.copy(user);
     console.dir(this.master);
     this.ajax().done(function (d) {
       alert(d);
     });

     return false;

   };

   $scope.ajax = function () {

     var d = new $.Deferred();

     $.ajax({

       type: "POST",
       url: "./php/index.php",
       data: this.master,
       processData: false,
       contentType: false,
       success: d.resolve,
       error: d.reject

     });

     return d.promise();

   };

 }]);
