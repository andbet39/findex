/**
 * Created by andrea.terzani on 22/04/2015.
 */
var app = angular.module('fileApp', ['ngFileUpload','ui.bootstrap'], function() {

});


app.controller('fileController', ['$scope', 'Upload','$http', function ($scope, Upload,$http) {


    $scope.uploaded = [];
        $scope.found = [];
        $scope.search='';


        $scope.$watch('files', function () {
            $scope.upload($scope.files);


        });

        $scope.upload = function (files) {
            if (files && files.length) {
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];

                    Upload.upload({
                        url: '/file',
                        file: file
                    }).progress(function (evt) {
                        var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                        evt.config.file.progress = progressPercentage;

                        console.log('progress: ' + progressPercentage + '% ' + evt.config.file.name);
                    }).success(function (data, status, headers, config) {
                        console.log('file ' + config.file.name + 'uploaded. Response: ' + data);
                        $scope.getfiles();
                        $scope.reindex();
                    });
                }
            }
        };


        $scope.getfiles = function(){
            $http.get('/list').
                success(function(data, status, headers, config) {
                    $scope.uploaded = data;
                });
        };


        $scope.delete = function(name){
            $http.get('/delete/'+ name).
                success(function(data, status, headers, config) {
                    $scope.getfiles();
                    $scope.reindex();
                });
        };


        $scope.getfiles();

        $scope.startSearch = function(){

            $http.get('/search/'+$scope.search).
                success(function(data, status, headers, config) {
                    console.log(data);
                   $scope.found =data.response.docs;
                });

        };



        $scope.reindex = function(){
            $http.get('/reindex').
                success(function(data, status, headers, config) {
                    console.log(data);
                });
        };



    }]);


