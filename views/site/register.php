
  <script>

    var formApp = angular.module('formApp', []);

    function formController($scope, $http) {

      $scope.formData = {};

      $scope.processForm = function() {
        $http({
              method  : 'POST',
              url     : "<?= \yii\helpers\Url::to(['users/register']); ?>",
              data    : $.param($scope.formData),  
              headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
          })
              .success(function(data) {
                  console.log(data);
                  console.log(data.message);

                  if (!data.success) {
                      $scope.errorEmail = data.email;
                  } else {
                      $scope.message = data.message;
                  }
              });
      };
    }
  </script>

<div class="col-md-6 col-md-offset-3">

  <div class="page-header">
    <h1><span class="glyphicon glyphicon-user"></span> Register</h1>
  </div>

   <div class="alert alert-success" role="alert" ng-show="message">{{ message }}</div>

  <form ng-submit="processForm()">
    <div  class="form-group" ng-class="{ 'has-error' : errorName }">
      <label>Name</label>
      <input type="text" name="name" class="form-control"  ng-model="formData.name" required>
                        
    </div>

    <div  class="form-group" ng-class="{ 'has-error' : errorEmail }">
      <label>Email</label>
      <input type="email" name="email" class="form-control"  ng-model="formData.email" required>
                        
    </div>

    <div  class="form-group" ng-class="{ 'has-error' : errorPassword }">
      <label>Password</label>
      <input type="password" name="password" class="form-control"  ng-model="formData.password">
    </div>
    <div  class="form-group" ng-class="{ 'has-error' : errorPasswordAgain }">
      <label>Password Confirmation</label>
      <input type="password" name="password_confirmation" class="form-control"  ng-model="formData.passwordAgain">
    </div>
    <div class="form-group">
    	<label>Gender</label>
		<div class="radio">
		  <label>
		    <input type="radio" name="gender"  value="m" checked>
		    Male
		  </label>
		</div>
		<div class="radio">
		  <label>
		    <input type="radio" name="gender" id="f" value="option2">
		    Female
		  </label>
		</div> 
	</div>
  <div class="form-group">
    <label for="">Hoppies</label>
    <textarea name="hoppies" class="form-control"></textarea>
  </div>	
    <button type="submit" class="btn btn-success btn-lg btn-block">
      <span class="glyphicon glyphicon-flash"></span> Submit!
    </button>
  </form>

 <div class="alert alert-danger" role="alert" ng-show="errorEmail">{{ errorEmail }}</div>

